<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'mailer/phpmailer/phpmailer/src/Exception.php';
require 'mailer/phpmailer/phpmailer/src/PHPMailer.php';
require 'mailer/phpmailer/phpmailer/src/SMTP.php';
require 'mailer/autoload.php';

$msg='';
$msg_class='';

if(isset($_POST["searchmail"]) && (!empty($_POST["email"]))){
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $msg="Invalid email address please type a valid email address!";
        $msg_class="alert-danger";
    }else{
        $sel_query = "SELECT * FROM doctors WHERE docEmail='$email'";
        $results = mysqli_query($conn,$sel_query);
        $row = mysqli_num_rows($results);
        $usereset=mysqli_fetch_assoc($results);

    if ($results->num_rows<1){
        $msg = "No doctor is registered with this email address!";
        $msg_class="alert-danger";
    }else {
        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $keyy = md5($email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $keyy . $addKey;
// Insert Temp Table


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail = new PHPMailer(true);


        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
        $mail->Host = EMAIL_SMTP_HOST;
        $mail->Port = EMAIL_SMTP_PORT; // or 587
        $mail->IsHTML(true);
        $mail->Username = EMAIL_SMTP_USERNAME;
        $mail->Password = EMAIL_SMTP_PASSWORD;
        $mail->setFrom(EMAIL_SMTP_USERNAME);
        $mail->addAddress($email);
        $output = '<p>Dear Doctor</p>';
        $output .= '<p>Please click on the following link to reset your password.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="' . BASE_URL . '/drchangepassword?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
        Click here</a></p><br>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
        $output .= '<p>If you did not request this forgotten password email, no action
    is needed, your password will not be reset. However, you may want to log into
    your account and change your security password as someone may have guessed it.</p>';
        $output .= '<p>Thanks,</p>';
        $output .= EMAIL_NOTIFICATION_FROM_NAME;
        $body = $output;
        $subject = EMAIL_RESET_SUBJECT;
        $body = $output;
        $mail->Subject = $subject;
        $mail->Body = $body;


//        $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject, 'MIME-Version' => 1,
//            'Content-type' => 'text/html;charset=iso-8859-1');
        if (!$mail->send()) {
            $msg = "ERROR: " . $mail->ErrorInfo;
            $msg_class = "alert-danger";
        } else {
            mysqli_query($conn,
                "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");
            $msg = "Check email for password reset instructions";
            $msg_class = "alert-info";
        }
    }}}