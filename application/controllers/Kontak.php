<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->library('googlemaps');
        $this->load->library('recaptcha');
        $this->load->model('kontak_m');
    }

    public function index()
    {
        // $config['center'] = '-6.5898, 110.6650'; // Center ke Kota Jepara
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);
        $listPeta = $this->kontak_m->select_office()->result();
        $no       = 1;
        foreach ($listPeta as $r) {
            $marker              = array();
            $marker['position']  = $r->office_lat . ',' . $r->office_long;
            $icon                = base_url('img/marker/red_marker.png');
            $marker['animation'] = 'DROP';
            $marker['title']     = ucwords(strtolower($r->office_name));
            $this->googlemaps->add_marker($marker);
        }

        $data['map']        = $this->googlemaps->create_map();
        $data['listBranch'] = $this->kontak_m->select_branch()->result();
        $this->template_front->display('kontak_view', $data);
    }

    public function send_data()
    {
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $rsp            = $this->recaptcha->verifyResponse($captcha_answer);
        
        if ($rsp['success']) {
            $this->kontak_m->insert_data();
            $response = [ 'status' => 'success', 'message' => 'Pesan Anda berhasil Terkirim.' ];
        } else {
            $response = [ 'status' => 'failed', 'message' => 'Pesan Anda gagal Terkirim.' ];
        }

        echo json_encode($response);
    }
}
/* Location: ./application/controller/Kontak.php */
