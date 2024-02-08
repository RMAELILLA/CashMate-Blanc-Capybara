-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 03:27 PM
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
-- Database: `login_cashmate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashchart`
--

CREATE TABLE `dashchart` (
  `id` int(5) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `Transportation` varchar(50) DEFAULT NULL,
  `Clothing` varchar(50) DEFAULT NULL,
  `Shopping` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `House` varchar(50) DEFAULT NULL,
  `HealthCare` varchar(50) DEFAULT NULL,
  `Entertainment` varchar(50) DEFAULT NULL,
  `Food` varchar(50) DEFAULT NULL,
  `Pet` varchar(50) DEFAULT NULL,
  `amount` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `start_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `expense_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashchart`
--

INSERT INTO `dashchart` (`id`, `user_name`, `Transportation`, `Clothing`, `Shopping`, `House`, `HealthCare`, `Entertainment`, `Food`, `Pet`, `amount`, `start_date`, `expense_type`) VALUES
(0, 'Foolish_heart', '', '', '', '', '', '', '', '590', '', '2024-02-07', ''),
(0, 'Foolish_heart', '', '', '', '', '', '', '15000', '', '', '2024-02-07', ''),
(0, 'Foolish_heart', '', '', '', '', '', '', '500', '', '', '2024-02-07', ''),
(0, 'Foolish_heart', '', '', '', '', '', '', '500', '', '', '2024-02-07', ''),
(0, 'Foolish_heart', '300', '', '', '', '', '', '', '', '', '2024-02-07', ''),
(NULL, 'Foolish_heart', NULL, '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-08', NULL),
(NULL, 'Foolish_heart', NULL, NULL, NULL, '10000', NULL, NULL, NULL, NULL, NULL, '2024-02-08', NULL),
(NULL, 'Foolish_heart', NULL, NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, '2024-02-08', NULL),
(NULL, 'Foolish_heart', NULL, NULL, NULL, NULL, NULL, '1500', NULL, NULL, NULL, '2024-02-08', NULL),
(NULL, 'Foolish_heart', NULL, NULL, '3290', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-08', NULL),
(NULL, 'braniks', NULL, NULL, NULL, NULL, NULL, NULL, '20000', NULL, NULL, '2024-02-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `user_name` varchar(250) NOT NULL,
  `plan_name` varchar(250) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`user_name`, `plan_name`, `amount`, `date`) VALUES
('braniks', 'Vehicle', 56000, '2024-01-31'),
('braniks', 'Vehicle', 834, '2024-01-31'),
('braniks', 'Vehicle', 834, '2024-01-31'),
('braniks', 'Vehicle', 834, '2024-02-01'),
('braniks', 'Vehicle', 41667, '2024-02-01'),
('braniks', 'Vehicle', 834, '2024-02-01'),
('braniks', 'Vehicle', 2000, '2024-02-01'),
('Foolish_heart', 'House & Lot', 36586, '2024-02-07'),
('Foolish_heart', 'Car', 20000, '2024-02-07'),
('Foolish_heart', 'House & Lot', 5000, '2024-02-07'),
('Foolish_heart', 'Laptop', 5000, '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `user_name` varchar(250) NOT NULL,
  `source` varchar(250) NOT NULL,
  `categ` varchar(250) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`user_name`, `source`, `categ`, `amount`, `date`) VALUES
('munchiesco', 'Beauty Havens', 'Business', 30000, '2024-01-30'),
('braniks', 'Accenture', 'Employment', 50000, '2024-01-30'),
('braniks', 'Beauty Havens', 'Business', 1000000, '2024-01-30'),
('braniks', 'Accenture', 'Employment', 50000, '2024-01-15'),
('Foolish_heart', 'Beauty Haven', 'Beauty', 10000, '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `planner`
--

CREATE TABLE `planner` (
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `plan_name` varchar(250) NOT NULL,
  `goal` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `suggested` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planner`
--

INSERT INTO `planner` (`user_name`, `plan_name`, `goal`, `start_date`, `end_date`, `suggested`) VALUES
('braniks', 'Vehicle', 2000000, '0000-00-00', '2026-01-01', 56000),
('braniks', 'Vehicle', 2000000, '0000-00-00', '2027-01-01', 55556),
('Foolish_heart', 'House & Lot', 3000000, '2024-02-07', '2030-12-25', 36586),
('Foolish_heart', 'Car', 1500000, '2024-03-01', '2027-03-01', 41667),
('Foolish_heart', 'Laptop', 40000, '2024-01-08', '2024-07-01', 6667);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(100) NOT NULL,
  `cpass` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  `code_timestamp` datetime DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_profile` varchar(254) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `f_name`, `l_name`, `user_name`, `email`, `password`, `cpass`, `code`, `code_timestamp`, `date`, `user_profile`) VALUES
(5, 87639543844443, 'bobby', 'ranika', 'braniks', 'b.ranika111@gmail.com', '61f7b248f03f09d23318c3f023cb9ac1', '', 353266, '0000-00-00 00:00:00', '2024-02-07 18:08:41', '2024-02-08 22:11:04'),
(6, 6651161, 'bobby', 'ranika', 'braniks', 'b.ranika111@gmail.com', '61f7b248f03f09d23318c3f023cb9ac1', '', 353266, '0000-00-00 00:00:00', '2024-02-07 18:08:41', '2024-02-08 22:11:04'),
(7, 65085716956181834, 'munchies', 'company', 'munchiesco', 'munchiesco11a@gmail.com', '3a0bd93139fb52f7d3cf74b236081e22', '', 353219, NULL, '2024-02-07 08:11:21', '2024-02-08 22:11:04'),
(8, 5591737812241350875, 'Hello', 'Foolish', 'Foolish_heart', 'HFoolish@gmail.com', '211ad862abd0ffd55ebcf1eabacd9b22', '', 0, NULL, '2024-01-24 09:23:47', '2024-02-08 22:11:04'),
(9, 5591737812241350875, 'Hello', 'Foolish', 'Foolish_heart', 'HFoolish@gmail.com', '211ad862abd0ffd55ebcf1eabacd9b22', '', 0, NULL, '2024-01-24 09:23:47', '2024-02-08 22:11:04'),
(10, 4328131572, 'rai', 'ron', 'rairai', 'ronioryzamae12@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, NULL, '2024-02-07 16:53:22', 'user_profiles/1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `f_name` (`f_name`),
  ADD KEY `l_name` (`l_name`),
  ADD KEY `email` (`email`),
  ADD KEY `cpass` (`cpass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
