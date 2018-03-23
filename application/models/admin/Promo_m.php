<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_m extends CI_Model
{
    public $table         = 'alifa_promo';
    public $column_order  = array(null, null, 'p.promo_post', 'p.promo_name', 'c.promo_category_name', null);
    public $column_search = array('p.promo_post', 'p.promo_name', 'c.promo_category_name');
    public $order         = array('p.promo_post' => 'desc', 'p.promo_category_id' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('p.*, c.promo_category_name');
        $this->db->from('alifa_promo p');
        $this->db->join('alifa_promo_category c', 'p.promo_category_id=c.promo_category_id');

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

    public function select_category()
    {
        $this->db->select('*');
        $this->db->from('alifa_promo_category');
        $this->db->order_by('promo_category_name', 'asc');

        return $this->db->get();
    }

    public function insert_data()
    {
        $data = array(
            'user_username'     => $this->session->userdata('username'),
            'promo_category_id' => $this->input->post('lstCategory', 'true'),
            'promo_name'        => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'promo_image'       => $this->upload->file_name,
            'promo_post'        => date('Y-m-d H:i:s'),
            'promo_update'      => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_promo', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('alifa_promo');
        $this->db->where('promo_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $promo_id = $this->input->post('id', 'true');
        if (!empty($_FILES['foto']['name'])) {
            $data = array(
                'user_username' => $this->session->userdata('username'),
                'promo_category_id' => $this->input->post('lstCategory', 'true'),
                'promo_name'    => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
                'promo_image'   => $this->upload->file_name,
                'promo_update'  => date('Y-m-d H:i:s'),
            );
        } else {
            $data = array(
                'user_username' => $this->session->userdata('username'),
                'promo_category_id' => $this->input->post('lstCategory', 'true'),
                'promo_name'    => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
                'promo_update'  => date('Y-m-d H:i:s'),
            );
        }

        $this->db->where('promo_id', $promo_id);
        $this->db->update('alifa_promo', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('promo_id', $id);
        $this->db->delete('alifa_promo');
    }
}
/* Location: ./application/models/admin/Promo_m.php */
