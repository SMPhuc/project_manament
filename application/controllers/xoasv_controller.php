<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class xoasv_controller extends CI_Controller {

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
			$this->load->view('deletesv_view.php');
		}
	}
	public function delete()
	{
		$ids = $this->input->post('ids');
		if ($ids) {
			$idArray = explode(',', $ids);
			$this->LecturerModel->deleteLecturers($idArray);
		}
		redirect('http://localhost:3000/LecturerManagement_Controller');
	}
}

/* End of file xoasv_controller.php */
/* Location: ./application/controllers/xoasv_controller.php */
