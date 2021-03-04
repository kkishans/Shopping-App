<?php
    $host="localhost";
    $user = "root";
    $pass="";
    $db_name="shopping";

    // $conn = mysqli_connect($host,$user,$pass);

    // if (!mysqli_query($conn,$create_database)) {
    //     echo "<script>alert('Error while creating databse.') ". mysqli_error($conn)."</script>";
    // }
   
    // $create_database = "CREATE DATABASE IF NOT EXISTS  $db_name ";
   
    // echo mysqli_error($conn);
    $conn = mysqli_connect($host,$user,$pass,$db_name);
    
    if(!$conn){
        echo "<script>alert('Error while connecting to databse.')</script>";
        return;
    }
?>