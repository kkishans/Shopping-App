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
                       
                        <tr onclick="window.location=' ../product.php?id=<?= $v['p_id']  ?>'" style="cursor:pointer">
                        
                        
                            <td><img src="<?= "../img/". $v['p_img']  ?>" alt="product image" width="60px" height="60px"></td>
                            <th><?= $v['p_name'] ?></th>
                            <th><?= $v['price'] ?></th>
                            <th>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value="<?=$v['qty']?>"/>
                                    <input type="hidden" name="pid" value="<?=$v['p_id']?>"/>
                                    <input type="submit" name="decrease" class="btn btn-sm btn-outline-primary me-2" value="-"/>
                                </form>
                                    <?= $v['qty'] ?>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value="<?=$v['qty']?>"/>
                                    <input type="hidden" name="pid" value="<?=$v['p_id']?>"/>
                                    <input type="submit" class="btn btn-sm btn-outline-primary ms-2" name="increse" value="+"/>
                                </form>
                            
                            </th> 
                            <th><a href="./remove_product.php?index=<?= $v['id'] ?>" class="btn btn-outline-danger "> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
                       
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
                                $totalPerProduct = $v['price'] * $v['qty'];
                                $total += $totalPerProduct;

                    ?>
                        <tr onclick="window.location=' ../product.php?id=<?= $v['id']  ?>'" style="cursor:pointer">
                            <td><img src="<?= "../img/". $v['p_img']  ?>" alt="product image" width="60px" height="60px"></td>
                            <th><?= $v['p_name'] ?></th>
                            <th><?= $v['price'] ?></th>
                            <!-- <th> <?= $v['qty'] ?> </th>  -->
                            <th>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value="<?=$v['qty']?>"/>
                                    <input type="hidden" name="pid" value="<?=$v['id']?>"/>
                                    <input type="submit" name="decrease" class="btn btn-sm btn-outline-primary me-2" value="-"/>
                                </form>
                                    <?= $v['qty'] ?>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="qty" value="<?=$v['qty']?>"/>
                                    <input type="hidden" name="pid" value="<?=$v['id']?>"/>
                                    <input type="submit" class="btn btn-sm btn-outline-primary ms-2" name="increse" value="+"/>
                                </form>
                            
                            </th> 
                            <th><a href="./remove_product.php?index=<?= $v['id'] ?>" class="btn btn-outline-danger"> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
                        </tr>
                        <?php 

                            }
                        }else{
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
    // echo "Result : ". (mysqli_num_rows($res) > 0 || isset($_SESSION['cart']) );
    //print_r($_SESSION);
        if(mysqli_num_rows($res) > 0 || isset($_SESSION['cart']) ){
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

<!-- Qty changing code -->
<?php
    if (isset($_POST['decrease'])) {
        $p_id = $_POST['pid'];
        $qty = $_POST['qty'];

        if ($qty > 1) {
            if (isset($_SESSION['useremail'])) {
                $query = "UPDATE cart_details SET qty = qty-1 where u_id = $u_id and p_id = $p_id and is_in_cart = 'y'";
                $res = mysqli_query($conn,$query);
                echo "<script> window.location ='./cart.php' </script>";
            }
            else if(isset($_SESSION['cart'])){
                foreach ( $_SESSION['cart'] as $k => $v ){
                    if ($v['id'] == $p_id) {
                        $_SESSION['cart'][$k]['qty'] = $v['qty'] - 1;
                        break;
                    }
                 }
                 echo "<script> window.location ='./cart.php' </script>"; 
            }
            
        }else echo "<script>swal('Alert','Quatity must be grater than 0','info')</script>"; 
        
    }

    if (isset($_POST['increse'])) {
        $p_id = $_POST['pid'];
        $qty = $_POST['qty'];
        
        if (isset($_SESSION['useremail'])) {
            $query = "UPDATE cart_details SET qty = qty+1 where u_id = $u_id and p_id = $p_id and is_in_cart = 'y'";
            $res = mysqli_query($conn,$query);
            echo "<script> window.location ='./cart.php' </script>";
        }
        else if(isset($_SESSION['cart'])){
            foreach ( $_SESSION['cart'] as $k => $v ){
                if ($v['id'] == $p_id) {
                    $_SESSION['cart'][$k]['qty'] = $v['qty'] + 1;
                    break;
                }
             }
             echo "<script> window.location ='./cart.php' </script>"; 
        }
    }

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
        
        
        if (isset($_SESSION['useremail'])) {
            $ordered_query = "INSERT INTO order_details(o_id,u_id,total_amount,shipping_address) 
            VALUES( $o_id,$u_id,$total,'$address')";
            echo mysqli_error($conn);
            $sql = "SELECT P.p_id,id from cart_details as C,product_details as P,users as U where  C.p_id = P.p_id and U.u_id = C.u_id and is_in_cart = 'y' and U.email = '".$_SESSION['useremail']."'";
                            
            $res = mysqli_query($conn,$sql);
            if (mysqli_num_rows($res) > 0) {

                while($r = mysqli_fetch_assoc($res)){
                    $query = "INSERT into ordered_products(p_id,o_id) VALUES(".$r['p_id'].",$o_id)";
                    mysqli_query($conn,$query);
                    echo mysqli_error($conn);
                }
            }
            if (mysqli_query($conn,$ordered_query)) {
                $query = "UPDATE cart_details SET is_in_cart = 'n' where u_id = $u_id and is_in_cart = 'y'";
                $res = mysqli_query($conn,$query);
                $msg =  'Your Ordered Id is O-0 '.$o_id.' .\n Product will deliver soon. \n A Confirmation E-mail will send to you';
                echo '<script>
                        
                swal({
                    title: "Order placed!",
                    text: "'.$msg.'",
                    icon: "success",
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        //window.location = "./cart.php";
                    } 
                  });
            </script>';
              
                //setcookie("cart","",-3600);
                //header("location: ./cart.php");
            }else{
                echo "<script>alert('Error while taking your order try again.')</script>";
                echo mysqli_error($conn);
            }
        }
        else{
            
            echo "<script> window.location ='./userLogin.php' </script>";
        }
        
    }
?>
