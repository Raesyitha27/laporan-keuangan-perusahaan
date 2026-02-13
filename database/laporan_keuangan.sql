-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2026 at 05:18 AM
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
-- Database: `laporan_keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `nomor` int(11) NOT NULL,
  `bagian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`nomor`, `bagian`) VALUES
(1, 'HR'),
(2, 'Keuangan'),
(3, 'IT'),
(4, 'Operasional');

-- --------------------------------------------------------

--
-- Table structure for table `debet_kredit`
--

CREATE TABLE `debet_kredit` (
  `id` int(11) NOT NULL,
  `jenis` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debet_kredit`
--

INSERT INTO `debet_kredit` (`id`, `jenis`) VALUES
(1, 'Debet'),
(2, 'Kredit');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `no_pegawai` varchar(20) NOT NULL,
  `gaji_pokok` decimal(15,2) DEFAULT NULL,
  `faktor_perubah` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`no_pegawai`, `gaji_pokok`, `faktor_perubah`) VALUES
('PG001', 5000000.00, 10.00),
('PG002', 4500000.00, 5.00),
('PG003', 8000000.00, 15.00),
('PG004', 6000000.00, 8.00),
('PG005', 4000000.00, 7.00),
('PG006', 5500000.00, 6.00),
('PG007', 7000000.00, 12.00),
('PG008', 10000000.00, 20.00),
('PG009', 4800000.00, 5.00),
('PG010', 6500000.00, 9.00);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `no_pegawai` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`no_pegawai`, `nama`, `id`, `nomor`, `jabatan`) VALUES
('PG001', 'Andi Saputra', 1, 1, 'Staff HR'),
('PG002', 'Budi Santoso', 2, 2, 'Staff Keuangan'),
('PG003', 'Citra Lestari', 3, 3, 'Programmer'),
('PG004', 'Dedi Pratama', 2, 4, 'Supervisor'),
('PG005', 'Eka Putri', 1, 1, 'Admin HR'),
('PG006', 'Fajar Hidayat', 3, 3, 'IT Support'),
('PG007', 'Gina Maharani', 2, 2, 'Akuntan'),
('PG008', 'Hendra Wijaya', 3, 4, 'Manager Operasional'),
('PG009', 'Intan Permata', 1, 1, 'Recruiter'),
('PG010', 'Joko Susilo', 2, 2, 'Finance Officer');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int(11) NOT NULL,
  `jenjang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `jenjang`) VALUES
(1, 'SMA'),
(2, 'S1'),
(3, 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_rekening` varchar(20) NOT NULL,
  `nama_rekening` varchar(100) DEFAULT NULL,
  `rek_level_1` varchar(100) DEFAULT NULL,
  `rek_level_2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rekening`, `nama_rekening`, `rek_level_1`, `rek_level_2`) VALUES
('101', 'Kas', NULL, NULL),
('102', 'Bank', NULL, NULL),
('201', 'Utang', NULL, NULL),
('301', 'Modal', NULL, NULL),
('401', 'Pendapatan', NULL, NULL),
('501', 'Beban Gaji', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` int(11) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_debet_kredit` int(11) DEFAULT NULL,
  `debet` decimal(15,2) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `no_rekening`, `tanggal`, `id_debet_kredit`, `debet`, `kredit`) VALUES
(1, '101', '2025-01-01', 1, 10000000.00, 0.00),
(2, '301', '2025-01-01', 2, 0.00, 10000000.00),
(3, '501', '2025-01-05', 1, 5000000.00, 0.00),
(4, '101', '2025-01-05', 2, 0.00, 5000000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `debet_kredit`
--
ALTER TABLE `debet_kredit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`no_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no_pegawai`),
  ADD KEY `id` (`id`),
  ADD KEY `nomor` (`nomor`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_rekening`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD KEY `no_rekening` (`no_rekening`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `id_debet_kredit` (`id_debet_kredit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `debet_kredit`
--
ALTER TABLE `debet_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `fk_gaji_pegawai` FOREIGN KEY (`no_pegawai`) REFERENCES `pegawai` (`no_pegawai`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pendidikan` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`nomor`) REFERENCES `bagian` (`nomor`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`no_rekening`) REFERENCES `rekening` (`no_rekening`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_debet_kredit`) REFERENCES `debet_kredit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
