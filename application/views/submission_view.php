<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
    <script type="text/javascript" src="http://localhost:3000/1.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
    <link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
    <link rel="stylesheet" href="http://localhost:3000/start2_css.css">
    <link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
    <style>
        .btn-primary {
            margin-top: -50px;
            margin-left: 1000px;
        }
        th.checkbox-column {
            width: 5%;
            /* text-align: center; */
        }
        .table-bordered th, .table-bordered td {
            width: 5%;
        }
        th.project-column {
            width: 50%;
        }
        th.student-name-column {
            width: 30%;
        }
        th.student-id-column {
            width: 15%;
        }
        #filterInput {
            width: 300px;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 400px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            animation: animatetop 0.4s;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }
    </style>
</head>
<body>
    <?php require('header.php'); ?>
    <input type="hidden" id="lecturerId" value="<?= $lecturer_id ?>">
    <div class="container d-flex justify-content-between align-items-center">
        <h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Danh sách sinh viên</h3>
        <button class="btn btn-primary" onclick="checkSelectedStudents()">Tạo mới yêu cầu</button>
    </div>
    <div class="container">
        <input type="text" id="filterInput" placeholder="Lọc theo tên đề tài hoặc tên sinh viên" class="form-control mb-3">
        <form action="" method="POST" style="margin-top: -30px;">
            <table class="table table-bordered" id="studentTable">
                <thead>
                    <tr>
                        <th class="checkbox-column"><input type="checkbox" id="selectAll"></th>
                        <th class="project-column">Tên đề tài</th>
                        <th class="student-name-column">Tên sinh viên</th>
                        <th class="student-id-column">Mã sinh viên</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><input type="checkbox" name="selected_students[]" value="<?= $student['student_id'] ?>"></td>
                                <td><?= $student['project'] ?? 'Không có đề tài' ?></td>
                                <td>
                                    <a href="/StudentProgressController/index/<?= $student['student_id'] ?>">
                                        <?= $student['approved_students'] ?? 'Không có tên' ?>
                                    </a>
                                </td>
                                <td><?= $student['student_id'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Modal -->
    <div id="requestModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h5>Tạo yêu cầu mới</h5>
            <form id="newRequestForm">
                <div class="form-group">
                    <label for="title">Tiêu đề:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline:</label>
                    <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
                </div>
                <button type="button" class="btn btn-success" onclick="submitRequest()">Lưu</button>
            </form>
        </div>
    </div>

    <script src="public/js/createRequest.js"></script>
</body>
</html> 