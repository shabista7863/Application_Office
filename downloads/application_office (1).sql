-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2019 at 07:41 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `application_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL COMMENT 'Administraion name',
  `image` varchar(255) NOT NULL COMMENT 'Administraion image'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `email`, `password`, `admin_name`, `image`) VALUES
(1, 'shabista33.sarwer@gmail.com                     ', '21                     ', ' shabista  sarwer ', '10422595_381003525407714_2974072878682432633_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `download_id` int(12) NOT NULL,
  `payment_id` int(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `token_id` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`download_id`, `payment_id`, `pid`, `token_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:02:04', '2019-12-05 16:02:04'),
(2, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:02:19', '2019-12-05 16:02:19'),
(3, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:02:37', '2019-12-05 16:02:37'),
(4, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:04:40', '2019-12-05 16:04:40'),
(5, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:04:41', '2019-12-05 16:04:41'),
(6, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:05:17', '2019-12-05 16:05:17'),
(7, 27, 20, '98f13708210194c475687be6106a3b84', '0', '2019-12-05 16:05:18', '2019-12-05 16:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(12) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_gross` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `payment_status` enum('1','0') NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `created_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_gross`, `currency_code`, `payment_status`, `name`, `email`, `phoneno`, `created_dt`) VALUES
(20, '20', '', '12', '', '0', 'shibbi', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 11:34:41'),
(22, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 15:35:12'),
(23, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 15:36:32'),
(24, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 15:37:20'),
(25, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 15:41:38'),
(26, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 15:43:56'),
(27, '20', '', '12', '', '1', 'shibbi', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 15:47:38'),
(28, '22', '', '22', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 16:11:13'),
(29, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 16:20:35'),
(30, '20', '', '12', '', '0', 'shabista sarwer', 'shabista.sarwer@gmail.com', '08750836783', '2019-12-05 16:22:04'),
(31, '25', '', '50', '', '0', 'Pratik Jain', 'pratik@gmail.com', '8750836783', '2019-12-05 16:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1-Active,0-Deactive',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_item`
--

INSERT INTO `product_item` (`id`, `name`, `reference`, `price`, `video`, `description`, `file`, `image`, `status`, `created_date`) VALUES
(20, 'pratik hyhy ', 'jain  iuiu  ', '125', 'https://www.youtube.com/watch?v=kJQP7kiw5Fk    ', 'so interested in english song sdfghjkl;cvbnm,.dfghjklcvb nm,cvbnm,cvbnmcvbnmxcvbnmxcvbnmdfghjkertyuiertyuifghj', '', 'picture001.jpg', '0', '2019-12-06 12:05:30'),
(22, 'shabista sarwer', 'sarwar  1', '22', '', 'iuytre', '', 'picture001.jpg', '1', '2019-12-06 12:05:30'),
(25, 'shabista sarwer', 'asdfg', '50', '', 'vbnm', '', 'picture000.jpg', '1', '2019-12-06 12:05:30'),
(26, 'ajay', 'php developer', '15', 'https://www.youtube.com/watch?v=N3oMKS1AfVI', 'THIS song is very ', '', '1mb.mp4', '1', '2019-12-06 12:05:30'),
(27, 'shabista sarwer', 'sarwar  1', '1111', 'Anchorage', 'rewghjasd', '', 'picture003.jpg', '1', '2019-12-06 12:05:30'),
(28, 'shabista sarwer', 'sarwar  1', '20000', '', 'lolo', '', 'picture006.jpg', '1', '2019-12-06 12:05:30'),
(29, 'shabista sarwer', 'asdfg', '100000', 'hbgvfd', 'gfds', 'AnyDesk.exe', '', '1', '2019-12-06 12:06:35'),
(30, 'pratik', 'jain', '11111', 'dddd', 'rews', 'AnyDesk.exe', 'picture005.png', '1', '2019-12-06 12:07:48'),
(31, 'pratik', 'jain', '11111', 'dddd', 'rews', 'AnyDesk.exe', 'picture005.png', '1', '2019-12-06 12:10:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_id`),
  ADD KEY `pid_2` (`pid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `download_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
