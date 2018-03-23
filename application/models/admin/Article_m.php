<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article_m extends CI_Model
{
    public $table         = 'alifa_article';
    public $column_order  = array(null, null, 'a.article_post', 'a.user_username', 'c.category_name', 'a.article_title',
        'a.article_read', null);
    public $column_search = array('a.user_username', 'c.category_name', 'a.article_title');
    public $order         = array('a.article_id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    public function select_category()
    {
        $this->db->select('*');
        $this->db->from('alifa_category');
        $this->db->order_by('category_name', 'asc');

        return $this->db->get();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.*, c.category_name');
        $this->db->from('alifa_article a');
        $this->db->join('alifa_category c', 'a.category_id=c.category_id');

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
            'user_username'  => $this->session->userdata('username'),
            'category_id'    => $this->input->post('lstCategory', 'true'),
            'article_title'  => strtoupper(trim(stripHTMLtags($this->input->post('name', 'true')))),
            'article_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
            'article_desc'   => trim($this->input->post('desc', 'true')),
            'article_image'  => $this->upload->file_name,
            'article_post'   => date('Y-m-d H:i:s'),
            'article_update' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_article', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('alifa_article');
        $this->db->where('article_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $article_id = $this->input->post('id', 'true');

        if (!empty($_FILES['foto']['name'])) {
            $data = array(
                'user_username'  => $this->session->userdata('username'),
                'category_id'    => $this->input->post('lstCategory', 'true'),
                'article_title'  => strtoupper(trim(stripHTMLtags($this->input->post('name', 'true')))),
                'article_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
                'article_desc'   => trim($this->input->post('desc', 'true')),
                'article_image'  => $this->upload->file_name,
                'article_post'   => date('Y-m-d H:i:s'),
                'article_update' => date('Y-m-d H:i:s'),
            );
        } else {
            $data = array(
                'user_username'  => $this->session->userdata('username'),
                'category_id'    => $this->input->post('lstCategory', 'true'),
                'article_title'  => strtoupper(trim(stripHTMLtags($this->input->post('name', 'true')))),
                'article_seo'    => seo_title(stripHTMLtags($this->input->post('name', 'true'))),
                'article_desc'   => trim($this->input->post('desc', 'true')),
                'article_post'   => date('Y-m-d H:i:s'),
                'article_update' => date('Y-m-d H:i:s'),
            );
        }

        $this->db->where('article_id', $article_id);
        $this->db->update('alifa_article', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('article_id', $id);
        $this->db->delete('alifa_article');
    }
}
/* Location: ./application/models/admin/Article_m.php */
