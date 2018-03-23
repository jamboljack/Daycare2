<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/promo_category_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/master/promo_category_view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->promo_category_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $promo_category_id = $r->promo_category_id;

            $row[] = '  <button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $promo_category_id . "'" . ')">
                        <i class="fa fa-edit"></i>
                        </button>
                        <a onclick="hapusData(' . $promo_category_id . ')">
                            <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                            <i class="fa fa-times-circle"></i>
                            </button>
                        </a>';

            $row[] = $no;
            $row[] = $r->promo_category_name;

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->promo_category_m->count_all(),
            "recordsFiltered" => $this->promo_category_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->promo_category_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->promo_category_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $this->promo_category_m->update_data();
    }

    public function deletedata($id)
    {
        $this->promo_category_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Promo_category.php */
