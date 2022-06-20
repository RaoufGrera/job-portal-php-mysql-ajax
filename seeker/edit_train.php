<?php

require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);		

	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
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

$train_name	=	safe_input($_POST['train_name']);
$train_comp		=	safe_input($_POST['train_comp']);

$query = $mysqli->query("UPDATE `job_train` SET `train_name` = '$train_name',`train_comp` = '$train_comp'  WHERE user_id = '$txt_user_id' AND train_id = '$id'  " ); 

if(!($query)){ // التأكد من تنفيذ الأستعلام
echo 'حدث خطاء في الأدخال';
} 
else{
header("location: profile.php#train");
} 
?>