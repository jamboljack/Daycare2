<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Greeting_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_detail($menu_id = 4)
    {
        $this->db->select('*');
        $this->db->from('alifa_menu');
        $this->db->where('menu_id', $menu_id);

        return $this->db->get();
    }

    public function update_data()
    {
        $menu_id = 4;

        $data = array(
            'menu_desc'   => $this->input->post('desc'),
            'menu_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('menu_id', $menu_id);
        $this->db->update('alifa_menu', $data);
    }
}
/* Location: ./application/models/admin/Greeting_m.php */
