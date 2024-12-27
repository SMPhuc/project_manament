<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class duyetdexuatdetaidexuat_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getDatabase()
	{
		$this->db->select('*');//chọn toàn bộ
		$ketqua=$this->db->get('proposed_project_list');//lấy 3 bộ kể từ bộ thứ hai vào biến kết quả
		$ketqua=$ketqua->result_array();//biến kết quả thành mảng
		//var_dump($ketqua);//in ra
		return $ketqua;
	}
	public function Id($i)
	{
		$this->db->select('*');
		$this->db->where('id', $i);
		$dulieu= $this->db->get('proposed_project_list');
		$dulieu=$dulieu->result_array();
		return $dulieu;
	}
	public function duyetdetaidexuat_model($t,$n,$m,$k)
	{
        $dulieu = ['project_title' =>$t,'content' => $n,'lecturer_id'=>$m,'lecturer'=>$k];
		$this->db->insert('project_list', $dulieu);
	}
	public function deletebyid($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('proposed_project_list');
		
	}
}

/* End of file duyetdexuatdetaidexuat_model.php */
/* Location: ./application/models/duyetdexuatdetaidexuat_model.php */