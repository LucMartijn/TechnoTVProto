-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 02:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techno_tv_prototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image1_path` varchar(255) DEFAULT NULL,
  `image2_path` varchar(255) DEFAULT NULL,
  `image3_path` varchar(255) DEFAULT NULL,
  `image4_path` varchar(255) DEFAULT NULL,
  `image5_path` varchar(255) DEFAULT NULL,
  `image6_path` varchar(255) DEFAULT NULL,
  `image7_path` varchar(255) DEFAULT NULL,
  `image8_path` varchar(255) DEFAULT NULL,
  `image9_path` varchar(255) DEFAULT NULL,
  `image10_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nieuwsflash`
--

CREATE TABLE `nieuwsflash` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `flashdesc1` text DEFAULT NULL,
  `flashimage1` varchar(255) DEFAULT NULL,
  `flashimage2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nieuwsflash`
--

INSERT INTO `nieuwsflash` (`id`, `title`, `flashdesc1`, `flashimage1`, `flashimage2`) VALUES
(5, 'TechnoTV Prototype', 'Dit is een Testversie van de TechnoTV. Met deze test probeer ik feedback te krijgen, zoals wat er goed of slecht gaat. Je kan een artikel toevoegen door ESC te drukken, te klikken op de invoer knop rechtsboven en een van de 3 forms in te vullen.', 'newsImages/791e5bedafcd7c8622a06ed60ef2a057054a09b24f219d7930d17a212f58.png', 'newsImages/3c5cd5fbac9005014a3dbb118bd6d7d309086402567c65d453b18a6f2445.png'),
(6, 'Feedback Geven op de TechnoTV!', 'Doordat dit een prototype is, is feedback heel waardevol voor ons. Heb je nog ideeen, tips, tops of feedback? Kom langs of stuur een berichtje naar Luc Martijn via teams!', 'newsImages/af25593d2682ae61954a6bee3e4e10a5ef0b912f370e7bc9246e2e3d2fda.webp', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `storydesc1` text DEFAULT NULL,
  `storydesc2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`id`, `title`, `storydesc1`, `storydesc2`) VALUES
(1, 'Dit is een Verhaal', 'Hier kan je een kort verhaal schrijven over een gebeurtenis of iets anders!', 'Dit krijg je dan te zien op de technoTV. Cool he?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nieuwsflash`
--
ALTER TABLE `nieuwsflash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nieuwsflash`
--
ALTER TABLE `nieuwsflash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
