-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 09:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory-management-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(3, 'Mobile', '2023-05-20 13:57:29', '2023-05-20 13:57:29'),
(4, 'Laptop', '2023-05-20 13:57:34', '2023-06-17 14:25:13'),
(5, 'Desktop', '2023-05-20 13:58:13', '2023-05-21 11:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Shakil Khan', 'batm9651@gmail.com', '01736928117', 'Court Station', 'backend/img/customer/1687160991.jpeg', '2023-06-19 01:49:52', '2023-06-19 01:49:52'),
(3, 'David Beckham', 'david@gmail.com', '0157272727', 'London', 'backend/img/customer/1687162448.jpeg', '2023-06-19 02:14:08', '2023-06-19 05:08:51'),
(4, 'Asif Hasan', 'asif@gmail.com', '01855616562', 'Dhaka Bangladesh', 'backend/img/customer/1687172242.jpeg', '2023-06-19 04:57:22', '2023-06-19 04:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joining_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `address`, `nid`, `phone`, `salary`, `joining_date`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Tony Stark', 'tony@gmail.com', 'Court Station', '16535664', '0188916115', '20000', '2023-05-18', 'backend/img/employee/1687161363.jpeg', '2023-05-15 15:31:23', '2023-06-19 01:56:03'),
(2, 'Shakil Khan', 'khan.shakil.1414@gmail.com', 'Court Station', '10511654', '01736928117', '25000', '2023-05-02', 'backend/img/employee/1687161254.jpeg', '2023-05-15 15:32:47', '2023-06-19 01:54:14'),
(12, 'Steve Rogers', 'rogers@gmail.com', 'London', '181668651', '018451611664', '3000', '2023-05-31', 'backend/img/employee/1687167470.jpeg', '2023-06-19 03:37:50', '2023-06-19 03:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `details`, `amount`, `date`, `created_at`, `updated_at`) VALUES
(3, 'Electricity Bill', '1500', '2023-06-08', '2023-06-18 03:56:02', '2023-06-18 04:01:17'),
(4, 'Internet Bill', '1000', '2023-06-10', '2023-06-18 03:56:23', '2023-06-18 03:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_05_14_100200_add_employees_table', 2),
(7, '2023_05_20_174513_create_suppliers_table', 3),
(8, '2023_05_20_191338_create_categories_table', 4),
(9, '2023_06_17_175951_create_products_table', 5),
(10, '2023_06_18_085533_create_expenses_table', 6),
(11, '2023_06_18_112631_create_salaries_table', 7),
(12, '2023_06_18_220404_create_customers_table', 8),
(13, '2023_06_19_112209_create_pos_table', 9),
(14, '2023_06_19_205800_create_orders_table', 10),
(15, '2023_06_19_212938_create_order_details_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payby` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `quantity`, `sub_total`, `vat`, `total`, `pay`, `due`, `payby`, `order_date`, `order_month`, `order_year`, `created_at`, `updated_at`) VALUES
(4, 2, '12', '20000', '5', '21000', '5615', '51', 'GiftCard', '19/06/2023', 'June', '2023', '2023-06-19 15:45:04', '2023-06-19 15:45:04'),
(5, 4, '1', '1200', '5', '1260', '424', NULL, 'Cheaque', '19/06/2023', 'June', '2023', '2023-06-19 16:05:39', '2023-06-19 16:05:39'),
(6, 4, '2', '2700', '5', '2835', '4534', '75', 'GiftCard', '19/06/2023', 'June', '2023', '2023-06-19 16:07:29', '2023-06-19 16:07:29'),
(7, 3, '4', '5200', '5', '5460', '5460', '0', 'HandCash', '19/06/2023', 'June', '2023', '2023-06-19 16:09:10', '2023-06-19 16:09:10'),
(8, 3, '2', '2800', '5', '2940', '555', '50', 'HandCash', '19/06/2023', 'June', '2023', '2023-06-19 16:16:25', '2023-06-19 16:16:25'),
(9, 3, '2', '2800', '5', '2940', '555', '50', 'HandCash', '19/06/2023', 'June', '2023', '2023-06-19 16:16:44', '2023-06-19 16:16:44'),
(10, 4, '2', '2800', '5', '2940', '454', '15', 'Cheaque', '19/06/2023', 'June', '2023', '2023-06-19 16:19:43', '2023-06-19 16:19:43'),
(11, 4, '3', '4200', '5', '4410', '4400', '10', 'Cheaque', '20/06/2023', 'June', '2023', '2023-06-20 03:16:25', '2023-06-20 03:16:25'),
(12, 3, '1', '1200', '5', '1260', '242', NULL, 'GiftCard', '20/06/2023', 'June', '2023', '2023-06-20 03:31:08', '2023-06-20 03:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_quantity`, `product_price`, `sub_total`, `created_at`, `updated_at`) VALUES
(4, 4, 5, '4', '1200', '4800', '2023-06-19 15:45:04', '2023-06-19 15:45:04'),
(5, 4, 14, '3', '900', '2700', '2023-06-19 15:45:04', '2023-06-19 15:45:04'),
(6, 4, 6, '5', '2500', '12500', '2023-06-19 15:45:04', '2023-06-19 15:45:04'),
(7, 5, 5, '1', '1200', '1200', '2023-06-19 16:05:39', '2023-06-19 16:05:39'),
(8, 6, 5, '1', '1200', '1200', '2023-06-19 16:07:29', '2023-06-19 16:07:29'),
(9, 6, 7, '1', '1500', '1500', '2023-06-19 16:07:29', '2023-06-19 16:07:29'),
(10, 7, 11, '1', '1400', '1400', '2023-06-19 16:09:10', '2023-06-19 16:09:10'),
(11, 7, 10, '2', '1000', '2000', '2023-06-19 16:09:10', '2023-06-19 16:09:10'),
(12, 7, 9, '1', '1800', '1800', '2023-06-19 16:09:10', '2023-06-19 16:09:10'),
(13, 8, 11, '2', '1400', '2800', '2023-06-19 16:16:25', '2023-06-19 16:16:25'),
(14, 9, 11, '2', '1400', '2800', '2023-06-19 16:16:44', '2023-06-19 16:16:44'),
(15, 10, 11, '2', '1400', '2800', '2023-06-19 16:19:43', '2023-06-19 16:19:43'),
(16, 11, 11, '3', '1400', '4200', '2023-06-20 03:16:25', '2023-06-20 03:16:25'),
(17, 12, 5, '1', '1200', '1200', '2023-06-20 03:31:08', '2023-06-20 03:31:08');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `sub_total`, `created_at`, `updated_at`) VALUES
(6, 8, 'iPhone 13', '2', '1300', '2600', '2023-06-20 09:59:47', '2023-06-20 09:59:50'),
(7, 5, 'Dell XPS 13', '1', '1200', '1200', '2023-06-20 09:59:49', '2023-06-20 09:59:49'),
(8, 6, 'MacBook Pro 16', '3', '2500', '7500', '2023-06-20 09:59:52', '2023-06-20 11:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `root` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `buying_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_code`, `root`, `buying_price`, `selling_price`, `category_id`, `supplier_id`, `buying_date`, `image`, `product_quantity`, `created_at`, `updated_at`) VALUES
(5, 'Dell XPS 13', 'LP001', 'B', '800', '1200', 4, 3, '2023-02-14', 'backend/img/product/1687166579.webp', '46', '2023-06-19 03:23:00', '2023-06-20 03:31:08'),
(6, 'MacBook Pro 16', 'LP002', 'B', '2000', '2500', 4, 5, '2023-06-09', 'backend/img/product/1687167339.jpeg', '32', '2023-06-19 03:24:06', '2023-06-19 15:46:50'),
(7, 'HP Pavilion', 'DT001', 'A', '1000', '1500', 5, 5, '2023-03-30', 'backend/img/product/1687166716.jpeg', '42', '2023-06-19 03:25:17', '2023-06-19 16:07:29'),
(8, 'iPhone 13', 'MB001', 'C', '1000', '1300', 3, 3, '2023-05-18', 'backend/img/product/1687166763.jpeg', '28', '2023-06-19 03:26:03', '2023-06-19 15:47:02'),
(9, 'Lenovo ThinkPad', 'LP003', 'B', '1200', '1800', 4, 5, '2022-12-14', 'backend/img/product/1687166838.webp', '45', '2023-06-19 03:27:18', '2023-06-19 16:09:10'),
(10, 'Samsung Galaxy S', 'MB002', 'C', '800', '1000', 3, 3, '2023-04-12', 'backend/img/product/1687166890.webp', '67', '2023-06-19 03:28:10', '2023-06-19 16:09:10'),
(11, 'ASUS ZenBook', 'LP004', 'B', '900', '1400', 4, 6, '2023-04-12', 'backend/img/product/1687166934.jpeg', '65', '2023-06-19 03:28:54', '2023-06-20 03:16:25'),
(12, 'Dell Inspiron', 'DT002', 'B', '800', '1200', 5, 5, '2023-04-20', 'backend/img/product/1687166982.webp', '29', '2023-06-19 03:29:43', '2023-06-19 15:47:28'),
(13, 'Google Pixel', 'MB003', 'C', '700', '1000', 3, 6, '2023-03-09', 'backend/img/product/1687167026.png', '39', '2023-06-19 03:30:26', '2023-06-19 15:47:34'),
(14, 'Acer Swift', 'LP005', 'B', '600', '900', 4, 5, '2023-04-27', 'backend/img/product/1687167149.jpeg', '33', '2023-06-19 03:32:29', '2023-06-19 15:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `amount`, `salary_date`, `salary_month`, `salary_year`, `created_at`, `updated_at`) VALUES
(1, 2, '2500', '18/06/2023', 'February', '2023', '2023-06-18 05:55:05', '2023-06-18 13:43:32'),
(2, 1, '20000', '18/06/2023', 'August', '2023', '2023-06-18 05:56:25', '2023-06-18 05:56:25'),
(3, 1, '20000', '18/06/2023', 'January', '2023', '2023-06-18 06:31:24', '2023-06-18 06:31:24'),
(4, 2, '25000', '18/06/2023', 'January', '2023', '2023-06-18 06:34:22', '2023-06-18 06:34:22'),
(5, 2, '25000', '18/06/2023', 'December', '2023', '2023-06-18 12:28:38', '2023-06-18 12:28:38'),
(6, 2, '25000', '18/06/2023', 'November', '2023', '2023-06-18 12:28:52', '2023-06-18 12:28:52'),
(8, 2, '2500', '18/06/2023', 'July', '2023', '2023-06-18 13:05:41', '2023-06-18 13:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `address`, `phone`, `shop_name`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Alexa', 'alexa@gmail.com', 'Basundhara R/A', '0156185616', 'Alexa\'s Shop', 'backend/img/supplier/1687162343.jpeg', '2023-05-20 12:33:01', '2023-06-19 02:12:23'),
(5, 'Robert', 'robert@gmail.com', 'New York', '01896572531', 'Robert\'s Shop', 'backend/img/supplier/1687162382.jpeg', '2023-06-17 13:16:49', '2023-06-19 02:13:02'),
(6, 'Bucky Burns', 'bucky@gmail.com', 'Paris', '018494665', 'Bucky\'s Shop', 'backend/img/supplier/1687167528.jpeg', '2023-06-19 03:38:48', '2023-06-19 03:38:48');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shakil Khan', 'khan.shakil.1414@gmail.com', NULL, '$2y$12$JQnOLosNvFG1Tfoj3rXS9.u805/xHhtfEJD.90QDeOjakAQN3Bl0y', NULL, '2023-04-24 15:15:02', '2023-04-24 15:15:02'),
(3, 'Bat Man', 'batm9651@gmail.com', NULL, '$2y$10$PvawNU6yi9L1ru5WMWTy7uHPPRrBWIskE9d55B3tvoBjDLmJal8uS', NULL, '2023-04-29 13:38:26', '2023-04-29 13:38:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
