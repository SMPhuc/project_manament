<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dexuatdetai_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data = $this->quyentruycap_model->isSV($_SESSION['username']);
		$data1 = $this->quyentruycap_model->isGV($_SESSION['username']);
		if ($data == false && $data1 == false) {
			$this->load->view('thongbaokhongcoquyentruycap_view');
		} else {
			$this->load->model('dexuatdetai_model');
			$proposals = $this->dexuatdetai_model->getProposalsByStudent($_SESSION['username']);
			
			// Kiểm tra xem sinh viên đã đăng ký đề tài nào chưa
			$this->load->model('dangkidetai_model');
			$isRegistered = $this->dangkidetai_model->isStudentRegistered($_SESSION['username']);
			
			$viewData = [
				'proposals' => $proposals,
				'isRegistered' => $isRegistered
			];
			$this->load->view('dexuatdetai_view', $viewData);
		}
	}
	public function insertData_controller()
	{
		$ma=$_SESSION['username'];
		$this->load->model('addData_model');
		$thongtin=$this->addData_model->searchDatabaseSV($ma);
		$tendetai=$this->input->post('project_title');//lay du lieu tu view ve
		$noidung= $this->input->post('content');
		foreach( $thongtin as $value )
		{
			 $masv=$value['student_id']; 
			 $tensv=$value['student'];
		}
		if(empty($tendetai)||empty($noidung))
		{
			$this->load->view('nhaplaidtdexuat_view.php');
		}
		else
		{
		$this->load->model('dexuatdetai_model');
		$this->dexuatdetai_model->insertdetaidexuat($tendetai,$noidung,$tensv,$masv);
		$this->load->view('dexuatthanhcong.php');
		}
	}
	public function approve($proposal_id)
	{
		$this->load->model('dexuatdetai_model');
		$this->dexuatdetai_model->approveProposal($proposal_id);
		redirect('dexuatdetai_controller');
	}
}

/* End of file dexuatdetai_controller.php */
/* Location: ./application/controllers/dexuatdetai_controller.php */