<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý giảng viên</title>
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
            <h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold;">Quản lý giảng viên</h3>
            <div style="margin-top: -40px;margin-left: 700px;">
                <button class="btn btn-primary" onclick="location.href='themgv_controller'">Thêm</button>
                <button class="btn btn-warning" onclick="editSelected()">Sửa</button>
                <button class="btn btn-danger" onclick="deleteSelected()">Xóa</button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Tìm kiếm theo tên hoặc mã số giảng viên">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Mã số giảng viên</th>
                    <th>Tên giảng viên</th>
                    <th>Khoa</th>
                    <th>Trường</th>
                </tr>
            </thead>
            <tbody id="lecturerList">
                <?php foreach ($lecturers as $lecturer): ?>
                    <tr>
                        <td><input type="checkbox" class="lecturerCheckbox" value="<?= $lecturer['lecturer_id'] ?>"></td>
                        <td><?= $lecturer['lecturer_id'] ?></td>
                        <td><?= $lecturer['lecturer'] ?></td>
                        <td><?= $lecturer['department'] ?></td>
                        <td><?= $lecturer['university'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.lecturerCheckbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        function editSelected() {
            const selected = getSelectedLecturers();
            if (selected.length === 1) {
                location.href = 'suagv_controller/edit/' + selected[0];
            } else {
                alert('Vui lòng chọn một giảng viên để sửa.');
            }
        }

        function deleteSelected() {
            const selected = getSelectedLecturers();
            if (selected.length > 0) {
                if (confirm('Bạn có chắc chắn muốn xóa các giảng viên đã chọn?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'http://localhost:3000/LecturerManagement_Controller/delete';

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids';
                    input.value = selected.join(',');

                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            } else {
                alert('Vui lòng chọn ít nhất một giảng viên để xóa.');
            }
        }

        function getSelectedLecturers() {
            const selected = [];
            const checkboxes = document.querySelectorAll('.lecturerCheckbox:checked');
            checkboxes.forEach(checkbox => selected.push(checkbox.value));
            return selected;
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#lecturerList tr');
            rows.forEach(row => {
                const lecturerId = row.cells[1].textContent.toLowerCase();
                const lecturerName = row.cells[2].textContent.toLowerCase();
                if (lecturerId.includes(filter) || lecturerName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html> 