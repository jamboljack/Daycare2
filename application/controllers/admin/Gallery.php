<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/gallery_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $data['listCategory'] = $this->gallery_m->select_category()->result();
            $this->template->display('admin/master/gallery_view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->gallery_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row        = array();
            $gallery_id = $r->gallery_id;
            $linkDetail = site_url('admin/gallery/listdetail/'.$gallery_id);
            $row[]      = ' <button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $gallery_id . "'" . ')"><i class="fa fa-edit"></i></button>
                        <a href="' . $linkDetail . '">
                        <button type="button" class="btn btn-warning btn-xs" title="Detail Galeri"><i class="fa fa-list"></i></button></a>
                        <a onclick="hapusData(' . $gallery_id . ')"><button class="btn btn-danger btn-xs" type="button" title="Delete Data"><i class="fa fa-times-circle"></i></button>';

            $row[] = $no;
            $row[] = date('d-m-Y', strtotime($r->gallery_post));
            $row[] = $r->gallery_name;
            $row[] = $r->category_gallery_name;
            $row[] = '<img src=' . base_url('img/gallery_folder/' . $r->gallery_image) . ' width="50%">';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->gallery_m->count_all(),
            "recordsFiltered" => $this->gallery_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $jam = time();

        $config['file_name']     = 'Gallery_' . $jam . '.jpg';
        $config['upload_path']   = './img/gallery_folder/';
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
        $configThumb['width']          = 800;
        $configThumb['height']         = 600;
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
            $this->gallery_m->insert_data();
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }

    public function get_data($id)
    {
        $data = $this->gallery_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam                     = time();
            $config['file_name']     = 'Gallery_' . $jam . '.jpg';
            $config['upload_path']   = './img/gallery_folder/';
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
            $configThumb['width']          = 800;
            $configThumb['height']         = 600;
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

                $this->gallery_m->update_data();
                $response['status'] = 'success';
            }
        } else {
            $this->gallery_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->gallery_m->delete_data($id);
        echo json_encode(array("status" => true));
    }

    public function listdetail($id)
    {
        $data['detail'] = $this->gallery_m->select_by_id($id)->row();
        $this->template->display('admin/master/gallery_detail_view', $data);
    }

    public function data_list_detail()
    {
        $List = $this->gallery_m->get_datatables_detail();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row        = array();
            $detail_id  = $r->detail_id;
            $row[]      = ' <a onclick="hapusData(' . $detail_id . ')">
                            <button class="btn btn-danger btn-xs" type="button" title="Delete Data"><i class="fa fa-times-circle"></i>
                            </button>
                            </a>';

            $row[] = $no;
            $row[] = '<img src=' . base_url('img/gallery_folder/' . $r->detail_image) . ' width="50%">';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->gallery_m->count_all_detail(),
            "recordsFiltered" => $this->gallery_m->count_filtered_detail(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedatadetail()
    {
        $jam = time();

        $config['file_name']     = 'Gallery_Detail_' . $jam . '.jpg';
        $config['upload_path']   = './img/gallery_folder/';
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
        $configThumb['width']          = 800;
        $configThumb['height']         = 600;
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
            $this->gallery_m->insert_data_detail();
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }

    public function deletedatadetail($id)
    {
        $this->gallery_m->delete_data_detail($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Gallery.php */
