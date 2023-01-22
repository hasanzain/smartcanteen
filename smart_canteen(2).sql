-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 01:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'kalijogo', '0c8eb7852e684799b3214b93dea24b01');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `departemen_id` int(11) NOT NULL,
  `nama_departemen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`departemen_id`, `nama_departemen`) VALUES
(1, 'OPR'),
(2, 'PRO'),
(3, 'ENG'),
(4, 'PLT'),
(5, 'SCM'),
(6, 'HSE'),
(7, 'GEA');

-- --------------------------------------------------------

--
-- Table structure for table `jam_makan`
--

CREATE TABLE `jam_makan` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jam_makan`
--

INSERT INTO `jam_makan` (`id`, `keterangan`, `jam`) VALUES
(1, 'pagi', '04:30:00'),
(2, 'siang', '13:30:00'),
(3, 'sore', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nrp` int(30) NOT NULL,
  `id_karyawan` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `departemen_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nrp`, `id_karyawan`, `nama`, `departemen_id`, `email`, `status`) VALUES
(1, 0, '12345678', 'karyawan 2', 0, 'mail@mail.com', '1'),
(3, 113, '123', 'Hasan', 3, 'asadas@mail.com', '1'),
(5, 145, 'ads', 'mas ganteng', 4, 'asd@mail.com', '1'),
(6, 0, '11111', 'hasan', 1, 'asdjaklsdj', '1');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_makan`
--

CREATE TABLE `riwayat_makan` (
  `id` int(11) NOT NULL,
  `id_karyawan` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_makan`
--

INSERT INTO `riwayat_makan` (`id`, `id_karyawan`, `nama`, `tanggal`, `jam`, `keterangan`) VALUES
(14, '12345678', 'karyawan 2', '2022-09-11', '12:33:23', 'pagi'),
(15, '12345678', 'karyawan 2', '2022-09-16', '08:30:02', 'pagi'),
(16, '123', 'Hasan', '2022-09-16', '08:30:10', 'pagi'),
(34, '123', 'Hasan', '2022-09-20', '15:48:09', 'pagi'),
(35, '123', 'Hasan', '2022-09-20', '15:48:33', 'sore');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`departemen_id`),
  ADD KEY `departemen_id` (`departemen_id`);

--
-- Indexes for table `jam_makan`
--
ALTER TABLE `jam_makan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keterangan` (`keterangan`),
  ADD KEY `keterangan_2` (`keterangan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `departemen_id` (`departemen_id`);

--
-- Indexes for table `riwayat_makan`
--
ALTER TABLE `riwayat_makan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jam_makan`
--
ALTER TABLE `jam_makan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `riwayat_makan`
--
ALTER TABLE `riwayat_makan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `riwayat_makan`
--
ALTER TABLE `riwayat_makan`
  ADD CONSTRAINT `riwayat_makan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
