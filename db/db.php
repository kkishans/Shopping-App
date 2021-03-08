<?php
    $host="localhost";
    $user = "root";
    $pass="";
    $db_name="shopping";

    $conn = mysqli_connect($host,$user,$pass);

    if (!$conn) {
        echo "<script>alert('Error while creating database.') </script>";
    }
    
    $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
    $res = mysqli_query($conn,$query);

    if(mysqli_num_rows($res) == 0){
      include '../db/database_queries.php';
    }
    else{
      $conn = mysqli_connect($host,$user,$pass,$db_name);
    }
   
?>