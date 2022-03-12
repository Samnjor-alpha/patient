<?php
if ($userObj->isLoggedIn()){
    $userObj->redirect("/home.php");
}
if ($_SERVER['REQUEST_METHOD']==="POST"){
    if (isset($_POST['login'])){
        $email=trim(stripslashes((htmlentities($_POST['email']))));
        $password=$_POST['password'];
        if (!empty($email) && !empty($password)){
            if (!empty($email) || !empty($password)){
                if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $msg= "Invalid email format";
                }else{
                    if ($user= $userObj->emailExist($email)){
                        if (password_verify($password,$user->password)){
                            session_regenerate_id();
                            $_SESSION['userID']=$user->userID;
                            $_SESSION['name']=$user->name;
$userObj->redirect("/home.php");

                        }else{
                            $msg="incorrect email or password";
                        }
                    }
                }
            }
        }
    }
}

