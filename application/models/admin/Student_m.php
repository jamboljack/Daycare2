<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_m extends CI_Model
{
    public $table        = 'alifa_student';
    public $column_order = array(null, null, 's.student_date_register', 's.student_name', 's.student_gender', 'p.paket_name',
        'o.office_name', 'y.year_name');
    public $column_search = array('s.student_date_register', 's.student_name', 's.student_gender', 'p.paket_name',
        'o.office_name', 'y.year_name');
    public $order = array('s.student_date_register' => 'desc');

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
        $this->db->order_by('year_id', 'desc');

        return $this->db->get();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('lstPaket', 'true')) {
            $this->db->where('s.paket_id', $this->input->post('lstPaket', 'true'));
        }
        if ($this->input->post('lstOffice', 'true')) {
            $this->db->where('s.office_id', $this->input->post('lstOffice', 'true'));
        }
        if ($this->input->post('lstTahun', 'true')) {
            $this->db->where('s.year_id', $this->input->post('lstTahun', 'true'));
        }

        $this->db->select('s.*, p.paket_name, o.office_name, y.year_name');
        $this->db->from('alifa_student s');
        $this->db->join('alifa_paket p', 's.paket_id=p.paket_id');
        $this->db->join('alifa_office o', 's.office_id=o.office_id');
        $this->db->join('alifa_year y', 's.year_id=y.year_id');

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function select_provinsi()
    {
        $this->db->select('*');
        $this->db->from('alifa_provinsi');
        $this->db->order_by('provinsi_id', 'asc');

        return $this->db->get();
    }

    public function select_kabupaten_edit($student_id)
    {
        $this->db->select('k.*');
        $this->db->from('alifa_kabupaten k');
        $this->db->join('alifa_student s', 's.kabupaten_id = k.kabupaten_id');
        $this->db->where('s.student_id', $student_id);

        return $this->db->get();
    }

    public function select_kecamatan_edit($student_id)
    {
        $this->db->select('k.*');
        $this->db->from('alifa_kecamatan k');
        $this->db->join('alifa_student s', 's.kecamatan_id = k.kecamatan_id');
        $this->db->where('s.student_id', $student_id);

        return $this->db->get();
    }

    public function select_desa_edit($student_id)
    {
        $this->db->select('d.*');
        $this->db->from('alifa_desa d');
        $this->db->join('alifa_student s', 's.desa_id = d.desa_id');
        $this->db->where('s.student_id', $student_id);

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

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('alifa_student');
        $this->db->where('student_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $student_id = $this->input->post('id', 'true');

        if (!empty($_FILES['foto']['name'])) {
            $data = array(
                'paket_id'        => $this->input->post('lstPaket', 'true'),
                'year_id'         => $this->input->post('lstTahun', 'true'),
                'office_id'       => $this->input->post('lstOffice', 'true'),
                'student_name'    => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
                'student_birth'   => strtoupper(stripHTMLtags($this->input->post('place', 'true'))),
                'student_date'    => date('Y-m-d', strtotime($this->input->post('date', 'true'))),
                'student_gender'  => $this->input->post('lstJK', 'true'),
                'student_agama'   => $this->input->post('lstAgama', 'true'),
                'provinsi_id'     => $this->input->post('lstProvinsi', 'true'),
                'kabupaten_id'    => $this->input->post('lstKabupaten', 'true'),
                'kecamatan_id'    => $this->input->post('lstKecamatan', 'true'),
                'desa_id'         => $this->input->post('lstDesa', 'true'),
                'student_address' => strtoupper(stripHTMLtags($this->input->post('address', 'true'))),
                'student_phone'   => trim(stripHTMLtags($this->input->post('phone', 'true'))),
                'student_email'   => trim(stripHTMLtags($this->input->post('email', 'true'))),
                'student_parent'  => strtoupper(stripHTMLtags($this->input->post('ortu', 'true'))),
                'student_image'   => $this->upload->file_name,
                'student_update'  => date('Y-m-d H:i:s'),
            );
        } else {
            $data = array(
                'paket_id'        => $this->input->post('lstPaket', 'true'),
                'year_id'         => $this->input->post('lstTahun', 'true'),
                'office_id'       => $this->input->post('lstOffice', 'true'),
                'student_name'    => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
                'student_birth'   => strtoupper(stripHTMLtags($this->input->post('place', 'true'))),
                'student_date'    => date('Y-m-d', strtotime($this->input->post('date', 'true'))),
                'student_gender'  => $this->input->post('lstJK', 'true'),
                'student_agama'   => $this->input->post('lstAgama', 'true'),
                'provinsi_id'     => $this->input->post('lstProvinsi', 'true'),
                'kabupaten_id'    => $this->input->post('lstKabupaten', 'true'),
                'kecamatan_id'    => $this->input->post('lstKecamatan', 'true'),
                'desa_id'         => $this->input->post('lstDesa', 'true'),
                'student_address' => strtoupper(stripHTMLtags($this->input->post('address', 'true'))),
                'student_phone'   => trim(stripHTMLtags($this->input->post('phone', 'true'))),
                'student_email'   => trim(stripHTMLtags($this->input->post('email', 'true'))),
                'student_parent'  => strtoupper(stripHTMLtags($this->input->post('ortu', 'true'))),
                'student_update' => date('Y-m-d H:i:s'),
            );
        }

        $this->db->where('student_id', $student_id);
        $this->db->update('alifa_student', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('student_id', $id);
        $this->db->delete('alifa_student');
    }
}
/* Location: ./application/models/admin/Student_m.php */
