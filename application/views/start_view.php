
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Start</title>
  <script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
  <script type="text/javascript" src="http://localhost:3000/1.js"></script>
  <link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
  <link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
  <link rel="stylesheet" href="http://localhost:3000/start_css.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php require('header.php') ?>;
  <div class="main">
    <!--  <div class="line_2" style="background-color:#286B81;"></div> -->
    <div class="user-info">
        <span>Xin chào! <strong><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Khách'; ?></strong></span>
    </div>
    <div class="login_thongbao">
      <form method="post" enctype="multidata/form-data">
        <h2 style="text-align:center; font-weight:bold; font-size:40px;">TRANG ĐĂNG KÝ ĐỀ TÀI TIỂU LUẬN, KHOÁ LUẬN</h2>
        <h4 style="text-transform:uppercase; margin-top:30px; font-weight:bold;">Thông báo</h4>

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

  </div>


</body>

</html>