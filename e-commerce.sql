-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 01:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `bayar`
-- (See below for the actual view)
--
CREATE TABLE `bayar` (
`id_pesanan` int(11)
,`id_detail_keranjang` int(11)
,`tgl_pesanan` date
,`no_wa` text
,`penerima` text
,`alamat` text
,`bukti` text
,`nama_metode` text
,`resi` varchar(225)
,`status` text
,`total_bayar` double
,`total` text
,`ongkir` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_keranjang`
-- (See below for the actual view)
--
CREATE TABLE `detail_keranjang` (
`id_keranjang` int(11)
,`id_detail_keranjang` int(11)
,`id_produk` int(11)
,`nama_produk` text
,`harga_produk` text
,`quantity` int(11)
,`status` varchar(225)
,`id_pembeli` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `info_toko`
--

CREATE TABLE `info_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` text NOT NULL,
  `no` text NOT NULL,
  `fb` text NOT NULL,
  `ig` text NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_toko`
--

INSERT INTO `info_toko` (`id`, `nama_toko`, `no`, `fb`, `ig`, `alamat`, `email`) VALUES
(1, 'Hanna Collection', '085', 'https://fb.com/hanacollection', 'https://instagram.com/hana_collection', 'Besito Gebog Kudus', 'hanacollection@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pesanan`
-- (See below for the actual view)
--
CREATE TABLE `pesanan` (
`tgl_pesanan` date
,`penerima` text
,`no_wa` text
,`alamat` text
,`ongkir` int(11)
,`total` text
,`nama_metode` text
,`no_metode` text
,`nama_penerima_pem` text
,`bukti` text
,`resi` varchar(225)
,`id_pesanan` int(11)
,`id_keranjang` int(11)
,`id_detail_keranjang` int(11)
,`id_produk` int(11)
,`id_metode_pembayaran` int(11)
,`nama_produk` text
,`harga_produk` text
,`quantity` int(11)
,`status` text
,`id_pembeli` varchar(225)
,`input` datetime
,`deadline` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `produk`
-- (See below for the actual view)
--
CREATE TABLE `produk` (
`id_produk` int(11)
,`id_kategori` int(11)
,`nama_kategori` text
,`nama_produk` text
,`jumlah_produk` int(11)
,`harga_produk` text
,`deskripsi` text
,`gambar_produk` text
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` varchar(225) NOT NULL,
  `nama_admin` text NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` text NOT NULL,
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha') NOT NULL,
  `idu` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `alamat`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `no_telp`, `agama`, `idu`) VALUES
('20220101022919', 'Admin', 'Kudus', 'L', 'Kudus', '2022-01-01', '2147483647', 'Islam', '20220101022919');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_keranjang`
--

CREATE TABLE `tbl_detail_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_detail_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(225) NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detail_keranjang`
--

INSERT INTO `tbl_detail_keranjang` (`id_keranjang`, `id_detail_keranjang`, `id_produk`, `quantity`, `status`) VALUES
(1, 1, 11, 300, 'checkout'),
(1, 2, 11, 23, 'checkout'),
(2, 3, 10, 10, 'checkout'),
(2, 4, 10, 50, 'Belum'),
(2, 4, 12, 90, 'Belum'),
(1, 5, 13, 100, 'checkout'),
(1, 6, 10, 11, 'checkout'),
(1, 7, 11, 12, 'checkout'),
(3, 8, 14, 26, 'checkout'),
(3, 9, 17, 34, 'checkout');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jasa_pengiriman`
--

CREATE TABLE `tbl_jasa_pengiriman` (
  `id_jasa_pengiriman` int(11) NOT NULL,
  `nama_jasa` text NOT NULL,
  `gambar_jasa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jasa_pengiriman`
--

INSERT INTO `tbl_jasa_pengiriman` (`id_jasa_pengiriman`, `nama_jasa`, `gambar_jasa`) VALUES
(30, 'JNE', '442678459_800px-New_Logo_JNE.png'),
(31, 'TIKI', '1449658767_Logo TiKi.png'),
(32, 'POS INDONESIA', '787120277_kisspng-pos-indonesia-mail-point-of-sale-logo-indonesia-5aeb329c2f74d7.4438029915253633561944.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Tas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembeli` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `id_pembeli`) VALUES
(1, '20220220063548'),
(2, '20220306074446'),
(3, '20220609134144');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_metode_pembayaran`
--

CREATE TABLE `tbl_metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `nama_metode` text NOT NULL,
  `no_metode` text NOT NULL,
  `nama_penerima_pem` text NOT NULL,
  `gambar_pem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_metode_pembayaran`
--

INSERT INTO `tbl_metode_pembayaran` (`id_metode_pembayaran`, `nama_metode`, `no_metode`, `nama_penerima_pem`, `gambar_pem`) VALUES
(1, 'BRI', '087897315639', 'Muhammad', '1638747739_Bank BRI (Bank Rakyat Indonesia) Logo (PNG-720p) - FileVector69.png'),
(4, 'DANA', '087897315639', 'Firman', '427968764_Logo DANA (PNG-480p) - FileVector69.png'),
(5, 'BNI', '087897315639', 'Fahri', '1969513570_Bank BNI Logo (PNG-720p) - FileVector69.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembeli`
--

CREATE TABLE `tbl_pembeli` (
  `id_pembeli` varchar(225) NOT NULL,
  `idu` varchar(225) NOT NULL,
  `nama_pembeli` text NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pembeli`
--

INSERT INTO `tbl_pembeli` (`id_pembeli`, `idu`, `nama_pembeli`, `jenis_kelamin`, `alamat`) VALUES
('20220220063548', '20220220063548', 'Manarul', 'L', 'getassrabi'),
('20220528053956', '20220528053956', 'Manarul Hidayat ', 'L', 'getassrabi'),
('20220609134144', '20220609134144', 'Manarul', 'L', 'getas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `idu` varchar(225) NOT NULL,
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `hak_akses` varchar(15) NOT NULL,
  `verif_code` varchar(100) NOT NULL,
  `is_verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`idu`, `nama`, `username`, `password`, `email`, `hak_akses`, `verif_code`, `is_verified`) VALUES
('20220101022919', 'Admin', 'admin', 'admin', 'admin@gmail.com', 'Admin', '', 1),
('20220220063548', 'man4', 'manarul04', 'manarul04', '', 'Pembeli', '', 1),
('20220528053956', 'Manarul Hidayat ', 'mana', 'mana', 'manarulhidayat04@gmail.com', 'Pembeli', 'e8e355a2d66a92e561d128137460058d', 1),
('20220609134144', 'Manarul', 'manarul92', 'manarul92', 'manarulhidayat92@gmail.com', 'Pembeli', 'cf6656829cdc4598cbc4b278f4320897', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_detail_keranjang` int(11) NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `penerima` text NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total` text NOT NULL,
  `no_wa` text NOT NULL,
  `alamat` text NOT NULL,
  `id_metode_pembayaran` int(11) NOT NULL,
  `status` text NOT NULL DEFAULT 'Belum',
  `resi` varchar(225) NOT NULL,
  `bukti` text NOT NULL,
  `input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_detail_keranjang`, `tgl_pesanan`, `penerima`, `ongkir`, `total`, `no_wa`, `alamat`, `id_metode_pembayaran`, `status`, `resi`, `bukti`, `input`) VALUES
(1, 1, '2022-04-20', 'Manarul', 45000, '8745000', '23434', '343dsfsd', 1, 'Selesai', '5646546465', '1586674345_ayah sprites.png', '2022-04-25 09:58:59'),
(2, 2, '2022-02-26', 'fgddfg', 57000, '724000', '7687687', 'gfghf', 0, 'Belum', '', '', '2022-04-25 09:58:59'),
(3, 3, '2022-04-06', 'Manarul', 11000, '281000', '0897899987', 'getassrabi', 1, 'Selesai', '6756768999', '245650734_hidung.jpg', '2022-04-25 09:58:59'),
(4, 5, '2022-04-25', 'Manarul', 63000, '3363000', '65765', 'yhjfjf', 1, 'Belum', '', '', '2022-04-24 09:58:59'),
(5, 6, '2022-06-07', 'Manarul', 8000, '305000', '9810290812', 'getassrabi', 1, 'Belum', '', '', '2022-06-07 16:25:13'),
(6, 7, '2022-06-09', 'Mana', 8000, '356000', '837483', 'srabi', 4, 'Belum', '', '', '2022-06-09 18:30:16'),
(7, 8, '2022-06-09', 'hhhhh', 63000, '583000', '83784783', 'hhwg', 4, 'Sudah bayar', '', '1842025254_kemensos.jpg', '2022-06-09 18:46:22'),
(8, 9, '2022-06-09', 'tettetetisksj', 11000, '351000', '62375657235', 'iutkrthk', 4, 'Sudah bayar', '', '1910431489_bnn.png', '2022-06-09 18:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` text NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `harga_produk` text NOT NULL,
  `gambar_produk` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_kategori`, `nama_produk`, `jumlah_produk`, `harga_produk`, `gambar_produk`, `deskripsi`) VALUES
(10, 1, 'Tas Syahrini 20', 979, '27000', '2106553784_tas_syahrini-20.jpg', 'Tas Syahrini Size 20'),
(11, 1, 'Tas Syahrini 22', 465, '29000', '130773307_tas_syahrini-22.jpg', 'Tas Syahrini Size 22'),
(12, 1, 'Tas Pita Kotak Istimewa 20', 910, '30000', '686622139_tas_kotak_pita_istimewa-20.jpg', 'Tas Pita Kotak yang Istimewa Size 20'),
(13, 1, 'Tas Pita Kotak Istimewa 22', 600, '33000', '1519945835_tas_kotak_pita_istimewa-22.jpg', 'Tas Pita Kotak Istimewa Size 22'),
(14, 1, 'Tas Pita Kotak Standard 18', 1174, '20000', '2122297739_tas_kotak_pita_standart-18.jpg', 'Tas Pita Kotak Standard Size 18'),
(15, 1, 'Tas Pita Kotak Standard 20', 900, '22000', '971581654_tas_kotak_pita_standart-20.jpg', 'Tas Pita Kotak Standard Size 20'),
(16, 1, 'Tas Pita Kotak Standard 22', 600, '23000', '1190800953_tas_kotak_pita_standart-22.jpg', 'Tas Pita Kotak Standard Size 22'),
(17, 1, 'Tas Serut Tipis 20', 1166, '10000', '1517836840_tas_serut_tipis 20.jpg', 'Tas Serut Tipis'),
(18, 1, 'Tas Serut Standard 20', 700, '16000', '2104237473_tas_serut_standart 20.jpg', 'Tas Serut Standard Size 20'),
(19, 1, 'Tas Serut Standard 22', 600, '18000', '454845323_tas_serut_standart 22.jpg', 'Tas Serut Standard Size 22'),
(20, 1, 'Tas Kotak Idul Fitri', 1000, '3500', '1541836631_tas_idulfitri_istimewa.jpg', 'All Size');

-- --------------------------------------------------------

--
-- Structure for view `bayar`
--
DROP TABLE IF EXISTS `bayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bayar`  AS SELECT `pesanan`.`id_pesanan` AS `id_pesanan`, `pesanan`.`id_detail_keranjang` AS `id_detail_keranjang`, `pesanan`.`tgl_pesanan` AS `tgl_pesanan`, `pesanan`.`no_wa` AS `no_wa`, `pesanan`.`penerima` AS `penerima`, `pesanan`.`alamat` AS `alamat`, `pesanan`.`bukti` AS `bukti`, `pesanan`.`nama_metode` AS `nama_metode`, `pesanan`.`resi` AS `resi`, `pesanan`.`status` AS `status`, sum(`pesanan`.`quantity` * `pesanan`.`harga_produk`) AS `total_bayar`, `pesanan`.`total` AS `total`, `pesanan`.`ongkir` AS `ongkir` FROM `pesanan` GROUP BY `pesanan`.`id_detail_keranjang``id_detail_keranjang`  ;

-- --------------------------------------------------------

--
-- Structure for view `detail_keranjang`
--
DROP TABLE IF EXISTS `detail_keranjang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_keranjang`  AS SELECT `tbl_detail_keranjang`.`id_keranjang` AS `id_keranjang`, `tbl_detail_keranjang`.`id_detail_keranjang` AS `id_detail_keranjang`, `tbl_detail_keranjang`.`id_produk` AS `id_produk`, `tbl_produk`.`nama_produk` AS `nama_produk`, `tbl_produk`.`harga_produk` AS `harga_produk`, `tbl_detail_keranjang`.`quantity` AS `quantity`, `tbl_detail_keranjang`.`status` AS `status`, `tbl_keranjang`.`id_pembeli` AS `id_pembeli` FROM ((`tbl_detail_keranjang` join `tbl_produk` on(`tbl_produk`.`id_produk` = `tbl_detail_keranjang`.`id_produk`)) join `tbl_keranjang` on(`tbl_keranjang`.`id_keranjang` = `tbl_detail_keranjang`.`id_keranjang`))  ;

-- --------------------------------------------------------

--
-- Structure for view `pesanan`
--
DROP TABLE IF EXISTS `pesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pesanan`  AS SELECT `a`.`tgl_pesanan` AS `tgl_pesanan`, `a`.`penerima` AS `penerima`, `a`.`no_wa` AS `no_wa`, `a`.`alamat` AS `alamat`, `a`.`ongkir` AS `ongkir`, `a`.`total` AS `total`, `e`.`nama_metode` AS `nama_metode`, `e`.`no_metode` AS `no_metode`, `e`.`nama_penerima_pem` AS `nama_penerima_pem`, `a`.`bukti` AS `bukti`, `a`.`resi` AS `resi`, `a`.`id_pesanan` AS `id_pesanan`, `c`.`id_keranjang` AS `id_keranjang`, `b`.`id_detail_keranjang` AS `id_detail_keranjang`, `d`.`id_produk` AS `id_produk`, `e`.`id_metode_pembayaran` AS `id_metode_pembayaran`, `d`.`nama_produk` AS `nama_produk`, `d`.`harga_produk` AS `harga_produk`, `b`.`quantity` AS `quantity`, `a`.`status` AS `status`, `c`.`id_pembeli` AS `id_pembeli`, `a`.`input` AS `input`, `a`.`input`+ interval 1 day AS `deadline` FROM ((((`tbl_pesanan` `a` join `tbl_detail_keranjang` `b` on(`a`.`id_detail_keranjang` = `b`.`id_detail_keranjang`)) join `tbl_keranjang` `c` on(`c`.`id_keranjang` = `b`.`id_keranjang`)) join `tbl_produk` `d` on(`d`.`id_produk` = `b`.`id_produk`)) join `tbl_metode_pembayaran` `e` on(`e`.`id_metode_pembayaran` = `a`.`id_metode_pembayaran`)) WHERE `c`.`id_pembeli` <> 00  ;

-- --------------------------------------------------------

--
-- Structure for view `produk`
--
DROP TABLE IF EXISTS `produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `produk`  AS SELECT `tbl_produk`.`id_produk` AS `id_produk`, `tbl_produk`.`id_kategori` AS `id_kategori`, `tbl_kategori`.`nama_kategori` AS `nama_kategori`, `tbl_produk`.`nama_produk` AS `nama_produk`, `tbl_produk`.`jumlah_produk` AS `jumlah_produk`, `tbl_produk`.`harga_produk` AS `harga_produk`, `tbl_produk`.`deskripsi` AS `deskripsi`, `tbl_produk`.`gambar_produk` AS `gambar_produk` FROM (`tbl_produk` join `tbl_kategori` on(`tbl_produk`.`id_kategori` = `tbl_kategori`.`id_kategori`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_toko`
--
ALTER TABLE `info_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `idu` (`idu`);

--
-- Indexes for table `tbl_detail_keranjang`
--
ALTER TABLE `tbl_detail_keranjang`
  ADD KEY `id_pembeli` (`id_produk`),
  ADD KEY `id_keranjang` (`id_keranjang`);

--
-- Indexes for table `tbl_jasa_pengiriman`
--
ALTER TABLE `tbl_jasa_pengiriman`
  ADD PRIMARY KEY (`id_jasa_pengiriman`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `tbl_metode_pembayaran`
--
ALTER TABLE `tbl_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- Indexes for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD KEY `idu` (`idu`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`idu`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_toko`
--
ALTER TABLE `info_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jasa_pengiriman`
--
ALTER TABLE `tbl_jasa_pengiriman`
  MODIFY `id_jasa_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_metode_pembayaran`
--
ALTER TABLE `tbl_metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `tbl_pengguna` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_keranjang`
--
ALTER TABLE `tbl_detail_keranjang`
  ADD CONSTRAINT `tbl_detail_keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
  ADD CONSTRAINT `tbl_pembeli_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `tbl_pengguna` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
