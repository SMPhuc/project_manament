<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dexuatdetai_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insertdetaidexuat($t,$n, $s,$m)
	{
		$dulieu = ['project_title' => $t,'content' => $n,'student'=>$s, 'student_id'=>$m];
		$this->db->insert('proposed_project_list', $dulieu);
	}
	public function getProposalsByStudent($student_id)
	{
		$this->db->where('student_id', $student_id);
		$query = $this->db->get('proposed_project_list');
		return $query->result_array();
	}
	public function approveProposal($proposal_id)
	{
		// Lấy thông tin đề tài từ bảng proposed_project_list
		$this->db->where('id', $proposal_id);
		$query = $this->db->get('proposed_project_list');
		$proposal = $query->row_array();

		if ($proposal) {
			// Chuyển đề tài sang bảng project_list
			$this->db->insert('project_list', [
				'project_title' => $proposal['project_title'],
				'content' => $proposal['content'],
				'student' => $proposal['student'],
				'student_id' => $proposal['student_id']
			]);

			// Cập nhật trạng thái đề tài trong bảng proposed_project_list
			$this->db->where('id', $proposal_id);
			$this->db->update('proposed_project_list', ['status' => 1]); // 1: approved
		}
	}
}

/* End of file dexuatdetai_model.php */
/* Location: ./application/models/dexuatdetai_model.php */