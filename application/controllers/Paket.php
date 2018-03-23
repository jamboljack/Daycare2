<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('paket_m');
    }

    public function index()
    {
        redirect(site_url('my_error'));
    }

    public function id($paket_id)
    {
        $paket_id = decrypt($paket_id);
        $check    = $this->paket_m->select_detail($paket_id)->row();
        if (count($check) == 0) {
            redirect(site_url('my_error'));
        } else {
            $data['detail']    = $this->paket_m->select_detail($paket_id)->row();
            $data['listPaket'] = $this->paket_m->select_paket()->result();
            $this->template_front->display('paket_view', $data);
        }
    }
}
/* Location: ./application/controller/Paket.php */
