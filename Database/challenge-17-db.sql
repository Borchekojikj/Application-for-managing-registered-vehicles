-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 11:57 PM
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
-- Database: `challenge-17-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE `fuel_types` (
  `id` int(11) NOT NULL,
  `fuel_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `fuel_type`) VALUES
(1, 'gasoline'),
(2, 'diesel'),
(3, 'electric');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `model` int(11) DEFAULT 0,
  `type` int(11) NOT NULL,
  `chassis_number` text NOT NULL,
  `production_year` date NOT NULL,
  `registration_number` text NOT NULL,
  `fuel_type` int(11) NOT NULL,
  `registration_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `model`, `type`, `chassis_number`, `production_year`, `registration_number`, `fuel_type`, `registration_to`) VALUES
(13, 24, 2, '325r1rars1', '2024-01-03', 'AA-5355-AU', 2, '2025-04-23'),
(14, 24, 2, '22131rars1', '2024-01-09', 'BA-1255-AU', 3, '2025-01-14'),
(15, 10, 3, '211311', '2024-01-11', 'CC-1355-AU', 2, '2024-01-24'),
(16, 10, 1, 'AA-5355-AU', '2024-01-09', '21321', 1, '2024-03-20'),
(17, 12, 2, '213', '2024-01-11', '123123213123123', 2, '2024-04-26'),
(20, 10, 1, '12322222', '2023-11-29', '2222', 1, '2024-03-02'),
(21, 10, 1, '2223', '2024-01-10', '223', 1, '2024-01-23'),
(22, 12, 3, '444', '2024-01-16', '5151', 1, '2025-01-15'),
(25, 24, 3, '12312', '2024-01-08', '12312', 3, '2024-01-11'),
(28, 12, 3, '2', '2024-01-12', '2', 2, '2024-01-13'),
(36, 10, 2, '123', '2024-01-08', '123', 2, '2024-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'borchekojikj', 'test123'),
(2, 'borchekojikj1', 'test123');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` int(11) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `vehicle_model`) VALUES
(10, 'BMW x5'),
(12, 'Mustang'),
(24, 'Audi'),
(27, 'BMW x6'),
(28, 'Audi Q7'),
(39, 'BMW M5');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `vehicle_type`) VALUES
(1, 'sedan'),
(2, 'coupe'),
(3, 'hatchback'),
(4, 'suv'),
(5, 'minivan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vehicle_types` (`type`),
  ADD KEY `fk_fuel_types` (`fuel_type`),
  ADD KEY `FK_PersonOrder` (`model`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `FK_PersonOrder` FOREIGN KEY (`model`) REFERENCES `vehicle_models` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `fk_fuel_types` FOREIGN KEY (`fuel_type`) REFERENCES `fuel_types` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `fk_vehicle_types` FOREIGN KEY (`type`) REFERENCES `vehicle_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
