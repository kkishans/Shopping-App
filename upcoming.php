<?php
include './top.php';
include './db/db.php';
$id = $_GET['id'];
$query = "SELECT * FROM upcoming_products where id =" . $id;
$result = mysqli_query($conn, $query);
$r = mysqli_fetch_assoc($result);
$title = $r['title'];
$desc = $r['desc'];
$img = $r['image'];
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 col-xl-6 col-sm -11">
      <div class="card">
        <div class="slideshow-container">
          
            <div class="showslide">
              <img src="<?= "upload/upcoming/" . $img  ?>" class="card-img-top" height="400px" alt="Product Image" style="object-fit: contain;">
              
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-6 col-sm-11 p-5">
      <div class="row">
        <label class="form-label col-4 fs-5">Product: </label>
        <label class="form-label fs-5 col-7 align-baseline"><?= $title ?></label>
      </div>
      <div class="row mt-3">
        <label class="form-label col-4 fs-5 font-weight-bold"><b>Description: </b></label>
        <label class="form-label fs-6 col-12 align-baseline"><?= $desc ?></label>
      </div>


    </div>

  </div>
</div>

<?php include 'bottom.php' ?>