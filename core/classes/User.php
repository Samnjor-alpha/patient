<?php

namespace MyApp;
use PDO;

class User{
public $db, $userID,$sessionID;

 public function __construct(){
$db= new \MyApp\DB;
$this->db=$db->connect();
$this->userID=$this->ID();
$this->sessionID=$this->getSessionID();
}
public function ID(){
     if ($this->isLoggedIn()) {
         return $_SESSION['userID'];
     }
}
function getSessionID(){
     return session_id();
}
public function emailExist($email){
     $stmt=$this->db->prepare("SELECT * FROM users where email=:email and type='patient'");
     $stmt->bindParam(":email",$email,PDO::PARAM_STR);
     $stmt->execute();
     $user=$stmt->fetch(PDO::FETCH_OBJ);
     if(!empty($user)){
         return $user;
     }else{
         return false;
     }

}
public function hash($password){
     return password_hash($password,PASSWORD_DEFAULT);
}
public function redirect($location){
     header("location: ".BASE_URL.$location);
}
public  function userdata($userID){
     $userID = ((!empty($userID))? $userID : $this->$userID);
    $stmt=$this->db->prepare("SELECT * FROM users where userID=:userID");
    $stmt->bindParam(":userID",$userID,PDO::PARAM_STR);
    $stmt->execute();
   return $stmt->fetch(PDO::FETCH_OBJ);


}
function isLoggedIn(){
     return (isset($_SESSION['userID']) ? true : false);
}
public function logout(){
    $_SESSION= array();
    session_destroy();
    session_regenerate_id();
    $this->redirect('/index.php');
}
public function getUsers(){
     $stmt=$this->db->prepare("SELECT * FROM users where userID !=:userid");
     $stmt->bindParam(":userid",$this->userID,PDO::PARAM_INT);
     $stmt->execute();
     $users=$stmt->fetchAll(PDO::FETCH_OBJ);
     foreach ($users as $user){
         echo'<li class="select-none transition hover:bg-green-50 p-4 cursor-pointer select-none">
                        <a href="'.BASE_URL.'/'.$user->username.'">
                            <div class="user-box flex items-center flex-wrap">
                                <div class="flex-shrink-0 user-img w-14 h-14 rounded-full border overflow-hidden">
                                    <img class="w-full h-full" src="assets/images/defaultImage.png">
                                </div>
                                <div class="user-name ml-2">
                                    <div><span class="flex font-medium">'.$user->username.'</span></div>
                                    <div></div>
                                </div>
                            </div>
                        </a>
                    </li>';
    }

}
    public  function getUserByUsername($username){

        $stmt=$this->db->prepare("SELECT * FROM users where username=:username");
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);


    }
    public function updateSession(){
     $stmt=$this ->db->prepare("update users set sessionID=:sessionID where userID=:userID");
     $stmt->bindParam(":sessionID",$this->sessionID,PDO::PARAM_STR);
     $stmt->bindParam(":userID",$this->userID,PDO::PARAM_INT);
     $stmt->execute();
    }
    public function updateConnection($connectionID,$userID){
        $stmt=$this ->db->prepare("update users set connectionID=:connectionID where userID=:userID");
        $stmt->bindParam(":connectionID",$connectionID,PDO::PARAM_STR);
        $stmt->bindParam(":userID",$userID,PDO::PARAM_INT);
        $stmt->execute();
    }
    public function getUserBySession($sessionID){
        $stmt=$this->db->prepare("SELECT * FROM users where sessionID=:sessionID");
        $stmt->bindParam(":sessionID",$sessionID,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}