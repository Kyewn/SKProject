-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 12:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_projek`
--

-- --------------------------------------------------------

--
-- Table structure for table `kerosakan`
--

CREATE TABLE `kerosakan` (
  `KOD_ROSAK` int(10) NOT NULL,
  `NAMA_ALAT` varchar(30) NOT NULL,
  `BIL_ALAT` int(10) NOT NULL,
  `JENIS_ROSAK` varchar(30) NOT NULL,
  `TARIKH_ROSAK` varchar(30) NOT NULL,
  `MURID_TERLIBAT` varchar(30) NOT NULL,
  `PEREKOD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kerosakan`
--

INSERT INTO `kerosakan` (`KOD_ROSAK`, `NAMA_ALAT`, `BIL_ALAT`, `JENIS_ROSAK`, `TARIKH_ROSAK`, `MURID_TERLIBAT`, `PEREKOD`) VALUES
(1, 'test', 21, 'rosak sendiri', '24/03/2022', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kodpengguna` int(10) NOT NULL,
  `NAMA` varchar(30) NOT NULL,
  `KATALALUAN` varchar(30) NOT NULL,
  `TELEFON` varchar(30) NOT NULL,
  `SECURITYQ` varchar(30) NOT NULL,
  `ANSWER` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kodpengguna`, `NAMA`, `KATALALUAN`, `TELEFON`, `SECURITYQ`, `ANSWER`) VALUES
(1, 'admin', 'admin123', '', 'a', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `peralatan`
--

CREATE TABLE `peralatan` (
  `KODALAT` int(10) NOT NULL,
  `NAMAALAT` varchar(50) NOT NULL,
  `BILANGANALAT` int(11) NOT NULL,
  `JENISALAT` varchar(50) NOT NULL,
  `PENDAFTAR` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peralatan`
--

INSERT INTO `peralatan` (`KODALAT`, `NAMAALAT`, `BILANGANALAT`, `JENISALAT`, `PENDAFTAR`) VALUES
(1, 'tool 1', 3, 'bahan', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kerosakan`
--
ALTER TABLE `kerosakan`
  ADD PRIMARY KEY (`KOD_ROSAK`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kodpengguna`);

--
-- Indexes for table `peralatan`
--
ALTER TABLE `peralatan`
  ADD PRIMARY KEY (`KODALAT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kerosakan`
--
ALTER TABLE `kerosakan`
  MODIFY `KOD_ROSAK` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `kodpengguna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peralatan`
--
ALTER TABLE `peralatan`
  MODIFY `KODALAT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
