<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
use PhpOffice\PhpSpreadsheet\IOFactory;

class themgv_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once FCPATH . 'vendor/autoload.php';
	}

	public function index()
	{
		$this->load->model('quyentruycap_model');
		$data = $this->quyentruycap_model->isCVK($_SESSION['username']);
		if ($data == false) {
			$this->load->view('thongbaokhongcoquyentruycap_view.php');
		} else {
			$this->load->view('themgv_view.php');
		}
	}

	function insert()
	{
		$msgv = $this->input->post('msgv');
		$giangvien = $this->input->post('giangvien');
		$khoa = $this->input->post('khoa');
		$truong = $this->input->post('truong');
		$this->load->model('themsvgv_model');

		if (empty($msgv) || empty($giangvien) || empty($khoa) || empty($truong)) {
			$this->load->view('chuanhapdayduthongtingv_view.php');
		} else {
			if ($this->themsvgv_model->themgv($msgv, $giangvien, $khoa, $truong)) {
				$this->load->view('thongbaonhapthanhconggv_view.php');
			} else {
				$this->load->view('gvdaco_view.php');
			}
		}
	}

	function uploadExcel()
	{
		if (isset($_FILES['excelFile']['name']) && $_FILES['excelFile']['error'] == 0) {
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
						$msgv = $rowData[0];
						if ($this->isDuplicateLecturer($msgv)) {
							$duplicateRows[] = $rowIndex;
						}
						$data[] = $rowData;
					}
					$rowIndex++;
				}

				$_SESSION['excel_data'] = $data;
				$_SESSION['excel_headers'] = $headers;
				$_SESSION['duplicate_rows'] = $duplicateRows;

				$this->load->view('themgv_view', ['data' => $data, 'headers' => $headers, 'duplicateRows' => $duplicateRows]);

			} catch (Exception $e) {
				$this->load->view('themgv_view', ['error' => 'Lỗi khi đọc file Excel: ' . $e->getMessage()]);
			}
		} else {
			$this->load->view('themgv_view', ['error' => 'Không thể tải file lên. Vui lòng thử lại.']);
		}
	}

	private function isDuplicateLecturer($msgv)
	{
		$this->load->model('themsvgv_model');
		return $this->themsvgv_model->isLecturerExists($msgv);
	}

	public function saveExcelData()
	{
		if (isset($_SESSION['excel_data'])) {
			$data = $_SESSION['excel_data'];
			$this->load->model('themsvgv_model');

			foreach ($data as $row) {
				if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3])) {
					$this->themsvgv_model->themgv($row[0], $row[1], $row[2], $row[3]);
				}
			}

			unset($_SESSION['excel_data']);
			$this->load->view('thongbaonhapthanhconggv_view.php');
		} else {
			$this->load->view('loi.php');
		}
	}

}

/* End of file themgv_controller.php */
/* Location: ./application/controllers/themgv_controller.php */