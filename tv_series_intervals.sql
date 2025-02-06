-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 10:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tv_series_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tv_series_intervals`
--

CREATE TABLE `tv_series_intervals` (
  `id` int(11) NOT NULL,
  `id_tv_series` int(11) NOT NULL,
  `week_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `show_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tv_series_intervals`
--

INSERT INTO `tv_series_intervals` (`id`, `id_tv_series`, `week_day`, `show_time`) VALUES
(6, 1, 'Wednesday', '2025-02-12 20:00:00'),
(7, 1, 'Friday', '2025-02-14 20:00:00'),
(8, 1, 'Sunday', '2025-02-16 20:00:00'),
(9, 2, 'Thursday', '2025-02-13 21:00:00'),
(10, 2, 'Saturday', '2025-02-15 21:00:00'),
(11, 3, 'Tuesday', '2025-02-18 22:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tv_series_intervals`
--
ALTER TABLE `tv_series_intervals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tv_series` (`id_tv_series`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tv_series_intervals`
--
ALTER TABLE `tv_series_intervals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tv_series_intervals`
--
ALTER TABLE `tv_series_intervals`
  ADD CONSTRAINT `tv_series_intervals_ibfk_1` FOREIGN KEY (`id_tv_series`) REFERENCES `tv_series` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
