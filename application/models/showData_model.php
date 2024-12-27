<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class showData_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Lấy tất cả dữ liệu từ bảng project_list
	public function getDatabase()
	{
		$this->db->select('*');
		$ketqua = $this->db->get('project_list');
		$ketqua = $ketqua->result_array();
		return $ketqua;
	}

	// Xóa dữ liệu theo id
	public function deleteDatabyid($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('project_list');
	}

	// Sửa dữ liệu theo id
	public function editById($i)
	{
		$this->db->select('*');
		$this->db->where('id', $i);
		$dulieu = $this->db->get('project_list');
		$dulieu = $dulieu->result_array();
		return $dulieu;
	}

	// Cập nhật dữ liệu theo id
	public function updateDataById($id, $t, $n)
{
    // Kiểm tra đầu vào
    if (empty($id) || empty($t) || empty($n)) {
        return false; // Nếu không có dữ liệu cần thiết, trả về false
    }

    $dulieucanupdate = array(
        'id' => $id,
        'project_title' => $t,
        'content' => $n,
    );

    // Cập nhật dữ liệu
    $this->db->where('id', $id);
    return $this->db->update('project_list', $dulieucanupdate);
}

	// Thêm phương thức Id() để lấy dữ liệu theo ID
	public function Id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('project_list');
		return $query->result_array(); // Trả về dữ liệu dưới dạng mảng
	}
}

/* End of file showData_model.php */
/* Location: ./application/models/showData_model.php */
