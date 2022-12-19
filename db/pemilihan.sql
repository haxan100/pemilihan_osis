-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2022 pada 02.36
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemilihan`
--
CREATE DATABASE IF NOT EXISTS `pemilihan` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pemilihan`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(1) NOT NULL DEFAULT 0 COMMENT '0 untuk admin biasa 1 untuk superadmin',
  `no_telpon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `id_role`, `no_telpon`) VALUES
(1, 'aku', 'hasan', 'hasan', 0, '48274839743289'),
(2, 'kepsek', 'admin', 'admin123', 0, '111'),
(5, 'baru', 'abdul', 'abdul', 1, '2'),
(7, 'kepsek00', 'adminsajaoke', 'adminsajaoke', 0, '111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_bem`
--

DROP TABLE IF EXISTS `calon_bem`;
CREATE TABLE `calon_bem` (
  `id_calon` int(11) NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `moto` varchar(255) NOT NULL,
  `visi` varchar(255) NOT NULL,
  `nim` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon_bem`
--

INSERT INTO `calon_bem` (`id_calon`, `nama_calon`, `foto`, `moto`, `visi`, `nim`, `total`) VALUES
(16, 'bem satu', 'bem 2', 'bem 2', 'bem 2', 2, 3),
(17, 'bem dua', '17-2022-12-15-11-11-45.jpg', 'fewfewfew3234', 'dfwddsfd', 0, 5),
(18, 'bem tiga', 'bem 2', 'bem 2', 'bem 2', 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_dpm`
--

DROP TABLE IF EXISTS `calon_dpm`;
CREATE TABLE `calon_dpm` (
  `id_calon` int(11) NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `moto` varchar(255) NOT NULL,
  `visi` varchar(255) NOT NULL,
  `nim` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon_dpm`
--

INSERT INTO `calon_dpm` (`id_calon`, `nama_calon`, `foto`, `moto`, `visi`, `nim`, `total`, `prodi`) VALUES
(22, 'hasan', '23143-2022-12-15-15-00-44.jpg', 'wdwd', 'qwdwd', 23143, 2, 'Teknik Informatika'),
(23, 'abdul', '23143-2022-12-15-15-00-44.jpg', 'dwdq', 'qwdwdwfeewf', 23143, 5, 'Teknik Informatika'),
(24, 'dalsan', '23143-2022-12-15-15-00-44.jpg', 'wdwd', 'qwdwd', 23143, 2, 'Sastra'),
(25, 'sasdul', '23143-2022-12-15-15-00-44.jpg', 'dwdq', 'qwdwdwfeewf', 23143, 5, 'Sastra'),
(26, '345', '456345-2022-12-19-08-20-46.jpg', '54', '345', 456345, 0, 'Teknik Informatika'),
(27, 'sdfswd', '234-2022-12-19-08-21-10.jpg', 'wfefewfew', 'fwfwfw', 234, 0, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Teknik Informatika'),
(2, 'Sastra'),
(3, 'Teknologi katulistiwa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `mulai` datetime DEFAULT NULL,
  `akhir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `mulai`, `akhir`) VALUES
(1, '2022-12-13 16:19:00', '2023-01-13 16:19:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id_siswa` int(6) NOT NULL,
  `nim` char(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `angkatan` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `foto_ktm` varchar(255) NOT NULL,
  `foto_diri` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pilih_bem` int(11) NOT NULL DEFAULT 0,
  `sudah_milih_bem` int(1) NOT NULL DEFAULT 0,
  `waktu_milih_bem` datetime DEFAULT NULL,
  `pilih_dpm` int(11) DEFAULT NULL,
  `sudah_milih_dpm` int(11) DEFAULT NULL,
  `waktu_milih_dpm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nim`, `nama`, `angkatan`, `prodi`, `foto_ktm`, `foto_diri`, `password`, `pilih_bem`, `sudah_milih_bem`, `waktu_milih_bem`, `pilih_dpm`, `sudah_milih_dpm`, `waktu_milih_dpm`) VALUES
(60, '1', 'terisi', '', '', '', '', 'siswa1', 12, 1, '2021-09-04 01:47:18', NULL, NULL, NULL),
(61, '2', 'siswa2', '', '', '', '', 'siswa2', 11, 1, '2021-09-04 01:48:07', NULL, NULL, NULL),
(62, '3', 'siswa3', '', '', '', '', 'siswa3', 13, 1, '2021-09-04 01:50:40', NULL, NULL, NULL),
(63, '4', 'siswa4', '', '', '', '', 'siswa4', 0, 0, NULL, NULL, NULL, NULL),
(64, '5', 'siswa5', '', '', '', '', 'siswa5', 0, 0, NULL, NULL, NULL, NULL),
(65, '6', 'siswa6', '', '', '', '', 'siswa6', 0, 0, NULL, NULL, NULL, NULL),
(66, '7', 'siswa7', '', '', '', '', 'siswa7', 0, 0, NULL, NULL, NULL, NULL),
(67, '8', 'siswa8', '', '', '', '', 'siswa8', 0, 0, NULL, NULL, NULL, NULL),
(68, '9', 'siswa9', '', '', '', '', 'siswa9', 0, 0, NULL, NULL, NULL, NULL),
(69, '10', 'siswa10', '', '', '', '', 'siswa10', 0, 0, NULL, NULL, NULL, NULL),
(70, '1233', 'wado', '', '', '', '', 'abdul', 0, 0, NULL, NULL, NULL, NULL),
(71, '12345', 'adi', '', '', '', '', '12345', 12, 1, '2021-09-04 02:37:52', NULL, NULL, NULL),
(73, '313544', 'Tes', '', '', '', '', '1', 0, 0, NULL, NULL, NULL, NULL),
(74, '6qwr', 'terisi', 'terisi', 'wd', 'coverwR9RPkCXNz.jpg', 'coverD8zo8nq5oj.jpg', 'MTUxMjIwMjJ2UjI4VG01R00yTm5QVDA9Mjk1MzA5', 0, 0, NULL, NULL, NULL, NULL),
(75, '12345234', 'terisi', 'terisi', 'wd2343', 'coverB3m8MIYmAc.jpg', 'coverw7F9qWNaJA.jpg', 'MTUxMjIwMjJISllQVFZSSmVrNUVWWGxOZWxGNVRYcFJQUT09MjUwMjEw', 0, 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `calon_bem`
--
ALTER TABLE `calon_bem`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indeks untuk tabel `calon_dpm`
--
ALTER TABLE `calon_dpm`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_siswa_2` (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `calon_bem`
--
ALTER TABLE `calon_bem`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `calon_dpm`
--
ALTER TABLE `calon_dpm`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
