<?php 
include '../db/db.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require '../vendor/autoload.php'; 

    if(isset($_GET['id'])){
        $order_update_query = "UPDATE ordered_products SET  status = 'Cancelled' WHERE o_id = '".$_GET['id']."' AND p_id = ". $_GET['pid'];

        if (mysqli_query($conn,$order_update_query)) {
            sendMail( $_GET['pid']);
            echo "<script>alert('Order Cancelled.')</script>";
            header("location:orders.php");
        }else{
            echo mysqli_error($conn);
        }
    }

    function sendMail($pid){
        include '../db/db.php';

        require "../env.php";
        $email = $_SESSION['useremail']; 
        $query = "SELECT
            ( SELECT p_name from product_details where p_id = $pid ) as p_name,
            (SELECT f_name from users where email = '$email') as f_name
            ";

        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $p_name = $r['p_name'];
        $fname = $r['f_name'];
        $to = $from ;
        $msg =  "$fname cancelled his $p_name order";

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