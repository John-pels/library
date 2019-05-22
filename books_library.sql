-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2019 at 09:15 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date_registered`) VALUES
(1, 'johnpels', '70d6e9549d5e066aa5aaa0b9e8fdbf17c31b2b97', '2019-03-28 09:17:35'),
(2, 'superAdmin', '31f9b74e6bc5414f921754e271bc63057400a62c', '2019-03-29 07:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_category` varchar(255) NOT NULL,
  `book_cover` varchar(255) NOT NULL,
  `book_content` varchar(255) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `book_title`, `book_category`, `book_cover`, `book_content`, `date_uploaded`) VALUES
(1, 'New general Mathematics', 'Primary Schools', '../bookCovers/cca-cover-5.jpg', '../bookContents/Mysql tutorial.pdf', '2019-03-28 09:36:22'),
(2, 'Invisible Teacher by Dele Ashade', 'Secondary Schools', '../bookCovers/9-chamomiles-promise-1.jpg', '../bookContents/A0B7F51C-D8F9-A0D0-7F387126198F12F6.pdf', '2019-03-28 10:30:00'),
(3, 'PHP programming concepts', 'Tertiary Institutions', '../bookCovers/binary.jpg', '../bookContents/sql tutorial.docx', '2019-03-28 10:31:19'),
(4, 'Social Studies for primary schools', 'Primary Schools', '../bookCovers/ACTIVE-ENGLISH-GRAMMAR-1.jpg', '../bookContents/IYANU.pdf', '2019-03-28 10:42:13'),
(5, 'Epulb Books test', 'Primary Schools', '../bookCovers/3.jpg', '../bookContents/AccessibleEPUBfromINDCS6.epub', '2019-03-29 11:24:42'),
(6, 'PHP programming concepts', 'Secondary Schools', '../bookCovers/8-germs-1.jpg', '../bookContents/State_of_Worlds_Children__ES_2013.epub', '2019-03-29 11:25:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
