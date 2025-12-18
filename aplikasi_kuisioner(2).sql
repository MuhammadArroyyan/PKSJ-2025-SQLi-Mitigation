-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 11:36 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_kuisioner`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` bigint UNSIGNED NOT NULL,
  `nama_fakultas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `created_at`, `updated_at`) VALUES
(1, 'FTTK (Fakultas Teknik dan Teknologi Kematiriman)', '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pertanyaan` bigint UNSIGNED NOT NULL,
  `id_pilihan_jawaban_pertanyaan` bigint UNSIGNED NOT NULL,
  `id_periode` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `nim`, `id_pertanyaan`, `id_pilihan_jawaban_pertanyaan`, `id_periode`, `created_at`, `updated_at`) VALUES
(3, '2301020002', 1, 1, 1, '2025-12-14 04:24:26', '2025-12-14 04:24:26'),
(4, '2301020002', 2, 6, 1, '2025-12-14 04:24:26', '2025-12-14 04:24:26'),
(5, '2301020002', 3, 11, 1, '2025-12-14 04:24:26', '2025-12-14 04:24:26'),
(6, '2301020002', 4, 15, 1, '2025-12-14 04:24:26', '2025-12-14 04:24:26'),
(7, '2301020002', 5, 19, 1, '2025-12-14 04:24:26', '2025-12-14 04:24:26'),
(8, '2301020106', 1, 2, 1, '2025-12-14 04:30:57', '2025-12-14 04:30:57'),
(9, '2301020106', 2, 6, 1, '2025-12-14 04:30:57', '2025-12-14 04:30:57'),
(10, '2301020106', 3, 11, 1, '2025-12-14 04:30:57', '2025-12-14 04:30:57'),
(11, '2301020106', 4, 15, 1, '2025-12-14 04:30:57', '2025-12-14 04:30:57'),
(12, '2301020106', 5, 19, 1, '2025-12-14 04:30:57', '2025-12-14 04:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` bigint UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_fakultas` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `id_fakultas`, `created_at`, `updated_at`) VALUES
(1, 'Jurusan Teknik Elektro dan Informatika', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 'Jurusan Teknik Industri Maritim', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(3, 'Jurusan Teknik Sipil dan Arsitektur', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user_mahasiswa` bigint UNSIGNED NOT NULL,
  `id_prodi` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mahasiswa`, `id_user_mahasiswa`, `id_prodi`, `created_at`, `updated_at`) VALUES
('2301020002', 'Rizqi Amanullah', 7, 1, '2025-12-14 04:24:01', '2025-12-14 04:24:01'),
('2301020106', 'Nathasya', 8, 1, '2025-12-14 04:30:31', '2025-12-14 04:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode_kuisioner`
--

CREATE TABLE `periode_kuisioner` (
  `id_periode` bigint UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_periode` enum('draft','active','closed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode_kuisioner`
--

INSERT INTO `periode_kuisioner` (`id_periode`, `keterangan`, `status_periode`, `created_at`, `updated_at`) VALUES
(1, 'Periode Semester Ganjil 2024', 'active', '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 'Periode Semester Genap 2024', 'draft', '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` bigint UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prodi` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_prodi`, `created_at`, `updated_at`) VALUES
(1, 'Seberapa puas Anda dengan kualitas pengajaran dosen?', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 'Apakah materi kuliah relevan dengan industri?', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(3, 'Bagaimana fasilitas laboratorium yang tersedia?', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(4, 'Apakah kurikulum sesuai dengan kebutuhan industri maritim?', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(5, 'Seberapa efektif praktikum perkapalan?', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_periode_kuisioner`
--

CREATE TABLE `pertanyaan_periode_kuisioner` (
  `id_pertanyaan_periode_kuisioner` bigint UNSIGNED NOT NULL,
  `id_periode_kuisioner` bigint UNSIGNED NOT NULL,
  `id_pertanyaan` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaan_periode_kuisioner`
--

INSERT INTO `pertanyaan_periode_kuisioner` (`id_pertanyaan_periode_kuisioner`, `id_periode_kuisioner`, `id_pertanyaan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 1, 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(3, 1, 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(4, 1, 4, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(5, 1, 5, '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_jawaban_pertanyaan`
--

CREATE TABLE `pilihan_jawaban_pertanyaan` (
  `id_pilihan_jawaban` bigint UNSIGNED NOT NULL,
  `deskripsi_pilihan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pertanyaan` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pilihan_jawaban_pertanyaan`
--

INSERT INTO `pilihan_jawaban_pertanyaan` (`id_pilihan_jawaban`, `deskripsi_pilihan`, `id_pertanyaan`, `created_at`, `updated_at`) VALUES
(1, 'Sangat Puas', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 'Puas', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(3, 'Cukup Puas', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(4, 'Kurang Puas', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(5, 'Sangat Tidak Puas', 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(6, 'Sangat Relevan', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(7, 'Relevan', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(8, 'Cukup Relevan', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(9, 'Kurang Relevan', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(10, 'Tidak Relevan', 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(11, 'Sangat Baik', 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(12, 'Baik', 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(13, 'Cukup', 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(14, 'Kurang', 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(15, 'Sangat Sesuai', 4, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(16, 'Sesuai', 4, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(17, 'Cukup Sesuai', 4, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(18, 'Kurang Sesuai', 4, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(19, 'Sangat Efektif', 5, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(20, 'Efektif', 5, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(21, 'Cukup Efektif', 5, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(22, 'Kurang Efektif', 5, '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` bigint UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user_kaprodi` bigint UNSIGNED NOT NULL,
  `id_jurusan` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `id_user_kaprodi`, `id_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 2, 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 'Teknik Perkapalan', 3, 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(3, 'Teknik Elektro', 2, 1, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(4, 'Teknik Industri', 3, 2, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(5, 'Teknik Kimia', 2, 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(6, 'Teknik Perancangan Wilayah Kota', 3, 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(7, 'Teknik Sipil', 2, 3, '2025-12-14 11:23:26', '2025-12-14 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','kaprodi','mahasiswa','pimpinan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mahasiswa',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin', '$2y$12$Z9p0bt8X4Eqb4j16cil8.eqnOOuQEbAAmSA4vIyPV.ml.e9dUIoWi', NULL, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(2, 'Kaprodi Teknik Informatika', 'kaprodi.ti@umrah.co.id', 'kaprodi', '$2y$12$Z9p0bt8X4Eqb4j16cil8.eqnOOuQEbAAmSA4vIyPV.ml.e9dUIoWi', NULL, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(3, 'Kaprodi Teknik Perkapalan', 'kaprodi.tp@umrah.co.id', 'kaprodi', '$2y$12$Z9p0bt8X4Eqb4j16cil8.eqnOOuQEbAAmSA4vIyPV.ml.e9dUIoWi', NULL, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(4, 'Pimpinan Fakultas', 'pimpinan@umrah.co.id', 'pimpinan', '$2y$12$Z9p0bt8X4Eqb4j16cil8.eqnOOuQEbAAmSA4vIyPV.ml.e9dUIoWi', NULL, '2025-12-14 11:23:26', '2025-12-14 11:23:26'),
(7, 'Rizqi Amanullah', '2301020002@umrah.ac.id', 'mahasiswa', '$2y$12$pp2tPc/tMKrZqZicyTsnTOMtWerufuHsOe7GKq8PeOltgb0ZtB2Vu', NULL, '2025-12-14 04:24:01', '2025-12-14 04:24:01'),
(8, 'Nathasya', '2301020106@umrah.ac.id', 'mahasiswa', '$2y$12$LBFveq02xiH6rNn/SD7yyeS1AC5Tt31Y1DEOPZG3mfGD9md7NVLvK', NULL, '2025-12-14 04:30:31', '2025-12-14 04:30:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD UNIQUE KEY `unique_jawaban` (`nim`,`id_pertanyaan`,`id_periode`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `id_pilihan_jawaban_pertanyaan` (`id_pilihan_jawaban_pertanyaan`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_user_mahasiswa` (`id_user_mahasiswa`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periode_kuisioner`
--
ALTER TABLE `periode_kuisioner`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `pertanyaan_periode_kuisioner`
--
ALTER TABLE `pertanyaan_periode_kuisioner`
  ADD PRIMARY KEY (`id_pertanyaan_periode_kuisioner`),
  ADD UNIQUE KEY `pk_periode_pertanyaan` (`id_periode_kuisioner`,`id_pertanyaan`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `pilihan_jawaban_pertanyaan`
--
ALTER TABLE `pilihan_jawaban_pertanyaan`
  ADD PRIMARY KEY (`id_pilihan_jawaban`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_user_kaprodi` (`id_user_kaprodi`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `periode_kuisioner`
--
ALTER TABLE `periode_kuisioner`
  MODIFY `id_periode` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pertanyaan_periode_kuisioner`
--
ALTER TABLE `pertanyaan_periode_kuisioner`
  MODIFY `id_pertanyaan_periode_kuisioner` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pilihan_jawaban_pertanyaan`
--
ALTER TABLE `pilihan_jawaban_pertanyaan`
  MODIFY `id_pilihan_jawaban` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`id_pilihan_jawaban_pertanyaan`) REFERENCES `pilihan_jawaban_pertanyaan` (`id_pilihan_jawaban`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_4` FOREIGN KEY (`id_periode`) REFERENCES `periode_kuisioner` (`id_periode`) ON DELETE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user_mahasiswa`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `pertanyaan_periode_kuisioner`
--
ALTER TABLE `pertanyaan_periode_kuisioner`
  ADD CONSTRAINT `pertanyaan_periode_kuisioner_ibfk_1` FOREIGN KEY (`id_periode_kuisioner`) REFERENCES `periode_kuisioner` (`id_periode`),
  ADD CONSTRAINT `pertanyaan_periode_kuisioner_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`);

--
-- Constraints for table `pilihan_jawaban_pertanyaan`
--
ALTER TABLE `pilihan_jawaban_pertanyaan`
  ADD CONSTRAINT `pilihan_jawaban_pertanyaan_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`);

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_user_kaprodi`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `prodi_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
