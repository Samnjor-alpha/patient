<?php
$invoices=mysqli_query($conn,"select * from payments where doc_id='".$_SESSION['dr_id']."' and status='0'");
$payed=mysqli_query($conn,"select * from payments where doc_id='".$_SESSION['dr_id']."' and status='1'");
$cnt=1;
if (isset($_GET['paid'])){

    $update="update payments set status='1' where id = '".$_GET['paid']."'";
    if (mysqli_query($conn,$update)) {
        echo "<script>
    
  window.location.href='javascript: history.go(-1)';
    </script>";
    }else{
        echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
    }
}