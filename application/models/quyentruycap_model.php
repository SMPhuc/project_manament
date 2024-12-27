<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quyentruycap_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
	public function isSV($tk)
	{
		$this->db->select('*');
		$this->db->where('student_id', $tk);
		$data=$this->db->get('student_list');
		$data=$data->result_array();
		foreach( $data as $value)
		{
			$mssv=$value['student_id'];
		}
		if(isset($mssv))return true;
		else return false;
	}
	public function isGV($tk)
	{
		$this->db->select('*');
		$this->db->where('lecturer_id', $tk);
		$data=$this->db->get('lecturer_list');
		$data=$data->result_array();
		foreach( $data as $value)
		{
			$msgv=$value['lecturer_id'];
		}
		if(isset($msgv))return true;
		else return false;
	}
	public function isCVK($tk)
	{
		$this->db->select('*');
		$this->db->where('faculty_id', $tk);
		$data=$this->db->get('faculty_transfer_list');
		$data=$data->result_array();
		foreach( $data as $value)
		{
			$mscvk=$value['faculty_id'];
		}
		if(isset($mscvk))return true;
		else return false;
	}
	public function getRole($username)
	{
		// Kiểm tra xem người dùng là sinh viên
		if ($this->isSV($username)) {
			return 'sinhvien';
		}
		// Kiểm tra xem người dùng là giảng viên
		if ($this->isGV($username)) {
			return 'giangvien';
		}
		// Kiểm tra xem người dùng là giáo vụ
		if ($this->isCVK($username)) {
			return 'giaovu';
		}
		// Trả về null nếu không tìm thấy vai trò
		return null;
	}

}

/* End of file quyentruycap_model.php */
/* Location: ./application/models/quyentruycap_model.php */