<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_category_m extends CI_Model
{
    public $table         = 'alifa_promo_category';
    public $column_order  = array(null, null, 'promo_category_name');
    public $column_search = array('promo_category_name');
    public $order         = array('promo_category_name' => 'asc');

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
            'promo_category_name'   => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'promo_category_seo'    => seo_title($this->input->post('name', 'true')),
            'promo_category_update' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_promo_category', $data);
    }

    function select_by_id($id) {
        $this->db->select('*');
        $this->db->from('alifa_promo_category');
        $this->db->where('promo_category_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $promo_category_id = $this->input->post('id', 'true');

        $data = array(
            'promo_category_name'   => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'promo_category_seo'    => seo_title($this->input->post('name', 'true')),
            'promo_category_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('promo_category_id', $promo_category_id);
        $this->db->update('alifa_promo_category', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('promo_category_id', $id);
        $this->db->delete('alifa_promo_category');
    }
}
/* Location: ./application/models/admin/Promo_category_m.php */
