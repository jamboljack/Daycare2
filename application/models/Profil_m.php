<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profil_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_detail_profil()
    {
        $this->db->select('*');
        $this->db->from('alifa_menu');
        $this->db->where('menu_id', 1);

        return $this->db->get();
    }

    public function select_list_image()
    {
        $this->db->select('*');
        $this->db->from('alifa_img_about');
        $this->db->order_by('img_about_id', 'asc');

        return $this->db->get();
    }

    public function select_detail_visi()
    {
        $this->db->select('*');
        $this->db->from('alifa_menu');
        $this->db->where('menu_id', 2);

        return $this->db->get();
    }

    public function select_team()
    {
        $this->db->select('*');
        $this->db->from('alifa_team');
        $this->db->order_by('team_id', 'asc');

        return $this->db->get();
    }

    public function select_staff($team_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_employee');
        $this->db->where('team_id', $team_id);
        $this->db->order_by('employee_id', 'asc');

        return $this->db->get();
    }

    public function select_detail($menu_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_menu');
        $this->db->where('menu_id', $menu_id);

        return $this->db->get();
    }
}
/* Location: ./application/model/Profil_m.php */
