<?php include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }
 ?>

<?php 
error_reporting(0);
 $label = "Add";
    $pname = $price = $stock = $c_id = $b_id = $desc = $u_file = "";
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM product_details where p_id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $pname = $r['p_name'];
        $price = $r['price'];
        $stock = $r['stock'];
        $c_id = $r['c_id'];
        $b_id = $r['b_id'];
        $desc = $r['description'];
        $u_file = $r['p_img'];
    }
?>

<div>
    <h1 class="text-center my-3"><?= $label ?> Product</h1>
</div>
    
<div class=" d-flex align-items-center m-auto card border-0 my-3">
    <div class="card col-sm-11 col-sm-11 col-md-5 col-xl-5   col-9">
        <form action="#" class="p-3 " enctype="multipart/form-data" method="POST" >
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="pname" placeholder="ex. laptop" 
                value ="<?= $pname ?>"  required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" placeholder="ex. Lenevo ideaPad" value ="<?= $desc ?>" required>
            </div>
            <div class="mb-3 row">
               <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" list="categories">
                    
               </div>
               <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Brand :</label>
                    <input type="text" class="form-control" name="brands" list="brands">
                    
                </div>
            </div>
            <div class="mb-3 row">
               <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="ex. 65000" value ="<?= $price ?>" required>
               </div>
               <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock" placeholder="ex. 10  " value ="<?= $stock ?>"required>
            </div>
            </div>
            <div class="mb-3">
            <?php 
                if (isset($_GET['update'])){
            ?>
                <label for="formFile" class="form-label"> Change Product Image</label>
                <div class="row">
                    <div class="col-10">
                        <input class="form-control" type="file" name="new_file" id="formFile">
                    </div>
                    <div class="col-2">
                        <img src="<?= "../img/". $u_file ?>"  alt="product image" width="50p" height="40px">
                    </div>                    
                </div>
            </div>
            <?php 
            }else{
            ?>
                <label for="formFile" class="form-label">Product Image</label>
                <input class="form-control" type="file" name="file" id="formFile" value ="<?= $file ?>" required>
            <?php
            }
            ?>
            <div class="col-6 m-auto align-item-center my-3 card">
                <input class="btn btn-outline-primary" type="submit" name="add" value="<?= $label ?> Product">
            </div>
        </form>   
    </div>
</div>  

<?php

    if (isset($_POST['add'])) {
        $pname = $_POST['pname'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        global $brand,$category;
        $desc = $_POST['description'];

        //get category id..
        $query = "SELECT * from category where c_title = '".$_POST['category']."'";
        $res = mysqli_query($conn,$query);

        if (mysqli_num_rows($res) == 0) {
            $query = "INSERT into category(c_title) values('".$_POST['category']."')";
            $res = mysqli_query($conn,$query);
        }
        $query = "SELECT * from category where c_title ='".$_POST['category']."'";
        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $category =(int) $r['c_id'];
            
                

        //get brand id...
        $query = "SELECT * from brands  where b_name = '".$_POST['brands']."'";
        $res = mysqli_query($conn,$query);

        if (mysqli_num_rows($res) == 0) {
            $query = "INSERT into brands(b_name) values('".$_POST['brands']."')";
            $res = mysqli_query($conn,$query);
        }
        
        $query = "SELECT * from brands where b_name = '".$_POST['brands']."'";
        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $brand =(int)$r['b_id'];
          
        



        if (isset($_GET['update'])) {
            $file = $_FILES['new_file'];
        }else{
            $file = $_FILES['file'];
        }
        if ($_FILES['new_file']['name'] != null || $_FILES['file']['name'] != null) {   
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_error = $file['error'];
            $file_type = $file['type'];

            $file_type = explode("/",$file_type);
            $file_type = strtolower($file_type[0]);

            if($file_type != "image"){
                echo "<script>alert('Only Image file allowed.')</script>";
                return;
            }else{                
                if (!move_uploaded_file($file_tmp,"../img/".$file_name)) {
                    echo "<script>alert('Error while uploading file')</script>";
                    return;
                }
            } 
        }else{
            $file_name = $u_file;
        }
        $insert_query = "INSERT INTO product_details(p_name,description,price,stock,c_id,b_id,p_img) values('$pname','$desc',$price,$stock,$category,$brand,'$file_name')";
        
        $update_query = "UPDATE product_details SET p_name = '$pname', description = '$desc',price = $price, stock = $stock,c_id = $category , b_id= $brand, p_img = '$file_name'  where p_id = $id";

        if (isset($_GET['update'])) {
            if (mysqli_query($conn,$update_query)) {
                echo "<script>alert('Product Update.')</script>";
                //header("location:home.php");
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
<datalist id="categories" >
                    <?php 
                        include '../db/db.php';
                        $query = "select * from category";

                        $result = mysqli_query($conn,$query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while($r = mysqli_fetch_assoc($result)){
                                //$s = ($c_id == $r["c_id"]) ? "selected" : "";
                                echo "<option value='". $r["c_title"]."' /> ";
                            }
                        }
                        ?>
</datalist>
<datalist id="brands" >
                    <?php 
                        include '../db/db.php';
                        $query = "select * from brands";

                        $result = mysqli_query($conn,$query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while($r = mysqli_fetch_assoc($result)){
                                //$s = ($b_id == $r["b_id"]) ? "selected" : "";
                                echo "<option value='". $r["b_name"]."' /> ";
                            }
                        }
                        ?>
                    </datalist>
<?php include 'bottom.php' ?>