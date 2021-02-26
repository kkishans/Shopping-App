<?php
    include './top.php';
    
    if (!isset($_SESSION['useremail'] )) {
        echo "<script> window.location ='./userLogin.php' </script>";
    }
?>
<div class="container-fluid mt-3">
    <hr>
    <div class="row justify-content-between my-3">
        
        
        <div class="col-md-4 ms-4">
            <h3>Your Cart</h3>
        </div>
        <?php
            if (isset($_SESSION['cart'])) {
        ?>
            <div class="col-md-3 text-end me-4">
            <form action="" method="post">
                <input type="submit" class="btn btn-outline-danger" value="Remove all" name="remove">
            </form>
        </div>
        <?php
            }
        ?>
        
        
    </div>
    <hr>
    
    <?php
            if (isset($_SESSION['cart'])) {
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
                            if(isset($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $k => $v){
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

    <?php
        }
    ?>
</div>

<?php
    if (isset($_POST['remove'])) {
        unset($_SESSION['cart']);
    }
?>