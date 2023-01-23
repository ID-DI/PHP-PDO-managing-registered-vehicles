-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 01:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `challenge_17`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `pass`) VALUES
(1, 'Ivan_D', '$2y$10$DJNEPVrQpJGO36w3NuzIdO5vsSGxehnb00C7F2/WjZrUSMCo6cQGy'),
(2, 'admin', '$2y$10$.7ysx50JmoU/VOTUy3i6.eIJdUM5JQpHK7lXIAr9OAsMqlUF7m4q.');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_model_id` int(10) UNSIGNED DEFAULT NULL,
  `vehicle_type` varchar(64) DEFAULT NULL,
  `vehicle_chassis_number` varchar(32) DEFAULT NULL,
  `vehicle_production_year` date DEFAULT NULL,
  `registration_number` varchar(32) DEFAULT NULL,
  `fuel_type` varchar(32) DEFAULT NULL,
  `registration_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `vehicle_model_id`, `vehicle_type`, `vehicle_chassis_number`, `vehicle_production_year`, `registration_number`, `fuel_type`, `registration_to`) VALUES
(4, 19, 'minivan', 'YA123RIS456', '2021-02-01', 'OH-7878-NN', 'electric', '2025-05-05'),
(63, 1, 'sedan', 'GT12FH87QR1', '2011-07-16', 'SR-7127-AC', 'gasoline', '2023-07-16'),
(64, 1, 'sedan', 'FT123KML256', '2012-02-02', 'PP-3691-MM', 'diesel', '2022-05-15'),
(65, 28, 'suv', 'BM12QW789', '2019-02-02', 'SR-5008-GR', 'gasoline', '2022-06-28'),
(66, 25, 'sedan', 'FT123KM', '2020-02-02', 'SR-5008-GR', 'diesel', '2005-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_model` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `vehicle_model`) VALUES
(1, 'AUDI A4'),
(2, 'BMW X5'),
(3, 'FORD TRANSIT'),
(4, 'TOYOTA YARIS'),
(18, 'VOLKSWAGEN GOLF'),
(19, 'VOLKSWAGEN PASSAT'),
(20, 'FIAT PUNTO'),
(25, 'FIAT LINEA'),
(27, 'MINI CUPPER'),
(28, 'BMW X7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_model_id` (`vehicle_model_id`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_models` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
