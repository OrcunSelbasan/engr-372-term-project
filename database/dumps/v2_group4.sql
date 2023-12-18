-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Dez 2023 um 09:15
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `group4`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auth`
--

CREATE TABLE `auth` (
  `id` int(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='User authentication table';

--
-- Daten für Tabelle `auth`
--

INSERT INTO `auth` (`id`, `email`, `password`) VALUES
(1, 'test@test.com', '$2y$10$ClKW1H.oUOB3qc3rlf8QPu2uidzq4jrdBSxUMftWioT48pnmnNrCy'),
(2, 'lutfu.selbasan@bilgiedu.net', '$2y$10$UPtQUhGuO8yGCj/QWDIDke9fSLImULQdHbEeOzRubobi3nXYGPGfC');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `employees`
--

CREATE TABLE `employees` (
  `id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(20) NOT NULL,
  `salary` int(20) NOT NULL,
  `modification_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `email`, `phone`, `salary`, `modification_date`) VALUES
(10, 'Jane', 'Smith', 'jane.smith@email.com', 5555678, 60000, '2023-12-11'),
(11, 'Robert', 'Johnson', 'robert.johnson@email.com', 5559012, 70000, '2023-12-16'),
(12, 'Emily', 'Williams', 'emily.williams@email.com', 5553456, 55000, NULL),
(15, 'Daniel', 'Miller', 'daniel.miller@email.com', 5556789, 70000, NULL),
(16, 'Megan', 'Jones', 'megan.jones@email.com', 5550123, 55000, NULL),
(17, 'Christopher', 'Wilson', 'christopher.wilson@email.com', 5554567, 65000, '2023-12-16'),
(18, 'Ashley', 'Moore', 'ashley.moore@email.com', 5558901, 70000, '2023-12-08'),
(19, 'David', 'Taylor', 'david.taylor@email.com', 5552345, 60000, NULL),
(21, 'Ryan', 'Hall', 'ryan.hall@email.com', 5550123, 55000, '2023-12-14'),
(22, 'Emma', 'Lewis', 'emma.lewis@email.com', 5554567, 65000, NULL),
(23, 'William', 'Scott', 'william.scott@email.com', 5558901, 70000, '2023-12-16'),
(24, 'Ava', 'Hill', 'ava.hill@email.com', 5552345, 60000, '2023-12-16'),
(25, 'Matthew', 'Turner', 'matthew.turner@email.com', 5556789, 70000, NULL),
(28, 'Isabella', 'Ward', 'isabella.ward@email.com', 5558901, 70000, NULL),
(29, 'James', 'Fisher', 'james.fisher@email.com', 5552345, 60000, '2023-12-14'),
(31, 'Liam', 'Young', 'liam.young@email.com', 5550123, 55000, '2023-12-14'),
(33, 'Benjamin', 'Reed', 'benjamin.reed@email.com', 5558901, 70000, NULL),
(35, 'Jackson', 'Russell', 'jackson.russell@email.com', 5556789, 70000, NULL),
(36, 'Ella', 'Stone', 'ella.stone@email.com', 5550123, 55000, '2023-12-16'),
(37, 'Logan', 'Harrison', 'logan.harrison@email.com', 5554567, 65000, '2023-12-16'),
(38, 'Mia', 'Ferguson', 'mia.ferguson@email.com', 98765432, 70000, '2023-12-16'),
(39, 'Caleb', 'Mason', 'caleb.mason@email.com', 5552345, 60000, NULL),
(40, 'Addison', 'Hudson', 'addison.hudson@email.com', 5556789, 70001, '2023-12-08'),
(41, 'Jack', 'Wolfe', 'jack.wolfe@email.com', 9928374, 60000, '2023-12-08');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `storage`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Storage entity table for trucks and bins';

--
-- Daten für Tabelle `storage`
--

INSERT INTO `storage` (`id`, `category`, `volume`, `volume_unit`, `type`, `initial_status`, `value`, `value_unit`, `autonotifier`, `quantity`, `lifetime`, `lifetime_unit`, `temporary_storage`, `modification_date`) VALUES
(14, 'truck', 10, 'liter', 'smart', 'active', 100, 'dollar', 'on', 1, 5, 'year', 'true', '2023-12-07'),
(17, 'bin', 3000, 'kilogram', 'regular', 'active', 10000, 'dollar', 'on', 2, 5, 'year', 'false', '2023-11-26'),
(18, 'truck', 100, 'cubicmeter', 'smart', 'passive', 10000, 'euro', 'on', 1, 5, 'year', 'true', '2023-11-26'),
(19, 'bin', 5, 'kilogram', 'smart', 'maintenance', 5000, 'euro', 'on', 3, 5, 'year', 'false', '2023-11-26'),
(21, 'truck', 2, 'cubicmeter', 'regular', 'maintenance', 1, 'dollar', '', 2, 2, 'year', 'true', '2023-12-07'),
(24, 'bin', 1, 'liter', 'smart', 'active', 333, 'dollar', '', 1, 1, 'year', 'false', '2023-12-12');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT für Tabelle `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
