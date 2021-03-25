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
        `admin_photo` varchar(255) NOT NULL
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
        `b_name` text NOT NULL
      )";
    $res = mysqli_query($conn,$create_brands);


    $create_category = "CREATE TABLE IF NOT EXISTS `category` (
        `c_id` int(10) primary key AUTO_INCREMENT,
        `c_title` text NOT NULL
      )";
    $res = mysqli_query($conn,$create_category);

    
    $create_order_details = "CREATE TABLE IF NOT EXISTS `order_details` (
        `o_id` int(8) primary key AUTO_INCREMENT,
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
      `o_id` int(8) NOT NULL,
      `p_id` int(8) NOT NULL,
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