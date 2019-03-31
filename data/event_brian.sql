-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2019 at 02:35 PM
-- Server version: 5.7.18
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_brian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocate`
--

CREATE TABLE `tbl_allocate` (
  `id` int(11) NOT NULL,
  `eventname` varchar(255) NOT NULL,
  `numberofpeople` varchar(255) NOT NULL,
  `eventDate` varchar(255) NOT NULL,
  `venueId` varchar(255) NOT NULL,
  `roomtype` varchar(255) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `roomprice` varchar(255) NOT NULL,
  `postid` varchar(255) NOT NULL,
  `postUser` varchar(255) NOT NULL,
  `allocateId` int(11) NOT NULL,
  `commentStatus` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT 'No Comment',
  `bookPerson` varchar(255) NOT NULL DEFAULT 'Not Booked',
  `bookStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_allocate`
--

INSERT INTO `tbl_allocate` (`id`, `eventname`, `numberofpeople`, `eventDate`, `venueId`, `roomtype`, `roomname`, `roomprice`, `postid`, `postUser`, `allocateId`, `commentStatus`, `comment`, `bookPerson`, `bookStatus`) VALUES
(27, 'kimatia', '4', '2018-07-17', '8', 'VIP', 'ryuyh', '334', '34', 'davy', 0, 0, 'No Comment', 'Not Booked', 0),
(28, 'hhh', '6', '2018-07-13', '7', 'Normal', 'wsxcf', '456', '34', 'davy', 21, 0, 'No Comment', 'Not Booked', 0),
(29, 'yuu', '6', '2018-07-10', '7', 'Normal', 'wsxcf', '456', '34', 'davy', 21, 1, 'ok', 'kims', 1),
(30, 'tttt', '6', '2018-07-20', '7', 'Normal', 'wsxcf', '456', '34', 'davy', 21, 1, 'nice', 'brianvillah', 1),
(31, 'hhh', '3', '2018-07-09', '6', 'Regular', 'qwerty', '2500', '34', 'davy', 22, 1, 'ttttt', 'kims', 1),
(32, 'kims', '3', '2018-07-12', '9', 'Regular', 'rty', '1200', '34', 'davy', 23, 1, 'hh', 'kims', 1),
(33, 'churchil live', '300', '2018-07-04', '10', 'Regular', 'mobasa sports club', '20000', '34', 'davy', 24, 1, 'eagerly waiting', 'kims', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookreserve`
--

CREATE TABLE `tbl_bookreserve` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `roomType` varchar(255) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `roomPrice` varchar(255) NOT NULL,
  `roomSize` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `bookReservePerson` varchar(255) NOT NULL,
  `allocate` int(11) NOT NULL DEFAULT '0',
  `event` varchar(255) NOT NULL DEFAULT 'Non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bookreserve`
--

INSERT INTO `tbl_bookreserve` (`id`, `postId`, `venueId`, `roomType`, `roomName`, `roomPrice`, `roomSize`, `startDate`, `endDate`, `duration`, `status`, `bookReservePerson`, `allocate`, `event`) VALUES
(20, 34, 8, 'VIP', 'ryuyh', '334', '3', '2018-07-24', '2018-07-27', '3', 1, 'davy', 1, 'Non'),
(21, 34, 7, 'Normal', 'wsxcf', '456', '23', '2018-07-12', '2018-07-28', '2', 1, 'davy', 1, '0'),
(22, 34, 6, 'Regular', 'qwerty', '2500', '23', '2018-07-03', '2018-07-20', '4', 1, 'davy', 1, '0'),
(23, 34, 9, 'Regular', 'rty', '1200', '34', '2018-07-03', '2018-07-12', '4', 1, 'davy', 1, 'kims'),
(24, 34, 10, 'Regular', 'mobasa sports club', '20000', '34', '2018-12-01', '2018-07-11', '4 hours', 0, 'davy', 1, 'churchil live');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logintype` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `username`, `phonenumber`, `email`, `password`, `logintype`) VALUES
(33, 'kimatia', 'Dan', 'kims', '2357677', 'kimatiadaniel@gmail.com', '$2y$10$Z5CBPF9sk7zWYcSkUkWlAOPs8Up28LtUL21BCV0MLCFivtsT3gkF2', '0'),
(34, 'DAVID ', 'KAGURU', 'davy', '2233455', 'kagurudavy@gmail.com', '$2y$10$dUe31bjhHyukuT1sLKUhZe0N1AY31DqnkZB8IiLus6S3HF/CTyJ8W', '1'),
(35, 'brian', 'villa', 'brio', '12455', 'brian@gmail.com', '$2y$10$Se5v6vCaO.bv2mPEi1voiO06ksyzd4U4pM72ZstPkOIbzv8tJ/bfS', '3'),
(36, 'brian', 'villah', 'brianvillah', '0706180626', 'brianvillah@gmail.com', '$2y$10$OdESqJT1lhs0gw8/8ourYOmoEXc5FacqJUBSP/lKZnI3r01P6A9mG', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL,
  `roomType` varchar(255) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `roomPrice` varchar(255) NOT NULL,
  `roomSize` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_venue`
--

INSERT INTO `tbl_venue` (`id`, `roomType`, `roomName`, `roomPrice`, `roomSize`, `startDate`, `endDate`, `duration`, `status`) VALUES
(6, 'Regular', 'qwerty', '2500', '23', '2018-07-03', '2018-07-20', '4', 1),
(7, 'Normal', 'wsxcf', '456', '23', '2018-07-12', '2018-07-28', '2', 0),
(8, 'VIP', 'ryuyh', '334', '3', '2018-07-24', '2018-07-27', '3', 0),
(10, 'Regular', 'mobasa sports club', '20000', '34', '2018-12-01', '2018-07-11', '4 hours', 0),
(11, 'Regular', 'kimson', '5600', '4', '2019-03-28', '2019-03-20', '55', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_allocate`
--
ALTER TABLE `tbl_allocate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookreserve`
--
ALTER TABLE `tbl_bookreserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allocate`
--
ALTER TABLE `tbl_allocate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_bookreserve`
--
ALTER TABLE `tbl_bookreserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
