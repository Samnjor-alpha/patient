<?php
$appnts=mysqli_query($connn,"select *  from appointment  where userId='".$_SESSION['userID']."' and userStatus='1' and doctorStatus='1' order by postingDate desc");

$prevappnts=mysqli_query($connn,"select *  from appointment  where userId='".$_SESSION['userID']."' and DATE(appointmentDate) < DATE(NOW())");
    //mysqli_query($connn,"select doctors.doctorName as docname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId where appointment.userId='".$_SESSION['userID']."'");

$cnt=1;



if (isset($_GET['cancel'])){

    $update="update appointment set userStatus='0' where id = '".$_GET['id']."'";
if (mysqli_query($connn,$update)) {
    echo "<script>
    alert('Feedback marked read successfully');
  window.location.href='javascript: history.go(-1)';
    </script>";
}else{
    echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
}
}