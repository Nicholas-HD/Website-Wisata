-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 10:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(150) NOT NULL,
  `admin_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', '$2y$10$FXcNSsezsIztmmfXXJ7bBesrL1avRW2pkrftxhg3OmUL4Phyjr.F2'),
(2, 'admin1', '$2y$10$w4bqdknsCxRu0QZ3YKgaP.XNRvPdpTuEXjR6pwTPDnmTNbTekuD8m'),
(3, 'admin1', '$2y$10$b4FmrwOzMieUluRR15B4/uT6xpLDKJoyPGcHxTSDtyXPUb3nSEYLm'),
(4, 'admin123', '$2y$10$NLSE.G98Cj/vneGekOgh1uGqO67FcXnWZHhYOhO2s2wyOjCOVZt3y'),
(5, 'admin123', '$2y$10$Lp./JaAmyxhCQEx3GUHzXuPYxWMZq4rVLFANpTM5oxZuTQNCs5eZO');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `berita_id` char(4) NOT NULL,
  `berita_judul` varchar(150) NOT NULL,
  `berita_isi` text NOT NULL,
  `berita_sumber` varchar(150) NOT NULL,
  `gambarberita` text NOT NULL,
  `kategori_id` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` char(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `subjudul` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `oleh` varchar(100) NOT NULL,
  `trip` varchar(100) NOT NULL,
  `totalorang` varchar(100) NOT NULL,
  `gambarbooking` varchar(100) NOT NULL,
  `rating` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `judul`, `subjudul`, `tujuan`, `keterangan`, `lokasi`, `tanggal`, `oleh`, `trip`, `totalorang`, `gambarbooking`, `rating`) VALUES
('B001', 'Booking your travel now', 'Travel, around the world with us.', 'Osaka', 'Lorem lorem lorem lorem ', 'Japan,Tokyo', '2024-11-30', 'Mr. Jhon Smith', 'Japan trip', '90', 'destinasi3.jpg', '10');

-- --------------------------------------------------------

--
-- Table structure for table `destinasiwisata`
--

CREATE TABLE `destinasiwisata` (
  `kode_destinasi` char(10) NOT NULL,
  `kode_kabupaten` char(10) NOT NULL,
  `kategori_id` char(11) NOT NULL,
  `nama_destinasi` varchar(200) NOT NULL,
  `alamat_destinasi` varchar(200) NOT NULL,
  `keterangan_destinasi` varchar(700) NOT NULL,
  `gambardestinasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasiwisata`
--

INSERT INTO `destinasiwisata` (`kode_destinasi`, `kode_kabupaten`, `kategori_id`, `nama_destinasi`, `alamat_destinasi`, `keterangan_destinasi`, `gambardestinasi`) VALUES
('D00012', 'KABU129', 'KATE10', 'Alaska highway', 'Fort St. John, BC; Fort Nelson, BC; Watson Lake, YT; Whitehorse, YT; Tok, AK; Delta Junction, AK', 'The Alaska Highway was constructed during World War II to connect the contiguous United States to Alaska across Canada. ', 'destinasi6.jpeg'),
('D0010', 'KABU127', 'KATE8', 'Hamdeok Beach', 'Jeju City, South Korea', 'Hamdeok Beach is popular among families wanting to enjoy water activities including parasailing and jet skiing', 'desti5.jpeg'),
('D0011', 'KABU127', 'KATE8', 'seoul tower', '105 Namsangongwon-gil, Yongsan District, Seoul, South Korea', 'The N Seoul Tower, officially the YTN Seoul Tower and a.k.a. for the Namsan', 'destinasi5.jpg'),
('D0013', 'KABU129', 'KATE10', 'Alaskan mountain', 'alaskan 1-mountain', 'great', 'destinasi6.jpeg'),
('D0020', 'KABU129', 'KATE12', 'Texas ', 'texas, nevada 0-1', 'trip to america ', 'destinasi5.jpg'),
('D003', 'PRO125', 'KATE7', 'Osaka Aquarium Kaiyukan', '1 Chome-1-10 Kaigandori, Minato Ward, Osaka, 552-0022, Japan', 'nice and great', 'destinasi2.jpg'),
('D009', 'KABU124', 'KATE01', 'kebun raya bogor', 'jln bogor selatan raya 977', 'indah dan sejuk', 'destinasi4.jpg'),
('DESTINASI0', 'PRO125', 'KATE7', 'Osaka castle japan', '1-1 Osakajo, Chuo Ward, Osaka, 540-0002, Japan', 'Osaka Castle is a Japanese castle in Chūō-ku, Osaka, Japan.', 'destinasi1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `kode_kabupaten` char(10) NOT NULL,
  `nama_kabupaten` varchar(200) DEFAULT NULL,
  `gambarkabupaten` text NOT NULL,
  `kode_provinsi` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`kode_kabupaten`, `nama_kabupaten`, `gambarkabupaten`, `kode_provinsi`) VALUES
('KABU124', 'Bogor selatan', 'images.jpeg', 'PRO124'),
('KABU127', 'Seoul', 'desti5.jpeg', 'PRO126'),
('KABU129', 'Alaska', 'destinasi6.jpeg', 'PRO127'),
('PRO125', 'Osaka', 'destinasi1.jpg', 'PRO125');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` char(11) NOT NULL,
  `kategori_nama` varchar(255) DEFAULT NULL,
  `kategori_keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_keterangan`) VALUES
('KATE01', 'indonesia trip', 'sejuk dan indah'),
('KATE10', 'Alaska trip', 'Dingin dan indah'),
('KATE12', 'America trip', 'Trip to america'),
('KATE7', 'Japan tour', 'japan tour'),
('KATE8', 'Korean trip', 'Korean tour and trip');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `kode_kecamatan` char(10) NOT NULL,
  `nama_kecamatan` varchar(200) DEFAULT NULL,
  `gambarkecamatans` text NOT NULL,
  `kode_kabupaten` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`kode_kecamatan`, `nama_kecamatan`, `gambarkecamatans`, `kode_kabupaten`) VALUES
('KECAMA01', 'magelaang barat', ' images.jpeg', 'KABU123');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `kode_provinsi` char(10) NOT NULL,
  `nama_provinsi` varchar(200) DEFAULT NULL,
  `gambarprovinsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`kode_provinsi`, `nama_provinsi`, `gambarprovinsi`) VALUES
('P006', 'sumatra', 'images.jpeg'),
('P009', 'jawa timur', 'images.jpeg'),
('PRO123', 'Jawa barat', 'images.jpeg'),
('PRO124', 'Jawa tengah', 'images.jpeg'),
('PRO125', 'Osaka', 'destinasi1.jpg'),
('PRO126', 'Seoul', 'desti5.jpeg'),
('PRO127', 'Alaskan', 'destinasi6.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` char(10) NOT NULL,
  `isi_testimoni` varchar(150) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `gambartestimoni` text NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kota_negara` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `isi_testimoni`, `judul`, `gambartestimoni`, `nama`, `kota_negara`) VALUES
('TEST002', 'I enjoyed the content, keep it up!', 'Nice and great', 'users2.jpeg', 'Adele', 'United state of America'),
('TEST003', 'Great and beautiful ', 'Testimoni user', 'users.jpg', 'bruno', 'brazil'),
('TEST008', 'user testting', 'User test1', 'users2.jpeg', 'adele', 'america'),
('TEST01', 'This place is so incredible ', 'Great review', 'users.jpg', 'Bruno mars', 'Brazil');

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE `travel` (
  `id_travel` char(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `subjudul` varchar(150) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `linkvideo` varchar(150) NOT NULL,
  `gambartravel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id_travel`, `judul`, `subjudul`, `keterangan`, `linkvideo`, `gambartravel`) VALUES
('TRA01', 'Best Destinations', 'Travel, enjoy and live a new and full life.', 'great and beautiful website', 'https://www.youtube.com/watch?v=GpkYLIlpGWk', 'travel1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`berita_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `destinasiwisata`
--
ALTER TABLE `destinasiwisata`
  ADD PRIMARY KEY (`kode_destinasi`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`kode_kabupaten`),
  ADD UNIQUE KEY `kode_provinsi` (`kode_provinsi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`kode_kecamatan`),
  ADD UNIQUE KEY `kode_kabupaten` (`kode_kabupaten`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`kode_provinsi`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id_travel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
