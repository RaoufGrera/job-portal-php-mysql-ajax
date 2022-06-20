<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['skilles_name']) || 
	!isset	($_POST['level_id'])  	 || 
	empty	($_POST["skilles_name"]) ||
	empty	($_POST['level_id'])) {
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

$skilles_name		=	safe_input($_POST['skilles_name']);
$level_id			=	safe_input($_POST['level_id']);

	$insert_skilles = $mysqli->query("INSERT INTO `job_skilles`(`skilles_name` ,`level_id`,`user_id`)
						VALUE ('$skilles_name','$level_id','$txt_user_id')"); 

if(!($insert_skilles)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#skilles");
}
$mysqli->close();
?>


