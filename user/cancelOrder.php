<?php 
include '../db/db.php';
    if(isset($_GET['id'])){
        $order_update_query = "UPDATE ordered_products SET  status = 'Cancelled' WHERE o_id = '".$_GET['id']."' AND p_id = ". $_GET['pid'];

        if (mysqli_query($conn,$order_update_query)) {
            echo "<script>alert('Order Cancelled.')</script>";
            header("location:orders.php");
        }else{
            echo mysqli_error($conn);
        }
    }

?>