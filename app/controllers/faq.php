<?php
$msg="";
$msg_class="";
$cnt=1;
$questions=mysqli_query($connn,"select * from faq where user_id='".$_SESSION['userID']."'");
if (mysqli_num_rows($questions)<1){
    $notfoundmsg="You have not asked any questions";
}
if (isset($_GET['cancel'])){

    $update="delete from faq where user_id='".$_SESSION['userID']."' and id='".$_GET['id']."'";
    if (mysqli_query($connn,$update)) {
        echo "<script>
    alert('FAQ deleted successfully');
  window.location.href='javascript: history.go(-1)';
    </script>";
    }else{
        echo "<script>
    alert('An error occured.');
 window.location.href='javascript: history.go(-1)';
    </script>";
    }
}

if (isset($_POST['ask'])) {
    $question = filter_var(stripslashes($_POST['faq']), FILTER_SANITIZE_STRING);
    if (empty($_POST['faq'])) {
        $msg = "Field can not be empty";
        $msg_class = "alert-danger";
    } else {
        $sql_q = mysqli_query($connn, "SELECT * FROM faq where faq='$question'");

        if (mysqli_num_rows($sql_q) > 0) {
            $msg = "The question has already been asked";
            $msg_class = "alert-danger";
        } else {


            if (empty($error)) {

                $query = "insert into faq set faq='$question',user_id='" . $_SESSION['userID'] . "'";
                if (mysqli_query($connn, $query)) {
                    $msg = "Question submitted successfully";
                    $msg_class = "alert-success";
                } else {
                    $msg = "An error occurred";
                    $msg_class = "alert-danger";
                }
            }
        }
    }
}