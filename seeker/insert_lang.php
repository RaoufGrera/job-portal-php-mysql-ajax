<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['lang_id']) || 
	!isset	($_POST['level_id'])  	 || 
	empty	($_POST["lang_id"]) ||
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

$lang_id		=	safe_input($_POST['lang_id']);
$level_id			=	safe_input($_POST['level_id']);

	$insert_lang = $mysqli->query("INSERT INTO `job_lang_seeker`(`lang_id` ,`level_id`,`user_id`)
						VALUE ('$lang_id', '$level_id','$txt_user_id')"); 

if(!($insert_lang)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#lang");
}
$mysqli->close();
?>


