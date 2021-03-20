<?php   include 'top.php';
        

        if (!isset($_SESSION['aname'])) {
            header("Location: login.php");
        }
 ?>


<?php 
 $label = "Add New";
    $ctitle = "";
    global $id;
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM category where c_id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $ctitle = $r['c_title'];
    }
?>

<?php
    // $countquery = "SELECT count(*),c_title,c.c_id from product_details as p, category as c where p.c_id = c.c_id group by c_title";
    // $countRes = mysqli_query($conn,$countquery);
    // while($r = mysqli_fetch_assoc($countRes)){
    //     echo $r['c_title'] ."->".$r['count(*)'] ."->".$r['c_id'];
    // }
?>

<div>
    <h1 class="text-center my-3"><?= $label ?> Category</h1>
</div>
    
<div class=" d-flex align-items-center m-auto card border-0 my-3">
    <div class="card col-sm-11 col-sm-11 col-md-5 col-xl-5 col-9 ">
        <form class="p-3 row" enctype="multipart/form-data" method="POST" >
            <div class="col-8 ">
                <input type="text" class="form-control" id="ctitle" name="ctitle" placeholder="Category name"  value ="<?= $ctitle ?>" required>
            </div>
            <div class=" col-4">
                <input class="btn btn-outline-primary" type="submit" name="addCategory" value="<?= $label ?> Category">
            </div>
        </form>   
    </div>
</div>  
<div class="card col-md-6 col-xl-6 col-sm-11 m-auto" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Category Title</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "SELECT count(p.c_id),c_title,c.c_id from product_details as p RIGHT JOIN category as c on p.c_id = c.c_id group by c_title";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <th><?= $r['c_title'] ?> ( <?= $r['count(p.c_id)']?> )</th>
                <th><a href="./category.php?update=<?= $r['c_id'] ?>" class="btn btn-outline-success"> Update</a></th>
                <th><a href="./delete.php?deleteCategory=<?= $r['c_id'] ?>" class="btn btn-outline-danger">X</a></th>
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

    if (isset($_POST['addCategory'])) {
        $ctitle = $_POST['ctitle'];
       
        include '../db/db.php';        
        $insert_query = "INSERT INTO category(c_title) values('$ctitle')";
        
        if (isset($_GET['update'])) {
        $update_query = "UPDATE category SET c_title = '$ctitle' WHERE c_id = $id ";

            if (mysqli_query($conn,$update_query)) {
                echo "<script>window.location = './category.php'</script>";
                
             }else{
                 echo mysqli_error($conn);
             }
        }else{
            if (mysqli_query($conn,$insert_query)) {
                echo "<script>window.location = './category.php'</script>";
             }else{
                 echo mysqli_error($conn);
             }
        }

    }
?>
<script>
    document.getElementById('ctitle').focus();
</script>
<?php include 'bottom.php' ?>
