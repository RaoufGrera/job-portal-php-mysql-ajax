<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز

/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['goal_text'])   || 
	empty	($_POST['goal_text'])) {
		die('دخول غير مسموح');
	}	
require_once("../db/db.php"); // الأتصال بقاعدة البيانات

/*
#دالة safe_input 
#طريقة العمل : تقوم بأستقبال قيمة لتأمينها ومن ثم أرجاع القيمة بعد التأمين
#الوظيفة : تقوم بتأمين المدخلات أي حماية الموقع من اي عمليات حقن تعليمات الاستعلام البنيوية 
#
#SQL INJECTION
#
*/


$goal_text	=	safe_input($_POST['goal_text']);


	$update_exp = $mysqli->query("UPDATE `job_seeker` SET `goal_text` ='$goal_text'
									WHERE `user_id` ='$txt_user_id' "); 


 
if(!($update_exp)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#goal");
}
$mysqli->close();
?>
