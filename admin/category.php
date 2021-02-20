<?php   include 'top.php';
        

        if (!isset($_SESSION['aname'])) {
            header("Location: login.php");
        }
 ?>


<?php 
 $label = "Add New";
    $ctitle = "";
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM category where c_id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $ctitle = $r['c_title'];
    }
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
          $query = "select * from category";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <th><?= $r['c_title'] ?></th>
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
        
        $update_query = "UPDATE category SET c_title = '$ctitle' WHERE c_id = $id ";
        echo $update_query;
        if (isset($_GET['update'])) {
            if (mysqli_query($conn,$update_query)) {
                echo "<script>alert('Category Update.')</script>";
                header("location:category.php");
             }else{
                 echo mysqli_error($conn);
             }
        }else{
            if (mysqli_query($conn,$insert_query)) {
                echo "<script>alert('Product Added.')</script>";
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
