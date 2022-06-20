<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if(isset($_POST['delete_lang']))	{
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات
	$delete = $mysqli->query("DELETE FROM job_lang_seeker 
								WHERE lang_id = '$id' 
								AND user_id ='$txt_user_id'")or die($mysqli->error());
	if(!($delete)){
	die("حدث خطاء أثناء حذف البيانات");
	}
	header("location: profile.php#lang");
}
else{
header("location: profile.php#lang");
}

?>