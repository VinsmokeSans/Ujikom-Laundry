-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 04:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_paket` int(11) NOT NULL,
  `qty` double NOT NULL,
  `keterangan` text NOT NULL,
  `status_detail` enum('dikeranjang','ditransaksi') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket`, `qty`, `keterangan`, `status_detail`, `id_user`) VALUES
(110, 61, 2, 3, '', 'ditransaksi', 1),
(111, 62, 2, 2, '', 'ditransaksi', 1),
(127, 66, 2, 1, '', 'ditransaksi', 1),
(128, 66, 3, 1, '', 'ditransaksi', 1),
(129, 66, 4, 1, '', 'ditransaksi', 1),
(135, 67, 2, 1, '', 'ditransaksi', 1),
(136, 67, 3, 1, '', 'ditransaksi', 1),
(137, 67, 4, 1, '', 'ditransaksi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(100) NOT NULL,
  `alamat_member` text NOT NULL,
  `jk_member` enum('Laki-Laki','Perempuan') NOT NULL,
  `tlp_member` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nm_member`, `alamat_member`, `jk_member`, `tlp_member`, `id_user`) VALUES
(2, 'Agung Kalam', 'Jakarta', 'Laki-Laki', '026654879', 1),
(3, 'Asep trol', 'jakarta', 'Laki-Laki', '0258545458', 1),
(10, 'Juragan Hp', 'sukabumi', 'Laki-Laki', '2153032', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `nm_outlet` varchar(100) NOT NULL,
  `alamat_outlet` text NOT NULL,
  `tlp_outlet` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `nm_outlet`, `alamat_outlet`, `tlp_outlet`) VALUES
(1, 'outlet1', 'bandung', '0266 235212'),
(2, 'outlet2', 'Sukabumi', '0266 2352222'),
(3, 'Outlet3', 'Sumedang', '023654'),
(6, 'Outlet3', 'Sukamaju', '023654');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `jenis_paket` enum('standar','paketan') NOT NULL,
  `nm_paket` varchar(100) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `deskripsi_paket` text NOT NULL,
  `gambar_paket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `id_outlet`, `jenis_paket`, `nm_paket`, `harga_paket`, `deskripsi_paket`, `gambar_paket`) VALUES
(1, 1, 'standar', 'Kemeja', 3000, 'Kemeja Lengan panjang, pendek dengan berbagai motif', 'bajukemeja.jpg'),
(2, 1, 'paketan', 'A', 25000, 'Paket All Pakaian dengan berat 5 kg.', ''),
(3, 1, 'paketan', 'B', 50000, 'All pakaian dengan total 15kg', ''),
(4, 1, 'paketan', 'C', 75000, 'All selimut dengan berat 10kg', ''),
(5, 1, 'standar', 'Jaket', 7000, 'Levis Lengan panjang, pendek dengan berbagai motif', 'jaketlaundri.jpg'),
(6, 1, 'standar', 'Selimut', 15000, 'Kemeja Lengan panjang, pendek dengan berbagai motif', 'selimut.jpg'),
(7, 1, 'standar', 'Sprei', 15000, 'Kemeja Lengan panjang, pendek dengan berbagai motif', 'spray.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `status_transaksi` enum('baru','proses','selesai','diambil') NOT NULL,
  `status_pembayaran` enum('dibayar','dp','belum bayar') NOT NULL,
  `id_user` int(11) NOT NULL,
  `bayar_transaksi` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_outlet`, `kode_invoice`, `id_member`, `tgl_transaksi`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status_transaksi`, `status_pembayaran`, `id_user`, `bayar_transaksi`, `total_harga`) VALUES
(61, 1, '5e61c8e483bbc', 2, '2020-03-06', '2020-03-08', '2020-03-06 00:00:00', 0, 0, 0, 'diambil', 'dibayar', 1, 80000, 75000),
(62, 1, '5e61d0c1a39a4', 3, '2020-03-09', '2020-03-10', '2020-03-06 00:00:00', 0, 0, 0, 'diambil', 'dibayar', 1, 50000, 50000),
(66, 1, '5e920a1eda419', 10, '2020-04-11', '2020-04-15', '2020-04-11 08:21:00', 0, 0, 10000, 'diambil', 'dibayar', 1, 20000000, 15150000),
(67, 0, '5e94172feba06', 10, '2020-04-13', '2020-04-13', '0000-00-00 00:00:00', 0, 0, 0, 'proses', 'belum bayar', 1, NULL, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nm_user`, `username`, `password`, `id_outlet`, `role`) VALUES
(1, 'Rezasa', 'reza', 'bb98b1d0b523d5e783f931550d7702b6', 1, 'kasir'),
(2, 'sans', 'sandi', 'ac9b4e0b6a21758534db2a6324d34a54', 0, 'owner'),
(5, 'Reza', 'febrian', '7a88290a97cd7284e7e47527baf3fcbe', 0, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_invoice` (`kode_invoice`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
