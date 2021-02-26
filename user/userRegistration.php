<?php 
  include '../db/db.php';
  include './top.php';
  if (isset($_SESSION['useremail'] )) {
    echo "<script> window.location ='./dashboard.php' </script>";
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
                    <input type="text" name="fname" class="form-control col-md-6" placeholder="First Name" required autofocus>
                   </div>
                   <div class="col-6">
                        <input type="text" name="lname" class="form-control col-md-6" placeholder= "Last Name" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <input type="email" name="email" class="form-control col-md-6" placeholder="Email" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <input type="text" name="phone" class="form-control col-md-6" placeholder="Phone Number" required >
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                   <div>
                     <textarea type="text" name="address" cols="3" class="form-control col-md-6" placeholder="Enter you address..." required ></textarea>
                   </div>
                </div>
                <div class="row col-md-10 m-3">
                    <div>
                        <input type="password" name="password" class="form-control col-md-6" placeholder="Password" required >
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

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $query = "INSERT INTO users(f_name,l_name,email,phone,address,pass) VALUES('$fname','$lname','$email','$phone','$address','$pass')";
    

    if( mysqli_query($conn,$query) ){
        $_SESSION['username'] = $fname;
       echo "<script> window.location ='./dashboard.php' </script>";
    }else{
        echo "<script>alert('Something went wrong. Data Not inseted. Try again.')</script>";

    }
}

?>