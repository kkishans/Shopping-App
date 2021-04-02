<?php 
  include './top.php';
  include '../db/db.php';
    if (isset($_SESSION['useremail'] )) {
        echo "<script> window.location ='./cart.php' </script>";
    }
?>

<div>
    <h1 class="text-center my-3">User Login</h1>
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
        <br>
        <div class="row m-auto col-10">
               <a href="./userRegistration.php" class="btn col-md-5 col-sm-11 btn-light m-auto">               
                    New Registration?
                </a>
                <button type="button" class="btn mt-2 col-md-5 col-sm-11 btn-light  m-auto" data-toggle="modal" data-target="#resetPassword">
                    Forgot Password?
                </button>
                  
        </div>
    </div>
</div>
</div>
 
</form>

</div>
<?php 
    
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "select * from users where email = '$email' and pass = '".md5($password)."'";

    $res = mysqli_query($conn,$query);

    if( mysqli_num_rows($res) > 0 ){
        $r = mysqli_fetch_assoc($res);
        $_SESSION['useremail'] = $r['email'];

         //get user id from the session...
         $query = "SELECT u_id FROM users where email = '". $_SESSION['useremail'] ."'";
         $res = mysqli_query($conn,$query);
         $r = mysqli_fetch_assoc($res);
         $u_id = $r['u_id'];

        //session data adding in user cart...

        if (isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $k => $v){
                $query = "INSERT into cart_details(p_id,u_id,qty,is_in_cart) values('". $v['id'] ."' ,$u_id,".$v['qty'].",'y')";
                $res = mysqli_query($conn,$query);

                if ($res) {
                    //echo "<script>alert('Item added in cart. Please click on order button again.')</script>";
                    echo "<script> window.location ='./cart.php' </script>";
                }
                     
            }
            session_unset($_SESSION['cart']);
        }

        header("Location: cart.php");
    }else{
        echo "<script>alert('Invalid username and Password.')</script>";
    }
}

?>
<?php include '../bottom.php' ?>