<?php 
    include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }
?>
<div>
    <h1 class="text-center my-3"> All Products</h1>
</div>
<div class="align-items-center text-center card border-0">
    <form action="#" method="post">
        <div class="d-flex just-content-center row">
            <div class=" col-md-2 col-sm-3  col-xl-3 mt-3 ">
                <label class="form-label">Category :</label>
            </div>
            <div class=" col-md-5 col-sm-5  col-xl-5 mt-3 ">           
               
                <select class="form-select" name="category" >
                <option value="0">All</option>
                <?php 
                
                    $query = "select * from category";

                    $result = mysqli_query($conn,$query);
                    $c_id = isset($_POST["category"]) ? $_POST["category"] : 0; 
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
            <div class=" col-md-5 col-sm-4 col-xl-4 mt-3 ">
                <button type="submit"  name="filter" class="btn btn-outline-success px-4">Filter</button>
            </div>
        </div>
       
        </div>
    </form>
</div>

<div class="card col-11 m-auto mt-5" >
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
          if (isset($_POST['category'])) {
              if( $_POST['category'] != '0')
                $query .= " where c_id = ".$_POST['category'];
          }
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
