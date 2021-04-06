<?php
include '../db/db.php';

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require '../vendor/autoload.php';

if(isset($_GET['deleteProduct'])){
    $product_query = "SELECT * FROM product_details WHERE p_id = ".$_GET['deleteProduct'];
    $r = mysqli_fetch_assoc(mysqli_query($conn,$product_query));
    $product_delete_query = "DELETE FROM product_details WHERE p_id = ".$_GET['deleteProduct'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Product Deleted.')</script>";
    }else{
        echo mysqli_error($conn);
        echo "<script>alert(' Error while deleting a product, it might be ordered by someone else'); window.location = './home.php'</script>";
        return;
    }
    $img = 
    array($r['p_img'],
          $r['product_optional_image_1'],
          $r['product_optional_image_2'],
          $r['product_optional_image_3'],
          $r['product_optional_image_4']
        );
    foreach ($img as $s) {
        if ($s== null || $s == '' || $s =="dummy.png") {
            $s = "t_e_m_p_1_2_3_4.tmp";
        }
        $file_pointer = "../img/".$s;
        echo $file_pointer ."<br>";
        if(file_exists($file_pointer)){
            if (!unlink($file_pointer)) {  
                echo ("$file_pointer cannot be deleted due to an error<br>");  
            }
            else {  
                echo ("$file_pointer has been deleted<br>");  
            }
        }
    }  
    
   header("location:./home.php");
}
if(isset($_GET['deleteCategory'])){
    $product_delete_query = "DELETE FROM category WHERE c_id = ".$_GET['deleteCategory'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Category Deleted.'); window.location = 'category.php'</script>";
        // header("location:category.php");
     }else{
        echo "<script>alert('Can not delete this category.'); window.location = 'category.php'</script>";
     }
    //  header("location:category.php");

}
if(isset($_GET['deleteBrand'])){
    $product_delete_query = "DELETE FROM brands WHERE b_id = ".$_GET['deleteBrand'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Brand Deleted.'); window.location = 'brand.php'</script>";
        // header("location:brand.php");
    }else{
        echo "<script>alert('Can not delete this brand.'); window.location = 'brand.php'</script>";
     }
}

// Delete Specitication
if(isset($_GET['deleteSpecification'])){
    $product_delete_query = "DELETE FROM product_description WHERE id = ".$_GET['deleteSpecification'];

    if (mysqli_query($conn,$product_delete_query)) {
        echo "<script>alert('Brand Deleted.')</script>";
        header("location:specification.php?pid=".$_GET['pid']);
    }else{
        echo mysqli_error($conn);
     }
}

if(isset($_GET['productDelivered'])){
    $order_update_query = "UPDATE ordered_products SET  status = 'Delivered' WHERE o_id = '".$_GET['productDelivered']."' AND p_id = ". $_GET['productId'];

    if (mysqli_query($conn,$order_update_query)) {
        echo "<script>alert('Brand Deleted.')</script>";
        header("location:orders.php");
     }else{
         echo mysqli_error($conn);
     }
}

if(isset($_GET['cancelOrder'])){
    $order_update_query = "UPDATE ordered_products SET  status = 'Cancelled' WHERE o_id = '".$_GET['cancelOrder']."' AND p_id = ". $_GET['productId'];

    if (mysqli_query($conn,$order_update_query)) {
        sendMail($_GET['productId'],$_GET['email']);
        header("location:orders.php");
     }else{
         echo mysqli_error($conn);
     }
}

 

function sendMail($pid,$email){
    include '../db/db.php';

    require "../env.php";
    $query = "SELECT p_name from product_details where p_id = $pid";

    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $p_name = $r['p_name'];
    $to = $email ;
    $msg =  "Due some reasons Your $p_name order is cancelled by us. \nFor more detail please contact us.";

    echo $msg;
        $mail = new PHPMailer(true); 
       
        try { 
            $mail->SMTPDebug = 0;                                        
            $mail->isSMTP();                                             
            $mail->Host       = 'smtp.gmail.com;';                     
            $mail->SMTPAuth   = true;                              
            $mail->Username   = $from;                  
            $mail->Password   = $password;                                                       
            $mail->Port       = 587;   
        
            $mail->setFrom($from, $fromName);            
            $mail->addAddress($to); 
            
            $mail->isHTML(true);                                   
            $mail->Subject = 'Pooja Electronics'; 
            $mail->Body    = $msg; 
            $mail->send(); 
            
            
        } catch (Exception $e) { 
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
        } 
}


?>