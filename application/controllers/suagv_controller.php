<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class suagv_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data=$this->quyentruycap_model->isCVK($_SESSION['username']);
		if($data==false){
			$this->load->view('thongbaokhongcoquyentruycap_view.php');
		}
		else
		{
			$this->load->view('suagv_view.php');
		}
	}
	function edit($lecturer_id)
	{
		$this->load->model('suasvgv_model');
		$lecturer = $this->suasvgv_model->getLecturerById($lecturer_id);
		
		if ($lecturer) {
			$data = [
				'lecturer' => $lecturer,
				'mangkq' => [$lecturer]
			];
			$this->load->view('editgv_view', $data);
		} else {
			echo "Không tìm thấy giảng viên với mã số: " . $lecturer_id;
			$this->load->view('lecturer_not_found_view');
		}
	}
	function update()
	{
		$data = $_SESSION['lecturer_id'];
		$msgv = $this->input->post('lecturer_id');
		$giangvien = $this->input->post('lecturer');
		$khoa = $this->input->post('department');
		$truong = $this->input->post('university');
		if (empty($msgv) || empty($giangvien) || empty($khoa) || empty($truong)) {
			$this->load->view('diendayduthongtindesuagv_view.php');
		} else {
			$this->load->model('suasvgv_model');
			$this->suasvgv_model->updateByMsgv($msgv, $giangvien, $khoa, $truong, $data);
			$this->suasvgv_model->updatetaikhoan1($data, $msgv);
			$this->load->view('quayvetrangsuagv_view.php');
		}
	}
	

}

/* End of file suagv_controller.php */
/* Location: ./application/controllers/suagv_controller.php */