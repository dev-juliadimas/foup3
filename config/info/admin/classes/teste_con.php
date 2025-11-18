<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

$database = "u617782901_foup";
//$host = "185.211.7.103";
$host = "localhost";
$user = "u617782901_foup";
$pwd = "Foup@2023";
$porta = '3306'; //===> 3306

$con = mysqli_connect($host, $user, $pwd, $database, $porta);
$db = mysqli_select_db($con, $database);


?>