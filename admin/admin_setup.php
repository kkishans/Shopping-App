<?php 
  include '../db/database_queries.php';
  include './top.php';

//   First time setup for admin...
  $query = "SELECT * from admin_details";
  $res = mysqli_query($conn,$query);

  if(mysqli_num_rows($res) > 0){
      header("location: ./login.php");
  }
$fname = $lname = $email  = "";
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
}

?>
<div>
    <h1 class="text-center my-3">Admin Setup</h1>
</div>
<div class="container-fluid row justify-content-center my-5">
<div class="col-md-6 card login-box">
    <div class="card-body">
        <form action="#" method="post">
            
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
            
        </div>
     </div>
</div>
<?php 

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    if($password != $cpassword){
        $passwordErr ="Passwords does not match.";       
    }
    
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
    $admin_email = 'SELECT email FROM admin_details';
    $res = mysqli_query($conn, $admin_email);
    if (mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            if ($r['email'] == $email) {
                echo "<script>alert('Already register with this email. Please provide another mail')</script>";
                return;
            }
        }
    }
    
    include '../src/VerifyEmail.class.php';
    include '../src/testEmail.php';
    
   
    if(!checkMail($email)){
        echo "<script>alert('E-mail does not not exist. please check you email address.')</script>";
        return;
    }

    $pass = md5($_POST['password']);
    $query = "INSERT INTO admin_details(fname,lname,email,`password`) VALUES('$fname','$lname','$email','$pass')";
    
    if( mysqli_query($conn,$query) ){
        $_SESSION['aname'] = $fname;
        echo "<script> window.location ='./home.php' </script>";
    }else{
        echo "<script>alert('Something went wrong. Data Not inseted. Try again.')</script>";

    }
}

?>