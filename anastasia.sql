-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2019 at 04:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anastasia`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2019-05-24 17:33:56', '2019-05-24 17:33:56', 'Evening Gown'),
(2, '2019-05-24 17:33:56', '2019-05-24 17:33:56', 'Wedding Gown'),
(3, '2019-05-24 17:33:56', '2019-05-24 17:33:56', 'Tuxedo'),
(4, '2019-05-24 17:33:57', '2019-05-24 17:33:57', 'Barong');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days_rented` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_orders`
--

INSERT INTO `item_orders` (`id`, `created_at`, `updated_at`, `price`, `size`, `days_rented`, `quantity`, `order_id`, `product_id`) VALUES
(1, '2019-05-28 20:15:52', '2019-05-28 20:15:52', '200', 'small', 1, 1, 21, 10),
(2, '2019-05-28 20:15:52', '2019-05-28 20:15:52', '650', 'small', 1, 1, 21, 1),
(3, '2019-05-28 20:17:28', '2019-05-28 20:17:28', '200', 'small', 1, 1, 22, 10),
(4, '2019-05-28 23:08:41', '2019-05-28 23:08:41', '200', 'medium', 1, 3, 23, 10),
(5, '2019-05-28 23:08:41', '2019-05-28 23:08:41', '300', 'medium', 2, 3, 23, 7),
(6, '2019-05-29 05:25:00', '2019-05-29 05:25:00', '450', 'small', 3, 2, 25, 7),
(10, '2019-05-29 05:49:14', '2019-05-29 05:49:14', '7,150', 'medium', 11, 1, 47, 1),
(11, '2019-05-29 05:50:22', '2019-05-29 05:50:22', '4,550', 'medium', 7, 1, 48, 1);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_24_043332_create_categories_table', 1),
(4, '2019_05_24_043349_create_products_table', 1),
(5, '2019_05_24_043645_create_orders_table', 1),
(6, '2019_05_24_043658_create_statuses_table', 1),
(7, '2019_05_24_043714_create_roles_table', 1),
(8, '2019_05_24_043738_create_sizes_table', 1),
(9, '2019_05_24_053036_update_products_table', 1),
(10, '2019_05_24_053422_update_orders_table', 1),
(11, '2019_05_24_053747_create_product_size_table', 1),
(12, '2019_05_25_110035_add_softdeletes_product_tables', 2),
(13, '2019_05_27_083916_update_orders_table', 3),
(14, '2019_05_28_001728_change_pivot_table_name', 4),
(15, '2019_05_28_071026_create_favorites_table', 5),
(16, '2019_05_29_040627_create_item_orders_table', 5),
(17, '2019_05_29_041119_update_item_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `total`, `user_id`, `status_id`, `transaction_id`) VALUES
(21, '2019-05-28 20:15:51', '2019-05-28 23:03:16', '850.00', 1, 3, 'AD593E-1559103351'),
(22, '2019-05-28 20:17:28', '2019-05-28 23:08:04', '200.00', 1, 3, '8DCE94-1559103448'),
(23, '2019-05-28 23:08:41', '2019-05-29 05:16:45', '1500.00', 1, 3, '44D06A-1559113721'),
(25, '2019-05-29 05:25:00', '2019-05-29 05:25:00', '900.00', 1, 1, '8442BA-1559136300'),
(47, '2019-05-29 05:49:14', '2019-05-29 05:51:25', '7150.00', 1, 3, 'D57881-1559137754'),
(48, '2019-05-29 05:50:22', '2019-05-29 05:51:20', '4550.00', 1, 2, 'AA370D-1559137822');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://zenit.org/wp-content/uploads/2018/05/no-image-icon.png',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `img_path`, `category_id`, `deleted_at`) VALUES
(1, '2019-05-24 17:34:46', '2019-05-24 17:34:46', 'Jasmine', 'Beautiful French chantilly lace gown with a sweetheart neckline, draped bodice, and full A-line skirt.', '650.00', 'images/jasmine-1.jpeg', 1, NULL),
(2, '2019-05-24 17:34:46', '2019-05-24 17:34:46', 'Cinderella', 'Delicate, lace-printed, tulle ball gown with embroidered lace hem and draped bodice that cinches at the waist.', '700.00', 'images/cinderella-1.jpg', 1, NULL),
(3, '2019-05-24 17:34:46', '2019-05-24 17:34:46', 'Rapunzel', '50’s inspired tulle gown with French lace bodice and flower sash.', '1000.00', 'images/rapunzel-1.jpg', 2, NULL),
(4, '2019-05-24 22:51:37', '2019-05-24 22:51:37', 'Belle', ' Sexy draped bodice with sweetheart neckline and tiered trumpet skirt.', '1300.00', 'images/belle-1.jpg', 2, NULL),
(5, '2019-05-24 22:52:42', '2019-05-24 22:52:42', 'Phillip', 'A 2 button front, self notch lapels with satin trim, satin besom pockets and side vents.', '150.00', 'images/phillip.jpg', 3, NULL),
(6, '2019-05-24 23:25:28', '2019-05-25 03:28:25', 'Hercules', 'A slim-fit tuxedo is which well suited for those who are looking to stand out from the crowd.', '300.00', 'images/hercules.jpg', 3, NULL),
(7, '2019-05-25 01:41:46', '2019-05-29 05:57:59', 'Eric', 'Ideal for those who don’t want to spend a lot of money on a barong but still want a more refined and classic look.', '160.00', 'images/eric.jpg', 4, NULL),
(10, '2019-05-25 04:50:12', '2019-05-25 04:50:12', 'Aladdin', 'Originally-made in the Philippines, the Pina fabric is meticulously woven by local artisans who have combined age-old Filipino weaving techniques.', '200.00', 'images/aladdin.png', 4, NULL),
(11, '2019-05-25 15:28:30', '2019-05-29 05:58:06', 'Lara Croft', '123', '232.00', 'https://zenit.org/wp-content/uploads/2018/05/no-image-icon.png', 1, '2019-05-29 05:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` bigint(20) NOT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `created_at`, `updated_at`, `quantity`, `size_id`, `product_id`) VALUES
(1, '2019-05-24 23:25:28', '2019-05-29 05:45:52', 26, 1, 6),
(3, '2019-05-25 01:41:46', '2019-05-28 23:08:41', 50, 2, 7),
(9, '2019-05-25 15:28:30', '2019-05-25 15:28:30', 30, 3, 11),
(10, '2019-05-25 16:26:59', '2019-05-29 05:57:10', 50, 1, 7),
(14, '2019-05-26 21:34:52', '2019-05-28 20:17:28', 19, 1, 10),
(15, '2019-05-27 02:51:52', '2019-05-29 05:24:16', 15, 2, 10),
(16, '2019-05-27 02:52:07', '2019-05-27 02:52:07', 37, 3, 10),
(17, '2019-05-28 03:02:09', '2019-05-29 05:50:22', 27, 2, 1),
(20, '2019-05-28 03:49:02', '2019-05-28 03:49:02', 10, 1, 2),
(21, '2019-05-29 05:53:26', '2019-05-29 05:53:26', 20, 2, 11),
(22, '2019-05-29 05:56:43', '2019-05-29 05:56:43', 50, 1, 11),
(23, '2019-05-29 05:57:01', '2019-05-29 05:57:01', 30, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2019-05-24 17:34:16', '2019-05-24 17:34:16', 'small'),
(2, '2019-05-24 17:34:16', '2019-05-24 17:34:16', 'medium'),
(3, '2019-05-24 17:34:16', '2019-05-24 17:34:16', 'large');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2019-05-24 17:34:04', '2019-05-24 17:34:04', 'pending'),
(2, '2019-05-24 17:34:04', '2019-05-24 17:34:04', 'completed'),
(3, '2019-05-24 17:34:05', '2019-05-24 17:34:05', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lara Croft', 'laracroft@gmail.com', NULL, '$2y$10$mayZbyqGRW4y7FRs5B0aF.YaGzrxKG5LhRF2ceuZ5tXRuftVV25AS', 'user', NULL, '2019-05-24 16:18:24', '2019-05-24 16:18:24'),
(2, 'Admin', 'admin@email.com', NULL, '$2y$10$8gfpHYthKslMy8mliZZrX.A3eT0rZ6O5z9p/Ilz3u/2QJJ5Fynd0C', 'admin', NULL, '2019-05-24 16:29:24', '2019-05-24 16:29:24'),
(3, 'Tony Stark', 'tonystark@gmail.com', NULL, '$2y$10$ny0hWLGBr9pWKqVbCfGEoefghkehc84zEjWwZuBkwxaqznLWc1ySi', 'user', NULL, '2019-05-28 15:19:49', '2019-05-28 15:19:49'),
(5, 'Black Widow', 'blackwidow@gmail.com', NULL, '$2y$10$lvRM/d0OeRScPaReBStbEOZSsZvoMp5ZtNZ.xOY67ksuKjd3E7yuS', 'user', NULL, '2019-05-28 15:25:24', '2019-05-28 15:25:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_orders_order_id_foreign` (`order_id`),
  ADD KEY `item_orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_id_foreign` (`status_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_orders`
--
ALTER TABLE `item_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD CONSTRAINT `item_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `item_orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
