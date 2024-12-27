<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>đăng ký đề tài</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
	<style>
		
		.card-block {
			cursor: pointer;
			border: 1px solid #ccc;
			padding: 10px;
			margin: 5px;
			border-radius: 5px;
			transition: background-color 0.3s;
		}
		.card-block:hover {
			background-color: #f0f0f0;
		}
		.card-block.selected {
			background-color: #025aa5;
			color: white;
			border-color: #025aa5;
		}
	</style>
	<script>
		function selectCard(card, radioId) {
			// Bỏ chọn tất cả các card-block
			var cards = document.querySelectorAll('.card-block');
			cards.forEach(function(c) {
				c.classList.remove('selected');
			});

			// Chọn card-block hiện tại
			document.getElementById(radioId).checked = true;
			card.classList.add('selected');
		}
	</script>
</head>
<body>
	<?php require('header.php')?>
	<div class="container">
		<form action="dangkidetai_controller/insertData_controller" method="POST" enctype="multidata/form-data">
			<div class="header-row">
				<h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">đăng ký đề tài</h3>
				<input type="submit" name="submit_detai" value="Ghi nhận" style="margin-left: 1000px; margin-top: -60px;" class="btn btn-primary">
			</div>
			<table>
				<tr>
					<?php foreach ($dulieutucontroller as $key => $a): ?>
						<?php if ($key % 3 == 0 && $key != 0): ?>
							</tr><tr> <!-- Mỗi dòng sẽ chứa 3 card-block -->
						<?php endif; ?>
						<td>
							<div class="card card-block" onclick="selectCard(this, 'radio_<?= $a['id'] ?>')">
								<input type="radio" id="radio_<?= $a['id'] ?>" name="chon" value="<?= $a['id'] ?>" style="display: none;" />
								<h3 class="card-title">Tên đề tài: <?= $a['project_title'] ?></h3>
								<p class="card-text">Giảng viên: <?= $a['lecturer'] ?></p>
								<p class="card-text">MSGV: <?= $a['lecturer_id'] ?></p>
								<p class="card-text">Số lượng sinh viên làm đề tài: <?= $a['count'] ?></p>
							</div>
						</td>
					<?php endforeach; ?>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
