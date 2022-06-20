<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if(isset($_POST['delete_ref']))	{
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات
	$delete = $mysqli->query("DELETE FROM job_ref
								WHERE ref_id = '$id' 
								AND user_id ='$txt_user_id'")or die($mysqli->error());
	if(!($delete)){
	die("حدث خطاء أثناء حذف البيانات");
	}
	header("location: profile.php#ref");
}
else{
header("location: profile.php#ref");
}

?>