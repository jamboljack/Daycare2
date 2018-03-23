<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('produk_m');
    }

    public function index()
    {
        redirect(site_url('my_error'));
    }

    public function id($menu_id)
    {
        $menu_id = decrypt($menu_id);
        $check = $this->produk_m->select_detail($menu_id)->row();
        if (count($check) == 0) {
            redirect(site_url('my_error'));
        } else {
            $data['detail'] = $this->produk_m->select_detail($menu_id)->row();
            $this->template_front->display('produk_view', $data);
        }
    }
}
/* Location: ./application/controller/Produk.php */
