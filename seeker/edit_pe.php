<?php

require_once("session.php"); //جلب بيانات الجلسة والكويكز
	

	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['fname']) 	|| 
	empty	($_POST["fname"]) 	||
    !isset	($_POST['lname']) 	|| 
	empty	($_POST["lname"]) 	||
	!isset	( $_POST['gender']) || 
	empty	($_POST['gender'])	||
	!isset	($_POST['nat_name'])|| 
	
	!isset	( $_POST['city'])  
		

	)
	
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

$fname		=	safe_input($_POST['fname']);
$lname		=	safe_input($_POST['lname']);
$Gender 	= 	safe_input($_POST['Gender']);
$rdate		=	safe_input($_POST['fdate2'])."-".safe_input($_POST['fdate1'])."-".safe_input($_POST['fdate']);
$nat_id  =safe_input($_POST['nat_name']);
$city		=	safe_input($_POST['city']);
$address 	= 	safe_input($_POST['address']);
$health_status = 	safe_input($_POST['health_status']);
	
$query = $mysqli->query("UPDATE `job_seeker` SET `health_status` = '$health_status', `city_id` = '$city',`address` = '$address' ,`fname` = '$fname' ,  `lname` = '$lname',`birth_day` = '$rdate' , `gender` ='$gender',`nat_id`='$nat_id' WHERE user_id = '$txt_user_id' " ); 

if(!($query)){ // التأكد من تنفيذ الأستعلام
echo 'حدث خطاء في الأدخال';
} 
else{
header("location: profile.php#personalinfo");
} 
?>