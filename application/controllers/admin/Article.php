<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/article_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/article/view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->article_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $article_id = $r->article_id;

            $link  = site_url('admin/article/editdata/' . $r->article_id);
            $row[] = '<a href="' . $link . '"><button class="btn btn-primary btn-xs" title="Edit Data"><i class="fa fa-edit"></i></button></a>
                        <a onclick="hapusData(' . $article_id . ')"><button class="btn btn-danger btn-xs" type="button" title="Delete Data"><i class="fa fa-times-circle"></i></button>';

            $row[] = $no;
            $row[] = date('d-m-Y', strtotime($r->article_post));
            $row[] = $r->user_username;
            $row[] = $r->category_name;
            $row[] = $r->article_title;
            $row[] = $r->article_read;
            $row[] = '<img src=' . base_url('img/article_folder/' . $r->article_image) . ' width="50%">';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->article_m->count_all(),
            "recordsFiltered" => $this->article_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function adddata()
    {
        $data['listCategory'] = $this->article_m->select_category()->result();
        $this->template->display('admin/article/add', $data);
    }

    public function savedata()
    {
        $jam  = time();
        $name = seo_title(stripHTMLtags($this->input->post('name', 'true')));

        $config['file_name']     = 'Article_' . $name . '_' . $jam . '.jpg';
        $config['upload_path']   = './img/article_folder/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['overwrite']     = true;
        $config['max_size']      = 0;
        $this->load->library('upload');
        $this->upload->initialize($config);
        // Resize
        $configThumb                   = array();
        $configThumb['image_library']  = 'gd2';
        $configThumb['source_image']   = '';
        $configThumb['maintain_ratio'] = true;
        $configThumb['overwrite']      = true;
        $configThumb['width']          = 700;
        $configThumb['height']         = 400;
        $this->load->library('image_lib');

        if (!$this->upload->do_upload('foto')) {
            $response['status'] = 'error';
        } else {
            $upload                      = $this->upload->do_upload('foto');
            $upload_data                 = $this->upload->data();
            $name_array[]                = $upload_data['file_name'];
            $configThumb['source_image'] = $upload_data['full_path'];
            $this->image_lib->initialize($configThumb);
            $this->image_lib->resize();

            $this->article_m->insert_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function editdata($article_id)
    {
        $data['listCategory'] = $this->article_m->select_category()->result();
        $data['detail']       = $this->article_m->select_by_id($article_id)->row();
        $this->template->display('admin/article/edit', $data);
    }

    public function updatedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam  = time();
            $name = seo_title(stripHTMLtags($this->input->post('name', 'true')));

            $config['file_name']     = 'Article_' . $name . '_' . $jam . '.jpg';
            $config['upload_path']   = './img/article_folder/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 0;
            $this->load->library('upload');
            $this->upload->initialize($config);
            // Resize
            $configThumb                   = array();
            $configThumb['image_library']  = 'gd2';
            $configThumb['source_image']   = '';
            $configThumb['maintain_ratio'] = true;
            $configThumb['overwrite']      = true;
            $configThumb['width']          = 700;
            $configThumb['height']         = 400;
            $this->load->library('image_lib');

            if (!$this->upload->do_upload('foto')) {
                $response['status'] = 'error';
            } else {
                $upload                      = $this->upload->do_upload('foto');
                $upload_data                 = $this->upload->data();
                $name_array[]                = $upload_data['file_name'];
                $configThumb['source_image'] = $upload_data['full_path'];
                $this->image_lib->initialize($configThumb);
                $this->image_lib->resize();

                $this->article_m->update_data();
                $response['status'] = 'success';
            }
        } else {
            $this->article_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->article_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Article.php */
