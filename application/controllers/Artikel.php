<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('artikel_m');
    }

    public function index($offset = 0)
    {
        // Content
        $config['uri_segment']    = 3;
        $config['base_url']       = site_url() . 'artikel/index';
        $config['total_rows']     = $this->artikel_m->count_all();
        $config['per_page']       = 10;
        $config['full_tag_open']  = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['prev_link']      = '<span class="fa fa-angle-double-left"></span> Prev';
        $config['prev_tag_open']  = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link']      = 'Next <span class="fa fa-angle-double-right"></span>';
        $config['next_tag_open']  = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open']   = '<li class="active-page">';
        $config['cur_tag_close']  = '</li>';
        $config['num_tag_open']   = '<li>';
        $config['num_tag_close']  = '</li>';
        $config["num_links"]      = round($config["total_rows"] / $config["per_page"]);
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();
        $data['listArticle'] = $this->artikel_m->select_article($config['per_page'], $offset)->result();

        $this->template_front->display('artikel_view', $data);
    }

    public function kategori($category_id, $offset = 0)
    {
        $category_id = decrypt($category_id);
        $check       = $this->artikel_m->select_category_detail($category_id)->row();
        if (count($check) == 0) {
            redirect(site_url('my_error'));
        } else {
            // Content
            $category_id           = $category_id;
            $offset                = $this->uri->segment(5);
            $config['uri_segment'] = 5;
            $config['base_url']    = site_url() . 'artikel/kategori/' . $category_id . '/' . $this->uri->segment(4);
            $config['total_rows']  = $this->artikel_m->count_all_category($category_id);
            $config['per_page']    = 5;
            // CSS Bootstrap
            $config['full_tag_open']  = '<ul class="page-navigation">';
            $config['full_tag_close'] = '</ul>';
            $config['prev_link']      = '<i class="fa fa-arrow-left"></i>';
            $config['prev_tag_open']  = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link']      = '<i class="fa fa-arrow-right"></i>';
            $config['next_tag_open']  = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open']   = '<li class="current-page"><a href="#">';
            $config['cur_tag_close']  = '</a></li>';
            $config['num_tag_open']   = '<li>';
            $config['num_tag_close']  = '</li>';
            // Akhir CSS

            $config["num_links"] = round($config["total_rows"] / $config["per_page"]);
            $this->pagination->initialize($config);
            $data['pages']       = $this->pagination->create_links();
            $data['listArticle'] = $this->artikel_m->select_article_by_category($category_id, $config['per_page'], $offset)->result();
            $data['detail']      = $this->artikel_m->select_category_detail($category_id)->row();

            $this->template_front->display('artikel_kategori_view', $data);
        }
    }

    public function id($article_id)
    {
        $article_id = decrypt($article_id);
        $check      = $this->artikel_m->select_detail($article_id)->row();
        if (count($check) == 0) {
            redirect(site_url('my_error'));
        } else {
            $this->artikel_m->update_view($article_id); // Update View
            $data['detail'] = $this->artikel_m->select_detail($article_id)->row();
            $this->template_front->display('artikel_detail_view', $data);
        }
    }
}
/* Location: ./application/controller/Artikel.php */
