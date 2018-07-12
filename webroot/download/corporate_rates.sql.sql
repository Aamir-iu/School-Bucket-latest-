-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 13, 2017 at 09:13 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essalab_staging`
--

-- --------------------------------------------------------

--
-- Table structure for table `corporate_rates`
--

CREATE TABLE `corporate_rates` (
  `id_corporate_rate` int(11) NOT NULL,
  `corporate_customer_id` int(11) NOT NULL,
  `sub_type` enum('R','S','U','X') DEFAULT NULL,
  `discount_in_percent` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `corporate_rates`
--

INSERT INTO `corporate_rates` (`id_corporate_rate`, `corporate_customer_id`, `sub_type`, `discount_in_percent`) VALUES
(25, 59, 'R', '0.00'),
(26, 59, 'S', '0.00'),
(27, 59, '', '0.00'),
(28, 59, '', '0.00'),
(29, 59, '', '0.00'),
(30, 59, '', '0.00'),
(31, 59, '', '0.00'),
(32, 59, '', '0.00'),
(33, 59, '', '0.00'),
(34, 59, '', '0.00'),
(35, 59, '', '0.00'),
(36, 59, '', '0.00'),
(37, 4, NULL, '0.00'),
(38, 4, NULL, '0.00'),
(39, 4, NULL, '0.00'),
(40, 4, NULL, '0.00'),
(41, 4, NULL, '0.00'),
(42, 4, NULL, '0.00'),
(43, 4, NULL, '0.00'),
(44, 4, NULL, '0.00'),
(45, 4, NULL, '0.00'),
(46, 4, NULL, '0.00'),
(47, 4, NULL, '0.00'),
(48, 4, NULL, '0.00'),
(49, 4, NULL, '0.00'),
(50, 4, NULL, '0.00'),
(51, 4, NULL, '0.00'),
(52, 4, NULL, '0.00'),
(53, 4, NULL, '0.00'),
(54, 4, NULL, '0.00'),
(55, 4, NULL, '0.00'),
(56, 4, NULL, '0.00'),
(57, 4, NULL, '0.00'),
(58, 4, NULL, '0.00'),
(59, 4, NULL, '0.00'),
(60, 4, NULL, '0.00'),
(61, 4, NULL, '0.00'),
(62, 4, NULL, '0.00'),
(63, 4, NULL, '0.00'),
(64, 71, 'R', '1.00'),
(65, 71, 'S', '2.00'),
(66, 71, 'U', '3.00'),
(67, 71, 'X', '4.00'),
(68, 5, 'R', '0.00'),
(69, 5, 'S', '0.00'),
(70, 5, 'U', '0.00'),
(71, 5, 'X', '0.00'),
(76, 72, 'R', '20.00'),
(77, 72, 'S', '20.00'),
(78, 72, 'U', '20.00'),
(79, 72, 'X', '20.00'),
(124, 76, 'R', '0.00'),
(125, 76, 'S', '0.00'),
(126, 76, 'U', '0.00'),
(127, 76, 'X', '0.00'),
(140, 20, 'R', '0.00'),
(141, 20, 'S', '0.00'),
(142, 20, 'U', '0.00'),
(143, 20, 'X', '0.00'),
(148, 77, 'R', '0.00'),
(149, 77, 'S', '0.00'),
(150, 77, 'U', '0.00'),
(151, 77, 'X', '0.00'),
(152, 78, 'R', '0.00'),
(153, 78, 'S', '0.00'),
(154, 78, 'U', '0.00'),
(155, 78, 'X', '0.00'),
(160, 54, 'R', '0.00'),
(161, 54, 'S', '0.00'),
(162, 54, 'U', '0.00'),
(163, 54, 'X', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corporate_rates`
--
ALTER TABLE `corporate_rates`
  ADD PRIMARY KEY (`id_corporate_rate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corporate_rates`
--
ALTER TABLE `corporate_rates`
  MODIFY `id_corporate_rate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
