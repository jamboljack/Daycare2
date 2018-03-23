<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_m extends CI_Model
{
    public $table         = 'alifa_category';
    public $column_order  = array(null, null, 'category_no', 'category_name', null);
    public $column_search = array('category_name');
    public $order         = array('category_no' => 'asc');

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
            'category_name'   => strtoupper($this->input->post('name', 'true')),
            'category_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
            'category_update' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_category', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('alifa_category');
        $this->db->where('category_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $category_id = $this->input->post('id', 'true');
        $data = array(
            'category_name'   => strtoupper($this->input->post('name', 'true')),
            'category_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
            'category_update' => date('Y-m-d H:i:s'),
        );
        $this->db->where('category_id', $category_id);
        $this->db->update('alifa_category', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('alifa_category');
    }

    public function atas($id, $posisi, $posisi_baru)
    {
        $this->db->query("UPDATE alifa_category SET category_no='$posisi' WHERE category_no = '$posisi_baru'");
        $this->db->query("UPDATE alifa_category SET category_no='$posisi_baru' WHERE category_id='$id'");
    }

    public function bawah($id, $posisi, $posisi_baru)
    {
        $this->db->query("UPDATE alifa_category SET category_no='$posisi' WHERE category_no='$posisi_baru'");
        $this->db->query("UPDATE alifa_category SET category_no='$posisi_baru' WHERE category_id='$id'");
    }
}
/* Location: ./application/models/admin/Category_m.php */
