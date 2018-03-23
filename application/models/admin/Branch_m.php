<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Branch_m extends CI_Model
{
    public $table         = 'alifa_branch';
    public $column_order  = array(null, null, 'branch_name');
    public $column_search = array('branch_name');
    public $order         = array('branch_name' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

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

    public function insert_data()
    {
        $data = array(
            'branch_name'   => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'branch_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
            'branch_update' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_branch', $data);
    }

    function select_by_id($id) {
        $this->db->select('*');
        $this->db->from('alifa_branch');
        $this->db->where('branch_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $branch_id = $this->input->post('id', 'true');

        $data = array(
            'branch_name'   => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'branch_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
            'branch_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('branch_id', $branch_id);
        $this->db->update('alifa_branch', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('branch_id', $id);
        $this->db->delete('alifa_branch');
    }
}
/* Location: ./application/models/admin/Branch_m.php */
