<?php
session_start();
?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Submission_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('quyentruycap_model');
        $isGV = $this->quyentruycap_model->isGV($_SESSION['username']);
        
        if ($isGV == false) {
            $this->load->view('thongbaokhongcoquyentruycap_view');
        } else {
            $this->load->model('StudentModel');
            $students = $this->StudentModel->getStudentsByLecturer($_SESSION['username']);
            $data = [
                'students' => $students,
                'lecturer_id' => $_SESSION['username']
            ];
            $this->load->view('submission_view', $data);
        }
    }

    // public function addSubmissionRequest() {
    //     $student_id = $this->input->post('student_id');
    //     $title = $this->input->post('title');
    //     $description = $this->input->post('description');
    //     $deadline = $this->input->post('deadline');

    //     $this->SubmissionModel->addSubmissionRequest($student_id, $title, $description, $deadline);
    //     redirect('Submission_Controller');
    // }
} 