<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class StudentProgressModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getSubmissionRequestsByStudentId($student_id)
    {
        $this->db->select('*');
        $this->db->from('submission_requests');
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        return $query->result_array(); // Trả về mảng dữ liệu
    }

    public function updateFeedback($submission_id, $feedback)
    {
        $data = ['feedback' => $feedback];
        $this->db->where('id', $submission_id);
        $this->db->update('submission_requests', $data);
    }
} 