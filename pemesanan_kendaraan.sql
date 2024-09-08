-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 12:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan_kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `tipe` enum('barang','penumpang') NOT NULL,
  `penyewaan` enum('yes','no') NOT NULL,
  `BBM` decimal(10,0) NOT NULL,
  `servis` date NOT NULL,
  `riwayat_pemakaian` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `tipe`, `penyewaan`, `BBM`, `servis`, `riwayat_pemakaian`, `created_at`) VALUES
(1, 'barang', 'yes', 10, '2024-09-06', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-09-06 13:05:21'),
(2, 'penumpang', 'no', 10, '2024-09-04', 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', '2024-09-06 13:05:21'),
(3, 'barang', '', 21, '0000-00-00', '', '2024-09-06 21:34:17'),
(4, 'penumpang', '', 21, '0000-00-00', '', '2024-09-06 21:37:57'),
(5, 'penumpang', '', 12, '2024-09-30', 'lecet sebagian', '2024-09-06 21:40:54'),
(6, 'barang', 'yes', 10, '2024-10-01', 'lecet', '2024-09-07 06:29:41'),
(7, 'barang', 'yes', 13, '2024-09-27', 'lancar', '2024-09-08 02:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_persetujuan` int(11) NOT NULL,
  `pengemudi` varchar(255) NOT NULL,
  `status` enum('tertunda','disetujui','ditolak') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_kendaraan`, `id_users`, `id_persetujuan`, `pengemudi`, `status`, `created_at`) VALUES
(34, 5, 2, 2, 'didir', 'ditolak', '2024-09-08 03:05:46'),
(35, 1, 2, 2, 'viqo', 'disetujui', '2024-09-08 04:21:06'),
(36, 1, 1, 2, 'supri', '', '2024-09-08 06:43:25'),
(37, 5, 3, 3, 'galih', 'tertunda', '2024-09-08 06:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `persetujuan`
--

CREATE TABLE `persetujuan` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_persetujuan` int(11) NOT NULL,
  `level` enum('Level 1','level 2','','') NOT NULL,
  `status` enum('tertunda','disetujui','ditolak') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persetujuan`
--

INSERT INTO `persetujuan` (`id`, `id_pemesanan`, `id_persetujuan`, `level`, `status`, `created_at`) VALUES
(6, 34, 2, 'Level 1', 'ditolak', '2024-09-08 03:05:46'),
(7, 35, 2, 'Level 1', 'disetujui', '2024-09-08 04:21:06'),
(8, 36, 2, 'Level 1', '', '2024-09-08 06:43:25'),
(9, 37, 3, 'Level 1', '', '2024-09-08 06:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','approver') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'messi', '25d55ad283aa400af464c76d713c07ad', 'admin', '2024-09-06 13:00:23'),
(2, 'kaka', '25d55ad283aa400af464c76d713c07ad', 'approver', '2024-09-06 13:00:23'),
(3, 'farel', '25d55ad283aa400af464c76d713c07ad', 'approver', '2024-09-07 08:10:25'),
(4, 'Admin2', '25d55ad283aa400af464c76d713c07ad', 'admin', '2024-09-08 02:18:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `persetujuan`
--
ALTER TABLE `persetujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
