-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 28, 2023 at 01:39 PM
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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `inhabitans_cnt` int(11) NOT NULL,
  `employees_cnt` int(11) NOT NULL,
  `coordinates` text NOT NULL,
  `object_cnt` int(11) NOT NULL,
  `region` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `inhabitans_cnt`, `employees_cnt`, `coordinates`, `object_cnt`, `region`) VALUES
(2, 'asddf_updated', 19, 646464, 'akjsfhj', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(20) NOT NULL,
  `salary` int(20) NOT NULL,
  `modification_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `email`, `phone`, `salary`, `modification_date`) VALUES
(10, 'Jane', 'Smith', 'jane.smith@email.com', 5555678, 60000, '2023-12-11'),
(11, 'Robert', 'Johnson', 'robert.johnson@email.com', 5559012, 70000, '2023-12-16'),
(12, 'Emily', 'Williams', 'emily.williams@email.com', 5553456, 55000, NULL),
(15, 'Daniel', 'Miller', 'daniel.miller@email.com', 5556789, 70000, NULL),
(16, 'Megan', 'Jones', 'megan.jones@email.com', 5550123, 55000, NULL),
(18, 'Ashley', 'Moore', 'ashley.moore@email.com', 5558901, 70000, '2023-12-08'),
(19, 'David', 'Taylor', 'david.taylor@email.com', 5552345, 60000, NULL),
(22, 'Emma', 'Lewis', 'emma.lewis@email.com', 5554567, 65000, NULL),
(23, 'William', 'Scott', 'william.scott@email.com', 5558901, 70000, '2023-12-16'),
(24, 'Ava', 'Hill', 'ava.hill@email.com', 5552345, 60000, '2023-12-16'),
(25, 'Matthew', 'Turner', 'matthew.turner@email.com', 5556789, 70000, NULL),
(28, 'Isabella', 'Ward', 'isabella.ward@email.com', 5558901, 70000, NULL),
(29, 'James', 'Fisher', 'james.fisher@email.com', 5552345, 60000, '2023-12-14'),
(33, 'Benjamin', 'Reed', 'benjamin.reed@email.com', 5558901, 70000, NULL),
(35, 'Jackson', 'Russell', 'jackson.russell@email.com', 5556789, 70000, NULL),
(36, 'Ella', 'Stone', 'ella.stone@email.com', 5550123, 55000, '2023-12-16'),
(37, 'Logan', 'Harrison', 'logan.harrison@email.com', 5554567, 65000, '2023-12-16'),
(38, 'Mia', 'Ferguson', 'mia.ferguson@email.com', 98765432, 70000, '2023-12-16'),
(39, 'Caleb', 'Mason', 'caleb.mason@email.com', 5552345, 60000, NULL),
(40, 'Addison', 'Hudson', 'addison.hudson@email.com', 5556789, 70001, '2023-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `lat` int(11) NOT NULL,
  `lon` int(11) NOT NULL,
  `collection_interval` varchar(100) NOT NULL,
  `threshold` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `modification_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `lat`, `lon`, `collection_interval`, `threshold`, `budget`, `modification_date`) VALUES
(2, 'testt', 13, 12, 'weekly', 12, 12, '2023-12-19'),
(4, 'qwe', 123, 123, 'biweekly', 12, 1424124, '2023-12-19');

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
(14, 'truck', 10, 'liter', 'smart', 'active', 100, 'dollar', 'on', 1, 5, 'year', 'true', '2023-12-07'),
(17, 'bin', 3000, 'kilogram', 'regular', 'active', 10000, 'dollar', 'on', 2, 5, 'year', 'false', '2023-11-26'),
(18, 'truck', 100, 'cubicmeter', 'smart', 'passive', 10000, 'euro', 'on', 1, 5, 'year', 'true', '2023-11-26'),
(19, 'bin', 5, 'kilogram', 'smart', 'maintenance', 5000, 'euro', 'on', 3, 5, 'year', 'false', '2023-11-26'),
(21, 'truck', 8, 'cubicmeter', 'regular', 'maintenance', 1, 'dollar', '', 2, 2, 'year', 'true', '2023-12-18'),
(25, 'bin', 10, 'liter', 'smart', 'active', 100, 'dollar', 'on', 1, 5, 'year', 'false', '2023-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `interaction_time` datetime NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `employee_id`, `storage_id`, `interaction_time`, `region_id`) VALUES
(1, 10, 14, '2023-12-07 00:00:00', 2);

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
