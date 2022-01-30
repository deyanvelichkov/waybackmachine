-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2022 at 01:11 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waybackmachine`
--

-- --------------------------------------------------------

--
-- Table structure for table `websitedata`
--

CREATE TABLE `websitedata` (
  `ID` int(11) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `WebsiteTitle` varchar(64) NOT NULL,
  `ArchiveAddress` varchar(256) NOT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateTime` int(11) DEFAULT NULL,
  `AccountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `websitedata`
--

INSERT INTO `websitedata` (`ID`, `Address`, `WebsiteTitle`, `ArchiveAddress`, `LastUpdated`, `UpdateTime`, `AccountID`) VALUES
(1, 'www.google.com', 'Google', '', '2022-01-29 10:58:28', NULL, NULL),
(2, 'https://susi.uni-sofia.bg/ISSU/forms/Login.aspx', 'SUSI', '', '2022-01-29 11:22:30', NULL, NULL),
(4, '81806isacoolFN.com', '81806', '', '2022-01-29 14:27:38', NULL, NULL),
(5, '81806isacoolFN.com', '81806', '', '2022-01-29 14:47:03', NULL, NULL),
(6, '81806isacoolFN.com', '81806', '', '2022-01-30 11:40:24', NULL, NULL),
(7, 'random.com', 'Random', '', '2022-01-30 11:53:24', NULL, NULL),
(8, 'ihaveroot.bg', 'Root', '', '2022-01-30 12:09:47', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `websitedata`
--
ALTER TABLE `websitedata`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `websitedata`
--
ALTER TABLE `websitedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
