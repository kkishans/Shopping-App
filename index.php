<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Shopping App</title>
  </head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Shopping App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
            aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarID">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </div>
        </div>
    </div>
  </nav>

<div class="row col-11 mt-4 py-3 m-auto border-1 border">
    <div class="col-xl-5 col-md-5 col-sm-10 col-xm-11">
        <h1 class="text-center my-3"> Our Collection</h1>
    </div>
    <div class="col-xl-7 col-md-7 col-sm-10 col-xm-11">
    <form action="#" method="post"  class="row">
    <div class="col-xl-3 col-md-3 col-sm-5 ">
      <label class="form-label">Category</label>
        <select class="form-select" name="category" >
          <option value="0">All</option>
          <?php 
            include './db/db.php';
            $query = "select * from category";

            $result = mysqli_query($conn,$query);
            
            if (mysqli_num_rows($result) > 0) {
                while($r = mysqli_fetch_assoc($result)){
                    echo "<option value='". $r["c_id"]."'> ".$r["c_title"]."</option>";
                }
            }
            ?>
        </select> 
    </div>
    <div class="col-xl-3 col-md-3 col-sm-5">
      <label  class="form-label">Brand :</label>
      <select class="form-select" name="brand" >
        <option value="0">All</option>
        <?php 
            include '../db/db.php';
            $query = "select * from brands";

            $result = mysqli_query($conn,$query);
            
            if (mysqli_num_rows($result) > 0) {
                while($r = mysqli_fetch_assoc($result)){
                    echo "<option value='". $r["b_id"]."'> ".$r["b_name"]."</option>";
                }
            }
            ?>
      </select>
    </div>
  </form>
    </div>   
</div>
<div class="items row col-11 m-auto mt-2 mb-5">
  <?php 
    include './db/db.php';
    $query = "select * from product_details";

    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) > 0) {
        while($r = mysqli_fetch_assoc($result)){

  ?>
  
  <div class=" col-xl-3 col-sm-11 col-md-6 col-xl-3 mt-3"> 
    <div class="card p-1" style="height: 20rem;">
      <img src="<?= "img/". $r['p_img']  ?>" class="card-img-top" height="200px" alt="Product Image" style="object-fit: contain;">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <h6 class="card-title"> <?= $r['p_name'] ?> ( <?= $r['stock'] ?> )</h6>
          <div class="cost-button"> 
            <h5>₹ <?= $r['price'] ?></h5>
          </div>                  
        </div>
        <div class="d-flex justify-content-between mt-2">
          <p class="card-title"><?= $r['description'] ?></p>
          <div class="cost-button"> 
            <a class="btn btn-primary" href="#" role="button">Buy</a>
          </div>                  
        </div>
      </div>
    </div>
  </div>
      <?php 
        }
      }
      ?>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
  </body>
</html>

<!-- 


  <div class="col-xl-5 col-md-5 col-sm-10 col-xm-11">
    <form action="#" method="post"  class="d-flex justify-content-between">
    <div class="col-3 d-flex justify-content-between">
      <label for="exampleFormControlInput1" class="form-label">Category</label>
        <select class="form-select" name="category" >
          <option value="0">All</option>
          <?php 
            include './db/db.php';
            $query = "select * from category";

            $result = mysqli_query($conn,$query);
            
            if (mysqli_num_rows($result) > 0) {
                while($r = mysqli_fetch_assoc($result)){
                    echo "<option value='". $r["c_id"]."'> ".$r["c_title"]."</option>";
                }
            }
            ?>
        </select> 
    </div>
    <div class="col-3  d-flex justify-content-between">
      <label for="exampleFormControlInput1" class="form-label">Brand :</label>
      <select class="form-select" name="brand" >
        <option value="0">All</option>
        <?php 
            include '../db/db.php';
            $query = "select * from brands";

            $result = mysqli_query($conn,$query);
            
            if (mysqli_num_rows($result) > 0) {
                while($r = mysqli_fetch_assoc($result)){
                    echo "<option value='". $r["b_id"]."'> ".$r["b_name"]."</option>";
                }
            }
            ?>
      </select>
    </div>
  </form>
  </div>
 -->