-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Dec 06, 2025 at 02:35 AM
-- Server version: 8.4.6
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docker`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` int NOT NULL,
  `rooms` int NOT NULL,
  `floor` int NOT NULL,
  `price` varchar(255) NOT NULL,
  `layout_id` int NOT NULL,
  `buildings_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `planning_date` date NOT NULL,
  `floors` int NOT NULL,
  `complex_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complex`
--

CREATE TABLE `complex` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` int NOT NULL,
  `image` text NOT NULL,
  `complex_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buildings_id` (`buildings_id`),
  ADD KEY `layout_id` (`layout_id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complex_id` (`complex_id`);

--
-- Indexes for table `complex`
--
ALTER TABLE `complex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complex_id` (`complex_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complex`
--
ALTER TABLE `complex`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layouts`
--
ALTER TABLE `layouts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`buildings_id`) REFERENCES `buildings` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`complex_id`) REFERENCES `complex` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `layouts`
--
ALTER TABLE `layouts`
  ADD CONSTRAINT `layouts_ibfk_1` FOREIGN KEY (`complex_id`) REFERENCES `complex` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
