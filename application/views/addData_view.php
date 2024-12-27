<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thêm đề tài</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
 	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
 	<link rel="stylesheet" href="http://localhost:3000/start_css.css">
	<style>
		/* Tùy chỉnh CSS nếu cần */
		.modal-lg {
			max-width: 90%; /* Tăng kích thước modal lên 90% chiều rộng màn hình */
		}
		/* Tùy chỉnh CSS cho modal */
		.modal-dialog {
			max-width: 1200px; /* Đặt chiều rộng tối đa cho modal */
			margin: 30px auto; /* Căn giữa modal với khoảng cách trên dưới */
		}
		.ui-autocomplete {
			background-color: white;
			border: 1px solid #ccc;
			max-height: 150px;
			overflow-y: auto;
			overflow-x: hidden;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			z-index: 1000;
			padding-left: 0;
		}
		.ui-menu-item {
			padding: 8px 12px;
			cursor: pointer;
			list-style-type: none;
		}
		.ui-menu-item:hover {
			background-color: #f0f0f0;
		}
		#ui-id-1 {
			width: 150px;
			border: 2px solid #ccc;
		}
	</style>
</head>
<body>
	<?php require('header.php') ?>;
	<div class="container">
		<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold; ">Thêm đề tài</h3>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-8 push-sm-2">
				<form action="http://localhost:3000/addData_controller/insertDetai_controller" method="post" enctype="multipart/form-data">
					<div class="card">
						<div class="card-block">
							<fieldset class="form-group">
								<label for="formGroupExampleInput">Tên đề tài:</label>
								<input type="text" name="project_title" class="form-control" id="formGroupExampleInput" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput1">Nội dung:</label>
								<textarea cols="50" rows="5" name="content" class="form-control" id="formGroupExampleInput1" autocomplete="off"></textarea>
							</fieldset>
							<fieldset class="form-group">
								<label for="lecturerName">Tên giảng viên:</label>
								<input type="text" name="lecturer_name" class="form-control" id="lecturerName" autocomplete="off">
							</fieldset>
							<fieldset class="form-group">
								<label for="lecturerId">Mã số giảng viên:</label>
								<input type="text" name="lecturer_id" class="form-control" id="lecturerId" autocomplete="off">
							</fieldset>
							<input type="submit" class="btn btn-success btn-block" value="Lưu">
						</div>
					</div>
				</form>
				<form action="http://localhost:3000/addData_controller/uploadExcel" method="post" enctype="multipart/form-data">
					<div class="card">
						<div class="card-block">
							<fieldset class="form-group">
								<label for="excelFile">Chọn file Excel:</label>
								<div style="display: flex; align-items: center;">
									<input type="file" name="excelFile" class="form-control" id="excelFile" accept=".xls,.xlsx" style="flex: 1;">
									<a href="/public/files/File_mau_nhap_de_tai.xlsx" class="btn btn-info" download style="margin-left: 10px;">Download file mẫu</a>
								</div>
							</fieldset>
							<input type="submit" class="btn btn-primary btn-block" value="Thêm đề tài từ file">
						</div>
					</div>
				</form>

				<?php if (isset($error)): ?>
					<div class="alert alert-danger"><?php echo $error; ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Modal để hiển thị dữ liệu Excel -->
	<div class="modal fade" id="excelDataModal" tabindex="-1" role="dialog" aria-labelledby="excelDataModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="excelDataModalLabel">Xem trước dữ liệu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php if (isset($data) && isset($headers)): ?>
						<form action="http://localhost:3000/addData_controller/saveExcelData" method="post">
							<table class="table table-bordered">
								<thead>
									<tr>
										<?php foreach ($headers as $header): ?>
											<th><?php echo htmlspecialchars($header); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data as $row): ?>
										<tr>
											<?php foreach ($row as $cell): ?>
												<td><?php echo htmlspecialchars($cell); ?></td>
											<?php endforeach; ?>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<button type="submit" class="btn btn-success">Duyệt</button>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		// Hiển thị modal nếu có dữ liệu
		<?php if (isset($data)): ?>
			$(document).ready(function() {
				$('#excelDataModal').modal('show');
			});
		<?php endif; ?>
	</script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$(document).ready(function() {
		$("#lecturerName").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "http://localhost:3000/addData_controller/getLecturers",
					dataType: "json",
					success: function(data) {
						response($.map(data, function(item) {
							return {
								label: item.lecturer + " (" + item.lecturer_id + ")",
								value: item.lecturer,
								id: item.lecturer_id
							};
						}));
					}
				});
			},
			select: function(event, ui) {
				$("#lecturerName").val(ui.item.value);
				$("#lecturerId").val(ui.item.id);
				return false;
			}
		});
	});
	</script>
</body>
</html>