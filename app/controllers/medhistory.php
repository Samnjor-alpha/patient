<?php
$msg="";
$msg_class="";
$medhis=mysqli_query($connn,"select * from medicalhist where pnt_id='".$_SESSION['userID']."'");
$cnt=1;

if (isset($_GET['cancel'])){

    $update="delete from medicalhist where pnt_id='".$_SESSION['userID']."' and id='".$_GET['id']."'";
    if (mysqli_query($connn,$update)) {
        echo "<script>
    alert('Medical history deleted successfully');
  window.location.href='javascript: history.go(-1)';
    </script>";
    }else{
        echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
    }
}



if (isset($_POST['addmedhist'])){

    $pnthist=filter_var(stripslashes($_POST['p_medhist']), FILTER_SANITIZE_STRING);
    $medhist=filter_var(stripslashes($_POST['med_hist']), FILTER_SANITIZE_STRING);
    $famhist=filter_var(stripslashes($_POST['famhist']), FILTER_SANITIZE_STRING);
    $trehist=filter_var(stripslashes($_POST['trehist']), FILTER_SANITIZE_STRING);
    if (empty($_POST['p_medhist']) ||empty($_POST['med_hist'])|| empty($_POST['famhist']|| empty($_POST['trehist']))){
        $msg = "inputs can not be empty";
        $msg_class="alert-danger";
    }else{
        if (empty($error)){

        $medhistory="insert into medicalhist set pnt_med_hist='$pnthist',medication_hist='$medhist',family_med_hist='$famhist',treatment_hist='$trehist',pnt_id='".$_SESSION['userID']."'";
        if (mysqli_query($connn,$medhistory)){
            $msg="Medical history added successfully";
            $msg_class="alert-success";
        }else{
            $msg = "An error occurred int he database";
            $msg_class="alert-danger";
        }
    }
}}