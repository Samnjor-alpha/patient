<?php

$users=mysqli_query($conn,"select * from users where userID !='".$_SESSION['userid']."'");
$userr=mysqli_query($conn,"select * from users where userID ='".$_SESSION['userid']."'");
$user=mysqli_query($conn,"select * from users where users.username ='".$_GET['username']."'");
$user_row=mysqli_fetch_assoc($user);
$userr_row=mysqli_fetch_assoc($userr);

$usersc=mysqli_query($conn,"select * from users where userID !='".$_SESSION['userid']."' and username !='".$_GET['username']."'");
$sessionid=session_id();

//$updatesessn=mysqli_query($conn,"update users set sessionID='$sessionid' where userID='".$_SESSION['userid']."'");
$userbysess=mysqli_query($conn,"select * from users where users.sessionID ='$sessionid'");