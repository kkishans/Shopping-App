-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 08:03 AM
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
  `wa_no` varchar(15) NOT NULL,
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

INSERT INTO `admin_details` (`aid`, `fname`, `lname`, `email`, `wa_no`, `password`, `admin_photo`, `facebook_link`, `insta_link`, `twitter_link`, `youtube_link`) VALUES
(2, 'Pooja', 'Electricals', 'poojaelectricals462@gmail.com', '7041555399', 'a6346bcbfe7a5bf487243dba7705c16b', 'user-dummy-pic.png', '', 'https://instagram.com/ayusshrivastav', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `b_id` int(10) NOT NULL,
  `b_name` text NOT NULL,
  `b_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`b_id`, `b_name`, `b_icon`) VALUES
(1, 'Generic', ''),
(2, 'RR Cables', 'rr-cable.png'),
(3, 'HAVELLS', '1200px-Havells_Logo.png'),
(4, 'UNICAB (APAR)', 'unicab_logo.png');

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
(2, 'Wires & Cables'),
(3, 'Motors');

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
-- Table structure for table `csr`
--

CREATE TABLE `csr` (
  `id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csr`
--

INSERT INTO `csr` (`id`, `caption`, `image`, `desc`, `category_id`) VALUES
(2, 'Pooja Electricals', 'Apple_logo.png', 'We provide enlightening services!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `csr_categories`
--

CREATE TABLE `csr_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csr_categories`
--

INSERT INTO `csr_categories` (`id`, `title`) VALUES
(1, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `caption`, `image`, `desc`, `category_id`) VALUES
(5, 'Pooja Electricals', '6074494521e779.25449001.png', 'Pooja Electricals', 1),
(7, 'Pooja ', '6074494521e779.25449001.png', 'Pooja', 4),
(8, 'Raj Electricals', 'wire.jpg', 'hello', 4);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `title`) VALUES
(1, 'Warehouse'),
(4, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(11) NOT NULL,
  `o_id` varchar(255) NOT NULL,
  `p_id` int(8) NOT NULL,
  `qty` int(8) NOT NULL,
  `status` text NOT NULL DEFAULT 'Not Delivered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `o_id` varchar(255) NOT NULL,
  `u_id` int(8) NOT NULL,
  `total_amount` double NOT NULL,
  `shipping_address` varchar(300) NOT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, 'Colors', 'red,yellow'),
(2, 1, 'Size', '0.75,1'),
(3, 4, 'input', '220w'),
(4, 3, 'Colors', 'red,yellow'),
(5, 2, 'Size', '0.75,1');

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
(1, 'SUPEREX FR', 'thin', 'istockphoto-144349803-612x612.jpg', 1200, 120, 2, 2, 'SUPEREX FR, SUPEREX, FR', '', '', '', ''),
(2, 'HT POWER CABLES', 'thin', 'istockphoto-1095876376-612x612.jpg', 1200, 120, 2, 3, 'SUPEREX FR, SUPEREX, FR', '', '', '', ''),
(3, 'SUPEREX', 'thin', 'istockphoto-144349803-612x612.jpg', 1200, 120, 2, 4, 'SUPEREX FR, SUPEREX, FR', '', '', '', ''),
(4, 'INVERTER DUTY MOTORS', 'test', 'ac-electric-motor-500x500.jpg', 2500, 10, 3, 3, 'motor, INVERTER, DUTY, MOTORS', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_products`
--

CREATE TABLE `upcoming_products` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upcoming_products`
--

INSERT INTO `upcoming_products` (`id`, `title`, `desc`, `image`) VALUES
(2, 'Wire-1', 'Long lasting wire', 'wire.jpg'),
(3, 'Motor', 'We provide enlightening services!', 'ac-electric-motor-500x500.jpg');

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
-- Indexes for table `csr`
--
ALTER TABLE `csr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `csr_categories`
--
ALTER TABLE `csr_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `upcoming_products`
--
ALTER TABLE `upcoming_products`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `csr`
--
ALTER TABLE `csr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `csr_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_description`
--
ALTER TABLE `product_description`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upcoming_products`
--
ALTER TABLE `upcoming_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `csr`
--
ALTER TABLE `csr`
  ADD CONSTRAINT `csr_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `csr_categories` (`id`) ON DELETE CASCADE;

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
