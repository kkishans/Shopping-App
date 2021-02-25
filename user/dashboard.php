<?php
    include './top.php';
    if (!isset($_SESSION['useremail'] )) {
        echo "<script> window.location ='./userLogin.php' </script>";
    }
?>
<div>
    <h1>Welcome <?= $_SESSION['useremail'] ?> </h1>
</div>