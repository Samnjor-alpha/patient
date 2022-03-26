<?php
$checkappointmenthrs=mysqli_query($conn,"select * from bz_hrs where doc_id='".$_SESSION['dr_id']."'");
if (mysqli_num_rows($checkappointmenthrs)<1){
    echo "<script>
alert('Add business hours to receive Appointments');
 window.location.href='appttimes.php';
</script>";
}
function countdoc_apptn($id){
    global $conn;
    $appnt=mysqli_query($conn,"select count(*) as upcoming from appointment where doctorId='$id' and userStatus='1' and doctorStatus='1'");
    return mysqli_fetch_assoc($appnt)['upcoming'];
}
function countprevdoc_apptn($id){
    global $conn;
    $prev=mysqli_query($conn,"select count(id) as previous from appointment where doctorId='$id' and userStatus='1' or userStatus='0' and doctorStatus='0' or doctorStatus=2");
    return mysqli_fetch_assoc($prev)['previous'];
}

function amountearned($id){
    global $conn;
    $earnings=mysqli_query($conn,"select COALESCE(sum(amount),0)as earn from payments where doc_id='$id' and status='1'");
    return mysqli_fetch_assoc($earnings)['earn'];

}
function amountdue($id){
    global $conn;
    $earnings=mysqli_query($conn,"select COALESCE(sum(amount),0)as due from payments where doc_id='$id' and status='0'");
    return mysqli_fetch_assoc($earnings)['due'];
}