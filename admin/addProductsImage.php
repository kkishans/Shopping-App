<?php include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }

    // error_reporting(0);
    $label = "Add";
    $u_file = "";
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM product_details where p_id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $u_file = $r['p_img'];
    }else if(isset($_GET['add'])){
        $id = $_GET['add'];
    }
    else{
        header('location:./product.php');
    }
?>
<div>
    <h1 class="text-center my-3"><?= $label ?> Product Images</h1>
</div>
    <div class=" d-flex align-items-center m-auto card border-0 my-3">
        <div class="card col-sm-11 col-sm-11 col-md-5 col-xl-5   col-9">
            <form action="#" class="p-3 " enctype="multipart/form-data" method="POST" >
            <?php 
                if (isset($_GET['update'])){
            ?>
                <label for="formFile" class="form-label"> Change Product Image</label>
                <div class="row">
                    <div class="col-10">
                        <input class="form-control" type="file" name="new_main_file" id="formFile" accept="image/*">
                    </div>
                    <div class="col-2">
                        <img src="<?= "../img/". $u_file ?>"  alt="product image" width="50p" height="40px">
                    </div>                    
                </div>
                
            
            <?php 
            }else{
            ?>
                <label for="formFile" class="form-label">Select Product Feature image (required):</label>
                <input class="form-control" type="file" name="main_file" id="formFile" value ="<?= $file ?>" accept="image/*" required>
            <?php
            }
            ?>
            <div class="my-3">
                <label > Select Optional Images: </label>
            </div>
            <div class="my-3">
            
                <div class="row">
                    <div class="col-6">
                        <input class="form-control" type="file" name="o_image_1" id="formFile" accept="image/*">
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="file" name="o_image_2" id="formFile" accept="image/*">
                    </div>                    
                </div>
            </div>
            <div class="my-3">
                <div class="row">
                    <div class="col-6">
                            <input class="form-control" type="file" name="o_image_3" id="formFile" accept="image/*">
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="file" name="o_image_4" id="formFile" accept="image/*">
                    </div>                    
                </div>
            </div>
            <div class="col-6 m-auto align-item-center my-3 card">
                <input class="btn btn-outline-primary" type="submit" name="addImage" value="<?= $label ?>">
            </div>
        </form>
    </div>
</div>
<?php 

    if (isset($_POST['addImage'])) {
         $img1 = $img2 = $img3 = $img4 = null; 
         $main_file = $u_file; 
        if (!isset($_GET['update'])) {
            $main_file = checkimage($_FILES['main_file'],$u_file);
        }
        if ($_FILES['o_image_1']['name'] != null) {
            $img1 = checkimage($_FILES['o_image_1'],null);  
        }
        if ($_FILES['o_image_2']['name'] != null) {
            $img2 = checkimage($_FILES['o_image_2'],null);  
        }
        if ($_FILES['o_image_3']['name'] != null) {
            $img3 = checkimage($_FILES['o_image_3'],null); 
        }
        if ($_FILES['o_image_4']['name'] != null) {
            $img4 = checkimage($_FILES['o_image_4'],null);
        }

        $update_query = "UPDATE product_details SET p_img = '$main_file', product_optional_image_1 = '$img1', product_optional_image_2 = '$img2' ,product_optional_image_3 ='$img3', product_optional_image_4 = '$img4'  where p_id = $id";

        //echo $update_query;
        
        if (mysqli_query($conn,$update_query)) {
            echo "<script>alert('Images Saved.')</script>";
        }else{
            echo mysqli_error($conn);
        }
        
    }

    function checkimage($file, $u_file)
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
                if (!move_uploaded_file($file_tmp,"../img/".$file_name)) {
                    echo "<script>alert('Error while uploading file')</script>";
                }
            } 
        }else{
            $file_name = $u_file;
        }
        return $file_name;
    }

?>