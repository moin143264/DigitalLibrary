<?php
include 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_password_reset($name, $email, $token)
{
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
    
        // Generate the reset link
        $reset_link = "https://digitallibrarymanagement.kesug.com/admin/pass.php?token=" . urlencode(trim($token)) . "&email=" . urlencode(trim($email));
    
        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        
        $email_template = "
        <h2>Hello, $name</h2>
        <h3>Password reset link:</h3>
        <a href='$reset_link'>Reset here</a>
        ";

        $mail->Body = $email_template;
        $mail->send();
    } catch (Exception $e) {
        echo 'Failed to send email: ', $mail->ErrorInfo;
    }
}

if (isset($_POST["forgot"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $token = md5(rand());
    $sql = "SELECT * FROM last WHERE email='$email';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $update_token = "UPDATE last SET token='$token' WHERE email='$email';";
        $sqll = mysqli_query($conn, $update_token);
        if ($sqll) {
            send_password_reset($name, $email, $token);
            echo "An email has been sent to you <br>
            <p>Click below to go to mail box  </p><br>
            <a  style='text-decoration:none; width:250px;color:#003366;font-family:fantasy;margin:15px' href='https://mail.google.com'>MailBox</a>";
            exit(0);
        } else {
            echo "Something went wrong: " . mysqli_error($conn);
            exit(0);
        }
    } else {
        echo "No email found.";
        exit(0);
    }
}

// Password update part
if (isset($_POST["update"])) {
    $email = trim($_POST["email"]);
    $pass = trim($_POST["paas"]);
    $cpass = trim($_POST["cpaas"]);
    $token = trim($_POST["ptoken"]);

    if (!empty($token)) {
        if (!empty($email) && !empty($pass) && !empty($cpass)) {
            $sql_check_token = "SELECT * FROM last WHERE email='$email' AND token='$token';";
            $result = mysqli_query($conn, $sql_check_token);

            if (mysqli_num_rows($result) > 0) {
                if ($pass === $cpass) {
                    $hash = password_hash($pass, PASSWORD_BCRYPT);
                    // Updating the password and clearing the token
                    $up_pass = "UPDATE last SET password='$hash', token='$token' WHERE email='$email' ;";
                    
                    if (mysqli_query($conn, $up_pass)) {
                        echo "Password updated successfully.";
                        header("location:../index.php");
                        exit(0);
                    } else {
                        // Log the exact SQL error if the update fails
                        echo "Failed to update: " . mysqli_error($conn);
                        header("location:pass.php?token=" . urlencode($token) . "&email=" . urlencode($email));
                        exit(0);
                    }
                } else {
                    echo "New password and confirm password do not match.";
                    header("location:pass.php?token=" . urlencode($token) . "&email=" . urlencode($email));
                    exit(0);
                }
            } else {
                echo "Invalid token.";
                header("location:pass.php?token=" . urlencode($token) . "&email=" . urlencode($email));
                exit(0);
            }
        } else {
            echo "All fields are required.";
            header("location:pass.php?token=" . urlencode($token) . "&email=" . urlencode($email));
            exit(0);
        }
    } else {
        echo "Token not available.";
        header('location:pass.php');
        exit(0);
    }
}
?>