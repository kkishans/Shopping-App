<?php   
    include '../db/db.php';
    include 'top.php';
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 6;
    $offset = ($pageno-1) * $no_of_records_per_page; 

    $total_pages_sql = "SELECT COUNT(*) FROM ordered_products";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

 ?>
<div>
    <h1 class="text-center my-3"> All Orders</h1>
</div>
    
<div class="card col-md-10 col-xl-10 col-sm-11 m-auto" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Order Id</th>
                <th>User Name</th>
                <th>Product Name</th>
                <th>Order At</th>
                
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php 
         $query = "SELECT * FROM ordered_products LIMIT $offset, $no_of_records_per_page";
         $res = mysqli_query($conn,$query);
          if (mysqli_num_rows($res) > 0) {
             while($r = mysqli_fetch_assoc($res)){
                $order_query = "SELECT * FROM order_details WHERE o_id = ".$r['o_id'] ;
                $res1 = mysqli_query($conn,$order_query);
                $o = mysqli_fetch_assoc($res1);
                $user_query = "SELECT * FROM users WHERE u_id = ".$o['u_id'] ;
                $res2 = mysqli_query($conn,$user_query);
                $u = mysqli_fetch_assoc($res2);
                $product_query = "SELECT * FROM product_details WHERE p_id = ".$r['p_id'] ;
                $res3 = mysqli_query($conn,$product_query);
                $p = mysqli_fetch_assoc($res3);
        ?>
            <tr>
                <th><?= $r['id'] ?></th>
                <th><?= $u['f_name']." ".$u['l_name'] ?> </th>
                <th><?= $p['p_name'] ?></th>
                <th><?= $o['ordered_at'] ?></th>
                
                <?php if($r['status'] == "Not Delivered") {   ?>
                <th><a href="./delete.php?productDelivered=<?= $r['o_id'] ?>&productId=<?= $r['p_id'] ?>" class="btn btn-success">Not Delivered</a></th>
                <?php  }else{ ?>
                    <th><a href="#" class="btn disable">Delivered</a></th>
                <?php  } ?>
            </tr>
            <?php 

             }
            }else{
                echo "
                    <tr><p' align='center'> No Data Found.</p></tr>
                ";
            }    
            echo mysqli_error($conn)   ;     
            ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-around">
        
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"   tabindex="-1">Previous</a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link " href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" >Next</a>
        </li>
    </ul>
</nav>

  </div>
</div>

<?php include 'bottom.php' ?>
