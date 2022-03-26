<?php
$sql=mysqli_query($conn,"select * from doctors where id='".$_SESSION['dr_id']."'");
$data=mysqli_fetch_array($sql);
if(isset($_POST['submit']))
{
    $fname=$_POST['fname'];
    $address=$_POST['address'];
    $fees=$_POST['fees'];


    $sql=mysqli_query($conn,"Update doctors set doctorName='$fname',address='$address',docFees='$fees' where id='".$_SESSION['dr_id']."'");
    if($sql)
    {
        echo"<script>
alert('Profile update succesfully');
</script>";


    }

}