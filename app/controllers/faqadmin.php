<?php
$msg='';
$msg_class='';
$questions= mysqli_query($conn,"select * from faq");
$cnt='AAZ';
if (isset($_POST['f_ans'])){
     $faqans=filter_var(stripslashes($_POST['faqans']), FILTER_SANITIZE_STRING);
    $faid=filter_var(stripslashes($_POST['faqid']), FILTER_SANITIZE_STRING);
    if (empty($_POST['faqans'])|| empty($_POST['faqid'])){
        $msg = "Inputs cannot be empty";
        $msg_class="alert-danger";
    }else{

        if (empty($error)) {
            $specs="insert into faq_answers set faq_ans='$faqans', faq_id='$faid'";
            if (mysqli_query($conn, $specs)) {
                echo "<script>
alert('Added successfully');
 window.location.href='Faqs.php';
</script>";
            }else{
                $msg="An error occured int he database";
                $msg_class="alert-danger";
            }
        }

    }
}