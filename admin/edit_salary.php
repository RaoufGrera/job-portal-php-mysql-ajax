<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);		

/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['salary_name']) || 
	empty	($_POST["salary_name"])) {
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

$salary_name =	safe_input($_POST['salary_name']);

$sql = "UPDATE `job_salary` SET `salary_name` = '$salary_name' WHERE salary_id = '$id' ";
$insert = $mysqli->query($sql); 

if(!($insert)){ // التأكد من تنفيذ الأستعلام

echo 'حدث خطاء في الأدخال';
} 
else{
header("location: tables.php#salary");
} 
?>