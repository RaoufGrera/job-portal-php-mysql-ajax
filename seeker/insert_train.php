<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['train_name']) || 
	empty	($_POST["train_name"]) ||
	!isset	($_POST['train_comp']) || 
	empty	($_POST["train_comp"])) {
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

$train_name	=	safe_input(strip_tags($_POST['train_name']));
$train_comp		=	safe_input(strip_tags($_POST['train_comp']));

	$insert_train = $mysqli->query("INSERT INTO `job_train`(`train_name`,`train_comp`,`user_id`)
						VALUE ('$train_name','$train_comp','$txt_user_id')"); 

if(!($insert_train)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#train");
}
$mysqli->close();
?>


