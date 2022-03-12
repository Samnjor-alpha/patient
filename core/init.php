<?php
session_start();
require "core/classes/DB.php";
require "core/classes/User.php";
$userObj = new \MyApp\User;
const BASE_URL = 'https://localhost/patient';