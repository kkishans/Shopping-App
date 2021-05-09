<?php 
  include '../db/database_queries.php';
  include './top.php';

    $sql = "SELECT * FROM admin_details WHERE fname = '".$_SESSION['aname']. "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if(isset($row)){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $admin_photo = $row['admin_photo'];
        $fname = $row['fname'];
        $facebook = $row['facebook_link'];
        $insta = $row['insta_link'];
        $twitter = $row['twitter_link'];
        $youtube = $row['youtube_link'];
    }
    mysqli_error($conn);
?>
<div>
    <h1 class="text-center my-3">Admin Details Update</h1>
</div>
<div class="container-fluid row justify-content-center my-5">
<div class="col-md-6 card login-box">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="row justify-content-center">
                <div class="row  col-md-10 m-3">
                   <div class="col-6">
                    <input type="text" name="fname" class="form-control col-md-6" placeholder="First Name" value="<?= $fname?>" required autofocus>
                   </div>
                   <div class="col-6">
                        <input type="text" name="lname" class="form-control col-md-6" placeholder= "Last Name" value="<?= $lname?>" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <input type="email" name="email" class="form-control col-md-6" placeholder="Email" value="<?= $email?>" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   
                <?php 
                if ($admin_photo){
                    ?>
                        <label for="formFile" class="form-label"> Admin Photo</label>
                        <div class="row">
                            <div class="col-10">
                                <input class="form-control" type="file" name="admin_photo" id="formFile" accept="image/*">
                            </div>
                            <div class="col-2">
                                <img src="<?= "../img/". $admin_photo ?>"  alt="product image" width="50p" height="40px">
                            </div>                    
                        </div>
                        
                    
                    <?php 
                    }else{
                    ?>
                        <label for="formFile" class="form-label"> Admin Photo</label>
                        <input class="form-control" type="file" name="admin_photo" id="formFile"  accept="image/*" required>
                    <?php
                    }
                    ?>           
                </div>                            
                <div class="row col-md-10 m-3">
                <label for="admin_photo" class="m-1 ">Social Media Links : <br> (These are optional, leave it blank if you haven't any of them.)</label>

                    <div class="my-2">
                        <input type="text" name="facebook_link" class="form-control col-md-6" placeholder="Facebook account URL" value="<?= $facebook ?>" >
                    </div>
                    <div class=" my-2">
                        <input type="text" name="insta_link" class="form-control col-md-6" placeholder="Instagram account URL" value="<?= $insta ?>" >
                    </div>
                    <div class=" my-2">
                        <input type="text" name="twitter_link" class="form-control col-md-6" placeholder="Twitter account URL" value="<?= $twitter ?>" >
                    </div>
                    <div class=" my-2">
                        <input type="text" name="youtube_link" class="form-control col-md-6" placeholder="YouTube Channel URL" value="<?= $youtube ?>">
                    </div>
                </div>
                <div class="col-md-10">
                    <span id="error" class="error"></span>
                </div>
                <div class="row col-md-9 m-3 ">
                    <input type="submit" class="btn btn-success" name="submit" value="Update Details"/>
                </div>
            </div>
        </form>
        <br>
            
        </div>
     </div>
</div>
<?php 

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $facebook =  $_POST["facebook_link"];
    $insta =  $_POST["insta_link"];
    $twitter =  $_POST["twitter_link"];
    $youtube =  $_POST["youtube_link"];
    
         
    if ($_FILES['admin_photo']['name'] != null) {
        $img = checkimage($_FILES['admin_photo']);  
    }else{  
        $img = $admin_photo;
    }
    
    $query = "UPDATE admin_details SET
        `fname` = '$fname' ,
        `lname` = '$lname',
        `email` = '$email',
        `admin_photo` = '$img' ,
        `facebook_link` =  '$facebook',
        `insta_link` = '$insta',
        `twitter_link` = '$twitter',
        `youtube_link` = '$youtube' WHERE `fname` = '" .$_SESSION['aname']. "'";
    
    if( mysqli_query($conn,$query) ){
        $_SESSION['aname'] = $fname;
        echo "<script> alert('Details are updated.'); window.location = 'myprofile.php' </script>";
    }else{
        echo "<script>alert('Something went wrong. Data Not inseted. Try again.')</script>";

    }
    echo mysqli_error($conn);
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
                if (!move_uploaded_file($file_tmp,"../img/".$file_name)) {
                    echo "<script>alert('Error while uploading file')</script>";
                }
            } 
        }
        return $file_name;
    }

?>
<div class="pt-5"></div>
<?php include '../bottom.php'; ?>