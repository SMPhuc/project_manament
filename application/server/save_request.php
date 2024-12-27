<?php
// Thêm header CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Kiểm tra phương thức yêu cầu
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Trả về 200 OK cho các yêu cầu OPTIONS
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $title = $data['title'];
    $description = $data['description'];
    $deadline = date('Y-m-d H:i:s', strtotime($data['deadline']));
    $students = $data['students'];
    $lecturer_id = $data['lecturer_id'];
    $created_at = date('Y-m-d H:i:s', strtotime($data['created_at']));

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'project_management');

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $success = true;
    foreach ($students as $student_id) {
        $sql = "INSERT INTO submission_requests (title, description, deadline, student_id, lecturer_id, created_at) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiss", $title, $description, $deadline, $student_id, $lecturer_id, $created_at);

        if (!$stmt->execute()) {
            $success = false;
            error_log("Lỗi SQL: " . $stmt->error);
            break;
        }
    }

    $stmt->close();
    $conn->close();

    if ($success) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu']);
    }
}
?>
