<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Duyệt đề tài đề xuất</title>
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
		<h3 class="text" style="color:#286B81; text-transform:uppercase; font-weight:bold;">Đề tài sinh viên đề xuất</h3>
	</div>
	<div class="container">
		<form action="" method="POST">
			<table>
				<tr>
					<?php foreach ($thongtintucontroller as $key => $value): ?>
						<?php if ($key % 3 == 0 && $key != 0): ?>
							</tr><tr> <!-- Mỗi dòng sẽ chứa 3 card-block -->
						<?php endif; ?>
						<td>
							<div id="table_detai" class="col-sm-10">
								<div class="card card-block">
									<h3 class="card-title">Tên đề tài: <?= $value['project_title'] ?></h3>
									<p class="card-text">Nội dung: <?= $value['content'] ?></p>
									<p class="card-text">Sinh viên: <?= $value['student'] ?></p>
									<p class="card-text">MSSV: <?= $value['student_id'] ?></p>
									<div class="click-function">
										<a href="duyetdetaidexuat_controller/duyetdetai/<?=$value['id']?>" class="btn btn-outline-warning sua"><i class="fa fa-check"></i></a>
										<a href="duyetdetaidexuat_controller/noidungdetai/<?=$value['id']?>" class="btn btn-outline-danger xem"><i class="fa fa-book"></i></a>
									</div>
								</div>
							</div>
						</td>
					<?php endforeach; ?>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
