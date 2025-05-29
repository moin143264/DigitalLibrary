<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "conn.php";
$name=$_POST["name"];
$email=$_POST["email"];
$number=$_POST["number"];
$query=$_POST["query"];
$reply=$_POST["reply"];
$sql="insert into contact values(null,'$name','$email',
'$number','$query','$reply');";

if (mysqli_query($conn,$sql)) {
    $mail = new PHPMailer(true);
    try {
        $senderemail = 'm3608701@gmail.com';
        $senderemailpass = 'prkx ukpe gypp dlyw';
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $senderemail;
        $mail->Password = $senderemailpass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        // Recipient information
        $mail->setFrom($senderemail, 'moin');
        $mail->addAddress($email, $name);
        $mail->addReplyTo($senderemail, 'moin');
    
    
        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'book Availability';
        $mail->Body    = 'We will connect you within 2 working Days.';
      //debug
      
        $mail->send();
        
        header("location:thnks.html");
    } catch (Exception $e) {
        echo 'Failed to send email: ', $mail->ErrorInfo;
    }
    
  
} 





else {
echo "Invalid Credentials";
}



?>