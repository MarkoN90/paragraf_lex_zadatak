-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 09:10 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paragraf_lex_zadatak`
--

-- --------------------------------------------------------

--
-- Table structure for table `osiguranici`
--

CREATE TABLE `osiguranici` (
  `id` int(11) NOT NULL,
  `polisa_osiguranja_id` int(11) NOT NULL,
  `ime_osiguranika` varchar(50) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `broj_pasosa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `osiguranici`
--

INSERT INTO `osiguranici` (`id`, `polisa_osiguranja_id`, `ime_osiguranika`, `datum_rodjenja`, `broj_pasosa`) VALUES
(25, 98, 'Marko Markovic', '1988-12-05', '654654654654');

-- --------------------------------------------------------

--
-- Table structure for table `polise_osiguranja`
--

CREATE TABLE `polise_osiguranja` (
  `id` int(11) NOT NULL,
  `datum_unosa` date NOT NULL DEFAULT current_timestamp(),
  `ime_osiguranika` varchar(50) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `broj_pasosa` varchar(15) NOT NULL,
  `telefon` int(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `pocetak_putovanja` date NOT NULL DEFAULT current_timestamp(),
  `kraj_putovanja` date NOT NULL DEFAULT current_timestamp(),
  `tip_osiguranja` set('individualno','grupno','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polise_osiguranja`
--

INSERT INTO `polise_osiguranja` (`id`, `datum_unosa`, `ime_osiguranika`, `datum_rodjenja`, `broj_pasosa`, `telefon`, `email`, `pocetak_putovanja`, `kraj_putovanja`, `tip_osiguranja`) VALUES
(92, '2020-06-23', 'Gordana Gojkovic', '1989-04-04', '465498749847', 2147483647, 'gordanagojkovic@gmail.com', '2020-06-26', '2020-07-09', 'individualno'),
(96, '2020-06-23', 'Petar Petrovic', '1954-01-16', '465498749847', 2147483647, 'markonisevic1@yahoo.com', '2020-06-14', '2020-06-25', 'individualno'),
(98, '2020-06-23', 'Marija Markovic', '1977-04-05', '465498749847', 2147483647, 'markonisevic1@yahoo.com', '2020-06-26', '2020-06-28', 'grupno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `osiguranici`
--
ALTER TABLE `osiguranici`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polisa_osiguranja_id` (`polisa_osiguranja_id`);

--
-- Indexes for table `polise_osiguranja`
--
ALTER TABLE `polise_osiguranja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `osiguranici`
--
ALTER TABLE `osiguranici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `polise_osiguranja`
--
ALTER TABLE `polise_osiguranja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `osiguranici`
--
ALTER TABLE `osiguranici`
  ADD CONSTRAINT `osiguranici_ibfk_1` FOREIGN KEY (`polisa_osiguranja_id`) REFERENCES `polise_osiguranja` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
