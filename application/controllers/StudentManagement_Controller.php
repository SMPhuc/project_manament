<?php
session_start();
?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class StudentManagement_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('StudentModel');
    }

    public function index() {
        $students = $this->StudentModel->getAllStudents();
        $data = ['students' => $students];
        $this->load->view('manage_students_view', $data);
    }
} 