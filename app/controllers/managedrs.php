<?php
$cnt=1;
if (isset($_GET['search'])){
    $search=$_GET['search'];
    $aldrs=mysqli_query($conn,"select * from doctors where doctorName like '%$search%' or contactno like '%$search%' or specilization like '%$search%'");
}else{
    $aldrs=mysqli_query($conn,"select * from doctors");
}
if (isset($_POST['reset'])){
    header('Location: ' .BASE_URL.'/admin/manageDoctors.php');
}
if (isset($_GET['cancel'])){

    $update="delete from doctors  where id = '".$_GET['id']."'";
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