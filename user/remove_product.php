<?php
    include "../db/db.php"; 
    session_start();
    if (isset($_SESSION['useremail'] )) {
        $k = $_GET['index'];
        
        $query = "DELETE from cart_details where id = $k";
        $res = mysqli_query($conn,$query);

        if ($res) {
            header("location:cart.php");
        }
    }
?>
