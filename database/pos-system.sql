-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2026 at 12:59 PM
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
-- Database: `pos-system`
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
(8, 'jdc', '$2y$10$nkbAMPlKIVkfW44PKPsUieqF.H1QxWHB8cjixfVA8ouPoWcLFSMVi', 'Juanna Dela Cruz', NULL, '2026-10-03 10:53:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
