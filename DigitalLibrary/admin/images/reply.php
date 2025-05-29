<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include "conn.php";
$name=$_POST["name"];
$email=$_POST["email"];
$id=$_POST["id"];
$reply=$_POST["reply"];
$sql="update contact set reply='$reply' where id='$id';";
if (mysqli_query($conn,$sql)) {

    $mail = new PHPMailer(true);

    $senderemail = 'm3608701@gmail.com';
    $senderemailpass = 'prkx ukpe gypp dlyw';
    
    try {
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
        $mail->Subject = 'Your Reply';
        $mail->Body    = $reply;


        $mail->send();
        header("location:contact_manage.php");
    } catch (Exception $e) {
        echo 'Failed to send email: ', $mail->ErrorInfo;
    }
    
  
    

} else {
    echo "Something Went Wrong";
}


?>