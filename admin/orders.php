<?php   
    include '../db/db.php';
    include 'top.php';
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }
 ?>
<div>
    <h1 class="text-center my-3"> All Orders</h1>
</div>

<div class="align-items-center text-center card border-0">
<form action="#" method="post">
<div class="d-flex just-content-center row">
        <div class="col-md-6 col-xl-6 col-sm-3 m-3">
        <?php
            if (isset($_POST['filterdate'])) {
               $date = $_POST['filterdate'];
            }else{
                $date = date('d-m-Y');
             }
        ?>
            <input type="date"  id="datepicker"  name="filterdate" class="form-control col-md-6" value="<?= date('Y-m-d')?>">

        </div>
        <div class="col-md-5 col-xl-3 col-sm-3 m-3">
            <input type="submit" name="submit" class="btn btn-success" value="Filter">
        </div>
        
    </div>
</form>
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
         
         $order_query = "SELECT O.o_id o_id, f_name,l_name, p_name , ordered_at , status FROM ordered_products AS OP, order_details AS O, users AS U, product_details  AS P WHERE  O.o_id = OP.o_id AND O.u_id = U.u_id AND OP.o_id = O.o_id AND P.p_id = OP.p_id AND DATE_FORMAT(ordered_at, '%Y-%m-%d') =  '$date'";
         $res = mysqli_query($conn,$order_query);
          if (mysqli_num_rows($res) > 0) {
             while($r = mysqli_fetch_assoc($res)){           

                ?>
            <tr>
                <th><?= $r['o_id'] ?></th>
                <th><?= $r['f_name']." ".$r['l_name'] ?> </th>
                <th><?= $r['p_name'] ?></th>
                <th><?= $r['ordered_at'] ?></th>
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
                    <tr><p' align='center'> No Data Found On This Date</p></tr>
                ";
            }    
            echo mysqli_error($conn)   ;     
            ?>
        </tbody>
    </table>
  </div>
</div>

<?php include 'bottom.php' ?>
