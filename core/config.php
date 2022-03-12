<?php
const BASE_URL = 'https://localhost/patient';

const USER = "root";
const HOST = "localhost";
const DB = "hms_v";
const DBPWD = "";

$connn = mysqli_connect(HOST,USER,DBPWD,DB);
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
