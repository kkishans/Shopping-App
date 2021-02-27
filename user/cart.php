<?php
    include '../db/db.php';
    include './top.php';
    error_reporting(E_ERROR | E_PARSE);
    if (!isset($_SESSION['useremail'] )) {
        echo "<script> window.location ='./userLogin.php' </script>";
    }
?>

<?php 
    $query = "SELECT o_id FROM order_details  ORDER BY o_id DESC LIMIT 1";
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $o_id = (int)$r['o_id'] + 1;
    $query = "SELECT u_id, address FROM users  WHERE  email = '".$_SESSION['useremail']."'" ;
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
        if (isset($_COOKIE['cart'])) {
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
                            $cart = json_decode($_COOKIE['cart'],true);
                            if(isset($_COOKIE['cart'])){
                                foreach( $cart as $k => $v){
                                    $totalPerProduct = $v['price'] * $v['qty'];
                                    $total += $totalPerProduct;

                        ?>
                            <tr>
                                <td><img src="<?= "../img/". $v['p_img']  ?>" alt="product image" width="60px" height="60px"></td>
                                <th><?= $v['p_name'] ?></th>
                                <th><?= $v['price'] ?></th>
                                <th><?= $v['qty'] ?></th> 
                                <th><a href="./remove_product.php?index=<?= $k ?>" class="btn btn-outline-danger"> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
                            </tr>
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
        }else{
    ?>
    <div class="col-4 m-auto" >
            <img src="../img/emptyCart" alt="Cart is empty" height="300px" srcset="">   
            <h4 class="text-center">Your Cart is Empty!!!</h4> 
    </div>
    <?php 
    }
    ?>
</div>

<?php
    if (isset($_POST['clear'])) {
        
            ///echo "button clicked";
            setcookie("cart","",time()-3600,"../");
            header("location: dashboard.php");
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
