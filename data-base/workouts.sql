-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 02:27 AM
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
-- Database: `workout_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `id` int(11) NOT NULL,
  `exercise` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `calories_burned` int(11) NOT NULL,
  `workout_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`id`, `exercise`, `duration`, `calories_burned`, `workout_date`) VALUES
(2, 'soccer', 45, 500, '0000-00-00'),
(3, 'threadmil', 20, 300, '0000-00-00'),
(4, 'swimming', 39, 399, '0000-00-00'),
(5, 'skiing', 100, 300, '0000-00-00'),
(6, 'cycling', 40, 300, '0000-00-00'),
(7, 'swimming', 40, 500, '0000-00-00'),
(9, 'cycling', 40, 398, '0000-00-00'),
(10, 'soccer', 10, 20, '0000-00-00'),
(11, 'dancing', 200, 300, '0000-00-00'),
(12, 'swimming', 30, 100, '0000-00-00'),
(15, 'swimming', 9, 99, '0000-00-00'),
(17, 'swimming', 99, 23, '0000-00-00'),
(21, 'cycling', 7, 7, '0000-00-00'),
(24, 'cycling', 32, 23, '0000-00-00'),
(26, 'walking', 99, 0, '0000-00-00'),
(27, 'cycling', 89, 88, '0000-00-00'),
(28, 'threadmil', 77, 90, '0000-00-00'),
(33, 'walking', 68, 9, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
