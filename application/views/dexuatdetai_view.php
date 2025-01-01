<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đề xuất đề tài</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
 	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
	<style>
		.custom-box {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border: 1px solid #e2e8f0;
			border-radius: 8px;
			padding: 16px;
			margin-bottom: 16px;
		}
		.status-approved {
			color: green;
		}
		.status-pending {
			color: orange;
		}
		.status-rejected {
			color: red;
		}
	</style>
</head>
<body>
	<?php require('header.php') ?>;
	<div class="max-w-4xl mx-auto p-6">
		<h3 class="text-xl font-bold text-gray-900 mb-4" style="font-size: 28px; margin-top: 70px; color:#286B81; text-transform:uppercase; font-weight:bold;">
			Đề xuất đề tài
		</h3>

		<div class="bg-white shadow-md rounded-lg p-4">
			<?php if ($isRegistered): ?>
				<p class="text-red-500">Sinh viên đã đăng ký đề không thể đề xuất đề tài.</p>
			<?php elseif (!empty($proposals)): ?>
				<h4 class="text-lg font-semibold text-gray-900 mb-4">Danh sách đề tài đã đề xuất:</h4>
				<?php foreach ($proposals as $proposal): ?>
					<div class="custom-box">
						<h5 class="font-bold text-gray-900"><?= htmlspecialchars($proposal['project_title']); ?></h5>
						<p class="text-gray-600"><?= htmlspecialchars($proposal['content']); ?></p>
						<p class="status">
							Trạng thái: 
							<span class="<?php 
								echo $proposal['status'] == 1 ? 'status-approved' : 
									 ($proposal['status'] == 0 ? 'status-pending' : 'status-rejected'); ?>">
								<?= $proposal['status'] == 1 ? 'Approved' : 'Waiting'; ?>
							</span>
						</p>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<form action="http://localhost:3000/dexuatdetai_controller/insertData_controller" method="post" enctype="multipart/form-data">
					<div class="custom-box">
						<fieldset class="form-group mb-4">
							<label for="formGroupExampleInput" class="font-medium text-gray-900">Tên đề tài:</label>
							<input type="text" name="project_title" class="form-control" id="formGroupExampleInput" autocomplete="off">
						</fieldset>
						<fieldset class="form-group mb-4">
							<label for="formGroupExampleInput1" class="font-medium text-gray-900">Nội dung:</label>
							<textarea cols="50" rows="10" name="content" class="form-control" id="formGroupExampleInput1" autocomplete="off"></textarea>
						</fieldset>
						<input type="submit" class="btn btn-success btn-block" value="Lưu">
					</div>
				</form>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>