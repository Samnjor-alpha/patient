<?php
$cnt=1;
if (isset($_GET['search'])){
    $search=$_GET['search'];
    $allpnts=mysqli_query($conn,"select * from users where fullName like '%$search%' or p_no like '%$search%'");
}else{
    $allpnts=mysqli_query($conn,"select * from users");
}
if (isset($_POST['reset'])){
    header('Location: ' .BASE_URL.'/admin/managepatients.php');
}
if (isset($_GET['cancel'])){

    $update="delete from users  where id = '".$_GET['id']."'";
    if (mysqli_query($conn,$update)) {
        echo "<script>
    alert('Account deleted');
  window.location.href='javascript: history.go(-1)';
    </script>";
    }else{
        echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
    }
}