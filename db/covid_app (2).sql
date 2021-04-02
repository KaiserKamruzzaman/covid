-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 08:51 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `org_id` int(10) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `inserted_at` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `org_id`, `comment`, `inserted_at`) VALUES
(2, 48, 1, 'the environment of the hospital is pretty good ......', '2021-03-03 23:03:27'),
(3, 47, 1, 'treatment is good but service is slow...', '2021-03-03 23:04:10'),
(4, 49, 1, 'for me treatment was good...', '2021-03-03 23:06:41'),
(5, 46, 1, 'maintain covid safety precaution', '2021-03-03 23:08:32'),
(6, 50, 1, 'nursing service is not that good..', '2021-03-03 23:09:32'),
(7, 47, 2, 'the hospital is very good..', '2021-03-23 01:41:36'),
(8, 47, 7, 'good hospital....', '2021-03-23 01:42:37'),
(9, 47, 6, 'treatment is very good...', '2021-03-23 01:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `covid_data`
--

CREATE TABLE `covid_data` (
  `id` int(15) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `total_case` int(15) DEFAULT NULL,
  `new_case` int(15) DEFAULT NULL,
  `total_death` int(15) DEFAULT NULL,
  `new_death` int(15) DEFAULT NULL,
  `trans_type` varchar(250) DEFAULT NULL,
  `pub_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `covid_data`
--

INSERT INTO `covid_data` (`id`, `country`, `total_case`, `new_case`, `total_death`, `new_death`, `trans_type`, `pub_date`) VALUES
(1, 'Italy', 2455185, 13331, 85162, 488, 'Cluster of cases', '2021-02-21'),
(6, 'India', 10777284, 11039, 154596, 110, 'Clusters of cases', '2021-02-21'),
(7, 'Germany', 2228085, 6114, 57981, 861, 'Community transmission', '2021-02-21'),
(8, 'Australia', 28824, 6, 909, 0, 'Community transmission', '2021-02-21'),
(9, 'USA', 26055512, 125444, 439830, 1866, 'Community transmission', '2021-02-21'),
(10, 'Pakistan', 547648, 1220, 11746, 63, 'Community transmission', '2021-02-21'),
(12, 'Italy', 2455185, 13331, 85162, 488, 'Cluster of cases', '2021-03-03'),
(13, 'Bangladesh', 532401, 500, 5000, 60, 'Clusters of cases', '2021-02-27'),
(14, 'Bangladesh', 533953, 500, 5000, 60, 'Clusters of cases', '2021-02-28'),
(15, 'Bangladesh', 534770, 500, 5000, 60, 'Clusters of cases', '2021-03-01'),
(16, 'Bangladesh', 535582, 500, 5000, 60, 'Clusters of cases', '2021-03-02'),
(17, 'India', 11139516, 14989, 157346, 98, 'Clusters of cases', '2021-03-03'),
(18, 'Germany', 2451011, 3943, 70463, 358, 'Community transmission', '2021-03-03'),
(19, 'Australia', 28986, 8, 909, 0, 'Community transmission', '2021-03-03'),
(20, 'USA', 28345585, 50776, 510924, 1279, 'Community transmission', '2021-03-03'),
(21, 'Pakistan', 582528, 1163, 12938, 42, 'Community transmission', '2021-03-03'),
(22, 'Bangladesh', 547316, 515, 8423, 7, 'Community transmission', '2021-03-03'),
(23, 'Italy', 2455185, 13331, 85162, 488, 'Cluster of cases', '2021-03-04'),
(28, 'India', 11139516, 14989, 157346, 98, 'Clusters of cases', '2021-03-04'),
(29, 'Germany', 2451011, 3943, 70463, 358, 'Community transmission', '2021-03-04'),
(30, 'Australia', 28986, 8, 909, 0, 'Community transmission', '2021-03-04'),
(31, 'USA', 28345585, 50776, 510924, 1279, 'Community transmission', '2021-03-04'),
(32, 'Pakistan', 582528, 1163, 12938, 42, 'Community transmission', '2021-03-04'),
(33, 'Bangladesh', 547316, 515, 8423, 7, 'Community transmission', '2021-03-04'),
(34, 'Italy', 2455185, 13331, 85162, 488, 'Cluster of cases', '2021-03-23'),
(35, 'India', 11139516, 14989, 157346, 98, 'Clusters of cases', '2021-03-23'),
(36, 'Germany', 2451011, 3943, 70463, 358, 'Community transmission', '2021-03-23'),
(37, 'Australia', 28986, 8, 909, 0, 'Community transmission', '2021-03-23'),
(38, 'USA', 28345588, 50776, 510924, 1277, 'Community transmission', '2021-03-23'),
(39, 'Pakistan', 582528, 1163, 12938, 42, 'Community transmission', '2021-03-23'),
(40, 'Bangladesh', 547316, 515, 8423, 7, 'Community transmission', '2021-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(10) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `location`) VALUES
(1, 'Chittagong Medical College and Hospital', 'ChawkBazar,Chittagong'),
(2, 'Dhaka Medical College and Hospital', 'Dhaka'),
(3, 'Khulna Medical College and Hospital', 'Khulna'),
(4, 'Kurmitola General Hospital', 'Kurmitola,Dhaka'),
(5, 'Mirpur Maternity Hospital', 'Mirpur,Dhaka'),
(6, 'Mymensingh Medical College and Hospital', 'Mymensingh '),
(7, 'National Heart Foundation,Sylhet', 'Sylhet');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `org_id` int(10) DEFAULT NULL,
  `rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `org_id`, `rating`) VALUES
(2, 48, 1, 4.5),
(3, 47, 1, 5),
(4, 47, 2, 5),
(5, 47, 3, 4.5),
(6, 47, 4, 4),
(7, 47, 5, 4.5),
(8, 47, 6, 4.5),
(9, 47, 7, 3.5),
(10, 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `country`, `image`, `type`) VALUES
(1, 'nk', 'nk@gmail.com', '123456', 'Bangladesh', NULL, 1),
(2, 'user', 'user@gmail.com', '123456', 'Germany', NULL, 2),
(45, 'test', 'test@gmail.com', '123456', 'bbbbb', '15555131_372613776408436_475460919_o.jpg', 2),
(46, 'tahseen', 'tahseen@gmail.com', '123456', 'Bangladesh', 'image.png', 2),
(47, 'masum', 'masum@gmail.com', '123456', 'Bangladesh', 'downloawwd.png', 2),
(48, 'kaiser', 'kaiser@gmail.com', '123456', 'Bangladesh', 'eeee.png', 2),
(49, 'flora', 'flora@gmail.com', '123456', 'Bangladesh', 'download.jpg', 2),
(50, 'Roushan', 'roushan@gmail.com', '123456', 'Bangladesh', 'download1.jpg', 2),
(51, 'admin', 'admin@gmail.com', '123456', 'Germany', 'try3.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(5) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `covid_data`
--
ALTER TABLE `covid_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `covid_data`
--
ALTER TABLE `covid_data`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
