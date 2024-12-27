<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đổi mật khẩu</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
 	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
 	<link rel="stylesheet" href="http://localhost:3000/start_css.css">
</head>
<body>
	<?php require('header.php') ?>;
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold; ">Đổi mật khẩu</h3>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 push-sm-2" id = "doimk">
				<form action="doimk_controller/doimk" method="post" enctype="multidata/form-data">
					<div class="card">
						<div class="card-block">
							<fieldset class="form-group">
								<label for="formGroupExampleInput1">Mật khẩu cũ:</label>
								<input type="Password" name="mkcu" class="form-control" id="formGroupExampleInput1" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput2">Mật khẩu mới</label>
								<input type="Password" name="mkmoi" class="form-control" id="formGroupExampleInput2" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput3">Nhập lại mật khẩu mới:</label>
								<input type="Password" name="mkmoi2" class="form-control" id="formGroupExampleInput3" autocomplete="off">
							</fieldset>
							<input type="submit" class="btn btn-success btn-block" value="Lưu">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>