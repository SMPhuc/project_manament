<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lecturer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Phương thức lấy thông tin giảng viên theo lecturer_id
    public function getLecturerById($lecturer_id)
    {
        $this->db->where('lecturer_id', $lecturer_id);
        $query = $this->db->get('lecturer_list');
        return $query->row_array();
    }
} 