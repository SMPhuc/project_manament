<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nhập thông tin</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
    <link rel="stylesheet" href="http://localhost:3000/start2_css.css">
    <link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
</head>
<body>
	<?php require('header.php') ?>;
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold; ">Sửa thông tin sinh viên</h3>
	</div>
	<div class="container">
		<div class="row">
			<?php foreach ($mangkq as $key => $value): ?>
				<div class="container">
					<div class="row">
						<div class="col-sm-8 push-sm-2">
							<form action="http://localhost:3000/suasv_controller/update" method="post" enctype="multidata/form-data">
								<div class="card">
								<div class="card-block">
									<fieldset class="form-group">
										<label for="formGroupExampleInput2">Mã số sinh viên: </label>
										<input name="student_id" type="text" class="form-control" autocomplete="off" id="formGroupExampleInput2" value="<?= $value['student_id'] ?>" >
									</fieldset>
									<fieldset class="form-group">
										<label for="formGroupExampleInput3">Sinh viên: </label>
										<input name="student" type="text" autocomplete="off" class="form-control" id="formGroupExampleInput3" value="<?= $value['student'] ?>">
									<fieldset class="form-group">
										<label for="formGroupExampleInput4">Khoa:</label>
										<input name="department" type="text" class="form-control" id="formGroupExampleInput4" autocomplete="off" value="<?= $value['department'] ?>">
									</fieldset>
									<fieldset class="form-group">
										<label for="formGroupExampleInput4">Ngành:</label>
										<input name="major" type="text" class="form-control" id="formGroupExampleInput4" autocomplete="off" value="<?= $value['major'] ?>">
									</fieldset>
									<fieldset class="form-group">
										<label for="formGroupExampleInput5">Lớp:</label>
										<input name="class" type="text" class="form-control" id="formGroupExampleInput5" autocomplete="off" value="<?= $value['class'] ?>">
									</fieldset>
								<input type="submit" class="btn btn-success btn-block" value="Lưu">
								</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			
		</div>
	</div>
</body>
</html>