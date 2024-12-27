<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<meta name="google-site-verification" content="9KdWV5qOckc64BeUVl5ZP8bgTgJGs9zbDx83SNON6S0">
	<link rel="shortcut icon" href="http://localhost:3000/Images/fav.png" type="image/x-icon">
	<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/1.css">
</head>

<body>
	<div class="container">
	</div>
	<div class="container">

		<div class="navbar navbar-default" style="background-color:#124874;"></div>
		<div class="row">
			<div class="login_thongbao">
			<form method="post" enctype="multidata/form-data">
			<h4 style="text-transform:uppercase; font-weight:bold;">Thông báo</h4>

        <ul>
          <li><a href="https://youtu.be/bQSrIOel5UA?si=-x-RHaCuugqU8gPn" target="_blank">(Video) Giao diện bài thi MOS 2016&nbsp;</a><strong></a>&nbsp;</strong></li>
          <li><a href="https://online.hcmue.edu.vn/TinTuc/4/9069" target="_blank">Thông báo về việc điều chỉnh các mốc thời gian triển khai xét và công nhận tốt nghiệp cho sinh viên hệ chính&nbsp;</a></li>
          <li><a href="https://ctsv.hcmue.edu.vn/storage/files/04-quy-trinh-xet-hoc-bong-khuyen-khich-hoc-tap.pdf" target="_blank">Hướng dẫn đăng ký học bổng</a></li>
          <li><a href="https://ctsv.hcmue.edu.vn/storage/files/so-tay-sinh-vien-khoa-43.pdf" target="_blank">Sổ tay sinh viên HCMUE</a><strong></strong></li>
        </ul>
        <h4>&nbsp;Cổng đăng ký học phần</h4>
        <ul>
          <li><a href="https://dkhp.hcmue.edu.vn" target="_blank">https://dkhp.hcmue.edu.vn</a></li>
        </ul>
        <h4>Cổng thông tin dành cho sinh viên đã tốt nghiệp Đại học</h4>
        <ul>
          <li><a href="https://hcmue.edu.vn/vi/tuyen-sinh/sau-dai-hoc" target="_blank">https://hcmue.edu.vn/vi/tuyen-sinh/sau-dai-hoc</a></li>
        </ul>

      </form>
			</div>


			<div class="login_dangnhap">
				<form action="http://localhost:3000/login_controller/kiemtra" method="post" enctype="multidata/form-data">
					<h4 style="text-transform:uppercase; font-weight:bold;">Đăng nhập</h4>
					<div class="card">
						<div class="card-block">

							<fieldset class="form-group">
								<label for="formGroupExampleInput">Username:</label>
								<i class="icon-user text-muted"></i>
								<input type="text" name="taikhoan" class="form-control" id="formGroupExampleInput" placeholder="Tài khoản" value="<?php echo isset($taikhoan) ? $taikhoan : ''; ?>" required>

							</fieldset>
							<fieldset class="form-group">
								<label for="formGroupExampleInput1">Password:</label>
								<div style="display: flex; align-items: center;">
									<i class="icon-lock text-muted1" style="margin-right: 8px;"></i>
									<input type="password" name="matkhau" class="form-control" id="password" autocomplete="off" placeholder="Mật khẩu" value="<?php echo isset($matkhau) ? $matkhau : ''; ?>" required>
									<span toggle="#password" class="fa fa-eye field-icon toggle-password" style="margin-left: -35px; cursor: pointer;"></span>
								</div>
							</fieldset>
							<?php if (isset($error_message)) { ?>
								<div class="alert alert-danger" style="color: red;">
									<?php echo $error_message; ?>
								</div>
							<?php } ?>
							<input id="button_login" type="submit" class="btn btn-success btn-block" value="Đăng nhập">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".toggle-password").click(function() {
				$(this).toggleClass("fa-eye fa-eye-slash");
				var input = $($(this).attr("toggle"));
				if (input.attr("type") === "password") {
					input.attr("type", "text");
				} else {
					input.attr("type", "password");
				}
			});
		});
	</script>


</body>

</html>