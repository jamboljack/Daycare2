<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Img_about extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level') == 'Admin' && !$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/img_about_m');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Admin' && $this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/master/img_about_view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->img_about_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row       = array();
            $img_about_id = $r->img_about_id;

            $row[] = '	<button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $img_about_id . "'" . ')">
                        <i class="fa fa-edit"></i>
                        </button>
            			<a onclick="hapusData(' . $img_about_id . ')">
                            <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                            <i class="fa fa-times-circle"></i>
                            </button>
                        </a>';

            $row[] = $no;
            $row[] = '<img src=' . base_url('img/img_about_folder/' . $r->img_about_image) . ' width="50%">';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->img_about_m->count_all(),
            "recordsFiltered" => $this->img_about_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $jam = time();

        $config['file_name']     = 'Img_' . $jam . '.jpg';
        $config['upload_path']   = './img/img_about_folder/';
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
        $configThumb['width']          = 550;
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
            $this->img_about_m->insert_data();
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }

    public function get_data($id)
    {
        $data = $this->img_about_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $jam = time();
        $config['file_name']     = 'Img_' . $jam . '.jpg';
        $config['upload_path']   = './img/img_about_folder/';
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
        $configThumb['width']          = 550;
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

            $this->img_about_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->img_about_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Img_about.php */
