<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class showsinhviendangki_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data=$this->quyentruycap_model->isGV($_SESSION['username']);
		if($data==false)
		{
			$this->load->view('thongbaokhongcoquyentruycap_view');
		}
		else
		{
		$this->load->model('dangkidetai_model');
		$dulieu=$this->dangkidetai_model->getDatabase($_SESSION['username']);
		$dulieu= array('dulieutucontroller' =>$dulieu);
		$this->load->view('showsinhviendangki_view.php', $dulieu, FALSE);
		}
	}
	public function duyetsinhvien($mssvlayve)
	{
		$this->load->model('dangkidetai_model');
		$thongtin=$this->dangkidetai_model->getDatabaseSV($mssvlayve);
		$this->load->model('dangkidetai_model');
		$this->dangkidetai_model->deletebymssv($mssvlayve);
		foreach( $thongtin as $value )
    	{
        		$tendetai=$value['project'];
				$giangvien=$value['lecturer'];
				$msgv=$value['lecturer_id'];
				$sinhvien=$value['student'];
				$mssv=$value['student_id'];
				$madetai=$value['project_id'];
    	}
    	$this->load->model('dangkidetai_model');
    	if($this->dangkidetai_model->demso($madetai)==5)
    	{
    		$this->load->view('thongbaodetaidadusv_view.php');
    	}
    	else
    	{
		$this->load->model('dangkidetai_model');
		$this->dangkidetai_model->duyetsinhviendangki_model($tendetai,$giangvien,$msgv,$sinhvien,$madetai,$mssv);
		$this->load->view('thongbaosvdaduocduyet_view.php');
		}
	}
	public function deleteData($mssvnhanduoc)
	{
		$this->load->model('dangkidetai_model');
		if($this->dangkidetai_model->deleteDatabymssv($mssvnhanduoc))
		{
			$this->load->view('xoasvdky_view.php');
		}
		else
		{
			echo "Xóa thất bại";
		}
	}
}

/* End of file showsinhviendangki_controller.php */
/* Location: ./application/controllers/showsinhviendangki_controller.php */