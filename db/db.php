<?php
    $host="localhost";
    $user = "root";
    $pass="";
    $db_name="shopping";

    $conn = mysqli_connect($host,$user,$pass,$db_name);

    if(!$conn){
        echo "<script>alert('Eroor while connecting to databse.')</script>";
        return;
    }
?>