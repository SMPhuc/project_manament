<?php
session_start();
?>
<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class showData_controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$role = $this->quyentruycap_model->getRole($_SESSION['username']);
		
		if ($role === null) {
			$this->load->view('thongbaokhongcoquyentruycap_view.php');
		} else {
			$this->load->model('showData_model');
			$dulieu = $this->showData_model->getDatabase();
			$viewData = [
				'dulieutucontroller' => $dulieu,
				'role' => $role
			];
			$this->load->view('showData_view.php', $viewData);
		}
	}
	public function noidungdetai($idlayve)
	{
		// Tải model
		$this->load->model('quyentruycap_model');
		$role = $this->quyentruycap_model->getRole($_SESSION['username']);

		// Kiểm tra quyền truy cập
		if ($role === 'giaovu' || $role === 'giangvien' || $role === 'sinhvien') {
			// Tải model
			$this->load->model('showData_model');

			// Lấy dữ liệu từ model dựa trên ID
			$tin = $this->showData_model->Id($idlayve);

			// Kiểm tra dữ liệu
			if (!empty($tin)) {
				// Truyền dữ liệu đến view
				$this->load->view('trove_view.php', ['tin' => $tin]);
			} else {
				// Hiển thị thông báo nếu không có dữ liệu
				$this->load->view('thongbao_view');
			}
		} else {
			// Thông báo không đủ quyền truy cập
			$this->load->view('thongbao_view');
		}
	}
	public function deleteData($idnhanduoc)
	{
		//echo $idnhanduoc;
		if ($_SESSION['username'] >= 7030000 || $_SESSION['username'] <= 7020000) {
			$this->load->view('thongbao_view');
		} else {
			$this->load->model('showData_model');
			if ($this->showData_model->deleteDatabyid($idnhanduoc)) {
				$this->load->view('thongbaoxoathanhcong.php');
			} else {
				echo "Xóa thất bại";
			}
		}
	}
	public function editSim($idlayve)
	{
		if ($_SESSION['username'] >= 7030000 || $_SESSION['username'] <= 7020000) {
			$this->load->view('thongbaokhongcoquyentruycap_view');
		} else {
			$this->load->model('showData_model');
			$ketqua = $this->showData_model->editById($idlayve);
			// Truyền dữ liệu vào view
			$ketqua = array('ketquatucontroller' => $ketqua);
			$this->load->view('editData_view.php', $ketqua, FALSE);
		}
	}

	public function updateData()
	{
		// Nhận giá trị từ form gửi lên
		$id = $this->input->post('id');
		$tendetai = $this->input->post('project_title'); // Kiểm tra trường này có giá trị không
		$noidung = $this->input->post('content'); // Kiểm tra trường này có giá trị không

		// Kiểm tra giá trị có hợp lệ hay không
		if (empty($tendetai) || empty($noidung)) {
			echo "Cả tên đề tài và nội dung đều phải được nhập!";
			return;
		}

		$this->load->model('showData_model');
		// Cập nhật dữ liệu vào database
		if ($this->showData_model->updateDataById($id, $tendetai, $noidung)) {
			$this->load->view('thongbaosuathanhcong.php');
		} else {
			echo "Sửa thất bại";
		}
	}
}

/* End of file showData_controller.php */
/* Location: ./application/controllers/showData_controller.php */