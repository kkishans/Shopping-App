<?php 
  include './top.php';

  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
      $pageno = 1;
  }

  $no_of_records_per_page = 10;
  $offset = ($pageno-1) * $no_of_records_per_page; 

  $total_pages_sql = "SELECT COUNT(*) FROM product_details";
  $result = mysqli_query($conn,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);
?>

<div class="row col-11 py-3 m-auto border-0 border rounded">
    <div class="col-xl-5 col-md-5 col-sm-10 col-xm-11">
        <h1 class="text-center my-3"> Our Collection</h1>
    </div>
    <div class="col-xl-7 col-md-7 col-sm-10 col-xm-11">
    <form action="#"  class="row">
    <div class="col-xl-3 col-md-3 col-sm-5 ">
      <label class="form-label">Category :</label>
        <select class="form-select" name="category" >
          <option value="0">All</option>
          <?php 
            include './db/db.php';
            $query = "select * from category";

            $result = mysqli_query($conn,$query);
            $c_id = isset($_GET["category"]) ? $_GET["category"] : 0; 
            if (mysqli_num_rows($result) > 0) {
                while($r = mysqli_fetch_assoc($result)){
                  print_r($r);
                  $s = ($c_id == $r["c_id"]) ? "selected" : "";
                    echo "<option value='". $r["c_id"]."' $s > ".$r["c_title"]."</option>";
                }
            }
            else echo "0 record in category";
            ?>
        </select> 
    </div>
    <div class="col-xl-3 col-md-3 col-sm-5">
      <label  class="form-label">Brand :</label>
      <select class="form-select" name="brand" >
        <option value="0">All</option>
        <?php 
            //include '../db/db.php';
            $query = "select * from brands";

            $result = mysqli_query($conn,$query);
            $b_id = isset($_GET["brand"]) ? $_GET["brand"] : 0; 
            if (mysqli_num_rows($result) > 0) {
                while($r = mysqli_fetch_assoc($result)){
                  $s = ($b_id == $r["b_id"]) ? "selected" : "";
                    echo "<option value='". $r["b_id"]."' $s > ".$r["b_name"]."</option>";
                }
            }
            ?>
      </select>
    </div>
   
    <div class=" col-md-1 col-sm-5 p-3 col-xl-2 text-center mt-3 ">
        <button type="submit"  name="filter" class="btn btn-outline-success px-4">Filter</button>
    </div>
    <div class=" col-md-3 col-sm-12 p-3 col-xl-4 text-center mt-3">

      <div class="form-outline d-flex">
        <input type="text" id="searchKey" name="searchKey" class="form-control" placeholder="Search.." list="searchResult" />
        <button type="submit" name="btnSearch" class="btn btn-outline-success px-4">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>      
    </div>
    </div>
  </form>
    </div>   
</div>
<hr>
<div class="items row col-11 m-auto mt-2 mb-5">
  <?php 
    include './db/db.php';

    $query = "select * from product_details LIMIT $offset, $no_of_records_per_page";

    if (isset($_GET['filter'])) {
      $category = $_GET['category'];
      $brand = $_GET['brand'];
  
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
        : "")."LIMIT $offset, $no_of_records_per_page" ;
     }
     
     
     if(isset($_GET['btnSearch'])){
        $search = $_GET['searchKey'];
        /*$query = "SELECT * from product_details as p,category as c, brands as b where c.c_id = p.c_id and b.b_id = p.b_id  and ( LOWER(p_name) like '%".strtolower($search)."%' or LOWER(c_title) like '%".strtolower($search)."%' or LOWER(b_name) like '%".strtolower($search)."%' or LOWER(`description`) like '%".strtolower($search)."%' )  LIMIT $offset, $no_of_records_per_page";*/
        $query = "SELECT * from product_details where LOWER(`keywords`) like '%".strtolower($search)."%' LIMIT $offset, $no_of_records_per_page";
     }
     

    $result = mysqli_query($conn,$query);
    
    $count_of_data =  mysqli_num_rows($result);
    
    if (mysqli_num_rows($result) > 0) {
        while($r = mysqli_fetch_assoc($result)){

  ?>
  
  <div class="card-l col-xl-3 col-sm-11 col-md-6 col-xl-3 mt-3"> 
  
    <div class="card p-1" style="height: 23rem;">
    <a href="./product.php?id=<?= $r['p_id']  ?>" class="card-l">
      <img src="<?= "img/". $r['p_img']  ?>" class="card-img-top" height="200px" alt="Product Image" style="object-fit: contain;">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <h6 class="card-title"> <?= $r['p_name'] ?> ( <?= $r['stock'] ?> )</h6>
          <div class="cost-button"> 
            <h5>₹ <?= $r['price'] ?></h5>
          </div>                  
        </div>
        <div class="d-flex justify-content-between mt-2">
         <div class="col-12">
         
            <p class="card-title"><?= $r['description'] ?></p>
         </div>
         
          <div class="col-6"> 
            
            <a class="btn btn-primary w-100" href="./add_to_cart.php?id=<?= $r['p_id']  ?>" role="button">Add To Cart</a>
          </div>                  
        </div>
      </div></a>
    </div>
  </div>
      <?php 
          }
        }
        else{
      ?>
        <div class="row justify-content-md-center mt-4">
          <div class="col-md-6">
            <img src="img/no_result.jpg" class="card-img-top" height="200px" alt="No result Image" style="object-fit: contain;">
            <div class="card-body text-center noResult">
              No Result Found
            </div>
          </div>
        </div>
      <?php
        }
      ?>



  </div>
  <?php
    if ($count_of_data < $total_rows ) {
    
    
  ?>
  <nav aria-label="Page navigation example mt-5">
    <ul class="pagination justify-content-around">
        
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"   tabindex="-1">Previous</a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link " href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" >Next</a>
        </li>
    </ul>
</nav>
<?php
  }
?>
  <datalist id="searchResult">
      <?php
        $query = "select * from product_details";
        $result = mysqli_query($conn,$query);

        if (mysqli_num_rows($result) > 0) {
            while($r = mysqli_fetch_assoc($result)){
              echo "<option value='". $r["p_name"]."' >";
            }
        }

      ?>
  </datalist>
        
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
  </body>
</html>