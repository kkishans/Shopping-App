<?php 
    include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }
?>
<div>
    <h1 class="text-center my-3"> All Products</h1>
</div>
<div class="card col-11 m-auto" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Review</th>
                <th>Product Name</th>
                <th>price</th>
                <th>stock</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "select * from product_details";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <td><img src="<?= "../img/". $r['p_img']  ?>" alt="product image" width="50p" height="40px"></td>
                <th><?= $r['p_name'] ?></th>
                <th><?= $r['price'] ?></th>
                <th><?= $r['stock'] ?></th>
                <th><a href="./product.php?update=<?= $r['p_id'] ?>" class="btn btn-outline-success"> <i class="fa fa-pencil" aria-hidden="true"></i></a></th>
                <th><a href="./delete.php?deleteProduct=<?= $r['p_id'] ?>" class="btn btn-outline-danger"> <i class="fa fa-remove" aria-hidden="true"></i> </a></th>
            </tr>
            <?php 

             }
            }
            
            ?>
        </tbody>
    </table>
  </div>
</div>
<?php include 'bottom.php' ?>
