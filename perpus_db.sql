-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2021 at 08:24 PM
-- Server version: 10.5.9-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `jk` enum('P','L') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id`, `nis`, `nama`, `id_kelas`, `jk`) VALUES
('2bf028d9-b15b-4bd9-bae4-5b799a0504f5', '9890939920', 'norkus ahmad', 6, 'L'),
('383a7cc6-5612-40a3-8ab3-b47cef6cf2cf', '989090932', 'niwan', 5, 'L'),
('9ca568de-d0c8-408c-b921-bd8d559763b4', '898798322', 'abd wahid', 8, 'L'),
('c4ab267e-3efb-4e50-a32b-108d21eb5dda', '77783111', 'riyadi', 5, 'L'),
('d079b6c8-04c4-4e70-b2be-871a86332889', '678678444', 'rianita anjay', 5, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdbuku` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerbit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` enum('hibah','beli') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tahun` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id`, `kdbuku`, `judul`, `penulis`, `penerbit`, `asal`, `jumlah`, `tahun`, `isbn`) VALUES
('02390e99-cc99-480c-9e6c-843d67351a7d', '12345619', 'Bulan', 'Tere liye', 'pustaka ebook', 'beli', 2, '2008', '99902989'),
('1d203133-d996-45fe-9b5f-f42c9ea80abb', '12345618', 'Hujan', 'Tere liye', 'pustaka ebook', 'hibah', 0, '2006', '99902988'),
('708a25c0-bad0-41e7-a6a2-f30827eb683e', '12345612', 'tenggelamnya kapal vander wick', 'buya hamka', 'gramedia', 'beli', 2, '2006', '99902982'),
('e3cc9663-de55-44f5-869b-91e5cb5e8c44', '12345617', 'Daun yang jatuh tak pernah membenci angin', 'Tere liye', 'pustaka ebook', 'beli', 3, '2005', '99902987'),
('eb67a44a-3877-49c5-8439-62cdd272ffcc', '12345613', 'ayat ayat cinta', 'habiburrahman', 'gramedia', 'beli', 2, '2004', '99902983');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kelas`) VALUES
(1, '1A'),
(2, '1B'),
(3, '1C'),
(4, '1D'),
(5, '1E'),
(6, '1F'),
(7, '1G'),
(8, '1H');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengunjung`
--

CREATE TABLE `tb_pengunjung` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tgl_kunjung` date NOT NULL,
  `keperluan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pengunjung`
--

INSERT INTO `tb_pengunjung` (`id`, `nama`, `id_kelas`, `tgl_kunjung`, `keperluan`) VALUES
(26, 'cek nama boleh', 2, '2021-04-06', 'satu dua tiga'),
(27, 'cek masuk lagi', 2, '2021-04-06', 'wewew'),
(28, 'pengunjung 1', 5, '2021-04-15', 'dfsad'),
(29, 'abd wahid', 4, '2021-04-17', 'pinjam buku');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_pinjam` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_anggota` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_buku` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('pinjam','kembali') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_pinjam`, `id_anggota`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `status`, `jumlah`) VALUES
('TRX-P0001', 'd079b6c8-04c4-4e70-b2be-871a86332889', 'eb67a44a-3877-49c5-8439-62cdd272ffcc', '2021-04-19', '2021-04-26', 'pinjam', 1),
('TRX-P0002', '9ca568de-d0c8-408c-b921-bd8d559763b4', '708a25c0-bad0-41e7-a6a2-f30827eb683e', '2021-04-19', '2021-04-19', 'kembali', 1),
('TRX-P0003', '383a7cc6-5612-40a3-8ab3-b47cef6cf2cf', '1d203133-d996-45fe-9b5f-f42c9ea80abb', '2021-04-19', '2021-04-19', 'kembali', 1),
('TRX-P0004', '383a7cc6-5612-40a3-8ab3-b47cef6cf2cf', '708a25c0-bad0-41e7-a6a2-f30827eb683e', '2021-04-19', '2021-04-26', 'pinjam', 1),
('TRX-P0005', 'd079b6c8-04c4-4e70-b2be-871a86332889', '1d203133-d996-45fe-9b5f-f42c9ea80abb', '2021-04-19', '2021-04-26', 'pinjam', 1);

--
-- Triggers `tb_pinjam`
--
DELIMITER $$
CREATE TRIGGER `kembali` AFTER UPDATE ON `tb_pinjam` FOR EACH ROW UPDATE tb_buku set tb_buku.jumlah = tb_buku.jumlah + old.jumlah
WHERE id = old.id_buku
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pinjam` AFTER INSERT ON `tb_pinjam` FOR EACH ROW BEGIN
UPDATE tb_buku
SET jumlah = jumlah - new.jumlah
WHERE
id = new.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(6, 'administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(7, 'abd wahid', 'wahid', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  ADD CONSTRAINT `tb_pengunjung_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD CONSTRAINT `tb_pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id`),
  ADD CONSTRAINT `tb_pinjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
