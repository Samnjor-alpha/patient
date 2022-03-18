<?php
namespace MyApp;
use PDO;

class DB{
    function connect(): PDO
    {
        return new PDO("mysql:host=127.0.0.1; dbname=hms_v","root","");
    }
}