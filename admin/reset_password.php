<?php include "top.php"; ?>
<div class="container">
    <h1 class="text-center mt-5">Reset Password</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group m-3">
                            <input type="text" name="otp" class="form-control-plaintext" value="<?= $_COOKIE['email']?>">
                        </div>
                        <div class="form-group m-3">
                            <input type="text" name="otp" class="form-control" placeholder="OTP">
                        </div>
                        <div class="form-group m-3">
                            <input type="password" name="password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form-group m-3">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="form-group m-3 text-center">
                            <input type="submit" name="update" class="btn btn-success" value="Update" placeholder="Confirm Password">
                        </div>


                        <?php
                            require("../db/db.php");
                            if (isset($_POST['update'])) {
                                $email = $_COOKIE['email'];
                                $otp = $_POST['otp'];
                                $password = $_POST['password'];
                                $confirmPassword = $_POST['confirm_password'];

                                if( $otp == $_COOKIE['otp'] && $password == $confirmPassword ){
                                    $query = "update admin_details set password = '".md5($password)."' where email =  '$email'";

                                    $res = mysqli_query($conn,$query);

                                    if ($res) {
                                        header("Location: login.php");
                                    }
                                    else{
                                        if ($otp != $_COOKIE['otp'] ) {
                                            echo "Invalid OTP";
                                        }
                                        else if ($password != $confirmPassword ) {
                                            echo "Password and confirm password not match...";
                                        }
                                    }
                                }
                            }
                        ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "bottom.php"; ?>
