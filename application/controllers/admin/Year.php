<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Year extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/year_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/master/year_view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->year_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $year_id = $r->year_id;

            $row[] = '  <button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $year_id . "'" . ')">
                        <i class="fa fa-edit"></i>
                        </button>
                        <a onclick="hapusData(' . $year_id . ')">
                        <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                        <i class="fa fa-times-circle"></i>
                        </button>
                        </a>';

            $row[] = $no;
            $row[] = $r->year_name;
            if ($r->year_status == 0) {
                $row[] = '  <a onclick="aktifData(' . $year_id . ')">
                                <button class="btn btn-warning btn-xs" type="button" title="Aktifkan Data">
                                    <i class="fa fa-check-circle"></i> Aktifkan
                                </button>
                                </a>';
            } else {
                $row[] = '<span class="label label-success"><i class="fa fa-check-circle"></i> Aktif</span>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->year_m->count_all(),
            "recordsFiltered" => $this->year_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->year_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->year_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {

        $this->year_m->update_data();
    }

    public function deletedata($id)
    {
        $this->year_m->delete_data($id);
        echo json_encode(array("status" => true));
    }

    public function activate($id)
    {
        $this->year_m->activate_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Year.php */
