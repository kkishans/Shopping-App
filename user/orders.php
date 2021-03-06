<?php
    include '../db/db.php';
    include './top.php';
    // error_reporting(E_ERROR | E_PARSE);
    // if (!isset($_SESSION['useremail'] )) {
    //     echo "<script> window.location ='./userLogin.php' </script>";
    // }
    $useremail = $_SESSION['useremail'];
    $query = "SELECT u_id, address FROM users  WHERE  email = '".$useremail."'" ;
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $u_id = (int)$r['u_id'];
?>


<div class="card col-md-10 col-xl-10 col-sm-11 m-auto mt-5" >
  <div class="card-body">
   
    <?php 
         $query = "SELECT * FROM order_details WHERE u_id = ".$u_id;
         $res = mysqli_query($conn,$query);
          if (mysqli_num_rows($res) > 0) {
    ?>
     <div class="text-center">
        <h2>Your Orders</h2><hr>
    </div>
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Order On</th>
                <th>Delivery address </th>
                <th>Price</th>
                <th>Status</th>
                <th>Cancel Order</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        
             while($r = mysqli_fetch_assoc($res)){
                $order_query = "SELECT * FROM ordered_products WHERE o_id = '".$r['o_id']."'" ;
                $res1 = mysqli_query($conn,$order_query);

                while($r2 = mysqli_fetch_assoc($res1)){
                $product_query = "SELECT * FROM product_details WHERE p_id = ".$r2['p_id'] ;
                $res3 = mysqli_query($conn,$product_query);
                $p = mysqli_fetch_assoc($res3);
                echo mysqli_error($conn);
        ?>
            <tr>
                
                <th><a href="../product.php?id=<?= $p['p_id']  ?>" class="card-l" style="max-width:4rem;text-decoration: none;color:black;"><?= $p['p_name'] ?>
                <br><p style="font-weight: 400;"> <?= $p['description'] ?></p></a></th>
                <th><?= $r2['qty'] ?></th>
                <th style="min-width: 4rem;"><?= $r['ordered_at'] ?></th>
                <th style="min-width: 5rem;font-weight: 500;"><?= $r['shipping_address'] ?></th>
                <th style="min-width: 6rem;">
                    <p style="font-weight: 400;"><?= $p['price'] ." * " . $r2['qty']." = " ?></p>
                    <p style="font-weight: 500;"><?= " ₹ ". number_format(($p['price'] * $r2['qty'])) ?></p>
                </th>
                <th><?= $r2['status']?></th>
                <th style="min-width: 6rem; text-align:center;"><?php 
                    if($r2['status'] == "Not Delivered"){
                        ?>
                        <a href="./cancelOrder.php?id=<?= $r['o_id'] ?>&pid=<?= $p['p_id'] ?>" class="btn btn-outline-danger">Cancel</a>
                        <?php
                    }else{
                        echo " - ";
                    }
                ?></th>
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
    include '../bottom.php';
?>