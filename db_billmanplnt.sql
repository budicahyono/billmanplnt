-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 01:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_billmanplnt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `is_admin_unit` int(1) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `level`, `is_admin_unit`, `id_unit`, `last_login`) VALUES
(1, 'Admin Utama', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 0, 0, '2023-10-04 01:33:36'),
(2, 'Manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager', 0, 0, '2023-10-02 21:17:40'),
(8, 'Admin Tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'admin', 0, 0, '2023-10-02 21:10:53'),
(9, 'tess', 'tess', 'tess', 'tess', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendala`
--

CREATE TABLE `jenis_kendala` (
  `id_jenis_kendala` int(11) NOT NULL,
  `nama_jenis_kendala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kendala`
--

INSERT INTO `jenis_kendala` (`id_jenis_kendala`, `nama_jenis_kendala`) VALUES
(1, 'Putus Fuding'),
(2, 'Janji Bayar'),
(3, ' '),
(4, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `kendala_harian`
--

CREATE TABLE `kendala_harian` (
  `id_kendala_harian` int(11) NOT NULL,
  `tgl_kendala` date NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `isi_kendala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendala_harian`
--

INSERT INTO `kendala_harian` (`id_kendala_harian`, `tgl_kendala`, `id_petugas`, `isi_kendala`) VALUES
(1, '2023-09-24', 2, 'waktu tidak cukup');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(12) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `tarif` varchar(2) NOT NULL,
  `daya` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `kddk` varchar(12) NOT NULL,
  `no_hp` int(11) NOT NULL,
  `is_new` int(1) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `tarif`, `daya`, `gol`, `alamat`, `kddk`, `no_hp`, `is_new`, `id_unit`, `id_petugas`) VALUES
(123, 'Asep', 'B1', 31000, 0, 'apa aja', '123', 123, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `is_petugas_khusus` int(1) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `level`, `is_petugas_khusus`, `id_unit`, `last_login`) VALUES
(1, 'Samsul', 'samsul', '00161aa5a5fc922918e4fcc155f6043d', 'petugas', 0, 1, '2023-09-24 14:46:32'),
(2, 'Arman', 'arman', '89dfdb53b820990c2663317dffea8a4c', 'petugas', 0, 1, '2023-09-24 14:46:32'),
(3, 'Marcel', 'marcel', '41c2fe9c8f8f015d08f9dc41f69d5a2a', 'petugas', 1, 1, '2023-09-24 14:46:32'),
(4, 'Satar', 'satar', 'ba4ed8aab0f900feb58811c980d43dac', 'petugas', 1, 1, '2023-09-24 14:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `rp_kategori`
--

CREATE TABLE `rp_kategori` (
  `id_rp_kategori` int(11) NOT NULL,
  `nama_rp_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rp_kategori`
--

INSERT INTO `rp_kategori` (`id_rp_kategori`, `nama_rp_kategori`) VALUES
(1, '1 to 200 ribu'),
(2, 'Rupiah Besar');

-- --------------------------------------------------------

--
-- Table structure for table `tusbung_harian`
--

CREATE TABLE `tusbung_harian` (
  `id_tusbung_harian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_tusbung` date NOT NULL,
  `is_evidence` int(1) NOT NULL,
  `id_jenis_kendala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tusbung_harian`
--

INSERT INTO `tusbung_harian` (`id_tusbung_harian`, `id_pelanggan`, `tgl_tusbung`, `is_evidence`, `id_jenis_kendala`) VALUES
(1, 123, '2023-09-24', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tusbung_kumulatif`
--

CREATE TABLE `tusbung_kumulatif` (
  `id_tusbung_kumulatif` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `lbr` int(1) NOT NULL,
  `rptag` int(11) NOT NULL,
  `is_lunas` int(1) NOT NULL,
  `tgl_lunas` date NOT NULL,
  `id_jenis_kendala` int(11) NOT NULL,
  `id_rp_kategori` int(11) NOT NULL,
  `id_petugas_khusus` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tusbung_kumulatif`
--

INSERT INTO `tusbung_kumulatif` (`id_tusbung_kumulatif`, `id_pelanggan`, `lbr`, `rptag`, `is_lunas`, `tgl_lunas`, `id_jenis_kendala`, `id_rp_kategori`, `id_petugas_khusus`, `bulan`, `tahun`) VALUES
(4, 123, 1, 123000, 0, '0000-00-00', 3, 1, 0, 1, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama_unit`) VALUES
(0, 'All'),
(1, 'Manokwari'),
(2, 'Bintuni'),
(3, 'Prafi'),
(4, 'Wasiorr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_id_unit_admin` (`id_unit`) USING BTREE;

--
-- Indexes for table `jenis_kendala`
--
ALTER TABLE `jenis_kendala`
  ADD PRIMARY KEY (`id_jenis_kendala`);

--
-- Indexes for table `kendala_harian`
--
ALTER TABLE `kendala_harian`
  ADD PRIMARY KEY (`id_kendala_harian`),
  ADD KEY `fk_id_pengguna_kendala` (`id_petugas`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `fk_id_unit_pelanggan` (`id_unit`),
  ADD KEY `fk_id_petugas_pelanggan` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `fk_id_unit_petugas` (`id_unit`);

--
-- Indexes for table `rp_kategori`
--
ALTER TABLE `rp_kategori`
  ADD PRIMARY KEY (`id_rp_kategori`);

--
-- Indexes for table `tusbung_harian`
--
ALTER TABLE `tusbung_harian`
  ADD PRIMARY KEY (`id_tusbung_harian`),
  ADD KEY `fk_id_pelanggan_th` (`id_pelanggan`),
  ADD KEY `fk_id_jkendala_th` (`id_jenis_kendala`);

--
-- Indexes for table `tusbung_kumulatif`
--
ALTER TABLE `tusbung_kumulatif`
  ADD PRIMARY KEY (`id_tusbung_kumulatif`),
  ADD KEY `fk_id_pelanggan_tk` (`id_pelanggan`),
  ADD KEY `fk_id_jkendala_tk` (`id_jenis_kendala`),
  ADD KEY `fk_id_rp_kategori_tk` (`id_rp_kategori`),
  ADD KEY `id_petugas_khusus` (`id_petugas_khusus`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_kendala`
--
ALTER TABLE `jenis_kendala`
  MODIFY `id_jenis_kendala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kendala_harian`
--
ALTER TABLE `kendala_harian`
  MODIFY `id_kendala_harian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rp_kategori`
--
ALTER TABLE `rp_kategori`
  MODIFY `id_rp_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tusbung_harian`
--
ALTER TABLE `tusbung_harian`
  MODIFY `id_tusbung_harian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tusbung_kumulatif`
--
ALTER TABLE `tusbung_kumulatif`
  MODIFY `id_tusbung_kumulatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_id_unit_admin` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON UPDATE NO ACTION;

--
-- Constraints for table `kendala_harian`
--
ALTER TABLE `kendala_harian`
  ADD CONSTRAINT `fk_id_pengguna_kendala` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON UPDATE NO ACTION;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_id_petugas_pelanggan` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_unit_pelanggan` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON UPDATE NO ACTION;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `fk_id_unit_petugas` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON UPDATE NO ACTION;

--
-- Constraints for table `tusbung_harian`
--
ALTER TABLE `tusbung_harian`
  ADD CONSTRAINT `fk_id_jkendala_th` FOREIGN KEY (`id_jenis_kendala`) REFERENCES `jenis_kendala` (`id_jenis_kendala`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_pelanggan_th` FOREIGN KEY (`id_pelanggan`) REFERENCES `tusbung_kumulatif` (`id_pelanggan`) ON UPDATE NO ACTION;

--
-- Constraints for table `tusbung_kumulatif`
--
ALTER TABLE `tusbung_kumulatif`
  ADD CONSTRAINT `fk_id_jkendala_tk` FOREIGN KEY (`id_jenis_kendala`) REFERENCES `jenis_kendala` (`id_jenis_kendala`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_pelanggan_tk` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_rp_kategori_tk` FOREIGN KEY (`id_rp_kategori`) REFERENCES `rp_kategori` (`id_rp_kategori`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
