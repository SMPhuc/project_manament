<div class="navbar navbar-default" style="background-color:#286B81;">
</div>
<div class="sidenav">
  <a href="http://localhost:3000/addData_controller/start">Trang chủ</a>
  <?php if ($_SESSION['role'] == 'sinhvien'): ?>
    <button class="dropdown-btn">Sinh viên
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="http://localhost:3000/dexuatdetai_controller">Đề xuất đề tài</a>
      <a href="http://localhost:3000/dangkidetai_controller">Đăng ký đề tài</a>
      <a href="http://localhost:3000/quatrinhthuchien_controller">Quá trình thực hiện</a>
    </div>
  <?php endif; ?>

  <?php if ($_SESSION['role'] == 'giangvien'): ?>
    <button class="dropdown-btn">Giảng viên
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <!-- <a href="http://localhost:3000/dexuatdetaiGV_controller">Đề xuất đề tài</a> -->
      <a href="http://localhost:3000/duyetdetaidexuat_controller">Duyệt đề tài đề xuất</a>
      <a href="http://localhost:3000/showsinhviendangki_controller">Duyệt đề tài đã đăng ký</a>
      <a href="http://localhost:3000/Submission_Controller">Theo dõi quá trình</a>
    </div>
    <a href="http://localhost:3000/dssinhvienduocduyet_controller">Danh sách sinh viên đã duyệt đề tài</a>
  <?php endif; ?>

  <?php if ($_SESSION['role'] == 'giaovu'): ?>
    <button class="dropdown-btn">Giáo vụ
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="http://localhost:3000/addData_controller">Thêm đề tài</a>
      <!-- <a href="http://localhost:3000/DuyetDeTaiDeXuatGV_controller">Duyệt đề tài đề xuất</a> -->
      <a href="http://localhost:3000/StudentManagement_Controller">Quản lý sinh viên</a>
      <a href="http://localhost:3000/LecturerManagement_Controller">Quản lý giảng viên</a>
      <!-- <a href="http://localhost:3000/themsv_controller">Thêm sinh viên</a> -->
      <!-- <a href="http://localhost:3000/themgv_controller">Thêm giảng viên</a> -->
      <!-- <a href="http://localhost:3000/suasv_controller">Sửa sinh viên</a> -->
      <!-- <a href="http://localhost:3000/suagv_controller">Sửa giảng viên</a> -->
      <!-- <a href="http://localhost:3000/xoasv_controller">Xóa sinh viên</a> -->
      <!-- <a href="http://localhost:3000/xoagv_controller">Xóa giảng viên</a> -->
    </div>
    <a href="http://localhost:3000/dssinhvienduocduyet_controller">Danh sách sinh viên đã duyệt đề tài</a>
  <?php endif; ?>

  <a href="http://localhost:3000/showData_controller">Xem đề tài</a>
  <a href="http://localhost:3000/doimk_controller">Đổi mật khẩu</a>
  <a href="http://localhost:3000/login_controller">Đăng xuất</a>
</div>
<div class="main">
</div>
<script>
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;
  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
</script>