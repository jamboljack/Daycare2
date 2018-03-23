<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Social extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level') == 'Admin' && !$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/social_m');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Admin' && $this->session->userdata('logged_in_alifa')) {
            $this->template->display('admin/master/social_view');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->social_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $social_id = $r->social_id;

            $row[] = '  <button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data('."'".$social_id."'".')">
                        <i class="fa fa-edit"></i>
                        </button>
                        <a onclick="hapusData('.$social_id.')">
                            <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                            <i class="fa fa-times-circle"></i>
                            </button>
                        </a>';

            $row[] = $no;
            $row[] = $r->social_name;
            $row[] = $r->social_class;
            $row[] = $r->social_url;
            
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->social_m->count_all(),
            "recordsFiltered" => $this->social_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->social_m->insert_data();
    }

    public function get_data($id) {
        $data   = $this->social_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $this->social_m->update_data();
    }

    public function deletedata($id)
    {
        $this->social_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Social.php */
