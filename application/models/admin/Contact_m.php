<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_contact($contact_id = 1)
    {
        $this->db->select('*');
        $this->db->from('alifa_contact');
        $this->db->where('contact_id', $contact_id);

        return $this->db->get();
    }

    public function update_data()
    {
        $contact_id = 1;

        $data = array(
            'contact_name'    => stripHTMLtags($this->input->post('name', 'true')),
            'contact_address' => stripHTMLtags($this->input->post('address', 'true')),
            'contact_phone'   => stripHTMLtags($this->input->post('phone', 'true')),
            'contact_mobile'  => stripHTMLtags($this->input->post('mobile', 'true')),
            'contact_email'   => stripHTMLtags($this->input->post('email', 'true')),
            'contact_web'     => stripHTMLtags($this->input->post('web', 'true')),
            'contact_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->where('contact_id', $contact_id);
        $this->db->update('alifa_contact', $data);
    }
}
/* Location: ./application/models/admin/Contact_m.php */
