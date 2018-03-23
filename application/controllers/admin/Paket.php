<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/paket_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/paket/view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->paket_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $paket_id = $r->paket_id;

            $link  = site_url('admin/paket/editdata/' . $r->paket_id);
            $row[] = '<a href="' . $link . '"><button class="btn btn-primary btn-xs" title="Edit Data"><i class="fa fa-edit"></i></button></a>
                        <a onclick="hapusData(' . $paket_id . ')"><button class="btn btn-danger btn-xs" type="button" title="Delete Data"><i class="fa fa-times-circle"></i></button>';

            $row[] = $no;
            $row[] = $r->paket_name;
            $row[] = $r->paket_schedule;

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->paket_m->count_all(),
            "recordsFiltered" => $this->paket_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function adddata()
    {
        $this->template->display('admin/paket/add');
    }

    public function savedata()
    {
        $this->paket_m->insert_data();
    }

    public function editdata($paket_id)
    {
        $data['detail']       = $this->paket_m->select_by_id($paket_id)->row();
        $this->template->display('admin/paket/edit', $data);
    }

    public function updatedata()
    {
        $this->paket_m->update_data();
    }

    public function deletedata($id)
    {
        $this->paket_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Paket.php */
