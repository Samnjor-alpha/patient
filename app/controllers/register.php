<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'mailer/phpmailer/phpmailer/src/Exception.php';
require 'mailer/phpmailer/phpmailer/src/PHPMailer.php';
require 'mailer/phpmailer/phpmailer/src/SMTP.php';
require 'mailer/autoload.php';
$msg="";
$msg_class="";
session_start();

$ret=mysqli_query($conn,"select * from doctorspecilization");



/**Start User Registration**/
if(isset($_POST['regptnt']))
{
    $fname=filter_var(stripslashes($_POST['full_name']), FILTER_SANITIZE_STRING);
    $address=filter_var(stripslashes($_POST['address']), FILTER_SANITIZE_STRING);
    $pno=filter_var(stripslashes($_POST['pno']), FILTER_SANITIZE_STRING);
    $city=filter_var(stripslashes($_POST['city']), FILTER_SANITIZE_STRING);
    $gender=filter_var(stripslashes($_POST['gender']), FILTER_SANITIZE_STRING);
    $email=filter_var(stripslashes($_POST['email']), FILTER_SANITIZE_STRING);
    $password=filter_var(stripslashes($_POST['password']), FILTER_SANITIZE_STRING);
    $cpassword=filter_var(stripslashes($_POST['password_again']), FILTER_SANITIZE_STRING);
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
                    global $conn;
                    $select = mysqli_query($conn,"select * from v_users where username='$new_name'");

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

                $res_e = mysqli_query($conn, $sql_e);

                $sql_u = "SELECT * FROM users WHERE p_no='$pno'";

                $res_u = mysqli_query($conn, $sql_u);


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




                                $query="insert into users set fullname='$fname',address='$address',city='$city',gender='$gender',p_no='$pno',email='$email',password='$hash'";
                                if (mysqli_query($conn, $query)) {
                                    $_SESSION['p_id'] = mysqli_insert_id($conn);
                                    session_regenerate_id();
                                    $ssid=session_id();
$v_user=mysqli_query($conn,"insert into v_users set dr_pnt_id='".$_SESSION['p_id']."',username='$newname', name='$fname', type='pnt', connectionID='0',sessionID='$ssid' ");

                                    $_SESSION['userID']=mysqli_insert_id($conn);
                                    $_SESSION['sessionID'] =$ssid;
                                    $_SESSION['name']=$fname;
                                    $_SESSION['pname'] = $fname;
                                    $_SESSION['pemail'] = $email;
                                    if (isset($_SESSION['p_id'])){

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
alert('Redirecting to dashboard....');
 window.location.href='dashboard/userdashboard.php';
</script>";
                                    }



                                }
                            }



                            else {
                                $msg = "There was an Error in the database";
                                $msg_class = "alert-danger";
                            }
                        }
                    }
                }

            }}}}
/**End User Registration**/
/**Start Dr. Registration**/
if(isset($_POST['drreg']))
{
    $drspec=filter_var(stripslashes($_POST['drspec']), FILTER_SANITIZE_STRING);
    $drname=filter_var(stripslashes($_POST['docname']), FILTER_SANITIZE_STRING);
    $address=filter_var(stripslashes($_POST['clinicaddress']), FILTER_SANITIZE_STRING);
    $fees=filter_var(stripslashes($_POST['docfees']), FILTER_SANITIZE_STRING);
    $no=filter_var(stripslashes($_POST['doccontact']), FILTER_SANITIZE_STRING);
    $email=filter_var(stripslashes($_POST['docemail']), FILTER_SANITIZE_STRING);
    $password=filter_var(stripslashes($_POST['npass']), FILTER_SANITIZE_STRING);
    $cpassword=filter_var(stripslashes($_POST['cfpass']), FILTER_SANITIZE_STRING);
    if (empty($_POST['drspec']) ||empty($_POST['docname'])|| empty($_POST['clinicaddress']|| empty($_POST['docfees']) || empty($_POST['doccontact'])|| empty($_POST['docemail']) || empty($_POST['npass']))){
        $msg = "inputs can not be empty";
        $msg_class="alert-danger";
    }    else{
        if(!empty($_POST["docemail"])) {
            $email= $_POST["docemail"];
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
                    global $conn;
                    $select = mysqli_query($conn,"select * from v_users where username='$new_name'");

                    if(mysqli_num_rows($select)>0)
                    {
                        random_username($fname);
                    }
                    else
                    {
                        return $new_name;
                    }

                }
                $newname= check_user_name(str_replace(' ', '', random_username($drname)), str_replace(' ', '', $drname));
                $sql_de = "SELECT * FROM doctors WHERE docEmail='$email'";

                $res_de = mysqli_query($conn, $sql_de);

                $sql_u = "SELECT * FROM doctors WHERE contactno='$no'";

                $res_u = mysqli_query($conn, $sql_u);


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

                        if (mysqli_num_rows($res_de) > 0) {
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





                                $query="insert into doctors set doctorName='$drname',specilization='$drspec',docEmail='$email',address='$address',docFees='$fees',contactno='$no',password='$hash'";
                                if (mysqli_query($conn, $query)) {
                                    $_SESSION['dr_id'] = mysqli_insert_id($conn);

                                    session_regenerate_id();
                                    $ssid=session_id();
                                    $v_user=mysqli_query($conn,"insert into v_users set dr_pnt_id='".$_SESSION['dr_id']."',username='$newname', name='$drname', type='dr', connectionID='0',sessionID='$ssid' ");

                                    $_SESSION['userID']=mysqli_insert_id($conn);
                                    $_SESSION['sessionID'] =$ssid;
                                    $_SESSION['dr_name'] = $drname;
                                    $_SESSION['dr_email'] = $email;
                                    if (isset($_SESSION['dr_id'])){

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

                                        $output = '<p>'.$drname.', '.EMAIL_DR_NOTIFICATION_CONTENT.'</p>';
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
alert('Redirecting to dashboard....');
 window.location.href='doctor/doctordashboard.php';
</script>";
                                    }else{
                                        echo mysqli_errno($conn);
                                    }



                                }
                            }



                            else {
                                $msg = "There was an Error in the database";
                                $msg_class = "alert-danger";
                            }
                        }
                    }
                }

            }}}}
/**End Dr. Registration**/



