<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level') == 'Admin' && !$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/employee_m');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Admin' && $this->session->userdata('logged_in_alifa')) {
            $data['listTeam'] = $this->employee_m->select_team()->result();
            $this->template->display('admin/master/employee_view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->employee_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row         = array();
            $employee_id = $r->employee_id;

            $row[] = '	<button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $employee_id . "'" . ')">
                        <i class="fa fa-edit"></i>
                        </button>
            			<a onclick="hapusData(' . $employee_id . ')">
                            <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                            <i class="fa fa-times-circle"></i>
                            </button>
                        </a>';

            $row[] = $no;
            $row[] = $r->employee_name;
            $row[] = $r->employee_position;
            $row[] = $r->team_name;

            if (!empty($r->employee_image)) {
                $gambar = base_url('img/employee_folder/' . $r->employee_image);
            } else {
                $gambar = base_url('img/no-image.jpg');
            }

            $row[] = '<img src=' . $gambar . ' width="30%">';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->employee_m->count_all(),
            "recordsFiltered" => $this->employee_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam  = time();
            $name = seo_title(stripHTMLtags($this->input->post('name', 'true')));

            $config['file_name']     = 'Employee_' . $name . '_' . $jam . '.jpg';
            $config['upload_path']   = './img/employee_folder/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 0;
            $this->load->library('upload');
            $this->upload->initialize($config);
            // Resize
            $configThumb                   = array();
            $configThumb['image_library']  = 'gd2';
            $configThumb['source_image']   = '';
            $configThumb['maintain_ratio'] = true;
            $configThumb['overwrite']      = true;
            $configThumb['width']          = 150;
            $configThumb['height']         = 200;
            $this->load->library('image_lib');

            if (!$this->upload->do_upload('foto')) {
                $response['status'] = 'error';
            } else {
                $upload                      = $this->upload->do_upload('foto');
                $upload_data                 = $this->upload->data();
                $name_array[]                = $upload_data['file_name'];
                $configThumb['source_image'] = $upload_data['full_path'];
                $this->image_lib->initialize($configThumb);
                $this->image_lib->resize();

                $this->employee_m->insert_data();
                $response['status'] = 'success';
            }
        } else {
            $this->employee_m->insert_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function get_data($id)
    {
        $data = $this->employee_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam  = time();
            $name = seo_title(stripHTMLtags($this->input->post('name', 'true')));

            $config['file_name']     = 'Employee_' . $name . '_' . $jam . '.jpg';
            $config['upload_path']   = './img/employee_folder/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 0;
            $this->load->library('upload');
            $this->upload->initialize($config);
            // Resize
            $configThumb                   = array();
            $configThumb['image_library']  = 'gd2';
            $configThumb['source_image']   = '';
            $configThumb['maintain_ratio'] = true;
            $configThumb['overwrite']      = true;
            $configThumb['width']          = 150;
            $configThumb['height']         = 200;
            $this->load->library('image_lib');

            if (!$this->upload->do_upload('foto')) {
                $response['status'] = 'error';
            } else {
                $upload                      = $this->upload->do_upload('foto');
                $upload_data                 = $this->upload->data();
                $name_array[]                = $upload_data['file_name'];
                $configThumb['source_image'] = $upload_data['full_path'];
                $this->image_lib->initialize($configThumb);
                $this->image_lib->resize();

                $this->employee_m->update_data();
                $response['status'] = 'success';
            }
        } else {
            $this->employee_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->employee_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Employee.php */
