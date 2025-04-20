-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2025 at 11:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `AppID` int(11) NOT NULL,
  `AppVersion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `App`
--

INSERT INTO `App` (`AppID`, `AppVersion`) VALUES
(1, '1.0'),
(2, '1.1'),
(3, '1.2');

-- --------------------------------------------------------

--
-- Stand-in structure for view `AvgStepsPerUser`
-- (See below for the actual view)
--
CREATE TABLE `AvgStepsPerUser` (
`UserID` int(10) unsigned
,`AvgSteps` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Table structure for table `ConnectsTo`
--

CREATE TABLE `ConnectsTo` (
  `ConnectID` int(11) NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `AppID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ContactForm`
--

CREATE TABLE `ContactForm` (
  `Token` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `UserData`
--

CREATE TABLE `UserData` (
  `DataID` int(11) NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `GenderValue` varchar(10) NOT NULL,
  `HeightValue` decimal(5,2) DEFAULT NULL,
  `WeightValue` decimal(5,2) DEFAULT NULL,
  `AgeValue` int(11) DEFAULT NULL,
  `AvgSteps` decimal(10,2) DEFAULT 0.00,
  `Steps` int(11) DEFAULT 0,
  `TargetWeight` decimal(5,2) DEFAULT NULL,
  `Goal` enum('lose','gain') NOT NULL DEFAULT 'lose'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `UserData`
--

INSERT INTO `UserData` (`DataID`, `UserID`, `GenderValue`, `HeightValue`, `WeightValue`, `AgeValue`, `AvgSteps`, `Steps`, `TargetWeight`, `Goal`) VALUES
(4, 5, 'Female', 54.00, 155.00, 30, 0.00, 0, 150.00, 'lose');

-- --------------------------------------------------------

--
-- Table structure for table `UserLogs`
--

CREATE TABLE `UserLogs` (
  `LogID` int(11) NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `Action` varchar(255) NOT NULL,
  `Timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `Height` decimal(5,2) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL DEFAULT 'Unknown',
  `Weight` decimal(5,2) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPasswordHash` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Height`, `Age`, `Gender`, `Weight`, `UserName`, `UserPasswordHash`, `Email`, `CreatedAt`, `UpdatedAt`) VALUES
(4, 0.00, 0, 'Unknown', 0.00, 'ad', '$2y$10$6UJghSrstfqv1ZhO5P67Eugsd1OnRz/Y6iWTmzoMzNEbAWdflWxyy', 'ad@gmail.com', '2025-03-28 23:07:51', '2025-03-28 23:07:51'),
(5, 0.00, 0, 'Unknown', 0.00, 'ad2', '$2y$10$H9L3vhwmXTbSUoc7HpwHduH8aX.VTd9pGWgymWn9IR1BpsfIcyHiG', 'ad2@gmail.com', '2025-03-29 00:12:17', '2025-03-29 00:12:17'),
(6, 0.00, 0, 'Unknown', 0.00, 'sd', '$2y$10$Ew/YqoGcy1pVJATovMcpMuDtKtdT5ZZvplDExgstqVS8N3/bad3wK', 'ad3@gmail.com', '2025-04-06 05:45:55', '2025-04-06 05:45:55');

-- --------------------------------------------------------

--
-- Structure for view `AvgStepsPerUser`
--
DROP TABLE IF EXISTS `AvgStepsPerUser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `AvgStepsPerUser`  AS SELECT `UserData`.`UserID` AS `UserID`, avg(`UserData`.`Steps`) AS `AvgSteps` FROM `UserData` GROUP BY `UserData`.`UserID` ;

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
-- Indexes for table `ContactForm`
--
ALTER TABLE `ContactForm`
  ADD PRIMARY KEY (`Token`);

--
-- Indexes for table `UserData`
--
ALTER TABLE `UserData`
  ADD PRIMARY KEY (`DataID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `UserLogs`
--
ALTER TABLE `UserLogs`
  ADD PRIMARY KEY (`LogID`),
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
  MODIFY `AppID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ConnectsTo`
--
ALTER TABLE `ConnectsTo`
  MODIFY `ConnectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `UserData`
--
ALTER TABLE `UserData`
  MODIFY `DataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `UserLogs`
--
ALTER TABLE `UserLogs`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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

--
-- Constraints for table `UserLogs`
--
ALTER TABLE `UserLogs`
  ADD CONSTRAINT `UserLogs_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
