<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
    <script type="text/javascript" src="http://localhost:3000/1.js"></script>
    <link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
    <link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
    <link rel="stylesheet" href="http://localhost:3000/start2_css.css">
    <link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
    <style>
        .form-control {
            margin-top: -30px;
            width: 35%;
        }
        .table {
            margin-top: -20px;
        }
    </style>
</head>

<body>
    <?php require('header.php') ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Quản lý sinh viên</h3>
            <div style="margin-top: -40px;margin-left: 700px;">
                <button class="btn btn-primary" onclick="location.href='themsv_controller'">Thêm</button>
                <button class="btn btn-warning" onclick="editSelected()">Sửa</button>
                <button class="btn btn-danger" onclick="deleteSelected()">Xóa</button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Tìm kiếm theo tên hoặc mã số sinh viên">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Mã số sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Khoa</th>
                    <th>Ngành</th>
                    <th>Lớp</th>
                </tr>
            </thead>
            <tbody id="studentList">
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><input type="checkbox" class="studentCheckbox" value="<?= $student['student_id'] ?>"></td>
                        <td><?= $student['student_id'] ?></td>
                        <td><?= $student['student'] ?></td>
                        <td><?= $student['department'] ?></td>
                        <td><?= $student['major'] ?></td>
                        <td><?= $student['class'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.studentCheckbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        function editSelected() {
            const selected = getSelectedStudents();
            if (selected.length === 1) {
                location.href = 'suasv_controller/edit/' + selected[0];
            } else {
                alert('Vui lòng chọn một sinh viên để sửa.');
            }
        }

        function deleteSelected() {
            const selected = getSelectedStudents();
            if (selected.length > 0) {
                if (confirm('Bạn có chắc chắn muốn xóa các sinh viên đã chọn?')) {
                    // Gửi yêu cầu xóa
                    location.href = 'suasv_controller/delete/' + selected.join(',');
                }
            } else {
                alert('Vui lòng chọn ít nhất một sinh viên để xóa.');
            }
        }

        function getSelectedStudents() {
            const selected = [];
            const checkboxes = document.querySelectorAll('.studentCheckbox:checked');
            checkboxes.forEach(checkbox => selected.push(checkbox.value));
            return selected;
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#studentList tr');
            rows.forEach(row => {
                const studentId = row.cells[1].textContent.toLowerCase();
                const studentName = row.cells[2].textContent.toLowerCase();
                if (studentId.includes(filter) || studentName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>