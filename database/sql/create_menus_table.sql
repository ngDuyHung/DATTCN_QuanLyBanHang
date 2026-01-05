-- SQL Script để tạo bảng menus
-- Chạy script này trong MySQL/phpMyAdmin để tạo bảng

CREATE TABLE `menus` (
    `menu_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL COMMENT 'Tên menu hiển thị',
    `url` VARCHAR(500) NULL COMMENT 'Đường dẫn URL (có thể là đầy đủ https hoặc relative)',
    `type` VARCHAR(50) NOT NULL DEFAULT 'header' COMMENT 'Loại menu: header, footer, sidebar',
    `parent_id` BIGINT UNSIGNED NULL DEFAULT NULL COMMENT 'ID của menu cha (NULL nếu là menu cấp 1)',
    `sort_order` INT NOT NULL DEFAULT 1 COMMENT 'Thứ tự sắp xếp',
    `is_active` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái: 1 = Hoạt động, 0 = Tạm tắt',
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`menu_id`),
    INDEX `idx_parent_id` (`parent_id`),
    INDEX `idx_type` (`type`),
    INDEX `idx_sort_order` (`sort_order`),
    INDEX `idx_is_active` (`is_active`),
    CONSTRAINT `fk_menu_parent` FOREIGN KEY (`parent_id`) REFERENCES `menus`(`menu_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng quản lý menu website';

-- Dữ liệu mẫu (có thể bỏ qua nếu không cần)
INSERT INTO `menus` (`name`, `url`, `type`, `parent_id`, `sort_order`, `is_active`) VALUES
('Trang chủ', '/', 'header', NULL, 1, 1),
('Sản phẩm', '/san-pham', 'header', NULL, 2, 1),
('Điện thoại', '/dien-thoai', 'header', 2, 1, 1),
('Laptop', '/laptop', 'header', 2, 2, 1),
('Tin tức', '/tin-tuc', 'header', NULL, 3, 1),
('Liên hệ', '/lien-he', 'header', NULL, 4, 1),
('Về chúng tôi', '/ve-chung-toi', 'footer', NULL, 1, 1),
('Chính sách bảo hành', '/chinh-sach-bao-hanh', 'footer', NULL, 2, 1);
