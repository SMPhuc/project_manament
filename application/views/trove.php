<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Danh sách sinh viên đã được duyệt đề tài</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
 	<link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
</head>
<body>
	<?php require('header.php'); ?>
	<div class="container">
	<h3 class="text" style="color:#286B81; text-transform:uppercase; font-weight:bold;">Danh sách sinh viên đã được duyệt đề tài</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Họ tên sinh viên</th>
                    <th>Mã số sinh viên</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student['approved_students'] ?></td>
                            <td><?= $student['student_id'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="http://localhost:3000/dssinhvienduocduyet_controller" class="btn btn-info">Quay lại</a>
    </div>
</body>
</html>
