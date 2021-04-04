<?php
    include '../db/db.php';
    include './top.php';
    error_reporting(E_ERROR | E_PARSE);
    // if (!isset($_SESSION['useremail'] )) {
    //     echo "<script> window.location ='./userLogin.php' </script>";
    // }
    $useremail = $_SESSION['useremail'];
?>

<?php 
    $date = date_default_timezone_set('Asia/Kolkata');
    $o_id =  "O-".rand(100,999).Date("-dmYhis",time()) ."-".rand(10000,99999);
    $query = "SELECT u_id, address FROM users  WHERE  email = '".$useremail."'" ;
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $u_id = (int)$r['u_id'];
    $address = $r['address'];
    $order_falg = false;
?>
<div class="container-fluid mt-3">
    <hr>
    <div class="row justify-content-between my-3">
        
        
        <div class="col-md-4 ms-4">
            <h3>Your Cart</h3>
        </div>
        <div class="col-md-3 text-end me-4">
            <form  method="post">
                <input type="submit" class="btn btn-outline-danger" value="Remove all" name="clear">
            </form>
        </div>
    </div>
    <hr>
    <div class="mt-4">
        <div class="card col-11 m-auto" >
            <div class="card-body">
            <?php 
                $total = 0;
                if(isset($_SESSION['useremail'])){
                $sql = "SELECT P.p_id,id,p_name,qty,p_img,price from cart_details as C,product_details as P,users as U where  C.p_id = P.p_id and U.u_id = C.u_id and is_in_cart = 'y' and U.email = '".$_SESSION['useremail']."'";
               
                $res = mysqli_query($conn,$sql);
                if (mysqli_num_rows($res) > 0) {
                    $order_falg = true;
                            ?>
                <table class="table table-striped text-center" >
                    <thead>
                        <tr>
                            <th>Review</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php                             
                        while( $v = mysqli_fetch_assoc($res)){
                        $totalPerProduct = $v['price'] * $v['qty'];
                        $total += $totalPerProduct;
                    ?>
                       
                        <tr>
                            <td>  <img src="<?= "../img/". $v['p_img']  ?>" alt="product image" width="60px" height="60px"></td>
                            <th><a href="../product.php?id=<?= $v['p_id'] ?>" class="nav-link text-dark"> <?= $v['p_name'] ?></a></th>
                            <th><a href="../product.php?id=<?= $v['p_id'] ?>" class="nav-link text-dark"> <?= $v['price'] ?></a>  </th>
                            <th>
                                <form method="post" style="display:inline">
                                    <input type="number" id="txtqty<?=$v['p_id']?>" class="form-control justify-content-center" onfocusout="return updateQty(<?=$v['p_id']?>)" style="width:20%;"  name="qty" value="<?=$v['qty']?>" min="1"/>
                                    <input type="hidden" name="pid" id="pid<?=$v['p_id']?>" value="<?= $v['p_id']?>"/>
                                    <!-- <input type="submit" name="decrease" class="btn btn-sm btn-outline-primary me-2" value="Apply"/> -->
                                </form>                                
                                    
                                <!--<form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value=""/>
                                    <input type="hidden" name="pid" value=""/>
                                    <input type="submit" class="btn btn-sm btn-outline-primary ms-2" name="increse" value="+"/>
                                </form> -->
                            
                            </th> 
                            <th><a href="./remove_product.php?index=<?= $v['id'] ?>" class="btn btn-outline-danger "> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
                       
                        </tr>
                                  
                        <?php 

                            }
                        }
                        else{
                        ?>
                            <div class="col-4 m-auto" >
                                    <img src="../img/emptyCart.png" alt="Cart is empty" height="300px" srcset="">   
                                    <h4 class="text-center">Your Cart is Empty!!!</h4> 
                            </div>
                        <?php 
                        }
                    }
                    else{
                
                        $total = 0;
                        if(isset($_SESSION['cart'])){
                ?>
                         <table class="table table-striped text-center" >
                    <thead>
                        <tr>
                            <th>Review</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                
                            foreach($_SESSION['cart'] as $k => $v){
                                $order_falg = true;
                                $totalPerProduct = $v['price'] * $v['qty'];
                                $total += $totalPerProduct;

                    ?>
                        <tr onclick="window.location=' ../product.php?id=<?= $v['id']  ?>'" style="cursor:pointer">
                            <td><img src="<?= "../img/". $v['p_img']  ?>" alt="product image" width="60px" height="60px"></td>
                            <th><?= $v['p_name'] ?></th>
                            <th><?= $v['price'] ?></th>
                            <!-- <th> <?= $v['qty'] ?> </th>  -->
                            <th>
                                <!-- <form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value=""/>
                                    <input type="hidden" name="pid" value=""/>
                                    <input type="submit" name="decrease" class="btn btn-sm btn-outline-primary me-2" value="-"/>
                                </form>
                            
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value=""/>
                                    <input type="hidden" name="pid" value=""/>
                                    <input type="submit" class="btn btn-sm btn-outline-primary ms-2" name="increse" value="+"/>
                                </form> -->
                            
                            </th> 
                            <th><a href="./remove_product.php?index=<?= $v['id'] ?>" class="btn btn-outline-danger"> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
                        </tr>
                        <?php 

                            }
                        }else{
                            ?>
                            <div class="col-4 m-auto" >
                                    <img src="../img/emptycart.png" alt="Cart is empty" height="300px" srcset="">   
                                    <h4 class="text-center">Your Cart is Empty!!!</h4> 
                            </div>
                        <?php 
                        }  
                    }
                    ?>
          
                    </tbody>
                </table>
                <?php
                    if(mysqli_num_rows($res) > 0 || isset($_SESSION['cart']) ){
                        ?>
                        <div class="mt-3">
                            <h5 class="text-end pe-2">Total : <?= $total?></h5>
                        </div>
                        
                        <?php
                    }
                
                ?>
            </div>
        </div>
    </div>
    <?php
        if($order_falg){
            ?>
            <div class="justify-content-center d-flex">
                <form action="" method="post">
                    <button type="submit" name="order" class="btn btn-outline-primary my-5 m-auto fs-4">Order Now</button>
                </form>
            </div>
            <?php
        }
    
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script>
    function updateQty(pid){
        var qty = document.getElementById('txtqty'+pid).value
        var pid = document.getElementById('pid'+pid).value

        //alert("updateQty.php?pid="+pid+"&qty="+qty)
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtQty"+pid).value = this.responseText;
            }
        };
        xmlhttp.open("GET", "updateQty.php?pid=" + pid + "&qty= "+qty, true);
        xmlhttp.send();
        // $.ajax({

        //     url: "updateQty.php?pid="+pid+"&qty="+qty ,    //the page containing php script
        //     type: "get",    //request type,
            
        //     success:function(result){
        //         console.log(result.abc);
        //     }
        // });
    }
  </script>

<?php 
    include './bottom.php';
?>
<!-- Qty changing code -->
<?php
    // if (isset($_POST['decrease'])) {
    //     $p_id = $_POST['pid'];
    //     $qty = $_POST['qty'];

    //     if ($qty > 1) {
    //         if (isset($_SESSION['useremail'])) {
    //             $query = "UPDATE cart_details SET qty = qty-1 where u_id = $u_id and p_id = $p_id and is_in_cart = 'y'";
    //             $res = mysqli_query($conn,$query);
    //             echo "<script> window.location ='./cart.php' </script>";
    //         }
    //         else if(isset($_SESSION['cart'])){
    //             foreach ( $_SESSION['cart'] as $k => $v ){
    //                 if ($v['id'] == $p_id) {
    //                     $_SESSION['cart'][$k]['qty'] = $v['qty'] - 1;
    //                     break;
    //                 }
    //              }
    //              echo "<script> window.location ='./cart.php' </script>"; 
    //         }
            
    //     }else echo "<script>swal('Alert','Quatity must be grater than 0','info')</script>"; 
        
    // }

    // if (isset($_POST['increse'])) {
    //     $p_id = $_POST['pid'];
    //     $qty = $_POST['qty'];
        
    //     if (isset($_SESSION['useremail'])) {
    //         $query = "UPDATE cart_details SET qty = qty+1 where u_id = $u_id and p_id = $p_id and is_in_cart = 'y'";
    //         $res = mysqli_query($conn,$query);
    //         echo "<script> window.location ='./cart.php' </script>";
    //     }
    //     else if(isset($_SESSION['cart'])){
    //         foreach ( $_SESSION['cart'] as $k => $v ){
    //             if ($v['id'] == $p_id) {
    //                 $_SESSION['cart'][$k]['qty'] = $v['qty'] + 1;
    //                 break;
    //             }
    //         }
    //         echo "<script> window.location ='./cart.php' </script>"; 
    //     }
    //}

?>

<?php
    if (isset($_POST['clear'])) {
        if (isset($_SESSION['useremail'])) {
            $sql = "DELETE from cart_details where u_id = $u_id and is_in_cart = 'y'";
            $res = mysqli_query($conn,$sql);
        }
        else  {
            unset($_SESSION['cart']);
            echo "<script> window.location ='./cart.php' </script>";
        }
        
        
    }

    if (isset($_POST['order'])) {
        $flag = 1;
        
        if (isset($_SESSION['useremail'])) {
            $ordered_query = "INSERT INTO order_details(o_id,u_id,total_amount,shipping_address) 
                        VALUES('$o_id',$u_id,$total,'$address')";
            echo mysqli_error($conn);
            $sql = "SELECT P.p_id,P.p_name,id, qty,stock from cart_details as C,product_details as P,users as U where  C.p_id = P.p_id and U.u_id = C.u_id and is_in_cart = 'y' and U.email = '".$_SESSION['useremail']."'";
            
            $selct_res = mysqli_query($conn,$sql);
            if (mysqli_num_rows($selct_res) > 0) {

                while($r = mysqli_fetch_assoc($selct_res)){
                    $qty = $r['qty'];
                    

                    if ($qty > $r['stock']) {
                        

                        if ($r['stock'] == 0) {
                            echo "<script>alert('We currently out of stock of ".$r['p_name'].".')</script>";
                        }
                        else{
                            echo "<script>alert('We currently have only ".$r['stock']." pieces of ".$r['p_name'].". \\nSo your order can\'t be accepted.')</script>";
                        } 
                        $flag = 0;
                        break;
                         
                    }

                }

                if ($flag == 1) {
                    $sql = "SELECT P.p_id,P.p_name,id, qty,stock from cart_details as C,product_details as P,users as U where  C.p_id = P.p_id and U.u_id = C.u_id and is_in_cart = 'y' and U.email = '".$_SESSION['useremail']."'";
            
                    $selct_res = mysqli_query($conn,$sql);
                    while($r = mysqli_fetch_assoc($selct_res)){
                        $qty = $r['qty'];
                        $query = "INSERT into ordered_products(p_id,o_id,qty) VALUES(".$r['p_id'].",'$o_id',$qty)";
                        $update_product_query = "UPDATE product_details SET stock = stock - $qty where p_id = " . $r['p_id'];
                        mysqli_query($conn,$query);
                        mysqli_query($conn,$update_product_query);
                        echo mysqli_error($conn);

                    }
                }
                
            }
            if ($flag === 1) {

                if (mysqli_query($conn,$ordered_query)) {

                    
                    $query = "UPDATE cart_details SET is_in_cart = 'n' where u_id = $u_id and is_in_cart = 'y'";
                    $res = mysqli_query($conn,$query);
                    $msg =  'Your Order Id is '.$o_id.' .\n Product will deliver soon. \n A Confirmation E-mail will send to you';

                    $mailmsg =  'Your Order Id is O-0 '.$o_id.' .<br> Product will deliver soon.';
                    sendMail($_SESSION['useremail'],$o_id,$mailmsg);
                    
                    echo '<script>
                            
                    swal({
                        title: "Order placed!",
                        text: "'.$msg.'",
                        icon: "success",
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            window.location = "./cart.php";
                        } 
                      });
                </script>';
                    
                    
                    //echo "<script>window.location = 'cart.php'</script>";
                }else{
                    echo "<script>alert('Error while taking your order try again.')</script>";
                    echo mysqli_error($conn);
                }
            }
            
        }
        else{
            
            echo "<script> window.location ='./userLogin.php' </script>";
        }
        
    }
    
?>

<!-- Mail message function -->
<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;

    function sendMail($to,$oid,$msg){
        
    
        require '../vendor/autoload.php';
            $mail = new PHPMailer(true); 
            
            require "../env.php";
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
<?php include '../bottom.php' ?>