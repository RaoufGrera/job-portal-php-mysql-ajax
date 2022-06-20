<?php
$jb_host ='mysql_db' ; //localhost if you don't using docker
$jb_dbname = 'job_cv';
$jb_username = 'newuser';
$jb_password='newuser'; 
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