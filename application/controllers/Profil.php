<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('profil_m');
    }

    public function index()
    {
        $data['detailprofil'] = $this->profil_m->select_detail_profil()->row();
        $data['listImage']    = $this->profil_m->select_list_image()->result();
        $data['listTeam']     = $this->profil_m->select_team()->result();
        $this->template_front->display('profil_view', $data);
    }

    public function id($menu_id)
    {
        $menu_id = decrypt($menu_id);
        $check = $this->profil_m->select_detail($menu_id)->row();
        if (count($check) == 0) {
            redirect(site_url('my_error'));
        } else {
            $data['detail'] = $this->profil_m->select_detail($menu_id)->row();
            $this->template_front->display('profil_detail_view', $data);
        }
    }
}
/* Location: ./application/controller/Profil.php */
