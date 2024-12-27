<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Danh sách sinh viên được duyệt</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
</head>

<body>
	<?php require('header.php') ?>
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold; ">Danh sách sinh viên đã duyệt đề tài</h3>
	</div>
	<div class="container">
		<form action="" method="POST">
			<table>
				<tr>
					<?php foreach ($dulieutucontroller as $key => $value): ?>
						<?php if ($key % 3 == 0 && $key != 0): ?>
					</tr><tr> <!-- Mỗi dòng sẽ chứa 3 card-block -->
					<?php endif; ?>
					<td>
						<div class="col-sm-10">
							<div class="card card-block">
							<h3 class="card-title">Tên đề tài: <?= $value['project_title'] ?></h3>
							<p class="card-text">Giảng viên: <?= $value['lecturer'] ?></p>
							<p class="card-text">Mã giảng viên: <?= $value['lecturer_id'] ?></p>
							<a href="dssinhvienduocduyet_controller/danhsachsinhvien/<?= $value['id'] ?>/<?= $value['project_title'] ?>" class="btn btn-outline-warning sua"><i class="fa fa-book"></i></a>
							</div>
						</div>
					</td>
					<?php endforeach; ?>
				</tr>
			</table>
		</form>
</body>

</html>