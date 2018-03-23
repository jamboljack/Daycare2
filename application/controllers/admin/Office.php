<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Office extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level') == 'Admin' && !$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/office_m');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Admin' && $this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/office/view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->office_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row       = array();
            $office_id = $r->office_id;

            $link  = site_url('admin/office/editdata/' . $office_id);
            $row[] = '<a href="' . $link . '"><button class="btn btn-primary btn-xs" title="Edit Data"><i class="fa fa-edit"></i></button></a>
                        <a onclick="hapusData(' . $office_id . ')"><button class="btn btn-danger btn-xs" type="button" title="Delete Data"><i class="fa fa-times-circle"></i></button>';

            $row[] = $no;
            $row[] = $r->office_name;
            $row[] = $r->office_address;
            $row[] = $r->branch_name;
            $row[] = $r->office_status;

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->office_m->count_all(),
            "recordsFiltered" => $this->office_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function adddata()
    {
        $data['listBranch'] = $this->office_m->select_branch()->result();
        $this->template->display('admin/office/add', $data);
    }

    public function savedata()
    {
        $this->office_m->insert_data();
    }

    public function editdata($office_id)
    {
        $data['listBranch'] = $this->office_m->select_branch()->result();
        $data['detail']     = $this->office_m->select_by_id($office_id)->row();
        $this->template->display('admin/office/edit', $data);
    }

    public function updatedata()
    {
        $this->office_m->update_data();
    }

    public function deletedata($id)
    {
        $this->office_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Office.php */
