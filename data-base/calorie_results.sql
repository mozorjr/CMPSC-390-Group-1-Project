-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 02:28 AM
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
-- Database: `calorie_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `calorie_results`
--

CREATE TABLE `calorie_results` (
  `id` int(11) NOT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `goal` varchar(20) DEFAULT NULL,
  `target_weight` float DEFAULT NULL,
  `calories` float DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calorie_results`
--

INSERT INTO `calorie_results` (`id`, `height`, `weight`, `age`, `gender`, `goal`, `target_weight`, `calories`, `timestamp`) VALUES
(1, 400, 300, 30, 'male', 'lose', 200, 7188.24, '2025-04-08 22:24:23'),
(2, 180, 70, 55, 'female', 'lose', 55, 1680.28, '2025-04-08 22:48:02'),
(3, 600, 600, 60, 'male', 'lose', 60, 13096, '2025-04-08 22:49:36'),
(4, 288, 288, 88, 'male', 'lose', 68, 5848.04, '2025-04-08 22:55:09'),
(5, 300, 300, 30, 'male', 'lose', 50, 6587.88, '2025-04-08 22:58:38'),
(6, 166, 55, 30, 'female', 'lose', 48, 1617.34, '2025-04-08 23:37:10'),
(7, 78, 34, 9, 'male', 'maintain', 0, 1338.4, '2025-04-09 00:21:56'),
(8, 555, 300, 45, 'male', 'lose', 220, 7997.3, '2025-04-09 00:31:39'),
(9, 999, 780, 56, 'male', 'lose', 200, 18493.8, '2025-04-10 19:53:24'),
(10, 67, 22, 3, 'male', 'maintain', 0, 1060.12, '2025-04-10 20:27:58'),
(11, 3212, 23, 23, 'male', 'maintain', 0, 25260.6, '2025-04-10 21:04:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calorie_results`
--
ALTER TABLE `calorie_results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calorie_results`
--
ALTER TABLE `calorie_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
