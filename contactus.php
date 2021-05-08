<?php 
    include './top.php';
?>

<?php
    $query = "SELECT admin_photo from admin_details";
    $res = mysqli_query($conn,$query);

    if (mysqli_num_rows($res)) {
        $data = mysqli_fetch_assoc($res);
        $admin_photo = $data['admin_photo'];
    }
?>

<div class="card col-md-8 col-xl-7 col-sm-10 m-auto p-4 mt-5 ">
    
   <div class="row">
        <div class="col-md-5 col-xl-5 col-sm-11 pl-5 ">
            <img src="./img/<?= $admin_photo ?>" class="contact-user-img" alt="" srcset="">

            <p><h4>NEHA SINGH.. </h4><br><b> CON NO-7228010920</b></p>
            <p>ACCOUNTS DEPARTMENT..<br>
            POOJA ELECTRICALS</p>
            <dl>
                <dt> <p>shop No-7, J.B.Row House<br>
            Kim char Rasta, Palod-394110<br>
            Near Union Bank, Di-Surat</p></dt>  
            </dl>
            <p>GST NO-24AARPU7005J1ZA</p>
        </div>
        <div class="col-md-6 col-xl-6 col-sm-11 mt-n1">
            <h1 class="section-title" style="margin-top:1.7rem;">Contact Us </h1>

            <form action="" method="post" class="mt-4"> 
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Enter you mail address">
            </div>
            <div class="mb-3">
                <label class="form-label">Your message</label>
                <textarea type="text" name="message" cols="3" class="form-control col-md-6" placeholder="Type your message here..." required ></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" value="Send Message" class="w-100 btn btn-success" name="submit">
            </div>
            </form>
        </div>
   </div>
</div>

<div class="container mt-5 text-center">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3715.076243290058!2d72.95060541493878!3d21.386902385805385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be038fa17132eab%3A0x6b1f76a1ca1d6c99!2sPooja%20Electricals!5e0!3m2!1sen!2sin!4v1620458292138!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

</div>



<?php
    if (isset($_POST['submit'])) {
        require './db/db.php';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $query = "INSERT into contact_us (`name`,`email`,`message`) values('$name','$email','$message')";
        $res = mysqli_query($conn,$query);

        if ($res) {
            
            echo "<script>swal('Message recieved','We will respond you soon via mail','success')</script>";
        }
        else mysqli_error($conn);
    }

?>
<?php include 'bottom.php' ?>