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
        $bicon = $r['b_icon'];
    }
?>

<div>
    <h1 class="text-center my-3"><?= $label ?> Brand</h1>
</div>
    
<div class=" d-flex align-items-center m-auto card border-0 my-3">
    <div class="card col-sm-11 col-sm-11 col-md-5 col-xl-7 ">
        <form action="" class="p-3 row" enctype="multipart/form-data" method="POST" >
            <div class="col-xl-6 col-sm-12  m-auto my-3 ">
                <input type="text" class="form-control" name="bname" placeholder="Brand name" value ="<?= $bname ?>"required>
            </div>
            <?php 
                if (isset($_GET['update'])){
            ?>
                <div class="col-xl-3 col-sm-12  m-auto my-3 text-center">
                <input class="btn btn-outline-primary" type="file" id="newBrandImage" name="newBrandImage" hidden>
                <label class="btn btn-outline-primary" for="newBrandImage">Select New Image</label>
            </div>
                
            
            <?php 
            }else{
            ?>
                <div class="col-xl-3 col-sm-12  m-auto my-3 text-center">
                <input class="btn btn-outline-primary" type="file" id="brandImage" name="brandImage" hidden>
                <label class="btn btn-outline-primary" for="brandImage">Select Image</label>
            </div>
            <?php
            }
            ?>
            
            <div class="col-xl-3 col-sm-12  m-auto my-3 text-center">
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
                <th>Image</th>
                <th>Brand Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "SELECT count(p.b_id),b_name,b.b_id,b_icon from product_details as p RIGHT JOIN brands as b on p.b_id = b.b_id group by b_name";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
            <td>
                <?php if ($r['b_icon'] != "") {?>
                    <img src="<?= "../upload/brand/". $r['b_icon']  ?>"  width="50p" height="40px" alt="<?= "../upload/brand/". $r['b_icon']  ?>">
                <?php }else {?>
                    No Brand Image
                <?php }?>
            </td>
                <td><?= $r['b_name'] ?> ( <?= $r['count(p.b_id)']?> )</td>
                <td><a href="./brand.php?update=<?= $r['b_id'] ?>" class="btn btn-outline-success"> Update</a></td>
                <td><a href="./delete.php?deleteBrand=<?= $r['b_id'] ?>&img=<?= $r['b_icon'] ?>" class="btn btn-outline-danger">X</a></td>
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
        $img = null;
        if(!isset($_GET['update'])){
            if ($_FILES['brandImage']['name'] != null) {
                $img = checkimage($_FILES['brandImage']);  
            }
        }

        include '../db/db.php';        
        $insert_query = "INSERT INTO brands(b_name,b_icon) values('$bname','$img')";
        
        if (isset($_GET['update'])) {
            if ($_FILES['newBrandImage']['name'] != null) {
                $img = checkimage($_FILES['newBrandImage']);  
            }else{
                $img = $bicon;
            }
        $update_query = "UPDATE brands SET b_name = '$bname', b_icon = '$img' WHERE b_id = $id ";

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

    
function checkimage($file)
    {
        if ($file != null || $file['name'] != null) {   
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];

            $file_type = explode("/",$file_type);
            $file_type = strtolower($file_type[0]);

            if($file_type != "image"){
                echo "<script>alert('Only Image file allowed.')</script>";
                return;
            }else{       
                $new_name = time()."-".rand(1000, 9999)."-".$file_name;
               
                if (!move_uploaded_file($file_tmp,"../upload/brand/".$new_name)) {
                    echo "<script>alert('Error while uploading file')</script>";
                }
            } 
        }
        return $new_name;
    }

?>

<?php include '../bottom.php' ?>
