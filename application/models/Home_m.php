<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_slider()
    {
        $this->db->select('*');
        $this->db->from('alifa_slider');
        $this->db->order_by('slider_id', 'asc');

        return $this->db->get();
    }

    public function select_article($limit = 6, $offset = 0)
    {
        $this->db->select('a.*, c.category_name, c.category_seo, u.user_name');
        $this->db->from('alifa_article a');
        $this->db->join('alifa_category c', 'a.category_id = c.category_id');
        $this->db->join('alifa_users u', 'a.user_username = u.user_username');
        $this->db->where('YEAR(a.article_post)', date('Y'));
        $this->db->order_by('a.article_id', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);

        return $this->db->get();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->from('alifa_article');
        $this->db->where('YEAR(article_post)', date('Y'));

        return $this->db->count_all_results();
    }
}
/* Location: ./application/model/Home_m.php */
