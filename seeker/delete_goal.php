<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز

/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if(isset($_POST['delete_ed']))	{
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات
	$delete = $mysqli->query("UPDATE `job_seeker` SET `goal_text` =''
									WHERE `user_id` ='$txt_user_id' ")or die($mysqli->error());
	if(!($delete)){
	die("حدث خطاء أثناء تحديث البيانات");
	}
	header("location: profile.php#goal");
}
else{
header("location: profile.php#goal");
}

?>