<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in_alifa')) {
            redirect(base_url());
        }

        $this->load->library('template');
        $this->load->model('admin/promo_m');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in_alifa')) {
            $data['listCategory'] = $this->promo_m->select_category()->result();
            $this->template->display('admin/master/promo_view', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function data_list()
    {
        $List = $this->promo_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row       = array();
            $promo_id = $r->promo_id;

            $row[] = '	<button type="button" class="btn btn-primary btn-xs" title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $promo_id . "'" . ')">
                        <i class="fa fa-edit"></i>
                        </button>
            			<a onclick="hapusData(' . $promo_id . ')">
                            <button class="btn btn-danger btn-xs" type="button" title="Delete Data">
                            <i class="fa fa-times-circle"></i>
                            </button>
                        </a>';

            $row[] = $no;
            $row[] = date('d-m-Y' ,strtotime($r->promo_post));
            $row[] = $r->promo_name;
            $row[] = $r->promo_category_name;
            $row[] = '<img src=' . base_url('img/promo_folder/' . $r->promo_image) . ' width="50%">';

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->promo_m->count_all(),
            "recordsFiltered" => $this->promo_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $jam = time();

        $config['file_name']     = 'Promo_' . $jam . '.jpg';
        $config['upload_path']   = './img/promo_folder/';
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
        $configThumb['width']          = 900;
        $configThumb['height']         = 700;
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
            $this->promo_m->insert_data();
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }

    public function get_data($id)
    {
        $data = $this->promo_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam = time();
            $config['file_name']     = 'Promo_' . $jam . '.jpg';
            $config['upload_path']   = './img/promo_folder/';
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
            $configThumb['width']          = 900;
            $configThumb['height']         = 700;
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

                $this->promo_m->update_data();
                $response['status'] = 'success';
            }
        } else {
            $this->promo_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->promo_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Promo.php */
