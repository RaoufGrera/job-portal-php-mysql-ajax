
<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);		

/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['edt_name']) || 
	empty	($_POST["edt_name"])) {
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

$edt_name =	safe_input($_POST['edt_name']);


$query = $mysqli->query("UPDATE `job_ed_type` SET `edt_name` = '$edt_name' WHERE edt_id = '$id' " ); 

if(!($query)){ // التأكد من تنفيذ الأستعلام
echo 'حدث خطاء في الأدخال';
} 
else{
header("location: tables.php#edtype");
} 
?>