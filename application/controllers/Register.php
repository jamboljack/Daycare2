<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->library('recaptcha');
        $this->load->model('register_m');
    }

    public function index()
    {
        $data['listPaket']    = $this->register_m->select_paket()->result();
        $data['listOffice']   = $this->register_m->select_office()->result();
        $data['tahun']        = $this->register_m->select_tahun()->row();
        $data['listProvince'] = $this->register_m->select_province()->result();
        $this->template_front->display('register_view', $data);
    }

    public function select_kabupaten_change()
    {
        $data['listKabupaten'] = $this->register_m->select_kabupaten_by_id($this->uri->segment(3));
        $this->load->view('drop_down_kabupaten_view', $data);
    }

    public function select_kecamatan_change()
    {
        $data['listKecamatan'] = $this->register_m->select_kecamatan_by_id($this->uri->segment(3));
        $this->load->view('drop_down_kecamatan_view', $data);
    }

    public function select_desa_change()
    {
        $data['listDesa'] = $this->register_m->select_desa_by_id($this->uri->segment(3));
        $this->load->view('drop_down_desa_view', $data);
    }

    public function savedata()
    {
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $rsp            = $this->recaptcha->verifyResponse($captcha_answer);
        if ($rsp['success']) {
            $this->register_m->insert_data();
            $response = [ 'status' => 'success', 'message' => 'Pendaftaran Anda Berhasil.' ];
        } else {
            $response = [ 'status' => 'failed', 'message' => 'Pendaftaran Anda Gagal.' ];
        }

        echo json_encode($response);
    }
}
/* Location: ./application/controller/Register.php */
