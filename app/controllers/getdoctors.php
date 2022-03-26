<?php
$ret=mysqli_query($connn,"select * from doctorspecilization");

if (isset($_POST['skill'])){
$doctors=mysqli_query($connn,"select * from users where specialization ='".$_POST['skill']."'");
if (mysqli_num_rows($doctors)<1){

    $querymsg='No doctors found under that specialization';
}
}elseif (isset($_GET['search'])){
$search=$_GET['search'];
$doctors=mysqli_query($connn,"select * from users where fname like '%$search% ' and type='doctor'");
    if (mysqli_num_rows($doctors)<1){

        $querymsg='Query does not match any details in our database';
    }
}else{
    $doctors=mysqli_query($connn,"select * from users where type='doctor' ");
    if (mysqli_num_rows($doctors)<1){

        $querymsg='No doctors found.Check again later';
    }
}


