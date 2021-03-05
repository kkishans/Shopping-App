<?php
    $host="localhost";
    $user = "root";
    $pass="";
    $db_name="shopping";

    $conn = mysqli_connect($host,$user,$pass);

    if (!$conn) {
        echo "<script>alert('Error while creating databse.') </script>";
    }
   
    $create_database = "CREATE DATABASE IF NOT EXISTS  $db_name ";  
    $conn = mysqli_connect($host,$user,$pass,$db_name);
    
    if(!$conn){
        echo "<script>alert('Error while connecting to databse.')</script>";
        return;
    }
?>