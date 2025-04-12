-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 01:42 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_merch`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `stock` int(20) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `deskripsi`, `stock`, `harga_jual`, `harga_beli`, `foto`, `tanggal_masuk`) VALUES
(1, 'Hatsune Miku', 'collection of Hasune Miku', 0, '200000.00', '50000.00', '2048175373_nendroid5.jpg', '2024-10-28'),
(2, 'Zenitsu', 'zenitsu kimetsu no yaiba figure', 1, '250000.00', '100000.00', '1488226074_nendro4.jpg', '2024-10-28'),
(3, 'Nendroid No. 1', 'Pajangan', 6, '150000.00', '50000.00', '2133467236_nendroid1.jpg', '2024-10-28'),
(4, 'ambalabu', 'limited edition', 0, '999000.00', '100000.00', '424775403_ambalabu.jpg', '2024-10-28'),
(5, 'Nendroid No. 2', 'pajangan', 7, '300000.00', '150000.00', '1539440723_nendro1.jpg', '2024-10-28'),
(6, 'Nendroid No. 4', 'pajangan', 10, '100000.00', '50000.00', '2145114348_nendro3.jpg', '2024-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(20) NOT NULL,
  `id_transaksi` int(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `uang_masuk` decimal(10,2) NOT NULL,
  `kembalian` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_transaksi`, `id_barang`, `jumlah`, `harga`, `tanggal_transaksi`, `uang_masuk`, `kembalian`) VALUES
(16, 29, 3, 3, '150000.00', '2024-10-29', '700000.00', '50000.00'),
(18, 30, 2, 5, '250000.00', '2024-10-30', '1300000.00', '51000.00'),
(23, 32, 4, 1, '999000.00', '2024-10-30', '1300000.00', '51000.00');

-- --------------------------------------------------------

--
-- Table structure for table `data_pribadi`
--

CREATE TABLE `data_pribadi` (
  `id_data` int(20) NOT NULL,
  `id_akun` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `gmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pribadi`
--

INSERT INTO `data_pribadi` (`id_data`, `id_akun`, `nama`, `tanggal_lahir`, `jk`, `alamat`, `no_telp`, `gmail`) VALUES
(1, 2, 'rehan', '2024-10-29', 'Laki-laki', 'on my heart', '45678', 'avicennaa@gmail.com'),
(2, 3, 'syafira', '2024-10-30', 'Perempuan', 'komplek perdagangan', '089507454580', 'islamiadhaa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(20) NOT NULL,
  `id_transaksi` int(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_barang`, `jumlah`, `harga`) VALUES
(17, 29, 3, 3, '150000.00'),
(19, 30, 2, 5, '250000.00'),
(24, 32, 4, 1, '999000.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(20) NOT NULL,
  `id_akun` int(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `uang_masuk` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_akun`, `tanggal_transaksi`, `total_harga`, `uang_masuk`) VALUES
(29, 2, '2024-10-29', '400000.00', '400000.00'),
(30, 2, '2024-10-29', '400000.00', '500000.00'),
(31, 2, '2024-10-29', '650000.00', '700000.00'),
(32, 3, '2024-10-30', '1249000.00', '1300000.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_akun` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tanggal_regis` date NOT NULL,
  `roles` enum('pengguna','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_akun`, `username`, `password`, `tanggal_regis`, `roles`) VALUES
(1, 'admin_nabila', 'sicantik', '2024-10-29', 'admin'),
(2, 'pookie', '123', '2024-10-28', 'pengguna'),
(3, 'islamiadhaa', '123', '2024-10-30', 'pengguna');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`),
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indexes for table `data_pribadi`
--
ALTER TABLE `data_pribadi`
  ADD PRIMARY KEY (`id_data`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`),
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `data_pribadi`
--
ALTER TABLE `data_pribadi`
  MODIFY `id_data` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_akun` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pribadi`
--
ALTER TABLE `data_pribadi`
  ADD CONSTRAINT `data_pribadi_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `user` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
