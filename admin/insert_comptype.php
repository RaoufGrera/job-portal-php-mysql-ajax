
<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['comp_type']) || 
	empty	($_POST["comp_type"])) {
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

$comp_type		=	safe_input($_POST['comp_type']);


$insert_city = $mysqli->query("INSERT INTO `job_comp_type`(`comp_type_name`)
					VALUE ('$comp_type')"); 

if(!($insert_city)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: tables.php#comptype");
}
$mysqli->close();
?>


