-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 04:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videoke`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `admin_fee` varchar(80) NOT NULL,
  `gcash` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `admin_fee`, `gcash`) VALUES
(1, 'admin', 'admin', '150', '09164529592');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(80) NOT NULL,
  `Address` varchar(80) NOT NULL,
  `landlord_id` varchar(100) NOT NULL,
  `bhouse_id` varchar(100) NOT NULL,
  `status` varchar(80) NOT NULL,
  `reserve` varchar(80) NOT NULL,
  `event` varchar(80) NOT NULL,
  `event_date` varchar(80) NOT NULL,
  `finish` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `contact_number`, `Address`, `landlord_id`, `bhouse_id`, `status`, `reserve`, `event`, `event_date`, `finish`) VALUES
(1, 'gago', '123', 'gago', '2', '22931', '', '', 'Birthday', '2022-12-21', 'yes'),
(2, 'edward', '2134', 'edward', '2', '22931', '', '', 'Wedding', '2022-12-15', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(100) NOT NULL,
  `file_name` varchar(1000) NOT NULL,
  `rental_id` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `file_name`, `rental_id`) VALUES
(1, '7Cs.jpeg', '53196'),
(2, 'small.jpeg', '22931'),
(3, '11.jpg', '27304'),
(4, '15.jpg', '20371'),
(5, '15.jpg', '20371'),
(6, '1main.jpg', '88949'),
(7, '2.jpg', '88949'),
(8, '3.jpg', '88949'),
(9, '4.jpg', '88949'),
(10, '5.jpg', '88949'),
(11, '2.jpg', '53612'),
(12, '3.jpg', '53612'),
(13, '4.jpg', '53612'),
(14, '5.jpg', '53612'),
(15, '8.jpg', '53612'),
(16, '1.jpg', '31725'),
(17, '1main.jpg', '31725'),
(18, '2.jpg', '31725'),
(19, '3.jpg', '31725'),
(20, '4.jpg', '31725');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Address` varchar(80) NOT NULL,
  `profile_photo` varchar(80) NOT NULL,
  `contact_number` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `name`, `email`, `Address`, `profile_photo`, `contact_number`, `password`, `status`) VALUES
(1, 'Darly Caranzo', 'darly_caranzo@gmail.com', 'Pili ', '7Cs.jpeg', '09164529592', 'caranzo', 'Approved'),
(2, 'Roley Larunias', 'roleylaruniaz@gmail.com', 'Atop-Atop, Bantayan, Cebu', 'man1.png', '09126841957', '123', 'Approved'),
(3, 'Destura Joenel P.', 'desturajoenel@gmail.com', 'Putian, Bantayan, Cebu', 'man2.jpg', '09151918810', 'destura123', ''),
(4, 'Jevy Rose Cervantes', 'jevyrose@gmail.com', 'Brgy, San Agustin ,Madridejos, Cebu', 'man3.png', '09482514515', 'jevyrose12345', 'Approved'),
(8, 'mark stephen', 'markalolor07@gmail.com', 'Mancilang, Madridejos, Cebu', 'man5.png', '0912534578765', 'markalolor', 'Approved'),
(9, 'Mark', 'mark.alolor07@gmail.com', 'poblacion', 'man4.jpg', '091645295922', 'mark123', 'Approved'),
(10, 'stephen', 'mark_alolor07@gmail.com', 'malbago', 'man4.jpg', '09344355567', '12345', 'Approved'),
(11, 'test', 'test@gmail.com', 'test', '14.jpg', '1324', 'test', ''),
(12, 'Stephen Alolor', 'stephen_alolor@gmail.com', 'Mancilang, Madridejos, Cebu', 'man4.jpg', '09385677543', 'stephen12', ''),
(13, 'Stephen Alolor', 'stephen.alolor@gmail.com', 'Mancilang, Madridejos, Cebu', 'ss3.png', '09456677321', '12345', ''),
(14, 'owner', 'owner@gmail.com', 'mancilang', 'man1.png', '09898765433', 'own er', ''),
(15, 'kurt', 'kurt@gmail.com', 'bunakan', 'man4.jpg', '43456770909', 'kurt', '');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` int(100) NOT NULL,
  `rental_id` varchar(1000) NOT NULL,
  `landlord_id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `photo` varchar(1000) NOT NULL,
  `monthly` varchar(1000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `video` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(80) NOT NULL,
  `date` date NOT NULL,
  `fee` varchar(80) NOT NULL,
  `reserve` varchar(80) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `shot` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `rental_id`, `landlord_id`, `title`, `address`, `photo`, `monthly`, `description`, `video`, `type`, `status`, `date`, `fee`, `reserve`, `ref`, `shot`) VALUES
(1, '53196', '1', '7Cs Sound System', 'Pili, Madridejos, Cebu', '7Cs.jpeg', '3000', 'Types of Events with complete package and prices\r\nBirthday Events with complete package set up and lights', 'movie.mp4', 'Videoke', 'Approved', '2022-12-07', '200', 'yes', '', ''),
(2, '22931', '2', 'SMALL SOUND SYSTEM', 'Brgy, Atop-Atop, Bantayan, Cebu', 'small.jpeg', '200000', 'Types of Events:\r\nWedding  w/ two Box mcv, two Mid and complete light', 'movie.mp4', 'Videoke', 'Approved', '2022-12-07', '200', '', '', ''),
(3, '27304', '3', 'DJ nEILz', 'Putian, Bantayan,Cebu', '66.jpg', '3500', 'Types of Events:\r\nBirthday \r\nComplete package and Lights', 'movie.mp4', 'Sound System', 'Approved', '2022-12-07', '200', '', '', ''),
(4, '20371', '4', 'Jevy Rose Sound System', 'Brgy, San Agustin, Madridejos, Cebu', 'abt.jpg', '3000', 'Types of Events:\r\nWedding\r\nComplete Package w/ lights\r\n', 'movie.mp4', 'Sound System', 'Approved', '2022-12-07', '200', '', '', ''),
(11, '88949', '12', 'Alolor Mobile Sound System', 'Mancilang, Madridejos, Cebu', '22.jpg', '3000', 'Events and Package Offer:\r\nBirthday party with complete set up with lights', 'movie.mp4', 'Sound System', 'Approved', '2022-12-08', '200', 'yes', '091773641234', 'ss1.jpg'),
(12, '53612', '13', 'StephenZ Mobile Sound System', 'Mancilang, Madridejos, Cebu', '1main.jpg', '3000', 'Events and Package offer:\r\nBirthday with complete set up with lights', 'movie.mp4', 'Sound System', 'Approved', '2022-12-08', '200', '', '09254440751', 'ss3.png'),
(13, '31725', '15', 'kurt sound system', 'bunakan', '5.jpg', '3000', 'birthday party eventy wit complete set up with lights', 'movie.mp4', 'Videoke', 'Approved', '2022-12-10', '200', 'yes', '09123456787', 'ss2.png');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(80) NOT NULL,
  `owner_id` varchar(80) NOT NULL,
  `rating` varchar(80) NOT NULL,
  `comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
