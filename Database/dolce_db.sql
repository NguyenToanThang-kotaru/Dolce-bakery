-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 12:43 PM
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
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `email`, `product_id`, `quantity`) VALUES
(155, 'quockhanhtanghuynh@gmail.com', 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `userName`, `password`, `fullName`, `phoneNumber`, `email`, `address`, `status`) VALUES
(1, 'nguyenvanhuy1234', '$2y$10$5P2ZmDSM2BvCboYuvBcFCeESufTOCeetMGGtB2Chk01', 'Nguyễn Văn Hau', '0987654375', 'nguyenvassna@gmail.com', 'Đức Hòa, Long An', 1),
(2, 'vodathai123', '$2y$10$hpMaBqC7aYz6mfOkih8u0eQCn3pqcQ.h3pLLVPHI8vG', 'Võ Đạt Hảii', '0912345678', 'tranthib@yahoo.com', 'TP.HCM', 2);

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
(1, 'Quản lí đơn hàng'),
(2, 'Quản lí sản phẩm'),
(3, 'Quản lí khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `paid_orders`
--

CREATE TABLE `paid_orders` (
  `order_id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `orderDate` date NOT NULL,
  `orderItem` text NOT NULL,
  `totalAmount` bigint(20) NOT NULL,
  `notes` text NOT NULL,
  `paymentMethod` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paid_orders`
--

INSERT INTO `paid_orders` (`order_id`, `userName`, `phoneNumber`, `email`, `address`, `orderDate`, `orderItem`, `totalAmount`, `notes`, `paymentMethod`) VALUES
(1, 'Cô Độc Vương', '0886121849', 'quockhanhtanghuynh@gmail.com', 'phuoc hai', '2025-12-04', '[{\"name\":\"Mèo Chiêu Tài\",\"quantity\":\"3\",\"totalPrice\":16500000},{\"name\":\"Hũ Vàng Thần Tài\",\"quantity\":\"2\",\"totalPrice\":700000}]', 17200000, 'giao luc tao di choi', 'thanh toán bằng ngân hàng techcombank 077205009502'),
(12, 'Cô Độc Vương', '0886121849', 'quockhanhtanghuynh@gmail.com', 'ba ria vung tau', '2025-12-04', '[{\"name\":\"Bánh Kem Chocolate\",\"quantity\":\"2\",\"totalPrice\":500000},{\"name\":\"Bánh Quy Trà Xanh\",\"quantity\":\"2\",\"totalPrice\":150000},{\"name\":\"Mèo Chiêu Tài\",\"quantity\":\"4\",\"totalPrice\":22000000},{\"name\":\"Bánh Kem Bơ Cafe\",\"quantity\":\"1\",\"totalPrice\":250000},{\"name\":\"Bánh Kem Bơ Cafe2\",\"quantity\":\"1\",\"totalPrice\":250000}]', 23150000, 'giao luc tao vang nha nhe', 'thanh toán bằng ngân hàng techcombank 077205009502');

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
(3, 'C'),
(22, 'G'),
(36, 'fe');

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
(3, 3),
(22, 1),
(22, 2),
(36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `quantity`, `price`, `image`) VALUES
(25, 'Mèo Chiêu Tài', 'cookie', 5, 5500000.00, '/Dolce-bakery/assest/PD-Manager/meotailoc.png'),
(26, 'Hũ Vàng Thần Tài', 'cake', 5, 350000.00, '/Dolce-bakery/assest/PD-Manager/thantai.png'),
(27, 'Xuân Như Ý', 'cake', 5, 450000.00, '/Dolce-bakery/assest/PD-Manager/xuannhuy.png'),
(28, 'Thanh Xà Điệu Đà', 'cake', 5, 700000.00, '/Dolce-bakery/assest/PD-Manager/xadieuda.png'),
(29, 'Bánh Kem Trà Xanh', 'cake', 11, 250000.00, '/Dolce-bakery/assest/PD-Manager/12cm.png'),
(30, 'Bánh Kem Bơ Cafe', 'cake', 5, 250000.00, '/Dolce-bakery/assest/PD-Manager/cafe.png'),
(31, 'Bánh Kem Chocolate', 'cake', 12, 250000.00, '/Dolce-bakery/assest/PD-Manager/chocola12cm.png'),
(32, 'Bánh Kem Bơ Cafe2', 'cake', 12, 250000.00, '/Dolce-bakery/assest/PD-Manager/bocafe.png'),
(33, 'Macaron', 'cookie', 2, 94000.00, '/Dolce-bakery/assest/PD-Manager/macaron.png'),
(34, 'Bánh Quy Đồng Tiền', 'cookie', 2, 50000.00, '/Dolce-bakery/assest/PD-Manager/banhdongtien.png'),
(35, 'Bánh Quy Trà Xanh', 'cookie', 4, 75000.00, '/Dolce-bakery/assest/PD-Manager/quytraxanh.png'),
(36, 'Bánh Xoán Đường', 'cookie', 2, 75000.00, '/Dolce-bakery/assest/PD-Manager/xoanduong.png'),
(37, 'Bánh Dứa Mini', 'cookie', 2, 98000.00, '/Dolce-bakery/assest/PD-Manager/duamini.png'),
(38, 'Bánh Phô Mai Que', 'cookie', 2, 95000.00, '/Dolce-bakery/assest/PD-Manager/phomaique.png'),
(39, 'Cookies Lưỡi Mèo', 'cookie', 3, 75000.00, '/Dolce-bakery/assest/PD-Manager/luoimeo.png'),
(40, 'Bánh Quy Socola', 'cookie', 2, 75000.00, '/Dolce-bakery/assest/PD-Manager/banh-quy-socola01-17369169346.png'),
(41, 'Red Velvet Cookies', 'cookie', 4, 75000.00, '/Dolce-bakery/assest/PD-Manager/red revel.png'),
(42, 'Apple Pie', 'bread', 12, 50000.00, '/Dolce-bakery/assest/PD-Manager/applecpie.png'),
(43, 'Almond Croissant', 'bread', 2, 65000.00, '/Dolce-bakery/assest/PD-Manager/almon.png'),
(44, 'Bánh Mì Sấy Bơ Tỏi', 'bread', 14, 25000.00, '/Dolce-bakery/assest/PD-Manager/saybotoi.png'),
(45, 'Bacon Phô Mai ', 'bread', 25, 25000.00, '/Dolce-bakery/assest/PD-Manager/bacon.png'),
(46, 'Bông Lan Phô Mai', 'bread', 14, 25000.00, '/Dolce-bakery/assest/PD-Manager/bonglanphomai.png'),
(47, 'Croissant Kem & Dâu', 'bread', 15, 50000.00, '/Dolce-bakery/assest/PD-Manager/croisant Kem.png'),
(48, 'Tôm Phô Mai', 'bread', 4, 25000.00, '/Dolce-bakery/assest/PD-Manager/tomphomi.png'),
(49, 'Phô Mai Hoàng Kim', 'bread', 6, 115000.00, '/Dolce-bakery/assest/PD-Manager/phomaihoangkim.png'),
(50, 'Phô Mai Chảy', 'bread', 4, 115000.00, '/Dolce-bakery/assest/PD-Manager/phomaichay.png'),
(51, 'Hũ Vàng Tài Lộc', 'cake', 3, 250000.00, '/Dolce-bakery/assest/PD-Manager/6-17377924658.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `numberPhone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `permission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `email`, `fullName`, `numberPhone`, `password`, `role`, `status`, `permission_id`) VALUES
(134, 'admin', 'admin@gmail.com', '', '', '$2y$10$/JWpewfU6APWiAEJ34S1G.dR5tk.caOKwNNzntI/FlHHPtbJQpgH6', 1, 1, 1),
(151, 'user12', 'sdsss3213sfd@gmail.com', '', '', '$2y$10$VBgZuD/ya0hiyB.vPl6n3eQaUKbOd0ie8DsH39E91stWh2l24lm7G', 1, 1, 3),
(153, 'user11', 'huy124532@gmail.com', '', '', '$2y$10$HWW.hzj9PRHV91phf6CF4.Dtw9KVfs8NwZZHOiT.mLD.p6lUzRoie', 1, 1, 22),
(154, 'huyr112532', 'huyagdshs@gmail.com', '', '', '$2y$10$5vkKmOGkGBHsd0XZoKWPQ.Btub1pKqxM.ydVoO1yUiJURozWCrqVC', 1, 1, 22),
(155, 'user123', 'quockhanhtanghuynh@gmail.com', 'Cô Độc Vương', '0886121849', '$2y$10$gp3HJchIGPDSWjcf91Wv1uP974tv7cReIygvgzIoMo1dll0Xn87gu', 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_orders`
--
ALTER TABLE `paid_orders`
  ADD PRIMARY KEY (`order_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_permission` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paid_orders`
--
ALTER TABLE `paid_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_function`
--
ALTER TABLE `permission_function`
  ADD CONSTRAINT `permission_function_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_function_ibfk_2` FOREIGN KEY (`function_id`) REFERENCES `functions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
