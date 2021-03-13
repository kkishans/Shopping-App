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
    <h1 class="text-center my-3">User Info</h1>
</div>

<div class="card col-11 m-auto mt-5" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>User Name</th>
                <th>E-mail</th>
                <th>No. of Product Ordered</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "select * from users LIMIT $offset, $no_of_records_per_page";
          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){
                $o_query = "SELECT count(O.o_id) as o_no FROM order_details AS O ,  ordered_products AS OP WHERE O.o_id = OP.o_id AND O.u_id = ". $r['u_id'];
                $o_no = mysqli_fetch_assoc(mysqli_query($conn, $o_query))['o_no'];
                echo mysqli_error($conn);
        ?>
            <tr>
                <th><?= $r['f_name'] ?>  <?= $r['l_name']?></th>
                <th><?= $r['email'] ?></th>
                <th><?= $o_no ?></th>
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


<?php include 'bottom.php' ?>
