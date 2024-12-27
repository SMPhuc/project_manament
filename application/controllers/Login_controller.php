<?php 
session_start();
?>
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//Kiểm tra vai trò của người dùng nếu đã đăng nhập
		if (isset($_SESSION['username'])) {
			$this->load->model('quyentruycap_model');
			$role = $this->quyentruycap_model->getRole($_SESSION['username']);
			$_SESSION['role'] = $role;
		}
	}
	
	public function index()
	{
		$this->load->view('login_view.php');
	}
	
	public function kiemtra()
	{
		$taikhoan = $this->input->post('taikhoan');
		$matkhau = $this->input->post('matkhau');

		// Kiểm tra nếu tài khoản hoặc mật khẩu để trống
		if (empty($taikhoan) || empty($matkhau)) {
			$data['error_message'] = "Tên đăng nhập và mật khẩu không được để trống!";
			$data['taikhoan'] = $taikhoan; // Giữ lại tài khoản
			$data['matkhau'] = $matkhau; // Giữ lại mật khẩu
			$this->load->view('login_view.php', $data);
			return; // Dừng thực hiện nếu có lỗi
		}

		$this->load->model('login_model');

		if ($this->login_model->kiemtra_model($taikhoan, $matkhau) == true) {
			$_SESSION['username'] = $taikhoan; // Đặt session sau khi xác thực thành công
			$this->load->view('start_view.php');
		} else {
			$data['error_message'] = "Tên đăng nhập hoặc mật khẩu không chính xác!";
			$data['taikhoan'] = $taikhoan; // Giữ lại tài khoản
			$data['matkhau'] = $matkhau; // Giữ lại mật khẩu
			$this->load->view('login_view.php', $data);
		}
	}
}

/* End of file addData_controller */
/* Location: ./application/controllers/addData_controller */