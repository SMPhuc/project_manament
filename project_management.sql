-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 20, 2024 lúc 03:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_list`
--

CREATE TABLE `account_list` (
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_list`
--

INSERT INTO `account_list` (`account`, `password`) VALUES
('17020021', '17020021'),
('17020029', '17020029'),
('17020059', '17020059'),
('17021074', '17021074'),
('17021075', '17021075'),
('21006', '21006'),
('21007', '21007'),
('4102024', '4102024'),
('7021006', '7021006'),
('7021089', '7021089'),
('789465132', '789465132'),
('smphuc', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `approved_student_list`
--

CREATE TABLE `approved_student_list` (
  `project` varchar(255) NOT NULL,
  `lecturer` varchar(255) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `approved_students` text NOT NULL,
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `approved_student_list`
--

INSERT INTO `approved_student_list` (`project`, `lecturer`, `lecturer_id`, `approved_students`, `id`, `project_id`, `student_id`) VALUES
('Thesis Registration Project', 'TS Trần Văn Huấn', 7021006, 'Lê Mai Anh', 1, 4, 17020059),
('Thesis Registration Project', 'TS Trần Văn Huấn', 7021006, 'Nguyễn Quỳnh Trang', 2, 4, 17021074),
('Library Management Project', 'TS Nguyễn Lan Anh', 7020050, 'SMPhuc', 3, 6, 4102024),
('Xây dựng Ứng dụng Quản lý Công việc Nhóm với Scrum', 'TS Trần Văn Huấn', 7021006, 'Ngô Thu Hà', 4, 8, 17020021);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculty_transfer_list`
--

CREATE TABLE `faculty_transfer_list` (
  `faculty_id` int(11) NOT NULL,
  `faculty_member` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `faculty_transfer_list`
--

INSERT INTO `faculty_transfer_list` (`faculty_id`, `faculty_member`, `department`, `university`) VALUES
(21006, 'CV Lê Mai Anh', 'Information Technology', 'University of Technology'),
(21007, 'Lê Cúc', 'IT', 'IT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lecturer_list`
--

CREATE TABLE `lecturer_list` (
  `lecturer_id` int(11) NOT NULL,
  `lecturer` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lecturer_list`
--

INSERT INTO `lecturer_list` (`lecturer_id`, `lecturer`, `department`, `university`) VALUES
(7021006, 'TS Trần Văn Huấn', 'IT', 'University of Technology'),
(7021089, 'TS Cao Mạnh Hùng', 'IT', 'University of Technology');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pending_student_list`
--

CREATE TABLE `pending_student_list` (
  `student_id` int(11) NOT NULL,
  `student` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `lecturer` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pending_student_list`
--

INSERT INTO `pending_student_list` (`student_id`, `student`, `project`, `lecturer_id`, `lecturer`, `project_id`) VALUES
(17020029, 'Lê Phương Hằng', 'Phát triển Ứng dụng Di động Hỗ trợ Tập Luyện Cá Nhân', 7021006, 'TS Trần Văn Huấn', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project_list`
--

CREATE TABLE `project_list` (
  `id` double NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `lecturer` varchar(255) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `project_list`
--

INSERT INTO `project_list` (`id`, `project_title`, `content`, `lecturer`, `lecturer_id`, `count`) VALUES
(6, 'Library Management Project', 'Dự án Quản lý Thư viện nhằm thiết kế và triển khai hệ thống quản lý sách, độc giả và giao dịch mượn/trả sách. Các chức năng chính bao gồm quản lý sách, độc giả, giao dịch mượn/trả, và tạo báo cáo thống kê. Hệ thống sử dụng công nghệ web hiện đại và cơ sở ', 'TS Nguyễn Lan Anh', 7020050, 1),
(8, 'Xây dựng Ứng dụng Quản lý Công việc Nhóm với Scrum', 'Phát triển một ứng dụng web hỗ trợ các nhóm làm việc áp dụng phương pháp Scrum, bao gồm quản lý backlog, theo dõi tiến độ sprint, và giao tiếp nhóm.', 'TS Trần Văn Huấn', 7021006, 0),
(9, 'Phát triển Ứng dụng Di động Hỗ trợ Tập Luyện Cá Nhân', 'Xây dựng ứng dụng di động cung cấp các bài tập thể dục cá nhân hóa dựa trên thể trạng và mục tiêu của người dùng, tích hợp theo dõi tiến trình qua API thiết bị đeo tay.', 'TS Trần Văn Huấn', 7021006, 0),
(11, 'Demo', 'ádfghjkl', 'TS Trần Văn Huấn', 7021006, 0),
(12, 'Phân Tích Tâm Lý Người Dùng qua Văn Bản Bằng Xử Lý Ngôn Ngữ Tự Nhiên (NLP)', 'Áp dụng các kỹ thuật NLP để phân tích các bài viết hoặc bình luận của người dùng trên mạng xã hội, từ đó xác định trạng thái cảm xúc hoặc tính cách dựa trên dữ liệu.', 'TS Trần Văn Huấn', 7021006, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `proposed_project_list`
--

CREATE TABLE `proposed_project_list` (
  `id` int(11) NOT NULL,
  `project_title` text NOT NULL,
  `content` text NOT NULL,
  `student` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `proposed_project_list`
--

INSERT INTO `proposed_project_list` (`id`, `project_title`, `content`, `student`, `student_id`) VALUES
(11, 'Ứng dụng Blockchain trong Quản Lý Chứng Chỉ và Văn Bằng', 'Phát triển hệ thống quản lý chứng chỉ và văn bằng trên nền tảng blockchain, đảm bảo tính toàn vẹn, bảo mật và minh bạch thông tin cho các tổ chức giáo dục.', 'Ngô Thu Hà', 17020021);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_list`
--

CREATE TABLE `student_list` (
  `student_id` int(11) NOT NULL,
  `student` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student_list`
--

INSERT INTO `student_list` (`student_id`, `student`, `department`, `major`, `class`) VALUES
(4102024, 'SMPhuc', 'CNTT', 'CNTT&HTTT', 'CNTT.C'),
(17020021, 'Ngô Thu Hà', 'IT', 'IT', 'K62CB'),
(17020029, 'Lê Phương Hằng', 'IT', 'IT', 'K62CB'),
(17020059, 'Lê Mai Anh', 'IT', 'IT', 'K62CB'),
(17021074, 'Nguyễn Quỳnh Trang', 'IT', 'IT', 'K62CB'),
(17021075, 'Nguyễn Thị Lệ Hà', 'IT', 'IT', 'K62CB');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `submission_requests`
--

CREATE TABLE `submission_requests` (
  `id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deadline` datetime NOT NULL,
  `attach` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `submission_requests`
--

INSERT INTO `submission_requests` (`id`, `lecturer_id`, `student_id`, `title`, `description`, `created_at`, `deadline`, `attach`) VALUES
(1, 7021089, 17020059, '123', '159', '2024-12-12 22:26:37', '2024-12-12 16:25:48', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`account`);

--
-- Chỉ mục cho bảng `approved_student_list`
--
ALTER TABLE `approved_student_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lecturer_list`
--
ALTER TABLE `lecturer_list`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- Chỉ mục cho bảng `pending_student_list`
--
ALTER TABLE `pending_student_list`
  ADD PRIMARY KEY (`student_id`);

--
-- Chỉ mục cho bảng `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `proposed_project_list`
--
ALTER TABLE `proposed_project_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`student_id`);

--
-- Chỉ mục cho bảng `submission_requests`
--
ALTER TABLE `submission_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`),
  ADD KEY `fk_student_id` (`student_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `approved_student_list`
--
ALTER TABLE `approved_student_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `proposed_project_list`
--
ALTER TABLE `proposed_project_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `submission_requests`
--
ALTER TABLE `submission_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `submission_requests`
--
ALTER TABLE `submission_requests`
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`student_id`),
  ADD CONSTRAINT `submission_requests_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer_list` (`lecturer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
