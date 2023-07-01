-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 04:35 PM
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
-- Database: `uas_pabw`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `gambar`, `quantity`, `id_buku`, `judul_buku`, `user_id`, `harga`) VALUES
(21, '0.08361600 1687946279.jpg', 1, 27, 'naruto', 3, 32432);

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` double NOT NULL,
  `gambar` text NOT NULL,
  `id_kategori` int(20) NOT NULL,
  `jumlah_buku` int(50) NOT NULL,
  `terjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id`, `judul_buku`, `deskripsi`, `harga`, `gambar`, `id_kategori`, `jumlah_buku`, `terjual`) VALUES
(25, 'asdas', 'sadasd', 123, '0.37190500 1687945820.jpg', 2, 1110, 1),
(26, 'sadas', 'sa21', 123, '0.24094700 1687945888.jpg', 2, 9, 2),
(27, 'naruto', 'qweqw', 32432, '0.08361600 1687946279.jpg', 2, 320, 4),
(28, 'Kimetsu no Yaiba', '23432', 23423, 'download (14).jpg', 2, 19, 3),
(29, 'asdas', 'sadsa', 1111, '0.00589500 1688014574.png', 3, 10, 2),
(30, 'sadas', 'sadas', 213213, '0.22731800 1688015177.jpg', 4, 10, 0),
(31, 'sadas', 'sasa', 111, 'banner majalah.jpg', 4, 10, 1),
(32, '11', '111', 2222, '0.07439600 1688015231.jpg', 3, 18, 2),
(33, 'naruto', 'asd', 1213, '0.10844300 1688015399.jpg', 2, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`) VALUES
(2, 'manga', NULL),
(3, 'fantasy', NULL),
(4, 'teknologi', NULL),
(5, 'majalah', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_artikel`
--

CREATE TABLE `kategori_artikel` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(30) DEFAULT NULL,
  `slug` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `nama_kategori`, `slug`) VALUES
(4, 'Wisata', NULL),
(5, 'Kuliner', NULL),
(6, 'Tour', NULL),
(7, 'pertanian', NULL),
(8, 'komik', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_transaksi`
--

CREATE TABLE `riwayat_transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_transaksi`
--

INSERT INTO `riwayat_transaksi` (`id`, `user_id`, `judul_buku`, `created_time`, `jumlah`, `total_harga`) VALUES
(6, 3, '11', '2023-06-30 21:33:44', 1, 2222),
(7, 3, 'asdas', '2023-06-30 21:36:38', 1, 1111),
(8, 3, 'naruto', '2023-06-30 21:38:16', 1, 32432),
(9, 1, 'naruto', '2023-06-30 21:46:03', 1, 32432),
(10, 1, 'sadas', '2023-07-01 13:31:35', 1, 123),
(11, 1, 'naruto', '2023-07-01 13:31:35', 1, 32432),
(12, 4, '11', '2023-07-01 13:37:10', 1, 2222),
(13, 4, 'naruto', '2023-07-01 13:39:11', 1, 32432),
(14, 4, 'sadas', '2023-07-01 14:52:02', 1, 111),
(15, 1, '11', '2023-07-01 16:02:05', 1, 2222),
(16, 1, 'sadas', '2023-07-01 16:02:05', 1, 123),
(17, 1, 'asdas', '2023-07-01 16:02:05', 1, 123),
(18, 1, 'Kimetsu no Yaiba', '2023-07-01 16:03:09', 3, 70269),
(19, 1, 'asdas', '2023-07-01 16:03:09', 1, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `tb_about`
--

CREATE TABLE `tb_about` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_about`
--

INSERT INTO `tb_about` (`id`, `judul`, `isi`) VALUES
(6, 'ini adalah about', 'Pertanian adalah kegiatan pemanfaatan sumber daya hayati yang dilakukan manusia untuk menghasilkan bahan pangan, bahan baku industri, atau sumber energi, serta untuk mengelola lingkungan hidupnya.[1] Kegiatan pemanfaatan sumber daya hayati yang termasuk d');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `usertype` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `nama_operator`, `usertype`, `saldo`, `gambar`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0, -25818, ''),
(3, 'aaa', 'bbb', 'bbb', 0, 0, ''),
(4, 'daffaa', '267324a2037700247c00fba40f1f1756', 'daffaa', 1, 79989, ''),
(5, 'ccc', '9df62e693988eb4e1e1444ece0578579', 'ccc', 0, 0, ''),
(6, 'megumin', '958f051b30e88ec019edf339593e506a', 'megumin', 1, 0, ''),
(7, 'kontil', 'b829071a7a3a979ff4d1c5bb387db2b3', 'kontil', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_artikel`
--

CREATE TABLE `tb_artikel` (
  `id` int(11) NOT NULL,
  `judul_artikel` varchar(100) DEFAULT NULL,
  `content_artikel` longtext DEFAULT NULL,
  `cover` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `slug` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_artikel`
--

INSERT INTO `tb_artikel` (`id`, `judul_artikel`, `content_artikel`, `cover`, `user_id`, `created_time`, `id_kategori`, `slug`) VALUES
(4, 'Sawo Manilla', 'Sawo manila (Manilkara zapota) adalah pohon buah yang berumur panjang. Pohon dan buahnya dikenal dengan beberapa nama seperti sawo (Ind., Jw.), sauh atau sauh manila, atau ciku (Mly.). Sawo manila merupakan tanaman buah yang termasuk dalam suku sawo-sawoan (Sapotaceae) yang berasal dari Amerika Tengah dan Meksiko. Tanaman sawo termasuk tumbuhan tropis yang mudah beradaptasi sehingga mudah dibudidayakan di berbagai negara termasuk di Indonesia, sawo banyak diusahakan di lahan pekarangan dan sangat mudah dijumpai di pasaran.', 'bibit-sawo-manila.jpg', 1, '2023-05-08 01:28:05', 7, NULL),
(5, 'Mangga', 'Mangga atau mempelam adalah nama sejenis buah, demikian pula nama pohonnya. Mangga termasuk ke dalam genus Mangifera, yang terdiri dari 35-40 anggota dari famili Anacardiaceae.\r\n\r\nMangga\r\nMangga gedong gincu 071021-0845 tmo.jpg\r\nBuah mangga gedong gincu,\r\ndari Tomo, Sumedang\r\nStatus konservasi\r\n\r\nData Kurang (IUCN 2.3)[1]\r\nKlasifikasi ilmiah\r\nKerajaan:	Plantae\r\nKelas:	Magnoliopsida\r\nOrdo:	Sapindales\r\nFamili:	Anacardiaceae\r\nGenus:	Mangifera\r\nSpesies:	M. indica\r\nNama binomial\r\nMangifera indica\r\nL.\r\nNama \"mangga\" berasal dari bahasa Tamil, mankay, yang berarti man \"pohon mangga\" + kay \"buah\".[2] Kata ini dibawa ke Eropa oleh orang-orang Portugis dan diserap menjadi manga (bahasa Portugis), mango (bahasa Spanyol dan Inggris) dan lainnya.[2]\r\n\r\nMangga berasal dari daerah di sekitar perbatasan India dengan Burma, dan mangga telah menyebar ke Asia Tenggara sekitar 1500 tahun yang silam.[3][4] Buah ini dikenal pula dalam berbagai bahasa daerah, seperti pêlêm atau poh (Jw.), Poh (Bl.), dan Paok (Sas.)', 'Pupuk_Mangga.jpg', 1, '2023-05-08 01:28:00', 7, NULL),
(6, 'Jeruk', 'Jeruk (bahasa Inggris: orange) adalah buah dari spesies citrus dalam famili Rutaceae. Ini mengacu pada Citrus sinensis[1] yang juga disebut jeruk manis dan Citrus aurantium yang disebut jeruk pahit. Jeruk manis bereproduksi secara aseksual (apomiksis melalui nucellar embryony), yaitu melalui sistem cangkok, okulasi atau stek, dan varietas jeruk manis muncul melalui mutasi.', 'TIRTO-shutterstock_115590688_ratio-16x9.jpeg', 1, '2023-05-08 01:27:54', 7, NULL),
(7, 'Semangka', 'Semangka (juga dikenal sebagai tembikai[1] atau mendikai[1]) (Citrullus lanatus, suku ketimun-ketimunan atau Cucurbitaceae) adalah tanaman merambat yang berasal dari daerah setengah gurun di Afrika bagian selatan.[2] Tanaman ini masih sekerabat dengan labu-labuan (Cucurbitaceae), melon (Cucumis melo), dan ketimun (Cucumis sativus). Semangka biasa dipanen buahnya untuk dimakan segar atau dibuat jus. Biji semangka yang dikeringkan dan disangrai juga dapat dimakan isinya (kotiledon) sebagai kua', 'Watermeloen.jpg', 1, '2023-05-08 01:27:43', 7, NULL),
(9, 'Semangkaaaaaaa', 'asdasdsadasasdasd', 'Annotation 2023-05-14 170230.png', 7, '2023-05-14 20:17:15', 7, NULL),
(11, 'dafaf', 'dafafa', '0.19801300 1684071012.png', 7, '2023-05-14 20:30:12', 10, NULL),
(14, 'sadas', 'sdaas', '0.74601700 1687617791.png', 1, '2023-06-24 21:43:11', 5, NULL),
(15, 'sdas', 'sadsad', '0.87372900 1687784949.png', 5, '2023-06-26 20:09:09', 4, NULL),
(16, 'sadasd', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdiojoisaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '0.24303200 1687787561.png', 5, '2023-06-26 20:52:41', 4, NULL),
(17, 'sadd', 'asdas', '0.82747300 1687787755.jpg', 5, '2023-06-26 20:55:55', 4, NULL),
(18, 'dsaasd', 'asdsadsa', '0.72279800 1687858862.png', 1, '2023-06-27 16:41:02', 8, NULL),
(19, 'asdsa', 'sadsad', '0.93970900 1687858873.jpeg', 1, '2023-06-27 16:41:13', 6, NULL),
(20, 'sdaas', 'dsadasd', 'download (12).jpg', 1, '2023-07-01 13:24:39', 8, NULL),
(21, 'sdasd', 'sadas', '0.85753900 1687859925.jpg', 1, '2023-06-27 16:58:45', 7, NULL),
(22, 'sadas', 'sadasd', '0.54569100 1687859942.png', 1, '2023-06-27 16:59:02', 7, NULL),
(23, 'sdas', 'asdasdas', '0.76612900 1687859951.jpg', 1, '2023-06-27 16:59:11', 7, NULL),
(24, 'sadsad', 'sadsad', '0.63301900 1687859960.jpg', 1, '2023-06-27 16:59:20', 7, NULL),
(25, 'gdf', 'dg', '0.03330100 1687860189.png', 1, '2023-06-27 17:03:09', 8, NULL),
(26, 'test', 'adas', '0.01668400 1688202035.jpg', 1, '2023-07-01 16:00:35', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gallery`
--

CREATE TABLE `tb_gallery` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_gallery`
--

INSERT INTO `tb_gallery` (`id`, `nama`, `gambar`) VALUES
(3, 'adsadas', '0.43806700 1687939728.png'),
(4, 'komik', '0.13918700 1688009946.jpg'),
(6, 'dafaf', '0.26898600 1688050745.jpg'),
(7, 'aaabbb', 'banner komik.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `nama_menu`, `url`) VALUES
(9, 'menu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_slider`
--

CREATE TABLE `tb_slider` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_slider`
--

INSERT INTO `tb_slider` (`id`, `nama`, `gambar`) VALUES
(2, 'test', 'download (12).jpg'),
(6, 'aaa', '0.50693200 1688192443.jpg'),
(7, 'aa', '0.58165900 1688192543.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_social`
--

CREATE TABLE `tb_social` (
  `id` int(11) NOT NULL,
  `nama_sosmed` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_social`
--

INSERT INTO `tb_social` (`id`, `nama_sosmed`, `icon`) VALUES
(9, 'gmail', 'email.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  `foto_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `saldo`, `foto_profile`) VALUES
(1, 'daffa', '135a4e22cda0e0a68499e6d6e2a861aa', 67568, NULL),
(2, 'rearizth', '29d46a1dcead8b76f385f2aa174ec94d', NULL, NULL),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_gallery`
--
ALTER TABLE `tb_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_slider`
--
ALTER TABLE `tb_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_social`
--
ALTER TABLE `tb_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_artikel`
--
ALTER TABLE `tb_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_gallery`
--
ALTER TABLE `tb_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_slider`
--
ALTER TABLE `tb_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_social`
--
ALTER TABLE `tb_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
