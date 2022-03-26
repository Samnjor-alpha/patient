<?php
const BASE_URL = 'https://localhost/hms';


const USER = "root";
const HOST = "localhost";
const DB = "hms";
const DBPWD = "";

$conn = mysqli_connect(HOST,USER,DBPWD,DB);
global $conn;
//Text constants
const PHONE= "+233555396154";
const APP_NAME="Wilson Medical Center";
const EMAIL= "info@wilsonmedicalcenter.com";
const ptnt_loginTittle= "HMS Patient Login";
const ptnt_logindesc= "Login  to book Appointment";
const ptnt_regTittle= "HMS Patient Registration";
const ptnt_regdesc= "Register  to book Appointment";
const doc_loginTittle= "HMS Doctor Login";
const doc_logindesc= "Login  to receive Appointment";
const admin_loginTittle= "HMS Admin Login";
const admin_logindesc= "Login  to manage system";
const doc_regTittle= "HMS Doctor Registration";
const doc_regdesc= "Register  to receive appointments";
const currency="Cedis";
const reset_pwdttle="HMS Patient Password Reset";
const user_dashboard="User Dashboard";
const doc_dashboard="Doctor Dashboard";
const admin_dashboard="Admin Dashboard";
const EMAIL_USE_SMTP = true;
const EMAIL_SMTP_HOST = "smtp.gmail.com";
const EMAIL_SMTP_AUTH = true;
const EMAIL_SMTP_USERNAME = "wilsonmedicalcenter1@gmail.com";
const EMAIL_SMTP_PASSWORD = "WilS100%123";
const EMAIL_SMTP_PORT = 587;
const EMAIL_SMTP_ENCRYPTION = "tsl";


const EMAIL_PNTN_NOTIFICATION_CONTENT = "your account was Created successfully.Login to book an appointment with a qualified Doctor.";
const EMAIL_DR_NOTIFICATION_CONTENT = "your account was Created successfully.Login to receive appointments from different patients.";

const EMAIL_NOTIFICATION_SUBJECT = "Account Created successfully!!";
const EMAIL_NOTIFICATION_FROM_NAME = "Wilson Medical Center";
const EMAIL_RESET_SUBJECT="Password Recovery";
//Text constants