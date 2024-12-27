<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class head_controller extends CI_Controller {

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
			$this->load->view('moi_view.php');
		}
	}

}

/* End of file head_controller.php */
/* Location: ./application/controllers/head_controller.php */