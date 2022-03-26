<?php
session_start();
if (!isset($_SESSION['userID'])){
    header('Location: ' .BASE_URL.'/index.php');
}