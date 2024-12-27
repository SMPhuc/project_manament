<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Xem dữ liệu</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
 	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
 	<link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
</head>
<body>
	<?php require('header.php'); ?>
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Danh sách đề tài</h3>
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
							<div id="table_detai" class="col-sm-10">
								<div class="card card-block">
									<h3 class="card-title">Tên đề tài: <?= $value['project_title'] ?></h3>
									<p class="card-text">Giảng viên: <?= $value['lecturer'] ?></p>
									<p class="card-text">Mã giảng viên: <?= $value['lecturer_id'] ?></p>
									<div class="click-function">
										<?php if ($role == 'giaovu'): ?>
											<a href="showData_controller/deleteData/<?=$value['id']?>" class="btn btn-outline-success xoa"><i class="fa fa-trash"></i></a>
										<?php endif; ?>
										<?php if ($role == 'giaovu' || $role == 'giangvien'): ?>
											<a href="showData_controller/editSim/<?=$value['id']?>" class="btn btn-outline-danger sua"><i class="fa fa-pencil"></i></a>
										<?php endif; ?>
										<a href="showData_controller/noidungdetai/<?=$value['id']?>" class="btn btn-outline-warning sua"><i class="fa fa-book"></i></a>
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
