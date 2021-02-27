<?php
include '../db/db.php';
if(isset($_GET['deleteProduct'])){
    $product_delete_query = "DELETE FROM product_details WHERE p_id = ".$_GET['deleteProduct'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Product Deleted.')</script>";
        header("location:home.php");
     }else{
         echo mysqli_error($conn);
     }
}
if(isset($_GET['deleteCategory'])){
    $product_delete_query = "DELETE FROM category WHERE c_id = ".$_GET['deleteCategory'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Category Deleted.')</script>";
        header("location:category.php");
     }else{
         echo mysqli_error($conn);
     }
}
if(isset($_GET['deleteBrand'])){
    $product_delete_query = "DELETE FROM brands WHERE b_id = ".$_GET['deleteBrand'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Brand Deleted.')</script>";
        header("location:brand.php");
    }else{
        echo mysqli_error($conn);
     }
}
if(isset($_GET['productDelivered'])){
    $order_update_query = "UPDATE ordered_products SET  status = 'Delivered' WHERE o_id = ".$_GET['productDelivered']." AND p_id = ". $_GET['productId'];

    if (mysqli_query($conn,$order_update_query)) {
        echo "<script>alert('Brand Deleted.')</script>";
        header("location:orders.php");
     }else{
         echo mysqli_error($conn);
     }
}


?>