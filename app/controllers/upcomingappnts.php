<?php
$upcomingappnts=mysqli_query($connn,"select * from appointment where doctorId='".$_SESSION['dr_id']."' and userStatus='1' and doctorStatus='1'");
$previousappnts=mysqli_query($connn,"select * from appointment where doctorId='".$_SESSION['dr_id']."' and   doctorStatus='2' or DATE(appointmentDate) < DATE(NOW())");

$cnt=1;
$ucnt='AAZ';
if (isset($_GET['cancel'])){

    $update="update appointment set doctorStatus='0' where id = '".$_GET['id']."'";
    if (mysqli_query($connn,$update)) {
        echo "<script>
    alert('appointment cancelled successfully');
  window.location.href='javascript: history.go(-1)';
    </script>";
    }else{
        echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
    }
}
if (isset($_POST['feed'])){
    $fbck=filter_var(stripslashes($_POST['feedback']), FILTER_SANITIZE_STRING);
    $uid=filter_var(stripslashes($_POST['us_id']), FILTER_SANITIZE_STRING);
    $appid=filter_var(stripslashes($_POST['appnt_id']), FILTER_SANITIZE_STRING);
    $dr_id=$_SESSION['dr_id'];
    if (empty($_POST['feedback'])|| empty($_POST['us_id'])){
        echo "<script>
alert('Fill all fields');
 window.location.href='previousappnt.php';
</script>";
    }else{

        if (empty($error)) {
            $specs="insert into med_feedback set feedback='$fbck',doc_id='$dr_id',user_id='$uid'";
            $updateappnt="Update appointment set feedbackstatus='1' where id='$appid'";
            if (mysqli_query($connn, $specs) && mysqli_query($connn,$updateappnt)) {

                echo "<script>
alert('Send successfully');
 window.location.href='previousappnt.php';
</script>";
            }else{
                echo "<script>
alert('An error occured');
 window.location.href='previousappnt.php';
</script>";
            }
        }

    }
}