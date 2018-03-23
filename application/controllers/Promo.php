<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('promo_m');
    }

    public function index()
    {
        $data['listCategory'] = $this->promo_m->select_category()->result();
        $data['listPromo']    = $this->promo_m->select_promo()->result();
        $this->template_front->display('promo_view', $data);
    }
}
/* Location: ./application/controller/Promo.php */
