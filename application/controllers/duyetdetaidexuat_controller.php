<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class duyetdetaidexuat_controller extends CI_Controller {

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
		$this->load->model('duyetdexuatdetaidexuat_model');
		$dulieu=$this->duyetdexuatdetaidexuat_model->getDatabase();
		$dulieu= array('thongtintucontroller' =>$dulieu);
		$this->load->view('duyetdtddetaidexuat_view.php', $dulieu, FALSE);
		}
	}
	public function noidungdetai($idlayve)
{
    if ($_SESSION['username'] >= 7030000 || $_SESSION['username'] <= 7020000) {
        $this->load->view('thongbao_view');
    } else {
        $this->load->model('duyetdexuatdetaidexuat_model');
        $tin = $this->duyetdexuatdetaidexuat_model->Id($idlayve);

        // Kiểm tra dữ liệu từ model
        if (!empty($tin)) {
            $this->load->view('trove_view.php', ['tin' => $tin]); // Truyền dữ liệu đến view
        } else {
            $this->load->view('thongbao_view'); // Hiển thị thông báo nếu dữ liệu rỗng
        }
    }
}

	public function duyetdetai($idlayve)
	{
		$this->load->model('duyetdexuatdetaidexuat_model');
		$thongtin=$this->duyetdexuatdetaidexuat_model->Id($idlayve);
		$this->load->model('duyetdexuatdetaidexuat_model');
		$this->duyetdexuatdetaidexuat_model->deletebyid($idlayve);
		foreach( $thongtin as $value )
    	{
        		$tendetai=$value['project_title'];
				$noidung=$value['content'];
    	}
    	$ma=$_SESSION['username'];
    	$this->load->model('addData_model');
		$tin=$this->addData_model->searchDatabaseGV($ma);
		foreach( $tin as $value )
    	{
    		 $magv=$value['lecturer_id']; 
    		 $tengv=$value['lecturer'];
    	}
		$this->load->model('duyetdexuatdetaidexuat_model');
		$this->duyetdexuatdetaidexuat_model->duyetdetaidexuat_model($tendetai,$noidung,$magv,$tengv);
		$this->load->view('thongbaoduyetdetaidexuatthanhcong.php');
	}

}

/* End of file duyetdetaidexuat_controller.php */
/* Location: ./application/controllers/duyetdetaidexuat_controller.php */