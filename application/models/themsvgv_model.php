<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class themsvgv_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function themsv($mssv, $sinhvien, $khoa, $nganh, $lop)
	{
		$dulieu=array(
			'student_id'=>$mssv,
			'student'=>$sinhvien,
			'department'=>$khoa,
			'major'=>$nganh,
			'class'=>$lop,
		);
		$ketqua=array(
			'account'=>$mssv,
			'password'=>$mssv,
			
		);
		$this->db->insert('student_list', $dulieu);
		$this->db->insert('account_list', $ketqua);
	}
	//them gv
	function themgv($msgv, $giangvien, $khoa, $truong)
		{
			$dulieu=array(
				'lecturer_id'=>$msgv,
				'lecturer'=>$giangvien,
				'department'=>$khoa,
				'university'=>$truong,
				
			);
			$ketqua=array(
				'account'=>$msgv,
				'password'=>$msgv
				
			);
			$this->db->insert('lecturer_list', $dulieu);
			$this->db->insert('account_list', $ketqua);
		}

	public function isStudentExists($mssv)
	{
		$this->db->where('student_id', $mssv);
		$query = $this->db->get('student_list');
		return $query->num_rows() > 0;
	}

	public function isLecturerExists($msgv)
	{
		$this->db->where('lecturer_id', $msgv);
		$query = $this->db->get('lecturer_list');
		return $query->num_rows() > 0;
	}

}

/* End of file themsvgv_model.php */
/* Location: ./application/models/themsvgv_model.php */