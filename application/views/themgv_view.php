<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thêm giảng viên</title>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<style>
		.table-danger {
			background-color: #ff0018 !important;
		}
		.modal-dialog {
			max-width: 1200px;
			margin: 30px auto;
		}
	</style>
</head>
<body>
	<?php require('header.php') ?>;
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Nhập thông tin giảng viên</h3>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 push-sm-2">
				<form action="themgv_controller/insert" method="post" enctype="multipart/form-data">
					<div class="card">
						<div class="card-block">
							<fieldset class="form-group">
								<label for="formGroupExampleInput">Mã số giảng viên:</label>
								<input type="text" name="msgv" class="form-control" id="formGroupExampleInput" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput1">Tên giảng viên:</label>
								<input type="text" name="giangvien" class="form-control" id="formGroupExampleInput1" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput1">Khoa:</label>
								<input type="text" name="khoa" class="form-control" id="formGroupExampleInput1" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput1">Trường:</label>
								<input type="text" name="truong" class="form-control" id="formGroupExampleInput1" autocomplete="off">
							</fieldset>
							<input type="submit" class="btn btn-success btn-block" value="Lưu">
						</div>
					</div>
				</form>

				<!-- Form để tải lên file Excel -->
				<form action="http://localhost:3000/themgv_controller/uploadExcel" method="post" enctype="multipart/form-data">
					<div class="card">
						<div class="card-block">
							<fieldset class="form-group">
								<label for="excelFile">Chọn file Excel:</label>
								<div style="display: flex; align-items: center;">
									<input type="file" name="excelFile" class="form-control" id="excelFile" accept=".xls,.xlsx" style="flex: 1;">
									<a href="/public/files/File_mau_nhap_giang_vien.xlsx" class="btn btn-info" download style="margin-left: 10px;">Download file mẫu</a>
								</div>
							</fieldset>
							<input type="submit" class="btn btn-primary btn-block" value="Thêm giảng viên từ file">
						</div>
					</div>
				</form>

				<?php if (isset($error)): ?>
					<div class="alert alert-danger"><?php echo $error; ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="excelDataModal" tabindex="-1" role="dialog" aria-labelledby="excelDataModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="excelDataModalLabel">Xem Trước Dữ Liệu Excel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php if (isset($data)): ?>
						<form action="http://localhost:3000/themgv_controller/saveExcelData" method="post">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Mã số giảng viên</th>
										<th>Tên giảng viên</th>
										<th>Khoa</th>
										<th>Trường</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data as $index => $row): ?>
										<tr class="<?php echo in_array($index + 1, $duplicateRows) ? 'table-danger' : ''; ?>">
											<td><?php echo htmlspecialchars($row[0]); ?></td>
											<td><?php echo htmlspecialchars($row[1]); ?></td>
											<td><?php echo htmlspecialchars($row[2]); ?></td>
											<td><?php echo htmlspecialchars($row[3]); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<button type="submit" class="btn btn-success" <?php echo !empty($duplicateRows) ? 'disabled' : ''; ?>>Duyệt</button>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			<?php if (isset($data)): ?>
				$('#excelDataModal').modal('show');
			<?php endif; ?>
		});
	</script>
</body>
</html>