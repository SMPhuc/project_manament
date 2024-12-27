<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// Kết nối đến cơ sở dữ liệu 
		$this->load->database();
	}

	// Phương thức kiểm tra tài khoản và mật khẩu
	public function kiemtra_model($tk, $mk)
	{
		// Chọn tất cả các cột từ bảng
		$this->db->select('*');
		$this->db->where('account', $tk);
		
		// Lấy dữ liệu từ bảng 'danhsachtaikhoan'
		$query = $this->db->get('account_list');
		
		// Kiểm tra nếu có bản ghi nào trả về
		if ($query->num_rows() > 0) {
			$dulieu = $query->row_array(); // Lấy hàng đầu tiên trong kết quả
			// Kiểm tra mật khẩu có khớp không
			if ($dulieu['password'] == $mk) {
				return true; // Mật khẩu đúng
			} else {
				return false; // Mật khẩu sai
			}
		} else {
			return false; // Không tìm thấy tài khoản
		}
	}
}
