<?php
session_start(); // Khởi động session
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class quatrinhthuchien_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->library('session');
        $this->load->library('upload');
    }

    public function index()
    {
        // Kiểm tra nếu session không tồn tại
        if (!isset($_SESSION['username'])) {
            show_error('User is not logged in or session has expired.', 403, 'Forbidden');
            return;
        }

        // Lấy username từ session
        $username = $_SESSION['username'];

        // Tải model kiểm tra quyền truy cập
        $this->load->model('quyentruycap_model');
        $isSV = $this->quyentruycap_model->isSV($username);
        $isGV = $this->quyentruycap_model->isGV($username);

        if (!$isSV && !$isGV) {
            // Nếu không có quyền, hiển thị thông báo
            $this->load->view('thongbaokhongcoquyentruycap_view');
        } else {
            // Tải model lấy dữ liệu
            $this->load->model('xemquatrinh_model');
            $submissionRequests = $this->xemquatrinh_model->getSubmissionRequestsByUsername($username);

            // Truyền dữ liệu đến view
            $data = [
                'submissionRequests' => $submissionRequests
            ];
            $this->load->view('quatrinhthuchien_view.php', $data);
        }
    }
    public function uploadAttachment()
    {
        // Đặt múi giờ cho Việt Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Kiểm tra nếu có tệp được gửi lên
        if (isset($_FILES['attachment_' . $this->input->post('submission_id')])) {
            $file = $_FILES['attachment_' . $this->input->post('submission_id')];

            // Kiểm tra lỗi trong quá trình tải tệp lên
            if ($file['error'] == 0) {
                // Đường dẫn lưu tệp đính kèm
                $upload_path = 'C:\Users\sonmi\Documents\TieuLuanTotNghiep\uploads\\';
                $file_name = basename($file['name']);
                $file_path = $upload_path . $file_name;

                // Di chuyển tệp từ tạm thời đến thư mục uploads
                if (move_uploaded_file($file['tmp_name'], $file_path)) {
                    // Lấy thời gian hiện tại theo múi giờ Việt Nam
                    $turn_in_at = date('Y-m-d H:i:s');

                    // Cập nhật thông tin trong cơ sở dữ liệu
                    $submission_id = $this->input->post('submission_id');
                    $this->load->model('xemquatrinh_model');
                    $this->xemquatrinh_model->updateSubmissionRequest($submission_id, $file_path, $turn_in_at);

                    // Chuyển hướng lại trang với thông báo thành công
                    redirect('http://localhost:3000/quatrinhthuchien_controller');
                } else {
                    // Nếu không thể tải lên tệp
                    echo "Lỗi khi tải tệp lên!";
                }
            } else {
                // Nếu có lỗi tải lên
                echo "Lỗi: " . $file['error'];
            }
        }
    }
    public function updateFeedback($submission_id, $feedback)
{
    // Cập nhật cột 'feedback' trong cơ sở dữ liệu
    $data = [
        'feedback' => $feedback
    ];

    // Cập nhật thông tin phản hồi vào bảng submission_requests
    $this->db->where('id', $submission_id);
    $this->db->update('submission_requests', $data);
}

}
