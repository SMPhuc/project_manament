<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tìm kiếm sinh viên cần sửa</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
		<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
		 	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">

</head>
<body>
	<?php require('header.php') ?>;
	<div class="container" style="padding: 100px">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 push-sm-2">
					<form action="suasv_controller/edit" method="post" enctype="multidata/form-data">
						<div class="card">
						<div class="card-block">
 							<fieldset class="form-group">
								<label for="formGroupExampleInput2">Mã số sinh viên: </label>
								<input name="student_id" type="text" class="form-control" id="formGroupExampleInput2" autocomplete="off">
							</fieldset>
							<input type="submit" class="btn btn-success btn-block" value="Tìm kiếm">
						</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
</html>