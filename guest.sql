-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 08:54 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guest`
--

-- --------------------------------------------------------

--
-- Table structure for table `an_instansi`
--

CREATE TABLE `an_instansi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `an_instansi`
--

INSERT INTO `an_instansi` (`id`, `nama`) VALUES
(1, 'Perorangan'),
(2, 'DPD RI'),
(3, 'Dinas Komunikasi dan Informatika'),
(4, 'Dinas Sosial'),
(5, 'Dinas Kebudayaan dan Pariwisata'),
(6, 'DPU Bina Marga'),
(7, 'Dinas Cipta Karya'),
(8, 'Dinas Kesehatan'),
(9, 'Dinas Pendidikan'),
(10, 'Dinas Lingkungan Hidup'),
(11, 'Dinas Kependudukan dan Catatan Sipil (Dukcapil)'),
(12, 'Dinas Pertanian'),
(13, 'Dinas Perhubungan'),
(14, 'Dinas Perindustrian dan Perdagangan'),
(15, 'Dinas Perpustakaan dan Kearsipan'),
(16, 'Dinas Tenaga Kerja dan Transmigrasi'),
(17, 'Dinas Pendapatan Daerah'),
(18, 'Dinas Koperasi dan UKM'),
(19, 'Dinas Pemuda dan Olahraga'),
(20, 'KADIN (Kamar dagang dan Industri) Jawa Timur'),
(21, 'Universitas Airlangga (UNAIR)'),
(22, 'Institut Teknologi Sepuluh Nopember (ITS) Surabaya'),
(23, 'Universitas Negeri Surabaya (UNESA)'),
(24, 'UIN Sunan Ampel Surabaya (UINSA)'),
(25, 'Universitas Pembangunan Nasional (UPN) Veteran Jawa Timur'),
(26, 'Universitas Muhammadiyah Surabaya'),
(27, 'Universitas Wijaya Kusuma Surabaya'),
(28, 'STIESIA'),
(29, 'STIKOM'),
(30, 'STIKES Katolik St.Vincentius a Paulo Surabaya'),
(31, 'Universitas PGRI Adi Buana'),
(32, 'Universitas Widya Kartika'),
(33, 'Universitas 17 Agustus 1945 (UNTAG) Surabaya'),
(34, 'Universitas dr.Soetomo (UNITOMO)'),
(35, 'Universitas Brawijaya'),
(36, 'Universitas Negeri Malang'),
(37, 'Universitas Trunojoyo Madura'),
(38, 'Universitas Negeri Jember (UNEJ)'),
(39, 'Universitas Sebelas Maret Solo'),
(40, 'Kokoon Hotel'),
(41, 'Whiz Prime Hotel'),
(42, 'Gunawangsa Hotel'),
(43, 'Hotel Neo+'),
(44, 'Aliston Papilio'),
(45, 'Ascott Waterplace Surabaya'),
(46, 'Bumi Surabaya'),
(47, 'Ciputra World Hotel Surabaya'),
(48, 'JW Marriott Surabaya Hotel'),
(49, 'Shangri-La Hotel'),
(50, 'Sheraton Surabaya Hotel & Towers'),
(51, 'Vasa Hotel Surabaya'),
(52, 'Wyndham Surabaya'),
(53, 'Aria Centra Hotel'),
(54, 'Best Western Papilio Hotel'),
(55, 'Ciputra Golf Club & Hotel'),
(56, 'Crown Prince Surabaya Hotel'),
(57, 'Fairfield by Marriott Surabaya'),
(58, 'Four Points by Sheraton Surabaya Hotel'),
(59, 'Garden Palace Hotel'),
(60, 'Graha Residen Serviced Apartments'),
(61, 'Grand Darmo Suite'),
(62, 'Grand Hotel Surabaya'),
(63, 'Harris Hotel & Conventions Gubeng'),
(64, 'Holiday Inn Express Surabaya Center Plaza'),
(65, 'Hotel Santika Premiere Gubeng'),
(66, 'Hotel Tunjungan'),
(67, 'Inna Simpang Surabaya'),
(68, 'Java Paragon Hotel& Residences'),
(69, 'Mercure Surabaya Hotel'),
(70, 'Novotel Surabaya Hotel'),
(71, 'Puncak Kertajaya Apartment Surabaya'),
(72, 'Rich Palace Hotel Surabaya'),
(73, 'Singgasana Hotel Surabaya'),
(74, 'Somerset Surabaya Hotel'),
(75, 'Surabaya Suites Hotel'),
(76, 'The Alana Hotel Surabaya'),
(77, 'Hotel Santika Jemursari'),
(78, 'Grand Dafam Signature Surabaya'),
(79, 'Grand Mercure Surabaya'),
(80, 'Hotel Santika Banyuwangi'),
(81, 'Bank Mandiri'),
(82, 'Bank Central Asia (BCA)'),
(83, 'Bank Rakyat Indonesia (BRI)'),
(84, 'Bank Syariah Indonesia (BSI)'),
(85, 'HSP Provider'),
(86, 'PT Moratelindo'),
(87, 'Hypernet'),
(88, 'MarkPlus Institute'),
(89, 'Surabaya Pagi'),
(90, 'Jawa Pos');

-- --------------------------------------------------------

--
-- Table structure for table `an_instansi_bps`
--

CREATE TABLE `an_instansi_bps` (
  `id` int(11) NOT NULL,
  `kode` varchar(4) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `an_instansi_bps`
--

INSERT INTO `an_instansi_bps` (`id`, `kode`, `nama`) VALUES
(1, '3501', 'BPS KAB. PACITAN'),
(2, '3502', 'BPS KAB. PONOROGO'),
(3, '3503', 'BPS KAB. TRENGGALEK'),
(4, '3504', 'BPS KAB. TULUNGAGUNG'),
(5, '3505', 'BPS KAB. BLITAR'),
(6, '3506', 'BPS KAB. KEDIRI'),
(7, '3507', 'BPS KAB. MALANG'),
(8, '3508', 'BPS KAB. LUMAJANG'),
(9, '3509', 'BPS KAB. JEMBER'),
(10, '3510', 'BPS KAB. BANYUWANGI'),
(11, '3511', 'BPS KAB. BONDOWOSO'),
(12, '3512', 'BPS KAB. SITUBONDO'),
(13, '3513', 'BPS KAB. PROBOLINGGO'),
(14, '3514', 'BPS KAB. PASURUAN'),
(15, '3515', 'BPS KAB. SIDOARJO'),
(16, '3516', 'BPS KAB. MOJOKERTO'),
(17, '3517', 'BPS KAB. JOMBANG'),
(18, '3518', 'BPS KAB. NGANJUK'),
(19, '3519', 'BPS KAB. MADIUN'),
(20, '3520', 'BPS KAB. MAGETAN'),
(21, '3521', 'BPS KAB. NGAWI'),
(22, '3522', 'BPS KAB. BOJONEGORO'),
(23, '3523', 'BPS KAB. TUBAN'),
(24, '3524', 'BPS KAB. LAMONGAN'),
(25, '3525', 'BPS KAB. GRESIK'),
(26, '3526', 'BPS KAB. BANGKALAN'),
(27, '3527', 'BPS KAB. SAMPANG'),
(28, '3528', 'BPS KAB. PAMEKASAN'),
(29, '3529', 'BPS KAB. SUMENEP'),
(30, '3571', 'BPS KOTA KEDIRI'),
(31, '3572', 'BPS KOTA BLITAR'),
(32, '3573', 'BPS KOTA MALANG'),
(33, '3574', 'BPS KOTA PROBOLINGGO'),
(34, '3575', 'BPS KOTA PASURUAN'),
(35, '3576', 'BPS KOTA MOJOKERTO'),
(36, '3577', 'BPS KOTA MADIUN'),
(37, '3578', 'BPS KOTA SURABAYA'),
(38, '3579', 'BPS KOTA BATU');

-- --------------------------------------------------------

--
-- Table structure for table `an_layanan`
--

CREATE TABLE `an_layanan` (
  `id` int(11) NOT NULL,
  `id_tujuan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `an_layanan`
--

INSERT INTO `an_layanan` (`id`, `id_tujuan`, `nama`) VALUES
(1, 1, 'Konsultasi Data'),
(2, 1, 'Data Mikro'),
(3, 1, 'Penjualan'),
(4, 1, 'Publikasi'),
(5, 1, 'Perpustakaan'),
(6, 1, 'Rekomendasi Kegiatan Statistik');

-- --------------------------------------------------------

--
-- Table structure for table `an_progres`
--

CREATE TABLE `an_progres` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `an_progres`
--

INSERT INTO `an_progres` (`id`, `nama`) VALUES
(1, 'Reserved'),
(2, 'On Location'),
(3, 'Process'),
(4, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `an_reservasi`
--

CREATE TABLE `an_reservasi` (
  `id` int(11) NOT NULL,
  `kode` varchar(4) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` int(11) NOT NULL,
  `hp` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `layanan` varchar(255) DEFAULT NULL,
  `keperluan` text NOT NULL,
  `jenis` int(11) NOT NULL,
  `progres` int(11) NOT NULL,
  `process_by` varchar(30) NOT NULL,
  `qr_code` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `an_tujuan`
--

CREATE TABLE `an_tujuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `an_tujuan`
--

INSERT INTO `an_tujuan` (`id`, `nama`) VALUES
(1, 'PST (Pelayanan Statistik Terpadu)'),
(2, 'Kepala BPS Jawa Timur'),
(3, 'Bagian Tata Usaha'),
(4, 'Subbag Bina Program'),
(5, 'Subbag Pengadaan Barang Jasa'),
(6, 'Subbag Kepegawaian dan Hukum'),
(7, 'Subbag Keuangan'),
(8, 'Subbag Umum'),
(9, 'Bidang Sosial'),
(10, 'Bidang Produksi'),
(11, 'Bidang Distribusi'),
(12, 'Bidang Nerwilis'),
(13, 'Bidang IPDS'),
(14, 'Tim Humas'),
(15, 'Resepsionis');

-- --------------------------------------------------------

--
-- Table structure for table `an_users`
--

CREATE TABLE `an_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `password` text NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `an_users`
--

INSERT INTO `an_users` (`id`, `username`, `nama`, `role`, `tujuan`, `password`, `last_active`) VALUES
(1, 'admin', 'Admin Antrian', 1, 0, '5041e1519eb16f2d53ff513781593f14ea8202b847126b76e094fe69f5c1ca13', '2021-12-29 07:53:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `an_instansi`
--
ALTER TABLE `an_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an_instansi_bps`
--
ALTER TABLE `an_instansi_bps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an_layanan`
--
ALTER TABLE `an_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an_progres`
--
ALTER TABLE `an_progres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an_reservasi`
--
ALTER TABLE `an_reservasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an_tujuan`
--
ALTER TABLE `an_tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an_users`
--
ALTER TABLE `an_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `an_instansi`
--
ALTER TABLE `an_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `an_instansi_bps`
--
ALTER TABLE `an_instansi_bps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `an_layanan`
--
ALTER TABLE `an_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `an_reservasi`
--
ALTER TABLE `an_reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `an_users`
--
ALTER TABLE `an_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
