<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Cập nhật đề tài</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
</head>

<body>
	<?php require('header.php') ?>;
	<h3 class="text" style="color:#286B81; text-transform:uppercase; font-weight:bold; margin-left: 280px;">
		Cập nhật thông tin đề tài
	</h3>
	<div class="container">
		<div class="row"></div>
			<?php foreach ($ketquatucontroller as $key => $value): ?>
				<div class="container"></div>
					<div class="row">
						<div class="col-sm-8 push-sm-2">
							<form action="../updateData" method="post" enctype="multidata/form-data">
								<div class="card" >
									<div class="card-block">
										<input name="id" type="hidden" class="form-control" id="formGroupExampleInput" placeholder="" value="<?= $value['id'] ?>">

										<fieldset class="form-group">
											<label for="formGroupExampleInput2">Tên đề tài: </label>
											<input name="project_title" type="text" class="form-control" id="formGroupExampleInput2" placeholder="" value="<?= $value['project_title'] ?>">
										</fieldset>
										<fieldset class="form-group">
											<label for="formGroupExampleInput3">Nội dung: </label>
											<textarea name="content" class="form-control" id="formGroupExampleInput3" rows="4" placeholder=""
												oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"><?= $value['content'] ?></textarea>
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