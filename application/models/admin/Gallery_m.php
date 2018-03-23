<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery_m extends CI_Model
{
    public $table         = 'alifa_gallery';
    public $column_order  = array(null, null, 'g.gallery_post', 'g.gallery_name', 'c.category_gallery_name', null);
    public $column_search = array('g.gallery_name', 'c.category_gallery_name');
    public $order         = array('g.gallery_id' => 'desc');

    public $table2         = 'alifa_gallery_detail';
    public $column_order2  = array(null, null, null);
    public $column_search2 = array();
    public $order2         = array('gallery_id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('g.*, c.category_gallery_name');
        $this->db->from('alifa_gallery g');
        $this->db->join('alifa_category_gallery c', 'g.category_gallery_id=c.category_gallery_id');

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
        $this->db->from('alifa_category_gallery');
        $this->db->order_by('category_gallery_name', 'asc');

        return $this->db->get();
    }

    public function insert_data()
    {
        $data = array(
            'user_username'       => $this->session->userdata('username'),
            'category_gallery_id' => $this->input->post('lstCategory', 'true'),
            'gallery_name'        => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'gallery_seo'         => seo_title($this->input->post('name', 'true')),
            'gallery_image'       => $this->upload->file_name,
            'gallery_post'        => date('Y-m-d H:i:s'),
            'gallery_update'      => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_gallery', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('alifa_gallery');
        $this->db->where('gallery_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $gallery_id = $this->input->post('id', 'true');
        if (!empty($_FILES['foto']['name'])) {
            $data = array(
                'user_username'       => $this->session->userdata('username'),
                'category_gallery_id' => $this->input->post('lstCategory', 'true'),
                'gallery_name'        => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
                'gallery_image'       => $this->upload->file_name,
                'gallery_update'      => date('Y-m-d H:i:s'),
            );
        } else {
            $data = array(
                'user_username'       => $this->session->userdata('username'),
                'category_gallery_id' => $this->input->post('lstCategory', 'true'),
                'gallery_name'        => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
                'gallery_update'      => date('Y-m-d H:i:s'),
            );
        }

        $this->db->where('gallery_id', $gallery_id);
        $this->db->update('alifa_gallery', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('gallery_id', $id);
        $this->db->delete('alifa_gallery');
    }

    private function _get_datatables_detail_query()
    {
        $gallery_id = $this->uri->segment(4);
        $this->db->from($this->table2);
        $this->db->where('gallery_id', $gallery_id);

        $i = 0;
        foreach ($this->column_search2 as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search2) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables_detail()
    {
        $this->_get_datatables_detail_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_detail()
    {
        $this->_get_datatables_detail_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_detail()
    {
        $gallery_id = $this->uri->segment(4);
        $this->db->from($this->table2);
        $this->db->where('gallery_id', $gallery_id);

        return $this->db->count_all_results();
    }

    public function insert_data_detail()
    {
        $data = array(
            'gallery_id'     => $this->input->post('gallery_id', 'true'),
            'detail_image'   => $this->upload->file_name,
            'detail_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_gallery_detail', $data);
    }

    public function delete_data_detail($id)
    {
        $this->db->where('detail_id', $id);
        $this->db->delete('alifa_gallery_detail');
    }
}
/* Location: ./application/models/admin/Gallery_m.php */
