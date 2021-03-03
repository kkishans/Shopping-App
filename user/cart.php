<?php
    include '../db/db.php';
    include './top.php';
    error_reporting(E_ERROR | E_PARSE);
    if (!isset($_SESSION['useremail'] )) {
        echo "<script> window.location ='./userLogin.php' </script>";
    }

    $useremail = $_SESSION['useremail'];
?>

<?php 
    $query = "SELECT o_id FROM order_details  ORDER BY o_id DESC LIMIT 1";
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $o_id = (int)$r['o_id'] + 1;
    $query = "SELECT u_id, address FROM users  WHERE  email = '".$useremail."'" ;
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $u_id = (int)$r['u_id'];
    $address = $r['address'];
?>
<div class="container-fluid mt-3">
    <hr>
    <div class="row justify-content-between my-3">
        
        
        <div class="col-md-4 ms-4">
            <h3>Your Cart</h3>
        </div>
        <?php
            if (isset($_COOKIE['cart'])) {
        ?>
            <div class="col-md-3 text-end me-4">
            <form  method="post">
                <input type="submit" class="btn btn-outline-danger" value="Remove all" name="clear">
            </form>
        </div>
        <?php
            }
        ?>
        
        
    </div>
    <hr>
    
    <?php
        
    ?>

    <div class="mt-4">
            <div class="card col-11 m-auto" >
                <div class="card-body">
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
                            $total = 0;
                            if(isset($_SESSION['useremail'])){
                            $sql = "SELECT id,p_name,qty,p_img,price from cart_details as C,product_details as P,users as U where  C.p_id = P.p_id and U.u_id = C.u_id and is_in_cart = 'y' and U.email = '".$_SESSION['useremail']."'";
                            
                            $res = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($res) > 0) {
                            
                            
                                while( $v = mysqli_fetch_assoc($res)){
                                    $totalPerProduct = $v['price'] * $v['qty'];
                                    $total += $totalPerProduct;

                        ?>
                            <tr>
                                <td><img src="<?= "../img/". $v['p_img']  ?>" alt="product image" width="60px" height="60px"></td>
                                <th><?= $v['p_name'] ?></th>
                                <th><?= $v['price'] ?></th>
                                <th><?= $v['qty'] ?></th> 
                                <th><a href="./remove_product.php?index=<?= $v['id'] ?>" class="btn btn-outline-danger"> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
                            </tr>
                            <?php 

                                }
                            }
                            else{
                            ?>
                                <div class="col-4 m-auto" >
                                        <img src="../img/emptyCart" alt="Cart is empty" height="300px" srcset="">   
                                        <h4 class="text-center">Your Cart is Empty!!!</h4> 
                                </div>
                            <?php 
                            }
                        }
                        
                            
                            ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                            <h5 class="text-end pe-2">Total : <?= $total?></h5>
                    </div>
                </div>
        </div>
    </div>
    <div class="justify-content-center d-flex">
    <form action="" method="post">
        <button type="submit" name="order" class="btn btn-outline-primary my-5 m-auto fs-4">Order Now</button>
    </form>
    </div>
    <?php
        
    ?>
    <!-- <div class="col-4 m-auto" >
            <img src="../img/emptyCart" alt="Cart is empty" height="300px" srcset="">   
            <h4 class="text-center">Your Cart is Empty!!!</h4> 
    </div> -->
    <?php 
    
    ?>
</div>
  
<div class="card col-md-10 col-xl-10 col-sm-11 m-auto mt-5" >
  <div class="card-body">
   
    <?php 
         $query = "SELECT * FROM order_details WHERE u_id = ".$u_id;
         $res = mysqli_query($conn,$query);
          if (mysqli_num_rows($res) > 0) {
    ?>
     <div class="text-center">
        <h2>Your Ordered List</h2><hr>
    </div>
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Order At</th>
                <th>Delivery address </th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        
             while($r = mysqli_fetch_assoc($res)){
                $order_query = "SELECT * FROM ordered_products WHERE o_id = ".$r['o_id'] ;
                $res1 = mysqli_query($conn,$order_query);

                while($r2 = mysqli_fetch_assoc($res1)){
                $product_query = "SELECT * FROM product_details WHERE p_id = ".$r2['p_id'] ;
                $res3 = mysqli_query($conn,$product_query);
                $p = mysqli_fetch_assoc($res3);
        ?>
            <tr>
                <th><?= $p['p_name'] ?></th>
                <th><?= $r['ordered_at'] ?></th>
                <th><?= $r['shipping_address'] ?></th>
                <th><?= $r2['status']?></th>
            </tr>
            <?php 
                }
             }
            }else{
                echo "
                    <div  class='text-center'><p' class='text-center text-success '> You haven't ordered any product yet!</p></div>
                ";
            }    
            echo mysqli_error($conn)   ;     
            ?>
        </tbody>
    </table>
  </div>
</div>

<?php
    if (isset($_POST['clear'])) {
        $sql = "DELETE from cart_details where u_id = $u_id and is_in_cart = 'y'";
        $res = mysqli_query($conn,$sql);
           
    }

    if (isset($_POST['order'])) {
       $ordered_query = "INSERT INTO order_details(o_id,u_id,total_amount,shipping_address) 
        VALUES( $o_id,$u_id,$total,'$address')";
        foreach( $cart as $k => $v){
            $query = "INSERT into ordered_products(p_id,o_id) VALUES(".$v['id'].",$o_id)";
            mysqli_query($conn,$query);
        }
        if (mysqli_query($conn,$ordered_query)) {
            echo "<script>alert('Product Ordered.')</script>";
            setcookie("cart","",-3600);
            header("location: ./cart.php");
        }else{
            echo "<script>alert('Error while taking your order try again.')</script>";
            echo mysqli_error($conn);
        }
        
    }
?>
