-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Jan 2017 pada 05.23
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_catering`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_nama`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `costumer`
--

CREATE TABLE `costumer` (
  `costumer_id` int(5) NOT NULL,
  `costumer_username` varchar(100) NOT NULL,
  `costumer_password` varchar(100) NOT NULL,
  `costumer_nama` varchar(100) NOT NULL,
  `costumer_notelp` varchar(20) NOT NULL,
  `costumer_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `costumer`
--

INSERT INTO `costumer` (`costumer_id`, `costumer_username`, `costumer_password`, `costumer_nama`, `costumer_notelp`, `costumer_alamat`) VALUES
(1, 'nava', '533078acd91fffef2a525239de4a3dc9', 'Nava Gia Ginasta', '087820033395', 'Bandung'),
(5, 'anggi', '4a283e1f5eb8628c8631718fe87f5917', 'Anggi Sholihatus Sadiah', '087820033392', 'Bandung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(5) NOT NULL,
  `menu_nama` varchar(100) NOT NULL,
  `menu_harga` int(50) NOT NULL,
  `menu_deskripsi` text NOT NULL,
  `menu_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_nama`, `menu_harga`, `menu_deskripsi`, `menu_foto`) VALUES
(1, 'Paket A', 200000, 'Asin, Ampela, Daging', 'menu1.jpg'),
(2, 'Paket B', 300000, 'Asin, Ampela, Daging', 'menu1.jpg'),
(3, 'Paket C', 20000, 'Asin,Ampela,Daging', 'menu1.jpg'),
(9, 'Paket D', 300000, 'Sambel, Ampela, Nasi, Tempe', '1483671632-2.jpg'),
(10, 'Paket E', 20000, 'Sambel, Ampela, Nasi, Tempe', '1483671670-1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(5) NOT NULL,
  `pembayaran_tanggal` date NOT NULL,
  `pembayaran_jumlah` varchar(100) NOT NULL,
  `pembayaran_status` varchar(200) NOT NULL,
  `pemesanan_id` int(5) NOT NULL,
  `costumer_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_id`, `pembayaran_tanggal`, `pembayaran_jumlah`, `pembayaran_status`, `pemesanan_id`, `costumer_id`) VALUES
(4, '2017-01-07', '20000', 'Tunai', 3, 5),
(5, '2017-02-13', '1000', 'Tunai', 3, 5),
(6, '2017-01-13', '300000', 'TRANSPER', 3, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(5) NOT NULL,
  `pemesanan_tanggal` date NOT NULL,
  `pemesanan_acara` text NOT NULL,
  `pemesanan_tempat` varchar(100) NOT NULL,
  `pemesanan_status` enum('N','Y') NOT NULL DEFAULT 'N',
  `costumer_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_id`, `pemesanan_tanggal`, `pemesanan_acara`, `pemesanan_tempat`, `pemesanan_status`, `costumer_id`) VALUES
(3, '2017-01-06', 'ULTAH NAVA', 'Bandung', 'N', 5),
(14, '2017-01-06', 'Syukuran', 'Cianjur', 'Y', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `detail_id` int(5) NOT NULL,
  `detail_jumlah` varchar(50) NOT NULL,
  `detail_harga` varchar(50) NOT NULL,
  `detail_total` varchar(50) NOT NULL,
  `menu_id` int(5) NOT NULL,
  `pemesanan_id` int(5) NOT NULL,
  `costumer_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`detail_id`, `detail_jumlah`, `detail_harga`, `detail_total`, `menu_id`, `pemesanan_id`, `costumer_id`) VALUES
(5, '2', '300000', '600000', 2, 3, 5),
(6, '2', '200000', '400000', 1, 3, 5),
(9, '2', '20000', '40000', 3, 3, 5),
(14, '60', '200000', '12000000', 1, 14, 1),
(15, '10', '300000', '3000000', 9, 14, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('993846f75356a4b1eeeb6a721d6331ca', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.7.2883.75 Safari/537.36', 1484367742, 'a:7:{s:9:"user_data";s:0:"";s:14:"admin_username";s:5:"admin";s:14:"admin_password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:17:"costumer_username";s:4:"nava";s:17:"costumer_password";s:32:"533078acd91fffef2a525239de4a3dc9";s:13:"costumer_nama";s:16:"Nava Gia Ginasta";s:10:"logged_in2";b:1;}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`costumer_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`);

--
-- Indexes for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `costumer`
--
ALTER TABLE `costumer`
  MODIFY `costumer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  MODIFY `detail_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
