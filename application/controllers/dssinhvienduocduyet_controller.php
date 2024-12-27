<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dssinhvienduocduyet_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data=$this->quyentruycap_model->isSV($_SESSION['username']);
		$data1=$this->quyentruycap_model->isGV($_SESSION['username']);
		$data2=$this->quyentruycap_model->isCVK($_SESSION['username']);
		if($data==false && $data1==false && $data2==false)
		{
			$this->load->view('thongbaokhongcoquyentruycap_view');
		}
		else
		{
			$this->load->model('showData_model');
			$this->load->model('dangkidetai_model');
			
			$projects = $this->showData_model->getDatabase();
			
			// Lấy số lượng sinh viên cho mỗi đề tài
			foreach ($projects as &$project) {
				$project['student_count'] = $this->dangkidetai_model->getStudentCountByProject($project['id']);
			}
			
			$data = array('dulieutucontroller' => $projects);
			$this->load->view('dssvduocduyet_view.php', $data, FALSE);
		}
	}
	public function danhsachsinhvien($idlayve)
{
    $this->load->model('dangkidetai_model');
    $data = $this->dangkidetai_model->getDatabaseDTGV($idlayve);

    $this->load->view('trove.php', ['students' => $data]);
}




}

/* End of file dssinhvienduocduyet_controller.php */
/* Location: ./application/controllers/dssinhvienduocduyet_controller.php */