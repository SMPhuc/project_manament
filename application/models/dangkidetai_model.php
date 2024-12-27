<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class dangkidetai_model extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insertsinhviencanduyet($m, $s, $d, $mm, $g, $k)
	{
		$dulieu = ['student_id' => $m, 'student' => $s, 'project' => $d, 'lecturer_id' => $mm, 'lecturer' => $g, 'project_id' => $k];
		$this->db->insert('pending_student_list', $dulieu);
	}
	public function getDatabase($s)
	{
		$this->db->select('*'); //chọn toàn bộ
		$this->db->where('lecturer_id', $s);
		$ketqua = $this->db->get('pending_student_list'); //lấy 3 bộ kể từ bộ thứ hai vào biến kết quả
		$ketqua = $ketqua->result_array(); //biến kết quả thành mảng
		//var_dump($ketqua);//in ra
		return $ketqua;
	}
	public function getDatabaseSV($s)
	{
		$this->db->select('*'); //chọn toàn bộ
		$this->db->where('student_id', $s);
		$ketqua = $this->db->get('pending_student_list'); //lấy 3 bộ kể từ bộ thứ hai vào biến kết quả
		$ketqua = $ketqua->result_array(); //biến kết quả thành mảng
		//var_dump($ketqua);//in ra
		return $ketqua;
	}
	public function getDatabaseDTGV($d)
	{
		$this->db->select('*'); //chọn toàn bộ
		if ($this->db->where('project_id', $d)) {
			$ketqua = $this->db->get('approved_student_list'); //lấy 3 bộ kể từ bộ thứ hai vào biến kết quả
			$ketqua = $ketqua->result_array(); //biến kết quả thành mảng
			//var_dump($ketqua);//in ra
			return $ketqua;
		}
	}
	public function getDatabaseByGV($i)
	{
		$this->db->select('*');
		$this->db->where('lecturer_id', $i);
		$dulieu = $this->db->get('approved_student_list');
		$dulieu = $dulieu->result_array();
		return $dulieu;
	}
	public function getDatabase1()
	{
		$this->db->select('*'); //chọn toàn bộ
		$ketqua = $this->db->get('approved_student_list'); //lấy 3 bộ kể từ bộ thứ hai vào biến kết quả
		$ketqua = $ketqua->result_array(); //biến kết quả thành mảng
		//var_dump($ketqua);//in ra
		return $ketqua;
	}
	public function deletebymssv($mssv)
	{
		$this->db->where('student_id', $mssv);
		return $this->db->delete('pending_student_list');
	}
	public function duyetsinhviendangki_model($d, $g, $m, $s, $k, $mm)
	{
		$dulieu = ['project' => $d, 'lecturer' => $g, 'lecturer_id' => $m, 'approved_students' => $s, 'project_id' => $k, 'student_id' => $mm];
		$this->db->insert('approved_student_list', $dulieu);
	}
	public function deleteDatabymssv($id)
	{
		$this->db->where('student_id', $id);
		return $this->db->delete('pending_student_list');
	}
	public function demso($madetai)
	{
		$this->db->select('*');
		$this->db->where('project_id', $madetai);
		$dulieu = $this->db->get('approved_student_list');
		$dulieu = $dulieu->result_array();
		return count($dulieu);
	}
	public function dem()
	{
		// Lấy tất cả các project
		$this->db->select('*');
		$ketqua = $this->db->get('project_list');
		$ketqua = $ketqua->result_array();

		foreach ($ketqua as $key => $value) {
			// Lấy danh sách sinh viên được phê duyệt cho từng project
			$this->db->select('*');
			$this->db->where('project_id', $value['id']);
			$dulieu = $this->db->get('approved_student_list');
			$dulieu = $dulieu->result_array();

			// Đếm số lượng sinh viên
			$data = count($dulieu);

			// Chuẩn bị dữ liệu để cập nhật
			$dulieucanupdate = array(
				'count' => $data
			);

			// Cập nhật cột 'dem' trong bảng project_list
			$this->db->where('id', $value['id']);
			$this->db->update('project_list', $dulieucanupdate);
		}
	}
	public function isStudentRegistered($student_id)
	{
		$this->db->where('student_id', $student_id);
		$query = $this->db->get('approved_student_list'); 
		return $query->num_rows() > 0;
	}
	public function getStudentCountByProject($projectId)
	{
		$this->db->where('project_id', $projectId);
		$this->db->from('approved_student_list'); 
		return $this->db->count_all_results();
	}
}

/* End of file dangkidetai_model.php */
/* Location: ./application/models/dangkidetai_model.php */