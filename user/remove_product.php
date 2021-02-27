<?php
    session_start();
    if (isset($_SESSION['useremail'] ) && isset($_COOKIE['cart'])) {
        $k = $_GET['index'];
        //unset($_SESSION['cart'][$k]);
        //setcookie("cart","", time()-3600);
        //print_r($_SESSION['cart']);
        header("location:cart.php");
    }
?>
