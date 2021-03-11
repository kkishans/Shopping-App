<?php   
    include '../db/db.php';
    include 'top.php';
?>

<?php
    $query = "SELECT 
        ( SELECT count(*) from product_details ) as pid,
        ( SELECT count(*) from category ) as cid,
        ( SELECT count(*) from brands ) as bid,
        ( select count(*) from users ) as user,
        ( select count(*) from contact_us ) as mails,
        ( select count(*) from order_details ) as orders,
        ( select count(*) from ordered_products where `status` = 'Delivered' ) as deliver, 
        ( select count(*) from ordered_products where `status` = 'Not Delivered' ) as notDeliver
        
    ";
      
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
?>

<div class="container my-4">
<!-- <h1 class="text-center mt-2">Dashboard</h1> -->
<div class="row  mt-2">

<h3>Order Details :</h3>
<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Total Orders</h4>
        <p class="p-2 number text-info"><?= $r['orders']?></p>
    </div>
  </div>
</div>

<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Delivered</h4>
        <p class="p-2 number text-success"><?= $r['deliver']?></p>
    </div>
  </div>
</div>

<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Pending</h4>
        <p class="p-2 number text-danger"><?= $r['notDeliver']?></p>
    </div>
  </div>
</div>

<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Mails</h4>
        <p class="p-2 number text-secondary"><?= $r['mails']?></p>
    </div>
  </div>
</div>

<h3 class="mt-4">Product details :</h3>
<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Products</h4>
        <p class="p-2 number text-secondary"><?= $r['pid']?></p>
    </div>
  </div>
</div>

<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Categories</h4>
        <p class="p-2 number  text-secondary"><?= $r['cid']?></p>
    </div>
  </div>
</div>

<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Brands</h4>
        <p class="p-2 number  text-secondary"><?= $r['bid']?></p>
    </div>
  </div>
</div>

<div class="card-l col-xl-3 col-sm-11 col-md-4 mt-3"> 
  <div class="card p-1" >
    <div class="card-body ">
        <h4 class="text-center">Total Customers</h4>
        <p class="p-2 number  text-info"><?= $r['user']?></p>
    </div>
  </div>
</div>


</div>


<?php include 'bottom.php' ?>