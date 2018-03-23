<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Greeting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/greeting_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $data['detail'] = $this->greeting_m->select_detail()->row();
            $this->template->display('admin/master/greeting_view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function updatedata()
    {
        $this->greeting_m->update_data();
        $this->session->set_flashdata('notification', 'Update Data Sukses.');
        redirect(site_url('admin/greeting'));
    }

    public function uploadimage()
    {
        $image      = $_FILES['file']['name'];
        $dir_name   = "img/uploads/";
        $time       = time();
        $uploadfile = $dir_name.seo_title($image).'_'.$time.'_.jpg';
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            echo base_url().$uploadfile;
        } else {
            echo "Unable to Upload";
        }
    }
}

/* Location: ./application/controller/admin/Greeting.php */
