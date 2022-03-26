<?php
$sql=mysqli_query($connn,"select * from users where userID='".$_SESSION['userID']."'");
$data=mysqli_fetch_array($sql);
if(isset($_POST['submit']))
{
    $fname=$_POST['fname'];
    $address=$_POST['address'];
    $city=$_POST['city'];


    $sql=mysqli_query($connn,"Update users set fname='$fname',address='$address',city='$city' where userID='".$_SESSION['userID']."'");
    if($sql)
    {
 echo"<script>
alert('Profile update succesfully');
</script>";


    }

}