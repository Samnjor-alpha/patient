<?php
$msg="";
$msg_class="";
$getbzhrs=mysqli_query($conn,"select * from bz_hrs where doc_id='".$_SESSION['dr_id']."'");
$cnt=1;
if (isset($_GET['cancel'])){
    $delehrs="delete from bz_hrs where id='".$_GET['cancel']."'";
    if (mysqli_query($conn,$delehrs)){
        echo "<script>
alert('Deleted successfully');
 window.location.href='appttimes.php';
</script>";
    }
}


if (isset($_POST['addhrs'])){
    $hrs=filter_var(stripslashes($_POST['bzn_hrs']), FILTER_SANITIZE_STRING);

    if (empty($_POST['bzn_hrs'])){
        $msg = "Business Hours cannot be empty";
        $msg_class="alert-danger";
    }else{

        $btime = date('h:i A', strtotime($hrs));
        $res_e = mysqli_query($conn,"SELECT * FROM bz_hrs  WHERE hours='$btime' and doc_id='".$_SESSION['dr_id']."'");
        if (mysqli_num_rows($res_e) > 0) {
            $msg = "Business hours already added";
            $msg_class = "alert-danger";
        }else{
            if (empty($error)) {
                $bizhrs="insert into bz_hrs set hours='$btime',doc_id='".$_SESSION['dr_id']."'";
                if (mysqli_query($conn, $bizhrs)) {
                    echo "<script>
alert('Added successfully');
 window.location.href='appttimes.php';
</script>";
                }else{
                    $msg="An error occured int he database";
                    $msg_class="alert-danger";
                }
            }
            }
        }

    }
    
