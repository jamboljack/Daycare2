<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/student_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $data['listPaket']  = $this->student_m->select_paket()->result();
            $data['listOffice'] = $this->student_m->select_office()->result();
            $data['listTahun']  = $this->student_m->select_tahun()->result();
            $this->template->display('admin/student/view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->student_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row        = array();
            $student_id = $r->student_id;

            $link  = site_url('admin/student/editdata/' . $r->student_id);
            $row[] = '  <a href="' . $link . '"><button class="btn btn-primary btn-xs" title="Detail Data">
                        <i class="fa fa-edit"></i></button>
                        </a>
                        <a onclick="hapusData(' . $student_id . ')">
                        <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                        <i class="fa fa-times-circle"></i>
                        </button>';

            $row[] = $no;
            $row[] = date('d-m-Y', strtotime($r->student_date_register));
            $row[] = $r->student_name;
            $row[] = $r->student_gender;
            $row[] = $r->paket_name;
            $row[] = $r->office_name;
            $row[] = $r->year_name;

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->student_m->count_all(),
            "recordsFiltered" => $this->student_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function select_kabupaten_change()
    {
        $data['listKabupaten'] = $this->student_m->select_kabupaten_by_id($this->uri->segment(4));
        $this->load->view('admin/student/drop_down_kabupaten_view', $data);
    }

    public function select_kecamatan_change()
    {
        $data['listKecamatan'] = $this->student_m->select_kecamatan_by_id($this->uri->segment(4));
        $this->load->view('admin/student/drop_down_kecamatan_view', $data);
    }

    public function select_desa_change()
    {
        $data['listDesa'] = $this->student_m->select_desa_by_id($this->uri->segment(4));
        $this->load->view('admin/student/drop_down_desa_view', $data);
    }

    public function editdata($student_id)
    {
        $data['listPaket']     = $this->student_m->select_paket()->result();
        $data['listOffice']    = $this->student_m->select_office()->result();
        $data['listTahun']     = $this->student_m->select_tahun()->result();
        $data['listProvinsi']  = $this->student_m->select_provinsi()->result();
        $data['listKabupaten'] = $this->student_m->select_kabupaten_edit($student_id)->result();
        $data['listKecamatan'] = $this->student_m->select_kecamatan_edit($student_id)->result();
        $data['listDesa']      = $this->student_m->select_desa_edit($student_id)->result();
        $data['detail']        = $this->student_m->select_by_id($student_id)->row();
        $this->template->display('admin/student/edit', $data);
    }

    public function updatedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam  = time();
            $name = seo_title(stripHTMLtags($this->input->post('name', 'true')));
            $config['file_name']     = 'Student_' . $name . '_' . $jam . '.jpg';
            $config['upload_path']   = './img/student_folder/';
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

                $this->student_m->update_data();
                $response['status'] = 'success';
            }
        } else {
            $this->student_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->student_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Student.php */
