-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 06:49 PM
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
-- Database: `otp-cloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `c-group`
--

CREATE TABLE `c-group` (
  `g_id` varchar(10) NOT NULL,
  `g_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c-group`
--

INSERT INTO `c-group` (`g_id`, `g_name`, `email`, `img`) VALUES
('76gg3198', 'ASDNNNN', 'kavidubim1gamaethige@gmail.com', ''),
('93gg2318', 'ASD', 'kavidubim1gamaethige@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `g_id` varchar(10) NOT NULL,
  `otp_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`otp`, `email`, `time`, `g_id`, `otp_status`) VALUES
('16tp8644', 'kavidubim2gamaethige@gmail.com', '2024-01-23 17:50:55', 'user', 'verified'),
('37tp2321', 'kavidubim1gamaethige@gmail.com', '2024-05-24 16:08:53', 'user', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `pw` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `acc_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `pw`, `name`, `acc_type`) VALUES
('kavidubim1gamaethige@gmail.com', '1234', 'Kavindu Bimsara', 'gold'),
('kavidubim2gamaethige@gmail.com', '12345', 'Kavindu', 'nn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c-group`
--
ALTER TABLE `c-group`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
