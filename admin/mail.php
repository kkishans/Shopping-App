<?php   include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }   
 ?>




<div>
    <h1 class="text-center my-3">Contact Mails</h1>
</div>
    

<div class="card col-md-10 col-xl-10 col-sm-11 m-auto" >
  <div class="card-body">
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Name</th>
                <th>Message</th>
                <th>Reply</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          include '../db/db.php';
          $query = "select * from contact_us";

          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
             while($r = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <td><?= $r['name'] ?></td>
                <td><?= $r['message']?></td>
                <th>
                <a href="#replyMail" class="btn col-md-4 btn-outline-success" data-toggle="modal" data-id="<?= $r['email']?>">Reply </a>
                
                </th> 
                
            </tr>
            <?php 

             }
            }else{
                echo "
                    <tr><p' align='center'> No Data Found.</p></tr>
                ";
            }            
            ?>
        </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="replyMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reply</h5>
        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size:20px">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" method="post">
                <div class="row justify-content-center">
                    <div class="col-md-12 m-3">
                    <input type="hidden" name="contact_id" id="contact_id" value=""/>
                    <textarea type="text" name="message" id="message" cols="3" class="form-control col-md-6" placeholder="Type your message here..." required ></textarea>

                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="sendReply" class="btn btn-primary">Send reply</button>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>


<?php include 'bottom.php' ?>
<!-- call model -->
<script>
   $('#replyMail').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var id = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('input[name="contact_id"]').val(id);
    });
</script>


<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
  
require '../vendor/autoload.php'; 

    if (isset($_POST['sendReply'])) {
        $to = $_POST['contact_id'] ;
        $msg = $_POST['message'];

   
            $mail = new PHPMailer(true); 
           
            require "../env.php"; 
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
                $mail->Subject = 'Pooja Electronics'; 
                $mail->Body    = $msg; 
                $mail->send(); 
                
                
            } catch (Exception $e) { 
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
            } 
        
    }

?>