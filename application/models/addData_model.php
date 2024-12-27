<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class addData_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insert($t, $n, $m, $g)
	{
		$dulieu = [
			'project_title' => $t,
			'content' => $n,
			'lecturer' => $g,
			'lecturer_id' => $m
		];
		$this->db->insert('project_list', $dulieu);
	}
	public function searchDatabaseGV($m)
	{
		$this->db->select('*');
		$this->db->where('lecturer_id', $m);
		$dulieu= $this->db->get('lecturer_list');
		$dulieu=$dulieu->result_array();
		return $dulieu;
	}
	public function searchDatabaseDT($m)
	{
		$this->db->select('*');
		$this->db->where('id', $m);
		$dulieu= $this->db->get('project_list');
		$dulieu=$dulieu->result_array();
		return $dulieu;
	}
	public function searchDatabaseSV($m)
	{
		$this->db->select('*');
		$this->db->where('student_id', $m);
		$dulieu= $this->db->get('student_list');
		$dulieu=$dulieu->result_array();
		return $dulieu;
	}
	public function search($m)
	{
		$this->db->select('*');
		$this->db->where('student_id', $m);
		$dulieu= $this->db->get('pending_student_list');
		$dulieu=$dulieu->result_array();
		foreach( $dulieu as $value)
		{
				$mssv=$value['student_id'];
		}
		$this->db->select('*');
		$this->db->where('student_id', $m);
		$data= $this->db->get('approved_student_list');
		$data=$data->result_array();
		foreach( $data as $value)
		{
			$mmsv=$value['student_id'];
		}
		if(isset($mssv) || isset($mmsv))return true;
		else return false;
	}
	public function getLecturers()
	{
		$this->db->select('lecturer_id, lecturer');
		$query = $this->db->get('lecturer_list');
		return $query->result_array();
	}
}

/* End of file addData_model.php */
/* Location: ./application/models/addData_model.php */