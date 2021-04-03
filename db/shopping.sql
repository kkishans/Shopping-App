-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2021 at 09:07 AM
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
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `aid` int(10) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_photo` varchar(255) NOT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `insta_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`aid`, `fname`, `lname`, `email`, `password`, `admin_photo`, `facebook_link`, `insta_link`, `twitter_link`, `youtube_link`) VALUES
(1, 'Nikunj', 'Thakor', 'thakornikunj152@gmail.com', '4de518f35a2a288388de929d56fe7852', 'user-dummy-pic.png', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `b_id` int(10) NOT NULL,
  `b_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`b_id`, `b_name`) VALUES
(1, 'Generic'),
(2, 'Lenovo'),
(3, 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `is_in_cart` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `p_id`, `u_id`, `qty`, `is_in_cart`) VALUES
(1, 1, 1, 5, 'n'),
(2, 1, 1, 4, 'n'),
(6, 1, 2, 3, 'n'),
(7, 1, 6, 1, 'n'),
(8, 1, 6, 1, 'y'),
(10, 1, 10, 2, 'n'),
(11, 2, 1, 2, 'n'),
(12, 1, 1, 1, 'n'),
(13, 2, 1, 3, 'n'),
(14, 2, 1, 2, 'n'),
(15, 1, 1, 1, 'n'),
(16, 2, 1, 1, 'n'),
(17, 2, 2, 2, 'n'),
(18, 2, 2, 3, 'n'),
(19, 2, 2, 1, 'n'),
(20, 1, 2, 2, 'n'),
(21, 2, 2, 3, 'n'),
(22, 2, 2, 4, 'n'),
(23, 2, 2, 1, 'n'),
(24, 2, 1, 1, 'n'),
(25, 2, 2, 1, 'n'),
(26, 2, 1, 2, 'n'),
(27, 2, 2, 3, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(10) NOT NULL,
  `c_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_title`) VALUES
(1, 'none'),
(2, 'Laptop'),
(3, 'Desktop');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(11) NOT NULL,
  `o_id` int(8) NOT NULL,
  `p_id` int(8) NOT NULL,
  `qty` int(10) NOT NULL,
  `status` text NOT NULL DEFAULT 'Not Delivered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `o_id`, `p_id`, `qty`, `status`) VALUES
(9, 7, 2, 2, 'Not Delivered'),
(10, 8, 1, 1, 'Not Delivered'),
(11, 8, 2, 1, 'Not Delivered'),
(12, 9, 1, 3, 'Not Delivered'),
(13, 12, 2, 1, 'Not Delivered'),
(14, 13, 1, 2, 'Not Delivered'),
(15, 13, 2, 3, 'Not Delivered'),
(16, 14, 2, 2, 'Not Delivered'),
(17, 15, 2, 1, 'Not Delivered'),
(18, 16, 2, 0, 'Not Delivered'),
(19, 17, 2, 1, 'Not Delivered'),
(20, 18, 2, 0, 'Not Delivered'),
(21, 19, 2, 0, 'Not Delivered'),
(22, 20, 2, 0, 'Not Delivered'),
(23, 21, 2, 0, 'Not Delivered'),
(24, 21, 2, 0, 'Not Delivered'),
(25, 21, 2, 0, 'Not Delivered'),
(26, 21, 2, 1, 'Not Delivered'),
(27, 22, 2, 2, 'Not Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `o_id` int(8) NOT NULL,
  `u_id` int(8) NOT NULL,
  `total_amount` double NOT NULL,
  `shipping_address` varchar(300) NOT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`o_id`, `u_id`, `total_amount`, `shipping_address`, `ordered_at`) VALUES
(1, 1, 36000, '2306\r\nGhikudiya', '2021-04-02 13:14:55'),
(2, 1, 24000, '2306\r\nGhikudiya', '2021-04-02 13:16:00'),
(3, 6, 12000, 'bharuch', '2021-04-02 15:36:54'),
(4, 10, 24000, 'bharuch', '2021-04-02 17:11:04'),
(5, 1, 46000, '2306\r\nGhikudiya', '2021-04-03 03:58:47'),
(6, 1, 68000, '2306\r\nGhikudiya', '2021-04-03 04:27:41'),
(7, 1, 68000, '2306\r\nGhikudiya', '2021-04-03 04:39:07'),
(8, 1, 46000, '2306\r\nGhikudiya', '2021-04-03 04:40:06'),
(9, 2, 36000, 'bharuch', '2021-04-03 04:43:26'),
(10, 2, 68000, 'bharuch', '2021-04-03 04:52:35'),
(11, 2, 102000, 'bharuch', '2021-04-03 04:53:01'),
(12, 2, 34000, 'bharuch', '2021-04-03 04:54:44'),
(13, 2, 126000, 'bharuch', '2021-04-03 04:57:51'),
(14, 2, 136000, 'bharuch', '2021-04-03 05:14:27'),
(15, 1, 34000, '2306\r\nGhikudiya', '2021-04-03 05:18:54'),
(16, 2, 34000, 'bharuch', '2021-04-03 05:19:15'),
(17, 2, 34000, 'bharuch', '2021-04-03 05:22:40'),
(18, 1, 34000, '2306\r\nGhikudiya', '2021-04-03 05:23:08'),
(19, 1, 34000, '2306\r\nGhikudiya', '2021-04-03 05:23:31'),
(20, 1, 34000, '2306\r\nGhikudiya', '2021-04-03 05:23:40'),
(21, 1, 68000, '2306\r\nGhikudiya', '2021-04-03 05:28:21'),
(22, 2, 102000, 'bharuch', '2021-04-03 06:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_description`
--

CREATE TABLE `product_description` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `spec_key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_description`
--

INSERT INTO `product_description` (`id`, `p_id`, `spec_key`, `value`) VALUES
(1, 1, 'RAM', '8gb ddr4'),
(2, 2, 'display', 'FHD amoled');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `p_id` int(10) NOT NULL,
  `p_name` text NOT NULL,
  `description` text NOT NULL,
  `p_img` text NOT NULL,
  `price` double NOT NULL,
  `stock` int(30) NOT NULL,
  `c_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `keywords` varchar(10000) NOT NULL,
  `product_optional_image_1` varchar(255) DEFAULT NULL,
  `product_optional_image_2` varchar(255) DEFAULT NULL,
  `product_optional_image_3` varchar(255) DEFAULT NULL,
  `product_optional_image_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`p_id`, `p_name`, `description`, `p_img`, `price`, `stock`, `c_id`, `b_id`, `keywords`, `product_optional_image_1`, `product_optional_image_2`, `product_optional_image_3`, `product_optional_image_4`) VALUES
(1, 'Lenovo ideapad 3', 'Performence Beast', 'carousal-img-1.jpg', 12000, 4, 2, 2, 'slim, Lenovo, ideapad, 3, Lenovo, ideapad, 3', '', '', '', ''),
(2, 'Apple desktop', 'HDR', 'maxresdefault.jpg', 34000, 0, 3, 3, 'slim, Apple, desktop, Apple, desktop, Apple, desktop, Apple, desktop, Apple, desktop, Apple, desktop, Apple, desktop, Apple, desktop', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(10) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `f_name`, `l_name`, `email`, `phone`, `address`, `pass`) VALUES
(1, 'Nikunj', 'Thakor', 'thakornikunj152@gmail.com', '8980112582', '2306\r\nGhikudiya', '4de518f35a2a288388de929d56fe7852'),
(2, 'Test', 'test', 'test@mail.com', '9876543210', 'bharuch', '662af1cd1976f09a9f8cecc868ccc0a2'),
(6, 'test1', 'test1', 'test1@mail.com', '9876543210', 'bharuch', '662af1cd1976f09a9f8cecc868ccc0a2'),
(10, 'kishan', 'khant', 'kishan@mail.com', '7894561230', 'bharuch', '22d502e00e17f11e9ed4322ceb9099af');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `o_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_description`
--
ALTER TABLE `product_description`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`);

--
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `product_description`
--
ALTER TABLE `product_description`
  ADD CONSTRAINT `product_description_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `brands` (`b_id`),
  ADD CONSTRAINT `product_details_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `category` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
