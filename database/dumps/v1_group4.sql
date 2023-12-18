-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2023 at 10:18 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group4`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User authentication table';

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `email`, `password`) VALUES
(1, 'test@test.com', '$2y$10$ClKW1H.oUOB3qc3rlf8QPu2uidzq4jrdBSxUMftWioT48pnmnNrCy'),
(2, 'lutfu.selbasan@bilgiedu.net', '$2y$10$UPtQUhGuO8yGCj/QWDIDke9fSLImULQdHbEeOzRubobi3nXYGPGfC');

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `volume` int(11) NOT NULL,
  `volume_unit` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `initial_status` varchar(100) NOT NULL,
  `value` int(11) NOT NULL,
  `value_unit` varchar(100) NOT NULL,
  `autonotifier` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `lifetime` int(11) NOT NULL,
  `lifetime_unit` varchar(100) NOT NULL,
  `temporary_storage` varchar(100) NOT NULL,
  `modification_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Storage entity table for trucks and bins';

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`id`, `category`, `volume`, `volume_unit`, `type`, `initial_status`, `value`, `value_unit`, `autonotifier`, `quantity`, `lifetime`, `lifetime_unit`, `temporary_storage`, `modification_date`) VALUES
(9, 'bin', 10, 'liter', 'smart', 'active', 100, 'dollar', 'on', 1, 5, 'year', 'false', '2023-11-25'),
(11, 'bin', 10, 'liter', 'smart', 'maintenance', 100, 'dollar', 'on', 1, 5, 'year', 'false', '2023-11-26'),
(12, 'bin', 50, 'cubicmeter', 'smart', 'active', 100, 'dollar', 'on', 1, 5, 'year', 'false', '2023-11-26'),
(14, 'truck', 10, 'liter', 'smart', 'active', 100, 'dollar', 'on', 1, 5, 'year', 'true', '2023-11-26'),
(17, 'bin', 3000, 'kilogram', 'regular', 'active', 10000, 'dollar', 'on', 2, 5, 'year', 'false', '2023-11-26'),
(18, 'truck', 100, 'cubicmeter', 'smart', 'passive', 10000, 'euro', 'on', 1, 5, 'year', 'true', '2023-11-26'),
(19, 'bin', 5, 'kilogram', 'smart', 'maintenance', 5000, 'euro', 'on', 3, 5, 'year', 'false', '2023-11-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
