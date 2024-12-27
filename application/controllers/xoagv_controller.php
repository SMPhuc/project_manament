<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class xoagv_controller extends CI_Controller {

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
			$this->load->view('deletegv_view.php');
		}
	}
	public function delete()
	{
		
		$msgv=$this->input->post('msgv');
		$this->load->model('suasvgv_model');
		$data=$this->suasvgv_model->searchGV($msgv);
		if($data==true)
		{
			$this->load->model('suasvgv_model');
			$this->suasvgv_model->deleteGV($msgv);
			$this->load->view('thongbaoxoagv_view');
		}
		else
		{
			$this->load->view('khongtimthaygvdexoa_view.php');
		}
	}
}

/* End of file xoagv_controller.php */
/* Location: ./application/controllers/xoagv_controller.php */