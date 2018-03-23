<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }
        $this->load->library('template');
        $this->load->model('admin/profil_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $username       = $this->session->userdata('username');
            $data['detail'] = $this->profil_m->select_detail($username)->row();
            $this->template->display('admin/profil_view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function updatedataprofil()
    {
        $this->profil_m->update_data_profil();
    }

    public function updateavatar()
    {
        $jam      = time();
        $username = $this->session->userdata('username');

        $config['file_name']     = 'Avatar_' . $username . '_' . $jam . '.jpg';
        $config['upload_path']   = './img/icon/';
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
        $configThumb['height']         = 150;
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

            $this->profil_m->update_avatar();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    private function password_exists($oldpassword)
    {
        $this->db->where('user_password', $oldpassword);
        $query = $this->db->get('alifa_users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_old_password()
    {
        if (array_key_exists('oldpassword', $_POST)) {
            if ($this->password_exists(sha1($this->input->post('oldpassword', 'true'))) == true) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        }
    }

    public function updatepassword()
    {
        $this->profil_m->update_password();
    }

}
/* Location: ./application/controller/Profil.php */
