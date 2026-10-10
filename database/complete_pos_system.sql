-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 09:56 AM
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
-- Database: `complete_pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Maria Santos', 'maria@example.com', '09171234567', '2026-09-22 14:37:07'),
(2, 'Juan Dela Cruz', 'juan@example.com', '09182345678', '2026-09-22 14:37:07'),
(3, 'Angela Reyes', 'angela@example.com', '09193456789', '2026-09-22 14:37:07'),
(4, 'Carlo Mendoza', 'carlo@example.com', '09204567890', '2026-09-22 14:37:07'),
(5, 'Sofia Garcia', 'sofia@example.com', '09215678901', '2026-09-22 14:37:07'),
(6, 'Zyan Ilawrel', 'yz@gmail.com', '09123456789', '2026-10-03 08:31:23'),
(7, 'John Doe', 'jd@gmail.com', '09177223347', '2026-10-03 10:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock_quantity`, `image`, `created_at`) VALUES
(2, 'Apple', 56.00, 2, '1791545411_e9d372a8aa5c545e72e3.jpg', '2026-10-09 11:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `customer_id`, `sold_by`, `quantity`, `total_price`, `created_at`) VALUES
(1, 2, NULL, 1, 1, 56.00, '2026-10-10 07:39:20'),
(2, 2, 7, 8, 3, 168.00, '2026-10-10 07:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `avatar`, `created_at`) VALUES
(1, 'admin01', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Ana Villanueva', NULL, '2026-09-22 14:37:07'),
(2, 'cashier01', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Mark Bautista', '1791018117_3e43f3a153c7970b45f6.jpeg', '2026-09-22 14:37:07'),
(3, 'cashier02', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Liza Ramos', NULL, '2026-09-22 14:37:07'),
(4, 'manager01', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Paolo Flores', NULL, '2026-09-22 14:37:07'),
(5, 'staff01', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Nina Castillo', NULL, '2026-09-22 14:37:07'),
(6, 'mdc', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Mc Donalds Jr.', NULL, '2026-10-03 08:40:22'),
(7, 'cashier4', '$2y$10$XBsy3GGFWG2hyLCsSudGY.GwgIacOCceiMmsjYmPaI1xAmanS6Wj2', 'Ferb Fletcher', '1791021819_c75640552eca4f20772e.jpg', '2026-10-03 10:02:20'),
(8, 'jdc', '$2y$10$gQhGgtp23Sp0N3aJvrzpZOqQRR873me4PQiGf8DChSHDjtaYpbH/2', 'Juanna Dela Cruz', NULL, '2026-10-03 10:53:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `sold_by` (`sold_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
