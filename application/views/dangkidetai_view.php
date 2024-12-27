<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng kí đề tài</title>
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
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Đăng kí đề tài</h3>
	</div>
	<div class="container">
		<form action="dangkidetai_controller/insertData_controller" method="POST" enctype="multidata/form-data">
			<table>
				<tr>
					<?php foreach ($dulieutucontroller as $key => $a): ?>
						<?php if ($key % 3 == 0 && $key != 0): ?>
							</tr><tr> <!-- Mỗi dòng sẽ chứa 3 card-block -->
						<?php endif; ?>
						<td>
							<div class="card card-block">
								<h3><input type="radio" name="chon" value="<?= $a['id'] ?>" /></h3>
								<h3 class="card-title">Tên đề tài: <?= $a['project_title'] ?></h3>
								<p class="card-text">Giảng viên: <?= $a['lecturer'] ?></p>
								<p class="card-text">MSGV: <?= $a['lecturer_id'] ?></p>
								<p class="card-text">Số lượng sinh viên làm đề tài: <?= $a['count'] ?></p>
							</div>
						</td>
					<?php endforeach; ?>
				</tr>
			</table>
			<input type="submit" name="submit_detai" value="Ghi nhận">
		</form>
	</div>
</body>
</html>
