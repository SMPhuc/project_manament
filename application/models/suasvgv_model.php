<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class suasvgv_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//cap nhat thong tin sinh vien
	function laythongtinsv($mssvlayve)
	{
		$this->db->select('*');
		$this->db->where('student_id', $mssvlayve);
		$dulieu=$this->db->get('student_list');
		$dulieu=$dulieu->result_array();
		return $dulieu;
	}
	function updateByMssv($mssv, $sinhvien, $khoa, $nganh, $lop,$t)
	{
		$dulieu=array(
			'student_id'=>$mssv,
			'student'=>$sinhvien,
			'department'=>$khoa,
			'major'=>$nganh,
			'class'=>$lop
		);
		$this->db->where('student_id',$t);
		return $this->db->update('student_list', $dulieu);
	}
	function updatetaikhoan($t,$mssv)
	{
		$dataa=array(
			'account'=>$mssv,
			'password'=>$mssv);
		$this->db->where('account', $t);
		$this->db->update('account_list',$dataa);

	}
	//cap nhat thong tin gv
	function laythongtingv($msgv)
	{
		$this->db->select('*');
		$this->db->where('lecturer_id', $msgv);
		$dulieu=$this->db->get('lecturer_list');
		$dulieu=$dulieu->result_array();
		return $dulieu;
	}
	function updateByMsgv($msgv, $giangvien, $khoa, $truong, $t)
	{
		$dulieu = array(
			'lecturer_id' => $msgv,
			'lecturer' => $giangvien,
			'department' => $khoa,
			'university' => $truong
		);
		$this->db->where('lecturer_id', $t);
		return $this->db->update('lecturer_list', $dulieu);
	}
	function updatetaikhoan1($t,$msgv)
	{
		$dataa=array(
			'account'=>$msgv,
			'password'=>$msgv
		);
		$this->db->where('account', $t);
		$this->db->update('account_list',$dataa);
	}
	public function deleteGV($id)
	{
		$this->db->where('lecturer_id', $id);
		 $this->db->delete('lecturer_list');
		  $this->db->where('account', $id);
		 $this->db->delete('account_list');
		
	}
	public function deleteSV($id)
	{
		$this->db->where('student_id', $id);
		$this->db->delete('student_list');
		$this->db->where('account', $id);
		$this->db->delete('account_list');
	}
	public function searchSV($m)
	{
		$this->db->select('*');
		$this->db->where('student_id', $m);
		$dulieu = $this->db->get('student_list');
		$dulieu = $dulieu->result_array();
		return !empty($dulieu);
	}
	public function searchGV($m)
	{
		$this->db->select('*');
		$this->db->where('lecturer_id', $m);
		$dulieu = $this->db->get('lecturer_list');
		$dulieu = $dulieu->result_array();
		return !empty($dulieu);
	}
	function getLecturerById($lecturer_id) {
		$this->db->select('*');
		$this->db->from('lecturer_list');
		$this->db->where('lecturer_id', $lecturer_id);
		$query = $this->db->get();
		$result = $query->row_array();
		
		if (!$result) {
			log_message('error', 'Lecturer not found: ' . $lecturer_id); // Log lỗi nếu không tìm thấy
		}
		
		return $result;
	}
}

/* End of file suasv_ model.php */
/* Location: ./application/models/suasv_ model.php */