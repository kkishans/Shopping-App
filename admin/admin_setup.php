<?php 
  include '../db/db.php';
  include './top.php';

  //First time setup for admin...
  $query = "SELECT * from admin_details";
  $res = mysqli_query($conn,$query);

  if(mysqli_num_rows($res) > 0){
      header("location: ./login.php");
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
            
        </div>
     </div>
</div>
<?php 

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $query = "INSERT INTO admin_details(fname,lname,email,`password`) VALUES('$fname','$lname','$email','$pass')";
    

    if( mysqli_query($conn,$query) ){
        //$_SESSION['username'] = $fname;
        echo "<script> window.location ='./login.php' </script>";
    }else{
        echo "<script>alert('Something went wrong. Data Not inseted. Try again.')</script>";

    }
}

?>