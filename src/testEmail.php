<?php
 function checkMail($email)
{

    // Include library file
     require_once './VerifyEmail.class.php'; 
    // Initialize library class
    $mail = new VerifyEmail();

    // Set the timeout value on stream
    $mail->setStreamTimeoutWait(10);

    // Set debug output mode
    $mail->Debug= false; 
    $mail->Debugoutput= 'html'; 

    // Set email address for SMTP request
    $mail->setEmailFrom('from@email.com');

    // Email to check
    // $email = 'kishan@example.com';

    // Check if email is valid and exist
    $b = verifyEmail::validate($email) && $mail->check($email);
    if($b){ 
        // echo 'Email &lt;'.$email.'&gt; is exist!'; 
        return true;
    }else{ 
        // echo 'Email &lt;'.$email.'&gt; is not valid and not exist!'; 
        return false;
    } 
    return false;
}


?>