-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 05:11 AM
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
-- Database: `project_tokoonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'devi', 'adminmaster', '21232f297a57a5a743894a0e4a801fc3', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_nama` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_hp` varchar(20) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_new` tinyint(1) DEFAULT 1,
  `invoice_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_nama`, `customer_email`, `customer_hp`, `customer_alamat`, `customer_password`, `customer_new`, `invoice_customer`) VALUES
(9, 'gaby', 'dvgaby@gmail.com', '4342', 'jalan yosudarso 10', 'ddaf3e29375ed9565450c316ebc91cae', 1, 0),
(10, 'sky', 'bluesky@gmail.com', '4342', 'Universitas Palangka Raya, Palangka Raya, Indonesia', 'ddaf3e29375ed9565450c316ebc91cae', 1, 0),
(11, 'monmoon', 'monmoon@gmail.com', '081251167', 'jalan karet', 'efdd7ce8badb51d4b81fd6489beb9f66', 0, 0),
(26, 'natan', 'natan@gmail.com', '3242', 'sdfsdf', 'f39fae12f6f866c7e6ac6f54c700c204', 0, 0),
(27, 'natan', 'natan2@gmail.com', '0843534534', 'fsdfsdfsd', 'f39fae12f6f866c7e6ac6f54c700c204', 0, 0),
(28, 'Theo', 'theo@gmail.com', '081350749240', 'Jl. Sawit Raya', '2a27b8144ac02f67687f76782a3b5d8f', 1, 0),
(29, 'Limbong', 'Limbong@gmail.com', '081350749240', 'Jl. Sawit Raya', '2a27b8144ac02f67687f76782a3b5d8f', 0, 0),
(30, 'mon', 'mon@gmail.com', '081350749240', 'Jl. Nyai Undang', '2a27b8144ac02f67687f76782a3b5d8f', 1, 0),
(31, 'Anton', 'Anton@gmail.com', '081357689978', 'Jl. Wortel', '2a27b8144ac02f67687f76782a3b5d8f', 0, 0),
(32, 'Tejo', 'tejo@gmail.com', '09123456789', 'JL. 1', '2a27b8144ac02f67687f76782a3b5d8f', 0, 0),
(33, 'lara', 'lara@gmail.com', '09876', 'jalan karet', 'd3c327c84f809a5330bbf0d74438500c', 0, 0),
(34, 'cindy', 'cindy07@gmail.com', '082252780800', 'jl.garuda', '8dc447bd23961fddf8482f8fb69645d3', 0, 0),
(35, 'cina', 'cincin@gmail.com', '082252780851', 'jl. melati', '24d9cb9562d07d09499898d5c6849844', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_tanggal` date NOT NULL,
  `invoice_customer` int(11) NOT NULL,
  `invoice_nama` varchar(255) NOT NULL,
  `invoice_hp` varchar(255) NOT NULL,
  `invoice_alamat` text NOT NULL,
  `invoice_status` int(11) NOT NULL,
  `invoice_bukti` text NOT NULL,
  `total_bayar` float DEFAULT NULL,
  `invoice_metode_pembayaran` varchar(50) DEFAULT NULL,
  `invoice_metode_pengiriman` varchar(50) DEFAULT NULL,
  `transaksi_invoice` int(11) NOT NULL,
  `transaksi_jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_tanggal`, `invoice_customer`, `invoice_nama`, `invoice_hp`, `invoice_alamat`, `invoice_status`, `invoice_bukti`, `total_bayar`, `invoice_metode_pembayaran`, `invoice_metode_pengiriman`, `transaksi_invoice`, `transaksi_jumlah`) VALUES
(51, '2024-11-29', 12, 'lia', '02983823', 'jalan yos 3', 0, '', 100000, 'cod', 'antar', 0, 0),
(52, '2024-12-01', 29, 'Limbong', '081350749240', 'Jl. Sawit Raya', 0, '', 85000, 'transfer', 'antar', 0, 0),
(54, '2024-12-02', 31, 'Anton', '081234567890', 'Jl. Wortel', 5, '1037003560.jpeg', 85000, 'transfer', 'ambil', 0, 0),
(55, '2024-12-02', 31, 'Anton', '08123456789', 'Jl. Tampei', 0, '', 100000, 'transfer', 'ambil', 0, 0),
(56, '2024-12-02', 32, 'Tejo', '081234567890', 'Jl. 1', 0, '', 85000, NULL, NULL, 0, 0),
(57, '2024-12-02', 33, 'lara', '09876', 'jalan karet', 1, '1181690418.png', 100000, 'transfer', 'ambil', 0, 0),
(58, '2024-12-02', 0, '', '', '', 0, '', 0, NULL, NULL, 0, 0),
(59, '2024-12-02', 33, 'lara', '09876', 'jalan karet', 4, '', 85000, NULL, NULL, 0, 0),
(60, '2024-12-02', 33, 'lara', '19874', 'jalan karet', 0, '', 100000, NULL, NULL, 0, 0),
(61, '2024-12-02', 0, '', '', '', 0, '', 0, '', '', 0, 0),
(62, '2024-12-03', 11, 'monmoon', '34589', 'jalan tilung', 0, '', 38244.9, 'cod', 'antar', 0, 0),
(63, '2024-12-03', 34, 'cindy', '082252780800', 'jl.garuda', 5, '874566531.jpg', 12748.3, 'transfer', 'antar', 0, 0),
(64, '2024-12-03', 34, 'Devi', '082252780851', 'jl.garuda', 5, '', 14998, 'transfer', 'ambil', 0, 0),
(65, '2024-12-03', 33, 'lara', '1234', '', 2, '', 39998, 'transfer', 'ambil', 0, 0),
(66, '2024-12-16', 35, 'cina', '082252780851', 'jl.melati', 0, '', 21250, 'cod', 'antar', 0, 0),
(67, '2024-12-16', 35, 'cina', '0', 'a', 0, '', 25000, 'cod', 'ambil', 0, 0),
(68, '2024-12-16', 35, 'cina', '0', 'a', 0, '', 25000, 'cod', 'ambil', 0, 0),
(69, '2024-12-16', 35, 'cina', '0', 'a', 0, '', 25000, 'cod', 'ambil', 0, 0),
(70, '2024-12-16', 35, 'cina', '0', 'a', 0, '', 25000, 'cod', 'ambil', 0, 0),
(71, '2024-12-16', 35, 'cina', '0', 'a', 1, '', 25000, 'cod', 'ambil', 0, 0),
(72, '2024-12-16', 35, 'cindy', '0852', 'sabbilah city', 0, '', 50000, 'transfer', 'ambil', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`) VALUES
(12, 'kupu-kupu '),
(13, 'bunga'),
(14, 'balon'),
(15, 'satuan');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `produk_kategori` int(11) NOT NULL,
  `produk_harga` int(11) NOT NULL,
  `produk_keterangan` text NOT NULL,
  `produk_jumlah` int(11) NOT NULL,
  `produk_berat` int(11) NOT NULL,
  `produk_foto1` varchar(255) DEFAULT NULL,
  `produk_foto2` varchar(255) DEFAULT NULL,
  `produk_foto3` varchar(255) DEFAULT NULL,
  `transaksi_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `produk_nama`, `produk_kategori`, `produk_harga`, `produk_keterangan`, `produk_jumlah`, `produk_berat`, `produk_foto1`, `produk_foto2`, `produk_foto3`, `transaksi_produk`) VALUES
(15, 'buket bunga', 13, 75000, '<p>buket bunga yang bagus untuk hari hari specia anda&nbsp;</p>', 1, 0, '215752319_bucket bunga (5).jpg', '1441910841_591b8dcb2829a18ac17c7f0f39f3b773.jpg', '1441910841_16e24d782471cbb02a7519912664b476.jpg', 0),
(16, 'buket model kupu-kupu ', 12, 100000, '<p>buket bermodel kupu kupu&nbsp;</p>', 3, 0, '1603749027_81acd605cd3a491b7ccc7bc8106f9acc.jpg', '1603749027_ab35aa01c9f94ec475ad5f26e73ed6cd.jpg', '1603749027_ku.jpg', 0),
(18, 'buket  balon', 14, 100000, '<p>sangat bagus&nbsp;</p>', 12, 0, '797743817_e05c11ba6bee3aee563a9875ef0e1773.jpg', '797743817_download (1).jpeg', '797743817_16e24d782471cbb02a7519912664b476.jpg', 0),
(20, 'mawar pink', 15, 20000, '<p>pinky</p>', 2, 0, '1441376304_Single Pink Rose.jpeg', '1441376304_a965e322923e552f03f52b062260c4dd.jpg', '', 0),
(21, 'ungu', 15, 20000, '<p>bunga ungu</p>', 3, 0, '2119027947_Purple Korean Wrapped Single Eternal Rose.jpeg', '2119027947_7df346e05c7e6af1d0038b2a4a6b5a43.jpg', '', 0),
(22, 'tulip pink', 15, 20000, '<p>tulip</p>', 5, 0, '978147374_Single Tulip kawat bulu _ Buket bunga Tulip _ kawat bulu mercy _ pipe cleaner _ buket hari guru _ buket ulang tahun _ buket valentine _ buket wisuda _ buket hari ibu.jpeg', '978147374_f08541f3fd43ea6108aca3db249257d9.jpg', '978147374_81c1eae7ac8d65435df3f38b37fb1230.jpg', 0),
(23, 'mawar putih', 15, 25000, '<p>mawar putih</p>', 5, 0, '582885317_download (2).jpeg', '582885317_4a4f7ead002e5fc2492cf84f10e18462.jpg', '582885317_30bb9d478627ad15ca1a343e920ff174.jpg', 0),
(24, 'mawar merah', 15, 25000, '<p>mawar merah</p>', 6, 0, '1320766568_022e069c7add5bbb19d1c0c7ce2e2e15.jpg', '1320766568_e28267b1fb61952a6286347211652676.jpg', '1320766568_c9b50621983ee896afe28c9b6455b067.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_invoice` int(11) NOT NULL,
  `transaksi_produk` int(11) NOT NULL,
  `transaksi_jumlah` int(11) NOT NULL,
  `transaksi_harga` int(11) NOT NULL,
  `invoice_status` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_invoice`, `transaksi_produk`, `transaksi_jumlah`, `transaksi_harga`, `invoice_status`, `total_bayar`) VALUES
(47, 0, 16, 1, 100000, 0, 0),
(67, 52, 16, 1, 100000, 0, 0),
(69, 54, 16, 1, 100000, 0, 0),
(70, 55, 16, 1, 100000, 0, 0),
(71, 56, 16, 1, 100000, 0, 0),
(78, 65, 24, 1, 25000, 0, 0),
(79, 66, 23, 1, 25000, 0, 0),
(80, 71, 23, 1, 25000, 0, 25000),
(81, 72, 23, 2, 25000, 0, 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
