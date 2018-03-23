<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('home_m');
    }

    public function index($offset = 0)
    {
        $data['listSlider']       = $this->home_m->select_slider()->result();
        $config['uri_segment']    = 3;
        $config['base_url']       = site_url() . 'home/index';
        $config['total_rows']     = $this->home_m->count_all();
        $config['per_page']       = 6;
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
        $config["num_links"]      = round($config["total_rows"] / $config["per_page"]);
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();
        $data['listArticle'] = $this->home_m->select_article($config['per_page'], $offset)->result();

        $this->template_front->display('home_view', $data);
    }
}
/* Location: ./application/controller/Home.php */
