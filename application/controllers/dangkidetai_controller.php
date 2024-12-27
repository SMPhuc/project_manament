<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dangkidetai_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data=$this->quyentruycap_model->isSV($_SESSION['username']);
		if($data==false)
		{
			$this->load->view('thongbaokhongcoquyentruycap_view');
		}
		else
		{
		$ma=$_SESSION['username'];
		$this->load->model('addData_model');
		if($this->addData_model->search($ma)==true){
			$this->load->view('dadangkidetai_view.php');
		}
		else
		{
		$this->load->model('dangkidetai_model');
		$data=$this->dangkidetai_model->dem();
		$this->load->model('showData_model');
		$dulieu=$this->showData_model->getDatabase();
		$dulieu= array('dulieutucontroller' =>$dulieu);
		$this->load->view('dangkidetai_view.php', $dulieu, FALSE);
	    }
		}
	}
	public function insertData_controller()
	{
		$ma=$_SESSION['username'];
		$this->load->model('addData_model');
		$thongtin=$this->addData_model->searchDatabaseSV($ma);
		foreach( $thongtin as $value)
		{
			 $masv=$value['student_id']; 
			 $tensv=$value['student'];
		}
		
		if(isset($_POST['chon'])) {
      		$chon=$_POST['chon'];
			$this->load->model('addData_model');
			$data=$this->addData_model->searchDatabaseDT($chon);
			foreach( $data as $value )
			{
				$tendetai=$value['project_title'];
				$giangvien=$value['lecturer'];
				$msgv=$value['lecturer_id'];
				$madetai=$value['id'];
			}
			$this->load->model('dangkidetai_model');
			$this->dangkidetai_model->insertsinhviencanduyet($masv,$tensv,$tendetai,$msgv,$giangvien,$madetai);
			$this->load->view('Dangkithanhcong_view.php');
		}
		else 
		{
			$this->load->view('phaidky_view.php');
		}
	}
}

/* End of file dangkidetai_controller.php */
/* Location: ./application/controllers/dangkidetai_controller.php */