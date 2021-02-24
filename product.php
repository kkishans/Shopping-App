<?php 
  include './top.php';
  include './db/db.php';
?>
<?php 
    $id = $_GET['id'];
    $query = "SELECT * FROM product_details where p_id =". $id;
    $result = mysqli_query($conn, $query);
    $r = mysqli_fetch_assoc($result);
    $pname = $r['p_name'];
    $price = $r['price'];
    $stock = $r['stock'];
    $c_id = $r['c_id'];
    $b_id = $r['b_id'];
    $desc = $r['description'];
?>
<div class="container mt-5">
    <div class="row">
        <div class="card col-md-6 col-xl-6 col-sm -11">
            <img src="<?= "img/". $r['p_img']  ?>" class="card-img-top" height="400px" alt="Product Image" style="object-fit: contain;">
        </div>
        <div class="col-md-6 col-xl-6 col-sm -11 p-5">
          <div class="row">
            <label class="form-label col-3 fs-5">Product: </label>
            <label class="form-label fs-4 col-8"><?= $pname ?></label>
          </div> 
         
          <div class="row">
            <label class="form-label col-3 fs-5"></label>
            <label class="form-label fs-5 col-8"><?= $desc ?></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Price: </label>
            <label class="form-label fs-4 col-8"><b><?= $price ?> ₹</b></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Category:</label>
            <?php 
                 $query = "SELECT * FROM category where c_id =". $c_id;
                 $result = mysqli_query($conn, $query);
                 $r = mysqli_fetch_assoc($result);
            ?>
            <label class="form-label fs-4 col-8"><?= $r['c_title'] ?></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Brand: </label>
            <?php 
                 $query = "SELECT * FROM brands where b_id =". $b_id;
                 $result = mysqli_query($conn, $query);
                 $r = mysqli_fetch_assoc($result);
            ?>
            <label class="form-label fs-4 col-8"><?= $r['b_name']  ?></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Stock: </label>
            <label class="form-label fs-4 col-8"><?= $stock ?></label>
          </div>    
        </div>
    </div>
</div>