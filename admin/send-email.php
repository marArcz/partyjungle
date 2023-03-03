<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './assets/PHPMailer/src/Exception.php';
require './assets/PHPMailer/src/PHPMailer.php';
require './assets/PHPMailer/src/SMTP.php';
include_once './includes/Session.php';

//Create an instance; passing `true` enables exceptions
$user = Session::getUser();
// header("location:verify-account.php");

$mail = new PHPMailer(false);
$user_id = $user['id'];
$name = $user['firstname'] . " " . $user['lastname'];
$email = $user['email'];

$code = $user_id . time() . date('d-F-Y') . $user['username'];
$code = md5($code);
$code = substr($code, 0, 6);
$code = strtoupper($code);

//generate verification code
$query = mysqli_query($con, "SELECT * FROM verification_codes WHERE user_id=$user_id AND expiry > NOW() AND status = 0 ORDER BY id DESC LIMIT 1");
if ($query->num_rows > 0) {
    $code = $query->fetch_assoc()['code'];
} else {
    $query = mysqli_query($con, "INSERT INTO verification_codes(code,user_id,expiry) VALUES('$code',$user_id,DATE_ADD(NOW(),INTERVAL 10 MINUTE))");
    if (!$query) {
        Session::insertError("Sorry an error occured please try again later!");
        Session::redirectTo("login.php");
    }
}

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'partyjungleneeds001@gmail.com';                     //SMTP username
    $mail->Password   = 'tosqnycjrdxaymvr';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('partyjungle@gmail.com', 'Party Jungle');
    $mail->addAddress($email, $name);     //Add a recipient


    $email_body = file_get_contents('includes/email_body.html');
    $email_body = str_replace("{name}", $name, $email_body);
    $email_body = str_replace("{code}", $code, $email_body);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verify your account';
    $mail->Body    =  $email_body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->AddEmbeddedImage('assets\images\logo1.png', 'my-image', 'attachment', 'base64', 'image/jpeg');
    $mail->send();
    echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

Session::redirectTo("verify-account.php");
