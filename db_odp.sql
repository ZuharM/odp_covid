-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 05:40 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_odp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `angka` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id`, `nama`, `angka`) VALUES
(1, 'Tidak', '0.0'),
(2, 'Sesekali', '0.5'),
(3, 'Sedikit', '0.5'),
(4, 'Tidak Terlalu', '0.5'),
(5, 'Ya', '1.0');

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `angka` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id`, `nama`, `angka`) VALUES
(1, 'traveler', '0.30'),
(2, 'fever', '0.80'),
(3, 'fatigue', '0.10'),
(4, 'dry cough', '0.80'),
(5, 'flu', '0.50'),
(6, 'anorexia', '0.01'),
(7, 'myalgia', '0.83'),
(8, 'dyspnea', '0.11'),
(9, 'pharyngalgia', '0.30'),
(10, 'diarrhea', '0.20'),
(11, 'dizziness', '0.07'),
(12, 'headache', '0.40'),
(13, 'vomiting', '0.13'),
(14, 'abdominal pain', '0.02'),
(15, 'cheast pain', '0.02'),
(16, 'heamoptysis', '0.05');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `jawaban_id` bigint(15) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pertanyaan_id` int(11) DEFAULT NULL,
  `bobot_jawab_id` int(11) DEFAULT NULL,
  `cf_user` decimal(10,2) DEFAULT NULL,
  `cf_value` decimal(10,2) DEFAULT NULL,
  `cf_combine` decimal(10,4) DEFAULT NULL,
  `jawaban_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `jawaban_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`jawaban_id`, `user_id`, `pertanyaan_id`, `bobot_jawab_id`, `cf_user`, `cf_value`, `cf_combine`, `jawaban_created`, `jawaban_updated`) VALUES
(1, 3, 1, 5, '1.00', '0.30', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(2, 3, 2, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(3, 3, 3, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(4, 3, 4, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(5, 3, 5, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(6, 3, 6, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(7, 3, 7, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(8, 3, 8, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(9, 3, 9, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(10, 3, 10, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(11, 3, 11, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(12, 3, 12, 1, '0.00', '0.00', '0.3000', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(13, 3, 13, 1, '0.00', '0.00', '0.3070', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(14, 3, 14, 1, '0.00', '0.00', '0.3417', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(15, 3, 15, 3, '0.50', '0.01', '0.3417', '2020-04-16 09:15:35', '2020-04-16 02:15:35'),
(16, 3, 16, 5, '1.00', '0.05', '0.3417', '2020-04-16 09:15:35', '2020-04-16 02:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `penyakit` text,
  `jawaban` text,
  `persentase` decimal(10,3) DEFAULT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `userid`, `penyakit`, `jawaban`, `persentase`, `uuid`, `created`) VALUES
(1, 3, 'Cardiovascular disease, batuk, pilek, ', '{\"1\":\"6\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"2\",\"8\":\"2\",\"9\":\"3\",\"10\":\"2\",\"11\":\"1\",\"12\":\"2\",\"13\":\"2\",\"14\":\"6\",\"15\":\"4\",\"16\":\"1\",\"17\":\"1\"}', '91.426', '1a2416c4-ea99-5344-911e-450a0160f546', '2020-04-13 04:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `nama`) VALUES
(1, 'Cardiovascular disease'),
(2, 'Diabetes'),
(3, 'Chronic respiratory disease'),
(4, 'Hypertension'),
(5, 'Cancer');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `pertanyaan_id` int(11) NOT NULL,
  `pil_jawaban` varchar(100) DEFAULT NULL,
  `indikator_id` int(11) DEFAULT NULL,
  `pertanyaan_konten` varchar(100) DEFAULT NULL,
  `pertanyaan_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pertanyaan_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`pertanyaan_id`, `pil_jawaban`, `indikator_id`, `pertanyaan_konten`, `pertanyaan_created`, `pertanyaan_updated`) VALUES
(1, '[\"1\",\"5\"]', 1, 'Apakah anda baru berpergian 14 hari terakhir ke area transmision (daerah terdampak Covid19) ?', '2020-04-15 09:51:39', '2020-04-15 02:51:39'),
(2, '[\"1\",\"3\",\"5\"]', 2, 'Apakah anda mengalami Gejala demam?', '2020-04-15 09:51:39', '2020-04-15 02:51:39'),
(3, '[\"1\",\"3\",\"5\"]', 3, 'Apakah anda merasa lelah?', '2020-04-15 09:52:36', '2020-04-15 02:52:36'),
(4, '[\"1\",\"3\",\"5\"]', 4, 'Apakah anda mengalami batuk kering?', '2020-04-15 09:52:36', '2020-04-15 02:52:36'),
(5, '[\"1\",\"3\",\"5\"]', 5, 'Apakah anda mengalami flu?', '2020-04-15 09:53:18', '2020-04-15 02:53:18'),
(6, '[\"1\",\"3\",\"5\"]', 6, 'Apakah anda mengalami kurang nafsu makan?', '2020-04-15 09:53:18', '2020-04-15 02:53:18'),
(7, '[\"1\",\"3\",\"5\"]', 7, 'Apakah anda mengalami nyeri otot?', '2020-04-15 09:53:56', '2020-04-15 02:53:56'),
(8, '[\"1\",\"3\",\"5\"]', 8, 'Apakah anda mengalami sesak nafas?', '2020-04-15 09:53:56', '2020-04-15 02:53:56'),
(9, '[\"1\",\"3\",\"5\"]', 9, 'Apakah anda mengalami nyeri ketika menelan?', '2020-04-15 10:07:47', '2020-04-15 03:07:47'),
(10, '[\"1\",\"3\",\"5\"]', 10, 'Apakah anda mengalami diare?', '2020-04-15 10:07:47', '2020-04-15 03:07:47'),
(11, '[\"1\",\"3\",\"5\"]', 11, ' Apakah anda merasa pusing?', '2020-04-15 10:08:47', '2020-04-15 03:08:47'),
(12, '[\"1\",\"3\",\"5\"]', 12, 'Apakah anda mengalami sakit kepala?', '2020-04-15 10:08:47', '2020-04-15 03:08:47'),
(13, '[\"1\",\"3\",\"5\"]', 13, 'Apakah anda menalami  muntah-muntah?', '2020-04-15 10:09:30', '2020-04-15 03:09:30'),
(14, '[\"1\",\"3\",\"5\"]', 14, 'Apakah anda mengalami sakit perut?', '2020-04-15 10:09:30', '2020-04-15 03:09:30'),
(15, '[\"1\",\"3\",\"5\"]', 15, 'Apakah anda mengalami nyeri pada bagian dada?', '2020-04-15 10:10:02', '2020-04-15 03:10:02'),
(16, '[\"1\",\"3\",\"5\"]', 16, 'Apakah anda mengalami batuk berdarah?', '2020-04-15 10:10:02', '2020-04-15 03:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) DEFAULT NULL,
  `upass` varchar(200) DEFAULT NULL,
  `upass_hid` varchar(255) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `telepon` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `alamat` text,
  `darah` char(5) DEFAULT NULL COMMENT 'config_item(''darah'')',
  `agama` char(5) DEFAULT NULL COMMENT 'config_item(''agama'')',
  `status_kawin` char(1) DEFAULT NULL COMMENT '1 => ''Belum Menikah'',\r\n2 => ''Menikah'',\r\n3 => ''Janda/Duda''',
  `pekerjaan` varchar(200) DEFAULT NULL,
  `tempat_lahir` varchar(200) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `upass`, `upass_hid`, `nama`, `level`, `telepon`, `email`, `alamat`, `darah`, `agama`, `status_kawin`, `pekerjaan`, `tempat_lahir`, `tanggal_lahir`, `uuid`, `created`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Administrator', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-14 17:56:01'),
(3, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user1', 'Mirza Purnandi', 'user', '085277131810', 'mirza.purnandi@gmail.com', 'Jl. Kenari Lr. Nuri, Lamlagang, Banda Aceh', 'B', '1', '2', 'Staf Programmer', 'Banda Aceh', '1990-02-13', '1d54d5fe-ae8f-5703-881a-264e98e3a97a', '2020-04-13 02:14:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`jawaban_id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`pertanyaan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `jawaban_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `pertanyaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
