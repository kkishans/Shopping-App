<?php   include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }   
 ?>


<?php 
 $label = "Add New";
    $bname = "";
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM brands where b_id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $bname = $r['b_name'];
    }
?>

<div>
    <h1 class="text-center my-3"><?= $label ?> Brand</h1>
</div>
    
<div class=" d-flex align-items-center m-auto card border-0 my-3">
    <div class="card col-sm-11 col-sm-11 col-md-5 col-xl-5 col-9 ">
        <form action="" class="p-3 row" enctype="multipart/form-data" method="POST" >
            <div class="col-8 ">
                <input type="text" class="form-control" name="bname" placeholder="Brand name" value ="<?= $bname ?>"required>
            </div>
            <div class=" col-4">
                <input class="btn btn-outline-primary" type="submit" name="addBrand" value="<?= $label ?> Brand">
            </div>
        </form>   
    </div>
</div>  
<div class="card col-md-6 col-xl-6 col-sm-11 m-auto" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "SELECT count(p.b_id),b_name,b.b_id from product_details as p RIGHT JOIN brands as b on p.b_id = b.b_id group by b_name";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <th><?= $r['b_name'] ?> ( <?= $r['count(p.b_id)']?> )</th>
                <th><a href="./brand.php?update=<?= $r['b_id'] ?>" class="btn btn-outline-success"> Update</a></th>
                <th><a href="./delete.php?deleteBrand=<?= $r['b_id'] ?>" class="btn btn-outline-danger">X</a></th>
            </tr>
            <?php 

             }
            }else{
                echo "
                    <tr><p' align='center'> No Data Found.</p></tr>
                ";
            }            
            ?>
        </tbody>
    </table>
  </div>
</div>
<?php

    if (isset($_POST['addBrand'])) {
        $bname = $_POST['bname'];
       
        include '../db/db.php';        
        $insert_query = "INSERT INTO brands(b_name) values('$bname')";
        
        if (isset($_GET['update'])) {
        $update_query = "UPDATE brands SET b_name = '$bname' WHERE b_id = $id ";

            if (mysqli_query($conn,$update_query)) {
                echo "<script>window.location = './brand.php'</script>";
               

             }else{
                 echo mysqli_error($conn);
             }
        }else{
            if (mysqli_query($conn,$insert_query)) {
                echo "<script>window.location = './brand.php'</script>";
                
             }else{
                 echo mysqli_error($conn);
             }
        }
        //header("location:brand.php");

    }
?>

<?php include 'bottom.php' ?>
