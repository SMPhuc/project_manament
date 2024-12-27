<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Quá trình thực hiện</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
	<style>
		/* Thu nhỏ form để khít với nội dung */
		.form-container {
			padding: 16px;
			/* Giảm padding cho form */
			margin-bottom: 16px;
			/* Giảm margin giữa các form */
			max-width: 100%;
			/* Đảm bảo form không vượt quá kích thước màn hình */
			margin-left: 80px
		}

		.form-content {
			padding: 8px 0;
			/* Giảm padding trong mỗi phần của form */
		}

		.form-header h1 {
			font-size: 1.25rem;
			/* Giảm kích thước tiêu đề */
			line-height: 1.5;
			/* Điều chỉnh chiều cao dòng */
		}

		.form-description p,
		.form-attachment p {
			font-size: 0.875rem;
			/* Giảm kích thước font cho mô tả và tệp đính kèm */
		}

		.form-button {
			padding: 8px 16px;
			/* Giảm kích thước nút */
			font-size: 0.875rem;
			/* Giảm kích thước font của nút */
		}

		input[type="file"] {
			padding: 4px;
			/* Thu nhỏ kích thước input file */
		}

		/* Đảm bảo các phần tử trong form không bị rộng quá */
		.flex {
			flex-wrap: wrap;
		}

		/* Thời gian created_at sẽ làm mờ */
		.created-at {
			color: #6B7280;
			/* Màu xám mờ */
		}

		/* Thời gian deadline sẽ đậm */
		.deadline {
			font-weight: bold;
			color: #1F2937;
			/* Màu đen đậm */
		}

		/* Chỉnh các phần tử created_at và deadline nằm trên một hàng */
		.date-container {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-top: -20px;
			font-size: 12px;
		}
	</style>
</head>

<body class="bg-gray-50">
	<?php require('header.php')?>

	<div class="max-w-4xl mx-auto p-6">
		<h3 class="text-xl font-bold text-gray-900 mb-4" style="color:#286B81;text-transform:uppercase; font-weight:bold; margin-top:110px; margin-left:-50px; font-size:27px">Theo dõi quá trình thực hiện đề tài</h3>

		<!-- Kiểm tra nếu có dữ liệu -->
		<?php if (!empty($submissionRequests)): ?>
			<?php foreach ($submissionRequests as $index => $request): ?>
				<!-- Form row for each submission request -->
				<form action="http://localhost:3000/quatrinhthuchien_controller/uploadAttachment" method="POST" enctype="multipart/form-data">
					<div class="border border-gray-200 rounded-lg bg-white mb-4 form-container">
						<div class="flex justify-between items-start mb-4 form-header" style="margin-bottom:-10px">
							<div>
								<h1 class="text-2xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($request['title']); ?></h1>

								<?php
								// Định dạng lại thời gian 'created_at'
								$created_at = new DateTime($request['created_at']);
								$formatted_created_at = $created_at->format('F jS'); // "May 7th"

								// Định dạng lại thời gian 'deadline'
								$deadline = new DateTime($request['deadline']);
								$formatted_deadline = $deadline->format('F j, Y g:i A'); // "December 12, 2024 4:25 PM"
								?>

								<!-- Chỉnh created_at và deadline nằm cùng hàng -->
								<div class="date-container">
									<p class="created-at"><?= $formatted_created_at; ?>&nbsp;</p>
									<p class="deadline"> Due <?= $formatted_deadline; ?></p>
								</div>
							</div>
							<div class="text-right">
								<?php if ($request['turn_in_at']): ?>
									<?php
									$turn_in_time = strtotime($request['turn_in_at']);
									$deadline_time = strtotime($request['deadline']);
									$color_class = $turn_in_time > $deadline_time ? 'text-red-500' : 'text-green-500';
									?>
									<span class="<?= $color_class ?>">
										Turned in <?= date('D M j, Y \a\t g:i A', $turn_in_time); ?>
									</span>
								<?php else: ?>
									<!-- Nếu chưa gửi, hiển thị nút gửi -->
									<button type="submit" class="px-2 py-6 bg-indigo-600 text-white rounded hover:bg-indigo-700 form-button">
										Gửi
									</button>
								<?php endif; ?>
							</div>

						</div>

						<!-- Description -->
						<div class="mb-6 form-description flex justify-between items-center">
							<div class="instructions">
								<h2 class="font-medium text-gray-900 mb-1" style="margin-top:20px">Instructions</h2>
								<p class="text-gray-600"><?= htmlspecialchars($request['description']); ?></p>
							</div>

							<!-- Feedback -->
							<?php if ($request['turn_in_at']): ?>
								<!-- Feedback hiển thị chỉ khi đã gửi -->
								<div class="feedback ml-4" style="margin-right:50px">
									<h3 class="text-lg font-semibold text-gray-900" style="font-weight:500">Feedback</h3>
									<p class="text-gray-600">
										<?php if ($request['feedback']): ?>
											<?= htmlspecialchars($request['feedback']); ?>
										<?php else: ?>
											No comment
										<?php endif; ?>
									</p>
								</div>
							<?php endif; ?>
						</div>


						<!-- Attachment input -->
						<div class="mb-6 form-attachment">
							<h2 class="font-medium text-gray-900 mb-4">Attachments</h2>
							<div class="flex items-center">
								<?php if ($request['turn_in_at']): ?>
									<!-- Nếu đã gửi, hiển thị tên tệp đã upload và ẩn input file -->
									<span class="text-gray-600"><?= basename($request['attach']); ?></span>
								<?php else: ?>
									<!-- Nếu chưa gửi, hiển thị input file -->
									<input type="file" class="form-control-file" id="attachment_<?= $index ?>" name="attachment_<?= $request['id'] ?>" required>
								<?php endif; ?>
							</div>
						</div>


						<!-- Hidden input for request ID -->
						<input type="hidden" name="submission_id" value="<?= $request['id']; ?>">
					</div>
				</form>

			<?php endforeach; ?>
		<?php else: ?>
			<p class="text-center">Không có dữ liệu để hiển thị.</p>
		<?php endif; ?>
	</div>
</body>

</html>