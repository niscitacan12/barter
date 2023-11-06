-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 03:26 AM
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
-- Database: `excabsensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `keterangan_izin` varchar(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `status` varchar(10) NOT NULL,
  `lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `id_organisasi` int(11) NOT NULL,
  `nama_organisasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `email_organisasi` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`id_organisasi`, `nama_organisasi`, `alamat`, `nomor_telepon`, `email_organisasi`, `kecamatan`, `kabupaten`, `provinsi`) VALUES
(1, 'smk', 'jl', '0987543678', 'smk@gmail.com', 'bergas', 'semarang', 'jawa tengah'),
(2, 'jhguifdg', 'dsgdgfh', '12344', 'a@gmail.com', 'dsgdhg', 'fdhgfh', 'gfhgfdh'),
(3, 'Excelent', 'Salatiga', '08974857454', 'exc@gmail.com', 'Salatiga', 'Semarang', 'Jateng'),
(4, 'MTs H M Subandi', 'Jl.kyai gandek Gandekan', '0812345678', 'subandi@gmail.com', 'Bawen', 'Semarang', 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_organisasi` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `nama_depan`, `nama_belakang`, `password`, `image`, `id_admin`, `id_superadmin`, `id_organisasi`, `role`) VALUES
(1, 'dewi@gmail.com', 'dewi', 'dewi', 'pulung', '25d55ad283aa400af464c76d713c07ad', '', 0, 0, 0, 'superadmin'),
(2, 'aveceena@gmail.com', 'ave', 'aveceena', 'ming', '25d55ad283aa400af464c76d713c07ad', '', 0, 1, 1, 'admin'),
(3, 'dhani@gmail.com', 'dhani', 'dhani', 'dhan', '25d55ad283aa400af464c76d713c07ad', '', 2, 1, 1, 'user'),
(4, 'niki@gmail.com', 'niki12', 'niki', 'kirana', '25d55ad283aa400af464c76d713c07ad', 'User.png', 0, 0, 0, 'user'),
(9, 'aruna@gmail.com', 'runaa', 'aruna', 'maida', '25d55ad283aa400af464c76d713c07ad', 'User.png', 0, 1, 3, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `absensi_ibfk_1` (`id_user`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`id_organisasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `user_ibfk_1` (`id_organisasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `id_organisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_organisasi`) REFERENCES `organisasi` (`id_organisasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
