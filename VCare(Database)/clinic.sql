-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 12:31 AM
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
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Beatae laborum dignissimos velit est vel temporibus. Ipsam iste consequatur recusandae omnis ipsa. Omnis quod est fuga sit minus earum. Vel vitae ullam ipsam.', '2024-10-30 17:19:06', '2024-10-30 17:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `appointment_date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(68, 37, '2024-11-04', '09:00:00', '18:00:00', '2024-11-03 16:13:28', '2024-11-03 16:13:28'),
(70, 39, '2024-11-04', '09:00:00', '18:00:00', '2024-11-03 19:18:10', '2024-11-03 19:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pinned','Booked','examined') NOT NULL DEFAULT 'pinned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `doctor_id`, `user_id`, `name`, `phone`, `email`, `time`, `created_at`, `updated_at`, `status`) VALUES
(15, 37, 70, 'omar hashem', '01068296014', 'ohashem321@gmail.com', '2024-11-04 12:00:00', '2024-11-03 19:14:36', '2024-11-03 19:15:09', 'pinned');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` enum('general_inquiry','technical_support','feedback','other') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(4, 'omar hashem', '01068296014', 'ohashem321@gmail.com', 'feedback', 'dakj;alkjfldskfsdf', '2024-11-03 19:20:35', '2024-11-03 19:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `experience_years` int(11) NOT NULL,
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `examination_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `phone`, `image`, `bio`, `experience_years`, `major_id`, `user_id`, `created_at`, `updated_at`, `examination_price`) VALUES
(28, 'Mohamed Hashem', 'mohashem@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730593937.jpeg', 'Blanditiis nisi volu Blanditiis nisi volu Blanditiis nisi volu Blanditiis nisi volu', 6, 12, 13, '2024-11-02 10:40:18', '2024-11-02 22:32:17', 300),
(29, 'Abdulrahman Hashem', 'abdulrahman@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730593952.jpeg', 'Dolor doloribus qui  Dolor doloribus qui  Dolor doloribus qui  Dolor doloribus qui  Dolor doloribus qui', 7, 13, 14, '2024-11-02 10:42:53', '2024-11-02 22:32:32', 500),
(30, 'Mahmoud Gaber', 'mahmoud@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730593983.jpeg', 'Aut modi saepe inven Aut modi saepe inven Aut modi saepe inven Aut modi saepe inven Aut modi saepe inven', 4, 15, 15, '2024-11-02 10:45:26', '2024-11-02 22:33:03', 600),
(31, 'Ahmed Mahmoud', 'ahmed_mahmoud@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730594000.jpeg', 'Non repellendus Fug Non repellendus Fug Non repellendus Fug Non repellendus Fug', 1, 16, 16, '2024-11-02 10:47:38', '2024-11-02 22:33:20', 200),
(32, 'Mahmoud Kareem', 'mahmoud_kareem@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730594017.jpeg', 'Dolor doloribus qui Dolor doloribus qui  Dolor doloribus qui Dolor doloribus qui Dolor doloribus qui', 8, 17, 17, '2024-11-02 10:49:30', '2024-11-02 22:33:37', 500),
(33, 'Asmaa Mahamed', 'asmaa@app.com', '01068296014', 'storage/doctors/doctor-doctor-1730594032.jpeg', 'Nostrum similique cu Nostrum similique cu Nostrum similique cu Nostrum similique cu', 2, 18, 18, '2024-11-02 10:51:24', '2024-11-02 22:33:52', 900),
(34, 'Mariam Ahmed', 'mariam@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730594046.jpeg', 'Blanditiis nisi volu Blanditiis nisi volu Blanditiis nisi volu Blanditiis nisi volu', 3, 19, 19, '2024-11-02 10:54:15', '2024-11-02 22:34:06', 300),
(37, 'Ahmed Hashem', 'ahmed@gmail.com', '01068296014', 'storage/doctors/doctor-doctor-1730656805.jpeg', 'Nostrum similique cu Nostrum similique cu Nostrum similique cu Nostrum similique cu Nostrum similique cu', 5, 14, 49, '2024-11-03 15:37:02', '2024-11-03 16:00:05', 900),
(39, 'Kareem Hassan', 'kareem@gmail.com', '01068296014', 'storage/doctors/doctor-Kareem Hassan.jpeg', 'Blanditiis nisi volu Blanditiis nisi volu Blanditiis nisi volu Blanditiis nisi volu', 6, 22, 71, '2024-11-03 19:17:09', '2024-11-03 19:17:09', 600);

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link_google_play` varchar(255) NOT NULL,
  `link_app_store` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `title`, `description`, `link_google_play`, `link_app_store`, `image`, `created_at`, `updated_at`) VALUES
(1, 'download the application now', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facere eveniet in id, quod explicabo minus ut, sint possimus, fuga voluptas. Eius molestias eveniet labore ullam magnam sequi possimus quaerat!', 'https://www.kyruzemocu.cc', 'https://www.tetibipy.com.au', 'storage/downloads/download-download-1730554294.jpg', '2024-11-02 11:25:18', '2024-11-02 11:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'everything you need is found at VCare.', 'storage/infos/info-info-1730665106.svg', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone, you can also order medicine or book a surgery.', '2024-10-30 17:18:56', '2024-11-03 18:18:26'),
(2, 'everything you need is found at VCare.', 'storage/infos/info-info-1730665157.svg', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone, you can also order medicine or book a surgery.', '2024-10-30 17:18:56', '2024-11-03 18:19:17'),
(3, 'everything you need is found at VCare.', 'storage/infos/info-info-1730665163.svg', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone, you can also order medicine or book a surgery.', '2024-10-30 17:18:56', '2024-11-03 18:19:23'),
(4, 'everything you need is found at VCare.', 'storage/infos/info-info-1730665181.svg', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone, you can also order medicine or book a surgery.v', '2024-10-30 17:18:56', '2024-11-03 18:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(12, 'Bones', 'storage/majors/major-Bones.jpg', '2024-11-02 09:37:18', '2024-11-02 09:37:18'),
(13, 'Dental Surgery', 'storage/majors/major-major-1730548789.jpg', '2024-11-02 09:46:15', '2024-11-02 09:59:49'),
(14, 'Brain and Nerves', 'storage/majors/major-Brain and Nerves.jpeg', '2024-11-02 09:48:09', '2024-11-02 09:48:09'),
(15, 'Eyes', 'storage/majors/major-Eyes.png', '2024-11-02 09:49:51', '2024-11-02 09:49:51'),
(16, 'children', 'storage/majors/major-major-1730548446.jpeg', '2024-11-02 09:52:28', '2024-11-02 09:54:06'),
(17, 'Skin Diseases', 'storage/majors/major-Skin Diseases.jpeg', '2024-11-02 10:04:41', '2024-11-02 10:04:41'),
(18, 'Women and Childbirth', 'storage/majors/major-Women and Childbirth.jpg', '2024-11-02 10:07:07', '2024-11-02 10:07:07'),
(19, 'Mental Illnesses', 'storage/majors/major-Mental Illnesses.jpg', '2024-11-02 10:11:27', '2024-11-02 10:11:27'),
(22, 'Nose, ear and throat', 'storage/majors/major-Nose, ear and throat.jpg', '2024-11-03 19:15:35', '2024-11-03 19:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_19_215456_create_majors_table', 1),
(6, '2024_10_20_001749_create_doctors_table', 1),
(7, '2024_10_20_215006_create_infos_table', 1),
(8, '2024_10_20_222346_create_sliders_table', 1),
(9, '2024_10_20_225353_create_abouts_table', 1),
(10, '2024_10_22_210250_create_roles_table', 1),
(11, '2024_10_22_210431_add_roles_to_users_table', 1),
(12, '2024_10_23_175904_add_phone_to_users_table', 1),
(13, '2024_10_24_120433_create_appointment_table', 1),
(14, '2024_10_24_194434_create_books_table', 1),
(15, '2024_10_31_110446_create_contacts_table', 2),
(16, '2024_10_31_111219_create_contact_table', 3),
(17, '2024_10_31_111548_create_contacts_table', 4),
(18, '2024_10_31_113654_create_contacts_table', 5),
(19, '2024_11_02_125533_create_downloads_table', 6),
(22, '2024_11_02_191815_add_status_to_books_table', 7),
(23, '2024_11_02_192202_add__examination_price_to_doctors_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2024-10-30 17:18:16', '2024-10-30 17:18:16'),
(2, 'admin', '2024-10-30 17:18:16', '2024-10-30 17:18:16'),
(3, 'doctor', '2024-10-30 17:18:16', '2024-10-30 17:18:16'),
(4, 'patient', '2024-10-30 17:18:16', '2024-10-30 17:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Have a Medical Question?', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque, laborum saepe enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis consequatur cum iure quod facere.', 'storage/sliders/slider-slider-1730665053.jpg', '2024-10-30 17:19:06', '2024-11-03 18:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `phone`) VALUES
(1, 'Admin', 'admin@app.com', '2024-10-30 17:18:16', '$2y$12$YoZZaSeY2xCPIBj1YHf3megmcTekmLWJPddMeXzhvqx1cM6CQ3Zo2', 'HgqFflHazG0CSXwy81Fq4KtIjc8LfZIqlflJg9tJ8G3gIxrcMLmAGl8iYUln', '2024-10-30 17:18:17', '2024-10-30 17:18:17', 1, NULL),
(6, 'Lana Martin', 'husaqyg@mailinator.com', NULL, '$2y$12$/4cHLOOjzu1bb786JaNhm.lm1gu2sTN/1/bof2kW4rzay0RG.nla2', NULL, '2024-11-01 19:10:31', '2024-11-03 00:51:03', 4, '01068296014'),
(7, 'Dane Huffman', 'pegy@mailinator.com', NULL, '$2y$12$hYk.aabc6ZySElompN9QFeGyIqxD5FuOAWZaTHUxNajyNTsmKlggq', NULL, '2024-11-01 19:14:41', '2024-11-03 12:32:53', 4, '01068296014'),
(13, 'Mohamed Hashem', 'mohamed_DOC@gmail.com', NULL, '$2y$12$eNtNjWI.tixvsFjXU9auieA0f39QKIMX.HHpygQKGgnomwaZIgvHC', NULL, '2024-11-02 10:39:17', '2024-11-03 00:04:13', 3, '01068296014'),
(14, 'Abdulrahman Hashem', 'abdulrahman_DOC@gmail.com', NULL, '$2y$12$umRxnquBdRHjaRJrYgsV3uWU4oz7vQpGiVBwuxV5Pm1/QguqgGbb2', NULL, '2024-11-02 10:41:59', '2024-11-02 19:59:25', 3, '01068296014'),
(15, 'Mahmoud Gaber', 'mahmoud_DOC@gmail.com', NULL, '$2y$12$hLMQx47eC9g.2B1nTp0tzObJkmP9euwwqu2mRaHLVxXqW3X.7wXTG', NULL, '2024-11-02 10:44:40', '2024-11-02 20:03:00', 3, '01068296014'),
(16, 'Ahmed Mahmoud', 'Ahmed _DOC_2@gmail.com', NULL, '$2y$12$sGjJ1RiCxZpa7D39iNtAyedrU7T71zHyPQIlS0sQ/F7/oVeT6Dqpe', NULL, '2024-11-02 10:46:25', '2024-11-02 10:46:25', 3, '01068296014'),
(17, 'Mahmoud Kareem', 'mahmoud _DOC_2@gmail.com', NULL, '$2y$12$tAIxxEKnxsij7X3H5xrYhON8iBTOCJjTgeOFlobKzak59ZCWwW9Re', NULL, '2024-11-02 10:48:27', '2024-11-02 10:48:27', 3, '01068296014'),
(18, 'Asmaa Mahamed', 'asmaa _DOC@gmail.com', NULL, '$2y$12$028IusqcGg9XzUXK9M7NzuaStNpA.woHkmYp5mmc6xtGGhqDQ1Qa2', NULL, '2024-11-02 10:50:36', '2024-11-02 10:50:36', 3, '01068296014'),
(19, 'Mariam Ahmed', 'mariam _DOC@gmail.com', NULL, '$2y$12$wzH4C42EOPFCiwgW5Fr6W.pfZ/dBpXoXyU9Qa3m7OYwvhUTIfqtnq', NULL, '2024-11-02 10:53:22', '2024-11-02 10:53:22', 3, '01068296014'),
(49, 'Ahmed Hashem', 'ahmed_DOC@gmail.com', NULL, '$2y$12$5Ue3moHFpsZZQtI2IFHILuHn2fCPLGsjLeMbxyf0LUYM.byOzQqIO', NULL, '2024-11-03 15:36:39', '2024-11-03 15:37:46', 3, '01068296014'),
(70, 'omar hashem', 'omarhashem321@gmail.com', NULL, '$2y$12$M/6t6eG9oArG3rgkomtSk.kni8THAHjY34hWXnk1oy1.QIE3y0wzi', NULL, '2024-11-03 19:13:40', '2024-11-03 19:14:10', 4, '01068296014'),
(71, 'Kareem Hassan', 'kareem_DOC@gmail.com', NULL, '$2y$12$vCbWisgTv2nYyDluFdmD3ezLx5tIRE6NpBCxImQUP/0Uaw5HQbd/.', NULL, '2024-11-03 19:16:26', '2024-11-03 19:16:26', 3, '01068296014'),
(72, 'eraasoft', 'eraasoft@gmail.com', NULL, '$2y$12$tui6A0bVk3vN9fhiDX2Uz.47IRyn8E8B2Vp/eofx8uRo9XVC4iJTS', NULL, '2024-11-03 19:20:06', '2024-11-03 19:20:06', 1, '01068296014');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_doctor_id_foreign` (`doctor_id`),
  ADD KEY `books_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_email_unique` (`email`),
  ADD KEY `doctors_major_id_foreign` (`major_id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
