
<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
	

/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['warning_active']) ) {
		die('يجب تعبئة كل الحقول المطلوبة');
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

$warning_active =	safe_input($_POST['warning_active']);


$query = $mysqli->query("UPDATE `job_seeker` SET `warning_active` = '$warning_active' WHERE user_id = '$txt_user_id'   " ); 

if(!($query)){ // التأكد من تنفيذ الأستعلام

$_SESSION["msg"] = "error";
header("location: settings.php");
}else{
$_SESSION["msg"] = "truee";
header("location: settings.php");
} 
?>