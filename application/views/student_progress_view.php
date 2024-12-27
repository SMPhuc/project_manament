<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Theo dõi quá trình thực hiện</title>
    <script type="text/javascript" src="http://localhost:3000/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="http://localhost:3000/1.js"></script>
	<link rel="stylesheet" href="http://localhost:3000/vendor/bootstrap.css">
	<link rel="stylesheet" href="http://localhost:3000/vendor/font-awesome.css">
	<link rel="stylesheet" href="http://localhost:3000/start2_css.css">
	<link rel="stylesheet" href="http://localhost:3000/adddata_css.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .form-container {
            padding: 16px;
            margin-bottom: 16px;
            max-width: 100%;
            margin-left: 80px;
        }
        .form-header h1 {
            font-size: 1.25rem;
            line-height: 1.5;
        }
        .created-at {
            color: #6B7280;
        }
        .deadline {
            font-weight: bold;
            color: #1F2937;
        }
        .date-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -20px;
            font-size: 12px;
        }
        .feedback p {
            word-wrap: break-word;
            max-width: 200px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <?php require('header.php')?>

    <div class="max-w-4xl mx-auto p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4" style="color:#286B81;text-transform:uppercase; font-weight:bold; margin-top:110px; margin-left:-50px; font-size:27px">Theo dõi quá trình thực hiện đề tài</h3>

        <?php if (!empty($submissionRequests)): ?>
            <?php foreach ($submissionRequests as $index => $request): ?>
                <div class="border border-gray-200 rounded-lg bg-white mb-4 form-container">
                    <div class="flex justify-between items-start mb-4 form-header" style="margin-bottom:-10px">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($request['title']); ?></h1>

                            <?php
                            $created_at = new DateTime($request['created_at']);
                            $formatted_created_at = $created_at->format('F jS');

                            $deadline = new DateTime($request['deadline']);
                            $formatted_deadline = $deadline->format('F j, Y g:i A');
                            ?>

                            <div class="date-container">
                                <p class="created-at"><?= $formatted_created_at; ?>&nbsp;</p>
                                <p class="deadline"> Due <?= $formatted_deadline; ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <?php if ($request['turn_in_at']): ?>
                                <span class="text-green-500">
                                    Turned in <?= date('D M j, Y \a\t g:i A', strtotime($request['turn_in_at'])); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-6 form-description flex justify-between items-center">
                        <div class="instructions">
                            <h2 class="font-medium text-gray-900 mb-1" style="margin-top:20px">Instructions</h2>
                            <p class="text-gray-600"><?= htmlspecialchars($request['description']); ?></p>
                        </div>

                        <div class="feedback ml-4" style="margin-right:50px">
                            <h3 class="text-lg font-semibold text-gray-900" style="font-weight:500">Feedback</h3>
                            <p class="text-gray-600" id="feedback-text-<?= $request['id']; ?>">
                                <?= htmlspecialchars($request['feedback'] ?? 'No comment'); ?>
                                <button class="text-blue-500 ml-2" onclick="showFeedbackForm(<?= $request['id']; ?>)">✏️</button>
                            </p>
                            <div id="feedback-form-<?= $request['id']; ?>" style="display: none;">
                                <textarea id="feedback-input-<?= $request['id']; ?>" class="form-control"><?= htmlspecialchars($request['feedback']); ?></textarea>
                                <button class="btn btn-primary mt-2" onclick="saveFeedback(<?= $request['id']; ?>)">Lưu</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 form-attachment">
                        <h2 class="font-medium text-gray-900 mb-4">Attachments</h2>
                        <div class="flex items-center">
                            <?php if (!empty($request['attach'])): ?>
                                <span><?= basename($request['attach']); ?></span>
                                <a href="<?= base_url('uploads/' . basename($request['attach'])); ?>" class="text-blue-500 ml-2" download>
                                    <i class="fa fa-download"></i>
                                </a>
                            <?php else: ?>
                                <span class="text-gray-600">Không có tệp đính kèm</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Không có dữ liệu để hiển thị.</p>
        <?php endif; ?>
    </div>

    <script>
        function showFeedbackForm(id) {
            document.getElementById('feedback-text-' + id).style.display = 'none';
            document.getElementById('feedback-form-' + id).style.display = 'block';
        }

        function saveFeedback(id) {
            const feedback = document.getElementById('feedback-input-' + id).value;
            // Gửi yêu cầu AJAX để lưu feedback
            fetch('/StudentProgressController/updateFeedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    submission_id: id,
                    feedback: feedback
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload(); // Tải lại trang khi thành công
                } else {
                    alert('Đã xảy ra lỗi khi cập nhật feedback.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>

</html> 