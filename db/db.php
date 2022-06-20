<?php
$jb_host ='127.0.0.1' ; 
$jb_dbname = 'job_cv';
$jb_username = 'root';
$jb_password='102030'; 
$mysqli = new mysqli($jb_host ,$jb_username,$jb_password,$jb_dbname);

if ($mysqli->connect_errno) {
    die('Error connection: ' . $mysqli->connect_errno);
}
$mysqli->set_charset("utf8");

function safe_input($val_input){
$val_safe =  (strip_tags($val_input));
return  $val_safe;
}
?>