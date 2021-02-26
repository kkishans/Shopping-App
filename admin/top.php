<?php
 include '../env.php';
 include '../db/db.php';
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">   
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <title><?= $app_name ?> | Admin</title>
   <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-4 p-1" href="./home.php">Admin</a>

        <?php
            if (isset($_SESSION['aname'])) {
        ?>

        <ul class="nav text-light  justify-content-end">
            <li class="nav-item p-1 ">
                <a class="nav-link link-light " href="./product.php">Add Product</a>
            </li>
            <li class="nav-item p-1 ">
                <a class="nav-link  link-light" href="../category.php" target="_blank">Categories</a>
            </li>
            <li class="nav-item p-1 ">
                <a class="nav-link  link-light" href="./brand.php">Brands</a>
            </li>
            <li class="nav-item p-1 ">
                <a class="nav-link  link-light" href="./brand.php">Orders</a>
            </li>
            <li class="nav-item p-1 ">
                  <a class="btn btn-outline-info"  href="../index.php" target="_blank">View Site</a>
            </li>
            <li class="nav-item p-1 ">
                <a class="btn btn-outline-danger" name="logout" href="logout.php">Logout</a>
            </li>
        </ul>

        <?php
            }else{
        ?>

        <ul class="nav text-light  justify-content-end">
            <li class="nav-item">
                <a class="btn btn-outline-info" href="../">View Site</a>
            </li> 
        </ul>
        <?php
            }
        ?>  
    </div>
</nav>