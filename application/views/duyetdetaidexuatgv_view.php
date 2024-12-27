<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Duyệt Đề Tài Đề Xuất Giảng Viên</title>
    <script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/showdata_css.css">
</head>
<body>
<?php require('header.php')?>
    <div class="container">
    <h3 class="text" style="color:#286B81; text-transform:uppercase; font-weight:bold;">Đề tài giảng viên đề xuất</h3>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên Đề Tài</th>
                    <th>Giảng Viên</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detai as $d): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($d['ten_detai']); ?></td>
                        <td><?php echo htmlspecialchars($d['giang_vien']); ?></td>
                        <td>
                            <a href="<?php echo site_url('DuyetDeTaiDeXuatGV_controller/duyet/' . $d['id']); ?>" class="btn btn-success">Duyệt</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 