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
        `aid` int(10) primary key,
        `fname` varchar(255) NOT NULL,
        `lname` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL
      )";
    $res = mysqli_query($conn,$create_admin_details);

    $create_brands = "CREATE TABLE IF NOT EXISTS `brands` (
        `b_id` int(10) primary key,
        `b_name` text NOT NULL
      )";
    $res = mysqli_query($conn,$create_brands);

    $create_cart_deatils = "CREATE TABLE IF NOT EXISTS `cart_details` (
        `id` int(10) primary key,
        `p_id` int(10) NOT NULL,
        `u_id` int(10) NOT NULL,
        `qty` int(10) NOT NULL,
        `is_in_cart` varchar(15) NOT NULL
      )";
    $res = mysqli_query($conn,$create_cart_deatils);

    $create_category = "CREATE TABLE IF NOT EXISTS `category` (
        `c_id` int(10) primary key,
        `c_title` text NOT NULL
      )";
    $res = mysqli_query($conn,$create_category);

    $create_ordered_product = "CREATE TABLE IF NOT EXISTS `ordered_products` (
        `id` int(11) primary key,
        `o_id` int(8) NOT NULL,
        `p_id` int(8) NOT NULL,
        `status` text NOT NULL DEFAULT 'Not Delivered'
      )";
    $res = mysqli_query($conn,$create_ordered_product);
    
    $create_order_details = "CREATE TABLE IF NOT EXISTS `order_details` (
        `o_id` int(8) primary key,
        `u_id` int(8) NOT NULL,
        `total_amount` double NOT NULL,
        `shipping_address` varchar(300) NOT NULL,
        `ordered_at` timestamp NOT NULL DEFAULT current_timestamp()
      )";
    $res = mysqli_query($conn,$create_order_details);
    
    $craete_product_details = "CREATE TABLE IF NOT EXISTS `product_details` (
        `p_id` int(10) primary key,
        `p_name` text NOT NULL,
        `description` text NOT NULL,
        `p_img` text NOT NULL,
        `price` double NOT NULL,
        `stock` int(30) NOT NULL,
        `c_id` int(11) NOT NULL,
        `b_id` int(11) NOT NULL
      )";

    $res = mysqli_query($conn,$craete_product_details);

    $create_users = "CREATE TABLE IF NOT EXISTS `users` (
        `u_id` int(10)  primary key,
        `f_name` text NOT NULL,
        `l_name` text NOT NULL,
        `email` text NOT NULL,
        `phone` text NOT NULL,
        `address` text NOT NULL,
        `pass` text NOT NULL
      )";

    

    $res = mysqli_query($conn,$create_users);

    $create_contact_us = "CREATE TABLE `contact_us` (
      `contact_id` int(10) PRIMARY KEY,
      `name` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `message` varchar(255) NOT NULL
    )";

    $res = mysqli_query($conn,$create_contact_us);

    //Relationship between tables

    $alter = "ALTER TABLE `admin_details`
    MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;";
    $res = mysqli_query($conn,$alter);
    $alter = "ALTER TABLE `brands`
        MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;";
    
        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `cart_details`
        MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;";
    
        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `category`
        MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
    
        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `ordered_products`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;";
    
        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `order_details`
        MODIFY `o_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;";
    
        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `product_details`
        MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;";
    
        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `users`
        MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;";
        $res = mysqli_query($conn,$alter);


        $alter ="ALTER TABLE `contact_us`
        MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
        $res = mysqli_query($conn,$alter);
        
        
        $alter = "ALTER TABLE `product_details`
        ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `brands` (`b_id`),
        ADD CONSTRAINT `product_details_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `category` (`c_id`);";

        $res = mysqli_query($conn,$alter);

        $alter = "ALTER TABLE `product_details`
        ADD  `product_optional_image_1` varchar(255) DEFAULT NULL, ADD  `product_optional_image_2` varchar(255) DEFAULT NULL,  ADD  `product_optional_image_3` varchar(255) DEFAULT NULL, ADD  `product_optional_image_4` varchar(255) DEFAULT NULL";

        $res = mysqli_query($conn,$alter);

        $alter = "ALTER TABLE `cart_details`
        ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
        ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`);";

        $res = mysqli_query($conn,$alter);

        $alter = "ALTER TABLE `ordered_products`
          ADD CONSTRAINT `ordered_products_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`);";

        $res = mysqli_query($conn,$alter);
        $alter = "ALTER TABLE `order_details`
          ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);";
        $res = mysqli_query($conn,$alter);


    if(!$conn){
        echo "<script>alert('Error while connecting to database.')</script>";
        return;
    }


    
    


?>