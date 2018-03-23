<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/category_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/master/category_view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->category_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row         = array();
            $category_id = $r->category_id;

            $row[] = '	<button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $category_id . "'" . ')">
            			<i class="fa fa-edit"></i>
            			</button>
            			<a onclick="hapusData(' . $category_id . ')">
            			<button class="btn btn-danger btn-xs" type="button" title="Delete Data">
            			<i class="fa fa-times-circle"></i>
            			</button>
            			</a>';

            $row[]     = $no;
            $row[]     = $r->category_no;
            $row[]     = $r->category_name;
            $btnUp     = site_url('admin/category/atas/' . $r->category_id . '/' . $r->category_no);
            $btnBottom = site_url('admin/category/bawah/' . $r->category_id . '/' . $r->category_no);

            if ($no == 1) {
                $row[] = '<a href="' . $btnBottom . '" title="Order ke Bawah"><i class="fa fa-arrow-down"></i></a>';
            } else {
                $row[] = '<a href="' . $btnUp . '" title="Order ke Atas"><i class="fa fa-arrow-up"></i></a>
            			<a href="' . $btnBottom . '" title="Order ke Bawah"><i class="fa fa-arrow-down"></i></a>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->category_m->count_all(),
            "recordsFiltered" => $this->category_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->category_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->category_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        
        $this->category_m->update_data();
    }

    public function deletedata($id)
    {
        $this->category_m->delete_data($id);
        echo json_encode(array("status" => true));
    }

    public function atas()
    {
        $id          = $this->uri->segment(4);
        $posisi      = $this->uri->segment(5);
        $posisi_baru = ($posisi - 1);
        $this->category_m->atas($id, $posisi, $posisi_baru);
        redirect(site_url('admin/category'));
    }

    public function bawah()
    {
        $id          = $this->uri->segment(4);
        $posisi      = $this->uri->segment(5);
        $posisi_baru = ($posisi + 1);
        $this->category_m->bawah($id, $posisi, $posisi_baru);
        redirect(site_url('admin/category'));
    }
}
/* Location: ./application/controller/admin/Category.php */
