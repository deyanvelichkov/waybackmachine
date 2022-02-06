-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 06:51 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(64) NOT NULL,
  `PasswordHash` varchar(256) NOT NULL,
  `Role` varchar(32) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `PasswordHash`, `Role`) VALUES
('admin', '$2y$10$A9xaC/W0S7Zsa3W2CEyPOePbOcgOAe4wYa3jBkhoYkKZ4vW3/GoBS', 'admin'),
('name', '$2y$10$IBfXKhejNuQcOJ.2C8iVyeHk3o6AWo.S0v6wRW/zwbFq4Ma2I6Uaq', 'user'),
('username', '$2y$10$EwxAG87WFF3ameA8WflD6efZ1rJe68FBTq4yo1QdMZ8tounRs77se', 'user');

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
  `Username` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `websitedata`
--

INSERT INTO `websitedata` (`ID`, `Address`, `WebsiteTitle`, `ArchiveAddress`, `LastUpdated`, `UpdateTime`, `Username`) VALUES
(1, 'www.google.com', 'Google', '', '2022-01-29 10:58:28', NULL, 'name'),
(2, 'https://susi.uni-sofia.bg/ISSU/forms/Login.aspx', 'SUSI', '', '2022-01-29 11:22:30', NULL, 'username'),
(4, '81806isacoolFN.com', '81806', '', '2022-01-29 14:27:38', NULL, 'admin'),
(5, '81806isacoolFN.com', '81806', '', '2022-01-29 14:47:03', NULL, ''),
(6, '81806isacoolFN.com', '81806', '', '2022-01-30 11:40:24', NULL, ''),
(7, 'random.com', 'Random', '', '2022-01-30 11:53:24', NULL, ''),
(8, 'ihaveroot.bg', 'Root', '', '2022-01-30 12:09:47', NULL, ''),
(9, 'test.net', 'Test', '', '2022-01-31 13:27:32', NULL, ''),
(10, 'testing.net', 'Testing', '', '2022-01-31 14:22:33', NULL, ''),
(11, 'authentication.bg', 'Authentication', '', '2022-01-31 18:42:32', NULL, ''),
(12, '', '', './saved/.html', '2022-02-01 08:35:30', NULL, ''),
(13, '', '', './saved/.html', '2022-02-01 08:35:53', NULL, ''),
(14, 'google.com', 'Google', './saved/Google.html', '2022-02-01 08:36:09', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
