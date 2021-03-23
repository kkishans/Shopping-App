<?php 
    include "top.php";
    
    if(isset($_SESSION['aname'])) {
        header("Location: ./dashboard.php");
    }

    //First time setup for admin...
    $query = "SELECT * from admin_details";
    $res = mysqli_query($conn,$query);

    if(mysqli_num_rows($res) == 0){
        header("location: admin_setup.php");
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

        <div class="row justify-content-end">
                <button type="button" class="btn col-md-4 btn-light" data-toggle="modal" data-target="#resetPassword">
                    Forgot Password?
                </button>
                <div class="col-md-1 col-sm-1 m-1"></div>    
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reset Password</h5>
        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size:20px">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" method="post">
                <div class="row justify-content-center">
                    <div class="col-md-12 m-3">
                        <input type="text" name="resetEmail" class="form-control col-md-6" placeholder="Email" required autofocus>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="sendOtp" class="btn btn-primary">Send OTP</button>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>


<?php
    
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 
      
    require '../vendor/autoload.php'; 


    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = "select * from admin_details where email = '$email' and password = '". md5($password) ."'" ;
        
       
        $res = mysqli_query($conn,$query);
        if( mysqli_num_rows($res) > 0 ){
            $r = mysqli_fetch_assoc($res);
            $_SESSION['aname'] = $r['fname'];
            header("Location: dashboard.php");
        }
        else{
            echo "<script>alert('Invalid username and Password.')</script>";
        }
    }

    if (isset($_POST['sendOtp'])) {

        $to = $_POST['resetEmail'] ;

        $query = "select * from admin_details where email = '$to'";
        $result = mysqli_query($conn,$query);

        if (mysqli_num_rows($result) > 0 ) {
            $otp = rand(1000,9999);
            $mail = new PHPMailer(true); 
            
            
            try { 
                $mail->SMTPDebug = 0;                                        
                $mail->isSMTP();                                             
                $mail->Host       = 'smtp.gmail.com;';                     
                $mail->SMTPAuth   = true;                              
                $mail->Username   = $from;                  
                $mail->Password   = $password;                                                       
                $mail->Port       = 587;   
            
                $mail->setFrom($from, $fromName);            
                $mail->addAddress($to); 
                
                $mail->isHTML(true);                                   
                $mail->Subject = 'Reset Password'; 
                $mail->Body    = "Your reset password OTP is <b>$otp</b> <br> OTP is expire within 5 minutes"; 
                $mail->send(); 
                
                setcookie("email",$to,time()+(60*5));
                setcookie("otp" , $otp , time()+(60 * 5));
                header("Location: reset_password.php");
            } catch (Exception $e) { 
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
            } 
        }
        else{
            echo "<h3 style='text-align:center'>No such email found...</h3>";
        }
    }
?>
<?php include 'bottom.php' ?>