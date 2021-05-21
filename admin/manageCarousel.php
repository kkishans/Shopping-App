<?php include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }

    // error_reporting(0);
?>
<div>
    <h1 class="text-center my-3"> Upload Images For Carousel</h1>
</div>
    <div class=" d-flex align-items-center m-auto card border-0 my-3">
        <div class="card col-sm-11 col-md-10 col-xl-5   col-9">
            <form action="#" class="p-3 " enctype="multipart/form-data" method="POST" >
            <div class="my-3">
                <label > Select Four Images: </label>
            </div>
            <div class="my-3">
            
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-11 my-3">
                        Frist Image :
                        <input class="form-control" type="file" name="o_image_1" id="formFile" accept="image/*">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-11 my-3">
                        Second Image :
                        <input class="form-control" type="file" name="o_image_2" id="formFile" accept="image/*">
                    </div>                    
                </div>
            </div>
            <div class="my-3">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-11 my-3">
                            Third Image:
                            <input class="form-control" type="file" name="o_image_3" id="formFile" accept="image/*">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-11 my-3">
                        Forth Image:
                        <input class="form-control" type="file" name="o_image_4" id="formFile" accept="image/*">
                    </div>                    
                </div>
            </div>
            <div class="col-6 m-auto align-item-center my-3 card">
                <input class="btn btn-outline-primary" type="submit" name="addImage" value="Update my carousel">
            </div>
        </form>
    </div>
</div>
<?php include '../bottom.php' ?>
<?php 

    if (isset($_POST['addImage'])) {
       
          
        if ($_FILES['o_image_1']['name'] != null) {
            $img1 = checkimage($_FILES['o_image_1'],"carousal-img-1.jpg");  
        }
        if ($_FILES['o_image_2']['name'] != null) {
            $img2 = checkimage($_FILES['o_image_2'],"carousal-img-2.jpg");  
        }
        if ($_FILES['o_image_3']['name'] != null) {
            $img3 = checkimage($_FILES['o_image_3'],"carousal-img-3.jpg"); 
        }
        if ($_FILES['o_image_4']['name'] != null) {
            $img4 = checkimage($_FILES['o_image_4'],"carousal-img-4.jpg");
        }


        echo "<script>alert('Selected Image Updated.')</script>";
        
        
    }

    function checkimage($file,$new_name)
    {
        if ($file != null || $file['name'] != null) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];
            $file_type = explode("/",$file_type);
            $file_type = strtolower($file_type[0]);
            
            $explodeName = explode(".", $new_name); 
            $name = strtolower($explodeName[0]);

            
            if($file_type != "image"){
                echo "<script>alert('Only Image file allowed.')</script>";
                return;
            }else{
                if (file_exists("../upload/carousel/".$name.".jpg")) {
                    unlink("../upload/carousel/".$name.".jpg");
                } 
                if (!move_uploaded_file($file_tmp,"../upload/carousel/".$name.".jpg")) {
                    echo "<script>alert('Error while uploading file')</script>";
                    echo error_get_last();
                }
            } 
        }
    }

?>