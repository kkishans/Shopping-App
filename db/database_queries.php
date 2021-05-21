<?php
    $host="localhost";
    $user = "root";
    $pass="";
    $db_name="shopping";

    $conn = mysqli_connect($host,$user,$pass);

    if (!$conn) {
        echo "<script>alert('Error while creating database.') </script>";
    }
    
   
    $create_database = "CREATE DATABASE IF NOT EXISTS  $db_name ";  
    $res = mysqli_query($conn,$create_database);
    if ($res) {
        $conn = mysqli_connect($host,$user,$pass,$db_name);
        
    }

    $create_admin_details = "CREATE TABLE IF NOT EXISTS `admin_details` (
        `aid` int(10) primary key AUTO_INCREMENT,
        `fname` varchar(255) NOT NULL,
        `lname` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `admin_photo` varchar(255) NOT NULL,
        `wa_no` varchar(20) not null,
        `facebook_link` varchar(255),
        `insta_link` varchar(255),
        `twitter_link` varchar(255),
        `youtube_link` varchar(255) 
      )";
    $res = mysqli_query($conn,$create_admin_details);

    $create_users = "CREATE TABLE IF NOT EXISTS `users` (
      `u_id` int(10)  primary key  AUTO_INCREMENT,
      `f_name` text NOT NULL,
      `l_name` text NOT NULL,
      `email` text NOT NULL,
      `phone` text NOT NULL,
      `address` text NOT NULL,
      `pass` text NOT NULL
    )";

    $res = mysqli_query($conn,$create_users);

    $create_brands = "CREATE TABLE IF NOT EXISTS `brands` (
        `b_id` int(10) primary key AUTO_INCREMENT,
        `b_name` text NOT NULL,
        `b_icon` text NOT NULL
      )";
    $res = mysqli_query($conn,$create_brands);


    $create_category = "CREATE TABLE IF NOT EXISTS `category` (
        `c_id` int(10) primary key AUTO_INCREMENT,
        `c_title` text NOT NULL
      )";
    $res = mysqli_query($conn,$create_category);

    
    $create_order_details = "CREATE TABLE IF NOT EXISTS `order_details` (
        `o_id` varchar(255) primary key AUTO_INCREMENT ,
        `u_id` int(8) NOT NULL,
        `total_amount` double NOT NULL,
        `shipping_address` varchar(300) NOT NULL,
        `ordered_at` timestamp NOT NULL DEFAULT current_timestamp(),
        FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`)
      )";
    $res = mysqli_query($conn,$create_order_details);

    
   
    $craete_product_details = "CREATE TABLE IF NOT EXISTS `product_details` (
        `p_id` int(10) primary key AUTO_INCREMENT,
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
        `product_optional_image_4` varchar(255) DEFAULT NULL,
        FOREIGN KEY (`b_id`) REFERENCES `brands` (`b_id`),
        FOREIGN KEY (`c_id`) REFERENCES `category` (`c_id`)
      )";

    $res = mysqli_query($conn,$craete_product_details);

    $create_ordered_product = "CREATE TABLE IF NOT EXISTS `ordered_products` (
      `id` int(11) primary key AUTO_INCREMENT,
      `o_id` varchar(255) NOT NULL,
      `p_id` int(8) NOT NULL,
      `qty` int(8) NOT NULL,  
      `status` text NOT NULL DEFAULT 'Not Delivered',
     FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`)
    )";

    $res = mysqli_query($conn,$create_ordered_product);
    
    $create_cart_deatils = "CREATE TABLE IF NOT EXISTS `cart_details` (
      `id` int(10) primary key AUTO_INCREMENT,
      `p_id` int(10) NOT NULL,
      `u_id` int(10) NOT NULL,
      `qty` int(10) NOT NULL,
      `is_in_cart` varchar(15) NOT NULL,
      FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
      FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`)
    )";
    $res = mysqli_query($conn,$create_cart_deatils);

    $create_contact_us = "CREATE TABLE `contact_us` (
      `contact_id` int(10) PRIMARY KEY  AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `message` varchar(255) NOT NULL
    )";

    $res = mysqli_query($conn,$create_contact_us);

    $product_details = "CREATE TABLE `product_description` (
      `id` int(10) PRIMARY KEY  AUTO_INCREMENT,
      `p_id` int(10) NOT NULL,
      `spec_key` varchar(255) NOT NULL,
      `value` varchar(255) NOT NULL,
      FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`) ON DELETE CASCADE
    )";

    $res = mysqli_query($conn,$product_details);

    $create_gallery_categories = "CREATE TABLE `gallery_categories` (
      `id` int(11) PRIMARY KEY AUTO_INCREMENT,
      `title` varchar(255) NOT NULL
    )";

    $res = mysqli_query($conn,$create_gallery_categories);
    

    $create_gallery = "CREATE TABLE `gallery` (
      `id` int(11) PRIMARY KEY AUTO_INCREMENT,
      `caption` varchar(255) NOT NULL,
      `image` varchar(255) NOT NULL,
      `desc` varchar(1000) not null,
      `category_id` int(11) NOT NULL,
      FOREIGN KEY (`category_id`) REFERENCES `gallery_categories`(`id`) ON DELETE CASCADE
    )";

    $res = mysqli_query($conn,$create_gallery);

    $create_csr_categories = "CREATE TABLE `csr_categories` (
      `id` int(11) PRIMARY KEY AUTO_INCREMENT,
      `title` varchar(255) NOT NULL
    )";

    $res = mysqli_query($conn,$create_csr_categories);
    

    $create_csr = "CREATE TABLE `csr` (
      `id` int(11) PRIMARY KEY AUTO_INCREMENT,
      `caption` varchar(255) NOT NULL,
      `image` varchar(255) NOT NULL,
      `desc` varchar(1000) not null,
      `category_id` int(11) NOT NULL,
      FOREIGN KEY (`category_id`) REFERENCES `csr_categories`(`id`) ON DELETE CASCADE
    )";

    $res = mysqli_query($conn,$create_csr);
    
    $create_upcoming_products = "CREATE TABLE `upcoming_products` (
      `id` int(10) primary key AUTO_INCREMENT,
      `title` varchar(255) NOT NULL,
      `desc` varchar(1000) NOT NULL,
      `image` varchar(255) NOT NULL
    )";

    $res = mysqli_query($conn,$create_upcoming_products);

    
    if(!$conn){
        echo "<script>alert('Error while connecting to database.')</script>";
        return;
    }

    $query = "SELECT 
      (SELECT count(*) from category) as c,
      (SELECT count(*) from brands) as b";
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);

    if ($r['c'] == 0 && $r['b'] == 0) {
      $query = "INSERT into category(c_title) values('none')";
      $res = mysqli_query($conn,$query);
      $query = "INSERT into brands(b_name) values('Generic')";
      $res = mysqli_query($conn,$query);

    }

    

?>