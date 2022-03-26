<?php
$msg="";
$msg_class="";

if (empty($_GET['doctor'])){
    header('Location: ' . BASE_URL . '/bookappt.php');
}

if (isset($_GET['doctor'])){
     $dr_id= getdrid($_GET['doctor']);
$doctor=mysqli_query($connn,"select * from users where userID='$dr_id' and type='doctor'");
}
$getdrbizhrs=mysqli_query($connn,"select * from bz_hrs where doc_id='$dr_id'");

if (isset($_POST['bookappt'])){
    if (empty($_POST['drspec']) || empty($_POST['drname'])|| empty($_POST['fees'])|| empty($_POST['appdate'])) {
        $msg = "All fields are required!";
        $msg_class="alert-danger";
    }else{
        $drspec=filter_var(stripslashes($_POST['drspec']), FILTER_SANITIZE_STRING);
        $drid=$dr_id;
        $userid=$_SESSION['userID'];
        $fee=filter_var(stripslashes($_POST['fees']), FILTER_SANITIZE_STRING);
        $appdate=filter_var(stripslashes($_POST['appdate']), FILTER_SANITIZE_STRING);
        $apptime=filter_var(stripslashes($_POST['bizhrs']), FILTER_SANITIZE_STRING);

//        $btime = date('h:i A', strtotime($apptime));
      //check whether doctor is having another appointment or a date is in the past
        $date1 = new DateTime($appdate);
        $dt1 = $date1->format('Y-m-d');

$dateappnt=$date1->format("Y-m-d");

        $td = date('Y-m-d');
        if ($td >= $dt1) {
            $msg="Appointments are done in future days";
            $msg_class="alert-danger";
        }else{
            $checkappointment=mysqli_query($connn,"select * from appointment where userId='$userid' and appointmentDate ='$dateappnt'");
            if (mysqli_num_rows($checkappointment)>0){
                $msg="You have an appointment on this date";
                $msg_class="alert-danger";
            }else{
             $checkdrappointment=mysqli_query($connn,"select * from appointment where doctorId='$drid' and appointmentDate='$appdate' and appt_time='$apptime'");
             if (mysqli_num_rows($checkdrappointment)){
                 $msg="Doctor has an appointment at this time";
                 $msg_class="alert-danger";
             }else{
                $query=mysqli_query($connn,"insert into appointment set doctorSpecialization='$drspec',doctorId='$drid',userId='$userid',consultancyFees='$fee',appointmentDate='$appdate',appt_time='$apptime'");
        if($query)
        {
            echo "<script>alert('Appointment booked successfully');</script>";
        }else{
            $msg = mysqli_error($connn);
            $msg_class = "alert-danger";
        }
    }}


}}}