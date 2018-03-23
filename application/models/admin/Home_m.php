<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_employee()
    {
        $this->db->select('COUNT(employee_id) as total');
        $this->db->from('alifa_employee');

        return $this->db->get();
    }

    public function select_student()
    {
        $this->db->select('COUNT(student_id) as total');
        $this->db->from('alifa_student');

        return $this->db->get();
    }

    public function select_promo()
    {
        $this->db->select('COUNT(promo_id) as total');
        $this->db->from('alifa_promo');

        return $this->db->get();
    }

    public function select_article()
    {
        $this->db->select('COUNT(article_id) as total');
        $this->db->from('alifa_article');

        return $this->db->get();
    }
}
/* Location: ./application/model/admin/Home_m.php */
