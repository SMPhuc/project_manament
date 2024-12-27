<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class xemquatrinh_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Lấy danh sách yêu cầu từ bảng submission_requests theo student_id
    public function getSubmissionRequestsByUsername($username)
    {
        $this->db->select('*');
        $this->db->from('submission_requests');
        $this->db->where('student_id', $username);
        $query = $this->db->get();
        return $query->result_array(); // Trả về mảng dữ liệu
    }

    // Cập nhật tệp đính kèm và thời gian turn_in_at
    public function updateSubmissionRequest($submission_id, $file_path, $turn_in_at)
    {
        $data = [
            'attach' => $file_path,
            'turn_in_at' => $turn_in_at
        ];

        $this->db->where('id', $submission_id);
        $this->db->update('submission_requests', $data);
    }

}
