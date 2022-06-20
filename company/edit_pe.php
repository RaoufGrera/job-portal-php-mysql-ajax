<?php

require_once("session.php"); //جلب بيانات الجلسة والكويكز


	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['insert_pe']) 	|| 
		
			!isset	($_POST['fname']) 	|| 
			empty	($_POST["fname"]) 	||
			!isset	($_POST['lname']) 	|| 
			empty	($_POST["lname"]))
	
	{
		die('دخول غير مسموح');
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

$fname	=	safe_input($_POST['fname']);
$lname		=	safe_input($_POST['lname']);

$sql="UPDATE `job_employer` SET `lname` = '$lname' ,`fname` = '$fname' WHERE emp_id = '$txt_user_id'    ";
$query = $mysqli->query($sql); 

if(!($query)){ // التأكد من تنفيذ الأستعلام

echo 'حدث خطاء في الأدخال';
} 
else{
header("Location: empprofile.php");  
} 
?>