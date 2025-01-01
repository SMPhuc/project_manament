<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class addData_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once FCPATH . 'vendor/autoload.php';
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data=$this->quyentruycap_model->isCVK($_SESSION['username']);
		if($data==false)
		{
			$this->load->view('thongbaokhongcoquyentruycap_view');
		}
		else
		{
		$this->load->view('addData_view.php');
		}
	}
	public function start()
	{
		$this->load->view('start_view.php');
	}
	public function insertDetai_controller()
	{
    	$ma=$_SESSION['username'];
    	$this->load->model('addData_model');
    	$thongtin=$this->addData_model->searchDatabaseGV($ma);
		$tendetai = $this->input->post('project_title');
		$noidung = $this->input->post('content');
		$tengv = $this->input->post('lecturer_name');
		$magv = $this->input->post('lecturer_id');

		if (empty($tendetai) || empty($noidung) || empty($tengv) || empty($magv)) {
			$this->load->view('nhaplaithemdetai_view');
		} else {
			$this->load->model('addData_model');
			$this->addData_model->insert($tendetai, $noidung, $magv, $tengv);
			$this->load->view('thanhcong.php');
		}
	}
	public function uploadExcel()
	{
		if (isset($_FILES['excelFile']['name']) && $_FILES['excelFile']['error'] == 0) {
			$fileType = pathinfo($_FILES['excelFile']['name'], PATHINFO_EXTENSION);
			$allowedTypes = ['xls', 'xlsx'];

			if (!in_array($fileType, $allowedTypes)) {
				$this->load->view('addData_view', ['error' => 'Định dạng file không hợp lệ. Vui lòng tải lên file Excel.']);
				return;
			}

			$path = $_FILES['excelFile']['tmp_name'];
			try {
				$spreadsheet = IOFactory::load($path);
				$worksheet = $spreadsheet->getActiveSheet();

				$data = [];
				$headers = [];
				$rowIndex = 0; // Biến đếm để theo dõi số hàng
				foreach ($worksheet->getRowIterator() as $row) {
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(false);

					$rowData = [];
					foreach ($cellIterator as $cell) {
						$rowData[] = $cell->getValue();
					}

					if ($rowIndex == 0) {
						// Lấy tiêu đề từ hàng đầu tiên
						$headers = $rowData;
					} else {
						// Chỉ thêm hàng nếu không rỗng
						if (!empty(array_filter($rowData))) {
							$data[] = $rowData;
						}
					}
					$rowIndex++;
				}

				if (empty($data)) {
					$this->load->view('addData_view', ['error' => 'File Excel không chứa dữ liệu hợp lệ.']);
					return;
				}

				// Lưu dữ liệu vào session
				$_SESSION['excel_data'] = $data;
				$_SESSION['excel_headers'] = $headers;

				// Hiển thị dữ liệu trong addData_view
				$this->load->view('addData_view', ['data' => $data, 'headers' => $headers]);

			} catch (Exception $e) {
				// Xử lý lỗi khi đọc file Excel
				$this->load->view('addData_view', ['error' => 'Lỗi khi đọc file Excel: ' . $e->getMessage()]);
			}
		} else {
			$this->load->view('addData_view', ['error' => 'Không thể tải file lên. Vui lòng thử lại.']);
		}
	}
	public function saveExcelData()
	{
		if (isset($_SESSION['excel_data'])) {
			$data = $_SESSION['excel_data'];
			$this->load->model('addData_model');

			foreach ($data as $row) {
				if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3])) {
					$this->addData_model->insert($row[0], $row[1], $row[3], $row[2]);
				}
			}

			// Xóa dữ liệu trong session sau khi lưu
			unset($_SESSION['excel_data']);

			$this->load->view('thanhcong.php');
		} else {
			$this->load->view('loi.php');
		}
	}
	public function getLecturers()
	{
		$this->load->model('addData_model');
		$lecturers = $this->addData_model->getLecturers();
		echo json_encode($lecturers);
	}
}

/* End of file addData_controller.php */
/* Location: ./application/controllers/addData_controller.php */