<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class suasv_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
			$this->load->view('suasv_view.php');
		}
	}
	function edit($student_id = null)
	{
		if ($student_id === null) {
			$student_id = $this->input->post('student_id');
		}
		$_SESSION['mssvlayve'] = $student_id;
		$this->load->model('suasvgv_model');
		$data = $this->suasvgv_model->searchSV($student_id);
		if ($data == true) {
			$dulieu = $this->suasvgv_model->laythongtinsv($student_id);
			$dulieu = array('mangkq' => $dulieu);
			$this->load->view('editsv_view.php', $dulieu, FALSE);
		} else {
			$this->load->view('khongtimthaysv_view.php');
		}
	}
	function update()
	{
		$data=	$_SESSION['mssvlayve'];
		$mssv=$this->input->post('student_id');
		$sinhvien=$this->input->post('student');
		$khoa=$this->input->post('department');
		$nganh=$this->input->post('major');
		$lop=$this->input->post('class');
		if(empty($mssv)||empty($sinhvien)||empty($khoa)||empty($nganh)||empty($lop))
		{
			$this->load->view('diendayduthongtindesuasv_view.php');
		}
		else
		{
			$this->load->model('suasvgv_model');
			$this->suasvgv_model->updateByMssv($mssv, $sinhvien, $khoa, $nganh, $lop,$data);
			$this->load->model('suasvgv_model');
			$this->suasvgv_model->updatetaikhoan($data,$mssv);
			$this->load->view('quayvetrangsuasv_view.php');
		}
	}
	function delete($student_ids)
	{
		$this->load->model('suasvgv_model');
		$ids = explode(',', $student_ids);
		foreach ($ids as $id) {
			$this->suasvgv_model->deleteSV($id);
		}
		// Chuyển hướng về trang quản lý sinh viên sau khi xóa
		redirect('http://localhost:3000/StudentManagement_Controller');
	}
}

/* End of file suasv.php */
/* Location: ./application/controllers/suasv.php */