-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2023 at 05:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donasiku`
--
CREATE DATABASE IF NOT EXISTS `donasiku` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `donasiku`;

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE IF NOT EXISTS `donasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `id_komunitas` int DEFAULT NULL,
  `nominal` decimal(50,0) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `waktu_donasi` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_komunitas` (`id_komunitas`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE IF NOT EXISTS `komunitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `profil` text,
  `visi` text,
  `misi` text,
  `laporan_keuangan` decimal(50,0) DEFAULT '0',
  `laporan_kegiatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `jumlah_donatur` int DEFAULT '0',
  `jumlah_donasi` decimal(50,0) NOT NULL DEFAULT '0',
  `jumlah_penerima_manfaat` int DEFAULT '0',
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id`, `nama`, `profil`, `visi`, `misi`, `laporan_keuangan`, `laporan_kegiatan`, `jumlah_donatur`, `jumlah_donasi`, `jumlah_penerima_manfaat`, `status`) VALUES
(19, 'pembuatan lahan parkir di UNISKA Banjarmasin', 'test.png', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias consequuntur sed facilis harum, expedita id debitis, eveniet rerum voluptatem labore amet numquam! Laborum expedita velit consectetur aliquam, blanditiis quasi totam?', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias consequuntur sed facilis harum, expedita id debitis, eveniet rerum voluptatem labore amet numquam! Laborum expedita velit consectetur aliquam, blanditiis quasi totam?', '500000000', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias consequuntur sed facilis harum, expedita id debitis, eveniet rerum voluptatem labore amet numquam! Laborum expedita velit consectetur aliquam, blanditiis quasi totam?', 0, '0', 1000, 'terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `password`) VALUES
(5, 'adminganteng', 'admin', 'a775f932270c86ade4f50d81ce55965a54d5f24f3918fccdda7f5363f89c84d8');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
