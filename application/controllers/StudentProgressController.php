<?php
session_start();
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class StudentProgressController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StudentProgressModel');
    }

    public function index($student_id = null)
    {
        if (!isset($_SESSION['username'])) {
            show_error('User is not logged in or session has expired.', 403, 'Forbidden');
            return;
        }

        if ($student_id === null) {
            show_error('Student ID is required.', 400, 'Bad Request');
            return;
        }

        $submissionRequests = $this->StudentProgressModel->getSubmissionRequestsByStudentId($student_id);

        $data = [
            'submissionRequests' => $submissionRequests
        ];
        $this->load->view('student_progress_view', $data);
    }

    public function updateFeedback()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $submission_id = $data['submission_id'];
        $feedback = $data['feedback'];

        $this->StudentProgressModel->updateFeedback($submission_id, $feedback);

        echo json_encode(['status' => 'success']);
    }
} 