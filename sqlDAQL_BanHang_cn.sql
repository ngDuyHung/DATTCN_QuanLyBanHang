-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 04, 2026 lúc 12:19 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan_thuctap_cn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_staff` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `name`, `slug`, `logo_url`, `description`, `category_id`, `is_staff`, `created_at`, `updated_at`) VALUES
(2, 'MSI', 'msi', 'logos/xgzE5uAgIokL7pnOJkBqWOjNBIjw6aUwc4QEys0s.png', '<p>MSI</p>', 12, 1, '2025-11-01 17:55:19', '2026-01-05 14:40:12'),
(4, 'ThinkPad', 'thinkpad', 'logos/7MXmXdGIgDd6COp86E2iSYfEItBnA8p6SyeD789a.png', '<p>ThinkPad</p>', 12, 1, '2025-11-01 18:18:47', '2026-01-05 14:40:21'),
(5, 'Lenovo', 'lenovo', 'logos/eY9cCwL5yRYKdAxFxdDNs7u2va37CdTdc2j44Q7d.webp', '<p>Lenovo</p>', 12, 1, '2025-11-19 09:06:53', '2026-01-05 19:16:03'),
(6, 'Asus', 'asus', 'logos/ab9dXIt2iJkABsFYmOBbWmWWLIHt7os1cjEoePUG.png', '<p>asus</p>', 12, 1, '2025-12-03 01:21:13', '2026-01-05 14:41:20'),
(9, 'HP', 'hp', 'logos/3XKQIawlI5wOSjwLlV1OE9b4WOCbVZFEaXzCsvas.png', '<p>hp</p>', 12, 1, '2025-12-03 01:29:03', '2026-01-05 14:39:55'),
(10, 'PC Văn Phòng', 'pcvanphong', NULL, 'PC Văn Phòng', 13, 1, '2025-12-23 11:15:24', '2025-12-23 11:15:24'),
(11, 'PC Gaming', 'pcgaming', NULL, 'PC Gaming', 13, 1, '2025-12-23 11:15:54', '2025-12-23 11:15:54'),
(12, 'PC Đồ Họa Render', 'pcdohoarender', NULL, 'PC Đồ Họa Render', 13, 1, '2025-12-23 11:16:23', '2025-12-23 11:16:23'),
(13, 'PC Nhỏ Gọn', 'pcnhogon', NULL, 'PC Nhỏ Gọn', 13, 1, '2025-12-23 11:17:02', '2025-12-23 11:17:02'),
(14, 'Kingston', 'kingston', NULL, 'Kingston', 19, 1, '2026-01-02 01:48:18', '2026-01-02 01:48:18'),
(15, 'Corsair', 'corsair', NULL, 'Corsair', 19, 1, '2026-01-02 01:52:13', '2026-01-02 01:52:13'),
(16, 'Acer', 'acer', 'logos/yyXS9ME0IWArLeqAeCWrbCcJPqoyKVBD5WHQLtQB.webp', '<p>acerr22</p>', 12, 1, '2026-01-02 01:54:09', '2026-01-05 14:44:01'),
(17, 'G.Skill', 'gskill', NULL, 'G.Skill', 19, 1, '2026-01-02 02:11:33', '2026-01-02 02:11:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('categories_sidebar', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:14:{i:0;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:12;s:4:\"name\";s:6:\"Laptop\";s:4:\"slug\";s:6:\"laptop\";s:11:\"description\";s:5177:\"<p><em>Trong thời đại c&ocirc;ng nghệ số hiện nay,&nbsp;<a href=\"https://memoryzone.com.vn/laptop\" rel=\"noopener\" target=\"_blank\">laptop</a>&nbsp;(m&aacute;y t&iacute;nh x&aacute;ch tay) đ&atilde; trở th&agrave;nh thiết bị kh&ocirc;ng thể thiếu cho mọi người, từ học sinh, sinh vi&ecirc;n, nh&acirc;n vi&ecirc;n văn ph&ograve;ng đến c&aacute;c chuy&ecirc;n gia trong nhiều lĩnh vực. Với k&iacute;ch thước nhỏ gọn, t&iacute;nh di động cao c&ugrave;ng hiệu năng mạnh mẽ, laptop mang đến khả năng hỗ trợ tối ưu cho c&ocirc;ng việc, học tập v&agrave; giải tr&iacute;.</em></p>\r\n\r\n<h2 dir=\"ltr\">1. Lợi &iacute;ch khi sử dụng&nbsp;laptop 222</h2>\r\n\r\n<p dir=\"ltr\">Sử dụng m&aacute;y t&iacute;nh laptop mang lại nhiều lợi &iacute;ch nổi bật:</p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>T&iacute;nh di động cao:</strong>&nbsp;Laptop c&oacute; k&iacute;ch thước nhỏ gọn, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, ph&ugrave; hợp cho người thường xuy&ecirc;n di chuyển hoặc l&agrave;m việc linh hoạt.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Hiệu năng mạnh mẽ:</strong>&nbsp;Cấu h&igrave;nh đa dạng đ&aacute;p ứng mọi nhu cầu sử dụng, từ cơ bản đến n&acirc;ng cao. Khả năng xử l&yacute; đa nhiệm hiệu quả, tiết kiệm thời gian.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>M&agrave;n h&igrave;nh hiển thị sắc n&eacute;t:</strong>&nbsp;Mang đến trải nghiệm h&igrave;nh ảnh sống động, ch&acirc;n thực. Gi&uacute;p bảo vệ mắt tốt hơn so với&nbsp;<a href=\"https://memoryzone.com.vn/man-hinh\" rel=\"noopener\" target=\"_blank\">m&agrave;n h&igrave;nh m&aacute;y t&iacute;nh</a>&nbsp;để b&agrave;n.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Thời lượng pin d&agrave;i:</strong>&nbsp;Cho ph&eacute;p sử dụng li&ecirc;n tục trong nhiều giờ m&agrave; kh&ocirc;ng cần cắm sạc. Ph&ugrave; hợp cho những ai thường xuy&ecirc;n l&agrave;m việc hoặc học tập ngo&agrave;i trời.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Khả năng kết nối đa dạng:</strong>&nbsp;Hỗ trợ nhiều cổng kết nối phổ biến như USB,&nbsp;<a href=\"https://memoryzone.com.vn/day-hdmi-la-gi\" target=\"_top\">HDMI</a>, Wi-Fi, Bluetooth,...</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Thiết kế đa dạng, bắt mắt:</strong>&nbsp;Ph&ugrave; hợp với mọi phong c&aacute;ch v&agrave; c&aacute; t&iacute;nh. G&oacute;p phần n&acirc;ng cao phong c&aacute;ch thời trang của người sử dụng.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h2 dir=\"ltr\">2. Một số loại&nbsp;laptop phổ biến hiện nay</h2>\r\n\r\n<p dir=\"ltr\">C&oacute; nhiều c&aacute;ch để ph&acirc;n loại laptop, phổ biến nhất l&agrave; theo k&iacute;ch thước m&agrave;n h&igrave;nh v&agrave; nhu cầu sử dụng.</p>\r\n\r\n<p dir=\"ltr\"><strong>2.1. Ph&acirc;n loại laptop theo nhu cầu sử dụng:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-hoc-tap-van-phong\" rel=\"noopener\" target=\"_blank\"><strong>Laptop học tập&nbsp;văn ph&ograve;ng</strong></a><strong>:</strong>&nbsp;Cấu h&igrave;nh ổn định, gi&aacute; th&agrave;nh phải chăng, ph&ugrave; hợp cho học sinh, sinh vi&ecirc;n.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-gaming\" rel=\"noopener\" target=\"_blank\"><strong>Laptop gaming</strong></a><strong>:</strong>&nbsp;Cấu h&igrave;nh mạnh mẽ, tản nhiệt tốt, m&agrave;n h&igrave;nh mượt m&agrave;, ph&ugrave; hợp cho chơi game v&agrave; c&aacute;c t&aacute;c vụ đồ họa nặng.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-doanh-nghiep\" rel=\"noopener\" target=\"_blank\"><strong>Laptop doanh nghiệp</strong></a><strong>:&nbsp;</strong>Sở hữu thiết kế mỏng nhẹ, tinh tế, với m&agrave;u sắc trang nh&atilde; như đen, x&aacute;m, bạc, tạo n&ecirc;n vẻ ngo&agrave;i chuy&ecirc;n nghiệp cho người sử dụng.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p dir=\"ltr\"><strong>2.2. Ph&acirc;n loại theo hệ điều h&agrave;nh:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop Windows:</strong>&nbsp;Hệ điều h&agrave;nh phổ biến nhất, tương th&iacute;ch với nhiều phần mềm.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop macOS:</strong>&nbsp;Hệ điều h&agrave;nh độc quyền của Apple, được đ&aacute;nh gi&aacute; cao về t&iacute;nh ổn định v&agrave; bảo mật.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop Chrome OS:</strong>&nbsp;Hệ điều h&agrave;nh nhẹ, nhanh, ph&ugrave; hợp cho nhu cầu sử dụng cơ bản.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Mua m&aacute;y t&iacute;nh laptop tại MemoryZone, giao nhanh 2 giờ, nhiều mẫu m&aacute;y để lựa nhu cầu ph&ugrave; hợp, bảo h&agrave;nh ch&iacute;nh h&atilde;ng, Freeship tr&ecirc;n to&agrave;n quốc. Hỗ trợ thanh to&aacute;n trả g&oacute;p 0%.</p>\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2026-01-05 14:26:05\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:12;s:4:\"name\";s:6:\"Laptop\";s:4:\"slug\";s:6:\"laptop\";s:11:\"description\";s:5177:\"<p><em>Trong thời đại c&ocirc;ng nghệ số hiện nay,&nbsp;<a href=\"https://memoryzone.com.vn/laptop\" rel=\"noopener\" target=\"_blank\">laptop</a>&nbsp;(m&aacute;y t&iacute;nh x&aacute;ch tay) đ&atilde; trở th&agrave;nh thiết bị kh&ocirc;ng thể thiếu cho mọi người, từ học sinh, sinh vi&ecirc;n, nh&acirc;n vi&ecirc;n văn ph&ograve;ng đến c&aacute;c chuy&ecirc;n gia trong nhiều lĩnh vực. Với k&iacute;ch thước nhỏ gọn, t&iacute;nh di động cao c&ugrave;ng hiệu năng mạnh mẽ, laptop mang đến khả năng hỗ trợ tối ưu cho c&ocirc;ng việc, học tập v&agrave; giải tr&iacute;.</em></p>\r\n\r\n<h2 dir=\"ltr\">1. Lợi &iacute;ch khi sử dụng&nbsp;laptop 222</h2>\r\n\r\n<p dir=\"ltr\">Sử dụng m&aacute;y t&iacute;nh laptop mang lại nhiều lợi &iacute;ch nổi bật:</p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>T&iacute;nh di động cao:</strong>&nbsp;Laptop c&oacute; k&iacute;ch thước nhỏ gọn, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, ph&ugrave; hợp cho người thường xuy&ecirc;n di chuyển hoặc l&agrave;m việc linh hoạt.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Hiệu năng mạnh mẽ:</strong>&nbsp;Cấu h&igrave;nh đa dạng đ&aacute;p ứng mọi nhu cầu sử dụng, từ cơ bản đến n&acirc;ng cao. Khả năng xử l&yacute; đa nhiệm hiệu quả, tiết kiệm thời gian.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>M&agrave;n h&igrave;nh hiển thị sắc n&eacute;t:</strong>&nbsp;Mang đến trải nghiệm h&igrave;nh ảnh sống động, ch&acirc;n thực. Gi&uacute;p bảo vệ mắt tốt hơn so với&nbsp;<a href=\"https://memoryzone.com.vn/man-hinh\" rel=\"noopener\" target=\"_blank\">m&agrave;n h&igrave;nh m&aacute;y t&iacute;nh</a>&nbsp;để b&agrave;n.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Thời lượng pin d&agrave;i:</strong>&nbsp;Cho ph&eacute;p sử dụng li&ecirc;n tục trong nhiều giờ m&agrave; kh&ocirc;ng cần cắm sạc. Ph&ugrave; hợp cho những ai thường xuy&ecirc;n l&agrave;m việc hoặc học tập ngo&agrave;i trời.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Khả năng kết nối đa dạng:</strong>&nbsp;Hỗ trợ nhiều cổng kết nối phổ biến như USB,&nbsp;<a href=\"https://memoryzone.com.vn/day-hdmi-la-gi\" target=\"_top\">HDMI</a>, Wi-Fi, Bluetooth,...</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Thiết kế đa dạng, bắt mắt:</strong>&nbsp;Ph&ugrave; hợp với mọi phong c&aacute;ch v&agrave; c&aacute; t&iacute;nh. G&oacute;p phần n&acirc;ng cao phong c&aacute;ch thời trang của người sử dụng.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h2 dir=\"ltr\">2. Một số loại&nbsp;laptop phổ biến hiện nay</h2>\r\n\r\n<p dir=\"ltr\">C&oacute; nhiều c&aacute;ch để ph&acirc;n loại laptop, phổ biến nhất l&agrave; theo k&iacute;ch thước m&agrave;n h&igrave;nh v&agrave; nhu cầu sử dụng.</p>\r\n\r\n<p dir=\"ltr\"><strong>2.1. Ph&acirc;n loại laptop theo nhu cầu sử dụng:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-hoc-tap-van-phong\" rel=\"noopener\" target=\"_blank\"><strong>Laptop học tập&nbsp;văn ph&ograve;ng</strong></a><strong>:</strong>&nbsp;Cấu h&igrave;nh ổn định, gi&aacute; th&agrave;nh phải chăng, ph&ugrave; hợp cho học sinh, sinh vi&ecirc;n.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-gaming\" rel=\"noopener\" target=\"_blank\"><strong>Laptop gaming</strong></a><strong>:</strong>&nbsp;Cấu h&igrave;nh mạnh mẽ, tản nhiệt tốt, m&agrave;n h&igrave;nh mượt m&agrave;, ph&ugrave; hợp cho chơi game v&agrave; c&aacute;c t&aacute;c vụ đồ họa nặng.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-doanh-nghiep\" rel=\"noopener\" target=\"_blank\"><strong>Laptop doanh nghiệp</strong></a><strong>:&nbsp;</strong>Sở hữu thiết kế mỏng nhẹ, tinh tế, với m&agrave;u sắc trang nh&atilde; như đen, x&aacute;m, bạc, tạo n&ecirc;n vẻ ngo&agrave;i chuy&ecirc;n nghiệp cho người sử dụng.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p dir=\"ltr\"><strong>2.2. Ph&acirc;n loại theo hệ điều h&agrave;nh:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop Windows:</strong>&nbsp;Hệ điều h&agrave;nh phổ biến nhất, tương th&iacute;ch với nhiều phần mềm.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop macOS:</strong>&nbsp;Hệ điều h&agrave;nh độc quyền của Apple, được đ&aacute;nh gi&aacute; cao về t&iacute;nh ổn định v&agrave; bảo mật.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop Chrome OS:</strong>&nbsp;Hệ điều h&agrave;nh nhẹ, nhanh, ph&ugrave; hợp cho nhu cầu sử dụng cơ bản.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Mua m&aacute;y t&iacute;nh laptop tại MemoryZone, giao nhanh 2 giờ, nhiều mẫu m&aacute;y để lựa nhu cầu ph&ugrave; hợp, bảo h&agrave;nh ch&iacute;nh h&atilde;ng, Freeship tr&ecirc;n to&agrave;n quốc. Hỗ trợ thanh to&aacute;n trả g&oacute;p 0%.</p>\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2026-01-05 14:26:05\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:2;s:4:\"name\";s:3:\"MSI\";s:4:\"slug\";s:3:\"msi\";s:8:\"logo_url\";s:50:\"logos/xgzE5uAgIokL7pnOJkBqWOjNBIjw6aUwc4QEys0s.png\";s:11:\"description\";s:10:\"<p>MSI</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-11-01 17:55:19\";s:10:\"updated_at\";s:19:\"2026-01-05 14:40:12\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:2;s:4:\"name\";s:3:\"MSI\";s:4:\"slug\";s:3:\"msi\";s:8:\"logo_url\";s:50:\"logos/xgzE5uAgIokL7pnOJkBqWOjNBIjw6aUwc4QEys0s.png\";s:11:\"description\";s:10:\"<p>MSI</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-11-01 17:55:19\";s:10:\"updated_at\";s:19:\"2026-01-05 14:40:12\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:4;s:4:\"name\";s:8:\"ThinkPad\";s:4:\"slug\";s:8:\"thinkpad\";s:8:\"logo_url\";s:50:\"logos/7MXmXdGIgDd6COp86E2iSYfEItBnA8p6SyeD789a.png\";s:11:\"description\";s:15:\"<p>ThinkPad</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-11-01 18:18:47\";s:10:\"updated_at\";s:19:\"2026-01-05 14:40:21\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:4;s:4:\"name\";s:8:\"ThinkPad\";s:4:\"slug\";s:8:\"thinkpad\";s:8:\"logo_url\";s:50:\"logos/7MXmXdGIgDd6COp86E2iSYfEItBnA8p6SyeD789a.png\";s:11:\"description\";s:15:\"<p>ThinkPad</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-11-01 18:18:47\";s:10:\"updated_at\";s:19:\"2026-01-05 14:40:21\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:5;s:4:\"name\";s:6:\"Lenovo\";s:4:\"slug\";s:6:\"lenovo\";s:8:\"logo_url\";s:51:\"logos/eY9cCwL5yRYKdAxFxdDNs7u2va37CdTdc2j44Q7d.webp\";s:11:\"description\";s:13:\"<p>Lenovo</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-11-19 09:06:53\";s:10:\"updated_at\";s:19:\"2026-01-05 19:16:03\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:5;s:4:\"name\";s:6:\"Lenovo\";s:4:\"slug\";s:6:\"lenovo\";s:8:\"logo_url\";s:51:\"logos/eY9cCwL5yRYKdAxFxdDNs7u2va37CdTdc2j44Q7d.webp\";s:11:\"description\";s:13:\"<p>Lenovo</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-11-19 09:06:53\";s:10:\"updated_at\";s:19:\"2026-01-05 19:16:03\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:6;s:4:\"name\";s:4:\"Asus\";s:4:\"slug\";s:4:\"asus\";s:8:\"logo_url\";s:50:\"logos/ab9dXIt2iJkABsFYmOBbWmWWLIHt7os1cjEoePUG.png\";s:11:\"description\";s:11:\"<p>asus</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-03 01:21:13\";s:10:\"updated_at\";s:19:\"2026-01-05 14:41:20\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:6;s:4:\"name\";s:4:\"Asus\";s:4:\"slug\";s:4:\"asus\";s:8:\"logo_url\";s:50:\"logos/ab9dXIt2iJkABsFYmOBbWmWWLIHt7os1cjEoePUG.png\";s:11:\"description\";s:11:\"<p>asus</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-03 01:21:13\";s:10:\"updated_at\";s:19:\"2026-01-05 14:41:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:9;s:4:\"name\";s:2:\"HP\";s:4:\"slug\";s:2:\"hp\";s:8:\"logo_url\";s:50:\"logos/3XKQIawlI5wOSjwLlV1OE9b4WOCbVZFEaXzCsvas.png\";s:11:\"description\";s:9:\"<p>hp</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-03 01:29:03\";s:10:\"updated_at\";s:19:\"2026-01-05 14:39:55\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:9;s:4:\"name\";s:2:\"HP\";s:4:\"slug\";s:2:\"hp\";s:8:\"logo_url\";s:50:\"logos/3XKQIawlI5wOSjwLlV1OE9b4WOCbVZFEaXzCsvas.png\";s:11:\"description\";s:9:\"<p>hp</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-03 01:29:03\";s:10:\"updated_at\";s:19:\"2026-01-05 14:39:55\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:16;s:4:\"name\";s:4:\"Acer\";s:4:\"slug\";s:4:\"acer\";s:8:\"logo_url\";s:51:\"logos/yyXS9ME0IWArLeqAeCWrbCcJPqoyKVBD5WHQLtQB.webp\";s:11:\"description\";s:14:\"<p>acerr22</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 01:54:09\";s:10:\"updated_at\";s:19:\"2026-01-05 14:44:01\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:16;s:4:\"name\";s:4:\"Acer\";s:4:\"slug\";s:4:\"acer\";s:8:\"logo_url\";s:51:\"logos/yyXS9ME0IWArLeqAeCWrbCcJPqoyKVBD5WHQLtQB.webp\";s:11:\"description\";s:14:\"<p>acerr22</p>\";s:11:\"category_id\";i:12;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 01:54:09\";s:10:\"updated_at\";s:19:\"2026-01-05 14:44:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:13;s:4:\"name\";s:14:\"PC - Máy bộ\";s:4:\"slug\";s:7:\"pcmaybo\";s:11:\"description\";s:48:\"Máy tính để bàn, PC gaming, PC văn phòng\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-20 22:10:48\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:13;s:4:\"name\";s:14:\"PC - Máy bộ\";s:4:\"slug\";s:7:\"pcmaybo\";s:11:\"description\";s:48:\"Máy tính để bàn, PC gaming, PC văn phòng\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-20 22:10:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:10;s:4:\"name\";s:14:\"PC Văn Phòng\";s:4:\"slug\";s:10:\"pcvanphong\";s:8:\"logo_url\";N;s:11:\"description\";s:14:\"PC Văn Phòng\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:15:24\";s:10:\"updated_at\";s:19:\"2025-12-23 11:15:24\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:10;s:4:\"name\";s:14:\"PC Văn Phòng\";s:4:\"slug\";s:10:\"pcvanphong\";s:8:\"logo_url\";N;s:11:\"description\";s:14:\"PC Văn Phòng\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:15:24\";s:10:\"updated_at\";s:19:\"2025-12-23 11:15:24\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:11;s:4:\"name\";s:9:\"PC Gaming\";s:4:\"slug\";s:8:\"pcgaming\";s:8:\"logo_url\";N;s:11:\"description\";s:9:\"PC Gaming\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:15:54\";s:10:\"updated_at\";s:19:\"2025-12-23 11:15:54\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:11;s:4:\"name\";s:9:\"PC Gaming\";s:4:\"slug\";s:8:\"pcgaming\";s:8:\"logo_url\";N;s:11:\"description\";s:9:\"PC Gaming\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:15:54\";s:10:\"updated_at\";s:19:\"2025-12-23 11:15:54\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:12;s:4:\"name\";s:21:\"PC Đồ Họa Render\";s:4:\"slug\";s:13:\"pcdohoarender\";s:8:\"logo_url\";N;s:11:\"description\";s:21:\"PC Đồ Họa Render\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:16:23\";s:10:\"updated_at\";s:19:\"2025-12-23 11:16:23\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:12;s:4:\"name\";s:21:\"PC Đồ Họa Render\";s:4:\"slug\";s:13:\"pcdohoarender\";s:8:\"logo_url\";N;s:11:\"description\";s:21:\"PC Đồ Họa Render\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:16:23\";s:10:\"updated_at\";s:19:\"2025-12-23 11:16:23\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:13;s:4:\"name\";s:14:\"PC Nhỏ Gọn\";s:4:\"slug\";s:8:\"pcnhogon\";s:8:\"logo_url\";N;s:11:\"description\";s:14:\"PC Nhỏ Gọn\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:17:02\";s:10:\"updated_at\";s:19:\"2025-12-23 11:17:02\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:13;s:4:\"name\";s:14:\"PC Nhỏ Gọn\";s:4:\"slug\";s:8:\"pcnhogon\";s:8:\"logo_url\";N;s:11:\"description\";s:14:\"PC Nhỏ Gọn\";s:11:\"category_id\";i:13;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2025-12-23 11:17:02\";s:10:\"updated_at\";s:19:\"2025-12-23 11:17:02\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:14;s:4:\"name\";s:10:\"Màn hình\";s:4:\"slug\";s:7:\"manhinh\";s:11:\"description\";s:55:\"Màn hình máy tính các hãng Dell, Asus, LG, MSI...\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-20 22:10:48\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:14;s:4:\"name\";s:10:\"Màn hình\";s:4:\"slug\";s:7:\"manhinh\";s:11:\"description\";s:55:\"Màn hình máy tính các hãng Dell, Asus, LG, MSI...\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-20 22:10:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:15;s:4:\"name\";s:15:\"Chuột - Phím\";s:4:\"slug\";s:9:\"chuotphim\";s:11:\"description\";s:42:\"Chuột và bàn phím văn phòng, gaming\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-20 22:14:45\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:15;s:4:\"name\";s:15:\"Chuột - Phím\";s:4:\"slug\";s:9:\"chuotphim\";s:11:\"description\";s:42:\"Chuột và bàn phím văn phòng, gaming\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-20 22:14:45\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:16;s:4:\"name\";s:8:\"Tai nghe\";s:4:\"slug\";s:7:\"tainghe\";s:11:\"description\";s:37:\"Tai nghe gaming, tai nghe văn phòng\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-23 10:39:01\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:16;s:4:\"name\";s:8:\"Tai nghe\";s:4:\"slug\";s:7:\"tainghe\";s:11:\"description\";s:37:\"Tai nghe gaming, tai nghe văn phòng\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-23 10:39:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:17;s:4:\"name\";s:26:\"Ổ cứng SSD gắn trong\";s:4:\"slug\";s:8:\"ssdnoibo\";s:11:\"description\";s:39:\"SSD dung lượng từ 120GB đến 8TB\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:37:03\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:17;s:4:\"name\";s:26:\"Ổ cứng SSD gắn trong\";s:4:\"slug\";s:8:\"ssdnoibo\";s:11:\"description\";s:39:\"SSD dung lượng từ 120GB đến 8TB\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:37:03\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:18;s:4:\"name\";s:25:\"Ổ cứng SSD di động\";s:4:\"slug\";s:9:\"ssddidong\";s:11:\"description\";s:41:\"Ổ cứng SSD di động tốc độ cao\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:37:11\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:18;s:4:\"name\";s:25:\"Ổ cứng SSD di động\";s:4:\"slug\";s:9:\"ssddidong\";s:11:\"description\";s:41:\"Ổ cứng SSD di động tốc độ cao\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:37:11\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:19;s:4:\"name\";s:3:\"RAM\";s:4:\"slug\";s:3:\"ram\";s:11:\"description\";s:26:\"RAM cho laptop, PC, server\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:19;s:4:\"name\";s:3:\"RAM\";s:4:\"slug\";s:3:\"ram\";s:11:\"description\";s:26:\"RAM cho laptop, PC, server\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:14;s:4:\"name\";s:8:\"Kingston\";s:4:\"slug\";s:8:\"kingston\";s:8:\"logo_url\";N;s:11:\"description\";s:8:\"Kingston\";s:11:\"category_id\";i:19;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 01:48:18\";s:10:\"updated_at\";s:19:\"2026-01-02 01:48:18\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:14;s:4:\"name\";s:8:\"Kingston\";s:4:\"slug\";s:8:\"kingston\";s:8:\"logo_url\";N;s:11:\"description\";s:8:\"Kingston\";s:11:\"category_id\";i:19;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 01:48:18\";s:10:\"updated_at\";s:19:\"2026-01-02 01:48:18\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:15;s:4:\"name\";s:7:\"Corsair\";s:4:\"slug\";s:7:\"corsair\";s:8:\"logo_url\";N;s:11:\"description\";s:7:\"Corsair\";s:11:\"category_id\";i:19;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 01:52:13\";s:10:\"updated_at\";s:19:\"2026-01-02 01:52:13\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:15;s:4:\"name\";s:7:\"Corsair\";s:4:\"slug\";s:7:\"corsair\";s:8:\"logo_url\";N;s:11:\"description\";s:7:\"Corsair\";s:11:\"category_id\";i:19;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 01:52:13\";s:10:\"updated_at\";s:19:\"2026-01-02 01:52:13\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:16:\"App\\Models\\Brand\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"brands\";s:13:\"\0*\0primaryKey\";s:8:\"brand_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:8:\"brand_id\";i:17;s:4:\"name\";s:7:\"G.Skill\";s:4:\"slug\";s:6:\"gskill\";s:8:\"logo_url\";N;s:11:\"description\";s:7:\"G.Skill\";s:11:\"category_id\";i:19;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 02:11:33\";s:10:\"updated_at\";s:19:\"2026-01-02 02:11:33\";}s:11:\"\0*\0original\";a:9:{s:8:\"brand_id\";i:17;s:4:\"name\";s:7:\"G.Skill\";s:4:\"slug\";s:6:\"gskill\";s:8:\"logo_url\";N;s:11:\"description\";s:7:\"G.Skill\";s:11:\"category_id\";i:19;s:8:\"is_staff\";i:1;s:10:\"created_at\";s:19:\"2026-01-02 02:11:33\";s:10:\"updated_at\";s:19:\"2026-01-02 02:11:33\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:8:\"logo_url\";i:3;s:11:\"description\";i:4;s:8:\"is_staff\";i:5;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:25;s:4:\"name\";s:3:\"USB\";s:4:\"slug\";s:3:\"usb\";s:11:\"description\";s:42:\"USB các dung lượng từ 8GB đến 1TB\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:25;s:4:\"name\";s:3:\"USB\";s:4:\"slug\";s:3:\"usb\";s:11:\"description\";s:42:\"USB các dung lượng từ 8GB đến 1TB\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:26;s:4:\"name\";s:11:\"Thẻ nhớ\";s:4:\"slug\";s:6:\"thenho\";s:11:\"description\";s:42:\"Thẻ nhớ SD, MicroSD các dung lượng\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:37:20\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:26;s:4:\"name\";s:11:\"Thẻ nhớ\";s:4:\"slug\";s:6:\"thenho\";s:11:\"description\";s:42:\"Thẻ nhớ SD, MicroSD các dung lượng\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:37:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:10;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:27;s:4:\"name\";s:15:\"Card màn hình\";s:4:\"slug\";s:3:\"vga\";s:11:\"description\";s:52:\"Card đồ họa NVIDIA, AMD các dòng mới nhất\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:27;s:4:\"name\";s:15:\"Card màn hình\";s:4:\"slug\";s:3:\"vga\";s:11:\"description\";s:52:\"Card đồ họa NVIDIA, AMD các dòng mới nhất\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:11;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:28;s:4:\"name\";s:9:\"Mainboard\";s:4:\"slug\";s:9:\"mainboard\";s:11:\"description\";s:38:\"Bo mạch chủ ASUS, MSI, Gigabyte...\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:28;s:4:\"name\";s:9:\"Mainboard\";s:4:\"slug\";s:9:\"mainboard\";s:11:\"description\";s:38:\"Bo mạch chủ ASUS, MSI, Gigabyte...\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:12;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:29;s:4:\"name\";s:3:\"CPU\";s:4:\"slug\";s:3:\"cpu\";s:11:\"description\";s:43:\"Bộ vi xử lý Intel, AMD các thế hệ\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:29;s:4:\"name\";s:3:\"CPU\";s:4:\"slug\";s:3:\"cpu\";s:11:\"description\";s:43:\"Bộ vi xử lý Intel, AMD các thế hệ\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:13;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:11:\"category_id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:11:\"category_id\";i:30;s:4:\"name\";s:18:\"Nguồn máy tính\";s:4:\"slug\";s:3:\"psu\";s:11:\"description\";s:54:\"Nguồn máy tính công suất từ 500W đến 1000W\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:11:\"\0*\0original\";a:7:{s:11:\"category_id\";i:30;s:4:\"name\";s:18:\"Nguồn máy tính\";s:4:\"slug\";s:3:\"psu\";s:11:\"description\";s:54:\"Nguồn máy tính công suất từ 500W đến 1000W\";s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-12-09 08:32:30\";s:10:\"updated_at\";s:19:\"2025-12-09 08:32:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"brands\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:11:\"description\";i:3;s:9:\"parent_id\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1772626041);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-11-24 07:45:29', '2025-11-24 07:45:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(12, 'Laptop', 'laptop', '<p><em>Trong thời đại c&ocirc;ng nghệ số hiện nay,&nbsp;<a href=\"https://memoryzone.com.vn/laptop\" rel=\"noopener\" target=\"_blank\">laptop</a>&nbsp;(m&aacute;y t&iacute;nh x&aacute;ch tay) đ&atilde; trở th&agrave;nh thiết bị kh&ocirc;ng thể thiếu cho mọi người, từ học sinh, sinh vi&ecirc;n, nh&acirc;n vi&ecirc;n văn ph&ograve;ng đến c&aacute;c chuy&ecirc;n gia trong nhiều lĩnh vực. Với k&iacute;ch thước nhỏ gọn, t&iacute;nh di động cao c&ugrave;ng hiệu năng mạnh mẽ, laptop mang đến khả năng hỗ trợ tối ưu cho c&ocirc;ng việc, học tập v&agrave; giải tr&iacute;.</em></p>\r\n\r\n<h2 dir=\"ltr\">1. Lợi &iacute;ch khi sử dụng&nbsp;laptop 222</h2>\r\n\r\n<p dir=\"ltr\">Sử dụng m&aacute;y t&iacute;nh laptop mang lại nhiều lợi &iacute;ch nổi bật:</p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>T&iacute;nh di động cao:</strong>&nbsp;Laptop c&oacute; k&iacute;ch thước nhỏ gọn, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, ph&ugrave; hợp cho người thường xuy&ecirc;n di chuyển hoặc l&agrave;m việc linh hoạt.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Hiệu năng mạnh mẽ:</strong>&nbsp;Cấu h&igrave;nh đa dạng đ&aacute;p ứng mọi nhu cầu sử dụng, từ cơ bản đến n&acirc;ng cao. Khả năng xử l&yacute; đa nhiệm hiệu quả, tiết kiệm thời gian.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>M&agrave;n h&igrave;nh hiển thị sắc n&eacute;t:</strong>&nbsp;Mang đến trải nghiệm h&igrave;nh ảnh sống động, ch&acirc;n thực. Gi&uacute;p bảo vệ mắt tốt hơn so với&nbsp;<a href=\"https://memoryzone.com.vn/man-hinh\" rel=\"noopener\" target=\"_blank\">m&agrave;n h&igrave;nh m&aacute;y t&iacute;nh</a>&nbsp;để b&agrave;n.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Thời lượng pin d&agrave;i:</strong>&nbsp;Cho ph&eacute;p sử dụng li&ecirc;n tục trong nhiều giờ m&agrave; kh&ocirc;ng cần cắm sạc. Ph&ugrave; hợp cho những ai thường xuy&ecirc;n l&agrave;m việc hoặc học tập ngo&agrave;i trời.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Khả năng kết nối đa dạng:</strong>&nbsp;Hỗ trợ nhiều cổng kết nối phổ biến như USB,&nbsp;<a href=\"https://memoryzone.com.vn/day-hdmi-la-gi\" target=\"_top\">HDMI</a>, Wi-Fi, Bluetooth,...</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Thiết kế đa dạng, bắt mắt:</strong>&nbsp;Ph&ugrave; hợp với mọi phong c&aacute;ch v&agrave; c&aacute; t&iacute;nh. G&oacute;p phần n&acirc;ng cao phong c&aacute;ch thời trang của người sử dụng.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h2 dir=\"ltr\">2. Một số loại&nbsp;laptop phổ biến hiện nay</h2>\r\n\r\n<p dir=\"ltr\">C&oacute; nhiều c&aacute;ch để ph&acirc;n loại laptop, phổ biến nhất l&agrave; theo k&iacute;ch thước m&agrave;n h&igrave;nh v&agrave; nhu cầu sử dụng.</p>\r\n\r\n<p dir=\"ltr\"><strong>2.1. Ph&acirc;n loại laptop theo nhu cầu sử dụng:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-hoc-tap-van-phong\" rel=\"noopener\" target=\"_blank\"><strong>Laptop học tập&nbsp;văn ph&ograve;ng</strong></a><strong>:</strong>&nbsp;Cấu h&igrave;nh ổn định, gi&aacute; th&agrave;nh phải chăng, ph&ugrave; hợp cho học sinh, sinh vi&ecirc;n.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-gaming\" rel=\"noopener\" target=\"_blank\"><strong>Laptop gaming</strong></a><strong>:</strong>&nbsp;Cấu h&igrave;nh mạnh mẽ, tản nhiệt tốt, m&agrave;n h&igrave;nh mượt m&agrave;, ph&ugrave; hợp cho chơi game v&agrave; c&aacute;c t&aacute;c vụ đồ họa nặng.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><a href=\"https://memoryzone.com.vn/laptop-doanh-nghiep\" rel=\"noopener\" target=\"_blank\"><strong>Laptop doanh nghiệp</strong></a><strong>:&nbsp;</strong>Sở hữu thiết kế mỏng nhẹ, tinh tế, với m&agrave;u sắc trang nh&atilde; như đen, x&aacute;m, bạc, tạo n&ecirc;n vẻ ngo&agrave;i chuy&ecirc;n nghiệp cho người sử dụng.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p dir=\"ltr\"><strong>2.2. Ph&acirc;n loại theo hệ điều h&agrave;nh:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop Windows:</strong>&nbsp;Hệ điều h&agrave;nh phổ biến nhất, tương th&iacute;ch với nhiều phần mềm.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop macOS:</strong>&nbsp;Hệ điều h&agrave;nh độc quyền của Apple, được đ&aacute;nh gi&aacute; cao về t&iacute;nh ổn định v&agrave; bảo mật.</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong>Laptop Chrome OS:</strong>&nbsp;Hệ điều h&agrave;nh nhẹ, nhanh, ph&ugrave; hợp cho nhu cầu sử dụng cơ bản.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Mua m&aacute;y t&iacute;nh laptop tại MemoryZone, giao nhanh 2 giờ, nhiều mẫu m&aacute;y để lựa nhu cầu ph&ugrave; hợp, bảo h&agrave;nh ch&iacute;nh h&atilde;ng, Freeship tr&ecirc;n to&agrave;n quốc. Hỗ trợ thanh to&aacute;n trả g&oacute;p 0%.</p>', 1, '2025-12-09 08:32:30', '2026-01-05 14:26:05'),
(13, 'PC - Máy bộ', 'pcmaybo', 'Máy tính để bàn, PC gaming, PC văn phòng', 1, '2025-12-09 08:32:30', '2025-12-20 22:10:48'),
(14, 'Màn hình', 'manhinh', 'Màn hình máy tính các hãng Dell, Asus, LG, MSI...', 1, '2025-12-09 08:32:30', '2025-12-20 22:10:48'),
(15, 'Chuột - Phím', 'chuotphim', 'Chuột và bàn phím văn phòng, gaming', 1, '2025-12-09 08:32:30', '2025-12-20 22:14:45'),
(16, 'Tai nghe', 'tainghe', 'Tai nghe gaming, tai nghe văn phòng', 1, '2025-12-09 08:32:30', '2025-12-23 10:39:01'),
(17, 'Ổ cứng SSD gắn trong', 'ssdnoibo', 'SSD dung lượng từ 120GB đến 8TB', 1, '2025-12-09 08:32:30', '2025-12-09 08:37:03'),
(18, 'Ổ cứng SSD di động', 'ssddidong', 'Ổ cứng SSD di động tốc độ cao', 1, '2025-12-09 08:32:30', '2025-12-09 08:37:11'),
(19, 'RAM', 'ram', 'RAM cho laptop, PC, server', 1, '2025-12-09 08:32:30', '2025-12-09 08:32:30'),
(25, 'USB', 'usb', 'USB các dung lượng từ 8GB đến 1TB', 1, '2025-12-09 08:32:30', '2025-12-09 08:32:30'),
(26, 'Thẻ nhớ', 'thenho', 'Thẻ nhớ SD, MicroSD các dung lượng', 1, '2025-12-09 08:32:30', '2025-12-09 08:37:20'),
(27, 'Card màn hình', 'vga', 'Card đồ họa NVIDIA, AMD các dòng mới nhất', 1, '2025-12-09 08:32:30', '2025-12-09 08:32:30'),
(28, 'Mainboard', 'mainboard', 'Bo mạch chủ ASUS, MSI, Gigabyte...', 1, '2025-12-09 08:32:30', '2025-12-09 08:32:30'),
(29, 'CPU', 'cpu', 'Bộ vi xử lý Intel, AMD các thế hệ', 1, '2025-12-09 08:32:30', '2025-12-09 08:32:30'),
(30, 'Nguồn máy tính', 'psu', 'Nguồn máy tính công suất từ 500W đến 1000W', 1, '2025-12-09 08:32:30', '2025-12-09 08:32:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `quantity_in_stock` int(11) NOT NULL DEFAULT 0,
  `min_alert_quantity` int(11) DEFAULT 0,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `product_id`, `location`, `quantity_in_stock`, `min_alert_quantity`, `last_updated`, `created_at`, `updated_at`) VALUES
(4, 14, 'Kệ L1', 17, 10, '2026-01-05 12:14:44', '2025-12-20 11:27:56', '2026-01-05 12:14:44'),
(5, 15, NULL, 3, 10, '2025-12-21 16:39:50', '2025-12-20 11:28:12', '2025-12-21 16:39:50'),
(6, 20, NULL, 20, 10, '2025-12-25 12:17:01', '2025-12-25 12:17:01', '2025-12-25 12:17:01'),
(8, 17, NULL, 21, 10, '2025-12-25 14:36:32', '2025-12-25 14:36:32', '2025-12-25 14:36:32'),
(9, 18, NULL, 15, 10, '2025-12-25 14:36:43', '2025-12-25 14:36:43', '2025-12-25 14:36:43'),
(10, 19, NULL, 29, 10, '2025-12-25 14:37:32', '2025-12-25 14:36:53', '2025-12-25 14:37:32'),
(11, 21, NULL, 30, 10, '2026-01-02 00:46:29', '2026-01-02 00:46:29', '2026-01-02 00:46:29'),
(12, 22, 'Kệ ABC', 14, 10, '2026-01-05 12:14:23', '2026-01-02 01:03:00', '2026-01-05 12:14:23'),
(13, 23, 'Kệ R19', 25, 10, '2026-01-05 12:15:25', '2026-01-02 01:06:43', '2026-01-05 12:15:25'),
(14, 24, 'Kệ R1', 0, 10, '2026-01-06 15:06:54', '2026-01-02 01:46:28', '2026-01-06 15:06:54'),
(16, 13, 'Kệ L3', 21, 10, '2026-01-05 12:15:04', '2026-01-04 23:52:48', '2026-01-05 12:15:04'),
(17, 12, 'Kệ A1', 22, 10, '2026-01-05 12:14:02', '2026-01-05 12:14:02', '2026-01-05 12:14:02'),
(18, 16, 'Kệ A2', 10, 10, '2026-01-26 12:58:01', '2026-01-05 12:14:14', '2026-01-26 12:58:01'),
(20, 27, 'eee', 7, 3, '2026-01-26 14:14:33', '2026-01-26 13:28:52', '2026-01-26 14:14:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"5bbca7f7-062b-45e8-8fac-9c9c0e7c9155\",\"displayName\":\"App\\\\Events\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":16:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\OrderStatusUpdated\\\":1:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:50;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1769411690,\"delay\":null}', 0, NULL, 1769411690, 1769411690),
(2, 'default', '{\"uuid\":\"3bdb99d4-a02c-45d6-8db9-357f3b9be3ab\",\"displayName\":\"App\\\\Events\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":16:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\OrderStatusUpdated\\\":1:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:50;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1769411690,\"delay\":null}', 0, NULL, 1769411690, 1769411690);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên menu hiển thị',
  `url` varchar(500) DEFAULT NULL COMMENT 'Đường dẫn URL (có thể là đầy đủ https hoặc relative)',
  `type` varchar(50) NOT NULL DEFAULT 'header' COMMENT 'Loại menu: header, footer, sidebar',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID của menu cha (NULL nếu là menu cấp 1)',
  `sort_order` int(11) NOT NULL DEFAULT 1 COMMENT 'Thứ tự sắp xếp',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái: 1 = Hoạt động, 0 = Tạm tắt',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng quản lý menu website';

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`menu_id`, `name`, `url`, `type`, `parent_id`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', '/', 'header', NULL, 1, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41'),
(2, 'Sản phẩm', '/san-pham', 'header', NULL, 2, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41'),
(3, 'Điện thoại', '/dien-thoai', 'header', 2, 1, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41'),
(4, 'Laptop', '/laptop', 'header', 2, 2, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41'),
(5, 'Tin tức', '/tin-tuc', 'header', NULL, 3, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41'),
(6, 'Liên hệ', '/lien-he', 'header', NULL, 4, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41'),
(7, 'Về chúng tôi', '/ve-chung-toi', 'footer', NULL, 1, 1, '2026-01-05 17:33:41', '2026-01-05 17:35:42'),
(8, 'Chính sách bảo hành', '/chinh-sach-bao-hanh', 'footer', NULL, 2, 1, '2026-01-05 17:33:41', '2026-01-05 17:33:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_21_202957_create_sepay_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `opt_key` varchar(191) NOT NULL,
  `opt_value` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Duy Hung Zone', '2026-01-06 01:13:25', '2026-01-06 01:23:19'),
(2, 'site_logo', 'configs/1pz92b0mVzv3yT2aybM5HmjAffVZmdqh5Fwc3Klo.png', '2026-01-06 01:13:25', '2026-01-06 01:23:19'),
(3, 'site_email', 'duyhungzone@gmail.com', '2026-01-06 01:14:31', '2026-01-06 01:23:19'),
(4, 'site_phone', '0123456789', '2026-01-06 01:14:31', '2026-01-06 01:23:19'),
(5, 'site_address', NULL, '2026-01-06 01:14:31', '2026-01-06 01:14:31'),
(6, 'site_favicon', NULL, '2026-01-06 01:18:48', '2026-01-06 01:18:48'),
(7, 'site_description', 'DuyHungZone là một thương hiệu chuyên cung cấp Laptop, PC, thiết bị lưu trữ, màn hình và các phụ kiện khác.', '2026-01-06 01:20:56', '2026-01-06 01:23:19'),
(8, 'site_title', 'CÔNG TY TNHH DỊCH VỤ TIN HỌC DUY HÙNG', '2026-01-06 01:23:19', '2026-01-06 01:23:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL COMMENT 'Mã đơn hàng tự tăng',
  `order_number` varchar(50) DEFAULT NULL COMMENT 'Số đơn hàng duy nhất',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address_snapshot` text NOT NULL COMMENT 'Địa chỉ giao hàng tại thời điểm đặt',
  `promo_id` int(11) DEFAULT NULL COMMENT 'Mã khuyến mãi áp dụng',
  `payment_method` enum('cod','bank_transfer','card','e_wallet') DEFAULT 'cod' COMMENT 'Phương thức thanh toán',
  `shipping_fee` decimal(12,2) DEFAULT 0.00 COMMENT 'Phí vận chuyển',
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00 COMMENT 'Tổng tiền hàng trước giảm giá',
  `discount_amount` decimal(12,2) DEFAULT 0.00 COMMENT 'Số tiền giảm giá',
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00 COMMENT 'Tổng tiền phải trả',
  `status` enum('pending','delivery','completed','cancelled') DEFAULT 'pending' COMMENT 'Trạng thái đơn hàng',
  `note` varchar(255) DEFAULT NULL,
  `placed_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm đặt hàng',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật gần nhất',
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `user_id`, `full_name`, `email`, `phone`, `address_snapshot`, `promo_id`, `payment_method`, `shipping_fee`, `subtotal`, `discount_amount`, `total_amount`, `status`, `note`, `placed_at`, `updated_at`, `handled_by`) VALUES
(32, '6435829969', 1, 'Nguyễn Duy Hùng', 'duyhungtest@gmail.com', 987674849, '34 tên lửa phương an lạc A quận bình tận, Xã Đại áng, Huyện Thanh Trì, Thành phố Hà Nội', NULL, 'cod', 0.00, 100200000.00, 0.00, 100200000.00, 'completed', '1', '2025-11-27 14:20:11', '2025-12-22 01:01:15', 1),
(33, '8219368200', NULL, 'Nguyễn Duy Hùng', 'duyhungtest@gmail.com', 987674849, '34 tên lửa phương an lạc A quận bình tận, Phường Dương Nội, Quận Hà Đông, Thành phố Hà Nội', NULL, 'bank_transfer', 0.00, 24000000.00, 0.00, 24000000.00, 'completed', '2', '2025-11-27 14:21:24', '2025-11-28 16:36:52', 1),
(40, '3238451720', NULL, 'Nguyễn Duy Hùng2', 'duyhungtest@gmail.com', 901234567, '123 Lê Lợi, Q1, TP.HCM, Phường Vân Dương, Thành phố Bắc Ninh, Tỉnh Bắc Ninh', 2, 'bank_transfer', 0.00, 24000000.00, 10000.00, 23990000.00, 'delivery', NULL, '2025-12-21 19:26:37', '2025-12-23 10:37:58', 1),
(41, '3223638093', 1, 'duyhungtest duyhungtest', 'duyhungtest@gmail.com', 987667849, '34 tên lửa, Phường 8, Quận 10, Thành phố Hồ Chí Minh', 2, 'bank_transfer', 0.00, 82000000.00, 10000.00, 81990000.00, 'delivery', NULL, '2025-12-25 13:52:50', '2026-01-05 19:07:22', 1),
(43, '5713991285', 1, 'Nguyễn Duy Hùng2222222t', 'duyhungtest@gmail.com', 901234567, '123 Lê Lợi, Q1, TP.HCM, Phường Khắc Niệm, Thành phố Bắc Ninh, Tỉnh Bắc Ninh', 2, 'cod', 0.00, 89000000.00, 10000.00, 88990000.00, 'completed', 'v', '2026-01-02 15:18:56', '2026-01-02 19:00:33', 1),
(44, '9957952431', 1, 'Nguyễn Duy Hùng2', 'duyhungtest@gmail.com', 901234567, '123 Lê Lợi, Q1, TP.HCM, Phường Liên Bảo, Thành phố Vĩnh Yên, Tỉnh Vĩnh Phúc', NULL, 'cod', 0.00, 41000000.00, 0.00, 41000000.00, 'completed', 'd', '2026-01-04 17:54:47', '2026-01-05 10:52:24', 1),
(46, '2661151708', 1, 'tét1', 'duyhungtest@gmail.com', 987667849, '34 tên lửa, Xã Liên Vị, Thị xã Quảng Yên, Tỉnh Quảng Ninh', NULL, 'cod', 0.00, 41000000.00, 0.00, 41000000.00, 'pending', 'f', '2026-01-06 15:01:33', '2026-01-06 15:01:33', NULL),
(47, '3385733051', 1, 'tét1', 'duyhungtest@gmail.com', 987667849, '34 tên lửa, Phường Quang Trung, Thành phố Hà Giang, Tỉnh Hà Giang', NULL, 'bank_transfer', 0.00, 41000000.00, 0.00, 41000000.00, 'pending', '2', '2026-01-26 12:58:01', '2026-01-26 12:58:01', NULL),
(48, '3906059249', 1, 'tét1', 'duyhungtest@gmail.com', 987667849, '34 tên lửa, Phường Trần Phú, Thành phố Hà Giang, Tỉnh Hà Giang', NULL, 'bank_transfer', 0.00, 10000.00, 0.00, 10000.00, 'completed', 'q', '2026-01-26 13:29:24', '2026-01-26 13:55:07', NULL),
(49, '4580997396', 1, 'tét1', 'duyhungtest@gmail.com', 987667849, '34 tên lửa, Xã Hoàng Kim, Huyện Mê Linh, Thành phố Hà Nội', NULL, 'bank_transfer', 0.00, 10000.00, 0.00, 10000.00, 'completed', 'd', '2026-01-26 13:58:12', '2026-01-26 13:58:35', NULL),
(50, '8242005021', 1, 'tét1', 'duyhungtest@gmail.com', 987667849, '34 tên lửa, Xã Tuấn Đạo, Huyện Sơn Động, Tỉnh Bắc Giang', NULL, 'bank_transfer', 0.00, 10000.00, 0.00, 10000.00, 'completed', NULL, '2026-01-26 14:14:33', '2026-01-26 14:14:50', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `line_total` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `sku`, `product_name`, `unit_price`, `quantity`, `line_total`, `created_at`) VALUES
(27, 32, 12, '21TF003QVA[TEST]', 'Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA (Core 5 210H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 24000000.00, 4, 96000000.00, '2025-11-27 14:20:11'),
(28, 32, 13, 'PH18-73-93P0[TEST]', 'Laptop Lenovo Thinkbook 14 Gen 8 IRL 21SG007PVA (Core 7 240H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS WUXGA 60Hz)', 2100000.00, 2, 4200000.00, '2025-11-27 14:20:11'),
(29, 33, 12, '21TF003QVA[TEST]', 'Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA (Core 5 210H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 24000000.00, 1, 24000000.00, '2025-11-27 14:21:24'),
(35, 40, 14, 'LT010012TEST', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 24000000.00, 1, 24000000.00, '2025-12-21 19:26:37'),
(36, 41, 16, 'LT010014TEST', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 41000000.00, 2, 82000000.00, '2025-12-25 13:52:50'),
(39, 43, 16, 'LT010014TEST', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 41000000.00, 1, 41000000.00, '2026-01-02 15:18:56'),
(40, 43, 14, 'LT010012TEST', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 24000000.00, 2, 48000000.00, '2026-01-02 15:18:56'),
(41, 44, 16, 'LT010014TEST', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 41000000.00, 1, 41000000.00, '2026-01-04 17:54:47'),
(43, 46, 16, 'LT010014TEST', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 41000000.00, 1, 41000000.00, '2026-01-06 15:01:33'),
(44, 47, 16, 'LT010014TEST', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 41000000.00, 1, 41000000.00, '2026-01-26 12:58:01'),
(45, 48, 27, 'skutest01', 'skutest01', 10000.00, 1, 10000.00, '2026-01-26 13:29:24'),
(46, 49, 27, 'skutest01', 'skutest01', 10000.00, 1, 10000.00, '2026-01-26 13:58:12'),
(47, 50, 27, 'skutest01', 'skutest01', 10000.00, 1, 10000.00, '2026-01-26 14:14:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sale_description` text DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cost_price` decimal(12,2) DEFAULT 0.00,
  `weight` decimal(10,3) DEFAULT 0.000,
  `is_active` tinyint(1) DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `main_img_url` text DEFAULT NULL,
  `total_attributes` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `sku`, `name`, `slug`, `short_description`, `description`, `sale_description`, `price`, `cost_price`, `weight`, `is_active`, `category_id`, `brand_id`, `main_img_url`, `total_attributes`, `created_at`, `updated_at`) VALUES
(12, 'LT010011TEST', 'Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA (Core 5 210H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 'laptop-lenovo-lt010011test', 'mô tả ngắn về Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA', '<p><strong>Laptop Gaming Lenovo Legion 5 15IRX10 83LY004GVN</strong>&nbsp;sở hữu&nbsp;<strong>vi xử l&yacute; Intel Core i7-14700HX</strong>&nbsp;với&nbsp;<strong>20 nh&acirc;n (8P + 12E), 28 luồng</strong>&nbsp;v&agrave; xung nhịp tối đa l&ecirc;n đến&nbsp;<strong>5.5GHz</strong>, mang lại hiệu năng xử l&yacute; vượt trội trong mọi t&aacute;c vụ từ chơi game đến đồ họa nặng. Kết hợp c&ugrave;ng&nbsp;<strong>card đồ họa NVIDIA GeForce RTX 5070 8GB GDDR7</strong>, chiếc laptop n&agrave;y c&oacute; khả năng xử l&yacute; đồ họa mượt m&agrave; với&nbsp;<strong>Boost Clock l&ecirc;n đến 2347MHz</strong>,&nbsp;<strong>TGP 115W</strong>, t&iacute;ch hợp&nbsp;<strong>798 AI TOPS</strong>&nbsp;cho c&aacute;c t&aacute;c vụ tăng tốc bằng AI. Đ&acirc;y l&agrave; một chiếc&nbsp;<strong>AI-Powered Gaming PC</strong>&nbsp;thực thụ, gi&uacute;p bạn lu&ocirc;n dẫn đầu trong mọi trận đấu hay dự &aacute;n s&aacute;ng tạo.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-lenovo-legion-5-15irx10-83ly004gvn-04.jpg?v=1750768785060\" /></p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh OLED 2.5K rực rỡ, tần số qu&eacute;t 165Hz si&ecirc;u mượt</strong></h3>\r\n\r\n<p>Trải nghiệm h&igrave;nh ảnh vượt trội tr&ecirc;n&nbsp;<strong>m&agrave;n h&igrave;nh OLED 15.1 inch độ ph&acirc;n giải WQXGA (2560x1600)</strong>&nbsp;với độ s&aacute;ng&nbsp;<strong>500 nits</strong>, tần số qu&eacute;t&nbsp;<strong>165Hz</strong>, hỗ trợ&nbsp;<strong>Dolby Vision&reg;</strong>&nbsp;v&agrave;&nbsp;<strong>DisplayHDR&trade; True Black 600</strong>&nbsp;cho m&agrave;u đen s&acirc;u v&agrave; độ tương phản ấn tượng. M&agrave;n h&igrave;nh c&oacute;&nbsp;<strong>tỷ lệ 16:10</strong>, kh&ocirc;ng gian hiển thị rộng hơn, c&ugrave;ng&nbsp;<strong>100% dải m&agrave;u DCI-P3</strong>&nbsp;v&agrave;&nbsp;<strong>c&acirc;n chỉnh m&agrave;u từ nh&agrave; m&aacute;y</strong>, đảm bảo độ ch&iacute;nh x&aacute;c m&agrave;u sắc l&yacute; tưởng cho thiết kế v&agrave; chỉnh sửa ảnh/video chuy&ecirc;n nghiệp. Mọi khung h&igrave;nh đều trở n&ecirc;n sống động, ch&acirc;n thực v&agrave; si&ecirc;u mượt.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-lenovo-legion-5-15irx10-83ly004gvn-02.jpg?v=1750768784973\" /></p>\r\n\r\n<h3><strong>RAM 24GB DDR5 v&agrave; SSD 1TB tốc độ cao, n&acirc;ng cấp linh hoạt</strong></h3>\r\n\r\n<p>M&aacute;y được trang bị&nbsp;<strong>RAM 24GB DDR5-4800MHz (2x12GB)</strong>&nbsp;hoạt động ở chế độ&nbsp;<strong>dual-channel</strong>, gi&uacute;p xử l&yacute; đa nhiệm mượt m&agrave; kể cả khi chơi game, stream v&agrave; chạy nhiều t&aacute;c vụ c&ugrave;ng l&uacute;c. K&egrave;m theo đ&oacute; l&agrave;&nbsp;<strong>ổ cứng SSD 1TB PCIe 4.0x4 NVMe</strong>, mang lại tốc độ đọc ghi cực nhanh, đảm bảo thời gian khởi động m&aacute;y v&agrave; load game gần như tức th&igrave;. Ngo&agrave;i ra, hệ thống hỗ trợ&nbsp;<strong>hai khe SSD M.2</strong>, cho ph&eacute;p n&acirc;ng cấp tối đa l&ecirc;n đến&nbsp;<strong>2TB</strong>, đ&aacute;p ứng mọi nhu cầu lưu trữ dữ liệu, game v&agrave; ứng dụng đồ họa nặng.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-lenovo-legion-5-15irx10-83ly004gvn-01.jpg?v=1750768784927\" /></p>\r\n\r\n<h3><strong>Hệ thống tản nhiệt ColdFront 5.0 tối ưu cho hiệu năng d&agrave;i l&acirc;u</strong></h3>\r\n\r\n<p>Với&nbsp;<strong>hệ thống tản nhiệt ColdFront 5.0</strong>, m&aacute;y được trang bị&nbsp;<strong>2 quạt lớn v&agrave; nhiều ống dẫn nhiệt</strong>&nbsp;c&ugrave;ng c&aacute;c khe tho&aacute;t kh&iacute; bố tr&iacute; th&ocirc;ng minh, gi&uacute;p duy tr&igrave; nhiệt độ ổn định ngay cả khi chạy t&aacute;c vụ nặng hay chơi game trong thời gian d&agrave;i. C&ocirc;ng nghệ&nbsp;<strong>AI Engine+</strong>&nbsp;được t&iacute;ch hợp gi&uacute;p tối ưu hiệu năng theo từng ứng dụng, giữ m&aacute;y lu&ocirc;n m&aacute;t mẻ v&agrave; &ecirc;m &aacute;i. D&ugrave; l&agrave; game thủ hay content creator, bạn ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m về độ ổn định v&agrave; tuổi thọ linh kiện b&ecirc;n trong thiết bị.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-lenovo-legion-5-15irx10-83ly004gvn-03.jpg?v=1750768785017\" /></p>\r\n\r\n<h3><strong>Thiết kế cao cấp, b&agrave;n ph&iacute;m RGB 24 v&ugrave;ng đậm chất gaming</strong></h3>\r\n\r\n<p><strong>Lenovo Legion 5 15IRX10 83LY004GVN</strong>&nbsp;sở hữu vẻ ngo&agrave;i mạnh mẽ với lớp vỏ&nbsp;<strong>nh&ocirc;m anodized</strong>&nbsp;m&agrave;u&nbsp;<strong>Eclipse Black</strong>, trọng lượng chỉ&nbsp;<strong>1.9kg</strong>, mỏng từ&nbsp;<strong>19.95mm</strong>, rất linh hoạt khi mang theo. B&agrave;n ph&iacute;m&nbsp;<strong>RGB 24 v&ugrave;ng</strong>&nbsp;kh&ocirc;ng chỉ nổi bật về thẩm mỹ m&agrave; c&ograve;n mang lại trải nghiệm g&otilde; ph&iacute;m tuyệt vời với độ phản hồi cao. Touchpad k&iacute;ch thước lớn, hỗ trợ&nbsp;<strong>Precision TouchPad</strong>, cho thao t&aacute;c đa điểm mượt m&agrave;. Ngo&agrave;i ra, webcam&nbsp;<strong>5MP k&egrave;m E-shutter</strong>&nbsp;c&ugrave;ng &acirc;m thanh&nbsp;<strong>HARMAN tinh chỉnh bởi Nahimic</strong>&nbsp;sẽ n&acirc;ng tầm trải nghiệm gọi video v&agrave; giải tr&iacute; c&aacute; nh&acirc;n.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-lenovo-legion-5-15irx10-83ly004gvn-05.jpg?v=1750768785107\" /></p>\r\n\r\n<h3><strong>Kết nối Wi-Fi 7 si&ecirc;u tốc, pin lớn 80Wh v&agrave; sạc 245W</strong></h3>\r\n\r\n<p>Sản phẩm được trang bị chuẩn kết nối&nbsp;<strong>Wi-Fi 7 v&agrave; Bluetooth 5.4</strong>, đảm bảo tốc độ truy cập mạng nhanh v&agrave; ổn định trong mọi t&igrave;nh huống. Bộ cổng kết nối đa dạng gồm&nbsp;<strong>USB-C Gen 2 PD 100W</strong>,&nbsp;<strong>HDMI 2.1 hỗ trợ 8K/60Hz</strong>,&nbsp;<strong>Ethernet RJ-45</strong>, jack 3.5mm v&agrave; nhiều cổng USB-A tiện dụng. Pin dung lượng&nbsp;<strong>80Wh</strong>&nbsp;cho thời lượng sử dụng d&agrave;i, kết hợp sạc&nbsp;<strong>245W Slim Tip</strong>&nbsp;gi&uacute;p nạp đầy năng lượng nhanh ch&oacute;ng, sẵn s&agrave;ng cho c&aacute;c buổi l&agrave;m việc hay chơi game k&eacute;o d&agrave;i. M&aacute;y c&agrave;i sẵn&nbsp;<strong>Windows 11 Home</strong>&nbsp;bản quyền v&agrave;&nbsp;<strong>Office Home 2024</strong>, tặng k&egrave;m phần mềm&nbsp;<strong>Lenovo AI Now</strong>&nbsp;th&ocirc;ng minh.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-lenovo-legion-5-15irx10-83ly004gvn-06.jpg?v=1750768785147\" /></p>', '<p><strong><img src=\"http://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;Qu&agrave; k&egrave;m m&aacute;y&nbsp;Balo Acer Backpack&nbsp;(GWPLAPTOP-LN.AC.BP01)1</strong></p>\r\n\r\n<p><img src=\"http://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;<strong>Key Bản quyền&nbsp;Microsoft Office&nbsp;Professional Plus 2021&nbsp;</strong><a href=\"http://127.0.0.1:8000/product/12#\" target=\"_blank\"><em>(Đăng k&yacute; nhận key tại đ&acirc;y)</em></a></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1741950997Tag_KM_Office_Pro_2021.png.webp\" /></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/thumb/icon/1759487894Asset%202.png.webp\" />&nbsp;Nhập m&atilde;&nbsp;<strong>FREESHIPST</strong>&nbsp;miễn ph&iacute;&nbsp;<strong>Giao h&agrave;ng Si&ecirc;u Tốc (2 - 4H)&nbsp;</strong>&aacute;p dụng trong nội th&agrave;nh HCM &amp; H&agrave; Nội cho đơn h&agrave;ng tối thiểu&nbsp;<strong>300.000đ.</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1759715160TAG-KM-01.jpg.webp\" /></p>', 24000000.00, 28000000.00, 1.800, 1, 12, 5, 'products/HijVx7biNDkHjy96HLMxkKXUkGs0fxpyunNC9wRe.webp', 'AMD Ryzen 5 + 7535HS + NVIDIA RTX 3050 6GB GDDR6 + AMD Radeon Graphics + Full HD (1920 x 1080)', '2025-11-22 05:43:58', '2026-01-05 12:14:02'),
(13, 'LT010010TEST', 'Laptop Lenovo Thinkbook 14 Gen 8 IRL 21SG007PVA (Core 7 240H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS WUXGA 60Hz)', 'laptop-lenovo-lt010010test', 'mô tả ngắn về Laptop Lenovo Thinkbook 14 Gen 8', '<p><strong>Laptop Lenovo ThinkPad E14 Gen 7 21SX002SVA</strong>&nbsp;được trang bị&nbsp;<strong>bộ vi xử l&yacute; Intel&reg; Core&trade; Ultra 7 255H</strong>, sở hữu&nbsp;<strong>16 nh&acirc;n (6P + 8E + 2LPE), 24MB cache v&agrave; tốc độ turbo tối đa 5.1GHz</strong>, cho khả năng xử l&yacute; vượt trội mọi t&aacute;c vụ từ văn ph&ograve;ng, đồ họa đến lập tr&igrave;nh. Điểm nổi bật l&agrave;&nbsp;<strong>t&iacute;ch hợp NPU Intel AI Boost</strong>, mang lại hiệu suất AI chuy&ecirc;n biệt l&ecirc;n đến&nbsp;<strong>13 TOPS</strong>, gi&uacute;p tối ưu c&aacute;c ứng dụng AI thế hệ mới như tạo nội dung, xử l&yacute; ảnh th&ocirc;ng minh v&agrave; hội họp ảo. Đồ họa&nbsp;<strong>Intel Arc&trade; 140T</strong>&nbsp;t&iacute;ch hợp mang lại trải nghiệm mượt m&agrave; với c&aacute;c t&aacute;c vụ thiết kế 2D, dựng video nhẹ hoặc tr&igrave;nh chiếu đa phương tiện. Với hiệu suất mạnh mẽ v&agrave; khả năng hỗ trợ AI vượt trội, đ&acirc;y l&agrave; d&ograve;ng laptop l&yacute; tưởng cho doanh nh&acirc;n, kỹ sư AI, người s&aacute;ng tạo nội dung hoặc những ai cần một thiết bị hiệu năng cao v&agrave; linh hoạt trong c&ocirc;ng việc hiện đại.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva-01.jpg?v=1753089479280\" /></p>\r\n\r\n<h3><strong>Thiết kế si&ecirc;u mỏng nhẹ, chuẩn doanh nh&acirc;n với độ bền đạt chuẩn qu&acirc;n đội MIL-STD-810H</strong></h3>\r\n\r\n<p>Thiết kế của&nbsp;<strong>ThinkPad E14 Gen 7 21SX002SVA</strong>&nbsp;mang phong c&aacute;ch sang trọng v&agrave; chuy&ecirc;n nghiệp với&nbsp;<strong>vỏ nh&ocirc;m nguy&ecirc;n khối ở cả mặt tr&ecirc;n v&agrave; dưới</strong>, trọng lượng chỉ&nbsp;<strong>1.34kg</strong>&nbsp;v&agrave; độ mỏng tối đa&nbsp;<strong>19.7mm</strong>, l&yacute; tưởng để mang theo mỗi ng&agrave;y. M&aacute;y vượt qua&nbsp;<strong>b&agrave;i kiểm tra độ bền MIL-STD-810H</strong>, đảm bảo khả năng chống sốc, nhiệt độ, độ ẩm v&agrave; rung động khi l&agrave;m việc ngo&agrave;i trời hoặc di chuyển xa. Tổng thể thiết kế vẫn giữ chất &ldquo;ThinkPad&rdquo; đặc trưng, tối giản nhưng bền bỉ, ph&ugrave; hợp với m&ocirc;i trường c&ocirc;ng sở, ph&ograve;ng họp hoặc kh&ocirc;ng gian l&agrave;m việc s&aacute;ng tạo.&nbsp;<strong>Bản lề mở 180 độ</strong>, bề mặt chống b&aacute;m v&acirc;n tay, c&ugrave;ng độ ho&agrave;n thiện tinh tế biến thiết bị th&agrave;nh lựa chọn đ&aacute;ng tin cậy cho c&aacute;c chuy&ecirc;n gia thường xuy&ecirc;n l&agrave;m việc di động.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva-04.jpg?v=1753089479467\" /></p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh WUXGA sắc n&eacute;t, tỷ lệ 16:10 tối ưu trải nghiệm l&agrave;m việc d&agrave;i hạn</strong></h3>\r\n\r\n<p><strong>M&agrave;n h&igrave;nh 14 inch độ ph&acirc;n giải WUXGA (1920x1200)</strong>&nbsp;mang đến kh&ocirc;ng gian hiển thị rộng hơn với&nbsp;<strong>tỷ lệ 16:10</strong>, gi&uacute;p người d&ugrave;ng dễ d&agrave;ng thao t&aacute;c tr&ecirc;n bảng t&iacute;nh, văn bản v&agrave; t&agrave;i liệu d&agrave;i.&nbsp;<strong>Tấm nền IPS với độ s&aacute;ng 300 nits v&agrave; lớp phủ chống ch&oacute;i</strong>, cho ph&eacute;p l&agrave;m việc thoải m&aacute;i trong nhiều điều kiện &aacute;nh s&aacute;ng kh&aacute;c nhau, kể cả khi ngồi cạnh cửa sổ hay ngo&agrave;i trời. Tuy chỉ đạt&nbsp;<strong>45% NTSC</strong>, nhưng m&agrave;n h&igrave;nh vẫn đủ d&ugrave;ng cho c&aacute;c t&aacute;c vụ văn ph&ograve;ng, xem phim, học tập v&agrave; l&agrave;m việc cơ bản. Sự kết hợp giữa độ ph&acirc;n giải cao, g&oacute;c nh&igrave;n rộng v&agrave; chống mỏi mắt đ&atilde; được&nbsp;<strong>chứng nhận T&Uuml;V Rheinland&reg; Low Blue Light</strong>, gi&uacute;p bảo vệ thị gi&aacute;c trong c&aacute;c phi&ecirc;n l&agrave;m việc k&eacute;o d&agrave;i. Đ&acirc;y l&agrave; điểm cộng đ&aacute;ng gi&aacute; cho nh&acirc;n vi&ecirc;n văn ph&ograve;ng, sinh vi&ecirc;n v&agrave; những ai cần gắn b&oacute; l&acirc;u d&agrave;i với m&agrave;n h&igrave;nh laptop.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva-02.jpg?v=1753089479337\" /></p>\r\n\r\n<h3><strong>&Acirc;m thanh Dolby Atmos&reg; v&agrave; b&agrave;n ph&iacute;m ThinkPad trứ danh hỗ trợ l&agrave;m việc hiệu quả</strong></h3>\r\n\r\n<p>Trải nghiệm nhập liệu v&agrave; &acirc;m thanh tr&ecirc;n&nbsp;<strong>Laptop Lenovo ThinkPad E14 Gen 7 21SX002SVA</strong>&nbsp;thực sự vượt mong đợi.&nbsp;<strong>B&agrave;n ph&iacute;m backlit</strong>&nbsp;mang đến cảm gi&aacute;c g&otilde; &ecirc;m, h&agrave;nh tr&igrave;nh ph&iacute;m s&acirc;u, phản hồi chắc tay &ndash; đ&uacute;ng chuẩn &ldquo;ThinkPad huyền thoại&rdquo;, gi&uacute;p tăng hiệu suất đ&aacute;nh m&aacute;y, lập tr&igrave;nh hay viết nội dung.&nbsp;<strong>Touchpad ch&iacute;nh x&aacute;c cao</strong>, mượt m&agrave; với cử chỉ đa điểm, hỗ trợ thao t&aacute;c nhanh ch&oacute;ng. Hệ thống&nbsp;<strong>&acirc;m thanh 2 loa stereo c&ocirc;ng suất 2W x2</strong>&nbsp;kết hợp c&ocirc;ng nghệ&nbsp;<strong>Dolby Atmos&reg;, tinh chỉnh bởi Harman</strong>, mang lại chất &acirc;m r&otilde; n&eacute;t, sống động cho cả họp online v&agrave; giải tr&iacute;. Webcam&nbsp;<strong>FHD 1080p kết hợp cảm biến hồng ngoại (IR)</strong>&nbsp;hỗ trợ đăng nhập&nbsp;<strong>Windows Hello</strong>&nbsp;qua nhận diện khu&ocirc;n mặt, k&egrave;m theo&nbsp;<strong>camera privacy shutter</strong>, đảm bảo quyền ri&ecirc;ng tư tuyệt đối. Tất cả đều tạo n&ecirc;n m&ocirc;i trường l&agrave;m việc chuy&ecirc;n nghiệp, hiệu quả v&agrave; an to&agrave;n.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva-05.jpg?v=1753089479523\" /></p>\r\n\r\n<h3><strong>Hệ thống kết nối hiện đại, đầy đủ cổng mở rộng, hỗ trợ cả Thunderbolt&trade; 4 v&agrave; USB-C&reg; 20Gbps</strong></h3>\r\n\r\n<p>Kh&ocirc;ng như nhiều laptop mỏng nhẹ kh&aacute;c phải hy sinh kết nối,&nbsp;<strong>ThinkPad E14 Gen 7 21SX002SVA</strong>&nbsp;vẫn trang bị&nbsp;<strong>đa dạng cổng I/O tốc độ cao</strong>&nbsp;gồm:&nbsp;<strong>2 x USB-C&reg; (Thunderbolt&trade; 4 / USB4&reg; 40Gbps v&agrave; USB 3.2 Gen2x2 20Gbps), 2 x USB-A (1 x Gen 1, 1 x Gen 2 Always-On), HDMI&reg; 2.1 hỗ trợ 4K@60Hz, cổng mạng RJ-45 v&agrave; jack &acirc;m thanh combo 3.5mm</strong>. C&aacute;c cổng USB-C đều hỗ trợ&nbsp;<strong>Power Delivery v&agrave; DisplayPort</strong>, gi&uacute;p bạn vừa sạc, vừa truyền h&igrave;nh ảnh với m&agrave;n h&igrave;nh rời chất lượng cao. Ngo&agrave;i ra, m&aacute;y c&ograve;n tương th&iacute;ch với nhiều giải ph&aacute;p docking qua USB-C hoặc Thunderbolt&trade;, tăng cường khả năng mở rộng cho d&acirc;n văn ph&ograve;ng sử dụng nhiều thiết bị ngoại vi. Chuẩn&nbsp;<strong>Wi-Fi 6E AX211</strong>&nbsp;v&agrave;&nbsp;<strong>Bluetooth 5.3</strong>&nbsp;cho ph&eacute;p kết nối mạng si&ecirc;u nhanh, ổn định v&agrave; tiết kiệm điện &ndash; phục vụ tốt trong m&ocirc;i trường l&agrave;m việc hiện đại, hội họp trực tuyến hoặc truy cập cloud li&ecirc;n tục.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva-06.jpg?v=1753089479590\" /></p>\r\n\r\n<h3><strong>Pin 48Wh bền bỉ, dễ n&acirc;ng cấp RAM/SSD v&agrave; bảo h&agrave;nh uy t&iacute;n tại MemoryZone</strong></h3>\r\n\r\n<p><strong>Vi&ecirc;n pin 48Wh</strong>&nbsp;gi&uacute;p m&aacute;y hoạt động bền bỉ trong nhiều giờ sử dụng thực tế, đ&aacute;p ứng trọn vẹn một buổi họp hoặc ca l&agrave;m việc d&agrave;i. Với&nbsp;<strong>bộ sạc 65W USB-C&reg;</strong>, m&aacute;y hỗ trợ sạc nhanh, tiện lợi khi di chuyển. Điểm cộng lớn l&agrave;&nbsp;<strong>RAM 16GB DDR5-5600 (c&oacute; 2 khe, n&acirc;ng cấp tối đa 64GB)</strong>&nbsp;v&agrave; ổ SSD&nbsp;<strong>512GB PCIe 4.0</strong>&nbsp;đều c&oacute; thể n&acirc;ng cấp dễ d&agrave;ng &ndash; ph&ugrave; hợp với người d&ugrave;ng muốn mở rộng hiệu suất l&acirc;u d&agrave;i. Hệ thống tản nhiệt được tối ưu nhờ thiết kế th&ocirc;ng minh v&agrave; vật liệu nh&ocirc;m, gi&uacute;p m&aacute;y lu&ocirc;n m&aacute;t mẻ v&agrave; y&ecirc;n tĩnh khi vận h&agrave;nh. Ngo&agrave;i ra,&nbsp;<strong>bảo mật v&acirc;n tay t&iacute;ch hợp n&uacute;t nguồn</strong>,&nbsp;<strong>TPM 2.0</strong>,&nbsp;<strong>khe kh&oacute;a Kensington Nano</strong>&nbsp;đều g&oacute;p phần gia tăng t&iacute;nh an to&agrave;n cho dữ liệu người d&ugrave;ng. M&aacute;y được bảo h&agrave;nh ch&iacute;nh h&atilde;ng&nbsp;<strong>1 năm theo chuẩn Premier Support</strong>, n&acirc;ng cấp tiện lợi tại MemoryZone với ch&iacute;nh s&aacute;ch&nbsp;<strong>0% trả g&oacute;p, giao h&agrave;ng si&ecirc;u tốc 2&ndash;4H v&agrave; hậu m&atilde;i uy t&iacute;n</strong>.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva-03.jpg?v=1753089479407\" /></p>\r\n\r\n<p><strong>Bạn đang quan t&acirc;m đến&nbsp;<a href=\"https://memoryzone.com.vn/laptop-lenovo-thinkpad-e14-gen-7-21sx002sva\">Laptop Lenovo ThinkPad E14 Gen 7 21SX002SVA</a>? Đang c&ograve;n đang băn khoăn chưa biết c&oacute; n&ecirc;n mua sản phẩm hay kh&ocirc;ng?</strong></p>', '<p><strong><img src=\"http://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;Qu&agrave; k&egrave;m m&aacute;y&nbsp;Balo Acer Backpack&nbsp;(GWPLAPTOP-LN.AC.BP01)1</strong></p>\r\n\r\n<p><img src=\"http://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;<strong>Key Bản quyền&nbsp;Microsoft Office&nbsp;Professional Plus 2021&nbsp;</strong><a href=\"http://127.0.0.1:8000/product/12#\" target=\"_blank\"><em>(Đăng k&yacute; nhận key tại đ&acirc;y)</em></a></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1741950997Tag_KM_Office_Pro_2021.png.webp\" /></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/thumb/icon/1759487894Asset%202.png.webp\" />&nbsp;Nhập m&atilde;&nbsp;<strong>FREESHIPST</strong>&nbsp;miễn ph&iacute;&nbsp;<strong>Giao h&agrave;ng Si&ecirc;u Tốc (2 - 4H)&nbsp;</strong>&aacute;p dụng trong nội th&agrave;nh HCM &amp; H&agrave; Nội cho đơn h&agrave;ng tối thiểu&nbsp;<strong>300.000đ.</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1759715160TAG-KM-01.jpg.webp\" /></p>', 2100000.00, 29000000.00, 1.700, 1, 12, 5, 'products/15A8pvPigrFBICK8sM2KTARS3bXjTQ4Bvp9C8Rxb.jpg', 'Intel Core 7 + Intel Graphics + 16 GB (1 x 16GB) + 512 GB M.2 2242 PCIe Gen 4x4', '2025-11-22 06:03:29', '2026-01-04 23:52:48'),
(14, 'LT010012TEST', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 'laptop-msi-lt010012test', 'mô tả ngắn về Laptop MSI Katana 15 HX B14WFK-025VN', '<h2>Đặc điểm nổi bật của Laptop MSI Katana 15 HX B14WFK-025VN</h2>\r\n\r\n<p><strong>Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch 2K QHD IPS 165Hz)</strong>&nbsp;nổi bật với thiết kế đậm chất gaming, đường n&eacute;t g&oacute;c cạnh kết hợp t&ocirc;ng m&agrave;u đen mạnh mẽ. M&aacute;y được ho&agrave;n thiện từ chất liệu nhựa cao cấp, tạo sự chắc chắn m&agrave; vẫn giữ trọng lượng 2.4kg ph&ugrave; hợp cho việc di chuyển. K&iacute;ch thước 359 x 262 x 25.5 mm mang lại cảm gi&aacute;c gọn g&agrave;ng trong ph&acirc;n kh&uacute;c laptop gaming 15.6 inch. B&agrave;n ph&iacute;m&nbsp;<strong>RGB 4 v&ugrave;ng</strong>&nbsp;với ph&iacute;m Copilot Key gi&uacute;p thao t&aacute;c nhanh ch&oacute;ng, vừa tạo điểm nhấn thẩm mỹ, vừa n&acirc;ng cao hiệu suất l&agrave;m việc v&agrave; giải tr&iacute;.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-msi-katana-15-hx-b14wek-025vn-01.jpg?v=1758862580710\" /></p>\r\n\r\n<h3><strong>Sức mạnh từ Intel Core i7-14650HX thế hệ 14</strong></h3>\r\n\r\n<p>M&aacute;y được trang bị&nbsp;<strong>Intel Core i7-14650HX</strong>, bộ vi xử l&yacute; hiệu năng cao thuộc thế hệ mới nhất, với&nbsp;<strong>16 nh&acirc;n 24 luồng</strong>, xung nhịp tối đa 5.2GHz v&agrave; bộ nhớ đệm 30MB. Đ&acirc;y l&agrave; lựa chọn l&yacute; tưởng cho c&aacute;c t&aacute;c vụ đa nhiệm nặng, từ chơi game AAA đến chỉnh sửa video, lập tr&igrave;nh hay l&agrave;m việc chuy&ecirc;n nghiệp. Với nền tảng HX series, Katana 15 mang lại sức mạnh vượt trội, sẵn s&agrave;ng đồng h&agrave;nh c&ugrave;ng game thủ v&agrave; người d&ugrave;ng s&aacute;ng tạo nội dung.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-msi-katana-15-hx-b14wek-025vn-02.jpg?v=1758862580783\" /></p>\r\n\r\n<h3><strong>Card đồ họa RTX 5060 8GB GDDR7, trải nghiệm gaming mượt m&agrave;</strong></h3>\r\n\r\n<p>Hiệu năng đồ họa của&nbsp;<strong>MSI Katana 15 HX B14WEK-025VN</strong>&nbsp;được n&acirc;ng tầm với&nbsp;<strong>NVIDIA GeForce RTX 5060 8GB GDDR7</strong>, TGP 115W. GPU thế hệ mới kh&ocirc;ng chỉ cải thiện khả năng xử l&yacute; h&igrave;nh ảnh m&agrave; c&ograve;n hỗ trợ&nbsp;<strong>Ray Tracing</strong>&nbsp;v&agrave;&nbsp;<strong>DLSS</strong>, gi&uacute;p t&aacute;i hiện khung h&igrave;nh ch&acirc;n thực, sống động v&agrave; mượt m&agrave; trong mọi tựa game. Với tổng thể AI TOPS đạt 572, laptop c&ograve;n hỗ trợ tốt c&aacute;c t&aacute;c vụ AI thế hệ mới, mang đến lợi thế đ&aacute;ng kể cho cả game thủ lẫn nh&agrave; s&aacute;ng tạo nội dung.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-msi-katana-15-hx-b14wek-025vn-03.jpg?v=1758862580830\" /></p>\r\n\r\n<h3><strong>RAM DDR5 16GB v&agrave; SSD PCIe Gen 4 tốc độ cao</strong></h3>\r\n\r\n<p>M&aacute;y được trang bị sẵn 16<strong>GB DDR5 bus 5600MHz</strong>&nbsp;(2x16GB), tối ưu cho khả năng đa nhiệm với nhiều ứng dụng c&ugrave;ng l&uacute;c. Với 2 khe RAM rời, người d&ugrave;ng c&oacute; thể n&acirc;ng cấp tối đa l&ecirc;n đến&nbsp;<strong>96GB</strong>, đảm bảo t&iacute;nh linh hoạt l&acirc;u d&agrave;i. Hệ thống lưu trữ bao gồm&nbsp;<strong>SSD PCIe Gen 4 512GB M.2 2280</strong>, mang đến tốc độ truy xuất cực nhanh, giảm thiểu thời gian tải game v&agrave; phần mềm, đồng thời đ&aacute;p ứng tốt cho nhu cầu lưu trữ dữ liệu lớn.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-msi-katana-15-hx-b14wek-025vn-04.jpg?v=1758862580890\" /></p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh 2K 165Hz, hiển thị mượt m&agrave; v&agrave; chuẩn m&agrave;u</strong></h3>\r\n\r\n<p><strong>MSI Katana 15 HX B14WEK-025VN</strong>&nbsp;sở hữu m&agrave;n h&igrave;nh&nbsp;<strong>15.6 inch QHD (2560x1440) IPS</strong>, tần số qu&eacute;t&nbsp;<strong>165Hz</strong>&nbsp;v&agrave; độ s&aacute;ng 300 nits, mang lại trải nghiệm hiển thị mượt m&agrave;, sắc n&eacute;t. Với dải m&agrave;u&nbsp;<strong>100% DCI-P3</strong>, m&agrave;n h&igrave;nh t&aacute;i hiện m&agrave;u sắc ch&iacute;nh x&aacute;c, ph&ugrave; hợp cho cả chơi game lẫn c&ocirc;ng việc đồ họa, chỉnh sửa h&igrave;nh ảnh hoặc dựng video. Khung h&igrave;nh rộng c&ugrave;ng tỷ lệ 16:10 hiện đại gi&uacute;p người d&ugrave;ng tận dụng tối đa kh&ocirc;ng gian hiển thị, tăng hiệu suất l&agrave;m việc đa nhiệm.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-msi-katana-15-hx-b14wek-025vn-06.jpg?v=1758862580990\" /></p>\r\n\r\n<h3><strong>Hệ thống tản nhiệt v&agrave; kết nối to&agrave;n diện</strong></h3>\r\n\r\n<p>Laptop được trang bị hệ thống tản nhiệt ti&ecirc;n tiến, duy tr&igrave; nhiệt độ ổn định cho cả CPU v&agrave; GPU trong c&aacute;c t&aacute;c vụ nặng. Pin dung lượng&nbsp;<strong>75Wh</strong>&nbsp;kết hợp adapter&nbsp;<strong>240W</strong>&nbsp;đảm bảo hiệu năng ổn định trong c&aacute;c phi&ecirc;n gaming k&eacute;o d&agrave;i. Về kết nối, m&aacute;y hỗ trợ đầy đủ cổng hiện đại:&nbsp;<strong>1x USB-C Gen 2 (DisplayPort/Power Delivery), 3x USB-A Gen 2, HDMI 2.1 (8K@60Hz / 4K@120Hz), LAN RJ45, jack combo tai nghe, Wi-Fi 6E v&agrave; Bluetooth 5.3</strong>, mang lại sự tiện lợi cho cả học tập, l&agrave;m việc v&agrave; giải tr&iacute;.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-msi-katana-15-hx-b14wek-025vn-05.jpg?v=1758862580943\" /></p>\r\n\r\n<h3><strong>So s&aacute;nh MSI Katana 15 HX B14WEK-025VN với sản phẩm c&ugrave;ng ph&acirc;n kh&uacute;c</strong></h3>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th>Ti&ecirc;u ch&iacute;</th>\r\n			<th><strong>MSI Katana 15 HX B14WEK-025VN</strong></th>\r\n			<th><strong>ASUS TUF Gaming F16 (FX608, i7-14650HX + RTX 4060)</strong></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>CPU</strong></td>\r\n			<td>Intel Core i7-14650HX (16 nh&acirc;n, 24 luồng, 5.2GHz, 30MB cache)</td>\r\n			<td>Intel Core i7-14650HX (16 nh&acirc;n, 24 luồng, 5.2GHz, 30MB cache)</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>GPU</strong></td>\r\n			<td>NVIDIA GeForce&nbsp;<strong>RTX 5060 8GB GDDR7</strong>, TGP 115W, 572 AI TOPS</td>\r\n			<td>NVIDIA GeForce&nbsp;<strong>RTX 4060 8GB GDDR6</strong>, TGP ~140W (Dynamic Boost)</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>RAM</strong></td>\r\n			<td>16GB DDR5 (2x8GB), bus 5600MHz, n&acirc;ng cấp tối đa 96GB</td>\r\n			<td>16GB DDR5, bus 5600MHz, n&acirc;ng cấp tối đa 64GB</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Ổ cứng</strong></td>\r\n			<td>512GB SSD PCIe Gen4x4, 1 khe M.2</td>\r\n			<td>512GB SSD PCIe Gen4x4, hỗ trợ th&ecirc;m khe mở rộng</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>M&agrave;n h&igrave;nh</strong></td>\r\n			<td>15.6 inch&nbsp;<strong>2K (2560x1440)</strong>, IPS, 165Hz, 100% DCI-P3, 300 nits</td>\r\n			<td>16 inch&nbsp;<strong>WUXGA (1920x1200)</strong>, IPS, 165Hz, 100% sRGB, 300 nits</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Kết nối</strong></td>\r\n			<td>1x USB-C (DP/PD 3.0), 3x USB-A 3.2 Gen2, HDMI 2.1 (8K60 / 4K120), Wi-Fi 6E, BT 5.3</td>\r\n			<td>1x USB-C (DP/PD 3.0), 2x USB-A 3.2, 1x HDMI 2.1, LAN RJ-45, Wi-Fi 6E, BT 5.3</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>B&agrave;n ph&iacute;m</strong></td>\r\n			<td>4-Zone RGB Gaming Keyboard, c&oacute; ph&iacute;m&nbsp;<strong>Copilot AI</strong></td>\r\n			<td>RGB Keyboard (1-Zone hoặc 4-Zone tuỳ phi&ecirc;n bản)</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Pin &amp; Sạc</strong></td>\r\n			<td>Pin 75Wh, sạc 240W</td>\r\n			<td>Pin&nbsp;<strong>90Wh</strong>, sạc 240W</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Trọng lượng &amp; K&iacute;ch thước</strong></td>\r\n			<td>2.4kg, 359 x 262 x 25.5 mm</td>\r\n			<td>2.3kg, 355 x 252 x 25 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Hệ điều h&agrave;nh</strong></td>\r\n			<td>Windows 11 Home</td>\r\n			<td>Windows 11 Home</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Bảo mật</strong></td>\r\n			<td>TPM 2.0, webcam shutter</td>\r\n			<td>TPM 2.0, webcam shutter</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Bảo h&agrave;nh</strong></td>\r\n			<td>24 th&aacute;ng ch&iacute;nh h&atilde;ng</td>\r\n			<td>24 th&aacute;ng ch&iacute;nh h&atilde;ng</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>Đ&aacute;nh gi&aacute; chung:</strong>&nbsp;<strong>MSI Katana 15 HX B14WEK-025VN</strong>: điểm mạnh l&agrave;&nbsp;<strong>GPU RTX 5060 GDDR7 thế hệ mới</strong>, hỗ trợ AI TOPS cao hơn, m&agrave;n h&igrave;nh&nbsp;<strong>2K 165Hz 100% DCI-P3</strong>, RAM n&acirc;ng cấp tới 96GB &ndash; ph&ugrave; hợp cho cả gaming lẫn s&aacute;ng tạo nội dung.</p>', '<p><a href=\"#\"><strong><img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;Tặng&nbsp;</strong><strong>Balo MSI Essential Backpack 15.6 inch&nbsp;</strong><em>(Xem chi tiết)</em></a></p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;<strong>Key Bản quyền&nbsp;Microsoft Office&nbsp;Professional Plus 2021&nbsp;</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1741950997Tag_KM_Office_Pro_2021.png.webp\" /></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', 24000000.00, 28000000.00, 1.800, 1, 12, 2, 'products/JDRQONEH5S61fbmJdT9wLZkOVHRDrgkeLuLWaTD5.jpg', 'i7 14650HX 16GB 512GB + RTX 5060', '2025-12-02 23:12:07', '2025-12-09 08:55:49'),
(15, 'LT010013TEST', 'Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA (Ultra 5 225U, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 'laptop-lenovo-lt010013test', 'mô tả ngắn về Laptop Lenovo ThinkPad E16 Gen', '<h2>Đặc điểm nổi bật của Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA</h2>\r\n\r\n<p><strong>Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA (Ultra 5 255U, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz)</strong>&nbsp;được trang bị&nbsp;<strong>Intel&reg; Core&trade; Ultra 5 225U</strong>, bộ vi xử l&yacute; thế hệ mới với&nbsp;<strong>12 nh&acirc;n (2 Performance + 8 Efficient + 2 Low Power)</strong>&nbsp;v&agrave;&nbsp;<strong>14 luồng</strong>, cho khả năng xử l&yacute; mượt m&agrave; c&aacute;c t&aacute;c vụ văn ph&ograve;ng, đa nhiệm v&agrave; cả lập tr&igrave;nh. Với xung nhịp&nbsp;<strong>tối đa l&ecirc;n đến 4.8GHz</strong>&nbsp;v&agrave; bộ nhớ đệm&nbsp;<strong>12MB Cache</strong>, sản phẩm mang lại hiệu năng tối ưu c&ugrave;ng khả năng tiết kiệm điện năng nhờ kiến tr&uacute;c hybrid th&ocirc;ng minh. Việc t&iacute;ch hợp&nbsp;<strong>Intel AI Boost NPU</strong>&nbsp;cũng gi&uacute;p xử l&yacute; t&aacute;c vụ AI nhanh v&agrave; hiệu quả hơn, hỗ trợ tối đa c&aacute;c phần mềm s&aacute;ng tạo v&agrave; năng suất cao cấp hiện nay.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e16-gen-3-21sr002jva-01.jpg?v=1753167293470\" /><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e16-gen-3-21sr002jva-02.jpg?v=1753167293540\" /><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e16-gen-3-21sr002jva-03.jpg?v=1753167293587\" /><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e16-gen-3-21sr002jva-04.jpg?v=1753167293630\" /><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e16-gen-3-21sr002jva-05.jpg?v=1753167293677\" /><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-lenovo-thinkpad-e16-gen-3-21sr002jva-06.jpg?v=1753167293720\" /></p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh lớn 16 inch WUXGA cho trải nghiệm hiển thị r&otilde; n&eacute;t, chuy&ecirc;n nghiệp</strong></h3>\r\n\r\n<p>Thiết bị sở hữu&nbsp;<strong>m&agrave;n h&igrave;nh 16 inch độ ph&acirc;n giải WUXGA (1920 x 1200)</strong>, c&ocirc;ng nghệ&nbsp;<strong>IPS chống ch&oacute;i</strong>, gi&uacute;p hiển thị h&igrave;nh ảnh sắc n&eacute;t, m&agrave;u sắc ch&acirc;n thực từ mọi g&oacute;c nh&igrave;n. Tỷ lệ khung h&igrave;nh&nbsp;<strong>16:10</strong>&nbsp;tối ưu hơn cho nhu cầu l&agrave;m việc đa cửa sổ, thiết kế đồ họa hoặc xử l&yacute; bảng t&iacute;nh. Với độ s&aacute;ng&nbsp;<strong>300 nits</strong>, tần số qu&eacute;t&nbsp;<strong>60Hz</strong>&nbsp;v&agrave; viền mỏng tinh tế,&nbsp;<strong>Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA</strong>&nbsp;mang lại kh&ocirc;ng gian hiển thị rộng r&atilde;i, l&yacute; tưởng cho cả c&ocirc;ng việc lẫn giải tr&iacute; đa phương tiện.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Thiết kế bền bỉ chuẩn qu&acirc;n đội, ph&ugrave; hợp cho m&ocirc;i trường l&agrave;m việc chuy&ecirc;n nghiệp</strong></h3>\r\n\r\n<p>Được chế t&aacute;c theo phong c&aacute;ch tối giản v&agrave; chắc chắn, sản phẩm sử dụng vật liệu cao cấp v&agrave; đạt ti&ecirc;u chuẩn&nbsp;<strong>độ bền qu&acirc;n sự MIL-STD-810H</strong>, đảm bảo khả năng hoạt động ổn định trong nhiều điều kiện m&ocirc;i trường. Bản lề linh hoạt, b&agrave;n ph&iacute;m chống tr&agrave;n v&agrave; h&agrave;nh tr&igrave;nh ph&iacute;m s&acirc;u mang lại cảm gi&aacute;c g&otilde; &ecirc;m &aacute;i, ch&iacute;nh x&aacute;c &ndash; một trong những đặc trưng được y&ecirc;u th&iacute;ch tr&ecirc;n d&ograve;ng ThinkPad. Trọng lượng khoảng&nbsp;<strong>1.76kg</strong>, sản phẩm c&acirc;n bằng giữa t&iacute;nh di động v&agrave; độ bền đ&aacute;ng tin cậy, th&iacute;ch hợp cho doanh nh&acirc;n, kỹ sư v&agrave; nh&acirc;n vi&ecirc;n văn ph&ograve;ng thường xuy&ecirc;n di chuyển.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Trang bị RAM DDR5 v&agrave; SSD tốc độ cao cho khả năng đa nhiệm mượt m&agrave;</strong></h3>\r\n\r\n<p>Với&nbsp;<strong>RAM 16GB LPDDR5x</strong>&nbsp;chạy ở bus cao&nbsp;<strong>7500MHz</strong>&nbsp;(onboard),&nbsp;<strong>Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA</strong>&nbsp;hỗ trợ đa nhiệm hiệu quả, từ mở nhiều tab tr&igrave;nh duyệt đến xử l&yacute; c&aacute;c phần mềm nặng như AutoCAD, Photoshop. Ổ cứng&nbsp;<strong>SSD 512GB M.2 PCIe Gen4 NVMe</strong>&nbsp;mang lại tốc độ truy xuất si&ecirc;u nhanh, khởi động m&aacute;y v&agrave; mở phần mềm chỉ trong t&iacute;ch tắc, đồng thời đảm bảo kh&ocirc;ng gian lưu trữ rộng r&atilde;i v&agrave; ổn định cho dữ liệu c&ocirc;ng việc v&agrave; c&aacute; nh&acirc;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Kết nối hiện đại, đầy đủ cổng giao tiếp hỗ trợ tối đa cho c&ocirc;ng việc</strong></h3>\r\n\r\n<p>M&aacute;y được trang bị đầy đủ c&aacute;c cổng kết nối gồm&nbsp;<strong>2 cổng USB-C (1 cổng hỗ trợ PD &amp; DisplayPort 1.4)</strong>,&nbsp;<strong>2 cổng USB-A 3.2 Gen1</strong>,&nbsp;<strong>HDMI 1.4b</strong>,&nbsp;<strong>LAN RJ45</strong>,&nbsp;<strong>jack combo audio</strong>, v&agrave;&nbsp;<strong>khe kh&oacute;a Kensington</strong>, hỗ trợ tối đa trong m&ocirc;i trường doanh nghiệp hoặc setup đa m&agrave;n h&igrave;nh. Ngo&agrave;i ra, kết nối&nbsp;<strong>Wi-Fi 6 v&agrave; Bluetooth 5.1</strong>&nbsp;đảm bảo đường truyền kh&ocirc;ng d&acirc;y ổn định v&agrave; tốc độ cao, mang lại sự tiện lợi trong mọi ho&agrave;n cảnh sử dụng, đặc biệt khi l&agrave;m việc từ xa hoặc họp trực tuyến.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Bảo mật v&agrave; trải nghiệm tối ưu cho m&ocirc;i trường doanh nghiệp</strong></h3>\r\n\r\n<p>ThinkPad E16 Gen 3 hỗ trợ bảo mật n&acirc;ng cao với&nbsp;<strong>firmware TPM 2.0</strong>&nbsp;v&agrave;&nbsp;<strong>cảm biến v&acirc;n tay t&iacute;ch hợp tr&ecirc;n n&uacute;t nguồn</strong>, gi&uacute;p bảo vệ dữ liệu an to&agrave;n tuyệt đối. Webcam&nbsp;<strong>FHD hỗ trợ Privacy Shutter</strong>&nbsp;bảo vệ quyền ri&ecirc;ng tư, đồng thời tối ưu chất lượng h&igrave;nh ảnh khi gọi video. Hệ điều h&agrave;nh&nbsp;<strong>Windows 11 Home bản quyền</strong>&nbsp;đi k&egrave;m mang đến giao diện trực quan, tối ưu cho c&ocirc;ng việc. B&ecirc;n cạnh đ&oacute;, Lenovo cũng cung cấp phần mềm quản l&yacute; điện năng th&ocirc;ng minh, gi&uacute;p m&aacute;y hoạt động ổn định v&agrave; tiết kiệm pin.</p>\r\n\r\n<p>&nbsp;</p>', '<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;<strong>Tặng Key&nbsp;Windows 11 Pro</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1761282357HUY-HIEU.png.webp\" /></p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;<strong>Key Bản quyền&nbsp;Microsoft Office&nbsp;Professional Plus 2021</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1741950997Tag_KM_Office_Pro_2021.png.webp\" /></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', 25000000.00, 28000000.00, 1.800, 1, 12, 5, 'products/vb8WDV3RCfQ91PctvZ309nE9xnXo44FwICz2dwNb.webp', 'Core Ultra 5 16 GB + 512 GB M.2 2242 PCIe Gen 4x4', '2025-12-03 01:11:49', '2025-12-09 08:55:42'),
(16, 'LT010014TEST', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 'laptop-msi-lt010014test', 'mô tả ngắn về Laptop Gaming MSI Crosshair', '<h2>Đặc điểm nổi bật của Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN</h2>\r\n\r\n<p><strong>Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)</strong>&nbsp;được trang bị vi xử l&yacute;&nbsp;<strong>Intel Core Ultra 7 155H</strong>&nbsp;mới nhất, mang kiến tr&uacute;c lai với&nbsp;<strong>NPU AI chuy&ecirc;n dụng</strong>, hỗ trợ xử l&yacute; th&ocirc;ng minh, tiết kiệm điện năng v&agrave; tăng tốc t&aacute;c vụ bằng tr&iacute; tuệ nh&acirc;n tạo. C&ugrave;ng với đ&oacute; l&agrave;&nbsp;<strong>card đồ họa rời NVIDIA GeForce RTX 5060 8GB GDDR7</strong>, tối ưu trải nghiệm gaming với&nbsp;<strong>Dynamic Boost</strong>&nbsp;v&agrave; hỗ trợ&nbsp;<strong>DLSS 4</strong>,&nbsp;<strong>Ray Tracing thế hệ mới</strong>, gi&uacute;p người d&ugrave;ng chinh phục mọi tựa game AAA, livestream hoặc l&agrave;m đồ họa n&acirc;ng cao một c&aacute;ch mượt m&agrave;.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-msi-crosshair-16-hx-ai-d2xwfkg-036vn-01.jpg?v=1748609200633\" /></p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh 16&quot; QHD+ 240Hz sắc n&eacute;t &ndash; tốc độ khung h&igrave;nh si&ecirc;u mượt cho game thủ chuy&ecirc;n nghiệp</strong></h3>\r\n\r\n<p>Chiếc laptop n&agrave;y sở hữu&nbsp;<strong>m&agrave;n h&igrave;nh 16 inch QHD+ (2560 x 1600)</strong>&nbsp;với&nbsp;<strong>tần số qu&eacute;t 240Hz</strong>, hỗ trợ&nbsp;<strong>100% dải m&agrave;u DCI-P3</strong>&nbsp;v&agrave; tấm nền&nbsp;<strong>IPS-level</strong>, mang đến h&igrave;nh ảnh cực kỳ sắc n&eacute;t v&agrave; sống động. Tỷ lệ 16:10 cho kh&ocirc;ng gian hiển thị rộng r&atilde;i hơn, rất l&yacute; tưởng cho c&aacute;c game thủ y&ecirc;u cầu tốc độ phản hồi nhanh, cũng như người s&aacute;ng tạo nội dung cần m&agrave;u sắc ch&iacute;nh x&aacute;c. Độ mượt khi chơi game FPS, MOBA, esport được đảm bảo nhờ thời gian phản hồi si&ecirc;u nhanh v&agrave; độ ph&acirc;n giải cao.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-msi-crosshair-16-hx-ai-d2xwfkg-036vn-03.jpg?v=1748609200780\" /></p>\r\n\r\n<h3><strong>Tản nhiệt Cooler Boost tối ưu, kiểm so&aacute;t nhiệt độ th&ocirc;ng minh v&agrave; y&ecirc;n tĩnh</strong></h3>\r\n\r\n<p><strong>MSI Crosshair 16 HX AI</strong>&nbsp;được trang bị hệ thống tản nhiệt&nbsp;<strong>Cooler Boost</strong>&nbsp;với&nbsp;<strong>2 quạt v&agrave; nhiều ống đồng</strong>, tối ưu khả năng l&agrave;m m&aacute;t ngay cả khi CPU v&agrave; GPU hoạt động ở hiệu suất cao. Thiết kế khe tản nhiệt th&ocirc;ng minh đảm bảo luồng gi&oacute; được lưu th&ocirc;ng li&ecirc;n tục, gi&uacute;p m&aacute;y lu&ocirc;n m&aacute;t v&agrave; vận h&agrave;nh ổn định kể cả khi chơi game nặng hoặc l&agrave;m việc trong thời gian d&agrave;i. Đ&acirc;y l&agrave; yếu tố quan trọng đảm bảo hiệu suất bền vững cho game thủ v&agrave; content creator chuy&ecirc;n nghiệp.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-msi-crosshair-16-hx-ai-d2xwfkg-036vn-04.jpg?v=1748609200837\" /></p>\r\n\r\n<h3><strong>RAM DDR5 tốc độ cao v&agrave; SSD Gen4 &ndash; hiệu suất xử l&yacute; dữ liệu nhanh ch&oacute;ng</strong></h3>\r\n\r\n<p>M&aacute;y được trang bị sẵn&nbsp;<strong>RAM 16GB DDR5-5200MHz (2x8GB)</strong>, hỗ trợ n&acirc;ng cấp tối đa l&ecirc;n&nbsp;<strong>96GB</strong>, c&ugrave;ng&nbsp;<strong>SSD 1TB PCIe Gen4 x4 NVMe</strong>, cho ph&eacute;p khởi động hệ điều h&agrave;nh nhanh ch&oacute;ng, mở ứng dụng chỉ trong v&agrave;i gi&acirc;y. Người d&ugrave;ng c&oacute; thể mở rộng th&ecirc;m SSD nhờ&nbsp;<strong>2 khe M.2 hỗ trợ cả PCIe Gen4 v&agrave; Gen5</strong>, tối ưu h&oacute;a kh&ocirc;ng gian lưu trữ v&agrave; hiệu suất cho những ai l&agrave;m việc với file nặng, game AAA, hoặc dựng phim độ ph&acirc;n giải cao.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-msi-crosshair-16-hx-ai-d2xwfkg-036vn-02.jpg?v=1748609200703\" /></p>\r\n\r\n<h3><strong>Kết nối đa dạng, hiện đại v&agrave; mạnh mẽ &ndash; tối ưu mọi thiết bị ngoại vi</strong></h3>\r\n\r\n<p>Laptop hỗ trợ&nbsp;<strong>1 cổng Thunderbolt 4 (hỗ trợ DisplayPort v&agrave; Power Delivery)</strong>,&nbsp;<strong>3 cổng USB-A 3.2 Gen1</strong>,&nbsp;<strong>1 cổng HDMI 2.1 (8K@60Hz / 4K@120Hz)</strong>,&nbsp;<strong>1 cổng LAN RJ45</strong>, c&ugrave;ng jack combo tai nghe. Nhờ đ&oacute;, người d&ugrave;ng c&oacute; thể dễ d&agrave;ng kết nối với nhiều thiết bị như m&agrave;n h&igrave;nh ngo&agrave;i, b&agrave;n ph&iacute;m cơ, chuột gaming hay webcam rời.&nbsp;<strong>Wi-Fi 6E AX211 v&agrave; Bluetooth 5.3</strong>&nbsp;mang lại tốc độ truyền tải ổn định, giảm độ trễ khi stream hoặc chơi game online.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-msi-crosshair-16-hx-ai-d2xwfkg-036vn-06.jpg?v=1748609200963\" /></p>\r\n\r\n<h3><strong>Thiết kế hiện đại, đậm chất gaming v&agrave; đầy cảm hứng c&aacute; t&iacute;nh</strong></h3>\r\n\r\n<p><strong>MSI Crosshair 16 HX AI D2XWFKG-036VN</strong>&nbsp;c&oacute; thiết kế mạnh mẽ với t&ocirc;ng m&agrave;u&nbsp;<strong>X&aacute;m Cosmos</strong>&nbsp;độc đ&aacute;o, c&ugrave;ng b&agrave;n ph&iacute;m&nbsp;<strong>RGB 24 v&ugrave;ng</strong>, cụm&nbsp;<strong>ph&iacute;m WASD nổi bật</strong>&nbsp;cho cảm gi&aacute;c g&otilde; chắc chắn v&agrave; đậm chất game thủ. M&aacute;y nặng&nbsp;<strong>2.5kg</strong>, k&iacute;ch thước&nbsp;<strong>359 x 266.4 x 21.8&ndash;27.9 mm</strong>, đi k&egrave;m pin&nbsp;<strong>4 cell 90Wh</strong>&nbsp;v&agrave; sạc&nbsp;<strong>240W</strong>, ph&ugrave; hợp cả cho nhu cầu l&agrave;m việc di động lẫn chơi game hiệu suất cao.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/laptop-gaming-msi-crosshair-16-hx-ai-d2xwfkg-036vn-05.jpg?v=1748609200900\" /></p>', '<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', 41000000.00, 53000000.00, 1.700, 1, 12, 2, 'products/GUzTAQVHEInkQWDAjqeaqfbh49kuuasb7o5mcMeY.png', 'NVIDIA RTX 5060 8GB GDDR7 + 16 GB + 1TB', '2025-12-03 01:16:17', '2026-01-26 12:58:01');
INSERT INTO `products` (`product_id`, `sku`, `name`, `slug`, `short_description`, `description`, `sale_description`, `price`, `cost_price`, `weight`, `is_active`, `category_id`, `brand_id`, `main_img_url`, `total_attributes`, `created_at`, `updated_at`) VALUES
(17, 'PC010001TEST', 'PC M5 i5-5060 (i5-14400F, RTX 5060 8GB, RAM DDR5 32GB, SSD 1TB, 650W, WIN11)', 'pcmaybo-pcgaming-pc010001test', 'PC M5 i5-5060', '<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/deskmini-x300.png?v=1627103438024\" /></td>\r\n			<td>\r\n			<p><strong>Thiết kế nhỏ gọn</strong></p>\r\n\r\n			<p>Với thiết kế hiện đại nổi bật với những đường n&eacute;t thanh mảnh v&agrave; chất liệu&nbsp;ho&agrave;n thiện một c&aacute;ch&nbsp;tinh tế,&nbsp;<a href=\"https://memoryzone.com.vn/may-tinh-asrock-mini-pc-deskmini-x300-x300-b-bb-box-us\">Asrock Mini PC DeskMini X300</a>&nbsp;dễ d&agrave;ng h&ograve;a nhập với kh&ocirc;ng gian&nbsp;gia đ&igrave;nh v&agrave;&nbsp;văn ph&ograve;ng. Cực kỳ&nbsp;gọn&nbsp;nhẹ với k&iacute;ch thước chỉ&nbsp;155mm x 155mm x 80mm, DeskMini X300&nbsp;c&oacute; thể được đặt ở hầu hết mọi nơi để mang lại sự tối giản nhất cho kh&ocirc;ng gian l&agrave;m việc của bạn.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Dạng APU nhỏ</strong></p>\r\n\r\n			<p>Hỗ trợ CPU AMD AM4 Socket Renoir, Picasso, Raven Ridge&nbsp;l&ecirc;n đến 65W. Hỗ trợ bộ tản nhiệt CPU với chiều cao tối đa&nbsp;≦&nbsp;46mm.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/may-tinh-bo-asrock-deskminix300-voi-cau-hinh-nho-gon.jpg?v=1627008291882\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/x300-overclocking-mobile.jpg?v=1627008774256\" /></td>\r\n			<td>\r\n			<p><strong>T&ugrave;y chọn &eacute;p xung trong Bios</strong></p>\r\n\r\n			<p>Asrock DeskMini X300 hỗ trợ t&ugrave;y chọn &eacute;p xung để gi&uacute;p bạn&nbsp;cải thiện hiệu suất hệ thống bằng c&aacute;ch điều chỉnh xung nhịp l&otilde;i v&agrave; giải ph&oacute;ng tiềm năng của APU AM4.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Hiệu suất bộ nhớ</strong></p>\r\n\r\n			<p>ASRock DeskMini hỗ trợ dual Ram DDR4-3200MHz l&ecirc;n tới 65GB. V&agrave; nhờ bộ nhớ cao c&ugrave;ng đồ họa Radeon, Deskmini cung cấp hiệu suất tốt nhất để cho ra h&igrave;nh ảnh 3D tuyệt vời.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-insanememoryperformance-mobile.jpg?v=1627008982970\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-4x-mobile.jpg?v=1627009256217\" /></td>\r\n			<td>\r\n			<p><strong>Kho lưu trữ đa dạng</strong></p>\r\n\r\n			<p>DeskMini x300&nbsp;hỗ trợ tối đa tới 4 cổng&nbsp;lưu trữ gồm 1 cổng&nbsp;SSD M.2 PCIe Gen 3 x 4, 1 cổng&nbsp;SSD M.2 PCIe Gen 3 x 2/ x 4 v&agrave; 2 cổng ổ 2.5inch SATA SSD/ HDD.&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Trung t&acirc;m dữ liệu mini</strong></p>\r\n\r\n			<p>DeskMini hỗ trợ chức năng RAID 0/1 gi&uacute;p bạn x&acirc;y dựng một trung t&acirc;m dữ liệu tại nh&agrave;. Với RAID 0 để cung cấp hiệu suất I / O vượt trội v&agrave;&nbsp;RAID 1 để bảo vệ c&aacute;c&nbsp;dữ liệu quan trọng trong dữ liệu được sao ch&eacute;p</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-minihome-mobile.jpg?v=1627009457756\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-heatsink-mobile.jpg?v=1627009608176\" /></td>\r\n			<td>\r\n			<p><strong>Tản nhiệt&nbsp;MOSFET</strong></p>\r\n\r\n			<p>Bộ tản nhiệt nh&ocirc;m MOSFET gi&uacute;p cung cấp khả năng tản nhiệt lớn để đảm bảo hệ thống ổn định kh&ocirc;ng bị qu&aacute;&nbsp;tải.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Cổng USB Type-C</strong></p>\r\n\r\n			<p>Với&nbsp;USB Type-C 3.2 Gen 1&nbsp;cung cấp cho bạn&nbsp;tốc độ truyền dữ liệu l&ecirc;n đến 5Gbps.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-usbtypec-mobile.jpg?v=1627009836277\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Hỗ trợ tối đa 3 m&agrave;n h&igrave;nh</strong></p>\r\n\r\n			<p>DeskMini hỗ trợ 3 đầu ra hiển thị đồng thời để hỗ trợ bạn sử dụng nhiều m&agrave;n h&igrave;nh hơn gi&uacute;p tăng hiệu suất l&agrave;m việc. Với nhiều m&agrave;n h&igrave;nh, tr&ograve; chơi trở n&ecirc;n nhập vai hơn, m&aacute;y trạm trở n&ecirc;n hữu &iacute;ch hơn v&agrave;&nbsp;hiệu quả hơn.</p>\r\n\r\n			<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-tripledisplay.jpg?v=1627010008915\" /></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p><strong>Nhu cầu chơi game :&nbsp;</strong>Đ&aacute;p ứng tốt game Full HD/2K, hỗ trợ Ray Tracing, DLSS, chơi mượt c&aacute;c tựa game nặng như Cyberpunk 2077, Call of Duty, PUBG, GTA V, Elden Ring, Forza Horizon 5&hellip; ở thiết lập cao với FPS ổn định.</p>\r\n\r\n<p><strong>Nhu cầu c&ocirc;ng việc :&nbsp;</strong>L&agrave;m việc đồ họa, editor, streamer, kỹ thuật vi&ecirc;n l&agrave;m việc với Photoshop, Illustrator, Premiere, After Effects, AutoCAD, Blender, Lumion..., hỗ trợ tốt render video, xử l&yacute; hiệu ứng, dựng phim 2K/4K, thiết kế 3D vừa v&agrave; nặng.&nbsp;Chạy m&aacute;y ảo, lập tr&igrave;nh, stream đa nền tảng, giải tr&iacute; đa phương tiện chất lượng cao.</p>\r\n\r\n<p><strong>Phần mềm đi k&egrave;m:</strong></p>\r\n\r\n<p><strong>- 𝐖𝐢𝐧𝐝𝐨𝐰𝐬 𝟏𝟏 𝐏𝐫𝐨</strong></p>\r\n\r\n<p><strong>- Bản quyền Microsoft&nbsp;Office Professional Plus&nbsp;2021&nbsp;(Đăng k&yacute; tại đ&acirc;y)</strong></p>\r\n\r\n<ul>\r\n	<li>CPU Intel Core i5-14400F Up to 4.7GHz 10 cores 16 threads 20MB</li>\r\n	<li>Mainboard MSI B760M GAMING WIFI DDR5</li>\r\n	<li>Ram PC Crucial Pro 16GB 5600MHz DDR5 (1x16GB) CP16G56C46U5 (x2)&nbsp; &nbsp; &nbsp;</li>\r\n	<li>SSD Crucial P310 1TB M.2 PCIe Gen4 x4 NVMe CT1000P310SSD8&nbsp; &nbsp;&nbsp;</li>\r\n	<li>VGA MSI GeForce RTX 5060 VENTUS 2X OC 8GB GDDR7</li>\r\n	<li>Nguồn m&aacute;y t&iacute;nh Deepcool PL650D PCIE5 650W 80 Plus Bronze R-PL650D-FC0B-EU-V2</li>\r\n	<li>Case m&aacute;y t&iacute;nh DeepCool CH160 PLUS Black R-CH160-BKNGM0-G</li>\r\n	<li>Tản nhiệt nước AIO Deepcool LE240 V2 A-RGB R-LE240-BKAMMC-G-2</li>\r\n</ul>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>\r\n\r\n<p>🎁&nbsp;<strong>Mở qu&agrave; mỗi ng&agrave;y tại&nbsp;MemoryZone Techmas</strong>❄️<em>(Xem chi tiết)</em></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1765429958tagproduct%20(1).jpg.webp\" /></p>', 4500000.00, 5500000.00, NULL, 1, 13, 11, 'products/ld8rqZvQ82NVnd1f0YOLOTvrTgota7judfwTCaLi.webp', 'i5-14400F, RTX 5060 8GB, RAM DDR5 32GB, SSD 1TB', '2025-12-23 11:29:37', '2026-01-02 12:12:06'),
(18, 'PC010002TEST', 'PC ST Văn Phòng R5-5500GT (Ryzen 5 5500GT, Radeon Graphics, Ram 8GB, SSD 500GB, 500W, Win 11)', 'pcmaybo-pcvanphong-pc010002test', 'PC ST Văn Phòng R5-5500GT', '<p><strong>Bạn đang quan t&acirc;m đến&nbsp;PC ST Văn Ph&ograve;ng R5-5500GT? Đang c&ograve;n đang băn khoăn chưa biết c&oacute; n&ecirc;n mua sản phẩm hay kh&ocirc;ng? Li&ecirc;n hệ <a href=\"/\">DuyHungZone&nbsp;</a>ngay để được tư vấn chi tiết!</strong></p>', '<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;<strong>&nbsp;QUÀ TẶNG ĐẶC BI&Ecirc;̣T CHO PC VĂN PHÒNG:</strong></p>\r\n\r\n<p><strong>- 𝐖𝐢𝐧𝐝𝐨𝐰𝐬 𝟏𝟏 𝐏𝐫𝐨</strong></p>\r\n\r\n<p><strong>- Bản quyền Microsoft Office Professional Plus 2021&nbsp;(Đăng k&yacute; nhận key tại đ&acirc;y)</strong></p>\r\n\r\n<p><strong>-&nbsp;Combo B&agrave;n Ph&iacute;m v&agrave; Chuột Rapoo X125SE Black X125SE-BLK&nbsp; &nbsp; &nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li>CPU AMD Ryzen 5 5500GT Up to 4.4GHz 6 cores 12 threads 16MB 100-100001489MPK</li>\r\n	<li>Onboard - Radeon&trade; Graphics Vega</li>\r\n	<li>Mainboard ASRock A520M/ac WIFI DDR4&nbsp;&nbsp;</li>\r\n	<li>Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A</li>\r\n	<li>SSD Transcend 115S 500GB PCIe Gen3 x4 NVMe M.2 TS500GMTE115S</li>\r\n	<li>Nguồn m&aacute;y t&iacute;nh Gamdias AURA GP550 550W PSAURAGP550GA</li>\r\n	<li>Case m&aacute;y t&iacute;nh XIGMATEK XA-22 EN47567</li>\r\n</ul>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>\r\n\r\n<p>🎁&nbsp;<strong>Mở qu&agrave; mỗi ng&agrave;y tại&nbsp;MemoryZone Techmas</strong>❄️<em>(Xem chi tiết)</em></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1765429958tagproduct%20(1).jpg.webp\" /></p>', 9000000.00, 11000000.00, 3.000, 1, 13, 10, 'products/gXLSMfY6Uzii2yJhCSpytAeArtMgT29Qkm7hqAFH.webp', 'Ryzen 5 5500GT', '2025-12-25 12:01:15', '2026-01-02 12:10:29'),
(19, 'PC010003TEST', 'PC MSI i5K-5070 White ( i5-14600K, RTX 5070 OC 12GB, Ram 32GB DDR5, SSD 1TB, 850W )', 'pcmaybo-pcgaming-pc010003test', 'PC MSI i5K-5070 White', '<p><strong>Bạn đang quan t&acirc;m đến&nbsp;PC MSI i5K-5070 White? Đang c&ograve;n đang băn khoăn chưa biết c&oacute; n&ecirc;n mua sản phẩm hay kh&ocirc;ng? Li&ecirc;n hệ&nbsp;MemoryZone&nbsp;ngay để được tư vấn chi tiết!</strong></p>', '<p><strong>Nhu cầu chơi game :&nbsp;</strong>Hầu hết c&aacute;c game AAA hiện tại ở mức 2K/4K&nbsp;high-ultra settings.&nbsp;</p>\r\n\r\n<p><strong>Nhu cầu c&ocirc;ng việc :&nbsp;</strong>Video editing v&agrave; streaming,&nbsp;chỉnh sửa video 4K, thiết kế đồ họa, 3D tr&ecirc;n Adobe Photoshop.&nbsp;Virtual Machines v&agrave; AI C&oacute; thể chạy 3-4 m&aacute;y ảo đồng thời với VMware hoặc VirtualBox.&nbsp;Đối với AI/Machine Learning, cấu h&igrave;nh ph&ugrave; hợp cho training models quy m&ocirc; nhỏ-trung b&igrave;nh với TensorFlow v&agrave; PyTorch.&nbsp;Data Analysis v&agrave; Development với khả năng xử l&yacute; dữ liệu lớn.</p>\r\n\r\n<p><strong>Phần mềm đi k&egrave;m:</strong></p>\r\n\r\n<p><strong>- 𝐖𝐢𝐧𝐝𝐨𝐰𝐬 𝟏𝟏 𝐏𝐫𝐨</strong></p>\r\n\r\n<p><strong>- Bản quyền Microsoft&nbsp;Office Professional Plus&nbsp;2021&nbsp;(Đăng k&yacute; tại đ&acirc;y)</strong></p>\r\n\r\n<ul>\r\n	<li>CPU Intel Core i5-14600K Up to 5.3GHz 14 cores 20 threads 24MB</li>\r\n	<li>Mainboard MSI B760M GAMING PLUS WIFI DDR5</li>\r\n	<li>Ram PC Corsair Vengeance RGB White 32GB 6000MHz DDR5 (2x16GB) CMH32GX5M2E6000C36W</li>\r\n	<li>SSD Crucial P310 1TB M.2 PCIe Gen4 x4 NVMe CT1000P310SSD8</li>\r\n	<li>VGA MSI GeForce RTX 5070 GAMING TRIO OC WHITE 12GB GDDR7</li>\r\n	<li>Nguồn m&aacute;y t&iacute;nh Corsair RM850e White ATX 3.1 850W Cybenetics Gold CP-9020293-NA</li>\r\n	<li>Case m&aacute;y t&iacute;nh MSI MAG PANO M100R PZ WHITE</li>\r\n	<li>Tản nhiệt nước AIO MSI MAG CORELIQUID A13 360 WHITE MAG-CORELIQUID-A13-360-WHITE</li>\r\n</ul>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>\r\n\r\n<p>🎁&nbsp;<strong>Mở qu&agrave; mỗi ng&agrave;y tại&nbsp;MemoryZone Techmas</strong>❄️<em>(Xem chi tiết)</em></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1765429958tagproduct%20(1).jpg.webp\" /></p>', 39000000.00, 42000000.00, 4.500, 1, 13, 11, 'products/iJ33btSpXc63VmMFKuLMN0HFCTbAUQSFOIjav0My.webp', 'MSI i5K-5070 White', '2025-12-25 12:10:13', '2026-01-02 12:10:41'),
(20, 'PC010004TEST', 'Mini PC ASRock DeskMini X300 ST-AX35500GT (Ryzen 5 5500GT, Ram DDR4, SSD 500GB, Win 11)', 'pcmaybo-pcnhogon-pc010004test', 'Mini PC ASRock DeskMini X300 ST-AX35500GT', '<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Thiết kế nhỏ gọn</strong></p>\r\n\r\n			<p>Với thiết kế hiện đại nổi bật với những đường n&eacute;t thanh mảnh v&agrave; chất liệu&nbsp;ho&agrave;n thiện một c&aacute;ch&nbsp;tinh tế, ASR<a href=\"https://memoryzone.com.vn/may-tinh-asrock-mini-pc-deskmini-x300-x300-b-bb-box-us\">ock Mini PC DeskMini X300</a>&nbsp;dễ d&agrave;ng h&ograve;a nhập với kh&ocirc;ng gian&nbsp;gia đ&igrave;nh v&agrave;&nbsp;văn ph&ograve;ng. Cực kỳ&nbsp;gọn&nbsp;nhẹ với k&iacute;ch thước chỉ&nbsp;155mm x 155mm x 80mm, DeskMini X300&nbsp;c&oacute; thể được đặt ở hầu hết mọi nơi để mang lại sự tối giản nhất cho kh&ocirc;ng gian l&agrave;m việc của bạn.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>CPU AMD Ryzen 5 5600GT</strong></p>\r\n\r\n			<p><strong>Ryzen 5 5600GT</strong>&nbsp;cung cấp sức mạnh cho hệ thống m&aacute;y t&iacute;nh của bạn để đ&aacute;p ứng c&aacute;c tựa Games đ&ograve;i hỏi khắt khe về hiệu suất, mang đến cho bạn một trải nghiệm nhập vai cực tốt v&agrave; chinh phục mọi t&aacute;c vụ đa luồng như 3D v&agrave; kết xuất video cũng như lập tr&igrave;nh phần mềm.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/amd-5600g-02.jpg?v=1633424370866\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/x300-overclocking-mobile.jpg?v=1627008774256\" /></td>\r\n			<td>\r\n			<p><strong>T&ugrave;y chọn &eacute;p xung trong Bios</strong></p>\r\n\r\n			<p>Asrock DeskMini X300 hỗ trợ t&ugrave;y chọn &eacute;p xung để gi&uacute;p bạn&nbsp;cải thiện hiệu suất hệ thống bằng c&aacute;ch điều chỉnh xung nhịp l&otilde;i v&agrave; giải ph&oacute;ng tiềm năng của APU AM4.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Hiệu suất bộ nhớ</strong></p>\r\n\r\n			<p><strong>DeskMini x300</strong>&nbsp;hỗ trợ dual Ram DDR4-3200MHz l&ecirc;n tới 64GB. V&agrave; nhờ bộ nhớ cao c&ugrave;ng đồ họa Radeon, Deskmini cung cấp hiệu suất tốt nhất để cho ra h&igrave;nh ảnh 3D tuyệt vời.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-insanememoryperformance-mobile.jpg?v=1627008982970\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-4x-mobile.jpg?v=1627009256217\" /></td>\r\n			<td>\r\n			<p><strong>Kho lưu trữ đa dạng</strong></p>\r\n\r\n			<p><strong>DeskMini x300</strong>&nbsp;hỗ trợ tối đa tới 4 cổng&nbsp;lưu trữ gồm 1 cổng&nbsp;SSD M.2 PCIe Gen 3 x 4, 1 cổng&nbsp;SSD M.2 PCIe Gen 3 x 2/ x 4 v&agrave; 2 cổng ổ 2.5inch SATA SSD/ HDD.&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Trung t&acirc;m dữ liệu mini</strong></p>\r\n\r\n			<p>DeskMini hỗ trợ chức năng RAID 0/1 gi&uacute;p bạn x&acirc;y dựng một trung t&acirc;m dữ liệu tại nh&agrave;. Với RAID 0 để cung cấp hiệu suất I / O vượt trội v&agrave;&nbsp;RAID 1 để bảo vệ c&aacute;c&nbsp;dữ liệu quan trọng trong dữ liệu được sao ch&eacute;p</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-minihome-mobile.jpg?v=1627009457756\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-heatsink-mobile.jpg?v=1627009608176\" /></td>\r\n			<td>\r\n			<p><strong>Tản nhiệt&nbsp;MOSFET</strong></p>\r\n\r\n			<p>Bộ tản nhiệt nh&ocirc;m MOSFET gi&uacute;p cung cấp khả năng tản nhiệt lớn để đảm bảo hệ thống ổn định kh&ocirc;ng bị qu&aacute;&nbsp;tải.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Cổng USB Type-C</strong></p>\r\n\r\n			<p>Với&nbsp;USB Type-C 3.2 Gen 1&nbsp;cung cấp cho bạn&nbsp;tốc độ truyền dữ liệu l&ecirc;n đến 5Gbps.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-usbtypec-mobile.jpg?v=1627009836277\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Hỗ trợ tối đa 3 m&agrave;n h&igrave;nh</strong></p>\r\n\r\n			<p>DeskMini hỗ trợ 3 đầu ra hiển thị đồng thời để hỗ trợ bạn sử dụng nhiều m&agrave;n h&igrave;nh hơn gi&uacute;p tăng hiệu suất l&agrave;m việc. Với nhiều m&agrave;n h&igrave;nh, tr&ograve; chơi trở n&ecirc;n nhập vai hơn, m&aacute;y trạm trở n&ecirc;n hữu &iacute;ch hơn v&agrave;&nbsp;hiệu quả hơn.</p>\r\n\r\n			<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/a300-tripledisplay.jpg?v=1627010008915\" /></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p><strong>Qu&agrave; tặng khi mua đủ RAM v&agrave; SSD k&egrave;m m&aacute;y:&nbsp;&nbsp;</strong></p>\r\n\r\n<p><strong>- 𝐖𝐢𝐧𝐝𝐨𝐰𝐬 𝟏𝟏 𝐏𝐫𝐨</strong></p>\r\n\r\n<p><strong>-&nbsp;Card Intel AC WiFi &amp; Bluetooth</strong></p>\r\n\r\n<p><strong><img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;Combo khuyến m&atilde;i 1:</strong></p>\r\n\r\n<p>Mini PC ASRock DeskMini X300 - X300/B/BB/BOX&nbsp;x1</p>\r\n\r\n<p>CPU AMD Ryzen 5 5500GT Up to 4.4GHz 6 cores 12 threads 16MB 100-100001489MPK&nbsp;x 1</p>\r\n\r\n<p>Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB&nbsp;x 1</p>\r\n\r\n<p>SSD Transcend 115S 500GB PCIe Gen3 x4 NVMe M.2 TS500GMTE115S&nbsp;x 1</p>\r\n\r\n<p><strong>​​​​​<img src=\"https://bizweb.dktcdn.net/100/329/122/files/gift.png?v=1535956050212\" />&nbsp;Combo khuyến m&atilde;i 2:</strong></p>\r\n\r\n<p>Mini PC ASRock DeskMini X300 - X300/B/BB/BOX&nbsp;x1</p>\r\n\r\n<p>CPU AMD Ryzen 5 5500GT Up to 4.4GHz 6 cores 12 threads 16MB 100-100001489MPK&nbsp;x 1</p>\r\n\r\n<p>Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB&nbsp;x 2</p>\r\n\r\n<p>SSD Transcend 115S 500GB PCIe Gen3 x4 NVMe M.2 TS500GMTE115S&nbsp;x 1</p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>\r\n\r\n<p>🎁&nbsp;<strong>Mở qu&agrave; mỗi ng&agrave;y tại&nbsp;MemoryZone Techmas</strong>❄️<em>(Xem chi tiết)</em></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1765429958tagproduct%20(1).jpg.webp\" /></p>', 14000000.00, 16500000.00, 5.500, 1, 13, 13, 'products/cuNvvNBOiOKeHQ7t8xkgkZyjkO8SnNKLc9Ueve2C.webp', 'Ryzen 5 5500GT, Ram DDR4, SSD 500GB, Win 11', '2025-12-25 12:16:52', '2026-01-02 12:10:17'),
(21, 'RM010001TEST', 'Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A', 'ram-corsair-rm010001test', 'Ram PC Crucial 8GB', '<h2>Đặc điểm nổi bật của Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A</h2>\r\n\r\n<p><strong>Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A</strong>&nbsp;cung cấp dung lượng bộ nhớ&nbsp;<strong>8GB</strong>, đ&aacute;p ứng tốt nhu cầu sử dụng cơ bản như học tập, l&agrave;m việc văn ph&ograve;ng, lướt web v&agrave; giải tr&iacute; đa phương tiện. Với mức dung lượng n&agrave;y, người d&ugrave;ng c&oacute; thể dễ d&agrave;ng chạy c&aacute;c ứng dụng phổ biến một c&aacute;ch mượt m&agrave;. Đ&acirc;y l&agrave; lựa chọn hợp l&yacute; để n&acirc;ng cấp hệ thống m&aacute;y t&iacute;nh b&agrave;n nhằm cải thiện hiệu suất m&agrave; kh&ocirc;ng cần chi ph&iacute; qu&aacute; cao.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-crucial-8gb-3200mhz-ddr4-ct8g4dfra32a-05.jpg?v=1759476404943\" /></p>\r\n\r\n<h3><strong>Tốc độ bus 3200MHz mang lại hiệu năng ổn định</strong></h3>\r\n\r\n<p>Thanh RAM được trang bị tốc độ bus&nbsp;<strong>DDR4-3200MHz</strong>, đảm bảo khả năng xử l&yacute; dữ liệu nhanh ch&oacute;ng v&agrave; hiệu quả. So với c&aacute;c thế hệ RAM DDR3 cũ, DDR4 kh&ocirc;ng chỉ nhanh hơn m&agrave; c&ograve;n ti&ecirc;u thụ &iacute;t điện năng hơn. Nhờ đ&oacute;, m&aacute;y t&iacute;nh c&oacute; thể khởi động nhanh, mở ứng dụng mượt m&agrave; v&agrave; hoạt động đa nhiệm ổn định hơn. Đ&acirc;y l&agrave; yếu tố quan trọng gi&uacute;p cải thiện trải nghiệm người d&ugrave;ng trong mọi t&aacute;c vụ.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-crucial-8gb-3200mhz-ddr4-ct8g4dfra32a-04.jpg?v=1759476404883\" /></p>\r\n\r\n<h3><strong>Chuẩn DDR4 UDIMM tương th&iacute;ch cao</strong></h3>\r\n\r\n<p><strong>Crucial CT8G4DFRA32A</strong>&nbsp;l&agrave; RAM&nbsp;<strong>DDR4 UDIMM</strong>&nbsp;ti&ecirc;u chuẩn, tương th&iacute;ch với nhiều loại mainboard hỗ trợ DDR4 hiện nay. Với cấu h&igrave;nh phổ biến n&agrave;y, việc lắp đặt v&agrave; n&acirc;ng cấp RAM trở n&ecirc;n đơn giản v&agrave; dễ d&agrave;ng. Người d&ugrave;ng chỉ cần cắm trực tiếp v&agrave;o khe DIMM m&agrave; kh&ocirc;ng cần th&ecirc;m bất kỳ c&ocirc;ng cụ n&agrave;o. Điều n&agrave;y gi&uacute;p tiết kiệm thời gian v&agrave; mang lại sự tiện lợi trong qu&aacute; tr&igrave;nh n&acirc;ng cấp m&aacute;y t&iacute;nh.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-crucial-8gb-3200mhz-ddr4-ct8g4dfra32a-03.jpg?v=1759476404827\" /></p>\r\n\r\n<h3><strong>Độ bền cao, hoạt động ổn định l&acirc;u d&agrave;i</strong></h3>\r\n\r\n<p>Crucial, thương hiệu thuộc Micron &ndash; một trong những nh&agrave; sản xuất bộ nhớ h&agrave;ng đầu thế giới, đảm bảo chất lượng v&agrave; độ bền của sản phẩm. Thanh RAM&nbsp;<strong>CT8G4DFRA32A</strong>&nbsp;được kiểm tra nghi&ecirc;m ngặt để đ&aacute;p ứng ti&ecirc;u chuẩn quốc tế, gi&uacute;p hoạt động ổn định v&agrave; bền bỉ trong nhiều điều kiện. Đ&acirc;y l&agrave; lựa chọn đ&aacute;ng tin cậy cho người d&ugrave;ng cần sự ổn định l&acirc;u d&agrave;i trong c&ocirc;ng việc v&agrave; học tập.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-crucial-8gb-3200mhz-ddr4-ct8g4dfra32a-02.jpg?v=1759476404773\" /></p>\r\n\r\n<h3><strong>Tiết kiệm điện năng với điện &aacute;p thấp 1.2V</strong></h3>\r\n\r\n<p>RAM hoạt động với điện &aacute;p&nbsp;<strong>1.2V</strong>, thấp hơn so với c&aacute;c d&ograve;ng RAM cũ, gi&uacute;p tiết kiệm điện năng v&agrave; giảm lượng nhiệt tỏa ra. Điều n&agrave;y kh&ocirc;ng chỉ g&oacute;p phần k&eacute;o d&agrave;i tuổi thọ linh kiện m&agrave; c&ograve;n tối ưu hiệu suất hoạt động của to&agrave;n hệ thống. Đ&acirc;y l&agrave; ưu điểm quan trọng cho người d&ugrave;ng thường xuy&ecirc;n l&agrave;m việc l&acirc;u d&agrave;i tr&ecirc;n m&aacute;y t&iacute;nh.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-crucial-8gb-3200mhz-ddr4-ct8g4dfra32a-01.jpg?v=1759476404713\" /></p>\r\n\r\n<h3><strong>Giải ph&aacute;p n&acirc;ng cấp kinh tế v&agrave; hiệu quả cho PC</strong></h3>\r\n\r\n<p>Với&nbsp;<strong>dung lượng 8GB, bus 3200MHz, chuẩn DDR4 UDIMM</strong>&nbsp;v&agrave; hiệu năng ổn định,&nbsp;<strong>Crucial CT8G4DFRA32A</strong>&nbsp;l&agrave; lựa chọn n&acirc;ng cấp l&yacute; tưởng cho m&aacute;y t&iacute;nh để b&agrave;n phổ th&ocirc;ng. Khi mua tại MemoryZone, kh&aacute;ch h&agrave;ng được đảm bảo&nbsp;<strong>h&agrave;ng ch&iacute;nh h&atilde;ng, gi&aacute; tốt, trả g&oacute;p 0% v&agrave; giao h&agrave;ng nhanh 2-4H</strong>, mang lại sự an t&acirc;m tuyệt đối. Đ&acirc;y ch&iacute;nh l&agrave; giải ph&aacute;p n&acirc;ng cấp RAM vừa kinh tế vừa hiệu quả.</p>\r\n\r\n<p><strong>Bạn đang quan t&acirc;m đến&nbsp;<a href=\"https://memoryzone.com.vn/ram-pc-crucial-8gb-3200mhz-ddr4-ct8g4dfra32a\">Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A</a>? Đang c&ograve;n đang băn khoăn chưa biết c&oacute; n&ecirc;n mua sản phẩm hay kh&ocirc;ng? Li&ecirc;n hệ&nbsp;<a href=\"https://memoryzone.com.vn/\">MemoryZone&nbsp;</a>ngay để được tư vấn chi tiết!</strong></p>', '<p>-&nbsp;<strong>Sản phẩm chỉ bán kèm PC Lắp Ráp t&ocirc;́i thi&ecirc;̉u 7 linh kiện:</strong>&nbsp;<strong>RAM, CPU, MAIN, SSD, Nguồn, Case, VGA hoặc Tản nhiệt&nbsp;</strong><a href=\"http://go.mmz.vn/build-pc\">(Xem th&ecirc;m)</a></p>\r\n\r\n<p>-&nbsp;<strong>Mỗi đơn h&agrave;ng chỉ được mua:&nbsp;1 kit RAM hoặc 2 thanh RAM đơn.&nbsp;</strong></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', 1800000.00, 2100000.00, 0.100, 1, 19, 15, 'products/rSrnHpDG5kF7vJ88CTxJ1oHK4fodzuY34n9e2h5L.webp', '8GB 3200MHz DDR4', '2026-01-02 00:46:18', '2026-01-02 12:10:56'),
(22, 'RM010002TEST', 'Ram PC Corsair Vengeance RGB White 32GB 6000MHz DDR5 (2x16GB) CMH32GX5M2E6000C36W', 'ram-corsair-rm010002test', 'Ram PC Corsair Vengeance RGB White 32GB', '<p>-&nbsp;<strong>Sản phẩm chỉ bán kèm PC Lắp Ráp t&ocirc;́i thi&ecirc;̉u 7 linh kiện:</strong>&nbsp;<strong>RAM, CPU, MAIN, SSD, Nguồn, Case, VGA hoặc Tản nhiệt&nbsp;</strong><a href=\"http://go.mmz.vn/build-pc\">(Xem th&ecirc;m)</a></p>\r\n\r\n<p>-&nbsp;<strong>Mỗi đơn h&agrave;ng chỉ được mua:&nbsp;1 kit RAM hoặc 2 thanh RAM đơn.&nbsp;</strong></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', '<p><strong>Ram PC Corsair Vengeance RGB&nbsp;White 6000MHz DDR5</strong></p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-corsair-vengeance-rgb-white-32gb-5600mhz-ddr5-2x16gb-cmh32gx5m2b5600c40w-nd.jpg?v=1700712105275\" /></p>\r\n\r\n<p><strong>Khả năng xử l&yacute; mạnh mẽ</strong></p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-corsair-vengeance-rgb-white-32gb-5600mhz-ddr5-2x16gb-cmh32gx5m2b5600c40w-3-nd.jpg?v=1700712126826\" /></p>\r\n\r\n<p><strong>Ram PC</strong>&nbsp;<strong>Corsair Vengeance RGB White DDR5</strong>&nbsp;với chuẩn DDR5 đem lại&nbsp;khả năng xử l&yacute; vượt trội&nbsp;đảm bảo CPU của bạn lấy dữ liệu nhanh ch&oacute;ng một c&aacute;ch dễ d&agrave;ng. Cho d&ugrave; bạn đang chơi game, s&aacute;ng&nbsp;tạo nội dung, mở 100 tab hay đa t&aacute;c vụ, PC của bạn đều&nbsp;c&oacute; thể thực hiện c&aacute;c t&aacute;c vụ phức tạp nhanh hơn bao giờ hết.</p>\r\n\r\n<p><strong>LED RGB</strong></p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-corsair-vengeance-rgb-white-32gb-5600mhz-ddr5-2x16gb-cmh32gx5m2b5600c40w-2-nd.jpg?v=1700712144285\" /></p>\r\n\r\n<p><strong>Ram PC</strong>&nbsp;<strong>Corsair Vengeance RGB White DDR5</strong>&nbsp;kh&ocirc;ng y&ecirc;u cầu cắm th&ecirc;m d&acirc;y hoặc c&aacute;p để điều khiển hệ thống Led. Tất cả việc bạn cần l&agrave;m l&agrave;m cắm v&agrave;o khe ram, bật phần mềm đi k&egrave;m v&agrave; hiệu chỉnh th&ocirc;ng qua phần mềm iCUE.</p>\r\n\r\n<p><strong>Hỗ Trợ Intel XMP 3.0</strong></p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-pc-corsair-vengeance-rgb-white-32gb-5600mhz-ddr5-2x16gb-cmh32gx5m2b5600c40w-1-nd.jpg?v=1700712157943\" /></p>\r\n\r\n<p><strong>Ram PC Corsair Vengeance RGB White DDR5</strong>&nbsp;hỗ trợ XMP 3.0 của Intel gi&uacute;p bạn dễ d&agrave;ng thiết lập BIOS, bạn chỉ cần thực hiện v&agrave;i bước để &eacute;p xung.</p>\r\n\r\n<p>&nbsp;</p>', 6800000.00, 7400000.00, 0.100, 1, 19, 15, 'products/XoI7Z57FqZZT7PAEIqXwEYils1cBrMsqKTkJ3XHS.webp', 'RGB White 32GB 6000MHz DDR5', '2026-01-02 01:02:55', '2026-01-04 23:52:54'),
(23, 'RM010003TEST', 'Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB', 'ram-acer-rm010003test', 'Ram Laptop Acer SD100', '<p><strong>Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2V SD100-16GB</strong>&nbsp;l&agrave; lựa chọn l&yacute; tưởng cho người d&ugrave;ng laptop cần n&acirc;ng cấp hiệu năng nhanh ch&oacute;ng, ổn định v&agrave; tiết kiệm năng lượng. Với dung lượng&nbsp;<strong>16GB DDR4</strong>, tốc độ&nbsp;<strong>3200MHz</strong>&nbsp;v&agrave; điện &aacute;p thấp&nbsp;<strong>1.2V</strong>, d&ograve;ng RAM n&agrave;y gi&uacute;p m&aacute;y t&iacute;nh xử l&yacute; đa nhiệm mượt m&agrave;, tối ưu cho học tập, l&agrave;m việc v&agrave; giải tr&iacute;. Được sản xuất bởi&nbsp;<strong>Acer &ndash; thương hiệu c&ocirc;ng nghệ h&agrave;ng đầu thế giới</strong>, SD100 mang đến hiệu suất cao, độ bền vượt trội c&ugrave;ng khả năng tương th&iacute;ch tốt với nhiều nền tảng&nbsp;<strong>Intel v&agrave; AMD</strong>.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-laptop-acer-sd100-ddr4-16gb-3200mhz-1-2v-sd100-16gb-01.jpg?v=1761275940037\" /></p>\r\n\r\n<h3><strong>Hiệu năng mạnh mẽ, n&acirc;ng cấp trải nghiệm m&aacute;y t&iacute;nh vượt trội</strong></h3>\r\n\r\n<p>Sở hữu dung lượng&nbsp;<strong>16GB</strong>&nbsp;v&agrave; tốc độ bus&nbsp;<strong>3200MHz</strong>,&nbsp;<strong>Acer SD100 DDR4</strong>&nbsp;mang lại khả năng xử l&yacute; nhanh ch&oacute;ng mọi t&aacute;c vụ, từ l&agrave;m việc văn ph&ograve;ng, học online, đến chơi game hay chỉnh sửa h&igrave;nh ảnh. Nhờ&nbsp;<strong>độ trễ CL22-22-22-52</strong>, RAM đảm bảo độ ổn định v&agrave; phản hồi nhanh, gi&uacute;p giảm t&igrave;nh trạng giật lag khi mở nhiều ứng dụng c&ugrave;ng l&uacute;c. Đ&acirc;y l&agrave; lựa chọn ho&agrave;n hảo để&nbsp;<strong>n&acirc;ng cấp hiệu năng tổng thể</strong>&nbsp;của laptop m&agrave; kh&ocirc;ng cần thay mới to&agrave;n bộ hệ thống.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-laptop-acer-sd100-ddr4-16gb-3200mhz-1-2v-sd100-16gb-05.jpg?v=1761275940227\" /></p>\r\n\r\n<h3><strong>Thiết kế SODIMM nhỏ gọn, dễ lắp đặt v&agrave; tương th&iacute;ch rộng</strong></h3>\r\n\r\n<p><strong>Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2V SD100-16GB</strong>&nbsp;được thiết kế theo chuẩn&nbsp;<strong>SODIMM 260 pin</strong>&nbsp;nhỏ gọn, ph&ugrave; hợp với hầu hết c&aacute;c d&ograve;ng laptop hiện nay. Người d&ugrave;ng c&oacute; thể dễ d&agrave;ng th&aacute;o nắp v&agrave;&nbsp;<strong>lắp đặt chỉ trong v&agrave;i ph&uacute;t</strong>, kh&ocirc;ng cần kỹ năng kỹ thuật chuy&ecirc;n s&acirc;u. RAM tương th&iacute;ch ho&agrave;n hảo với&nbsp;<strong>c&aacute;c nền tảng Intel v&agrave; AMD</strong>&nbsp;mới nhất, cũng như nhiều d&ograve;ng bo mạch chủ từ c&aacute;c thương hiệu phổ biến như ASUS, MSI, Gigabyte hay Lenovo.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-laptop-acer-sd100-ddr4-16gb-3200mhz-1-2v-sd100-16gb-02-461e2187-2814-4f74-9ec3-d70e3c55eab8.jpg?v=1761276073173\" /></p>\r\n\r\n<h3><strong>Hiệu suất ổn định, ti&ecirc;u thụ điện năng thấp</strong></h3>\r\n\r\n<p>Điểm nổi bật của&nbsp;<strong>Acer SD100 DDR4</strong>&nbsp;ch&iacute;nh l&agrave; mức&nbsp;<strong>điện &aacute;p 1.2V</strong>, gi&uacute;p tiết kiệm năng lượng m&agrave; vẫn duy tr&igrave; hiệu năng cao. Nhờ vậy, laptop hoạt động m&aacute;t mẻ v&agrave; ổn định hơn trong thời gian d&agrave;i. C&ocirc;ng nghệ tối ưu điện năng cũng g&oacute;p phần k&eacute;o d&agrave;i tuổi thọ pin, đặc biệt hữu &iacute;ch cho người d&ugrave;ng di động hoặc l&agrave;m việc ngo&agrave;i trời thường xuy&ecirc;n. Với thiết kế&nbsp;<strong>ti&ecirc;u chuẩn DDR4 hiện đại</strong>, SD100 mang lại khả năng truyền tải dữ liệu nhanh v&agrave; mượt, gi&uacute;p cải thiện r&otilde; rệt tốc độ phản hồi của hệ thống.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-laptop-acer-sd100-ddr4-16gb-3200mhz-1-2v-sd100-16gb-03.jpg?v=1761275940137\" /></p>\r\n\r\n<h3><strong>Linh kiện cao cấp &ndash; Độ bền v&agrave; độ tin cậy tuyệt đối</strong></h3>\r\n\r\n<p><strong>Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2V SD100-16GB</strong>&nbsp;được chế tạo từ&nbsp;<strong>linh kiện cao cấp với ch&acirc;n tiếp x&uacute;c mạ v&agrave;ng</strong>, tăng cường khả năng dẫn điện v&agrave; chống oxy h&oacute;a, đảm bảo độ bền vượt trội trong mọi điều kiện sử dụng. Acer c&ograve;n &aacute;p dụng quy tr&igrave;nh kiểm định nghi&ecirc;m ngặt, gi&uacute;p RAM hoạt động ổn định li&ecirc;n tục trong thời gian d&agrave;i m&agrave; kh&ocirc;ng gặp lỗi xung đột hay giảm hiệu suất. Đ&acirc;y l&agrave; sản phẩm đ&aacute;ng tin cậy cho cả người d&ugrave;ng phổ th&ocirc;ng lẫn d&acirc;n kỹ thuật cần sự ổn định tuyệt đối.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-laptop-acer-sd100-ddr4-16gb-3200mhz-1-2v-sd100-16gb-04.jpg?v=1761275940183\" /></p>\r\n\r\n<h3><strong>Khả năng xử l&yacute; đa nhiệm ấn tượng cho mọi nhu cầu</strong></h3>\r\n\r\n<p>Với dung lượng&nbsp;<strong>16GB</strong>, RAM Acer SD100 dễ d&agrave;ng đ&aacute;p ứng nhu cầu&nbsp;<strong>chạy nhiều ứng dụng c&ugrave;ng l&uacute;c</strong>&nbsp;như tr&igrave;nh duyệt, phần mềm văn ph&ograve;ng, chỉnh sửa ảnh, hoặc ứng dụng học tập trực tuyến. Đặc biệt, với tần số&nbsp;<strong>3200MHz</strong>, người d&ugrave;ng c&oacute; thể tận hưởng trải nghiệm mượt m&agrave; hơn khi mở nhiều tab tr&igrave;nh duyệt hoặc chạy phần mềm nặng. Acer SD100 gi&uacute;p hệ thống phản hồi nhanh hơn, giảm tối đa độ trễ khi chuyển đổi t&aacute;c vụ, mang lại trải nghiệm l&agrave;m việc v&agrave; giải tr&iacute; trọn vẹn.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ram-laptop-acer-sd100-ddr4-16gb-3200mhz-1-2v-sd100-16gb-06.jpg?v=1761275940273\" /></p>\r\n\r\n<h3><strong>Bảo h&agrave;nh ch&iacute;nh h&atilde;ng v&agrave; dịch vụ hậu m&atilde;i uy t&iacute;n tại MemoryZone</strong></h3>\r\n\r\n<p>Khi mua&nbsp;<strong>Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2V SD100-16GB</strong>&nbsp;tại&nbsp;<strong>MemoryZone</strong>, kh&aacute;ch h&agrave;ng được hưởng&nbsp;<strong>bảo h&agrave;nh ch&iacute;nh h&atilde;ng 36 th&aacute;ng</strong>, c&ugrave;ng dịch vụ hỗ trợ kỹ thuật tận t&acirc;m. Ngo&agrave;i ra, MemoryZone c&ograve;n mang đến&nbsp;<strong>ch&iacute;nh s&aacute;ch trả g&oacute;p 0%</strong>,&nbsp;<strong>giao h&agrave;ng 2&ndash;4H</strong>, v&agrave; cam kết&nbsp;<strong>sản phẩm ch&iacute;nh h&atilde;ng 100%</strong>, gi&uacute;p bạn ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi n&acirc;ng cấp thiết bị. Đ&acirc;y l&agrave; lựa chọn tuyệt vời cho bất kỳ ai muốn tối ưu hiệu năng laptop m&agrave; vẫn đảm bảo t&iacute;nh ổn định v&agrave; độ bền l&acirc;u d&agrave;i.</p>', '<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', 1600000.00, 1900000.00, 0.100, 1, 19, 16, 'products/M6ekeaQQCaUL8NoGjkVX7q7MFvJaZfgUJFhnkOdR.webp', 'DDR4 16GB 3200MHz 1.2v SD100-16GB', '2026-01-02 01:06:37', '2026-01-02 12:11:15'),
(24, 'RM010004TEST', 'Ram PC Kingston Fury Beast Black 8GB 3200MHz DDR4 KF432C16BB/8WP', 'ram-kingston-rm010004test', 'Ram PC Kingston Fury', '<p><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ramdesktopkingstonfury-4.jpg?v=1628061150781\" /></p>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><a href=\"https://memoryzone.com.vn/ram-pc-kingston-fury-beast-black-8gb-2666mhz-ddr4-kf426c16bb-8\"><strong>Ram PC Kingston&nbsp;Fury&nbsp;Beast Black DDR4</strong></a></p>\r\n\r\n			<p>Bộ nhớ Ram Kingston&nbsp;Fury DDR4 tự động &eacute;p xung với tần số cao nhất được c&ocirc;ng bố, l&ecirc;n đến 3200&nbsp;MHz, để cung cấp hiệu năng cao nhất cho c&aacute;c bo mạch chủ c&oacute; Chipset 100 Series v&agrave; x99 của Intel. Tăng hiệu suất tối đa cho c&aacute;c vi xử l&yacute; 2, 4, 6 v&agrave; 8-core của Intel gi&uacute;p nhanh ch&oacute;ng bi&ecirc;n tập video, dựng phim 3D, chơi game v&agrave; xử l&yacute; AI. Thiết kế bộ tản nhiệt c&oacute; độ cao thấp với phong c&aacute;ch độc đ&aacute;o v&agrave; mạnh mẽ gi&uacute;p tương th&iacute;ch với c&aacute;c loại Case c&oacute; k&iacute;ch thước nhỏ v&agrave; d&aacute;ng vẻ mạnh mẽ sẽ l&agrave;m cho hệ thống của bạn th&ecirc;m chuy&ecirc;n nghiệp.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/kingston-technology-kf432c16bb-8-fury-beast-modulo-de-memoria-8-gb-1-x-8-gb-ddr4-3200-mhz.jpg?v=1628061427152\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ramdesktopkingstonfury-1.jpg?v=1628061214532\" /></td>\r\n			<td>\r\n			<p><strong>Cắm v&agrave; chạy</strong></p>\r\n\r\n			<p>Ram Kingston&nbsp;Fury DDR4 l&agrave; d&ograve;ng sản phẩm đầu ti&ecirc;n cung cấp chế độ tự động &eacute;p xung l&ecirc;n đến tần số cao nhất được c&ocirc;ng bố. Chỉ cần cắm v&agrave; chạy, kh&ocirc;ng cần tinh chỉnh trong Bios.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Tối ưu h&oacute;a cho Chipset Intel 100 series v&agrave; chipset x99</strong></p>\r\n\r\n			<p>DDR4 l&agrave; thế hệ mới nhất của c&ocirc;ng nghệ DRAM d&agrave;nh cho Chipset 100 Series v&agrave; x99, bộ nhớ Ram Kingston Fury DDR4 đ&atilde; được thử nghiệm v&agrave; tối ưu h&oacute;a 100% cho khả năng tương th&iacute;ch v&agrave; dễ d&agrave;ng &eacute;p xung.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/2564418-n13.jpg?v=1628061455250\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/ramdesktopkingstonfury-2.jpg?v=1628061386106\" /></td>\r\n			<td>\r\n			<p><strong>Ti&ecirc;u thụ &iacute;t điện năng hơn</strong></p>\r\n\r\n			<p>Ram Kingston Fury DDR4 sử dụng hiệu điện thế thấp chỉ 1.2v gi&uacute;p giảm nhiệt độ sinh ra v&agrave; tăng độ bền, cho hệ thống của bạn hoạt động m&aacute;t hơn v&agrave; &ecirc;m hơn.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" cellpadding=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Tản nhiệt nh&ocirc;m</strong></p>\r\n\r\n			<p>H&atilde;y thể hiện phong c&aacute;ch của bạn với bộ tản nhiệt rất mạnh mẽ. M&agrave;u đen ph&ugrave; hợp với PCB, bộ nhớ Ram Kingston&nbsp;Fury DDR4 ph&ugrave; hợp với tất cả c&aacute;c bo mạch chủ c&oacute; Chipset Intel 100 Series hay Chipset x99.</p>\r\n			</td>\r\n			<td><img src=\"https://bizweb.dktcdn.net/100/329/122/files/download-2.jpg?v=1628061329921\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>-&nbsp;<strong>Sản phẩm chỉ bán kèm PC Lắp Ráp t&ocirc;́i thi&ecirc;̉u 7 linh kiện:</strong>&nbsp;<strong>RAM, CPU, MAIN, SSD, Nguồn, Case, VGA hoặc Tản nhiệt&nbsp;</strong><a href=\"http://go.mmz.vn/build-pc\">(Xem th&ecirc;m)</a></p>\r\n\r\n<p>-&nbsp;<strong>Mỗi đơn h&agrave;ng chỉ được mua:&nbsp;1 kit RAM hoặc 2 thanh RAM đơn.&nbsp;</strong></p>\r\n\r\n<p>💵<strong>Ưu đ&atilde;i thanh to&aacute;n:</strong></p>\r\n\r\n<p><img src=\"https://memoryzone.aecomapp.com/storage/files/1720541928Asset%201.png.webp\" />&nbsp;Miễn ph&iacute; khi thanh to&aacute;n thẻ<strong>&nbsp;Visa, MasterCard.</strong></p>', 1900000.00, 2500000.00, 0.100, 0, 19, 14, 'products/5Uh9O1HR4T9YB5QoNyCGuQncSnm32wifNdnP4ODG.webp', '8GB 3200MHz DDR4', '2026-01-02 01:46:22', '2026-01-06 15:06:54'),
(27, 'skutest01', 'skutest01', 'laptop-acer-skutest01', 'skutest01', '<p>skutest01</p>', '<p>skutest01</p>', 10000.00, 5000.00, 1.000, 1, 12, 16, NULL, '1', '2026-01-26 13:28:41', '2026-01-26 14:14:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attributes`
--

CREATE TABLE `product_attributes` (
  `attr_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attr_key` varchar(150) NOT NULL,
  `attr_value` varchar(500) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attributes`
--

INSERT INTO `product_attributes` (`attr_id`, `product_id`, `attr_key`, `attr_value`, `sort_order`, `created_at`, `updated_at`) VALUES
(248, 16, 'CPU', 'Intel Core Ultra 7', 1, '2025-12-09 08:55:30', '2025-12-09 08:55:30'),
(249, 16, 'Ổ cứng', '1TB M.2 PCIe Gen 4x4', 2, '2025-12-09 08:55:30', '2025-12-09 08:55:30'),
(250, 16, 'Độ phân giải', 'QHD+ (2560 x 1600)', 3, '2025-12-09 08:55:30', '2025-12-09 08:55:30'),
(251, 15, 'CPU', 'Intel Core Ultra 5', 1, '2025-12-09 08:55:42', '2025-12-09 08:55:42'),
(252, 15, 'Kích thước màn hình', '16.0 inch', 2, '2025-12-09 08:55:42', '2025-12-09 08:55:42'),
(253, 14, 'CPU', 'Intel Core i7 - 14650HX (16 nhân, 24 luồng)', 1, '2025-12-09 08:55:49', '2025-12-09 08:55:49'),
(254, 14, 'Loại CPU', '14650HX', 2, '2025-12-09 08:55:49', '2025-12-09 08:55:49'),
(255, 14, 'Card đồ họa rời', 'NVIDIA RTX 5060 8GB GDDR7', 3, '2025-12-09 08:55:49', '2025-12-09 08:55:49'),
(256, 14, 'Dung lượng RAM', '16GB (2x8GB)', 4, '2025-12-09 08:55:49', '2025-12-09 08:55:49'),
(257, 13, 'CPU', 'Intel Core 7', 1, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(258, 13, 'Loại CPU', '240H', 2, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(259, 13, 'Card đồ họa rời', 'no', 3, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(260, 13, 'TGP', 'no', 4, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(261, 13, 'Card đồ họa tích hợp', 'Intel Graphics', 5, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(262, 13, 'Dung lượng RAM', '16 GB (1 x 16GB)', 6, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(263, 13, 'Ổ cứng', '512 GB M.2 2242 PCIe Gen 4x4', 7, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(264, 13, 'Kích thước màn hình', '14.0 inch', 8, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(265, 13, 'Độ phân giải', 'WUXGA (1920 x 1200)', 9, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(266, 13, 'Thời gian bảo hành', '24 tháng', 10, '2025-12-09 08:55:55', '2025-12-09 08:55:55'),
(267, 12, 'CPU', 'AMD Ryzen 5', 1, '2025-12-09 08:56:03', '2025-12-09 08:56:03'),
(268, 12, 'Loại CPU', '7535HS', 3, '2025-12-09 08:56:03', '2025-12-09 08:56:03'),
(269, 12, 'Card đồ họa rời', 'NVIDIA RTX 3050 6GB GDDR6', 4, '2025-12-09 08:56:03', '2025-12-09 08:56:03'),
(270, 12, 'Card đồ họa tích hợp', 'AMD Radeon Graphics', 5, '2025-12-09 08:56:03', '2025-12-09 08:56:03'),
(271, 12, 'Độ phân giải', 'Full HD (1920 x 1080)', 6, '2025-12-09 08:56:03', '2025-12-09 08:56:03'),
(272, 12, 'Thời gian bảo hành', '24 tháng 3S1', 7, '2025-12-09 08:56:03', '2025-12-09 08:56:03'),
(334, 20, 'Hệ điều hành đi kèm', 'Combo 1 & 2: Tặng Windows 11 Pro', 1, '2026-01-02 12:10:17', '2026-01-02 12:10:17'),
(335, 20, 'Nhà sản xuất', 'ASRock', 2, '2026-01-02 12:10:17', '2026-01-02 12:10:17'),
(336, 20, 'Model', 'DeskMini-X300', 3, '2026-01-02 12:10:17', '2026-01-02 12:10:17'),
(337, 18, 'CPU Hỗ trợ', 'AMD Ryzen 3000, 4000, 5000 Series', 1, '2026-01-02 12:10:29', '2026-01-02 12:10:29'),
(338, 18, 'Socket CPU', 'LGA AM4', 2, '2026-01-02 12:10:29', '2026-01-02 12:10:29'),
(339, 18, 'Dung lượng RAM', '64GB', 3, '2026-01-02 12:10:29', '2026-01-02 12:10:29'),
(340, 21, 'Loại RAM', 'DDR4', 1, '2026-01-02 12:10:56', '2026-01-02 12:10:56'),
(341, 21, 'Dung lượng RAM', '8 GB (1 x 8GB)', 2, '2026-01-02 12:10:56', '2026-01-02 12:10:56'),
(342, 21, 'Tốc độ Bus RAM', '3200 MHz', 3, '2026-01-02 12:10:56', '2026-01-02 12:10:56'),
(343, 22, 'Loại RAM', 'DDR5', 1, '2026-01-02 12:11:06', '2026-01-02 12:11:06'),
(344, 22, 'Dung lượng RAM', '32 GB (2x 16GB)', 2, '2026-01-02 12:11:06', '2026-01-02 12:11:06'),
(345, 22, 'Overclock', 'Intel XMP 3.0', 3, '2026-01-02 12:11:06', '2026-01-02 12:11:06'),
(346, 22, 'Điện Áp', '1.1v - 1.4v', 4, '2026-01-02 12:11:06', '2026-01-02 12:11:06'),
(347, 23, 'Loại RAM', 'DDR4', 1, '2026-01-02 12:11:15', '2026-01-02 12:11:15'),
(348, 23, 'Dung lượng RAM', '16 GB (1 x 16GB)', 2, '2026-01-02 12:11:15', '2026-01-02 12:11:15'),
(349, 23, 'Điện Áp', '1.2V', 3, '2026-01-02 12:11:15', '2026-01-02 12:11:15'),
(350, 23, 'CAS Latency', 'CL22-22-22-52', 4, '2026-01-02 12:11:15', '2026-01-02 12:11:15'),
(351, 24, 'Loại RAM', 'DDR4', 1, '2026-01-02 12:11:25', '2026-01-02 12:11:25'),
(352, 24, 'Dung lượng RAM', '8 GB (1 x 8GB)', 2, '2026-01-02 12:11:25', '2026-01-02 12:11:25'),
(353, 24, 'Overclock', 'lntel XMP 2.0', 3, '2026-01-02 12:11:25', '2026-01-02 12:11:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_url`, `alt_text`, `sort_order`, `created_at`, `updated_at`) VALUES
(28, 12, 'products/7jGTZE0MEIs7H0MYoBCwEzrmhZ2Kp7cEbjPhsTai.jpg', 'Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA (Core 5 210H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 1, '2025-11-22 05:43:58', '2025-11-22 05:43:58'),
(29, 12, 'products/KFgXd5N6XZLefoIy8j61sMlduzMTboRjJX1Vl6Mg.webp', 'Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA (Core 5 210H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 2, '2025-11-22 05:43:58', '2025-11-22 05:43:58'),
(30, 12, 'products/LfvT8EtRjN7uslgrqi1VgVl5afOXxzTbZUEXSjMp.webp', 'Laptop Lenovo ThinkPad E16 Gen 3 21TF003QVA (Core 5 210H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 3, '2025-11-22 05:43:58', '2025-11-22 05:43:58'),
(31, 13, 'products/LEtjRqrJb2jd3ytt994qc4DW4c4BdwnC21wuHegy.webp', 'Laptop Lenovo Thinkbook 14 Gen 8 IRL 21SG007PVA (Core 7 240H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS WUXGA 60Hz)', 4, '2025-11-22 06:03:29', '2025-11-22 06:03:29'),
(32, 13, 'products/0VYtIHOomU1rZPTMfrX7AJyW0THaTq5i1Juic9H9.jpg', 'Laptop Lenovo Thinkbook 14 Gen 8 IRL 21SG007PVA (Core 7 240H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS WUXGA 60Hz)', 3, '2025-11-22 06:03:29', '2025-11-22 06:03:29'),
(33, 13, 'products/PJW74I67J0Wid8Av2XbJaYjftSgMTLXVSI9vS3FB.jpg', 'Laptop Lenovo Thinkbook 14 Gen 8 IRL 21SG007PVA (Core 7 240H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS WUXGA 60Hz)', 1, '2025-11-22 06:03:29', '2025-11-22 06:03:29'),
(34, 13, 'products/hcuh6jDIJs9zS29jifJkxBifkaYVhdz2e5V1antF.jpg', 'Laptop Lenovo Thinkbook 14 Gen 8 IRL 21SG007PVA (Core 7 240H, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS WUXGA 60Hz)', 2, '2025-11-22 06:03:29', '2025-11-22 06:03:29'),
(35, 14, 'products/zkWLqchgjfJJRo16qSyU0ZeGWangWZzDpS7Aag3Y.webp', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 1, '2025-12-02 23:12:07', '2025-12-02 23:12:07'),
(36, 14, 'products/1O1m6St0eYNVVlP25gSlhgjy04bSZbD6gqD7LXmA.jpg', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 2, '2025-12-02 23:12:07', '2025-12-02 23:12:07'),
(37, 14, 'products/i2VY3XztCCTLWIBXq7yBoS7i8NBbAPgWNd2cQEnI.jpg', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 3, '2025-12-02 23:12:07', '2025-12-02 23:12:07'),
(38, 14, 'products/0H9NpD7LZtmesB985jSqyZNZA6JrqLc1yfyjFdPY.webp', 'Laptop MSI Katana 15 HX B14WFK-025VN (i7-14650HX, RTX 5060 8GB, RAM 16GB D5, SSD 512GB, 15.6 Inch QHD IPS 165Hz, 100% DCI-P3)', 4, '2025-12-02 23:12:07', '2025-12-02 23:12:07'),
(39, 15, 'products/yY73i8Q315jD7RYNhUCqIEPndWxE7XpoQauwzeqx.webp', 'Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA (Ultra 5 225U, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 1, '2025-12-03 01:11:49', '2025-12-03 01:11:49'),
(40, 15, 'products/8iGLtiwjAQMzEQ4y3bH2a99XOJMgFXjoqj27pnXC.jpg', 'Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA (Ultra 5 225U, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 2, '2025-12-03 01:11:49', '2025-12-03 01:11:49'),
(41, 15, 'products/XI0Bud1ZlzfzkgfmonF4ni3AXPpBmwuhvojiB6lD.webp', 'Laptop Lenovo ThinkPad E16 Gen 3 21SR002JVA (Ultra 5 225U, Intel Graphics, RAM 16GB DDR5, SSD 512GB, 16 Inch IPS WUXGA 60Hz, NoOS)', 3, '2025-12-03 01:11:49', '2025-12-03 01:11:49'),
(42, 16, 'products/HLwEo94CMD6cUR8snw9kecIj4J3EQLDS7EXKaR2L.png', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 1, '2025-12-03 01:16:17', '2025-12-03 01:16:17'),
(43, 16, 'products/L4k3iWuBUUYJIwMXBD7K1cL2h6lbCAswcQI2onIO.webp', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 2, '2025-12-03 01:16:17', '2025-12-03 01:16:17'),
(44, 16, 'products/KaFc19mxs7sr60vJrjqqJUhGckFdty5QQ2dziwj5.jpg', 'Laptop Gaming MSI Crosshair 16 HX AI D2XWFKG-036VN (Ultra 7 255HX, RTX 5060 8GB, Ram 16GB DDR5, SSD 1TB, 16 Inch IPS QHD+ 240Hz 100% DCI-P3, Win 11)', 3, '2025-12-03 01:16:17', '2025-12-03 01:16:17'),
(45, 17, 'products/SdM49Lz6IoQHMyL2WeDtJwWykb9mREwuchZvUCNA.webp', 'PC M5 i5-5060 (i5-14400F, RTX 5060 8GB, RAM DDR5 32GB, SSD 1TB, 650W, WIN11)', 1, '2025-12-23 11:29:37', '2025-12-23 11:29:37'),
(46, 17, 'products/gsLXAIxZaiZXJfWhYLfM726eXL3M7PYfNAuAr8uV.webp', 'PC M5 i5-5060 (i5-14400F, RTX 5060 8GB, RAM DDR5 32GB, SSD 1TB, 650W, WIN11)', 2, '2025-12-23 11:29:37', '2025-12-23 11:29:37'),
(47, 17, 'products/4qd9EWJJTD36KtHaQyAOA3Yrg9N057saW3JdAnIO.webp', 'PC M5 i5-5060 (i5-14400F, RTX 5060 8GB, RAM DDR5 32GB, SSD 1TB, 650W, WIN11)', 3, '2025-12-23 11:29:37', '2025-12-23 11:29:37'),
(48, 18, 'products/D3sWEbj2xGCjeXlkG8pjf9HDNrpAerA0VmTSrpXq.webp', 'PC ST Văn Phòng R5-5500GT (Ryzen 5 5500GT, Radeon Graphics, Ram 8GB, SSD 500GB, 500W, Win 11)', 1, '2025-12-25 12:01:15', '2025-12-25 12:01:15'),
(49, 18, 'products/JQ6dB351R3C6R7yUevXhD30M5kXITKT5RtYcagKY.webp', 'PC ST Văn Phòng R5-5500GT (Ryzen 5 5500GT, Radeon Graphics, Ram 8GB, SSD 500GB, 500W, Win 11)', 2, '2025-12-25 12:01:15', '2025-12-25 12:01:15'),
(50, 18, 'products/gNaRrYrnM5SkdiXAZdkNbqzEK3ZXBT3qzBoBFHup.webp', 'PC ST Văn Phòng R5-5500GT (Ryzen 5 5500GT, Radeon Graphics, Ram 8GB, SSD 500GB, 500W, Win 11)', 3, '2025-12-25 12:01:15', '2025-12-25 12:01:15'),
(51, 18, 'products/j0i8aYELc0tRbGKlJO0QhNAiJxyQsjqi9qU256vm.webp', 'PC ST Văn Phòng R5-5500GT (Ryzen 5 5500GT, Radeon Graphics, Ram 8GB, SSD 500GB, 500W, Win 11)', 4, '2025-12-25 12:01:15', '2025-12-25 12:01:15'),
(52, 18, 'products/byNfwhYoxVcaIaUyb7SWQw9FZK4xa3i3BUCeFafn.webp', 'PC ST Văn Phòng R5-5500GT (Ryzen 5 5500GT, Radeon Graphics, Ram 8GB, SSD 500GB, 500W, Win 11)', 5, '2025-12-25 12:01:15', '2025-12-25 12:01:15'),
(53, 19, 'products/XLW3iDKMbdHBKCmFThqsXv5G05mQ0POpgRhW7Kfj.webp', 'PC MSI i5K-5070 White ( i5-14600K, RTX 5070 OC 12GB, Ram 32GB DDR5, SSD 1TB, 850W )', 1, '2025-12-25 12:10:13', '2025-12-25 12:10:13'),
(54, 19, 'products/lEWNoe0nsI2Rnzsuuwkv2QvR1YvgFYFOAOidrtmV.webp', 'PC MSI i5K-5070 White ( i5-14600K, RTX 5070 OC 12GB, Ram 32GB DDR5, SSD 1TB, 850W )', 2, '2025-12-25 12:10:13', '2025-12-25 12:10:13'),
(55, 19, 'products/p243UYJ4wKBzfNk6XrCflCg5XxxKNi32syhh6KB3.webp', 'PC MSI i5K-5070 White ( i5-14600K, RTX 5070 OC 12GB, Ram 32GB DDR5, SSD 1TB, 850W )', 3, '2025-12-25 12:10:13', '2025-12-25 12:10:13'),
(56, 19, 'products/ECzICpKmUmIQGyQPRrWHAMKOeG07IJDbulDx9Uce.webp', 'PC MSI i5K-5070 White ( i5-14600K, RTX 5070 OC 12GB, Ram 32GB DDR5, SSD 1TB, 850W )', 4, '2025-12-25 12:10:13', '2025-12-25 12:10:13'),
(57, 19, 'products/8Gs1VWyiERz7Rt4uYNWFlbE6SxG3e3c0w8myezMe.webp', 'PC MSI i5K-5070 White ( i5-14600K, RTX 5070 OC 12GB, Ram 32GB DDR5, SSD 1TB, 850W )', 5, '2025-12-25 12:10:13', '2025-12-25 12:10:13'),
(58, 20, 'products/e63KyNsamGhCfFcwHRZoBWsZj6JAhZWNw8ZF1q9h.webp', 'Mini PC ASRock DeskMini X300 ST-AX35500GT (Ryzen 5 5500GT, Ram DDR4, SSD 500GB, Win 11)', 2, '2025-12-25 12:16:52', '2025-12-25 12:16:52'),
(59, 20, 'products/VSaokRrggvAqfws2JM7WvkokcrFcXqFhX6pZOBUf.webp', 'Mini PC ASRock DeskMini X300 ST-AX35500GT (Ryzen 5 5500GT, Ram DDR4, SSD 500GB, Win 11)', 1, '2025-12-25 12:16:52', '2025-12-25 12:16:52'),
(60, 20, 'products/9kCNqvhXoWacnBvBGcjPItvLVqN9jwNIa6vyYL3C.webp', 'Mini PC ASRock DeskMini X300 ST-AX35500GT (Ryzen 5 5500GT, Ram DDR4, SSD 500GB, Win 11)', 3, '2025-12-25 12:16:52', '2025-12-25 12:16:52'),
(61, 21, 'products/eM5ED8PRIwQ72VESfC1tqqHIQZSr5IlxNCsPsFQp.webp', 'Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A', 1, '2026-01-02 00:46:19', '2026-01-02 00:46:19'),
(62, 21, 'products/Yrr0pYyankVF1I3f5Hu7kiIsniflJ1RlpI5xgkfb.webp', 'Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A', 2, '2026-01-02 00:46:19', '2026-01-02 00:46:19'),
(63, 21, 'products/KlPGcMI6GlEkBBx3IEdmwoLy3rFxtc3IHm3GRjM6.webp', 'Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A', 3, '2026-01-02 00:46:19', '2026-01-02 00:46:19'),
(64, 21, 'products/3MjL76q6Z4hSKD7jNIwmZk4IwSehW3gWMhUI8iCW.webp', 'Ram PC Crucial 8GB 3200MHz DDR4 CT8G4DFRA32A', 4, '2026-01-02 00:46:19', '2026-01-02 00:46:19'),
(65, 22, 'products/mnwKpr1bs01Pd3uJp0fgBcOLnAqcYJXLUdkDMqKM.webp', 'Ram PC Corsair Vengeance RGB White 32GB 6000MHz DDR5 (2x16GB) CMH32GX5M2E6000C36W', 1, '2026-01-02 01:02:55', '2026-01-02 01:02:55'),
(66, 22, 'products/iC9JKNrZmpP4uFaTNxot8JdvuhRTT5j55Hgzjg1i.webp', 'Ram PC Corsair Vengeance RGB White 32GB 6000MHz DDR5 (2x16GB) CMH32GX5M2E6000C36W', 2, '2026-01-02 01:02:55', '2026-01-02 01:02:55'),
(67, 23, 'products/mM0LY6YGspSYWPYLE1fcfCazRG3L94zHPXNjTA4t.webp', 'Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB', 1, '2026-01-02 01:06:37', '2026-01-02 01:06:37'),
(68, 23, 'products/BOGLyTmMjND6VcpbHH8d3IsBCN650NpwxvcpoKl8.webp', 'Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB', 2, '2026-01-02 01:06:37', '2026-01-02 01:06:37'),
(69, 23, 'products/zOquGU0A6tQq52BYasRL5HGmJqslonuAq2lCyfnh.webp', 'Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB', 3, '2026-01-02 01:06:37', '2026-01-02 01:06:37'),
(70, 23, 'products/Qn05zNHZPU7v5AXN29lHhA4zhZZBaZAdTtEHIEpc.webp', 'Ram Laptop Acer SD100 DDR4 16GB 3200MHz 1.2v SD100-16GB', 4, '2026-01-02 01:06:37', '2026-01-02 01:06:37'),
(71, 24, 'products/1qA2W8EdW9gnfyZvPRRucgiHgjURLLVJU3JYbC0c.webp', 'Ram PC Kingston Fury Beast Black 8GB 3200MHz DDR4 KF432C16BB/8WP', 1, '2026-01-02 01:46:22', '2026-01-02 01:46:22'),
(72, 24, 'products/diEkrhdvPVoYPql0VIZhXAN1nBMxOW2I4S9UL3LV.webp', 'Ram PC Kingston Fury Beast Black 8GB 3200MHz DDR4 KF432C16BB/8WP', 2, '2026-01-02 01:46:22', '2026-01-02 01:46:22'),
(73, 24, 'products/rMlClxAvgfH2GlnvrcSmevHr10Ud6IATN9tbVW1I.webp', 'Ram PC Kingston Fury Beast Black 8GB 3200MHz DDR4 KF432C16BB/8WP', 3, '2026-01-02 01:46:22', '2026-01-02 01:46:22'),
(74, 24, 'products/kaCvPzFZ1cwCY5UNvuMTn9mR0rtcyDeoOfJESOx8.webp', 'Ram PC Kingston Fury Beast Black 8GB 3200MHz DDR4 KF432C16BB/8WP', 4, '2026-01-02 01:46:22', '2026-01-02 01:46:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `promo_id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount_type` enum('percent','fixed') DEFAULT 'fixed',
  `discount_value` decimal(10,2) DEFAULT 0.00,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `times_used` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`promo_id`, `code`, `description`, `discount_type`, `discount_value`, `starts_at`, `ends_at`, `usage_limit`, `times_used`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'khuyenmai2', NULL, 'fixed', 10000.00, '2025-12-18 23:00:00', '2026-01-20 10:00:00', 12, 4, 1, '2025-12-18 22:32:15', '2026-01-02 15:18:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2025-11-19 22:58:41', '2025-11-19 22:58:41'),
(2, 'admin', '2025-11-19 22:59:14', '2025-11-19 22:59:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sepay_transactions`
--

CREATE TABLE `sepay_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `transactionDate` varchar(255) NOT NULL,
  `accountNumber` varchar(255) NOT NULL,
  `subAccount` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `transferType` varchar(255) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `transferAmount` bigint(20) NOT NULL,
  `referenceCode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sepay_transactions`
--

INSERT INTO `sepay_transactions` (`id`, `gateway`, `transactionDate`, `accountNumber`, `subAccount`, `code`, `content`, `transferType`, `description`, `transferAmount`, `referenceCode`, `created_at`, `updated_at`) VALUES
(123456, 'MBBank', '2024-05-25 21:11:02', '0359123456', '', '', 'DH1022', 'in', 'Thanh toan QR SE123456', 1700000, 'FT123456789', '2025-12-21 17:28:51', '2025-12-21 17:28:51'),
(1234563, 'MBBank', '2024-05-25 21:11:02', '0359123456', '', '', 'DH6435829969', 'in', 'Thanh toan QR SE123456', 1700000, 'FT123456789', '2025-12-21 17:55:02', '2025-12-21 17:55:02'),
(12345633, 'MBBank', '2024-05-25 21:11:02', '0359123456', '', '', 'DH6435829969', 'in', 'Thanh toan QR SE123456', 100200000, 'FT123456789', '2025-12-21 18:01:15', '2025-12-21 18:01:15'),
(40114192, 'BIDV', '2026-01-26 13:55:03', '8875473196', '96247DUYHUNG456', 'DH3906059249', 'DH3906059249', 'in', 'BankAPINotify DH3906059249', 10000, '4d046539-4acf-4b57-818a-d2dacca320bd', '2026-01-26 06:55:07', '2026-01-26 06:55:07'),
(40114487, 'BIDV', '2026-01-26 13:58:31', '8875473196', '96247DUYHUNG456', 'DH4580997396', 'DH4580997396', 'in', 'BankAPINotify DH4580997396', 10000, '820654e7-f828-4762-9c2d-930250ec53ae', '2026-01-26 06:58:34', '2026-01-26 06:58:34'),
(40115958, 'BIDV', '2026-01-26 14:14:48', '8875473196', '96247DUYHUNG456', 'DH8242005021', 'DH8242005021', 'in', 'BankAPINotify DH8242005021', 10000, 'fbed3649-cd56-4775-9c75-85e72be90042', '2026-01-26 07:14:50', '2026-01-26 07:14:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('75c7obvbRU2EOXxlEwV34UdbeIEpEp9W6Zkb0fkf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRlJ6cjNqcHlEcXlmZDdwbzE1WjFWNHhHd0RrTlFYMXVGYXc1ZTBBUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0L2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoyMDoiYWRtaW4ucHJvZHVjdC5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc3MjYwNDY4ODt9fQ==', 1772604844),
('Ut3ghfu0lNQ6Yhu8jE8wEeTIxzfcCGD0eEMvQvtn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVzZnUXg1N1NFMmo1ZEdsVnRRVFBBVGp3TnZPeWZYczBDajJqejJEYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0IjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi5wcm9kdWN0LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NzI2MjI0NTU7fX0=', 1772623082);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `role_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'duyhung', NULL, 2, 'duyhung@gmail.com', NULL, '$2y$12$MCoVNN/r1o2FMnWZ94AhpOcNCVQ3dK.ZRkKGYJFrMH4TTyzhjDiaW', NULL, '2025-11-09 11:31:52', '2025-12-20 04:56:17'),
(2, 'test123456', '0947318390', 1, 'test123456@gmail.com', NULL, '$2y$12$3q7d8BGyK5ICwL7dqc2KJ.K7e3UCpjO7Ah4t9V58Vef/5CZDX3vpa', NULL, '2025-11-19 10:14:00', '2025-11-19 10:14:00'),
(3, 'duyhungtest', '0987777777', 1, 'duyhungtest@gmail.com', NULL, '$2y$12$8z3oXx6cT4l89O7EB3E3C.bRoSQ2/a0IMXH2nFuxQcbfTT3z7oI1W', NULL, '2025-12-20 04:55:36', '2025-12-20 04:55:36');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_brands_category` (`category_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `ux_cart_product` (`cart_id`,`product_id`),
  ADD KEY `fk_cartitem_product` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `idx_parent_id` (`parent_id`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_sort_order` (`sort_order`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opt_key` (`opt_key`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD UNIQUE KEY `order_number_2` (`order_number`),
  ADD KEY `fk_order_promo` (`promo_id`),
  ADD KEY `fk_order_handled_by` (`handled_by`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_orderitem_order` (`order_id`),
  ADD KEY `fk_orderitem_product` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `fk_product_category` (`category_id`),
  ADD KEY `fk_product_brand` (`brand_id`);

--
-- Chỉ mục cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`attr_id`),
  ADD KEY `fk_prodattr_product` (`product_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_prodimg_product` (`product_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promo_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Chỉ mục cho bảng `sepay_transactions`
--
ALTER TABLE `sepay_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `FK_role_user` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng tự tăng', AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `attr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sepay_transactions`
--
ALTER TABLE `sepay_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40115959;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `fk_brands_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cartitem_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cartitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_inventory_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_menu_parent` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`menu_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_handled_by` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_promo` FOREIGN KEY (`promo_id`) REFERENCES `promotions` (`promo_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orderitem_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orderitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `fk_prodattr_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_prodimg_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_role_user` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
