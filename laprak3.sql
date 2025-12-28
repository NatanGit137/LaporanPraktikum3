-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2025 pada 16.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laprak3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `idnilai`
--

CREATE TABLE `idnilai` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nim` int(11) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `tugas` int(11) NOT NULL,
  `uts` int(11) NOT NULL,
  `uas` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `idnilai`
--

INSERT INTO `idnilai` (`id`, `nama`, `nim`, `kehadiran`, `tugas`, `uts`, `uas`, `grade`, `status`) VALUES
(1, 'a', 12, 80, 80, 70, 65, 'B', 'LULUS...'),
(3, 'b', 13, 80, 70, 80, 90, 'B', 'LULUS...'),
(4, 'b', 13, 80, 70, 80, 90, 'B', 'LULUS...');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `idnilai`
--
ALTER TABLE `idnilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `idnilai`
--
ALTER TABLE `idnilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
