<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['level_name']) || 
	empty	($_POST["level_name"])) {
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

$level_name		=	safe_input($_POST['level_name']);


$insert_city = $mysqli->query("INSERT INTO `job_level`(`level_name`)
					VALUE ('$level_name')"); 

if(!($insert_city)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: tables.php#level");
}
$mysqli->close();
?>


