<?php 
    include "top.php";
    
    if(isset($_SESSION['aname'])) {
        header("Location: home.php");
    }
?>

<div>
    <h1 class="text-center my-3">Admin Login</h1>
</div>
<div class="container-fluid row justify-content-center mt-5">
<div class="col-md-6 card login-box">
    <div class="card-body">
        <form action="" method="post">
            
            <div class="row justify-content-center">
                <div class="col-md-10 m-3">
                    <input type="text" name="email" class="form-control col-md-6" placeholder="Email" required autofocus>
                </div>
                <div class="col-md-10 m-3">
                    <input type="password" name="password" class="form-control col-md-6" placeholder="Password" required >
                </div>
                <div class="col-md-10">
                    <span id="error" class="error"></span>
                </div>
                <div class="row col-md-10 m-3 ">
                    <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php
    
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = "select * from admin_details where email = '$email' and password = '$password'";

        $res = mysqli_query($conn,$query);

        if( mysqli_num_rows($res) > 0 ){
            $r = mysqli_fetch_assoc($res);
            $_SESSION['aname'] = $r['fname'];
            header("Location: home.php");
        }
    }
?>
<?php include 'bottom.php' ?>
