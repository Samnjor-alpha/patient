<?php
$cnt=1;
$getspecs=mysqli_query($conn,"select * from doctorspecilization");

if (isset($_GET['cancel'])){
    $del_spec="delete from doctorspecilization where id='".$_GET['cancel']."'";
    if (mysqli_query($conn,$del_spec)){
        echo "<script>
alert('Deleted successfully');
 window.location.href='addspecialization.php';
</script>";
    }
}

if (isset($_POST['add_specs'])){
    $spec=filter_var(stripslashes($_POST['spec']), FILTER_SANITIZE_STRING);

    if (empty($_POST['spec'])){
        $msg = "Specialization cannot be empty";
        $msg_class="alert-danger";
    }else{


        $res_e = mysqli_query($conn,"SELECT * FROM doctorspecilization  WHERE specilization='$spec'");
        if (mysqli_num_rows($res_e) > 0) {
            $msg = "Specialization already added";
            $msg_class = "alert-danger";
        }else{
            if (empty($error)) {
                $specs="insert into doctorspecilization set specilization='$spec'";
                if (mysqli_query($conn, $specs)) {
                    echo "<script>
alert('Added successfully');
 window.location.href='addspecialization.php';
</script>";
                }else{
                    $msg="An error occured int he database";
                    $msg_class="alert-danger";
                }
            }
        }
    }

}