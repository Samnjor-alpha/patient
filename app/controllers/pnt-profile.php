<?php
if (isset($_GET['profile'])){
    $getprofile=mysqli_query($conn,"select * from users where id='".$_GET['profile']."'");
    $cnt=1;
    $medhis=mysqli_query($conn,"select * from medicalhist where pnt_id='".$_GET['profile']."'");
        if(mysqli_num_rows($getprofile)>0){
            $row=mysqli_fetch_assoc($getprofile);
        }
}else{
    echo "<script>
 window.location.href='javascript: history.go(-1)';
</script>";
}