<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Register_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_paket()
    {
        $this->db->select('*');
        $this->db->from('alifa_paket');
        $this->db->order_by('paket_id', 'asc');

        return $this->db->get();
    }

    public function select_office()
    {
        $this->db->select('*');
        $this->db->from('alifa_office');
        $this->db->order_by('office_id', 'asc');

        return $this->db->get();
    }

    public function select_tahun()
    {
        $this->db->select('*');
        $this->db->from('alifa_year');
        $this->db->where('year_status', 1);

        return $this->db->get();
    }

    public function select_province()
    {
        $this->db->select('*');
        $this->db->from('alifa_provinsi');
        $this->db->order_by('provinsi_id', 'asc');

        return $this->db->get();
    }

    public function select_kabupaten_by_id($provinsi_id)
    {
        $this->db->where('provinsi_id', $provinsi_id);
        $this->db->order_by('kabupaten_nama', 'asc');
        $sql_kabupaten = $this->db->get('alifa_kabupaten');
        if ($sql_kabupaten->num_rows() > 0) {
            foreach ($sql_kabupaten->result_array() as $row) {
                $result['']                   = '- PILIH KABUPATEN -';
                $result[$row['kabupaten_id']] = strtoupper(trim($row['kabupaten_nama']));
            }
        } else {
            $result[''] = '- BELUM ADA KABUPATEN -';
        }
        return $result;
    }

    public function select_kecamatan_by_id($kabupaten_id)
    {
        $this->db->where('kabupaten_id', $kabupaten_id);
        $this->db->order_by('kecamatan_nama', 'asc');
        $sql_kecamatan = $this->db->get('alifa_kecamatan');
        if ($sql_kecamatan->num_rows() > 0) {
            foreach ($sql_kecamatan->result_array() as $row) {
                $result['']                   = '- PILIH KECAMATAN -';
                $result[$row['kecamatan_id']] = strtoupper(trim($row['kecamatan_nama']));
            }
        } else {
            $result[''] = '- BELUM ADA KECAMATAN -';
        }
        return $result;
    }

    public function select_desa_by_id($kecamatan_id)
    {
        $this->db->where('kecamatan_id', $kecamatan_id);
        $this->db->order_by('desa_nama', 'asc');
        $sql_kecamatan = $this->db->get('alifa_desa');
        if ($sql_kecamatan->num_rows() > 0) {
            foreach ($sql_kecamatan->result_array() as $row) {
                $result['']              = "- PILIH DESA -";
                $result[$row['desa_id']] = strtoupper(trim($row['desa_nama']));
            }
        } else {
            $result[''] = "- BELUM ADA DESA -";
        }
        return $result;
    }

    public function insert_data()
    {
        $data = array(
            'paket_id'              => $this->input->post('lstPaket', 'true'),
            'year_id'               => $this->input->post('year_id', 'true'),
            'office_id'             => $this->input->post('lstOffice', 'true'),
            'student_name'          => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'student_birth'         => strtoupper(stripHTMLtags($this->input->post('place', 'true'))),
            'student_date'          => date('Y-m-d', strtotime($this->input->post('date', 'true'))),
            'student_gender'        => $this->input->post('lstJK', 'true'),
            'student_agama'         => $this->input->post('lstAgama', 'true'),
            'provinsi_id'           => $this->input->post('lstProvinsi', 'true'),
            'kabupaten_id'          => $this->input->post('lstKabupaten', 'true'),
            'kecamatan_id'          => $this->input->post('lstKecamatan', 'true'),
            'desa_id'               => $this->input->post('lstDesa', 'true'),
            'student_address'       => strtoupper(stripHTMLtags($this->input->post('address', 'true'))),
            'student_phone'         => trim(stripHTMLtags($this->input->post('phone', 'true'))),
            'student_email'         => trim(stripHTMLtags($this->input->post('email', 'true'))),
            'student_parent'        => strtoupper(stripHTMLtags($this->input->post('ortu', 'true'))),
            'student_date_register' => date('Y-m-d H:i:s'),
            'student_update'        => date('Y-m-d H:i:s'),
        );

        $this->db->insert('alifa_student', $data);
    }
}
/* Location: ./application/model/Register_m.php */
