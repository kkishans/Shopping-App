<?php 
    include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 5;
    if (isset($_COOKIE['RecPerPage'])) {
        $no_of_records_per_page = $_COOKIE['RecPerPage'];
    }
    
    $offset = ($pageno-1) * $no_of_records_per_page; 

    $total_pages_sql = "SELECT COUNT(*) FROM product_details";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

?>

<?php
    
    if (isset($_POST['applyRecPerPage'])) {
        $p = $_POST['recPerPage'];
        setcookie("RecPerPage","$p",time()+3600*24*365);
        echo "<script>window.location = './home.php'</script>";
    }

?>
<div>
    <h1 class="text-center my-3"> All Products</h1>
</div>
<div class="align-items-center text-center card border-0">
    <form action="#" method="post">
        <div class="d-flex just-content-center row">
            <div class=" col-md-3 col-sm-3  col-xl-4 mt-3 ">
                <label class="form-label">Category :</label>
            </div>
            <div class=" col-md-5 col-sm-5  col-xl-4 mt-3 ">           
               
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
                <th>Price</th>
                <th>Stock</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "select * from product_details LIMIT $offset, $no_of_records_per_page";
          if (isset($_POST['category'])) {
              if( $_POST['category'] != '0')
                $query = "select * from product_details  where c_id = ".$_POST['category']." LIMIT $offset, $no_of_records_per_page";
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
    <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-around">
        
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"   tabindex="-1">Previous</a>
        </li>
        <li class="page-item">
            <form action="" method="post">

                <input type="number" name="recPerPage" class="from-control txt"  min="1"  value="<?= $no_of_records_per_page ?>">

                <input type="submit" class="btn btn-light" value="Apply" name="applyRecPerPage">
            </form>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link " href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" >Next</a>
        </li>
    </ul>
</nav>
  </div>
</div>


<?php include '../bottom.php' ?>
