<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Artikel_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function select_article($limit = 10, $offset = 0) {
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

    function count_all() {
        $this->db->select('*');
        $this->db->from('alifa_article');
        $this->db->where('YEAR(article_post)', date('Y'));

        return $this->db->count_all_results();
    }

    function count_all_category($category_id) {
        $this->db->select('*');
        $this->db->from('alifa_article');
        $this->db->where('YEAR(article_post)', date('Y'));
        $this->db->where('category_id', $category_id);

        return $this->db->count_all_results();
    }

    public function select_detail($article_id)
    {
        $this->db->select('a.*, c.category_name, c.category_seo, u.user_name');
        $this->db->from('alifa_article a');
        $this->db->join('alifa_category c', 'a.category_id = c.category_id');
        $this->db->join('alifa_users u', 'a.user_username = u.user_username');
        $this->db->where('a.article_id', $article_id);

        return $this->db->get();
    }

    public function select_category_detail($category_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_category');
        $this->db->where('category_id', $category_id);

        return $this->db->get();
    }

    function select_article_by_category($category_id, $limit = 5, $offset = 0) {
        $this->db->select('a.*, c.category_name, c.category_seo, u.user_name');
        $this->db->from('alifa_article a');
        $this->db->join('alifa_category c', 'a.category_id = c.category_id');
        $this->db->join('alifa_users u', 'a.user_username = u.user_username');
        $this->db->where('YEAR(a.article_post)', date('Y'));
        $this->db->where('a.category_id', $category_id);
        $this->db->order_by('a.article_id', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);

        return $this->db->get();
    }

    function update_view($article_id) {
        $this->db->select('article_read');
        $this->db->from('alifa_article');
        $this->db->where('article_id', $article_id);
        $read = $this->db->get()->row();

        $data = array(
                'article_read'  => ($read->article_read+1),
            );

        $this->db->where('article_id', $article_id);
        $this->db->update('alifa_article', $data);
    }
}
/* Location: ./application/model/Home_m.php */
