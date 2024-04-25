-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 25, 2024 at 07:39 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipad`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_dokumen_id` bigint(20) UNSIGNED NOT NULL,
  `pengirim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `berkas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_berkas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ekstensi_berkas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `maksud_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acara` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengundang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delegasi_hadir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kantor_id` bigint(20) UNSIGNED NOT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contoh`
--

CREATE TABLE `contoh` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `ini_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_datepicker` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_excel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_textarea` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_select` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_select2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ini_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contoh`
--

INSERT INTO `contoh` (`id`, `ini_text`, `ini_number`, `ini_email`, `ini_datepicker`, `ini_gambar`, `ini_excel`, `ini_file`, `ini_textarea`, `ini_select`, `ini_select2`, `ini_password`) VALUES
(1, 'DSBId', '6', 'laila24@gmail.com', '2001-12-23', 'public/ini_gambar/0B0znS9te9bSD87ALjFD.jpg', 'public/ini_excel/N9kRv2gy8iciwDpnpqHj.xlsx', 'public/ini_file/Iu3CIPrkvg1I8N9AMAIs.pdf', 'Commodi voluptas architecto sit quia. Sed vel nisi fugit facere quisquam corrupti. Ut atque sint tempora alias itaque vitae est.', 'Option 2', 'Option 1', '$2y$10$DMY/pSJC4YTAE.RwMHgyO.PozdeKihe1FCJfttoz97Swdxoh5f08S'),
(2, 'aFIdL', '5', 'nnatsir@yahoo.com', '1988-03-05', 'public/ini_gambar/NWzaYF3zgtGWrgHmyPsB.jpg', 'public/ini_excel/WSgjWdVimVfghsG3ulb8.xlsx', 'public/ini_file/V165xGujn48JTF55VCtI.pdf', 'Voluptatibus excepturi et sed dolor unde. Eligendi ab ut velit iusto sed amet. Quaerat qui occaecati animi commodi id. Tempora voluptas architecto sint omnis animi. Ea quisquam accusantium et.', 'Option 2', 'Option 1', '$2y$10$u.nAMeUJRVsOmnCoEfgPHOnDOXk.MKmVXAovffSSASt5c8ysqox96'),
(3, 'UGGUA', '5', 'tami.gunawan@yahoo.co.id', '2000-11-15', 'public/ini_gambar/H9qqUqnCE9Qx5gNpdJKC.jpg', 'public/ini_excel/x6k5Tju2I44RGT8D2fO6.xlsx', 'public/ini_file/TVtfejNjTIB6bYYEaACf.pdf', 'Ab illo nam maxime. Dignissimos qui nisi magni laboriosam sint provident. Dolore doloremque quia dolorum eius iste officia ea. Quam saepe repellat doloribus minima.', 'Option 1', 'Option 1', '$2y$10$3IOEs0ybHe0IZ/cXfnVMq.E7fFKph9527NClWvS7nCHxTQ9EUqGYi'),
(4, 'GLd6f', '2', 'setiawan.embuh@riyanti.info', '2018-12-26', 'public/ini_gambar/HmE2frlGSmcHnnWIJtJ3.jpg', 'public/ini_excel/AJWHiwTA95ywPt8QQKYn.xlsx', 'public/ini_file/92oKqYQnGvNrpNz0TMNM.pdf', 'Et et voluptatem aliquam et totam nam laboriosam quas. Et quos impedit ratione harum veritatis. Magnam ea et a. Quia voluptas voluptates dolor quod.', 'Option 2', 'Option 2', '$2y$10$365RtEoCY7A8ck/QXxOa7uWlGaIU10.Q9wChEiH4XKA9gnDdvaztu'),
(5, 'ei0AX', '5', 'cayadi73@yahoo.com', '2004-10-16', 'public/ini_gambar/bb2KXX8Wwxzd7J0biFpw.jpg', 'public/ini_excel/3EGeOthpTZoTMq8HcMCv.xlsx', 'public/ini_file/oTu71EnawhgA7DySuxO0.pdf', 'Cumque ut impedit velit officiis et nam quisquam. Qui quas minus numquam molestias enim aut maxime. Eius voluptas fugiat non sint excepturi voluptate aut amet.', 'Option 1', 'Option 1', '$2y$10$MB/whwXX3D/FYMZaRy3UbegmRC.vYfS8jU/gY8SVOBJcdkwEeN3Ve'),
(6, 'uvQqg', '7', 'permadi.suci@winarno.net', '2010-03-23', 'public/ini_gambar/qJvazdtgdFN4IW4N7cJ1.jpg', 'public/ini_excel/DVyj7FPSXts7tQxPyaH4.xlsx', 'public/ini_file/Yze179DXxdcTVSl8Gxyb.pdf', 'Quae occaecati sed sit quia omnis. Necessitatibus voluptatem qui fuga minus atque maiores natus quidem. Voluptatem illum odio quae eos et laborum.', 'Option 1', 'Option 2', '$2y$10$B0oYC2hEj3ghXG1mtMLGSumYMcxGEToYE/g4TTYUh6AFm9Uec4/Ty'),
(7, 'zO6kS', '2', 'warsa43@usamah.name', '2002-08-03', 'public/ini_gambar/8zvMcBCRGhXOD8WkSLn7.jpg', 'public/ini_excel/AgcbddVslCKw7jK2IRW3.xlsx', 'public/ini_file/PAWZ8O03AGgDC9vah5ot.pdf', 'Autem libero et voluptate repellendus. Perspiciatis optio non corrupti vero facere. Quae voluptates minus aut. Id non ut dolorum odio.', 'Option 2', 'Option 2', '$2y$10$dBbcWXUIgZbfj4z68O2V0OetFsaAJjy/7/EoNcHsAPjzuFCFwBJh.'),
(8, 'QIcWr', '4', 'vsalahudin@permata.name', '2018-05-31', 'public/ini_gambar/JdnregMDRx7wSbafdLyL.jpg', 'public/ini_excel/yiDALvo3i2mxwM3unK2J.xlsx', 'public/ini_file/5N4LFe27l0NsTkk2xj0h.pdf', 'Doloremque et quo aut est at voluptatem. Ab ut quis sit error et autem dicta alias. Et voluptatibus magnam totam in exercitationem dolorum omnis. Quo nostrum totam tempore amet.', 'Option 2', 'Option 2', '$2y$10$vhHCnxunLtqWS9NvozXpHeAcjmqKvhs/8G4PoVWXGZjC2BSaXVzP6'),
(9, 'ZCJAd', '6', 'mangunsong.ganep@yahoo.co.id', '1987-12-13', 'public/ini_gambar/50vVF9Nvr31u1ND3RPkK.jpg', 'public/ini_excel/D5KBG3qqVkFLnhqCGkJk.xlsx', 'public/ini_file/0U5cT5RHO5pukW3z2pbr.pdf', 'Expedita nihil consequatur dolorum totam eveniet. Exercitationem sed amet ut aperiam. Tempora molestiae libero ea molestias non atque repellendus.', 'Option 2', 'Option 1', '$2y$10$sW2nGl7H7t/2foMZ.qc1v.IeGdlWJ/tipowCGB4OeFtde32eaJ82K'),
(10, '6oer8', '4', 'kamaria.saefullah@lailasari.org', '2005-11-12', 'public/ini_gambar/i6Ivrqac9IEfPJmd1mev.jpg', 'public/ini_excel/9PAmwg2q1NN36pas9Ogw.xlsx', 'public/ini_file/FGkWFBrWlWPT2fmmJDfg.pdf', 'Omnis in vel rerum libero. Numquam non debitis odio itaque ipsa. Provident ullam eos et molestiae. Sequi omnis nesciunt temporibus error neque labore earum inventore. Voluptate et eveniet vitae ea.', 'Option 1', 'Option 2', '$2y$10$1bWtklWlQKy3BYAcyukzOurmjdtO99Uc4YeWWRNMowotQqCGa67aG');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

CREATE TABLE `jenis_dokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_dokumen`
--

INSERT INTO `jenis_dokumen` (`id`, `nama`, `route`, `created_at`, `updated_at`) VALUES
(1, 'Surat Masuk', 'surat_masuk', NULL, NULL),
(2, 'Surat Keluar', 'surat_keluar', NULL, NULL),
(3, 'Pegawai', 'pegawai', NULL, NULL),
(4, 'Organisasi', 'organisasi', NULL, NULL),
(5, 'Undangan', 'undangan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id`, `nama`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'KANTOR PUSAT', 2, NULL, NULL),
(2, 'CABANG UTAMA', 3, NULL, NULL),
(3, 'CABANG AYAH', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_blank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `roles` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `route`, `url`, `ikon`, `is_blank`, `parent_id`, `roles`) VALUES
(1, 'Dashboard', 'dashboard', NULL, 'fas fa-fire', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(2, 'Surat Masuk', NULL, 'arsip/surat_masuk', 'fas fa-envelope-open', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(3, 'Surat Keluar', NULL, 'arsip/surat_keluar', 'fas fa-envelope', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(4, 'Pegawai', NULL, 'arsip/pegawai', 'fas fa-user-friends', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(5, 'Organisasi', NULL, 'arsip/organisasi', 'fas fa-users', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(6, 'Undangan', NULL, 'arsip/undangan', 'fas fa-envelope-open-text', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(7, 'Kantor', 'kantor.index', NULL, 'fas fa-university', NULL, NULL, '[\"superadmin\"]'),
(8, 'Profil', 'profil', NULL, 'fas fa-user', NULL, NULL, '[\"superadmin\",\"admin\"]'),
(9, 'Pengaturan', 'pengaturan', NULL, 'fas fa-cogs', NULL, NULL, '[\"superadmin\"]'),
(10, 'Keluar', 'keluar', NULL, 'fas fa-sign-out-alt', NULL, NULL, '[\"superadmin\",\"admin\"]');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(26, '2022_09_26_025222_create_settings_table', 3),
(27, '2014_10_12_000000_create_users_table', 4),
(28, '2014_10_12_100000_create_password_resets_table', 4),
(29, '2019_08_19_000000_create_failed_jobs_table', 4),
(30, '2019_12_18_172154_create_pengaturans_table', 4),
(31, '2019_12_18_172249_create_menus_table', 4),
(32, '2019_12_18_172249_create_moduls_table', 4),
(33, '2019_12_19_172249_create_contoh_table', 4),
(34, '2020_01_18_184209_create_jenis_dokumens_table', 4),
(35, '2020_01_18_185244_create_arsips_table', 4),
(36, '2020_01_19_094739_create_kantors_table', 4),
(37, '2020_01_19_110155_add_kantor_id_di_tabel_arsip', 4),
(38, '2020_01_20_132846_tambah_disk_di_arsip', 4);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ikon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `nama`, `ikon`, `label`) VALUES
(1, 'dashboard', 'fa fa-fire', 'Dashboard'),
(2, 'profil', 'fa fa-user', 'Profil'),
(3, 'contoh', 'fa fa-atom', 'Contoh'),
(4, 'surat_masuk', 'fa fa-envelope-open', 'Surat Masuk'),
(5, 'surat_keluar', 'fa fa-envelope', 'Surat Keluar'),
(6, 'pegawai', 'fa fa-user-friends', 'Pegawai'),
(7, 'organisasi', 'fa fa-users', 'Organisasi'),
(8, 'undangan', 'fa fa-envelope-open-text', 'Undangan'),
(9, 'kantor', 'fa fa-university', 'Kantor'),
(10, 'pengaturan', 'fa fa-cogs', 'Pengaturan'),
(11, 'keluar', 'fa fa-sign-out', 'Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `grup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengaturan_umum',
  `grup_label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pengaturan Umum',
  `ikon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-cog',
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pengaturan apa hayo',
  `pilihan` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `key`, `value`, `form_type`, `grup`, `grup_label`, `ikon`, `label`, `pilihan`) VALUES
(1, 'tahun', '2020', 'text', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-calendar', 'Tahun', NULL),
(2, 'nama_perusahaan', 'Nama Perusahaan', 'text', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-building', 'Nama Perusahaan', NULL),
(3, 'kota', 'Jember', 'text', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-city', 'Kota', NULL),
(4, 'negara', 'Indonesia', 'text', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-flag', 'Negara', NULL),
(5, 'logo', 'http://127.0.0.1:8000/stisla/assets/img/stisla-fill.png', 'image', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-atom', 'Logo', NULL),
(6, 'favicon', 'http://127.0.0.1:8000/stisla/assets/img/favicon.ico', 'image', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-heart', 'Favicon', NULL),
(7, 'background_masuk', 'http://127.0.0.1:8000/stisla/assets/img/pantai.jpg', 'image', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-image', 'Background Masuk', NULL),
(8, 'sidebar_mini', 'false', 'select', 'pengaturan_umum', 'Pengaturan Umum', 'fas fa-cog', 'Sidebar Mini', '{\"true\":\"true\",\"false\":\"false\"}'),
(9, 'ukuran_kertas', 'A4', 'select', 'pengaturan_laporan', 'Pengaturan Laporan', 'fas fa-paper', 'Ukuran Kertas', '{\"A4\":\"A4\",\"A3\":\"A3\",\"F4\":\"F4\",\"Legal\":\"Legal\"}'),
(10, 'layouts', 'landscape', 'select', 'pengaturan_laporan', 'Pengaturan Laporan', 'fas fa-paper', 'Layouts', '{\"landscape\":\"landscape\",\"portrait\":\"portrait\"}'),
(11, 'meta_description', 'Nama Perusahaan', 'text', 'pengaturan_meta', 'Pengaturan Meta', 'fas fa-globe', 'Meta Description', NULL),
(12, 'meta_keywords', 'Sistem Informasi, Pemrograman, Github, PHP, Laravel, Stisla, Heroku, Koperasi, Nururrohmah', 'text', 'pengaturan_meta', 'Pengaturan Meta', 'fas fa-globe', 'Meta Keywords', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'dropBoxAccessToken', 'sl.BbBxAsYdNKyPhoUmr2bUP7c9cAjeHDDy_jKm8AjhPncp5zZdF7McLPsXRB49oF0AUoWVJ9qws_4QIcADE6OvQJGyYb74cTJ5DH2dz0W7B491nlDPZebbHeOnjeLZNgGoU3WlXBg', '2023-03-21 20:17:42', '2023-03-21 20:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'superadmin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `avatar`, `role`, `remember_token`) VALUES
(1, 'Hairul Anam', 'superadmin@sipad.com', '$2y$10$EIbAssR3VZhmzdux86bio.ClosCWkx267iFICw5EE.pd3wqQETZ2G', 'http://127.0.0.1:8000/stisla/assets/img/avatar/avatar-1.png', 'superadmin', NULL),
(2, 'ADMIN KANTOR PUSAT', 'kantor_pusat@sipad.com', '$2y$10$5cLAHmugwi7u5cit0y0Dx.g7ekFPc7j7oodU9eVDiR1/cw1D9T8hS', 'http://127.0.0.1:8000/stisla/assets/img/avatar/avatar-1.png', 'admin', NULL),
(3, 'ADMIN CABANG UTAMA', 'cabang_utama@sipad.com', '$2y$10$26s1plI88xQQ8KXDW3ZnUuY9zGCF3X8yPb2eUJH4JGmWeGh8bCxmm', 'http://127.0.0.1:8000/stisla/assets/img/avatar/avatar-1.png', 'admin', NULL),
(4, 'ADMIN CABANG AYAH', 'cabang_ayah@sipad.com', '$2y$10$v/ImtXARWSQSxdwPbJNDZu5VaDDgySz7E9rcYxdyD4dabOLdza69.', 'http://127.0.0.1:8000/stisla/assets/img/avatar/avatar-1.png', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arsip_jenis_dokumen_id_foreign` (`jenis_dokumen_id`),
  ADD KEY `arsip_kantor_id_foreign` (`kantor_id`);

--
-- Indexes for table `contoh`
--
ALTER TABLE `contoh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kantor_user_id_foreign` (`user_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contoh`
--
ALTER TABLE `contoh`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `arsip_jenis_dokumen_id_foreign` FOREIGN KEY (`jenis_dokumen_id`) REFERENCES `jenis_dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arsip_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kantor`
--
ALTER TABLE `kantor`
  ADD CONSTRAINT `kantor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
