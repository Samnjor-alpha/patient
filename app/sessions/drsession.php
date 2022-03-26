<?php

session_start();
if (!isset($_SESSION['dr_id'])) {
    header('Location: ' . BASE_URL . '/doctor-login.php');
}