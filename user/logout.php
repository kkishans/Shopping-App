<?php
    session_start();
    if (isset($_SESSION['useremail'])) {
        session_destroy();
        // header("location: ./userLogin.php");
    }
    header("location: ./userLogin.php");
?>