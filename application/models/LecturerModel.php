<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LecturerModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllLecturers() {
        $query = $this->db->get('lecturer_list');
        return $query->result_array();
    }

    public function deleteLecturers($ids) {
        $this->db->where_in('lecturer_id', $ids);
        $this->db->delete('lecturer_list');
    }

    public function getLecturerById($lecturer_id) {
        $this->db->select('*');
        $this->db->from('lecturer_list');
        $this->db->where('lecturer_id', $lecturer_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function updateLecturer($lecturer_id, $lecturer_name, $department, $university) {
        $data = array(
            'lecturer' => $lecturer_name,
            'department' => $department,
            'university' => $university
        );
        $this->db->where('lecturer_id', $lecturer_id);
        return $this->db->update('lecturer_list', $data);
    }
} 