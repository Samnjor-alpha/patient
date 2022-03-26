<?php
$sql=mysqli_query($conn,"select * from admin where id='".$_SESSION['admin_id']."'");
$data=mysqli_fetch_array($sql);
if(isset($_POST['submit']))
{
    $fname=$_POST['fname'];
    $old_pwd=filter_var(stripslashes($_POST['oldpwd']), FILTER_SANITIZE_STRING);
    $password=filter_var(stripslashes($_POST['password']), FILTER_SANITIZE_STRING);
    $cpassword=filter_var(stripslashes($_POST['password_again']), FILTER_SANITIZE_STRING);

    if (!password_verify($_POST['oldpwd'], $data['password'])) {
        $msg = "You entered wrong old password!!";
        $msg_class = "alert-danger";
    } elseif (password_verify($_POST['oldpwd'], $data['password'])) {
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
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql=mysqli_query($conn,"Update admin set username='$fname',password='$hash' where id='".$_SESSION['admin_id']."'");
                if($sql)
                {
                    echo"<script>
alert('Profile update succesfully');
</script>";


                }

            }
            }

    }}

