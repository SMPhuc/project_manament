<?php
session_start();
?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LecturerManagement_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LecturerModel');
    }

    public function index() {
        $lecturers = $this->LecturerModel->getAllLecturers();
        $data = ['lecturers' => $lecturers];
        $this->load->view('manage_lecturers_view', $data);
    }

    public function edit($lecturer_id) {
        $lecturer = $this->LecturerModel->getLecturerById($lecturer_id);
        if ($lecturer) {
            $data = ['lecturer' => $lecturer];
            $this->load->view('edit_lecturer_view', $data);
        } else {
            $this->load->view('lecturer_not_found_view');
        }
    }

    public function update() {
        $lecturer_id = $this->input->post('lecturer_id');
        $lecturer_name = $this->input->post('lecturer');
        $department = $this->input->post('department');
        $university = $this->input->post('university');

        if (empty($lecturer_id) || empty($lecturer_name) || empty($department) || empty($university)) {
            $this->load->view('fill_all_fields_view');
        } else {
            $this->LecturerModel->updateLecturer($lecturer_id, $lecturer_name, $department, $university);
            redirect('http://localhost:3000/LecturerManagement_Controller');
        }
    }
} 