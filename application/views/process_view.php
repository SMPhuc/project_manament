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
</head>

<body>
    <?php require('header.php') ?>;
    <div class="container">
        <h3 class="text" style="color:#286B81;text-transform:uppercase; font-weight:bold; ">Theo dõi quá trình thực hiện đề tài</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Hạn chót</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $key => $request): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo htmlspecialchars($request['title']); ?></td>
                            <td><?php echo htmlspecialchars($request['description']); ?></td>
                            <td><?php echo htmlspecialchars($request['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($request['deadline']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có yêu cầu nào được tìm thấy.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>