<?php
    session_start();
    if (isset($_SESSION['useremail'] ) && isset($_SESSION['cart'])) {
        $k = $_GET['index'];
        unset($_SESSION['cart'][$k]);
        //print_r($_SESSION['cart']);
        header("location:cart.php");
    }
?>
