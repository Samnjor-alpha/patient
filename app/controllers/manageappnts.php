<?php
$cnt=1;
$ret=mysqli_query($conn,"select * from doctorspecilization");

if (isset($_POST['filter'])){
    $date=$_POST['appntdate'];
    $appnts=mysqli_query($conn,"select * from appointment where appointmentDate ='$date'");
    $notfound="No appointments in that period";
}elseif(isset($_POST['skill'])){
    $skill=$_POST['skill'];
    $appnts=mysqli_query($conn,"select * from appointment where doctorSpecialization ='$skill'");
    $notfound="No appointments under that specialization";
}else{

    $appnts=mysqli_query($conn,"select * from appointment");
    $notfound="No appointment history";
}
