-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2026 pada 07.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organisasi-app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggotas`
--

CREATE TABLE `anggotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_kartu` varchar(16) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `ktp_provinsi_code` varchar(2) NOT NULL,
  `ktp_provinsi_name` varchar(255) NOT NULL,
  `ktp_kota_code` varchar(10) NOT NULL,
  `ktp_kota_name` varchar(255) NOT NULL,
  `ktp_kecamatan_code` varchar(15) NOT NULL,
  `ktp_kecamatan_name` varchar(255) NOT NULL,
  `ktp_kelurahan_code` varchar(20) NOT NULL,
  `ktp_kelurahan_name` varchar(255) NOT NULL,
  `ktp_rt_rw` varchar(10) DEFAULT NULL,
  `ktp_alamat_detail` text NOT NULL,
  `domisili_provinsi_code` varchar(2) NOT NULL,
  `domisili_provinsi_name` varchar(255) NOT NULL,
  `domisili_kota_code` varchar(10) NOT NULL,
  `domisili_kota_name` varchar(255) NOT NULL,
  `domisili_kecamatan_code` varchar(15) NOT NULL,
  `domisili_kecamatan_name` varchar(255) NOT NULL,
  `domisili_kelurahan_code` varchar(20) NOT NULL,
  `domisili_kelurahan_name` varchar(255) NOT NULL,
  `domisili_rt_rw` varchar(10) DEFAULT NULL,
  `domisili_alamat_detail` text NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jml_keluarga_inti` int(11) NOT NULL DEFAULT 0,
  `jml_keluarga_serumah` int(11) NOT NULL DEFAULT 0,
  `ketertarikan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ketertarikan`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `registered_by` bigint(20) UNSIGNED DEFAULT NULL,
  `registered_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggotas`
--

INSERT INTO `anggotas` (`id`, `user_id`, `no_kartu`, `nik`, `nama_lengkap`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `pendidikan_terakhir`, `pekerjaan`, `ktp_provinsi_code`, `ktp_provinsi_name`, `ktp_kota_code`, `ktp_kota_name`, `ktp_kecamatan_code`, `ktp_kecamatan_name`, `ktp_kelurahan_code`, `ktp_kelurahan_name`, `ktp_rt_rw`, `ktp_alamat_detail`, `domisili_provinsi_code`, `domisili_provinsi_name`, `domisili_kota_code`, `domisili_kota_name`, `domisili_kecamatan_code`, `domisili_kecamatan_name`, `domisili_kelurahan_code`, `domisili_kelurahan_name`, `domisili_rt_rw`, `domisili_alamat_detail`, `no_wa`, `email`, `jml_keluarga_inti`, `jml_keluarga_serumah`, `ketertarikan`, `is_active`, `registered_by`, `registered_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, '01112632010001', '3201010101900001', 'Ahmad Fauzi', '1990-01-01', 'L', 'Islam', 'S1', 'Karyawan Swasta/BUMN/BUMD', '32', 'Jawa Barat', '3201', 'Kabupaten Bogor', '3201010', 'Cibinong', '3201010001', 'Nanggewer', '001/002', 'Jl. Raya Bogor No. 123', '32', 'Jawa Barat', '3201', 'Kabupaten Bogor', '3201010', 'Cibinong', '3201010001', 'Nanggewer', '001/002', 'Jl. Raya Bogor No. 123', '081234567890', 'ahmad@example.com', 4, 4, '\"[\\\"Pendidikan\\\",\\\"Sosial\\\",\\\"Ekonomi\\\"]\"', 1, 1, '2026-06-24 01:47:27', NULL, '2026-06-24 01:47:27', '2026-06-24 01:47:27'),
(2, NULL, '02122632020001', '3202020202900002', 'Siti Nurhaliza', '1990-02-02', 'P', 'Islam', 'S1', 'Pegawai Negeri Sipil/PPPK', '32', 'Jawa Barat', '3202', 'Kota Bogor', '3202020', 'Bogor Tengah', '3202020001', 'Sempur', '003/004', 'Jl. Pahlawan No. 45', '32', 'Jawa Barat', '3202', 'Kota Bogor', '3202020', 'Bogor Tengah', '3202020001', 'Sempur', '003/004', 'Jl. Pahlawan No. 45', '082345678901', 'siti@example.com', 3, 3, '\"[\\\"Lingkungan Hidup\\\",\\\"Sosial\\\",\\\"Pendidikan\\\"]\"', 1, 1, '2026-06-24 01:47:27', NULL, '2026-06-24 01:47:27', '2026-06-24 01:47:27'),
(3, NULL, '03112611020001', '3276020101900001', 'Ezza Eka Pramana', '0123-03-12', 'L', 'Penghayat Kepercayaan', 'S1', 'Buruh Harian Lepas', '11', 'Aceh', '11.02', 'Kabupaten Aceh Tenggara', '11.02.01', 'Lawe Alas', '11.02.01.2004', 'Pasir Bangun', '09/12', 'aasdasdasdasd', '11', 'Aceh', '11.02', 'Kabupaten Aceh Tenggara', '11.02.01', 'Lawe Alas', '11.02.01.2004', 'Pasir Bangun', '09/12', 'aasdasdasdasd', '9898789789897', 'ezaprambanan@gmail.com', 1, 1, '\"[\\\"Pendidikan\\\",\\\"Ekonomi\\\"]\"', 1, 1, '2026-06-24 02:25:18', NULL, '2026-06-24 02:25:18', '2026-06-24 02:25:18'),
(4, NULL, '0612262615030001', '3276021502850002', 'swaasd', '2022-06-18', 'P', 'Katolik', 'S2', 'Wirausaha', '15', 'Jambi', '15.03', 'Kabupaten Sarolangun', '15.03.05', 'Pelawan', '15.03.05.2005', 'Lubuk Sepuh', '09/12', 'sssss', '15', 'Jambi', '15.03', 'Kabupaten Sarolangun', '15.03.05', 'Pelawan', '15.03.05.2005', 'Lubuk Sepuh', '09/12', 'ssssss', '98987897822', 'ezaprambanan@gmail.coms', 1, 2, '[\"Pendidikan\"]', 1, 1, '2026-06-24 04:15:22', NULL, '2026-06-24 04:15:22', '2026-06-25 01:28:04'),
(5, NULL, '0611262631740001', '3276020101902222', 'Ezza Eka Pramana', '2026-06-17', 'L', 'Islam', 'S3', 'Karyawan Swasta/BUMN/BUMD', '31', 'DKI Jakarta', '31.74', 'Kota Administrasi Jakarta Selatan', '31.74.06', 'Cilandak', '31.74.06.1002', 'Lebak Bulus', '09/12', 'ssd', '31', 'DKI Jakarta', '31.74', 'Kota Administrasi Jakarta Selatan', '31.74.06', 'Cilandak', '31.74.06.1002', 'Lebak Bulus', '09/12', 'ssds', '98987897822', 'ezaprambanan@gmail.comas', 5, 5, '\"[\\\"Pendidikan\\\",\\\"Ekonomi\\\"]\"', 1, 1, '2026-06-24 04:19:16', NULL, '2026-06-24 04:19:16', '2026-06-24 04:19:16'),
(6, NULL, '0611262611030006', '3276022003881111', 'Ezza Eka Pramanass', '2026-06-17', 'L', 'Islam', 'S3', 'Guru/Dosen', '11', 'Aceh', '11.03', 'Kabupaten Aceh Timur', '11.03.03', 'Idi Rayeuk', '11.03.03.2003', 'Tanoh Anoe', '09/12', 'asd', '11', 'Aceh', '11.03', 'Kabupaten Aceh Timur', '11.03.03', 'Idi Rayeuk', '11.03.03.2003', 'Tanoh Anoe', '09/12', 'asd', '9898789789897', 'ezaprambanan@gmail.comaasds', 5, 5, '\"[\\\"Ekonomi\\\"]\"', 1, 1, '2026-06-24 04:22:15', NULL, '2026-06-24 04:22:15', '2026-06-24 04:22:15'),
(7, NULL, '0611262631740007', '3276022003880212', 'Waseso', '2026-06-16', 'L', 'Islam', 'S1', 'Wirausaha', '31', 'DKI Jakarta', '31.74', 'Kota Administrasi Jakarta Selatan', '31.74.08', 'Pancoran', '31.74.08.1002', 'Kalibata', '09/12', 'asdasdasdasdasd', '31', 'DKI Jakarta', '31.74', 'Kota Administrasi Jakarta Selatan', '31.74.08', 'Pancoran', '31.74.08.1002', 'Kalibata', '09/12', 'asdasdasdasdasd', '989878978233', 'ezaprambanan@gmail.comasdasasd', 3, 2, '\"[\\\"Pendidikan\\\",\\\"Ekonomi\\\"]\"', 1, 2, '2026-06-25 00:05:06', NULL, '2026-06-25 00:05:06', '2026-06-25 00:05:06'),
(8, NULL, '0611262619010008', '3276020101912312', 'Ezza Eka Pramana', '2026-06-24', 'L', 'Khong Hu Chu', 'S3', 'Guru/Dosen', '19', 'Kepulauan Bangka Belitung', '19.03', 'Kabupaten Bangka Selatan', '19.03.06', 'Tukak Sadai', '19.03.06.2002', 'Tukak', '09/12', 'asdasdasd', '19', 'Kepulauan Bangka Belitung', '19.01', 'Kabupaten Bangka', '19.01.06', 'Bakam', '19.01.06.2005', 'Tiang Tarah', '09/12', 'asdasdasd', '9898789789897', 'ezaprambanan@gmail.comasdasd', 2, 2, '\"[\\\"Pendidikan\\\",\\\"Ekonomi\\\"]\"', 1, 1, '2026-06-25 01:05:02', NULL, '2026-06-25 01:05:02', '2026-06-25 01:05:02'),
(9, NULL, '0611262631740009', '3276020101901232', 'Ezza Eka Pramana', '2026-06-02', 'L', 'Islam', 'S3', 'Wirausaha', '31', 'DKI Jakarta', '31.74', 'Kota Administrasi Jakarta Selatan', '31.74.09', 'Jagakarsa', '31.74.09.1003', 'Ciganjur', '112/221', 'asdas', '31', 'DKI Jakarta', '31.74', 'Kota Administrasi Jakarta Selatan', '31.74.09', 'Jagakarsa', '31.74.09.1003', 'Ciganjur', '112/221', 'asdas', '9898789789897', 'ezaprambanan@gmail.comaa', 1, 2, '\"[\\\"Pendidikan\\\",\\\"Ekonomi\\\"]\"', 1, 1, '2026-06-25 01:20:25', NULL, '2026-06-25 01:20:25', '2026-06-25 01:20:25'),
(10, NULL, '0611262631710010', '1232132222222222', 'Ezza Eka Pramanaaa', '2026-06-02', 'L', 'Islam', 'S3', 'Guru/Dosen', '31', 'DKI Jakarta', '31.71', 'Kota Administrasi Jakarta Pusat', '31.71.07', 'Tanah Abang', '31.71.07.1005', 'Kebon Melati', '008/009', 'aasd', '31', 'DKI Jakarta', '31.71', 'Kota Administrasi Jakarta Pusat', '31.71.07', 'Tanah Abang', '31.71.07.1005', 'Kebon Melati', '008/009', 'aasd', '9898789789897', 'ezaprambanan@gmail.comaaa', 1, 1, '\"[\\\"Ekonomi\\\",\\\"Pertanian\\\\\\/Perikanan\\\"]\"', 1, 1, '2026-06-25 08:27:37', NULL, '2026-06-25 08:27:37', '2026-06-25 08:27:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-districts_11.02', 'a:16:{i:0;a:2:{s:4:\"code\";s:8:\"11.02.01\";s:4:\"name\";s:9:\"Lawe Alas\";}i:1;a:2:{s:4:\"code\";s:8:\"11.02.02\";s:4:\"name\";s:16:\"Lawe Sigala-Gala\";}i:2;a:2:{s:4:\"code\";s:8:\"11.02.03\";s:4:\"name\";s:6:\"Bambel\";}i:3;a:2:{s:4:\"code\";s:8:\"11.02.04\";s:4:\"name\";s:10:\"Babussalam\";}i:4;a:2:{s:4:\"code\";s:8:\"11.02.05\";s:4:\"name\";s:5:\"Badar\";}i:5;a:2:{s:4:\"code\";s:8:\"11.02.06\";s:4:\"name\";s:12:\"Babul Makmur\";}i:6;a:2:{s:4:\"code\";s:8:\"11.02.07\";s:4:\"name\";s:13:\"Darul Hasanah\";}i:7;a:2:{s:4:\"code\";s:8:\"11.02.08\";s:4:\"name\";s:10:\"Lawe Bulan\";}i:8;a:2:{s:4:\"code\";s:8:\"11.02.09\";s:4:\"name\";s:11:\"Bukit Tusam\";}i:9;a:2:{s:4:\"code\";s:8:\"11.02.10\";s:4:\"name\";s:7:\"Semadam\";}i:10;a:2:{s:4:\"code\";s:8:\"11.02.11\";s:4:\"name\";s:12:\"Babul Rahmah\";}i:11;a:2:{s:4:\"code\";s:8:\"11.02.12\";s:4:\"name\";s:7:\"Ketambe\";}i:12;a:2:{s:4:\"code\";s:8:\"11.02.13\";s:4:\"name\";s:16:\"Deleng Pokhkisen\";}i:13;a:2:{s:4:\"code\";s:8:\"11.02.14\";s:4:\"name\";s:10:\"Lawe Sumur\";}i:14;a:2:{s:4:\"code\";s:8:\"11.02.15\";s:4:\"name\";s:10:\"Tanoh Alas\";}i:15;a:2:{s:4:\"code\";s:8:\"11.02.16\";s:4:\"name\";s:6:\"Leuser\";}}', 1782296690),
('laravel-cache-districts_11.03', 'a:24:{i:0;a:2:{s:4:\"code\";s:8:\"11.03.01\";s:4:\"name\";s:10:\"Darul Aman\";}i:1;a:2:{s:4:\"code\";s:8:\"11.03.02\";s:4:\"name\";s:5:\"Julok\";}i:2;a:2:{s:4:\"code\";s:8:\"11.03.03\";s:4:\"name\";s:10:\"Idi Rayeuk\";}i:3;a:2:{s:4:\"code\";s:8:\"11.03.04\";s:4:\"name\";s:12:\"Birem Bayeun\";}i:4;a:2:{s:4:\"code\";s:8:\"11.03.05\";s:4:\"name\";s:9:\"Serbajadi\";}i:5;a:2:{s:4:\"code\";s:8:\"11.03.06\";s:4:\"name\";s:10:\"Nurussalam\";}i:6;a:2:{s:4:\"code\";s:8:\"11.03.07\";s:4:\"name\";s:9:\"Peureulak\";}i:7;a:2:{s:4:\"code\";s:8:\"11.03.08\";s:4:\"name\";s:14:\"Rantau Selamat\";}i:8;a:2:{s:4:\"code\";s:8:\"11.03.09\";s:4:\"name\";s:12:\"Simpang Ulim\";}i:9;a:2:{s:4:\"code\";s:8:\"11.03.10\";s:4:\"name\";s:15:\"Ranto Peureulak\";}i:10;a:2:{s:4:\"code\";s:8:\"11.03.11\";s:4:\"name\";s:12:\"Pante Bidari\";}i:11;a:2:{s:4:\"code\";s:8:\"11.03.12\";s:4:\"name\";s:5:\"Madat\";}i:12;a:2:{s:4:\"code\";s:8:\"11.03.13\";s:4:\"name\";s:11:\"Indra Makmu\";}i:13;a:2:{s:4:\"code\";s:8:\"11.03.14\";s:4:\"name\";s:10:\"Idi Tunong\";}i:14;a:2:{s:4:\"code\";s:8:\"11.03.15\";s:4:\"name\";s:10:\"Banda Alam\";}i:15;a:2:{s:4:\"code\";s:8:\"11.03.16\";s:4:\"name\";s:7:\"Peudawa\";}i:16;a:2:{s:4:\"code\";s:8:\"11.03.17\";s:4:\"name\";s:15:\"Peureulak Timur\";}i:17;a:2:{s:4:\"code\";s:8:\"11.03.18\";s:4:\"name\";s:15:\"Peureulak Barat\";}i:18;a:2:{s:4:\"code\";s:8:\"11.03.19\";s:4:\"name\";s:11:\"Sungai Raya\";}i:19;a:2:{s:4:\"code\";s:8:\"11.03.20\";s:4:\"name\";s:14:\"Simpang Jernih\";}i:20;a:2:{s:4:\"code\";s:8:\"11.03.21\";s:4:\"name\";s:11:\"Darul Ihsan\";}i:21;a:2:{s:4:\"code\";s:8:\"11.03.22\";s:4:\"name\";s:11:\"Darul Falah\";}i:22;a:2:{s:4:\"code\";s:8:\"11.03.23\";s:4:\"name\";s:9:\"Idi Timur\";}i:23;a:2:{s:4:\"code\";s:8:\"11.03.24\";s:4:\"name\";s:8:\"Peunaron\";}}', 1782303712),
('laravel-cache-districts_11.13', 'a:11:{i:0;a:2:{s:4:\"code\";s:8:\"11.13.01\";s:4:\"name\";s:12:\"Blangkejeren\";}i:1;a:2:{s:4:\"code\";s:8:\"11.13.02\";s:4:\"name\";s:11:\"Kutapanjang\";}i:2;a:2:{s:4:\"code\";s:8:\"11.13.03\";s:4:\"name\";s:10:\"Rikit Gaib\";}i:3;a:2:{s:4:\"code\";s:8:\"11.13.04\";s:4:\"name\";s:8:\"Terangun\";}i:4;a:2:{s:4:\"code\";s:8:\"11.13.05\";s:4:\"name\";s:6:\"Pining\";}i:5;a:2:{s:4:\"code\";s:8:\"11.13.06\";s:4:\"name\";s:12:\"Blangpegayon\";}i:6;a:2:{s:4:\"code\";s:8:\"11.13.07\";s:4:\"name\";s:13:\"Puteri Betung\";}i:7;a:2:{s:4:\"code\";s:8:\"11.13.08\";s:4:\"name\";s:12:\"Dabun Gelang\";}i:8;a:2:{s:4:\"code\";s:8:\"11.13.09\";s:4:\"name\";s:12:\"Blangjerango\";}i:9;a:2:{s:4:\"code\";s:8:\"11.13.10\";s:4:\"name\";s:11:\"Teripe Jaya\";}i:10;a:2:{s:4:\"code\";s:8:\"11.13.11\";s:4:\"name\";s:12:\"Pantan Cuaca\";}}', 1782296226),
('laravel-cache-districts_15.03', 'a:11:{i:0;a:2:{s:4:\"code\";s:8:\"15.03.01\";s:4:\"name\";s:11:\"Batang Asai\";}i:1;a:2:{s:4:\"code\";s:8:\"15.03.02\";s:4:\"name\";s:5:\"Limun\";}i:2;a:2:{s:4:\"code\";s:8:\"15.03.03\";s:4:\"name\";s:10:\"Sarolangun\";}i:3;a:2:{s:4:\"code\";s:8:\"15.03.04\";s:4:\"name\";s:4:\"Pauh\";}i:4;a:2:{s:4:\"code\";s:8:\"15.03.05\";s:4:\"name\";s:7:\"Pelawan\";}i:5;a:2:{s:4:\"code\";s:8:\"15.03.06\";s:4:\"name\";s:10:\"Mandiangin\";}i:6;a:2:{s:4:\"code\";s:8:\"15.03.07\";s:4:\"name\";s:9:\"Air Hitam\";}i:7;a:2:{s:4:\"code\";s:8:\"15.03.08\";s:4:\"name\";s:11:\"Bathin VIII\";}i:8;a:2:{s:4:\"code\";s:8:\"15.03.09\";s:4:\"name\";s:7:\"Singkut\";}i:9;a:2:{s:4:\"code\";s:8:\"15.03.10\";s:4:\"name\";s:17:\"Cermin Nan Gedang\";}i:10;a:2:{s:4:\"code\";s:8:\"15.03.11\";s:4:\"name\";s:16:\"Mandiangin Timur\";}}', 1782303289),
('laravel-cache-districts_21.01', 'a:10:{i:0;a:2:{s:4:\"code\";s:8:\"21.01.04\";s:4:\"name\";s:13:\"Gunung Kijang\";}i:1;a:2:{s:4:\"code\";s:8:\"21.01.06\";s:4:\"name\";s:12:\"Bintan Timur\";}i:2;a:2:{s:4:\"code\";s:8:\"21.01.07\";s:4:\"name\";s:12:\"Bintan Utara\";}i:3;a:2:{s:4:\"code\";s:8:\"21.01.08\";s:4:\"name\";s:12:\"Teluk Bintan\";}i:4;a:2:{s:4:\"code\";s:8:\"21.01.09\";s:4:\"name\";s:8:\"Tambelan\";}i:5;a:2:{s:4:\"code\";s:8:\"21.01.10\";s:4:\"name\";s:12:\"Teluk Sebong\";}i:6;a:2:{s:4:\"code\";s:8:\"21.01.12\";s:4:\"name\";s:7:\"Toapaya\";}i:7;a:2:{s:4:\"code\";s:8:\"21.01.13\";s:4:\"name\";s:7:\"Mantang\";}i:8;a:2:{s:4:\"code\";s:8:\"21.01.14\";s:4:\"name\";s:14:\"Bintan Pesisir\";}i:9;a:2:{s:4:\"code\";s:8:\"21.01.15\";s:4:\"name\";s:16:\"Seri Kuala Lobam\";}}', 1782332220),
('laravel-cache-districts_31.71', 'a:8:{i:0;a:2:{s:4:\"code\";s:8:\"31.71.01\";s:4:\"name\";s:6:\"Gambir\";}i:1;a:2:{s:4:\"code\";s:8:\"31.71.02\";s:4:\"name\";s:11:\"Sawah Besar\";}i:2;a:2:{s:4:\"code\";s:8:\"31.71.03\";s:4:\"name\";s:9:\"Kemayoran\";}i:3;a:2:{s:4:\"code\";s:8:\"31.71.04\";s:4:\"name\";s:5:\"Senen\";}i:4;a:2:{s:4:\"code\";s:8:\"31.71.05\";s:4:\"name\";s:13:\"Cempaka Putih\";}i:5;a:2:{s:4:\"code\";s:8:\"31.71.06\";s:4:\"name\";s:7:\"Menteng\";}i:6;a:2:{s:4:\"code\";s:8:\"31.71.07\";s:4:\"name\";s:11:\"Tanah Abang\";}i:7;a:2:{s:4:\"code\";s:8:\"31.71.08\";s:4:\"name\";s:10:\"Johar Baru\";}}', 1782303514),
('laravel-cache-districts_31.74', 'a:10:{i:0;a:2:{s:4:\"code\";s:8:\"31.74.01\";s:4:\"name\";s:5:\"Tebet\";}i:1;a:2:{s:4:\"code\";s:8:\"31.74.02\";s:4:\"name\";s:9:\"Setiabudi\";}i:2;a:2:{s:4:\"code\";s:8:\"31.74.03\";s:4:\"name\";s:16:\"Mampang Prapatan\";}i:3;a:2:{s:4:\"code\";s:8:\"31.74.04\";s:4:\"name\";s:12:\"Pasar Minggu\";}i:4;a:2:{s:4:\"code\";s:8:\"31.74.05\";s:4:\"name\";s:14:\"Kebayoran Lama\";}i:5;a:2:{s:4:\"code\";s:8:\"31.74.06\";s:4:\"name\";s:8:\"Cilandak\";}i:6;a:2:{s:4:\"code\";s:8:\"31.74.07\";s:4:\"name\";s:14:\"Kebayoran Baru\";}i:7;a:2:{s:4:\"code\";s:8:\"31.74.08\";s:4:\"name\";s:8:\"Pancoran\";}i:8;a:2:{s:4:\"code\";s:8:\"31.74.09\";s:4:\"name\";s:9:\"Jagakarsa\";}i:9;a:2:{s:4:\"code\";s:8:\"31.74.10\";s:4:\"name\";s:12:\"Pesanggrahan\";}}', 1782303517),
('laravel-cache-districts_65.02', 'a:15:{i:0;a:2:{s:4:\"code\";s:8:\"65.02.01\";s:4:\"name\";s:9:\"Mentarang\";}i:1;a:2:{s:4:\"code\";s:8:\"65.02.02\";s:4:\"name\";s:12:\"Malinau Kota\";}i:2;a:2:{s:4:\"code\";s:8:\"65.02.03\";s:4:\"name\";s:8:\"Pujungan\";}i:3;a:2:{s:4:\"code\";s:8:\"65.02.04\";s:4:\"name\";s:11:\"Kayan Hilir\";}i:4;a:2:{s:4:\"code\";s:8:\"65.02.05\";s:4:\"name\";s:10:\"Kayan Hulu\";}i:5;a:2:{s:4:\"code\";s:8:\"65.02.06\";s:4:\"name\";s:15:\"Malinau Selatan\";}i:6;a:2:{s:4:\"code\";s:8:\"65.02.07\";s:4:\"name\";s:13:\"Malinau Utara\";}i:7;a:2:{s:4:\"code\";s:8:\"65.02.08\";s:4:\"name\";s:13:\"Malinau Barat\";}i:8;a:2:{s:4:\"code\";s:8:\"65.02.09\";s:4:\"name\";s:10:\"Sungai Boh\";}i:9;a:2:{s:4:\"code\";s:8:\"65.02.10\";s:4:\"name\";s:13:\"Kayan Selatan\";}i:10;a:2:{s:4:\"code\";s:8:\"65.02.11\";s:4:\"name\";s:10:\"Bahau Hulu\";}i:11;a:2:{s:4:\"code\";s:8:\"65.02.12\";s:4:\"name\";s:14:\"Mentarang Hulu\";}i:12;a:2:{s:4:\"code\";s:8:\"65.02.13\";s:4:\"name\";s:21:\"Malinau Selatan Hilir\";}i:13;a:2:{s:4:\"code\";s:8:\"65.02.14\";s:4:\"name\";s:20:\"Malinau Selatan Hulu\";}i:14;a:2:{s:4:\"code\";s:8:\"65.02.15\";s:4:\"name\";s:11:\"Sungai Tubu\";}}', 1782296266),
('laravel-cache-provinces', 'a:38:{i:0;a:2:{s:4:\"code\";s:2:\"11\";s:4:\"name\";s:4:\"Aceh\";}i:1;a:2:{s:4:\"code\";s:2:\"12\";s:4:\"name\";s:14:\"Sumatera Utara\";}i:2;a:2:{s:4:\"code\";s:2:\"13\";s:4:\"name\";s:14:\"Sumatera Barat\";}i:3;a:2:{s:4:\"code\";s:2:\"14\";s:4:\"name\";s:4:\"Riau\";}i:4;a:2:{s:4:\"code\";s:2:\"15\";s:4:\"name\";s:5:\"Jambi\";}i:5;a:2:{s:4:\"code\";s:2:\"16\";s:4:\"name\";s:16:\"Sumatera Selatan\";}i:6;a:2:{s:4:\"code\";s:2:\"17\";s:4:\"name\";s:8:\"Bengkulu\";}i:7;a:2:{s:4:\"code\";s:2:\"18\";s:4:\"name\";s:7:\"Lampung\";}i:8;a:2:{s:4:\"code\";s:2:\"19\";s:4:\"name\";s:25:\"Kepulauan Bangka Belitung\";}i:9;a:2:{s:4:\"code\";s:2:\"21\";s:4:\"name\";s:14:\"Kepulauan Riau\";}i:10;a:2:{s:4:\"code\";s:2:\"31\";s:4:\"name\";s:11:\"DKI Jakarta\";}i:11;a:2:{s:4:\"code\";s:2:\"32\";s:4:\"name\";s:10:\"Jawa Barat\";}i:12;a:2:{s:4:\"code\";s:2:\"33\";s:4:\"name\";s:11:\"Jawa Tengah\";}i:13;a:2:{s:4:\"code\";s:2:\"34\";s:4:\"name\";s:26:\"Daerah Istimewa Yogyakarta\";}i:14;a:2:{s:4:\"code\";s:2:\"35\";s:4:\"name\";s:10:\"Jawa Timur\";}i:15;a:2:{s:4:\"code\";s:2:\"36\";s:4:\"name\";s:6:\"Banten\";}i:16;a:2:{s:4:\"code\";s:2:\"51\";s:4:\"name\";s:4:\"Bali\";}i:17;a:2:{s:4:\"code\";s:2:\"52\";s:4:\"name\";s:19:\"Nusa Tenggara Barat\";}i:18;a:2:{s:4:\"code\";s:2:\"53\";s:4:\"name\";s:19:\"Nusa Tenggara Timur\";}i:19;a:2:{s:4:\"code\";s:2:\"61\";s:4:\"name\";s:16:\"Kalimantan Barat\";}i:20;a:2:{s:4:\"code\";s:2:\"62\";s:4:\"name\";s:17:\"Kalimantan Tengah\";}i:21;a:2:{s:4:\"code\";s:2:\"63\";s:4:\"name\";s:18:\"Kalimantan Selatan\";}i:22;a:2:{s:4:\"code\";s:2:\"64\";s:4:\"name\";s:16:\"Kalimantan Timur\";}i:23;a:2:{s:4:\"code\";s:2:\"65\";s:4:\"name\";s:16:\"Kalimantan Utara\";}i:24;a:2:{s:4:\"code\";s:2:\"71\";s:4:\"name\";s:14:\"Sulawesi Utara\";}i:25;a:2:{s:4:\"code\";s:2:\"72\";s:4:\"name\";s:15:\"Sulawesi Tengah\";}i:26;a:2:{s:4:\"code\";s:2:\"73\";s:4:\"name\";s:16:\"Sulawesi Selatan\";}i:27;a:2:{s:4:\"code\";s:2:\"74\";s:4:\"name\";s:17:\"Sulawesi Tenggara\";}i:28;a:2:{s:4:\"code\";s:2:\"75\";s:4:\"name\";s:9:\"Gorontalo\";}i:29;a:2:{s:4:\"code\";s:2:\"76\";s:4:\"name\";s:14:\"Sulawesi Barat\";}i:30;a:2:{s:4:\"code\";s:2:\"81\";s:4:\"name\";s:6:\"Maluku\";}i:31;a:2:{s:4:\"code\";s:2:\"82\";s:4:\"name\";s:12:\"Maluku Utara\";}i:32;a:2:{s:4:\"code\";s:2:\"91\";s:4:\"name\";s:5:\"Papua\";}i:33;a:2:{s:4:\"code\";s:2:\"92\";s:4:\"name\";s:11:\"Papua Barat\";}i:34;a:2:{s:4:\"code\";s:2:\"93\";s:4:\"name\";s:13:\"Papua Selatan\";}i:35;a:2:{s:4:\"code\";s:2:\"94\";s:4:\"name\";s:12:\"Papua Tengah\";}i:36;a:2:{s:4:\"code\";s:2:\"95\";s:4:\"name\";s:16:\"Papua Pegunungan\";}i:37;a:2:{s:4:\"code\";s:2:\"96\";s:4:\"name\";s:16:\"Papua Barat Daya\";}}', 1782370192),
('laravel-cache-regencies_11', 'a:23:{i:0;a:2:{s:4:\"code\";s:5:\"11.01\";s:4:\"name\";s:22:\"Kabupaten Aceh Selatan\";}i:1;a:2:{s:4:\"code\";s:5:\"11.02\";s:4:\"name\";s:23:\"Kabupaten Aceh Tenggara\";}i:2;a:2:{s:4:\"code\";s:5:\"11.03\";s:4:\"name\";s:20:\"Kabupaten Aceh Timur\";}i:3;a:2:{s:4:\"code\";s:5:\"11.04\";s:4:\"name\";s:21:\"Kabupaten Aceh Tengah\";}i:4;a:2:{s:4:\"code\";s:5:\"11.05\";s:4:\"name\";s:20:\"Kabupaten Aceh Barat\";}i:5;a:2:{s:4:\"code\";s:5:\"11.06\";s:4:\"name\";s:20:\"Kabupaten Aceh Besar\";}i:6;a:2:{s:4:\"code\";s:5:\"11.07\";s:4:\"name\";s:15:\"Kabupaten Pidie\";}i:7;a:2:{s:4:\"code\";s:5:\"11.08\";s:4:\"name\";s:20:\"Kabupaten Aceh Utara\";}i:8;a:2:{s:4:\"code\";s:5:\"11.09\";s:4:\"name\";s:18:\"Kabupaten Simeulue\";}i:9;a:2:{s:4:\"code\";s:5:\"11.10\";s:4:\"name\";s:22:\"Kabupaten Aceh Singkil\";}i:10;a:2:{s:4:\"code\";s:5:\"11.11\";s:4:\"name\";s:17:\"Kabupaten Bireuen\";}i:11;a:2:{s:4:\"code\";s:5:\"11.12\";s:4:\"name\";s:25:\"Kabupaten Aceh Barat Daya\";}i:12;a:2:{s:4:\"code\";s:5:\"11.13\";s:4:\"name\";s:19:\"Kabupaten Gayo Lues\";}i:13;a:2:{s:4:\"code\";s:5:\"11.14\";s:4:\"name\";s:19:\"Kabupaten Aceh Jaya\";}i:14;a:2:{s:4:\"code\";s:5:\"11.15\";s:4:\"name\";s:20:\"Kabupaten Nagan Raya\";}i:15;a:2:{s:4:\"code\";s:5:\"11.16\";s:4:\"name\";s:22:\"Kabupaten Aceh Tamiang\";}i:16;a:2:{s:4:\"code\";s:5:\"11.17\";s:4:\"name\";s:22:\"Kabupaten Bener Meriah\";}i:17;a:2:{s:4:\"code\";s:5:\"11.18\";s:4:\"name\";s:20:\"Kabupaten Pidie Jaya\";}i:18;a:2:{s:4:\"code\";s:5:\"11.71\";s:4:\"name\";s:15:\"Kota Banda Aceh\";}i:19;a:2:{s:4:\"code\";s:5:\"11.72\";s:4:\"name\";s:11:\"Kota Sabang\";}i:20;a:2:{s:4:\"code\";s:5:\"11.73\";s:4:\"name\";s:16:\"Kota Lhokseumawe\";}i:21;a:2:{s:4:\"code\";s:5:\"11.74\";s:4:\"name\";s:11:\"Kota Langsa\";}i:22;a:2:{s:4:\"code\";s:5:\"11.75\";s:4:\"name\";s:17:\"Kota Subulussalam\";}}', 1782303710),
('laravel-cache-regencies_12', 'a:33:{i:0;a:2:{s:4:\"code\";s:5:\"12.01\";s:4:\"name\";s:25:\"Kabupaten Tapanuli Tengah\";}i:1;a:2:{s:4:\"code\";s:5:\"12.02\";s:4:\"name\";s:24:\"Kabupaten Tapanuli Utara\";}i:2;a:2:{s:4:\"code\";s:5:\"12.03\";s:4:\"name\";s:26:\"Kabupaten Tapanuli Selatan\";}i:3;a:2:{s:4:\"code\";s:5:\"12.04\";s:4:\"name\";s:14:\"Kabupaten Nias\";}i:4;a:2:{s:4:\"code\";s:5:\"12.05\";s:4:\"name\";s:17:\"Kabupaten Langkat\";}i:5;a:2:{s:4:\"code\";s:5:\"12.06\";s:4:\"name\";s:14:\"Kabupaten Karo\";}i:6;a:2:{s:4:\"code\";s:5:\"12.07\";s:4:\"name\";s:22:\"Kabupaten Deli Serdang\";}i:7;a:2:{s:4:\"code\";s:5:\"12.08\";s:4:\"name\";s:20:\"Kabupaten Simalungun\";}i:8;a:2:{s:4:\"code\";s:5:\"12.09\";s:4:\"name\";s:16:\"Kabupaten Asahan\";}i:9;a:2:{s:4:\"code\";s:5:\"12.10\";s:4:\"name\";s:21:\"Kabupaten Labuhanbatu\";}i:10;a:2:{s:4:\"code\";s:5:\"12.11\";s:4:\"name\";s:15:\"Kabupaten Dairi\";}i:11;a:2:{s:4:\"code\";s:5:\"12.12\";s:4:\"name\";s:14:\"Kabupaten Toba\";}i:12;a:2:{s:4:\"code\";s:5:\"12.13\";s:4:\"name\";s:26:\"Kabupaten Mandailing Natal\";}i:13;a:2:{s:4:\"code\";s:5:\"12.14\";s:4:\"name\";s:22:\"Kabupaten Nias Selatan\";}i:14;a:2:{s:4:\"code\";s:5:\"12.15\";s:4:\"name\";s:23:\"Kabupaten Pakpak Bharat\";}i:15;a:2:{s:4:\"code\";s:5:\"12.16\";s:4:\"name\";s:28:\"Kabupaten Humbang Hasundutan\";}i:16;a:2:{s:4:\"code\";s:5:\"12.17\";s:4:\"name\";s:17:\"Kabupaten Samosir\";}i:17;a:2:{s:4:\"code\";s:5:\"12.18\";s:4:\"name\";s:25:\"Kabupaten Serdang Bedagai\";}i:18;a:2:{s:4:\"code\";s:5:\"12.19\";s:4:\"name\";s:19:\"Kabupaten Batu Bara\";}i:19;a:2:{s:4:\"code\";s:5:\"12.20\";s:4:\"name\";s:28:\"Kabupaten Padang Lawas Utara\";}i:20;a:2:{s:4:\"code\";s:5:\"12.21\";s:4:\"name\";s:22:\"Kabupaten Padang Lawas\";}i:21;a:2:{s:4:\"code\";s:5:\"12.22\";s:4:\"name\";s:29:\"Kabupaten Labuhanbatu Selatan\";}i:22;a:2:{s:4:\"code\";s:5:\"12.23\";s:4:\"name\";s:27:\"Kabupaten Labuhanbatu Utara\";}i:23;a:2:{s:4:\"code\";s:5:\"12.24\";s:4:\"name\";s:20:\"Kabupaten Nias Utara\";}i:24;a:2:{s:4:\"code\";s:5:\"12.25\";s:4:\"name\";s:20:\"Kabupaten Nias Barat\";}i:25;a:2:{s:4:\"code\";s:5:\"12.71\";s:4:\"name\";s:10:\"Kota Medan\";}i:26;a:2:{s:4:\"code\";s:5:\"12.72\";s:4:\"name\";s:20:\"Kota Pematangsiantar\";}i:27;a:2:{s:4:\"code\";s:5:\"12.73\";s:4:\"name\";s:12:\"Kota Sibolga\";}i:28;a:2:{s:4:\"code\";s:5:\"12.74\";s:4:\"name\";s:17:\"Kota Tanjungbalai\";}i:29;a:2:{s:4:\"code\";s:5:\"12.75\";s:4:\"name\";s:11:\"Kota Binjai\";}i:30;a:2:{s:4:\"code\";s:5:\"12.76\";s:4:\"name\";s:18:\"Kota Tebing Tinggi\";}i:31;a:2:{s:4:\"code\";s:5:\"12.77\";s:4:\"name\";s:20:\"Kota Padangsidimpuan\";}i:32;a:2:{s:4:\"code\";s:5:\"12.78\";s:4:\"name\";s:17:\"Kota Gunungsitoli\";}}', 1782296275),
('laravel-cache-regencies_15', 'a:11:{i:0;a:2:{s:4:\"code\";s:5:\"15.01\";s:4:\"name\";s:17:\"Kabupaten Kerinci\";}i:1;a:2:{s:4:\"code\";s:5:\"15.02\";s:4:\"name\";s:18:\"Kabupaten Merangin\";}i:2;a:2:{s:4:\"code\";s:5:\"15.03\";s:4:\"name\";s:20:\"Kabupaten Sarolangun\";}i:3;a:2:{s:4:\"code\";s:5:\"15.04\";s:4:\"name\";s:20:\"Kabupaten Batanghari\";}i:4;a:2:{s:4:\"code\";s:5:\"15.05\";s:4:\"name\";s:21:\"Kabupaten Muaro Jambi\";}i:5;a:2:{s:4:\"code\";s:5:\"15.06\";s:4:\"name\";s:30:\"Kabupaten Tanjung Jabung Barat\";}i:6;a:2:{s:4:\"code\";s:5:\"15.07\";s:4:\"name\";s:30:\"Kabupaten Tanjung Jabung Timur\";}i:7;a:2:{s:4:\"code\";s:5:\"15.08\";s:4:\"name\";s:15:\"Kabupaten Bungo\";}i:8;a:2:{s:4:\"code\";s:5:\"15.09\";s:4:\"name\";s:14:\"Kabupaten Tebo\";}i:9;a:2:{s:4:\"code\";s:5:\"15.71\";s:4:\"name\";s:10:\"Kota Jambi\";}i:10;a:2:{s:4:\"code\";s:5:\"15.72\";s:4:\"name\";s:17:\"Kota Sungai Penuh\";}}', 1782303288),
('laravel-cache-regencies_21', 'a:7:{i:0;a:2:{s:4:\"code\";s:5:\"21.01\";s:4:\"name\";s:16:\"Kabupaten Bintan\";}i:1;a:2:{s:4:\"code\";s:5:\"21.02\";s:4:\"name\";s:17:\"Kabupaten Karimun\";}i:2;a:2:{s:4:\"code\";s:5:\"21.03\";s:4:\"name\";s:16:\"Kabupaten Natuna\";}i:3;a:2:{s:4:\"code\";s:5:\"21.04\";s:4:\"name\";s:16:\"Kabupaten Lingga\";}i:4;a:2:{s:4:\"code\";s:5:\"21.05\";s:4:\"name\";s:27:\"Kabupaten Kepulauan Anambas\";}i:5;a:2:{s:4:\"code\";s:5:\"21.71\";s:4:\"name\";s:10:\"Kota Batam\";}i:6;a:2:{s:4:\"code\";s:5:\"21.72\";s:4:\"name\";s:19:\"Kota Tanjung Pinang\";}}', 1782332218),
('laravel-cache-regencies_31', 'a:6:{i:0;a:2:{s:4:\"code\";s:5:\"31.01\";s:4:\"name\";s:39:\"Kabupaten Administrasi Kepulauan Seribu\";}i:1;a:2:{s:4:\"code\";s:5:\"31.71\";s:4:\"name\";s:31:\"Kota Administrasi Jakarta Pusat\";}i:2;a:2:{s:4:\"code\";s:5:\"31.72\";s:4:\"name\";s:32:\"Kota Administrasi Jakarta Utara \";}i:3;a:2:{s:4:\"code\";s:5:\"31.73\";s:4:\"name\";s:31:\"Kota Administrasi Jakarta Barat\";}i:4;a:2:{s:4:\"code\";s:5:\"31.74\";s:4:\"name\";s:33:\"Kota Administrasi Jakarta Selatan\";}i:5;a:2:{s:4:\"code\";s:5:\"31.75\";s:4:\"name\";s:31:\"Kota Administrasi Jakarta Timur\";}}', 1782303511),
('laravel-cache-regencies_65', 'a:5:{i:0;a:2:{s:4:\"code\";s:5:\"65.01\";s:4:\"name\";s:18:\"Kabupaten Bulungan\";}i:1;a:2:{s:4:\"code\";s:5:\"65.02\";s:4:\"name\";s:17:\"Kabupaten Malinau\";}i:2;a:2:{s:4:\"code\";s:5:\"65.03\";s:4:\"name\";s:17:\"Kabupaten Nunukan\";}i:3;a:2:{s:4:\"code\";s:5:\"65.04\";s:4:\"name\";s:21:\"Kabupaten Tana Tidung\";}i:4;a:2:{s:4:\"code\";s:5:\"65.71\";s:4:\"name\";s:12:\"Kota Tarakan\";}}', 1782296263),
('laravel-cache-villages_11.02.01', 'a:28:{i:0;a:2:{s:4:\"code\";s:13:\"11.02.01.2001\";s:4:\"name\";s:8:\"Engkeran\";}i:1;a:2:{s:4:\"code\";s:13:\"11.02.01.2002\";s:4:\"name\";s:13:\"Rumah Kampung\";}i:2;a:2:{s:4:\"code\";s:13:\"11.02.01.2004\";s:4:\"name\";s:12:\"Pasir Bangun\";}i:3;a:2:{s:4:\"code\";s:13:\"11.02.01.2006\";s:4:\"name\";s:4:\"Kubu\";}i:4;a:2:{s:4:\"code\";s:13:\"11.02.01.2007\";s:4:\"name\";s:12:\"Lawe Kongker\";}i:5;a:2:{s:4:\"code\";s:13:\"11.02.01.2008\";s:4:\"name\";s:15:\"Kuta Cingkam II\";}i:6;a:2:{s:4:\"code\";s:13:\"11.02.01.2009\";s:4:\"name\";s:10:\"Muara Baru\";}i:7;a:2:{s:4:\"code\";s:13:\"11.02.01.2011\";s:4:\"name\";s:11:\"Kuta Batu I\";}i:8;a:2:{s:4:\"code\";s:13:\"11.02.01.2012\";s:4:\"name\";s:14:\"Kuta Cingkam I\";}i:9;a:2:{s:4:\"code\";s:13:\"11.02.01.2013\";s:4:\"name\";s:12:\"Kuta Batu II\";}i:10;a:2:{s:4:\"code\";s:13:\"11.02.01.2014\";s:4:\"name\";s:14:\"Lawe Sempilang\";}i:11;a:2:{s:4:\"code\";s:13:\"11.02.01.2015\";s:4:\"name\";s:19:\"Prapat Batu Nunggul\";}i:12;a:2:{s:4:\"code\";s:13:\"11.02.01.2016\";s:4:\"name\";s:11:\"Pulo Sepang\";}i:13;a:2:{s:4:\"code\";s:13:\"11.02.01.2017\";s:4:\"name\";s:11:\"Rih Mbelang\";}i:14;a:2:{s:4:\"code\";s:13:\"11.02.01.2018\";s:4:\"name\";s:14:\"Kute Batu Baru\";}i:15;a:2:{s:4:\"code\";s:13:\"11.02.01.2019\";s:4:\"name\";s:10:\"Darul Amin\";}i:16;a:2:{s:4:\"code\";s:13:\"11.02.01.2020\";s:4:\"name\";s:17:\"Lawe Lubang Indah\";}i:17;a:2:{s:4:\"code\";s:13:\"11.02.01.2021\";s:4:\"name\";s:13:\"Batu Hamparan\";}i:18;a:2:{s:4:\"code\";s:13:\"11.02.01.2022\";s:4:\"name\";s:10:\"Paye Munje\";}i:19;a:2:{s:4:\"code\";s:13:\"11.02.01.2023\";s:4:\"name\";s:11:\"Pulo Ndadap\";}i:20;a:2:{s:4:\"code\";s:13:\"11.02.01.2024\";s:4:\"name\";s:13:\"Pasir Nunggul\";}i:21;a:2:{s:4:\"code\";s:13:\"11.02.01.2025\";s:4:\"name\";s:19:\"Cingkham Mekhanggun\";}i:22;a:2:{s:4:\"code\";s:13:\"11.02.01.2026\";s:4:\"name\";s:12:\"Pintu Khimbe\";}i:23;a:2:{s:4:\"code\";s:13:\"11.02.01.2027\";s:4:\"name\";s:18:\"Lawe Kongker Hilir\";}i:24;a:2:{s:4:\"code\";s:13:\"11.02.01.2028\";s:4:\"name\";s:11:\"Pulo Gadung\";}i:25;a:2:{s:4:\"code\";s:13:\"11.02.01.2029\";s:4:\"name\";s:15:\"Pasikh Pehkmate\";}i:26;a:2:{s:4:\"code\";s:13:\"11.02.01.2030\";s:4:\"name\";s:13:\"Pasikh Nunang\";}i:27;a:2:{s:4:\"code\";s:13:\"11.02.01.2031\";s:4:\"name\";s:14:\"Deleng Kukusen\";}}', 1782296692),
('laravel-cache-villages_11.03.03', 'a:35:{i:0;a:2:{s:4:\"code\";s:13:\"11.03.03.2001\";s:4:\"name\";s:12:\"Gampong Jawa\";}i:1;a:2:{s:4:\"code\";s:13:\"11.03.03.2002\";s:4:\"name\";s:11:\"Keude Blang\";}i:2;a:2:{s:4:\"code\";s:13:\"11.03.03.2003\";s:4:\"name\";s:10:\"Tanoh Anoe\";}i:3;a:2:{s:4:\"code\";s:13:\"11.03.03.2004\";s:4:\"name\";s:21:\"Kuala Peudawa Puntong\";}i:4;a:2:{s:4:\"code\";s:13:\"11.03.03.2005\";s:4:\"name\";s:12:\"Gampong Aceh\";}i:5;a:2:{s:4:\"code\";s:13:\"11.03.03.2006\";s:4:\"name\";s:10:\"Kuta Blang\";}i:6;a:2:{s:4:\"code\";s:13:\"11.03.03.2007\";s:4:\"name\";s:15:\"Gampong Tanjong\";}i:7;a:2:{s:4:\"code\";s:13:\"11.03.03.2008\";s:4:\"name\";s:16:\"Blang Geulumpang\";}i:8;a:2:{s:4:\"code\";s:13:\"11.03.03.2009\";s:4:\"name\";s:14:\"Meunasah Pu\'uk\";}i:9;a:2:{s:4:\"code\";s:13:\"11.03.03.2010\";s:4:\"name\";s:13:\"Bantayan Timu\";}i:10;a:2:{s:4:\"code\";s:13:\"11.03.03.2011\";s:4:\"name\";s:15:\"Keutapang Mameh\";}i:11;a:2:{s:4:\"code\";s:13:\"11.03.03.2012\";s:4:\"name\";s:17:\"Seuneubok Rambong\";}i:12;a:2:{s:4:\"code\";s:13:\"11.03.03.2013\";s:4:\"name\";s:9:\"Kuala Idi\";}i:13;a:2:{s:4:\"code\";s:13:\"11.03.03.2014\";s:4:\"name\";s:10:\"Keude Aceh\";}i:14;a:2:{s:4:\"code\";s:13:\"11.03.03.2023\";s:4:\"name\";s:15:\"Seuneubok Bacee\";}i:15;a:2:{s:4:\"code\";s:13:\"11.03.03.2029\";s:4:\"name\";s:9:\"Titi Baro\";}i:16;a:2:{s:4:\"code\";s:13:\"11.03.03.2047\";s:4:\"name\";s:13:\"Tanjong Kapai\";}i:17;a:2:{s:4:\"code\";s:13:\"11.03.03.2048\";s:4:\"name\";s:15:\"Alue Dua Muka O\";}i:18;a:2:{s:4:\"code\";s:13:\"11.03.03.2049\";s:4:\"name\";s:15:\"Alue Dua Muka S\";}i:19;a:2:{s:4:\"code\";s:13:\"11.03.03.2050\";s:4:\"name\";s:10:\"Ulee Blang\";}i:20;a:2:{s:4:\"code\";s:13:\"11.03.03.2051\";s:4:\"name\";s:9:\"Buket Jok\";}i:21;a:2:{s:4:\"code\";s:13:\"11.03.03.2052\";s:4:\"name\";s:17:\"Buket Meulinteung\";}i:22;a:2:{s:4:\"code\";s:13:\"11.03.03.2053\";s:4:\"name\";s:13:\"Gampong Jalan\";}i:23;a:2:{s:4:\"code\";s:13:\"11.03.03.2054\";s:4:\"name\";s:12:\"Teupin Batee\";}i:24;a:2:{s:4:\"code\";s:13:\"11.03.03.2055\";s:4:\"name\";s:11:\"Buket Langa\";}i:25;a:2:{s:4:\"code\";s:13:\"11.03.03.2056\";s:4:\"name\";s:10:\"Buket Pala\";}i:26;a:2:{s:4:\"code\";s:13:\"11.03.03.2057\";s:4:\"name\";s:11:\"Buket Juara\";}i:27;a:2:{s:4:\"code\";s:13:\"11.03.03.2058\";s:4:\"name\";s:16:\"Seuneubok Tutong\";}i:28;a:2:{s:4:\"code\";s:13:\"11.03.03.2059\";s:4:\"name\";s:14:\"Seuneubok Tuha\";}i:29;a:2:{s:4:\"code\";s:13:\"11.03.03.2060\";s:4:\"name\";s:9:\"Sampoimah\";}i:30;a:2:{s:4:\"code\";s:13:\"11.03.03.2061\";s:4:\"name\";s:9:\"Dama pulo\";}i:31;a:2:{s:4:\"code\";s:13:\"11.03.03.2062\";s:4:\"name\";s:11:\"Gureb Blang\";}i:32;a:2:{s:4:\"code\";s:13:\"11.03.03.2064\";s:4:\"name\";s:12:\"Gampong Baro\";}i:33;a:2:{s:4:\"code\";s:13:\"11.03.03.2065\";s:4:\"name\";s:26:\"SeuneubokTeungoh P.Puntong\";}i:34;a:2:{s:4:\"code\";s:13:\"11.03.03.2067\";s:4:\"name\";s:10:\"Kuta Lawah\";}}', 1782303713),
('laravel-cache-villages_11.13.03', 'a:13:{i:0;a:2:{s:4:\"code\";s:13:\"11.13.03.2001\";s:4:\"name\";s:10:\"Ampa Kolak\";}i:1;a:2:{s:4:\"code\";s:13:\"11.13.03.2002\";s:4:\"name\";s:8:\"Cane Toa\";}i:2;a:2:{s:4:\"code\";s:13:\"11.13.03.2003\";s:4:\"name\";s:12:\"Padang Pasir\";}i:3;a:2:{s:4:\"code\";s:13:\"11.13.03.2005\";s:4:\"name\";s:12:\"Pinang Rugub\";}i:4;a:2:{s:4:\"code\";s:13:\"11.13.03.2006\";s:4:\"name\";s:6:\"Kuning\";}i:5;a:2:{s:4:\"code\";s:13:\"11.13.03.2008\";s:4:\"name\";s:7:\"Mangang\";}i:6;a:2:{s:4:\"code\";s:13:\"11.13.03.2011\";s:4:\"name\";s:8:\"Rempelam\";}i:7;a:2:{s:4:\"code\";s:13:\"11.13.03.2012\";s:4:\"name\";s:9:\"Cane Uken\";}i:8;a:2:{s:4:\"code\";s:13:\"11.13.03.2013\";s:4:\"name\";s:6:\"Tungel\";}i:9;a:2:{s:4:\"code\";s:13:\"11.13.03.2014\";s:4:\"name\";s:15:\"Kota Rikit Gaib\";}i:10;a:2:{s:4:\"code\";s:13:\"11.13.03.2016\";s:4:\"name\";s:10:\"Lukup Baru\";}i:11;a:2:{s:4:\"code\";s:13:\"11.13.03.2017\";s:4:\"name\";s:12:\"Penomon Jaya\";}i:12;a:2:{s:4:\"code\";s:13:\"11.13.03.2018\";s:4:\"name\";s:11:\"Tungel Baru\";}}', 1782296228),
('laravel-cache-villages_15.03.05', 'a:14:{i:0;a:2:{s:4:\"code\";s:13:\"15.03.05.2001\";s:4:\"name\";s:7:\"Penegah\";}i:1;a:2:{s:4:\"code\";s:13:\"15.03.05.2002\";s:4:\"name\";s:7:\"Pelawan\";}i:2;a:2:{s:4:\"code\";s:13:\"15.03.05.2003\";s:4:\"name\";s:8:\"Pulauaro\";}i:3;a:2:{s:4:\"code\";s:13:\"15.03.05.2004\";s:4:\"name\";s:5:\"Bukit\";}i:4;a:2:{s:4:\"code\";s:13:\"15.03.05.2005\";s:4:\"name\";s:11:\"Lubuk Sepuh\";}i:5;a:2:{s:4:\"code\";s:13:\"15.03.05.2006\";s:4:\"name\";s:13:\"Rantau Tenang\";}i:6;a:2:{s:4:\"code\";s:13:\"15.03.05.2007\";s:4:\"name\";s:11:\"Muara Danau\";}i:7;a:2:{s:4:\"code\";s:13:\"15.03.05.2013\";s:4:\"name\";s:12:\"Sungai Merah\";}i:8;a:2:{s:4:\"code\";s:13:\"15.03.05.2016\";s:4:\"name\";s:14:\"Pematang Kulim\";}i:9;a:2:{s:4:\"code\";s:13:\"15.03.05.2017\";s:4:\"name\";s:10:\"Batu Putih\";}i:10;a:2:{s:4:\"code\";s:13:\"15.03.05.2019\";s:4:\"name\";s:10:\"Mekar Sari\";}i:11;a:2:{s:4:\"code\";s:13:\"15.03.05.2021\";s:4:\"name\";s:13:\"Pasar Pelawan\";}i:12;a:2:{s:4:\"code\";s:13:\"15.03.05.2022\";s:4:\"name\";s:12:\"Pelawan Jaya\";}i:13;a:2:{s:4:\"code\";s:13:\"15.03.05.2023\";s:4:\"name\";s:11:\"Lubuk Sayak\";}}', 1782303291),
('laravel-cache-villages_21.01.14', 'a:4:{i:0;a:2:{s:4:\"code\";s:13:\"21.01.14.2001\";s:4:\"name\";s:6:\"Kelong\";}i:1;a:2:{s:4:\"code\";s:13:\"21.01.14.2002\";s:4:\"name\";s:5:\"Mapur\";}i:2;a:2:{s:4:\"code\";s:13:\"21.01.14.2003\";s:4:\"name\";s:7:\"Numbing\";}i:3;a:2:{s:4:\"code\";s:13:\"21.01.14.2004\";s:4:\"name\";s:10:\"Air Gelubi\";}}', 1782332222),
('laravel-cache-villages_31.74.06', 'a:5:{i:0;a:2:{s:4:\"code\";s:13:\"31.74.06.1001\";s:4:\"name\";s:14:\"Cilandak Barat\";}i:1;a:2:{s:4:\"code\";s:13:\"31.74.06.1002\";s:4:\"name\";s:11:\"Lebak Bulus\";}i:2;a:2:{s:4:\"code\";s:13:\"31.74.06.1003\";s:4:\"name\";s:11:\"Pondok Labu\";}i:3;a:2:{s:4:\"code\";s:13:\"31.74.06.1004\";s:4:\"name\";s:16:\"Gandaria Selatan\";}i:4;a:2:{s:4:\"code\";s:13:\"31.74.06.1005\";s:4:\"name\";s:14:\"Cipete Selatan\";}}', 1782303520),
('laravel-cache-villages_65.02.03', 'a:9:{i:0;a:2:{s:4:\"code\";s:13:\"65.02.03.2001\";s:4:\"name\";s:13:\"Long Pujungan\";}i:1;a:2:{s:4:\"code\";s:13:\"65.02.03.2002\";s:4:\"name\";s:12:\"Long Ketaman\";}i:2;a:2:{s:4:\"code\";s:13:\"65.02.03.2003\";s:4:\"name\";s:8:\"Long Pua\";}i:3;a:2:{s:4:\"code\";s:13:\"65.02.03.2004\";s:4:\"name\";s:9:\"Long Lame\";}i:4;a:2:{s:4:\"code\";s:13:\"65.02.03.2005\";s:4:\"name\";s:10:\"Long Jelet\";}i:5;a:2:{s:4:\"code\";s:13:\"65.02.03.2006\";s:4:\"name\";s:9:\"Long Aran\";}i:6;a:2:{s:4:\"code\";s:13:\"65.02.03.2007\";s:4:\"name\";s:12:\"Long Peliran\";}i:7;a:2:{s:4:\"code\";s:13:\"65.02.03.2008\";s:4:\"name\";s:9:\"Long Bena\";}i:8;a:2:{s:4:\"code\";s:13:\"65.02.03.2009\";s:4:\"name\";s:17:\"Long Belaka Pitau\";}}', 1782296268),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_11.01', 'a:18:{i:0;a:2:{s:4:\"code\";s:8:\"11.01.01\";s:4:\"name\";s:8:\"Bakongan\";}i:1;a:2:{s:4:\"code\";s:8:\"11.01.02\";s:4:\"name\";s:11:\"Kluet Utara\";}i:2;a:2:{s:4:\"code\";s:8:\"11.01.03\";s:4:\"name\";s:13:\"Kluet Selatan\";}i:3;a:2:{s:4:\"code\";s:8:\"11.01.04\";s:4:\"name\";s:11:\"Labuhanhaji\";}i:4;a:2:{s:4:\"code\";s:8:\"11.01.05\";s:4:\"name\";s:6:\"Meukek\";}i:5;a:2:{s:4:\"code\";s:8:\"11.01.06\";s:4:\"name\";s:7:\"Samadua\";}i:6;a:2:{s:4:\"code\";s:8:\"11.01.07\";s:4:\"name\";s:6:\"Sawang\";}i:7;a:2:{s:4:\"code\";s:8:\"11.01.08\";s:4:\"name\";s:9:\"Tapaktuan\";}i:8;a:2:{s:4:\"code\";s:8:\"11.01.09\";s:4:\"name\";s:6:\"Trumon\";}i:9;a:2:{s:4:\"code\";s:8:\"11.01.10\";s:4:\"name\";s:10:\"Pasie Raja\";}i:10;a:2:{s:4:\"code\";s:8:\"11.01.11\";s:4:\"name\";s:17:\"Labuhanhaji Timur\";}i:11;a:2:{s:4:\"code\";s:8:\"11.01.12\";s:4:\"name\";s:17:\"Labuhanhaji Barat\";}i:12;a:2:{s:4:\"code\";s:8:\"11.01.13\";s:4:\"name\";s:12:\"Kluet Tengah\";}i:13;a:2:{s:4:\"code\";s:8:\"11.01.14\";s:4:\"name\";s:11:\"Kluet Timur\";}i:14;a:2:{s:4:\"code\";s:8:\"11.01.15\";s:4:\"name\";s:14:\"Bakongan Timur\";}i:15;a:2:{s:4:\"code\";s:8:\"11.01.16\";s:4:\"name\";s:12:\"Trumon Timur\";}i:16;a:2:{s:4:\"code\";s:8:\"11.01.17\";s:4:\"name\";s:12:\"Kota Bahagia\";}i:17;a:2:{s:4:\"code\";s:8:\"11.01.18\";s:4:\"name\";s:13:\"Trumon Tengah\";}}', 1782378505),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_15.03', 'a:11:{i:0;a:2:{s:4:\"code\";s:8:\"15.03.01\";s:4:\"name\";s:11:\"Batang Asai\";}i:1;a:2:{s:4:\"code\";s:8:\"15.03.02\";s:4:\"name\";s:5:\"Limun\";}i:2;a:2:{s:4:\"code\";s:8:\"15.03.03\";s:4:\"name\";s:10:\"Sarolangun\";}i:3;a:2:{s:4:\"code\";s:8:\"15.03.04\";s:4:\"name\";s:4:\"Pauh\";}i:4;a:2:{s:4:\"code\";s:8:\"15.03.05\";s:4:\"name\";s:7:\"Pelawan\";}i:5;a:2:{s:4:\"code\";s:8:\"15.03.06\";s:4:\"name\";s:10:\"Mandiangin\";}i:6;a:2:{s:4:\"code\";s:8:\"15.03.07\";s:4:\"name\";s:9:\"Air Hitam\";}i:7;a:2:{s:4:\"code\";s:8:\"15.03.08\";s:4:\"name\";s:11:\"Bathin VIII\";}i:8;a:2:{s:4:\"code\";s:8:\"15.03.09\";s:4:\"name\";s:7:\"Singkut\";}i:9;a:2:{s:4:\"code\";s:8:\"15.03.10\";s:4:\"name\";s:17:\"Cermin Nan Gedang\";}i:10;a:2:{s:4:\"code\";s:8:\"15.03.11\";s:4:\"name\";s:16:\"Mandiangin Timur\";}}', 1782379674),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_19.01', 'a:8:{i:0;a:2:{s:4:\"code\";s:8:\"19.01.01\";s:4:\"name\";s:10:\"Sungailiat\";}i:1;a:2:{s:4:\"code\";s:8:\"19.01.02\";s:4:\"name\";s:7:\"Belinyu\";}i:2;a:2:{s:4:\"code\";s:8:\"19.01.03\";s:4:\"name\";s:8:\"Merawang\";}i:3;a:2:{s:4:\"code\";s:8:\"19.01.04\";s:4:\"name\";s:11:\"Mendo Barat\";}i:4;a:2:{s:4:\"code\";s:8:\"19.01.05\";s:4:\"name\";s:6:\"Pemali\";}i:5;a:2:{s:4:\"code\";s:8:\"19.01.06\";s:4:\"name\";s:5:\"Bakam\";}i:6;a:2:{s:4:\"code\";s:8:\"19.01.07\";s:4:\"name\";s:10:\"Riau Silip\";}i:7;a:2:{s:4:\"code\";s:8:\"19.01.08\";s:4:\"name\";s:12:\"Puding Besar\";}}', 1782378282),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_19.03', 'a:8:{i:0;a:2:{s:4:\"code\";s:8:\"19.03.01\";s:4:\"name\";s:7:\"Toboali\";}i:1;a:2:{s:4:\"code\";s:8:\"19.03.02\";s:4:\"name\";s:5:\"Lepar\";}i:2;a:2:{s:4:\"code\";s:8:\"19.03.03\";s:4:\"name\";s:8:\"Airgegas\";}i:3;a:2:{s:4:\"code\";s:8:\"19.03.04\";s:4:\"name\";s:13:\"Simpang Rimba\";}i:4;a:2:{s:4:\"code\";s:8:\"19.03.05\";s:4:\"name\";s:6:\"Payung\";}i:5;a:2:{s:4:\"code\";s:8:\"19.03.06\";s:4:\"name\";s:11:\"Tukak Sadai\";}i:6;a:2:{s:4:\"code\";s:8:\"19.03.07\";s:4:\"name\";s:11:\"Pulau Besar\";}i:7;a:2:{s:4:\"code\";s:8:\"19.03.08\";s:4:\"name\";s:16:\"Kepulauan Pongok\";}}', 1782378263),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_31.71', 'a:8:{i:0;a:2:{s:4:\"code\";s:8:\"31.71.01\";s:4:\"name\";s:6:\"Gambir\";}i:1;a:2:{s:4:\"code\";s:8:\"31.71.02\";s:4:\"name\";s:11:\"Sawah Besar\";}i:2;a:2:{s:4:\"code\";s:8:\"31.71.03\";s:4:\"name\";s:9:\"Kemayoran\";}i:3;a:2:{s:4:\"code\";s:8:\"31.71.04\";s:4:\"name\";s:5:\"Senen\";}i:4;a:2:{s:4:\"code\";s:8:\"31.71.05\";s:4:\"name\";s:13:\"Cempaka Putih\";}i:5;a:2:{s:4:\"code\";s:8:\"31.71.06\";s:4:\"name\";s:7:\"Menteng\";}i:6;a:2:{s:4:\"code\";s:8:\"31.71.07\";s:4:\"name\";s:11:\"Tanah Abang\";}i:7;a:2:{s:4:\"code\";s:8:\"31.71.08\";s:4:\"name\";s:10:\"Johar Baru\";}}', 1782404826),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_31.72', 'a:6:{i:0;a:2:{s:4:\"code\";s:8:\"31.72.01\";s:4:\"name\";s:11:\"Penjaringan\";}i:1;a:2:{s:4:\"code\";s:8:\"31.72.02\";s:4:\"name\";s:13:\"Tanjung Priok\";}i:2;a:2:{s:4:\"code\";s:8:\"31.72.03\";s:4:\"name\";s:4:\"Koja\";}i:3;a:2:{s:4:\"code\";s:8:\"31.72.04\";s:4:\"name\";s:9:\"Cilincing\";}i:4;a:2:{s:4:\"code\";s:8:\"31.72.05\";s:4:\"name\";s:10:\"Pademangan\";}i:5;a:2:{s:4:\"code\";s:8:\"31.72.06\";s:4:\"name\";s:13:\"Kelapa Gading\";}}', 1782379112),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-districts_31.74', 'a:10:{i:0;a:2:{s:4:\"code\";s:8:\"31.74.01\";s:4:\"name\";s:5:\"Tebet\";}i:1;a:2:{s:4:\"code\";s:8:\"31.74.02\";s:4:\"name\";s:9:\"Setiabudi\";}i:2;a:2:{s:4:\"code\";s:8:\"31.74.03\";s:4:\"name\";s:16:\"Mampang Prapatan\";}i:3;a:2:{s:4:\"code\";s:8:\"31.74.04\";s:4:\"name\";s:12:\"Pasar Minggu\";}i:4;a:2:{s:4:\"code\";s:8:\"31.74.05\";s:4:\"name\";s:14:\"Kebayoran Lama\";}i:5;a:2:{s:4:\"code\";s:8:\"31.74.06\";s:4:\"name\";s:8:\"Cilandak\";}i:6;a:2:{s:4:\"code\";s:8:\"31.74.07\";s:4:\"name\";s:14:\"Kebayoran Baru\";}i:7;a:2:{s:4:\"code\";s:8:\"31.74.08\";s:4:\"name\";s:8:\"Pancoran\";}i:8;a:2:{s:4:\"code\";s:8:\"31.74.09\";s:4:\"name\";s:9:\"Jagakarsa\";}i:9;a:2:{s:4:\"code\";s:8:\"31.74.10\";s:4:\"name\";s:12:\"Pesanggrahan\";}}', 1782379205),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-provinces', 'a:38:{i:0;a:2:{s:4:\"code\";s:2:\"11\";s:4:\"name\";s:4:\"Aceh\";}i:1;a:2:{s:4:\"code\";s:2:\"12\";s:4:\"name\";s:14:\"Sumatera Utara\";}i:2;a:2:{s:4:\"code\";s:2:\"13\";s:4:\"name\";s:14:\"Sumatera Barat\";}i:3;a:2:{s:4:\"code\";s:2:\"14\";s:4:\"name\";s:4:\"Riau\";}i:4;a:2:{s:4:\"code\";s:2:\"15\";s:4:\"name\";s:5:\"Jambi\";}i:5;a:2:{s:4:\"code\";s:2:\"16\";s:4:\"name\";s:16:\"Sumatera Selatan\";}i:6;a:2:{s:4:\"code\";s:2:\"17\";s:4:\"name\";s:8:\"Bengkulu\";}i:7;a:2:{s:4:\"code\";s:2:\"18\";s:4:\"name\";s:7:\"Lampung\";}i:8;a:2:{s:4:\"code\";s:2:\"19\";s:4:\"name\";s:25:\"Kepulauan Bangka Belitung\";}i:9;a:2:{s:4:\"code\";s:2:\"21\";s:4:\"name\";s:14:\"Kepulauan Riau\";}i:10;a:2:{s:4:\"code\";s:2:\"31\";s:4:\"name\";s:11:\"DKI Jakarta\";}i:11;a:2:{s:4:\"code\";s:2:\"32\";s:4:\"name\";s:10:\"Jawa Barat\";}i:12;a:2:{s:4:\"code\";s:2:\"33\";s:4:\"name\";s:11:\"Jawa Tengah\";}i:13;a:2:{s:4:\"code\";s:2:\"34\";s:4:\"name\";s:26:\"Daerah Istimewa Yogyakarta\";}i:14;a:2:{s:4:\"code\";s:2:\"35\";s:4:\"name\";s:10:\"Jawa Timur\";}i:15;a:2:{s:4:\"code\";s:2:\"36\";s:4:\"name\";s:6:\"Banten\";}i:16;a:2:{s:4:\"code\";s:2:\"51\";s:4:\"name\";s:4:\"Bali\";}i:17;a:2:{s:4:\"code\";s:2:\"52\";s:4:\"name\";s:19:\"Nusa Tenggara Barat\";}i:18;a:2:{s:4:\"code\";s:2:\"53\";s:4:\"name\";s:19:\"Nusa Tenggara Timur\";}i:19;a:2:{s:4:\"code\";s:2:\"61\";s:4:\"name\";s:16:\"Kalimantan Barat\";}i:20;a:2:{s:4:\"code\";s:2:\"62\";s:4:\"name\";s:17:\"Kalimantan Tengah\";}i:21;a:2:{s:4:\"code\";s:2:\"63\";s:4:\"name\";s:18:\"Kalimantan Selatan\";}i:22;a:2:{s:4:\"code\";s:2:\"64\";s:4:\"name\";s:16:\"Kalimantan Timur\";}i:23;a:2:{s:4:\"code\";s:2:\"65\";s:4:\"name\";s:16:\"Kalimantan Utara\";}i:24;a:2:{s:4:\"code\";s:2:\"71\";s:4:\"name\";s:14:\"Sulawesi Utara\";}i:25;a:2:{s:4:\"code\";s:2:\"72\";s:4:\"name\";s:15:\"Sulawesi Tengah\";}i:26;a:2:{s:4:\"code\";s:2:\"73\";s:4:\"name\";s:16:\"Sulawesi Selatan\";}i:27;a:2:{s:4:\"code\";s:2:\"74\";s:4:\"name\";s:17:\"Sulawesi Tenggara\";}i:28;a:2:{s:4:\"code\";s:2:\"75\";s:4:\"name\";s:9:\"Gorontalo\";}i:29;a:2:{s:4:\"code\";s:2:\"76\";s:4:\"name\";s:14:\"Sulawesi Barat\";}i:30;a:2:{s:4:\"code\";s:2:\"81\";s:4:\"name\";s:6:\"Maluku\";}i:31;a:2:{s:4:\"code\";s:2:\"82\";s:4:\"name\";s:12:\"Maluku Utara\";}i:32;a:2:{s:4:\"code\";s:2:\"91\";s:4:\"name\";s:5:\"Papua\";}i:33;a:2:{s:4:\"code\";s:2:\"92\";s:4:\"name\";s:11:\"Papua Barat\";}i:34;a:2:{s:4:\"code\";s:2:\"93\";s:4:\"name\";s:13:\"Papua Selatan\";}i:35;a:2:{s:4:\"code\";s:2:\"94\";s:4:\"name\";s:12:\"Papua Tengah\";}i:36;a:2:{s:4:\"code\";s:2:\"95\";s:4:\"name\";s:16:\"Papua Pegunungan\";}i:37;a:2:{s:4:\"code\";s:2:\"96\";s:4:\"name\";s:16:\"Papua Barat Daya\";}}', 1782404452),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-regencies_11', 'a:23:{i:0;a:2:{s:4:\"code\";s:5:\"11.01\";s:4:\"name\";s:22:\"Kabupaten Aceh Selatan\";}i:1;a:2:{s:4:\"code\";s:5:\"11.02\";s:4:\"name\";s:23:\"Kabupaten Aceh Tenggara\";}i:2;a:2:{s:4:\"code\";s:5:\"11.03\";s:4:\"name\";s:20:\"Kabupaten Aceh Timur\";}i:3;a:2:{s:4:\"code\";s:5:\"11.04\";s:4:\"name\";s:21:\"Kabupaten Aceh Tengah\";}i:4;a:2:{s:4:\"code\";s:5:\"11.05\";s:4:\"name\";s:20:\"Kabupaten Aceh Barat\";}i:5;a:2:{s:4:\"code\";s:5:\"11.06\";s:4:\"name\";s:20:\"Kabupaten Aceh Besar\";}i:6;a:2:{s:4:\"code\";s:5:\"11.07\";s:4:\"name\";s:15:\"Kabupaten Pidie\";}i:7;a:2:{s:4:\"code\";s:5:\"11.08\";s:4:\"name\";s:20:\"Kabupaten Aceh Utara\";}i:8;a:2:{s:4:\"code\";s:5:\"11.09\";s:4:\"name\";s:18:\"Kabupaten Simeulue\";}i:9;a:2:{s:4:\"code\";s:5:\"11.10\";s:4:\"name\";s:22:\"Kabupaten Aceh Singkil\";}i:10;a:2:{s:4:\"code\";s:5:\"11.11\";s:4:\"name\";s:17:\"Kabupaten Bireuen\";}i:11;a:2:{s:4:\"code\";s:5:\"11.12\";s:4:\"name\";s:25:\"Kabupaten Aceh Barat Daya\";}i:12;a:2:{s:4:\"code\";s:5:\"11.13\";s:4:\"name\";s:19:\"Kabupaten Gayo Lues\";}i:13;a:2:{s:4:\"code\";s:5:\"11.14\";s:4:\"name\";s:19:\"Kabupaten Aceh Jaya\";}i:14;a:2:{s:4:\"code\";s:5:\"11.15\";s:4:\"name\";s:20:\"Kabupaten Nagan Raya\";}i:15;a:2:{s:4:\"code\";s:5:\"11.16\";s:4:\"name\";s:22:\"Kabupaten Aceh Tamiang\";}i:16;a:2:{s:4:\"code\";s:5:\"11.17\";s:4:\"name\";s:22:\"Kabupaten Bener Meriah\";}i:17;a:2:{s:4:\"code\";s:5:\"11.18\";s:4:\"name\";s:20:\"Kabupaten Pidie Jaya\";}i:18;a:2:{s:4:\"code\";s:5:\"11.71\";s:4:\"name\";s:15:\"Kota Banda Aceh\";}i:19;a:2:{s:4:\"code\";s:5:\"11.72\";s:4:\"name\";s:11:\"Kota Sabang\";}i:20;a:2:{s:4:\"code\";s:5:\"11.73\";s:4:\"name\";s:16:\"Kota Lhokseumawe\";}i:21;a:2:{s:4:\"code\";s:5:\"11.74\";s:4:\"name\";s:11:\"Kota Langsa\";}i:22;a:2:{s:4:\"code\";s:5:\"11.75\";s:4:\"name\";s:17:\"Kota Subulussalam\";}}', 1782378502),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-regencies_15', 'a:11:{i:0;a:2:{s:4:\"code\";s:5:\"15.01\";s:4:\"name\";s:17:\"Kabupaten Kerinci\";}i:1;a:2:{s:4:\"code\";s:5:\"15.02\";s:4:\"name\";s:18:\"Kabupaten Merangin\";}i:2;a:2:{s:4:\"code\";s:5:\"15.03\";s:4:\"name\";s:20:\"Kabupaten Sarolangun\";}i:3;a:2:{s:4:\"code\";s:5:\"15.04\";s:4:\"name\";s:20:\"Kabupaten Batanghari\";}i:4;a:2:{s:4:\"code\";s:5:\"15.05\";s:4:\"name\";s:21:\"Kabupaten Muaro Jambi\";}i:5;a:2:{s:4:\"code\";s:5:\"15.06\";s:4:\"name\";s:30:\"Kabupaten Tanjung Jabung Barat\";}i:6;a:2:{s:4:\"code\";s:5:\"15.07\";s:4:\"name\";s:30:\"Kabupaten Tanjung Jabung Timur\";}i:7;a:2:{s:4:\"code\";s:5:\"15.08\";s:4:\"name\";s:15:\"Kabupaten Bungo\";}i:8;a:2:{s:4:\"code\";s:5:\"15.09\";s:4:\"name\";s:14:\"Kabupaten Tebo\";}i:9;a:2:{s:4:\"code\";s:5:\"15.71\";s:4:\"name\";s:10:\"Kota Jambi\";}i:10;a:2:{s:4:\"code\";s:5:\"15.72\";s:4:\"name\";s:17:\"Kota Sungai Penuh\";}}', 1782379672),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-regencies_19', 'a:7:{i:0;a:2:{s:4:\"code\";s:5:\"19.01\";s:4:\"name\";s:16:\"Kabupaten Bangka\";}i:1;a:2:{s:4:\"code\";s:5:\"19.02\";s:4:\"name\";s:18:\"Kabupaten Belitung\";}i:2;a:2:{s:4:\"code\";s:5:\"19.03\";s:4:\"name\";s:24:\"Kabupaten Bangka Selatan\";}i:3;a:2:{s:4:\"code\";s:5:\"19.04\";s:4:\"name\";s:23:\"Kabupaten Bangka Tengah\";}i:4;a:2:{s:4:\"code\";s:5:\"19.05\";s:4:\"name\";s:22:\"Kabupaten Bangka Barat\";}i:5;a:2:{s:4:\"code\";s:5:\"19.06\";s:4:\"name\";s:24:\"Kabupaten Belitung Timur\";}i:6;a:2:{s:4:\"code\";s:5:\"19.71\";s:4:\"name\";s:19:\"Kota Pangkal Pinang\";}}', 1782378260),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-regencies_31', 'a:6:{i:0;a:2:{s:4:\"code\";s:5:\"31.01\";s:4:\"name\";s:39:\"Kabupaten Administrasi Kepulauan Seribu\";}i:1;a:2:{s:4:\"code\";s:5:\"31.71\";s:4:\"name\";s:31:\"Kota Administrasi Jakarta Pusat\";}i:2;a:2:{s:4:\"code\";s:5:\"31.72\";s:4:\"name\";s:32:\"Kota Administrasi Jakarta Utara \";}i:3;a:2:{s:4:\"code\";s:5:\"31.73\";s:4:\"name\";s:31:\"Kota Administrasi Jakarta Barat\";}i:4;a:2:{s:4:\"code\";s:5:\"31.74\";s:4:\"name\";s:33:\"Kota Administrasi Jakarta Selatan\";}i:5;a:2:{s:4:\"code\";s:5:\"31.75\";s:4:\"name\";s:31:\"Kota Administrasi Jakarta Timur\";}}', 1782404824),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_11.01.07', 'a:15:{i:0;a:2:{s:4:\"code\";s:13:\"11.01.07.2001\";s:4:\"name\";s:7:\"Sikulat\";}i:1;a:2:{s:4:\"code\";s:13:\"11.01.07.2002\";s:4:\"name\";s:8:\"Sawang I\";}i:2;a:2:{s:4:\"code\";s:13:\"11.01.07.2003\";s:4:\"name\";s:7:\"Meuligo\";}i:3;a:2:{s:4:\"code\";s:13:\"11.01.07.2004\";s:4:\"name\";s:10:\"Lhok Pawoh\";}i:4;a:2:{s:4:\"code\";s:13:\"11.01.07.2005\";s:4:\"name\";s:9:\"Sawang II\";}i:5;a:2:{s:4:\"code\";s:13:\"11.01.07.2006\";s:4:\"name\";s:12:\"Ujung Karang\";}i:6;a:2:{s:4:\"code\";s:13:\"11.01.07.2007\";s:4:\"name\";s:20:\"Trieng Meuduro Baroh\";}i:7;a:2:{s:4:\"code\";s:13:\"11.01.07.2008\";s:4:\"name\";s:21:\"Trieng Meuduro Tunong\";}i:8;a:2:{s:4:\"code\";s:13:\"11.01.07.2009\";s:4:\"name\";s:11:\"Panton Luas\";}i:9;a:2:{s:4:\"code\";s:13:\"11.01.07.2010\";s:4:\"name\";s:12:\"Simpang Tiga\";}i:10;a:2:{s:4:\"code\";s:13:\"11.01.07.2011\";s:4:\"name\";s:9:\"Kuta Baro\";}i:11;a:2:{s:4:\"code\";s:13:\"11.01.07.2012\";s:4:\"name\";s:17:\"Blang Geulinggang\";}i:12;a:2:{s:4:\"code\";s:13:\"11.01.07.2013\";s:4:\"name\";s:7:\"Mutiara\";}i:13;a:2:{s:4:\"code\";s:13:\"11.01.07.2014\";s:4:\"name\";s:12:\"Ujung Padang\";}i:14;a:2:{s:4:\"code\";s:13:\"11.01.07.2015\";s:4:\"name\";s:11:\"Sawang Ba\'u\";}}', 1782378508),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_15.03.05', 'a:14:{i:0;a:2:{s:4:\"code\";s:13:\"15.03.05.2001\";s:4:\"name\";s:7:\"Penegah\";}i:1;a:2:{s:4:\"code\";s:13:\"15.03.05.2002\";s:4:\"name\";s:7:\"Pelawan\";}i:2;a:2:{s:4:\"code\";s:13:\"15.03.05.2003\";s:4:\"name\";s:8:\"Pulauaro\";}i:3;a:2:{s:4:\"code\";s:13:\"15.03.05.2004\";s:4:\"name\";s:5:\"Bukit\";}i:4;a:2:{s:4:\"code\";s:13:\"15.03.05.2005\";s:4:\"name\";s:11:\"Lubuk Sepuh\";}i:5;a:2:{s:4:\"code\";s:13:\"15.03.05.2006\";s:4:\"name\";s:13:\"Rantau Tenang\";}i:6;a:2:{s:4:\"code\";s:13:\"15.03.05.2007\";s:4:\"name\";s:11:\"Muara Danau\";}i:7;a:2:{s:4:\"code\";s:13:\"15.03.05.2013\";s:4:\"name\";s:12:\"Sungai Merah\";}i:8;a:2:{s:4:\"code\";s:13:\"15.03.05.2016\";s:4:\"name\";s:14:\"Pematang Kulim\";}i:9;a:2:{s:4:\"code\";s:13:\"15.03.05.2017\";s:4:\"name\";s:10:\"Batu Putih\";}i:10;a:2:{s:4:\"code\";s:13:\"15.03.05.2019\";s:4:\"name\";s:10:\"Mekar Sari\";}i:11;a:2:{s:4:\"code\";s:13:\"15.03.05.2021\";s:4:\"name\";s:13:\"Pasar Pelawan\";}i:12;a:2:{s:4:\"code\";s:13:\"15.03.05.2022\";s:4:\"name\";s:12:\"Pelawan Jaya\";}i:13;a:2:{s:4:\"code\";s:13:\"15.03.05.2023\";s:4:\"name\";s:11:\"Lubuk Sayak\";}}', 1782379676),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_19.01.06', 'a:9:{i:0;a:2:{s:4:\"code\";s:13:\"19.01.06.2001\";s:4:\"name\";s:5:\"Bakam\";}i:1;a:2:{s:4:\"code\";s:13:\"19.01.06.2002\";s:4:\"name\";s:5:\"Kapuk\";}i:2;a:2:{s:4:\"code\";s:13:\"19.01.06.2003\";s:4:\"name\";s:5:\"Dalil\";}i:3;a:2:{s:4:\"code\";s:13:\"19.01.06.2004\";s:4:\"name\";s:7:\"Neknang\";}i:4;a:2:{s:4:\"code\";s:13:\"19.01.06.2005\";s:4:\"name\";s:11:\"Tiang Tarah\";}i:5;a:2:{s:4:\"code\";s:13:\"19.01.06.2006\";s:4:\"name\";s:6:\"Mangka\";}i:6;a:2:{s:4:\"code\";s:13:\"19.01.06.2007\";s:4:\"name\";s:5:\"Mabat\";}i:7;a:2:{s:4:\"code\";s:13:\"19.01.06.2008\";s:4:\"name\";s:12:\"Bukit Layang\";}i:8;a:2:{s:4:\"code\";s:13:\"19.01.06.2009\";s:4:\"name\";s:12:\"Maras Senang\";}}', 1782378285),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_19.03.06', 'a:5:{i:0;a:2:{s:4:\"code\";s:13:\"19.03.06.2001\";s:4:\"name\";s:5:\"Sadai\";}i:1;a:2:{s:4:\"code\";s:13:\"19.03.06.2002\";s:4:\"name\";s:5:\"Tukak\";}i:2;a:2:{s:4:\"code\";s:13:\"19.03.06.2003\";s:4:\"name\";s:11:\"Pasir Putih\";}i:3;a:2:{s:4:\"code\";s:13:\"19.03.06.2004\";s:4:\"name\";s:5:\"Tiram\";}i:4;a:2:{s:4:\"code\";s:13:\"19.03.06.2005\";s:4:\"name\";s:11:\"Bukit Terap\";}}', 1782378267),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_31.71.02', 'a:5:{i:0;a:2:{s:4:\"code\";s:13:\"31.71.02.1001\";s:4:\"name\";s:10:\"Pasar Baru\";}i:1;a:2:{s:4:\"code\";s:13:\"31.71.02.1002\";s:4:\"name\";s:12:\"Karang Anyar\";}i:2;a:2:{s:4:\"code\";s:13:\"31.71.02.1003\";s:4:\"name\";s:7:\"Kartini\";}i:3;a:2:{s:4:\"code\";s:13:\"31.71.02.1004\";s:4:\"name\";s:19:\"Gunung Sahari Utara\";}i:4;a:2:{s:4:\"code\";s:13:\"31.71.02.1005\";s:4:\"name\";s:18:\"Mangga Dua Selatan\";}}', 1782378752),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_31.71.07', 'a:7:{i:0;a:2:{s:4:\"code\";s:13:\"31.71.07.1001\";s:4:\"name\";s:6:\"Gelora\";}i:1;a:2:{s:4:\"code\";s:13:\"31.71.07.1002\";s:4:\"name\";s:15:\"Bendungan Hilir\";}i:2;a:2:{s:4:\"code\";s:13:\"31.71.07.1003\";s:4:\"name\";s:13:\"Karet Tengsin\";}i:3;a:2:{s:4:\"code\";s:13:\"31.71.07.1004\";s:4:\"name\";s:10:\"Petamburan\";}i:4;a:2:{s:4:\"code\";s:13:\"31.71.07.1005\";s:4:\"name\";s:12:\"Kebon Melati\";}i:5;a:2:{s:4:\"code\";s:13:\"31.71.07.1006\";s:4:\"name\";s:12:\"Kebon Kacang\";}i:6;a:2:{s:4:\"code\";s:13:\"31.71.07.1007\";s:4:\"name\";s:12:\"Kampung Bali\";}}', 1782404829),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_31.72.02', 'a:7:{i:0;a:2:{s:4:\"code\";s:13:\"31.72.02.1001\";s:4:\"name\";s:13:\"Tanjung Priok\";}i:1;a:2:{s:4:\"code\";s:13:\"31.72.02.1002\";s:4:\"name\";s:11:\"Sunter Jaya\";}i:2;a:2:{s:4:\"code\";s:13:\"31.72.02.1003\";s:4:\"name\";s:8:\"Papanggo\";}i:3;a:2:{s:4:\"code\";s:13:\"31.72.02.1004\";s:4:\"name\";s:12:\"Sungai Bambu\";}i:4;a:2:{s:4:\"code\";s:13:\"31.72.02.1005\";s:4:\"name\";s:12:\"Kebon Bawang\";}i:5;a:2:{s:4:\"code\";s:13:\"31.72.02.1006\";s:4:\"name\";s:12:\"Sunter Agung\";}i:6;a:2:{s:4:\"code\";s:13:\"31.72.02.1007\";s:4:\"name\";s:7:\"Warakas\";}}', 1782379114),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_31.74.06', 'a:5:{i:0;a:2:{s:4:\"code\";s:13:\"31.74.06.1001\";s:4:\"name\";s:14:\"Cilandak Barat\";}i:1;a:2:{s:4:\"code\";s:13:\"31.74.06.1002\";s:4:\"name\";s:11:\"Lebak Bulus\";}i:2;a:2:{s:4:\"code\";s:13:\"31.74.06.1003\";s:4:\"name\";s:11:\"Pondok Labu\";}i:3;a:2:{s:4:\"code\";s:13:\"31.74.06.1004\";s:4:\"name\";s:16:\"Gandaria Selatan\";}i:4;a:2:{s:4:\"code\";s:13:\"31.74.06.1005\";s:4:\"name\";s:14:\"Cipete Selatan\";}}', 1782378191),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_31.74.08', 'a:6:{i:0;a:2:{s:4:\"code\";s:13:\"31.74.08.1001\";s:4:\"name\";s:8:\"Pancoran\";}i:1;a:2:{s:4:\"code\";s:13:\"31.74.08.1002\";s:4:\"name\";s:8:\"Kalibata\";}i:2;a:2:{s:4:\"code\";s:13:\"31.74.08.1003\";s:4:\"name\";s:8:\"Rawajati\";}i:3;a:2:{s:4:\"code\";s:13:\"31.74.08.1004\";s:4:\"name\";s:10:\"Duren Tiga\";}i:4;a:2:{s:4:\"code\";s:13:\"31.74.08.1005\";s:4:\"name\";s:10:\"Pengadegan\";}i:5;a:2:{s:4:\"code\";s:13:\"31.74.08.1006\";s:4:\"name\";s:6:\"Cikoko\";}}', 1782374681),
('sistem-keanggotaan-gerakan-indonesia-makmur-cache-villages_31.74.09', 'a:6:{i:0;a:2:{s:4:\"code\";s:13:\"31.74.09.1001\";s:4:\"name\";s:9:\"Jagakarsa\";}i:1;a:2:{s:4:\"code\";s:13:\"31.74.09.1002\";s:4:\"name\";s:15:\"Srengseng Sawah\";}i:2;a:2:{s:4:\"code\";s:13:\"31.74.09.1003\";s:4:\"name\";s:8:\"Ciganjur\";}i:3;a:2:{s:4:\"code\";s:13:\"31.74.09.1004\";s:4:\"name\";s:13:\"Lenteng Agung\";}i:4;a:2:{s:4:\"code\";s:13:\"31.74.09.1005\";s:4:\"name\";s:13:\"Tanjung Barat\";}i:5;a:2:{s:4:\"code\";s:13:\"31.74.09.1006\";s:4:\"name\";s:7:\"Cipedak\";}}', 1782379207);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_layouts`
--

CREATE TABLE `kartu_layouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_layout` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_path_depan` varchar(255) DEFAULT NULL,
  `tipe_file` varchar(255) NOT NULL,
  `field_positions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`field_positions`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kartu_layouts`
--

INSERT INTO `kartu_layouts` (`id`, `nama_layout`, `file_path`, `file_path_depan`, `tipe_file`, `field_positions`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Custom Layout 2026-06-24 10:03:08', 'layouts/iON8PGvE5X7bNfGfinovgy4Up0iAR4MvfbsIrsOo.jpg', NULL, 'image', '[]', 0, 1, '2026-06-24 03:03:08', '2026-06-24 03:03:49'),
(2, 'Custom Layout 2026-06-24 10:03:49', 'layouts/yMR6v0GPdB7qlQmc5Hepne3aeAdXRDggG7iUwW2G.jpg', NULL, 'image', '[]', 0, 1, '2026-06-24 03:03:49', '2026-06-24 03:04:00'),
(3, 'Custom Layout 2026-06-24 10:04:00', 'layouts/xsmQESPGSH84hYEtaFjMzuaD71lgsE7qUCnocibp.jpg', NULL, 'image', '{\"color\":\"#ffffff\",\"no_kartu\":{\"top\":\"20\",\"left\":\"26\",\"size\":\"10\"},\"nama\":{\"top\":\"14\",\"left\":\"26\",\"size\":\"12\"},\"qr\":{\"top\":\"15\",\"left\":\"6\",\"size\":\"17\"}}', 0, 1, '2026-06-24 03:04:00', '2026-06-24 23:19:32'),
(4, 'Custom Layout 2026-06-25 06:19:32', 'layouts/Eb0c4I9B9lk4uPxhl05Wv1oz2OtouUIYcPOl8i5B.jpg', NULL, 'image', '{\"color\":\"#ffffff\",\"no_kartu\":{\"top\":\"19\",\"left\":\"29\",\"size\":\"14\"},\"nama\":{\"top\":\"13\",\"left\":\"29\",\"size\":\"10\"},\"qr\":{\"top\":\"14\",\"left\":\"8\",\"size\":\"18\"}}', 0, 1, '2026-06-24 23:19:32', '2026-06-25 03:45:24'),
(5, 'Custom Layout 2026-06-25 10:45:24', 'layouts/Eb0c4I9B9lk4uPxhl05Wv1oz2OtouUIYcPOl8i5B.jpg', 'layouts/4g8Zw3kqYrWi6pnWOfIYNqPbpzA966Jcw2Yk7xGC.jpg', 'image', '{\"color\":\"#ffffff\",\"no_kartu\":{\"top\":\"19\",\"left\":\"29\",\"size\":\"14\"},\"nama\":{\"top\":\"13\",\"left\":\"29\",\"size\":\"10\"},\"qr\":{\"top\":\"14\",\"left\":\"8\",\"size\":\"18\"}}', 1, 1, '2026-06-25 03:45:24', '2026-06-25 03:45:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_24_074144_create_permission_tables', 1),
(5, '2026_06_24_074159_create_anggotas_table', 1),
(6, '2026_06_24_074205_create_wilayah_cache_table', 1),
(7, '2026_06_24_074326_create_kartu_layouts_table', 1),
(8, '2026_06_24_092035_fix_wilayah_code_length_in_anggotas_table', 2),
(9, '2026_06_25_103259_add_file_path_depan_to_kartu_layouts_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view dashboard', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(2, 'create anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(3, 'edit anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(4, 'delete anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(5, 'view anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(6, 'export anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(7, 'import anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(8, 'manage kartu', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(9, 'manage layout', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(10, 'manage users', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(11, 'manage settings', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(2, 'admin', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(3, 'anggota', 'web', '2026-06-24 01:47:26', '2026-06-24 01:47:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6yoJRW1QlUUFLxvyWb6HXL2wcVwMeAh41jHR4ZdI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkMHVTZnNIR0ZuckpmV1A5cmo2YzBlWXNuck9HQTc4WFJleFpVdzVnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1783409358),
('s2RrooIOfjHgbM71utnFUv2MWj15djm5UJvlU364', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJRUEFaWUozQk0xWU1ScEgxcWU2RTZkY29rMFl6djV0NXpMZWlCc2JzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1782464128);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@organisasi.com', '2026-06-24 01:47:26', '$2y$12$Z8qVTxnLFf2GoWhQTtIE3eq276hv.ssYinfiejsKgToNXVa8B39Om', NULL, '2026-06-24 01:47:26', '2026-06-24 01:47:26'),
(2, 'Admin Jambore', 'admin@organisasi.com', '2026-06-24 01:47:27', '$2y$12$g88aV7wEzpTzcYXeYlLlNuMSANQYBtaoG/j/KX8mCSOmxplnYANEO', NULL, '2026-06-24 01:47:27', '2026-06-25 00:04:00'),
(3, 'Anggota Demo', 'anggota@organisasi.com', '2026-06-24 01:47:27', '$2y$12$D9mDC5H7vhCENybvkG7N2OkXBqvmbq.fKzpt1zTdWuP5nRWb3TF.W', NULL, '2026-06-24 01:47:27', '2026-06-24 01:47:27'),
(4, 'Es Teh Manis', 'ezaprambanan@gmail.com', NULL, '$2y$12$A8RLRiHWmuIHO9d9rOuq8ume6kdbcPU.e5ALL/y5I9iA4DSMW9mf.', NULL, '2026-06-25 00:07:01', '2026-06-25 00:07:01'),
(5, 'Nasi Putih', 'ezaprambanan@gmail.comaa', NULL, '$2y$12$Q.FdC31wz1/DiX5nJ3CUXO23GCos0huWEYfJ4nDYA4XGJrhjAldYy', NULL, '2026-06-25 00:09:08', '2026-06-25 00:09:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah_cache`
--

CREATE TABLE `wilayah_cache` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('province','regency','district','village') NOT NULL,
  `code` varchar(255) NOT NULL,
  `parent_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_data`)),
  `cached_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggotas_no_kartu_unique` (`no_kartu`),
  ADD UNIQUE KEY `anggotas_nik_unique` (`nik`),
  ADD KEY `anggotas_user_id_foreign` (`user_id`),
  ADD KEY `anggotas_registered_by_foreign` (`registered_by`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kartu_layouts`
--
ALTER TABLE `kartu_layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_layouts_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wilayah_cache`
--
ALTER TABLE `wilayah_cache`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wilayah_cache_code_unique` (`code`),
  ADD KEY `wilayah_cache_parent_code_index` (`parent_code`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kartu_layouts`
--
ALTER TABLE `kartu_layouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `wilayah_cache`
--
ALTER TABLE `wilayah_cache`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  ADD CONSTRAINT `anggotas_registered_by_foreign` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `anggotas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `kartu_layouts`
--
ALTER TABLE `kartu_layouts`
  ADD CONSTRAINT `kartu_layouts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
