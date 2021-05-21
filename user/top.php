<?php
include '../env.php';
include '../db/db.php';
session_start();

if (isset($_SESSION['useremail'])) {
  $query = "SELECT qty FROM cart_details as C, users as U where C.u_id = U.u_id and email = '" . $_SESSION['useremail'] . "' and is_in_cart = 'y'";
  $result = mysqli_query($conn, $query);
  $total_cart_items = 0;
  while ($row = mysqli_fetch_array($result)) {
    $total_cart_items += $row[0];
  }
  echo mysqli_error($conn);
} else if (isset($_SESSION["cart"])) {
  $total_cart_items = 0;
  foreach ($_SESSION['cart'] as $k => $v) {
    $total_cart_items += $_SESSION['cart'][$k]['qty'];
  }
} else {
  $total_cart_items = 0;
}

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
  <script src="https://kit.fontawesome.com/43b88d4182.js" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <title><?= $app_name ?></title>
  <meta name="description" content="We provide enlightening services.">
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid row justify-content-end  text-white text-end">
      <div class="col-md-2"><i class="fas fa-phone-alt px-2"></i>+91 7228010920</div>
      <div class="col-md-3"><i class="fas fa-envelope px-1"></i> <a class="text-decoration-none text-white" href="mailto:poojaelectricals462@gmail.com">poojaelectricals462@gmail.com</a> </div>
    </div>
    <div class="container-fluid d-flex align-items-center">
      <div>
        <img src="./favicon.png" style="object-fit: contain;height: 50px;width: 50px;">
        <a class="navbar-brand fs-3 pt-2" href="../index.php"><?= $app_name ?></a>
      </div>
      <div>
        <ul class="nav text-light  justify-content-end">
          <li class="nav-item">
            <a class="nav-link link-light " href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-light " href="../product_list.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-light " href="../gallery.php">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-light " href="../CSR.php">CSR</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  link-light" href="../aboutUs.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  link-light" href="../contactus.php">Contact Us</a>
          </li>
          <li class="nav-item l">
            <a class="nav-link link-light" style="color:red" href="../upcoming_product_list.php">Upcoming</a>
          </li>
          <?php
          if (isset($_SESSION['useremail'])) {
          ?>

            <li class="nav-item">
              <a class="nav-link  link-light" href="./orders.php">My Orders</a>
            </li>
          <?php
          }
          ?>
          <li class="nav-item p-1 ">
            <a class="" name="cart" href="./cart.php"><i class="fa fa-shopping-cart nav-link" style="color:white;font-size:20px" aria-hidden="true"></i></a>
            <?php
            if ($total_cart_items > 0) {
              echo " <div class='cart-badge'>
                            <p id='badge'>$total_cart_items</p>
                          </div>";
            }

            ?>
          </li>
          <?php
          if (isset($_SESSION['useremail'])) {
          ?>

            <li class="nav-item p-1 ">
              <a class="btn btn-outline-danger" name="logout" href="./logout.php">Logout</a>
            </li>
          <?php
          } else {
          ?>
            <li class="nav-item p-1 ">
              <a class="btn btn-outline-info" href="./userLogin.php">Log in</a>
            </li>
          <?php  } ?>
        </ul>
      </div>
    </div>
  </nav>