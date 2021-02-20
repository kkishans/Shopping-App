<?php
    session_start();
    if (isset($_SESSION['aname'])) {
        session_destroy();
        header("Location: login.php");
    }
?>