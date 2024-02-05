-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 08:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `department` varchar(64) DEFAULT NULL,
  `average` double DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `student_photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `date_of_birth`, `department`, `average`, `address`, `city`, `country`, `tel`, `email`, `student_photo`) VALUES
(1122334, 'Ahmad', 'M', '2023-11-15', 'A', 82, 'Aa', 'AaA', 'AaAa', '0568552236', 'ahmad@gmail.com', '1122334.jpeg'),
(1210412, 'Worood', 'F', '2003-05-31', 'CS', 98, 'Ramallah', 'Ramallah_r', 'Palestinian Authority', '0598765432', 'woroodassi345@gmail.com', '1210412.jpeg'),
(1592346, 'Noor ', 'M', '2024-01-04', 'Math', 87, 'AAaa', 'BBbb', 'Palestinian Authority', '0591587600', 'noor@gmail.com', '1592346.jpeg'),
(3333337, 'Sara', 'F', '2024-02-12', 'cs', 65.4, 'USA', 'Paris', 'Palestinian Authority', '0585214730', 'sara@gmail.com', '3333337.jpeg'),
(3366008, 'Apple', 'F', '2024-01-17', 'mini-apple', 90, 'Banana', 'Pizza', 'Cookies', '0539966600', 'apple@gmail.com', '3366008.jpeg'),
(7778885, 'Hello', 'F', '2019-02-12', 'Hi', 40, 'Hello-World', 'Hh', 'Oo', '0520000001', 'hi@gmail.ocm', '7778885.jpeg'),
(7854652, 'Pin', 'M', '2024-01-03', 'OK', 78, 'Yes', 'NO', 'Maybe', '0512345678', 'pin@gmail.com', '7854652.jpeg'),
(8754600, 'Manar ', 'F', '1996-06-12', 'abc', 97, 'USA', 'Paris', 'Palestinian Authority', '0500011122', 'manar@gmail.com', '8754600.jpeg'),
(8888888, 'zain', 'M', '2024-01-02', 'Physics', 69, 'Aa', 'Bb', 'Cocos (Keeling) Islands', '0560560563', 'zaid@gmail.com', '8888888.jpeg'),
(9300989, 'Mohammad', 'M', '2022-08-04', 'IT', 78, 'yy', 'mm', 'bb', '0590590598', 'M@gmail.com', '9300989.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
