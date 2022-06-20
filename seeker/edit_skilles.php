<?php

require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);		

	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['skilles_name']) 	|| 
	empty	($_POST["skilles_name"]) 	||
    !isset	($_POST['level_id']) 	|| 
	empty	($_POST["level_id"]))
	
	{
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

$skilles_name	=	safe_input($_POST['skilles_name']);
$level_id		=	safe_input($_POST['level_id']);

$query = $mysqli->query("UPDATE `job_skilles` SET `skilles_name` = '$skilles_name' ,  `level_id` = '$level_id' WHERE user_id = '$txt_user_id' AND skilles_id = '$id'  " ); 

if(!($query)){ // التأكد من تنفيذ الأستعلام
echo 'حدث خطاء في الأدخال';
} 
else{
header("location: profile.php#skilles");
} 
?>