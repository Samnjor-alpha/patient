<?php
$smsg="";
$msg_class="";
session_start();

$checkadmin=mysqli_query($conn,"select * from admin");

if (isset($_POST['create'])){

    $username="Admin";
    $password=password_hash("admin123", PASSWORD_DEFAULT);
    $createadmin="insert into admin set username='$username',password='$password'";

    if (mysqli_query($conn, $createadmin)) {
        $_SESSION['admin_id'] = mysqli_insert_id($conn);



        $_SESSION['ad_name'] = $username;

        if (isset($_SESSION['admin_id'])){
            echo "<script>
alert('Redirecting to dashboard....');
 window.location.href='dashboard.php';
</script>";
        }else{
            echo "<script>
alert('An error occurred');
 window.location.href='../index.php';
</script>";
        }
    }
}

if (isset($_POST['admin_login'])){
  
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $msg = "complete fields!";
            $msg_class="alert-danger";
        } else{
            $email = $_POST['username'];
            $password = $_POST['password'];

            $query = "select * from admin where username='$email'";
            $result = $conn->query($query);
            if ($result->num_rows<1){
                $msg = "Account does not exist";
                $msg_class = "alert-danger";
            }else {

                $query = "select * from admin where username='$email'";
                $result = $conn->query($query);

            }        if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                if (!password_verify($_POST['password'], $row['password'])) {
                    $msg = "Cross-check your password!!";
                    $msg_class = "alert-danger";
                } else if (password_verify($_POST['password'], $row['password'])) {



                    $_SESSION['admin_id'] = $row['id'];// Password matches, so create the sessions
                    $_SESSION['ad_name'] = $row['username'];



                    header('Location: ' . BASE_URL . '/admin/dashboard.php');

                }


            }}}


