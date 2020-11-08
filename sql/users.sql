-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 01:01 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interim`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` int(11) NOT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT 1,
  `organization_id` bigint(20) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `created_by_user_id`, `remember_token`, `created_at`, `updated_at`, `status`, `deleted_at`, `role_id`, `organization_id`, `designation_id`) VALUES
(2, 'Bojitha Piyatilleke', 'boji@yahoo.com', '2020-11-06 05:04:42', '$2y$10$lAV1v1na6IECva8K6uMPHOwEMV5mPt21AwRFvV7ob1WTehzKErEZK', NULL, NULL, 0, NULL, '2020-11-06 05:04:17', '2020-11-06 05:04:42', 1, NULL, 1, 1, 4),
(3, 'Senal Hewage', 'senal@yahoo.com', '2020-11-06 05:51:28', '$2y$10$aQKl0mccMLeFACu49Phd/eQIGwAzr.nSdJUg.CpmGZpqjYfK.0iAG', NULL, NULL, 0, NULL, '2020-11-06 05:51:19', '2020-11-06 05:51:28', 1, NULL, 2, 3, 2),
(4, 'Thidas Perera', 'thidas@yahoo.com', '2020-11-06 05:51:57', '$2y$10$KH8jFmPC8Six/cmLc3UqEePEEY/wdREDj2Ghkeh4h5Kay0E4.QBqa', NULL, NULL, 0, NULL, '2020-11-06 05:51:47', '2020-11-06 05:51:57', 1, NULL, 3, 4, 5),
(5, 'Sharuka Perera', 'sharuka@yahoo.com', '2020-11-06 05:52:33', '$2y$10$s1QmLt/8vgYVMIPE04jKJ.ucoMuHpuw8D9RbU5.mcwQe0LZdfe73O', NULL, NULL, 0, NULL, '2020-11-06 05:52:22', '2020-11-06 05:52:33', 0, NULL, 2, 5, 7),
(6, 'Benjamin Subasinghe', 'benjamin@yahoo.com', '2020-11-06 05:53:11', '$2y$10$8MgZnq29OAFAGpIfN5CuLud3MbQZO5dmMTPETIOgkcIFWOgVnPPS6', NULL, NULL, 0, NULL, '2020-11-06 05:53:03', '2020-11-06 05:53:11', 1, NULL, 4, 2, 1),
(7, 'Dion Weiman', 'dion@gmail.com', '2020-11-06 06:27:05', '$2y$10$eVSi6Qwnf1OgEcAuMh.XAOC6muhwT6pOvZY1Kgw8XfCir22/br8Tu', NULL, NULL, 0, NULL, '2020-11-06 06:17:04', '2020-11-06 06:27:05', 0, NULL, 3, 3, 5),
(8, 'Chayu Damsinghe', 'chayu@yahoo.com', '2020-11-06 06:27:47', '$2y$10$4TS0d9TIyPROVTGTP80A.eRlZpEnlC4K3D6P0Rx6cr.20cw9iCxEi', NULL, NULL, 0, NULL, '2020-11-06 06:27:37', '2020-11-06 06:27:47', 0, NULL, 2, 4, 7),
(9, 'Saman Perera', 'saman@yahoo.com', '2020-11-06 06:28:40', '$2y$10$9pxh6cfAjrmAc3YHy3k/l.gkX8Dqa21RYSHsCS/AB1/UcxalyHtiO', NULL, NULL, 0, NULL, '2020-11-06 06:28:27', '2020-11-06 06:28:40', 1, NULL, 3, 5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_organization_id_foreign` (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
