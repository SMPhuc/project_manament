<?php 
session_start();
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;


class themsv_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once FCPATH . 'vendor/autoload.php';
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
			$this->load->view('themsv_view.php');
		}
	}
	function insert()
	{
		$mssv = $this->input->post('mssv');
		$sinhvien = $this->input->post('sinhvien');
		$khoa = $this->input->post('khoa');
		$nganh = $this->input->post('ngành');
		$lop = $this->input->post('lop');
		$this->load->model('themsvgv_model');

		// Lưu dữ liệu đã nhập vào session
		$_SESSION['form_data'] = compact('mssv', 'sinhvien', 'khoa', 'nganh', 'lop');

		if (empty($mssv) || empty($sinhvien) || empty($khoa) || empty($nganh) || empty($lop)) {
			$this->load->view('chuanhapdayduthongtin_view.php');
		} else {
			if ($this->themsvgv_model->isStudentExists($mssv)) {
				$this->load->view('svdaco_view.php', ['form_data' => $_SESSION['form_data']]);
			} else {
				$this->themsvgv_model->themsv($mssv, $sinhvien, $khoa, $nganh, $lop);
				unset($_SESSION['form_data']); // Xóa dữ liệu sau khi thêm thành công
				$this->load->view('thongbaonhapthanhcong_view.php');
			}
		}
	}
	function uploadExcel()
	{
		if (isset($_FILES['excelFile']['name']) && $_FILES['excelFile']['error'] == 0) {
			$fileType = pathinfo($_FILES['excelFile']['name'], PATHINFO_EXTENSION);
			$allowedTypes = ['xls', 'xlsx'];

			if (!in_array($fileType, $allowedTypes)) {
				$this->load->view('themsv_view', ['error' => 'Định dạng file không hợp lệ. Vui lòng tải lên file Excel.']);
				return;
			}

			$path = $_FILES['excelFile']['tmp_name'];
			try {
				$spreadsheet = IOFactory::load($path);
				$worksheet = $spreadsheet->getActiveSheet();

				$data = [];
				$headers = [];
				$rowIndex = 0;
				$duplicateRows = [];

				foreach ($worksheet->getRowIterator() as $row) {
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(false);

					$rowData = [];
					foreach ($cellIterator as $cell) {
						$rowData[] = $cell->getValue();
					}

					if ($rowIndex == 0) {
						$headers = $rowData;
					} else if (!empty(array_filter($rowData))) {
						$mssv = $rowData[0];
						if ($this->isDuplicateStudent($mssv)) {
							$duplicateRows[] = $rowIndex;
						}
						$data[] = $rowData;
					}
					$rowIndex++;
				}

				if (empty($data)) {
					$this->load->view('themsv_view', ['error' => 'File Excel không chứa dữ liệu hợp lệ.']);
					return;
				}

				$_SESSION['excel_data'] = $data;
				$_SESSION['excel_headers'] = $headers;
				$_SESSION['duplicate_rows'] = $duplicateRows;

				$this->load->view('themsv_view', ['data' => $data, 'headers' => $headers, 'duplicateRows' => $duplicateRows]);

			} catch (Exception $e) {
				$this->load->view('themsv_view', ['error' => 'Lỗi khi đọc file Excel: ' . $e->getMessage()]);
			}
		} else {
			$this->load->view('themsv_view', ['error' => 'Không thể tải file lên. Vui lòng thử lại.']);
		}
	}

	private function isDuplicateStudent($mssv)
	{
		$this->load->model('themsvgv_model');
		return $this->themsvgv_model->isStudentExists($mssv);
	}

	public function saveExcelData()
	{
		if (isset($_SESSION['excel_data'])) {
			$data = $_SESSION['excel_data'];
			$this->load->model('themsvgv_model');

			foreach ($data as $row) {
				if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4])) {
					$this->themsvgv_model->themsv($row[0], $row[1], $row[2], $row[3], $row[4]);
				}
			}

			unset($_SESSION['excel_data']);

			$this->load->view('thongbaonhapthanhcong_view.php');
		} else {
			$this->load->view('loi.php');
		}
	}
}

/* End of file themsv_controller.php */
/* Location: ./application/controllers/themsv_controller.php */