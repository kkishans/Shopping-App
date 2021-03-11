<?php 
  include '../db/db.php';
  include './top.php';
  if (isset($_SESSION['useremail'] )) {
    echo "<script> window.location ='./dashboard.php' </script>";
    }

    $fname = $lname = $email = $address = $phone = "";
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
    }

?>
<div>
    <h1 class="text-center my-3">User Registration</h1>
</div>
<div class="container-fluid row justify-content-center my-5">
<div class="col-md-6 card login-box">
    <div class="card-body">
        <form action="#" method="post">
            
            <div class="row justify-content-center">
                <div class="row  col-md-10 m-3">
                   <div class="col-6">
                    <input type="text" name="fname" class="form-control col-md-6" placeholder="First Name"   value="<?= $fname?>"
                    required autofocus>
                   </div>
                   <div class="col-6">
                        <input type="text" name="lname" class="form-control col-md-6" placeholder= "Last Name"  value="<?= $lname?>" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <input type="email" name="email" class="form-control col-md-6" placeholder="Email"  value="<?= $email?>" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <input type="text" name="phone" class="form-control col-md-6" placeholder="Phone Number"  value="<?= $phone?>" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <textarea type="text" name="address" cols="3" class="form-control col-md-6" placeholder="Enter you address..." required ><?= $address ?></textarea>
                   </div>
                </div>                
                <div class="row col-md-10 m-1">
                    <label for="pass">Note: Password Must be minimum length  8 and contain alphabet (uppercase and lowercase both) and number</label>
                </div>
                <div class="row col-md-10 m-3">
                    <div>
                        <input type="password" name="password" class="form-control col-md-6" placeholder="Password" required >
                    </div>
                </div>
                <div class="row col-md-10 m-3">
                    <div>
                        <input type="password" name="cpassword" class="form-control col-md-6" placeholder="Confirmed Password" required >
                    </div>
                </div>
                <div class="col-md-10">
                    <span id="error" class="error"></span>
                </div>
                <div class="row col-md-9 m-3 ">
                    <input type="submit" class="btn btn-success" name="submit" value="Submit Form"/>
                </div>
            </div>
        </form>
        <br>
            <div class="row m-auto col-10 ">
               <a href="./userLogin.php" class="btn col-md-5 col-sm-11 m-auto">               
                  Login Page
                </a>                
            </div>
        </div>
     </div>
</div>
<?php 

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['cpassword'];

    if (!preg_match("/^[0-9]{10}+$/", $phone)) {
        echo "<script>alert('Invlid mobile number. Please check your mobile number.')</script>";
        return;
    }
    $user_email = 'SELECT email FROM users';
    $res = mysqli_query($conn, $user_email);
    if (mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            if ($r['email'] == $email) {
                echo "<script>alert('Already register with this email. Please provide another mail')</script>";
                return;
            }
        }
    }
    if($pass != $pass2){
        $passwordErr ="Passwords does not match.";       
    }

    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    if (strlen($_POST["password"]) <= 8) {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    } else {
        $cpasswordErr = "Please Check You have Entered Or Confirmed Your Password!";
    }
    if (isset($passwordErr)) {
        echo "<script>alert('$passwordErr');</script>";
        return;
    }
    // include '../src/VerifyEmail.class.php';
    // include '../src/testEmail.php';
    
   
    // if(!checkMail($email)){
    //     echo "<script>alert('E-mail does not not exist. please check you email address.')</script>";
    //     return;
    // }
    
    $pass = md5($password);
    $query = "INSERT INTO users(f_name,l_name,email,phone,address,pass) VALUES('$fname','$lname','$email','$phone','$address','$pass')";
    

    if( mysqli_query($conn,$query) ){
        $_SESSION['username'] = $fname;
        $_SESSION['useremail'] = $email;
       echo "<script> window.location ='./cart.php' </script>";
    }else{
        echo "<script> alert('Something went wrong. Data Not inseted. Try again.') </script>";    
    }
}

?>