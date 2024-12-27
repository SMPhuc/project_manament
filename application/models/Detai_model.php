<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detai_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Phương thức lấy danh sách đề tài đề xuất của giảng viên
    public function getDeTaiDeXuatGV()
    {
        $query = $this->db->get_where('proposed_project_list', ['status' => 0]);
        return $query->result_array();
    }

    // Phương thức lấy thông tin đề tài theo ID
    public function getDeTaiById($id)
    {
        $query = $this->db->get_where('proposed_project_list', ['id' => $id]);
        return $query->row_array();
    }

    // Phương thức đánh dấu đề tài là đã duyệt
    public function markAsApproved($id)
    {
        $this->db->update('proposed_project_list', ['status' => 1], ['id' => $id]);
    }

    // Phương thức thêm đề tài vào project_list
    public function insertIntoProjectList($detai)
    {
        $this->db->insert('project_list', [
            'ten_detai' => $detai['ten_detai'],
            'giang_vien' => $detai['giang_vien'],
            // Thêm các trường khác nếu cần
        ]);
    }
} 