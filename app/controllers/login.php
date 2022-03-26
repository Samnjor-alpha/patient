<?php
$smsg="";
$msg_class="";
session_start();

/***Start USer login****/
if(isset($_POST['logptnt'])){
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $msg = "complete fields!";
        $msg_class="alert-danger";
    } else{
       $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "select * from users where email='$email'";
        $result = $conn->query($query);
        if ($result->num_rows<1){
            $msg = "Account does not exist";
            $msg_class = "alert-danger";
        }else {

            $query = "select * from users where email='$email'";
            $result = $conn->query($query);

        }        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!password_verify($_POST['password'], $row['password'])) {
                $msg = "Cross-check your password!!";
                $msg_class = "alert-danger";
            } else if (password_verify($_POST['password'], $row['password'])) {



                $_SESSION['p_id'] = $row['id'];// Password matches, so create the sessions
                 $_SESSION['pname'] = $row['fullName'];
                $_SESSION['pemail'] = $row['email'];
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
                $newname= check_user_name(str_replace(' ', '', random_username($_SESSION['pname'])), str_replace(' ', '', $_SESSION['pname']));
                session_regenerate_id();
                $ssid=session_id();
 $checkvuser=mysqli_query($conn,"select * from v_users where dr_pnt_id='".$_SESSION['p_id']."' and type='pnt' ");
 if (mysqli_num_rows($checkvuser)>0){
     $_SESSION['sessionID'] =$ssid;
     header('Location: ' . BASE_URL . '/dashboard/userdashboard.php');
 }else{
     $insert=mysqli_query($conn, "insert into v_users set dr_pnt_id='".$_SESSION['p_id']."',username='$newname',name='".$_SESSION['pname']."',sessionID='$ssid',type='pnt',connectionID='0'");
     $_SESSION['sessionID'] =$ssid;
     header('Location: ' . BASE_URL . '/dashboard/userdashboard.php');
 }


            }


        }}}
/***End USer login****/
/**/

/***Start Dr. login****/
if(isset($_POST['logdr'])){
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $msg = "complete fields!";
        $msg_class="alert-danger";
    } else{
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "select * from doctors where docEmail='$email'";
        $result = $conn->query($query);
        if ($result->num_rows<1){
            $msg = "Account does not exist";
            $msg_class = "alert-danger";
        }else {

            $query = "select * from doctors where docEmail='$email'";
            $result = $conn->query($query);

        }        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!password_verify($_POST['password'], $row['password'])) {
                $msg = "Cross-check your password!!";
                $msg_class = "alert-danger";
            } else if (password_verify($_POST['password'], $row['password'])) {



                $_SESSION['dr_id'] = $row['id'];// Password matches, so create the sessions
                $_SESSION['dr_name'] = $row['doctorName'];
                $_SESSION['dr_email'] = $row['docEmail'];
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

                $newname= check_user_name(str_replace(' ', '', random_username($_SESSION['doctorName'])), str_replace(' ', '', $_SESSION['doctorName']));
                session_regenerate_id();
                $ssid=session_id();


                $checkvuser=mysqli_query($conn,"select * from v_users where dr_pnt_id='".$_SESSION['dr_id']."' and type='dr' ");
                if (mysqli_num_rows($checkvuser)>0){
                    header('Location: ' . BASE_URL . '/doctor/doctordashboard.php');
                }else{
                    $insert=mysqli_query($conn, "insert into v_users set dr_pnt_id='".$_SESSION['dr_id']."',username='$newname',name='".$_SESSION['dr_id']."',sessionID='$ssid',type='dr',connectionID='0'");
                    header('Location: ' . BASE_URL . '/doctor/doctordashboard.php');
                }

            }


        }}}
/***End Dr. login****/