-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 06:17 AM
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
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_dm` int(11) NOT NULL,
  `madm` varchar(50) NOT NULL,
  `tendm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id_dm`, `madm`, `tendm`) VALUES
(13, 'thethao', 'giày thể thao'),
(14, 'caogot', 'giày cao gót');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_giohang` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`id_giohang`, `name`, `price`, `amount`, `size`, `id_sp`, `status`, `created_at`, `updated_at`) VALUES
(14, 'giày SWITCH RUN', '5 500 000 VND', 1, '38', 33, 'da_thanh_toan', '2024-04-21 09:31:22', '2024-04-21 09:33:06'),
(16, 'giày SWITCH RUN', '5 500 000 VND', 4, '39', 33, 'da_thanh_toan', '2024-04-21 10:07:40', '2024-04-23 09:27:42'),
(19, 'giày sandal phong cách thời thượng', '4 500 000 VND', 2, '37', 34, 'da_thanh_toan', '2024-04-21 10:39:57', '2024-04-23 09:27:42'),
(20, 'giày gucci', '5 000 000 VND', 2, '36', 32, 'da_thanh_toan', '2024-04-23 09:39:52', '2024-04-23 09:40:29'),
(21, 'giày sandal phong cách thời thượng', '4 500 000 VND', 2, '36', 34, 'da_thanh_toan', '2024-04-23 09:39:56', '2024-04-23 09:40:29'),
(22, 'giày SWITCH RUN', '5 500 000 VND', 1, '36', 33, 'da_thanh_toan', '2024-04-23 09:44:00', '2024-04-23 09:53:27'),
(23, 'giày SWITCH RUN', '5 500 000 VND', 2, '36', 33, 'da_thanh_toan', '2024-04-23 09:54:16', '2024-04-25 09:42:41'),
(25, 'giày SWITCH RUN', '5 500 000 VND', 1, '39', 33, 'da_thanh_toan', '2024-04-25 13:29:02', '2024-04-25 13:29:54'),
(26, 'giày SWITCH RUN', '5 500 000 VND', 1, '39', 33, 'da_thanh_toan', '2024-04-25 13:40:21', '2024-04-25 13:56:19'),
(27, 'giày sandal phong cách thời thượng', '4 500 000 VND', 1, '38', 34, 'da_thanh_toan', '2024-04-25 13:55:59', '2024-04-25 13:56:19'),
(28, 'giày SWITCH RUN', '5 500 000 VND', 1, '37', 33, 'da_thanh_toan', '2024-04-25 13:59:45', '2024-04-25 14:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `lien_he`
--

CREATE TABLE `lien_he` (
  `id_lienhe` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `subject` text NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sp` int(11) NOT NULL,
  `anh` varchar(100) NOT NULL,
  `masp` varchar(50) NOT NULL,
  `tensp` varchar(100) NOT NULL,
  `id_dm` int(11) NOT NULL,
  `size` int(3) NOT NULL,
  `tt` text NOT NULL,
  `nd` text NOT NULL,
  `slg` int(20) NOT NULL,
  `gb` varchar(20) NOT NULL,
  `gn` varchar(20) NOT NULL,
  `ncc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_sp`, `anh`, `masp`, `tensp`, `id_dm`, `size`, `tt`, `nd`, `slg`, `gb`, `gn`, `ncc`) VALUES
(32, '7.jpg', '38g', 'giày gucci', 14, 38, 'PHOM DÁNG TỐI GIẢN CHƯA BAO GIỜ LỖI THỜI\r\n\r\nĐi làm thanh lịch, đi chơi êm chân\r\n\r\nƯu đãi 50% còn #550k\r\n\r\nthiết kế êm ái, gót cao vừa phải giúp việc di chuyển dễ dàng, tự tin hơn.\r\n\r\nKiểu dàng hiện tại, năng động những vẫn toát lên được vẻ kiêu kỳ thời thượng của phái nữ.\r\n\r\nDễ dàng phối với mọi trang phục, phụ kiện tôn lên sự cá tính của các nang.', 'PHOM DÁNG TỐI GIẢN CHƯA BAO GIỜ LỖI THỜI\r\n\r\nĐi làm thanh lịch, đi chơi êm chân\r\n\r\nƯu đãi 50% còn #550k\r\n\r\nthiết kế êm ái, gót cao vừa phải giúp việc di chuyển dễ dàng, tự tin hơn.\r\n\r\nKiểu dàng hiện tại, năng động những vẫn toát lên được vẻ kiêu kỳ thời thượng của phái nữ.\r\n\r\nDễ dàng phối với mọi trang phục, phụ kiện tôn lên sự cá tính của các nang.', 8, '5 000 000 VND', '2 050 000 VND', 'Còn hàng'),
(33, '6.jpg', '3g', 'giày SWITCH RUN', 13, 42, 'PHOM DÁNG TỐI GIẢN CHƯA BAO GIỜ LỖI THỜI\r\n\r\nĐi làm thanh lịch, đi chơi êm chân\r\n\r\nƯu đãi 50% còn #550k\r\n\r\nthiết kế êm ái, gót cao vừa phải giúp việc di chuyển dễ dàng, tự tin hơn.\r\n\r\nKiểu dàng hiện tại, năng động những vẫn toát lên được vẻ kiêu kỳ thời thượng của phái nữ.\r\n\r\nDễ dàng phối với mọi trang phục, phụ kiện tôn lên sự cá tính của các nang.', 'PHOM DÁNG TỐI GIẢN CHƯA BAO GIỜ LỖI THỜI\r\n\r\nĐi làm thanh lịch, đi chơi êm chân\r\n\r\nƯu đãi 50% còn #550k\r\n\r\nthiết kế êm ái, gót cao vừa phải giúp việc di chuyển dễ dàng, tự tin hơn.\r\n\r\nKiểu dàng hiện tại, năng động những vẫn toát lên được vẻ kiêu kỳ thời thượng của phái nữ.\r\n\r\nDễ dàng phối với mọi trang phục, phụ kiện tôn lên sự cá tính của các nang.', 9, '5 500 000 VND', '3 200 000 VND', 'Còn hàng'),
(34, 'caogot5a.jpg', '3i09', 'giày sandal phong cách thời thượng', 14, 40, 'phong cách thời thượng', 'chất liệu da, có đủ size từ 36 - 45', 10, '4 500 000 VND', '2 050 000 VND', 'Còn hàng'),
(35, '1.jpg', '35y', 'giày adidas', 13, 39, 'vcgdfgfd', 'fvbfbvfvb', 9, '5 000 000 VND', '2 050 000 VND', 'Còn hàng'),
(36, 'background1.jpg', 'bg6', 'giày đính đá ', 14, 40, 'dcvxvfdv', 'dfvdxvcd', 5, '10 000 000 VND', '3 500 000 VND', 'Còn hàng'),
(37, '10.jpg', '58p', 'giày ysl hot 2024', 14, 39, 'x xcvfdbv', 'c cxv c v', 3, '5 000 000 VND', '2 050 000 VND', 'Còn hàng');

-- --------------------------------------------------------

--
-- Table structure for table `thanh_toan`
--

CREATE TABLE `thanh_toan` (
  `id` int(11) NOT NULL,
  `id_thanhtoan` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL,
  `id_giohang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`id_giohang`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thanh_toan`
--

INSERT INTO `thanh_toan` (`id`, `id_thanhtoan`, `name`, `email`, `phone`, `address`, `type`, `note`, `id_giohang`, `created_at`, `updated_at`) VALUES
(1, 0, 'dau tay', 'khuynh5@gmail.com', '0961045114', 'bắc ninh', 'Thanh toán khi nhận hàng', 'mkiomk', '[{\"cart_id\":\"23\"}]', '2024-04-25 09:42:41', '2024-04-25 09:42:41'),
(2, 0, 'trai cay', 'traicay@gmail.com', '0961045114', 'bắc ninh', 'Thanh toán khi nhận hàng', 'vcxcxb', '[{\"cart_id\":\"28\"}]', '2024-04-25 14:00:13', '2024-04-25 14:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `userad`
--

CREATE TABLE `userad` (
  `id_ad` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `ad_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userad`
--

INSERT INTO `userad` (`id_ad`, `username`, `pass`, `ad_status`) VALUES
(3, 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userdk`
--

CREATE TABLE `userdk` (
  `id_u` int(11) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdk`
--

INSERT INTO `userdk` (`id_u`, `sdt`, `ten`, `pass`, `email`) VALUES
(10, '0123456789', 'khuynh', '25f9e794323b453885f5181f1b624d0b', 'khuynh5@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_dm`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_giohang`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Indexes for table `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`id_lienhe`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `id_dm` (`id_dm`);

--
-- Indexes for table `thanh_toan`
--
ALTER TABLE `thanh_toan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userad`
--
ALTER TABLE `userad`
  ADD PRIMARY KEY (`id_ad`);

--
-- Indexes for table `userdk`
--
ALTER TABLE `userdk`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_dm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_giohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `id_lienhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `thanh_toan`
--
ALTER TABLE `thanh_toan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userad`
--
ALTER TABLE `userad`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userdk`
--
ALTER TABLE `userdk`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`id_sp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_dm`) REFERENCES `danhmuc` (`id_dm`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
