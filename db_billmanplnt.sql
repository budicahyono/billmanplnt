-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 08:23 PM
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
(1, 'Admin Utama', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 0, 0, '2023-11-05 19:39:57'),
(2, 'Manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager', 0, 0, '2023-10-02 21:17:40'),
(8, 'Admin Tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'admin', 0, 0, '2023-10-02 21:10:53');

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
(0, ' '),
(1, 'JANJI BAYAR'),
(2, 'PAGAR TERKUNCI'),
(5, 'VIA WA'),
(6, 'TIDAK ADA ORANG'),
(7, 'RUMAH TUTUP'),
(8, 'PLG MARAH'),
(9, 'TITIP LUNAS'),
(10, 'PUTUS'),
(11, 'PUTUS FUDING'),
(12, 'METER BONGKAR'),
(13, 'MIGRASI'),
(14, 'DIGUSUR'),
(15, 'K3 TIDAK DAPAT'),
(16, 'SEGEL'),
(17, 'RUMAH KOSONG'),
(18, 'PUTUS SR'),
(19, 'METER TINGGI'),
(20, 'METER DALAM BANGUNAN'),
(21, 'UANG KURANG'),
(22, 'MASIH KOORDINASI'),
(23, 'PLG OPNAME'),
(24, 'PLG KOMPLAIN'),
(25, 'METER TIDAK KETEMU'),
(26, 'RUMAH GUSUR'),
(27, 'METER TERBAKAR'),
(28, 'LUNAS');

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
  `id_pelanggan` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `tarif` varchar(2) NOT NULL,
  `daya` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `kddk` varchar(12) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `is_new` int(1) NOT NULL,
  `id_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'SAMSUL', 'samsul', '6ddcd35687be9a4415e4416a6dd6829e', '', 0, 1, '0000-00-00 00:00:00'),
(2, 'ARMAN', 'arman', '66059a527018b32e4597dd27574929f6', '', 0, 1, '0000-00-00 00:00:00'),
(8, 'YOSEP', 'yosep', '4f5b3bd0ae0019415565e554ae5f0cfa', '', 0, 1, '0000-00-00 00:00:00'),
(9, 'JHON', 'jhon', '4c25b32a72699ed712dfa80df77fc582', '', 0, 1, '0000-00-00 00:00:00'),
(10, 'SAMSUDIN', 'samsudin', '69ec49b2a3de2c33c27e79cd3bf3d741', '', 0, 1, '0000-00-00 00:00:00'),
(11, 'MORIS', 'moris', '8dbc32e761c3550a43c8734ba6b4cdc2', '', 0, 1, '0000-00-00 00:00:00'),
(12, 'UMAR', 'umar', '92deb3f274aaee236194c05729bfa443', '', 0, 1, '0000-00-00 00:00:00'),
(13, 'ALAN', 'alan', '02558a70324e7c4f269c69825450cec8', '', 0, 1, '0000-00-00 00:00:00'),
(14, 'MARWAN', 'marwan', '8c844d9ae507bdfd8e790589ed682aa9', '', 0, 1, '0000-00-00 00:00:00'),
(15, 'MARCEL', 'marcel', '24dde05168c24253ce9fec0fddd1e48d', '', 1, 1, '0000-00-00 00:00:00'),
(16, 'SATAR', 'satar', '77a20b08c3bb4bae35c269ed45589199', '', 1, 1, '0000-00-00 00:00:00'),
(17, 'BADRULLAH', 'badrullah', '1b7fee6aeee608fff680a7457360b74d', '', 0, 2, '0000-00-00 00:00:00'),
(18, 'RONALD', 'ronald', '5af0a0feb2094f43bebb50c518c1ebfe', '', 0, 2, '0000-00-00 00:00:00'),
(19, 'ADI', 'adi', 'f2ed69ecc189681d2e82c61433891712', '', 0, 4, '0000-00-00 00:00:00'),
(20, 'ALVIN', 'alvin', 'ba2c38866f918aec5ff232bb41fc5c16', '', 0, 4, '0000-00-00 00:00:00'),
(21, 'RICKY', 'ricky', 'c065f6c93b73b084bc2d125620173057', '', 0, 3, '0000-00-00 00:00:00'),
(22, 'LISDES', 'lisdes', 'ae7a643b45e2b396317e3cd895be3032', '', 0, 3, '0000-00-00 00:00:00'),
(24, 'NON PETUGAS', 'non', 'e3af4fb47bf8564fe8a71bbc989e5046', '', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rp_kategori`
--

CREATE TABLE `rp_kategori` (
  `id_rp_kategori` int(11) NOT NULL,
  `nama_rp_kategori` varchar(100) NOT NULL,
  `rp_bawah` int(11) NOT NULL,
  `rp_atas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rp_kategori`
--

INSERT INTO `rp_kategori` (`id_rp_kategori`, `nama_rp_kategori`, `rp_bawah`, `rp_atas`) VALUES
(1, '1-200 Ribu', 1, 200000),
(2, '200-500 Ribu', 200001, 500000),
(3, '500 Ribu-1 Juta', 500001, 1000000),
(4, 'Rupiah Besar', 1000001, 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `tusbung_harian`
--

CREATE TABLE `tusbung_harian` (
  `id_tusbung_harian` int(11) NOT NULL,
  `id_pelanggan` varchar(12) NOT NULL,
  `tgl_tusbung` date NOT NULL,
  `is_evidence` int(1) NOT NULL,
  `id_jenis_kendala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tusbung_kumulatif`
--

CREATE TABLE `tusbung_kumulatif` (
  `id_tusbung_kumulatif` int(11) NOT NULL,
  `id_pelanggan` varchar(12) NOT NULL,
  `lbr` int(1) NOT NULL,
  `rptag` int(11) NOT NULL,
  `rbk` int(11) NOT NULL,
  `is_lunas` int(1) NOT NULL,
  `tgl_lunas` date NOT NULL,
  `id_jenis_kendala` int(11) NOT NULL,
  `id_rp_kategori` int(11) NOT NULL,
  `id_petugas_khusus` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(0, 'ALL'),
(1, 'MANOKWARI'),
(2, 'BINTUNI'),
(3, 'WASIOR'),
(4, 'PRAFI');

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
  ADD KEY `fk_id_unit_pelanggan` (`id_unit`);

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
  ADD KEY `fk_id_jkendala_th` (`id_jenis_kendala`),
  ADD KEY `fk_id_pelanggan_th` (`id_pelanggan`);

--
-- Indexes for table `tusbung_kumulatif`
--
ALTER TABLE `tusbung_kumulatif`
  ADD PRIMARY KEY (`id_tusbung_kumulatif`),
  ADD KEY `fk_id_jkendala_tk` (`id_jenis_kendala`),
  ADD KEY `fk_id_rp_kategori_tk` (`id_rp_kategori`),
  ADD KEY `id_petugas_khusus` (`id_petugas_khusus`),
  ADD KEY `fk_id_pelanggan_tk` (`id_pelanggan`),
  ADD KEY `fk_id_petugas_tk` (`id_petugas`) USING BTREE;

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jenis_kendala`
--
ALTER TABLE `jenis_kendala`
  MODIFY `id_jenis_kendala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kendala_harian`
--
ALTER TABLE `kendala_harian`
  MODIFY `id_kendala_harian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rp_kategori`
--
ALTER TABLE `rp_kategori`
  MODIFY `id_rp_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tusbung_harian`
--
ALTER TABLE `tusbung_harian`
  MODIFY `id_tusbung_harian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tusbung_kumulatif`
--
ALTER TABLE `tusbung_kumulatif`
  MODIFY `id_tusbung_kumulatif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  ADD CONSTRAINT `fk_id_pelanggan_th` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE NO ACTION;

--
-- Constraints for table `tusbung_kumulatif`
--
ALTER TABLE `tusbung_kumulatif`
  ADD CONSTRAINT `fk_id_jkendala_tk` FOREIGN KEY (`id_jenis_kendala`) REFERENCES `jenis_kendala` (`id_jenis_kendala`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_pelanggan_tk` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_petugas_tk` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_rp_kategori_tk` FOREIGN KEY (`id_rp_kategori`) REFERENCES `rp_kategori` (`id_rp_kategori`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
