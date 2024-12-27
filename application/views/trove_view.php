<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Thoát</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<!-- <link rel="stylesheet" href="http://localhost:3000/trove_css.css"> -->
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
</head>

<body>
	<?php require('header.php'); ?>
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Danh sách đề tài</h3>
	</div>
	<div class="container">
	<?php if (isset($tin) && !empty($tin)): ?>
    <?php foreach ($tin as $key => $value): ?>
        <form action="" method="POST">
            <div id="table_detai" class="col-sm-10">
                <div class="card card-block" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 2px 5px rgba(0,0,0,0.2);">
                    <h3 class="card-title" style="color: #124874;">Tên đề tài: <?= $value['project_title'] ?></h3>
                    <p class="card-text"><b>Nội dung đề tài:</b> <?= $value['content'] ?></p>
                    <div style="margin-top: 20px;">
                        <a href="http://localhost:3000/duyetdetaidexuat_controller" class="btn btn-info" style="margin-right: 10px;">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
<?php else: ?>
    <p>Không có dữ liệu để hiển thị.</p>
<?php endif; ?>

</body>