<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['ref_name']) || 
	empty	($_POST["ref_name"])||
	!isset	($_POST['ref_adj']) || 
	empty	($_POST["ref_adj"])) {
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

$ref_name	=	safe_input($_POST['ref_name']);
$ref_adj	=	safe_input($_POST['ref_adj']);
$ref_email	=	safe_input($_POST['ref_email']);
$ref_phone	=	safe_input($_POST['ref_phone']);

$insert_train = $mysqli->query("INSERT INTO `job_ref`(`ref_name`,`ref_email`,`ref_phone`,`ref_adj`,`user_id`)
						VALUE ('$ref_name','$ref_email','$ref_phone','$ref_adj','$txt_user_id')"); 

if(!($insert_train)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#ref");
}
$mysqli->close();
?>


