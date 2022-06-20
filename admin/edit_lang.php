<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);		

/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['lang_name']) || 
	empty	($_POST["lang_name"])) {
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

$lang_name =	safe_input($_POST['lang_name']);

$sql = "UPDATE `job_lang` SET `lang_name` = '$lang_name' WHERE lang_id = '$id' ";
$insert = $mysqli->query($sql); 

if(!($insert)){ // التأكد من تنفيذ الأستعلام

echo 'حدث خطاء في الأدخال';
} 
else{
header("location: tables.php#lang");
} 
?>