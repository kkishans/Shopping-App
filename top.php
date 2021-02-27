<?php
  include 'env.php';
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title><?= $app_name ?></title>
  </head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid d-flex align-items-center">
       <div>
          <img src="./favicon.png" style="object-fit: contain;height: 50px;width: 50px;">
          <a class="navbar-brand fs-3 pt-2" href="./index.php"><?= $app_name ?></a>
       </div>
        <div>
          <ul class="nav text-light  justify-content-end">
              <li class="nav-item">
                  <a class="nav-link link-light " href="./index.php">All Products</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link  link-light" href="#">Services</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link  link-light" href="#">About Us</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link  link-light" href="contactus.php">Contact Us</a>
              </li>
              <?php 
                  if (isset($_SESSION['useremail'] )) {
              ?>
              <li class="nav-item p-1 ">
                  <a class="" name="cart" href="./user/cart.php"><i class="fa fa-shopping-cart nav-link" style="color:white;font-size:20px" aria-hidden="true"></i></a>
              </li>
              <li class="nav-item p-1 ">
                  <a class="btn btn-outline-danger" name="logout" href="./user/logout.php">Logout</a>
              </li>
              <?php 
                  }else{
              ?>
                <li class="nav-item p-1 ">
                  <a class="btn btn-outline-info"  href="./user/userLogin.php" >Log in</a>
                </li>
              <?php  } ?>
          </ul>
        </div>
    </div>
  </nav>