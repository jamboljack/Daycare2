<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Galeri_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_category()
    {
        $this->db->select('*');
        $this->db->from('alifa_category_gallery');
        $this->db->order_by('category_gallery_name', 'asc');

        return $this->db->get();
    }

    public function select_galery()
    {
        $this->db->select('g.*, c.category_gallery_seo');
        $this->db->from('alifa_gallery g');
        $this->db->join('alifa_category_gallery c', 'g.category_gallery_id=c.category_gallery_id');
        $this->db->order_by('g.gallery_id', 'desc');

        return $this->db->get();
    }

    public function select_detail($gallery_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_gallery');
        $this->db->where('gallery_id', $gallery_id);

        return $this->db->get();
    }

    public function select_galery_detail($gallery_id)
    {
        $this->db->select('*');
        $this->db->from('alifa_gallery_detail');
        $this->db->where('gallery_id', $gallery_id);
        $this->db->order_by('detail_id', 'asc');

        return $this->db->get();
    }

    public function select_jumlah($gallery_id)
    {
        $this->db->select('COUNT(gallery_id) as jumlah');
        $this->db->from('alifa_gallery_detail');
        $this->db->where('gallery_id', $gallery_id);

        return $this->db->get();
    }
}
/* Location: ./application/model/Galeri_m.php */
