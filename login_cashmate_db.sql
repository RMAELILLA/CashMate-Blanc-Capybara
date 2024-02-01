-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 01:56 PM
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
  `id` int(5) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `Transportation` varchar(50) NOT NULL,
  `Clothing` varchar(50) NOT NULL,
  `House` varchar(50) NOT NULL,
  `HealthCare` varchar(50) NOT NULL,
  `Entertainment` varchar(50) NOT NULL,
  `Food` varchar(50) NOT NULL,
  `Pet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashchart`
--

INSERT INTO `dashchart` (`id`, `user_name`, `Transportation`, `Clothing`, `House`, `HealthCare`, `Entertainment`, `Food`, `Pet`) VALUES
(0, 'Foolish_heart', '5000', '1000', '10000', '5000', '1000', '3500', '500'),
(1, 'braniks', '3000', '1500', '5000', '3000', '500', '10000', '500');

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
('braniks', 'Vehicle', 2000, '2024-02-01');

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
('braniks', 'Accenture', 'Employment', 50000, '2024-01-15');

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
('braniks', 'Vehicle', 2000000, '0000-00-00', '2027-01-01', 55556);

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `f_name`, `l_name`, `user_name`, `email`, `password`, `cpass`, `date`) VALUES
(5, 87639543844443, 'bobby', 'ranika', 'braniks', 'b.ranika111@gmail.com', '9522eb90ee8e8bfdd271d7886153eb74', '', '2024-01-24 11:07:38'),
(6, 6651161, 'bobby', 'ranika', 'braniks', 'b.ranika111@gmail.com', '9522eb90ee8e8bfdd271d7886153eb74', '', '2024-01-24 03:12:42'),
(7, 65085716956181834, 'munchies', 'company', 'munchiesco', 'munchiesco11a@gmail.com', '3a0bd93139fb52f7d3cf74b236081e22', '', '2024-01-24 04:31:45'),
(8, 5591737812241350875, 'Hello', 'Foolish', 'Foolish_heart', 'HFoolish@gmail.com', '211ad862abd0ffd55ebcf1eabacd9b22', '', '2024-01-24 09:23:47'),
(9, 5591737812241350875, 'Hello', 'Foolish', 'Foolish_heart', 'HFoolish@gmail.com', '211ad862abd0ffd55ebcf1eabacd9b22', '', '2024-01-24 09:23:47');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
