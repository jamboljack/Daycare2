<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Promo_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_category()
    {
        $this->db->select('*');
        $this->db->from('alifa_promo_category');
        $this->db->order_by('promo_category_name', 'asc');

        return $this->db->get();
    }

    public function select_promo()
    {
        $this->db->select('p.*, c.promo_category_seo');
        $this->db->from('alifa_promo p');
        $this->db->join('alifa_promo_category c', 'p.promo_category_id=c.promo_category_id');
        $this->db->order_by('p.promo_id', 'desc');

        return $this->db->get();
    }
}
/* Location: ./application/model/Promo_m.php */
