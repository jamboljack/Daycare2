<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/home_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $data['employee'] = $this->home_m->select_employee()->row();
            $data['student']  = $this->home_m->select_student()->row();
            $data['promo']    = $this->home_m->select_promo()->row();
            $data['article']  = $this->home_m->select_article()->row();
            $this->template->display('admin/home_view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
}
/* Location: ./application/controller/admin/Home.php */
