<?php   include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }   
 ?>

<?php 
 $label = "Add";
    $key = "";
    $value = "";
   
    $pid = $_GET['pid'];
   
    if (isset($_GET['update_product'])) {
        $label = "Update";
    }
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM product_description where id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $key = $r['spec_key'];
        $value = $r['value'];

    }
?>

<div>
    <h1 class="text-center my-3"><?= $label ?> Specification</h1>
</div>
    
<div class=" d-flex align-items-center m-auto card border-0 my-3">
    <div class="card col-sm-11 col-sm-11 col-md-6 col-xl-6 col-9">
        <form action="" class="p-3 row" enctype="multipart/form-data" method="POST" >
            <div class="col-4 ">
                <input type="text" class="form-control" name="spec_key" placeholder="Key" value="<?= $key ?>" required>
            </div>
            <div class="col-4 ">
                <input type="text" class="form-control" name="value" placeholder="Value" value="<?= $value ?>" required>
            </div>
            <div class="col-4">
                <input class="btn btn-outline-primary" type="submit" name="addSpecification" value="<?= $label ?> Specification" />
            </div>
        </form>   
    </div>
</div>  
<div class="card col-md-6 col-xl-6 col-sm-11 m-auto" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "SELECT * from product_description where p_id = $pid ";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <th><?= $r['spec_key'] ?></th>
                <th><?= $r['value'] ?></th>
                <th><a href="./specification.php?pid=<?= $r['p_id'] ?>&&update=<?= $r['id'] ?>" class="btn btn-outline-success"> Update</a></th>
                <th><a href="./delete.php?pid=<?= $r['p_id'] ?>&&deleteSpecification=<?= $r['id'] ?>" class="btn btn-outline-danger">X</a></th>
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
     if (isset($_GET['update_product'])) {
?>
<div class="container-fluid row justify-content-md-center mt-3">
    <div class="col-md-6 text-center">
        <a href="./addProductsImage.php?update=<?= $pid ?>" class="btn btn-primary"><?= $label ?> and Next</a>    
    </div>
</div>
<?php
     }else{
?>
<div class="container-fluid row justify-content-md-center mt-3">
    <div class="col-md-6 text-center">
        <a href="./addProductsImage.php?add=<?= $pid ?>" class="btn btn-primary"><?= $label ?> and Next</a>    
    </div>
</div>
<?php
     }
?>
<?php

    if (isset($_POST['addSpecification'])) {
        $key = $_POST['spec_key'];
        $value = $_POST['value'];
        $pid = $_GET['pid'];
       
        include '../db/db.php';        
        $insert_query = "INSERT INTO product_description(`p_id`,`spec_key`,`value`) values($pid,'$key','$value')";
        
        if (isset($_GET['update'])) {
            $update_query = "UPDATE product_description SET `spec_key` = '$key', `value` = '$value' WHERE id = $id ";

            if (mysqli_query($conn,$update_query)) {
                echo "<script>window.location = './specification.php?pid=".$pid."'</script>";
             }else{
                 echo mysqli_error($conn);
             }
        }else{

            if (mysqli_query($conn,$insert_query)) {
                // echo "<script>location.reload()</script>";
                echo "<script>window.location.href = './delete.php?specification=".$pid."</script>";
             }else{
                 echo mysqli_error($conn);
             }
        }
        //header("location:brand.php");

    }
?>

<?php include 'bottom.php' ?>
