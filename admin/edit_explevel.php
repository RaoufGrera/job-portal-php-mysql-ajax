
<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);		

/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['exp_type_name']) || 
	empty	($_POST["exp_type_name"])) {
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

$edit_exptype =	safe_input($_POST['exp_type_name']);


$query = $mysqli->query("UPDATE `job_exp_type` SET `exp_type_name` = '$edit_exptype' WHERE exp_type_id = '$id' " ); 

if(!($query)){ // التأكد من تنفيذ الأستعلام
echo 'حدث خطاء في الأدخال';
} 
else{
header("location: tables.php#explevel");
} 
?>