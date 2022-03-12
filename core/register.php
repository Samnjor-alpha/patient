<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'mailer/phpmailer/phpmailer/src/Exception.php';
require 'mailer/phpmailer/phpmailer/src/PHPMailer.php';
require 'mailer/phpmailer/phpmailer/src/SMTP.php';
require 'mailer/autoload.php';
$msg="";
$msg_class="";
session_start();

//$ret=mysqli_query($connn,"select * from doctorspecilization");



/**Start User Registration**/
if(isset($_POST['signup']))
{
    session_regenerate_id();
    $ssid=session_id();
    $fname=filter_var(stripslashes($_POST['full_name']), FILTER_SANITIZE_STRING);
    $address=filter_var(stripslashes($_POST['address']), FILTER_SANITIZE_STRING);
    $pno=filter_var(stripslashes($_POST['pno']), FILTER_SANITIZE_STRING);
    $city=filter_var(stripslashes($_POST['city']), FILTER_SANITIZE_STRING);
    $gender=filter_var(stripslashes($_POST['gender']), FILTER_SANITIZE_STRING);
    $email=filter_var(stripslashes($_POST['email']), FILTER_SANITIZE_STRING);
    $password=filter_var(stripslashes($_POST['password']), FILTER_SANITIZE_STRING);
    $cpassword=filter_var(stripslashes($_POST['password_again']), FILTER_SANITIZE_STRING);
    $dpl="https://ui-avatars.com/api/name=";
    $dp=$dpl.$fname;
    if (empty($_POST['full_name']) ||empty($_POST['address'])|| empty($_POST['pno']|| empty($_POST['city']) || empty($_POST['gender'])|| empty($_POST['email']) || empty($_POST['password']))){
        $msg = "inputs can not be empty";
        $msg_class="alert-danger";
    }    else{
        if(!empty($_POST["email"])) {
            $email= $_POST["email"];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

                $msg='invalid email';
                $msg_class='alert-danger';
            }else{

                function random_username($fname)
                {
                    $new_name = $fname.mt_rand(0,100900);

                    return  check_user_name($new_name,$fname);
                }
                function check_user_name($new_name,$fname)
                {
                    global $connn;
                    $select = mysqli_query($connn,"select * from users where username='$new_name'");

                    if(mysqli_num_rows($select)>0)
                    {
                        random_username($fname);
                    }
                    else
                    {
                        return $new_name;
                    }

                }
                $newname= check_user_name(str_replace(' ', '', random_username($fname)), str_replace(' ', '', $fname));

                $sql_e = "SELECT * FROM users WHERE email='$email'";

                $res_e = mysqli_query($connn, $sql_e);

                $sql_u = "SELECT * FROM users WHERE p_no='$pno'";

                $res_u = mysqli_query($connn, $sql_u);


                if(strlen(trim($password)) <6)
                {
                    $msg = "password too short";
                    $msg_class = "alert-danger";
                }else{



// check if passwords match
                    if ($password !== $cpassword) {
                        $msg = "The passwords do not match";
                        $msg_class = "alert-danger";
                    } elseif ($password == $cpassword) {

                        if (mysqli_num_rows($res_e) > 0) {
                            $msg = "Email is already associated with an account";
                            $msg_class = "alert-danger";
                        }elseif (mysqli_num_rows($res_u)>0){
                            $msg = "mobile number is already associated with an account";
                            $msg_class = "alert-danger";
                        } else {
                            $hash = password_hash($password, PASSWORD_DEFAULT);

// For image upload

// Upload image only if no errors
                            if (empty($error)) {




                                $query="insert into users set fname='$fname',address='$address',username='$newname',profileimage='$dp',city='$city',gender='$gender',p_no='$pno',email='$email',password='$hash',sessionID='$ssid',connectionID='0', type='patient'";
                                if (mysqli_query($connn, $query)) {


                                        $mail = new PHPMailer;
                                        $mail->isSMTP();
                                        $mail = new PHPMailer(true);


                                        $mail->IsSMTP();
                                        $mail->SMTPDebug =false;
                                        $mail->SMTPAuth = EMAIL_SMTP_AUTH;
                                        $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
                                        $mail->Host = EMAIL_SMTP_HOST;
                                        $mail->Port = EMAIL_SMTP_PORT; // or 587
                                        $mail->IsHTML(true);
                                        $mail->Username = EMAIL_SMTP_USERNAME;
                                        $mail->Password = EMAIL_SMTP_PASSWORD;

                                        $mail->addAddress($email);

                                        $output = '<p>'.$fname.', '.EMAIL_PNTN_NOTIFICATION_CONTENT.'</p>';
                                        $output .= '<p>-------------------------------------------------------------</p>';
                                        $output .= '<p>Regards,</p>';
                                        $output .= '<p>' . EMAIL_NOTIFICATION_FROM_NAME . '</p>';
                                        $output .="<p style='background-color: #1b1e21'><img alt='logo'  src='https://dl.uploadgram.me/6206666b869d3h?raw'></p>";
                                        $subject =EMAIL_NOTIFICATION_SUBJECT;
                                        $body = $output;
                                        $mail->Subject = $subject;
                                        $mail->Body = $body;


                                        if (!$mail->send()) {
                                            $msg = "ERROR: " . $mail->ErrorInfo;
                                            $msg_class = "alert-danger";
                                        }

                                        echo "<script>
alert('Redirecting to login page....');
 window.location.href='index.php';
</script>";
                                    }else{
                                    echo mysqli_error($connn);
                                    $msg_class = "alert-danger";
                                }



                                }





                        }
                    }
                }

            }}}}
/**End User Registration**/

