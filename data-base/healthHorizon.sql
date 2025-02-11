-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2025 at 08:06 AM
-- Server version: 8.0.41-0ubuntu0.24.10.1
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthHorizon`
--

-- --------------------------------------------------------

--
-- Table structure for table `App`
--

CREATE TABLE `App` (
  `AppID` int NOT NULL,
  `AppVersion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `App`
--

INSERT INTO `App` (`AppID`, `AppVersion`) VALUES
(1, '1.0'),
(2, '1.1'),
(3, '1.2');

-- --------------------------------------------------------

--
-- Table structure for table `ConnectsTo`
--

CREATE TABLE `ConnectsTo` (
  `ConnectID` int NOT NULL,
  `UserID` int UNSIGNED NOT NULL,
  `AppID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ConnectsTo`
--

INSERT INTO `ConnectsTo` (`ConnectID`, `UserID`, `AppID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `UserData`
--

CREATE TABLE `UserData` (
  `DataID` int NOT NULL,
  `UserID` int UNSIGNED NOT NULL,
  `GenderValue` varchar(10) NOT NULL,
  `HeightValue` decimal(5,2) NOT NULL,
  `WeightValue` decimal(5,2) NOT NULL,
  `AgeValue` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `UserData`
--

INSERT INTO `UserData` (`DataID`, `UserID`, `GenderValue`, `HeightValue`, `WeightValue`, `AgeValue`) VALUES
(1, 1, 'Male', 175.50, 70.20, 25),
(2, 2, 'Female', 160.00, 58.00, 30),
(3, 3, 'Male', 180.50, 85.40, 40);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int UNSIGNED NOT NULL,
  `Height` decimal(5,2) NOT NULL,
  `Age` int NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Weight` decimal(5,2) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPasswordHash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Height`, `Age`, `Gender`, `Weight`, `UserName`, `UserPasswordHash`) VALUES
(1, 175.50, 25, 'Male', 70.20, 'testuser', 'hashedpassword123'),
(2, 160.00, 30, 'Female', 58.00, 'janedoe', 'hashedpassword456'),
(3, 180.50, 40, 'Male', 85.40, 'bobjones', 'hashedpassword789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `App`
--
ALTER TABLE `App`
  ADD PRIMARY KEY (`AppID`);

--
-- Indexes for table `ConnectsTo`
--
ALTER TABLE `ConnectsTo`
  ADD PRIMARY KEY (`ConnectID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `AppID` (`AppID`);

--
-- Indexes for table `UserData`
--
ALTER TABLE `UserData`
  ADD PRIMARY KEY (`DataID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `App`
--
ALTER TABLE `App`
  MODIFY `AppID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ConnectsTo`
--
ALTER TABLE `ConnectsTo`
  MODIFY `ConnectID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `UserData`
--
ALTER TABLE `UserData`
  MODIFY `DataID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ConnectsTo`
--
ALTER TABLE `ConnectsTo`
  ADD CONSTRAINT `ConnectsTo_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ConnectsTo_ibfk_2` FOREIGN KEY (`AppID`) REFERENCES `App` (`AppID`) ON DELETE CASCADE;

--
-- Constraints for table `UserData`
--
ALTER TABLE `UserData`
  ADD CONSTRAINT `UserData_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
