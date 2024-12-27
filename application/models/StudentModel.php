<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class StudentModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Lấy danh sách sinh viên theo giảng viên
    public function getStudentsByLecturer($lecturer_id) {
        $this->db->select('student_id, approved_students, project'); // Sử dụng đúng tên cột
        $this->db->from('approved_student_list');
        $this->db->where('lecturer_id', $lecturer_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllStudents() {
        $query = $this->db->get('student_list');
        return $query->result_array();
    }
} 