<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class doimk_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('doimk_view.php');
	}
	public function doimk()
	{
		$mkcu=$this->input->post('mkcu');//lay du lieu tu view ve
		$mkmoi= $this->input->post('mkmoi');
		$mkmoi2=$this->input->post('mkmoi2');
		$this->load->model('doimk_model');
		if(empty($mkcu)||empty($mkmoi)||empty($mkmoi2))
		{
			$this->load->view('nhaplaidoimk_view.php');
		}
		else
		{
		if($this->doimk_model->doimk($_SESSION['username'],$mkcu,$mkmoi,$mkmoi2)==true)
		{
				$this->load->view('thongbaodoimkthanhcong');
		}
		else
		{
			$this->load->view('doimkthatbai');
		}
	}
	}

}

/* End of file doimk_controller.php */
/* Location: ./application/controllers/doimk_controller.php */