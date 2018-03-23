<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kontak_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_branch()
    {
        $this->db->select('*');
        $this->db->from('alifa_branch');
        $this->db->order_by('branch_id', 'asc');

        return $this->db->get();
    }

    public function select_list($branch_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_office');
        $this->db->where('branch_id', $branch_id);
        $this->db->order_by('office_id', 'asc');

        return $this->db->get();
    }

    public function select_office()
    {
        $this->db->select('*');
        $this->db->from('alifa_office');
        $this->db->order_by('office_id', 'asc');

        return $this->db->get();
    }

    public function insert_data()
    {
        $data = array(
            'message_name'    => ucwords(strtolower(stripHTMLtags($this->input->post('name', 'true')))),
            'message_email'   => trim(stripHTMLtags($this->input->post('email', 'true'))),
            'message_subject' => ucwords(strtolower(stripHTMLtags($this->input->post('subject', 'true')))),
            'message_phone'   => stripHTMLtags($this->input->post('phone', 'true')),
            'message_message' => trim(stripHTMLtags($this->input->post('message', 'true'))),
            'message_post'    => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_message', $data);
    }
}
/* Location: ./application/model/Kontak_m.php */
