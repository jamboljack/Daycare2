<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Office_m extends CI_Model
{
    public $table         = 'alifa_office';
    public $column_order  = array(null, null, 'o.office_name', 'o.office_address', 'b.branch_name', 'o.office_status');
    public $column_search = array('o.office_name', 'o.office_address', 'b.branch_name', 'o.office_status');
    public $order         = array('o.office_name' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('o.*, b.branch_name');
        $this->db->from('alifa_office o');
        $this->db->join('alifa_branch b', 'o.branch_id = b.branch_id');

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function select_branch()
    {
        $this->db->select('*');
        $this->db->from('alifa_branch');
        $this->db->order_by('branch_name', 'asc');

        return $this->db->get();
    }

    public function insert_data()
    {
        $data = array(
            'office_name'    => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'branch_id'      => $this->input->post('lstBranch', 'true'),
            'office_address' => $this->input->post('address', 'true'),
            'office_phone'   => trim(stripHTMLtags($this->input->post('telp', 'true'))),
            'office_mobile'  => trim(stripHTMLtags($this->input->post('handphone', 'true'))),
            'office_email'   => trim(stripHTMLtags($this->input->post('email', 'true'))),
            'office_status'  => strtoupper(stripHTMLtags($this->input->post('status', 'true'))),
            'office_lat'     => trim(stripHTMLtags($this->input->post('lat', 'true'))),
            'office_long'    => trim(stripHTMLtags($this->input->post('long', 'true'))),
            'office_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_office', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('alifa_office');
        $this->db->where('office_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $office_id = $this->input->post('id', 'true');

        $data = array(
            'office_name'    => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'branch_id'      => $this->input->post('lstBranch', 'true'),
            'office_address' => $this->input->post('address', 'true'),
            'office_phone'   => trim(stripHTMLtags($this->input->post('telp', 'true'))),
            'office_mobile'  => trim(stripHTMLtags($this->input->post('handphone', 'true'))),
            'office_email'   => trim(stripHTMLtags($this->input->post('email', 'true'))),
            'office_status'  => strtoupper(stripHTMLtags($this->input->post('status', 'true'))),
            'office_lat'     => trim(stripHTMLtags($this->input->post('lat', 'true'))),
            'office_long'    => trim(stripHTMLtags($this->input->post('long', 'true'))),
            'office_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->where('office_id', $office_id);
        $this->db->update('alifa_office', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('office_id', $id);
        $this->db->delete('alifa_office');
    }
}
/* Location: ./application/models/admin/Office_m.php */
