<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Shopping App</title>
  </head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-4" href="#">Shopping App</a>
        <div>
          <ul class="nav text-light  justify-content-end">
              <li class="nav-item">
                  <a class="nav-link link-light " href="#">All Products</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link  link-light" href="#">Services</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link  link-light" href="#">About Us</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link  link-light" href="#">Contact Us</a>
              </li>
          </ul>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </div>
        </div>
    </div>
  </nav>

<div class="row col-11 mt-4 py-3 m-auto border-1 border rounded">
    <div class="col-xl-5 col-md-5 col-sm-10 col-xm-11">
        <h1 class="text-center my-3"> Our Collection</h1>
    </div>
    <div class="col-xl-7 col-md-7 col-sm-10 col-xm-11">
    <form action="#" method="post"  class="row">
    <div class="col-xl-3 col-md-3 col-sm-5 ">
      <label class="form-label">Category :</label>
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
   
    <div class=" col-md-2 col-sm-6 p-3 col-xl-2 text-center mt-3 ">
        <input type="submit" value="Filter" name="filter" class="btn btn-outline-success px-4">
    </div>
    <div class=" col-md-3 col-sm-12 p-3 col-xl-4 text-center mt-3">
    <div class="input-group">
      <div class="form-outline d-flex">
        <input type="search" id="search" class="form-control" placeholder="Search.." list="searchResult"/>
        <button type="submit" name="search" class="btn btn-outline-success px-4">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>
      
    </div>
    </div>
  </form>
    </div>   
</div>

<div class="items row col-11 m-auto mt-2 mb-5">
  <?php 
    include './db/db.php';

    if (isset($_POST['filter'])) {
      $category = $_POST['category'];
      $brand = $_POST['brand'];
  
      $query = "select * from product_details " . 
        (($category != 0 || $brand != 0) ? 
          " where " . (
                        ($brand != 0) ? 
                        "b_id = $brand " : ""
                      ) . 
                      (
                        ($category != 0 && $brand != 0) ? 
                        " and " : ""
                      ) . 
                      (
                        ($category != 0) ?  
                        " c_id = $category" : ""
                      ) 
        : "") ;
     }
     else{
      $query = "select * from product_details";
     }
    
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) > 0) {
        while($r = mysqli_fetch_assoc($result)){

  ?>
  
  <div class=" col-xl-3 col-sm-11 col-md-6 col-xl-3 mt-3"> 
    <div class="card p-2" style="height: 20rem;">
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

<!-- Filter Product by brand and category -->