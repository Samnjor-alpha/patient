<?php
$fedback=mysqli_query($connn,"select * from med_feedback where user_id='".$_SESSION['userID']."'");
$cnt=1;

if (isset($_GET['cancel'])){

    $update="update med_feedback set viewed='1' where id = '".$_GET['id']."'";
    if (mysqli_query($connn,$update)) {
        echo "<script>
    alert('Feedback marked Read');
  window.location.href='javascript: history.go(-1)';
    </script>";
    }else{
        echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
    }
}