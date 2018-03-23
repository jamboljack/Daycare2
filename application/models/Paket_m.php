<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Paket_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_paket()
    {
        $this->db->select('*');
        $this->db->from('alifa_paket');
        $this->db->order_by('paket_id', 'asc');

        return $this->db->get();
    }

    public function select_detail($paket_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_paket');
        $this->db->where('paket_id', $paket_id);

        return $this->db->get();
    }
}
/* Location: ./application/model/Paket_m.php */
