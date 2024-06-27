-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 03:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cleaning_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `absen_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `filename`, `absen_at`) VALUES
(3, 1, 'uploads/6666b89fe200f.png', '2024-06-08 15:26:07'),
(4, 1, 'uploads/6666c7b4b5834.png', '2024-06-10 16:30:28'),
(5, 1, 'uploads/6667caa103ac8.png', '2024-06-07 10:55:13'),
(6, 1, 'uploads/6667d57b57685.png', '2024-06-11 11:41:31'),
(7, 1, 'uploads/666bc5a632891.png', '2024-06-14 11:23:02'),
(8, 1, 'uploads/6671087118cb4.png', '2024-06-18 07:09:21'),
(9, 1, 'uploads/66723727a5207.png', '2024-06-19 07:40:55'),
(10, 1, 'uploads/6674de2a3e355.png', '2024-06-21 08:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `image_tugas_harian`
--

CREATE TABLE `image_tugas_harian` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0 = sebelum,\r\n1 = sesudah,\r\n2 = komplain',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_tugas_harian`
--

INSERT INTO `image_tugas_harian` (`id`, `tugas_id`, `filename`, `status`, `created_at`) VALUES
(1, 1, 'uploads/6667ca6428303.png', 0, '2024-06-11 10:54:12'),
(2, 3, 'uploads/6667ca7278a2d.png', 0, '2024-06-11 10:54:26'),
(3, 3, 'uploads/6667ca8e7ab17.png', 1, '2024-06-11 10:54:54'),
(5, 1, 'uploads/666a9bf9076c2.png', 1, '2024-06-13 14:12:57'),
(6, 2, 'uploads/666bf4deb3c35.png', 0, '2024-06-14 14:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `followup` varchar(100) NOT NULL DEFAULT '-',
  `status` tinyint(1) NOT NULL COMMENT '0 = bersih,\r\n1 = kurang bersih,\r\n2 = kotor',
  `catatan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`id`, `nama`, `tugas_id`, `filename`, `followup`, `status`, `catatan`, `created_at`) VALUES
(3, 'doni', 3, 'uploads/666a9b5fc88b0.png', 'uploads/667150372c42d.png', 0, 'jendela kotor', '2024-06-13 14:10:23'),
(4, 'koni', 3, 'uploads/666a9bcdba588.png', '-', 2, 'jendela kotor', '2024-06-13 14:12:13'),
(5, 'loni', 1, 'uploads/666a9c1554247.png', 'uploads/6670ee939db7b.png', 0, 'lantai masih kotor', '2024-06-13 14:13:25'),
(6, 'honi', 1, 'uploads/666bafb3c1359.png', 'uploads/6670f469269dd.png', 0, 'aaaaaaaaaaaaaaaaaaa', '2024-06-14 09:49:23'),
(7, 'biibkbk', 1, 'uploads/666bf5223f506.png', 'uploads/6670f47e527c4.png', 0, 'fvygbhni', '2024-06-14 14:45:38'),
(8, 'bonin', 3, 'uploads/667275f02da4e.png', '-', 1, 'debu', '2024-06-19 13:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_harian`
--

CREATE TABLE `tugas_harian` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas_harian`
--

INSERT INTO `tugas_harian` (`id`, `lokasi`, `details`) VALUES
(1, 'Melawai 10 Lt.3', 'Lantai sudah di pel dengan bersih'),
(2, 'Melawai 10 Lt.3', 'Semua Air Minum karyawan sudah terisi'),
(3, 'Melawai 10 Lt.3', 'Jendela sudah di lap'),
(4, 'Melawai 10 Lt.3', 'Semua tempat sampah dibuang'),
(5, 'Melawai 10 Lt.2', 'Pel Lantai'),
(6, 'Melawai 10 Lt.2', 'Isi dispenser'),
(7, 'Melawai 10 Lt.2', 'Sapu lantai'),
(8, 'Melawai 10 Lt.2', 'Lap jendela'),
(9, 'Melawai 10 Lt.3', 'Bersihin meja');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` text NOT NULL,
  `nik` varchar(60) NOT NULL,
  `jabatan` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `nik`, `jabatan`, `status`) VALUES
(1, 'petugas1', 'pass1', 'Petugas', '123456489', 'Cleaning Service', 1),
(2, 'petugas2', 'pass2', 'Petugas Dua', '23465789', 'Cleaning Service', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `image_tugas_harian`
--
ALTER TABLE `image_tugas_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_harian`
--
ALTER TABLE `tugas_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `image_tugas_harian`
--
ALTER TABLE `image_tugas_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komplain`
--
ALTER TABLE `komplain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tugas_harian`
--
ALTER TABLE `tugas_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `image_tugas_harian`
--
ALTER TABLE `image_tugas_harian`
  ADD CONSTRAINT `image_tugas_harian_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas_harian` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
