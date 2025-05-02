-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 04:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dolce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(11, 38, 48, 1),
(0, 132, 30, 1),
(0, 132, 28, 2),
(0, 132, 27, 1),
(0, 7, 27, 1),
(0, 7, 26, 1),
(0, 7, 28, 1),
(0, 7, 32, 1),
(0, 6, 27, 1),
(0, 6, 26, 1),
(0, 6, 31, 1),
(0, 6, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'bread'),
(2, 'cake'),
(3, 'cookie');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) DEFAULT 1,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `addressDetail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `userName`, `password`, `fullName`, `phoneNumber`, `email`, `status`, `province_id`, `district_id`, `addressDetail`) VALUES
(1, 'nguyenvanhuy12345', '$2y$10$MegkdZ80iIRyh0P.B6CETOPdQXwJM3vlhe..SFlyjpk', 'Nguyễn Văn Hai', '0987654375', 'nguyenvassna@gmail.com', 3, 1, 2, '123'),
(2, 'vodathai1234', '$2y$10$khUKeLIVnDOck1sYIYgSxeCupe/JH3kDn8BcRIczv0a', 'Võ Đạt Hải', '0912345678', 'hai@yahoo.com', 1, 2, 3, 'abc'),
(6, 'user1234', '$2y$10$KKjugZ3DJ7Omr8rYFHaNTO9dQFbQAeBHsjtxwLlQK2p5uc0N1QuVi', 'Cô Độc Vương', '0886121849', 'quockhanhtanghuynh@gmail.com', 1, 2, 3, 'Số 12 Phan Đình Phùng, Phường Quán Thánh'),
(7, 'vogiahuy1234', '$2y$10$rauSNjQ.Orv9/vFLItiyg.Nh0dc1r3MqivnDFKcVrgyiq888jWMWe', 'Gia Huy', '0816808776', 'huy1213@gmail.com', 1, 1, 1, '335 Nguyễn Hữu Thọ'),
(8, 'huy123', '$2y$10$SqFwD0roi6rON17OQswAi.V32/Oa6XTraZ4HsTdvwiONICEWfA4xS', 'Võ Huy ', '0816808776', 'huy1234@gmail.com', 1, 1, 1, '123 csac'),
(9, 'huy1234', '$2y$10$mQFD6VdxkdGjoikYfB5z0ePB0g66Ua/jo2gc22ftQU8Da6EoRPm4S', 'Huy Voxx', '0816808776', 'huy12345@gmail.com', 1, 1, 1, 'er'),
(10, 'huy12345', '$2y$10$MDrVx8L/P5AulOfSTYLR/.eajN7j7jibvL6uIWuL7Xemr7VI225IG', 'khanhtang', '0816808776', 'huy121113@gmail.com', 1, 1, 2, '123');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `province_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `province_id`) VALUES
(1, 'Quận 1', 1),
(2, 'Quận Bình Thạnh', 1),
(3, 'Ba Đình', 2),
(4, 'Cầu Giấy', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employeeaccount`
--

CREATE TABLE `employeeaccount` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeeaccount`
--

INSERT INTO `employeeaccount` (`id`, `userName`, `password`, `permission_id`, `status`) VALUES
(1, 'NV001', '$2y$10$YPfCS7hEiqqYXiAkTHu4.OQQCHjJwzQ9X51QJeZnm3AQR6rEJUhsq', 1, 1),
(2, 'NV002', '$2y$10$ejVbVvt5lGW2v0uzZBsnyehoZ7m9AFAm99hw62/lrK3WU8RsQ0jDG', 2, 1),
(3, 'NV003', '$2y$10$7zYVJgxP1lNYjOPWFYhb/eBt.183JS6W8CLBp2CKG2ZA.NgZxZdYe', 2, 1),
(7, 'NV004', '$2y$10$664BdQJ1AnvTYZiQQ44G1OYiGYgXG.yvjHV54Zrp4SQZVSlfOsDWq', 2, 1),
(10, 'NV005', '$2y$10$kYrSZx9XL7Do0OSEo3lalOY5OVpdzvfnkf0qql0McjtMoEHgAm96G', 3, 1),
(11, 'NV006', '$2y$10$kkKJIzdZMnl7J2OPPID3B.M93BPaP4QZ7z7rUGZtnZXt9ck1oQYni', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` varchar(50) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fullName`, `email`, `phoneNumber`, `address`, `position_id`) VALUES
('NV001', 'Nguyễn Văn A', 'a.nguyen@example.com', '0901234567', 'TP.HCM', 2),
('NV002', 'Trần Thị B', 'b.tran@example.com', '0912345678', 'Hà Nội', 3),
('NV003', 'Lê Văn C', 'c.le@example.com', '0923456789', 'Đà Nẵng', 4),
('NV004', 'Võ Gia Huy', 'giahuya6k5@gmail.com', '0816808776', 'Long An', 4),
('NV005', 'Võ Đạt Hải', 'hai@gmail.com', '0772663776', 'Long An', 4),
('NV006', 'Huy DepzaiVLL', 'huy@gmail.com', '0816808776', 'Long An', 1);

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `before_insert_nhanvien` BEFORE INSERT ON `employees` FOR EACH ROW BEGIN
  DECLARE max_id INT DEFAULT 0;
  DECLARE new_id VARCHAR(10);

  -- Lấy phần số lớn nhất từ các ID hiện có (ví dụ: NV003 -> 3)
  SELECT IFNULL(MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)), 0)
  INTO max_id
  FROM employees;

  -- Tăng giá trị lên 1 và định dạng lại thành NVxxx
  SET new_id = CONCAT('NV', LPAD(max_id + 1, 3, '0'));

  -- Gán giá trị ID mới cho bản ghi sắp chèn
  SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`id`, `name`) VALUES
(1, 'Xem đơn hàng'),
(2, 'Sửa đơn hàng'),
(3, 'Xóa đơn hàng'),
(4, 'Xem khách hàng'),
(5, 'Sửa khách hàng'),
(6, 'Xóa khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `importreceipts`
--

CREATE TABLE `importreceipts` (
  `id` varchar(10) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `totalAmount` decimal(15,2) DEFAULT 0.00,
  `importDate` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `importreceipts`
--

INSERT INTO `importreceipts` (`id`, `employee_id`, `supplier_id`, `totalAmount`, `importDate`, `status`) VALUES
('IP001', 'NV006', 1, 63600000.00, '2025-04-26', 1);

--
-- Triggers `importreceipts`
--
DELIMITER $$
CREATE TRIGGER `before_insert_importreceipts` BEFORE INSERT ON `importreceipts` FOR EACH ROW BEGIN
    DECLARE max_id VARCHAR(10);
    DECLARE new_id VARCHAR(10);
    DECLARE max_num INT;

    -- Lấy giá trị số lớn nhất từ các ID hiện có
    SELECT IFNULL(MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)), 0)
    INTO max_num
    FROM importreceipts;

    -- Tăng giá trị lên 1 và định dạng lại thành IPxxx
    SET new_id = CONCAT('IP', LPAD(max_num + 1, 3, '0'));

    -- Gán giá trị ID mới cho bản ghi
    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `importreceipt_detail`
--

CREATE TABLE `importreceipt_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `importreceipt_id` varchar(10) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `unitPrice` decimal(15,2) DEFAULT 0.00,
  `serialList` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `fk_importreceipt_id` (`importreceipt_id`),
  CONSTRAINT `fk_importreceipt_id` FOREIGN KEY (`importreceipt_id`) REFERENCES `importreceipts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `importreceipt_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(23, 32, 1, 250000),
(23, 33, 28, 94000),
(23, 34, 1, 50000),
(23, 35, 1, 75000),
(24, 25, 1, 5500000),
(24, 26, 2, 350000),
(24, 27, 3, 450000),
(24, 28, 1, 700000),
(24, 39, 1, 75000),
(24, 40, 1, 75000),
(25, 26, 1, 350000),
(25, 27, 1, 450000),
(25, 28, 1, 700000),
(25, 30, 1, 250000),
(25, 32, 1, 250000),
(26, 27, 1, 450000),
(26, 30, 1, 250000),
(26, 31, 1, 250000),
(27, 30, 1, 250000),
(27, 31, 1, 250000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `paymentMethod_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `addressDetail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `totalPrice`, `orderDate`, `status`, `notes`, `paymentMethod_id`, `province_id`, `district_id`, `addressDetail`) VALUES
(23, 8, 3507000, '2025-04-22', 4, 'giao hãy gọi phone', 1, 1, 1, '123 csac'),
(24, 9, 8400000, '2025-04-23', 4, '', 1, 1, 1, '123 asd'),
(25, 10, 2000000, '2025-04-23', 4, '', 1, 1, 1, 'sad'),
(26, 10, 950000, '2025-04-23', 4, '', 1, 1, 1, '123'),
(27, 10, 500000, '2025-04-23', 4, '', 1, 1, 1, '123');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `name`) VALUES
(1, 'Chờ xử lý'),
(2, 'Đã xử lý'),
(3, 'Đang giao'),
(4, 'Đã giao'),
(5, 'Đã hủy');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `name`) VALUES
(1, 'thanh toán khi nhận hàng'),
(2, 'thanh toán bằng ATM');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod_detail`
--

CREATE TABLE `paymentmethod_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `card_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `permission_function`
--

CREATE TABLE `permission_function` (
  `permission_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_function`
--

INSERT INTO `permission_function` (`permission_id`, `function_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 3),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Quản lí'),
(3, 'Kế toán'),
(4, 'Nhân viên');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pd_name` varchar(255) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pd_name`, `subcategory_id`, `quantity`, `price`, `image`, `supplier_id`) VALUES
(25, 'Mèo Chiêu Tài', 2, 6, 5500000.00, '/Dolce-bakery/assest/PD-Manager/meotailoc.png', 1),
(26, 'Hũ Vàng Thần Tài', 2, 5, 350000.00, '/Dolce-bakery/assest/PD-Manager/thantai.png', 1),
(27, 'Xuân Như Ý', 3, 5, 450000.00, '/Dolce-bakery/assest/PD-Manager/xuannhuy.png', 3),
(28, 'Thanh Xà Điệu Đà', 4, 5, 700000.00, '/Dolce-bakery/assest/PD-Manager/xadieuda.png', 4),
(29, 'Bánh Kem Trà Xanh', 5, 11, 250000.00, '/Dolce-bakery/assest/PD-Manager/12cm.png', 1),
(30, 'Bánh Kem Bơ Cafe', 6, 5, 250000.00, '/Dolce-bakery/assest/PD-Manager/cafe.png', 1),
(31, 'Bánh Kem Chocolate', 7, 12, 250000.00, '/Dolce-bakery/assest/PD-Manager/chocola12cm.png', 4),
(32, 'Bánh Kem Bơ Cafe2', 8, 12, 250000.00, '/Dolce-bakery/assest/PD-Manager/bocafe.png', 3),
(33, 'Macaron', 9, 2, 94000.00, '/Dolce-bakery/assest/PD-Manager/macaron.png', 2),
(34, 'Bánh Quy Đồng Tiền', 8, 2, 50000.00, '/Dolce-bakery/assest/PD-Manager/banhdongtien.png', 2),
(35, 'Bánh Quy Trà Xanh', 7, 4, 75000.00, '/Dolce-bakery/assest/PD-Manager/quytraxanh.png', 2),
(36, 'Bánh Xoán Đường', 6, 2, 75000.00, '/Dolce-bakery/assest/PD-Manager/xoanduong.png', 2),
(37, 'Bánh Dứa Mini', 5, 2, 98000.00, '/Dolce-bakery/assest/PD-Manager/duamini.png', 5),
(38, 'Bánh Phô Mai Que', 4, 2, 95000.00, '/Dolce-bakery/assest/PD-Manager/phomaique.png', 2),
(39, 'Cookies Lưỡi Mèo', 3, 3, 75000.00, '/Dolce-bakery/assest/PD-Manager/luoimeo.png', 2),
(40, 'Bánh Quy Socola', 2, 2, 75000.00, '/Dolce-bakery/assest/PD-Manager/banh-quy-socola01-17369169346.png', 2),
(41, 'Red Velvet Cookies', 1, 4, 75000.00, '/Dolce-bakery/assest/PD-Manager/red revel.png', 3),
(42, 'Apple Pie', 3, 12, 50000.00, '/Dolce-bakery/assest/PD-Manager/applecpie.png', 1),
(43, 'Almond Croissant', 5, 2, 65000.00, '/Dolce-bakery/assest/PD-Manager/almon.png', 4),
(44, 'Bánh Mì Sấy Bơ Tỏi', 7, 14, 25000.00, '/Dolce-bakery/assest/PD-Manager/saybotoi.png', 1),
(46, 'Bông Lan Phô Mai', 9, 14, 25000.00, '/Dolce-bakery/assest/PD-Manager/bonglanphomai.png', 2),
(47, 'Croissant Kem & Dâu', 8, 15, 50000.00, '/Dolce-bakery/assest/PD-Manager/croisant Kem.png', 3),
(48, 'Tôm Phô Mai', 6, 4, 25000.00, '/Dolce-bakery/assest/PD-Manager/tomphomi.png', 4),
(49, 'Phô Mai Hoàng Kim', 4, 6, 115000.00, '/Dolce-bakery/assest/PD-Manager/phomaihoangkim.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Hồ Chí Minh'),
(2, 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`) VALUES
(1, 'Bánh mì ngọt', 1),
(2, 'Bánh mì mặn', 1),
(3, 'Bánh mì sandwich', 1),
(4, 'Bánh lạnh', 2),
(5, 'Bánh kem tươi', 2),
(6, 'Bánh kem fondant', 2),
(7, 'Bánh quy bơ', 3),
(8, 'Bánh quy socola', 3),
(9, 'Bánh quy hạt dẻ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phoneNumber`) VALUES
(1, 'Bánh Kem SweetDream', '123 Đường Hoa Lan, Quận Phú Nhuận, TP.HCM', '0909123456'),
(2, 'Tiệm Bánh Ngọt Gấu Trúc', '45 Đường Nguyễn Trãi, Quận 5, TP.HCM', '0912345678'),
(3, 'Xưởng Bánh FreshCake', '88 Đường Lê Văn Sỹ, Quận 3, TP.HCM', '0987654321'),
(4, 'Bánh Sinh Nhật HappyCake', '27 Đường Cách Mạng Tháng 8, Quận 10, TP.HCM', '0903344556'),
(5, 'Tiệm Bánh SuKem Ngon', '56 Đường Phạm Văn Đồng, Thủ Đức, TP.HCM', '0933221100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`userName`),
  ADD KEY `fk_permission` (`permission_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importreceipts`
--
ALTER TABLE `importreceipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `importreceipt_detail`
--
ALTER TABLE `importreceipt_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_importreceipt_id` (`importreceipt_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `status` (`status`),
  ADD KEY `fk_payment_method` (`paymentMethod_id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmethod_detail`
--
ALTER TABLE `paymentmethod_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_function`
--
ALTER TABLE `permission_function`
  ADD PRIMARY KEY (`permission_id`,`function_id`),
  ADD KEY `permission_function_ibfk_2` (`function_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`subcategory_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_subcategory` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `importreceipt_detail`
--
ALTER TABLE `importreceipt_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymentmethod_detail`
--
ALTER TABLE `paymentmethod_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  ADD CONSTRAINT `fk_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userName`) REFERENCES `employees` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Constraints for table `importreceipts`
--
ALTER TABLE `importreceipts`
  ADD CONSTRAINT `importreceipts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `importreceipts_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `importreceipt_detail`
--
ALTER TABLE `importreceipt_detail`
  ADD CONSTRAINT `fk_importreceipt_id` FOREIGN KEY (`importreceipt_id`) REFERENCES `importreceipts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `importreceipt_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_payment_method` FOREIGN KEY (`paymentMethod_id`) REFERENCES `paymentmethod` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status`) REFERENCES `orderstatus` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `paymentmethod_detail`
--
ALTER TABLE `paymentmethod_detail`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `permission_function`
--
ALTER TABLE `permission_function`
  ADD CONSTRAINT `permission_function_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_function_ibfk_2` FOREIGN KEY (`function_id`) REFERENCES `functions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_category_subcategory` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
