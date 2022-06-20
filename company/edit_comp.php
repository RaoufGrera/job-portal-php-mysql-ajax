<?php

require_once("session.php"); //جلب بيانات الجلسة والكويكز


	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['insert_comp']) 	|| 
		!isset	($_POST['comp_name']) 	||
			!isset	($_POST['domain_id']) 	|| 
			!isset	($_POST['url']) 	|| 
			empty	($_POST["domain_id"]) 	||
			!isset	($_POST['address']) 	|| 
		
			!isset	($_POST['comp_type_id']) 	|| 
			empty	($_POST["comp_type_id"]) 	||
			!isset	($_POST['start_comp']) 	|| 

			!isset	($_POST['comp_desc']) 	|| 
		
			!isset	($_POST['city_id']) 
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
$comp_name	=	safe_input($_POST['comp_name']);
$url	=	safe_input($_POST['url']);
$phone	=	safe_input($_POST['phone']);
$address		=	safe_input($_POST['address']);
$domain_id	=	safe_input($_POST['domain_id']);
$comp_type_id		=	safe_input($_POST['comp_type_id']);
$start_comp	=	safe_input($_POST['start_comp']);
$comp_desc		=	safe_input($_POST['comp_desc']);
$city_id		=	safe_input($_POST['city_id']);
$size_comp = safe_input($_POST['size_comp']);

$sql="UPDATE job_employer,job_company SET `size_comp`= '$size_comp',`comp_name` = '$comp_name' ,`url` = '$url' ,`phone` = '$phone' ,`comp_type_id` = '$comp_type_id',`domain_id` = '$domain_id',`start_comp` = '$start_comp',`address` = '$address',`city_id` = '$city_id',`comp_desc` = '$comp_desc' 
		WHERE job_company.comp_id = job_employer.comp_id AND job_employer.level ='1' AND  job_employer.emp_id = '$txt_user_id' ";
$query = $mysqli->query($sql); 

if(!($query)){ // التأكد من تنفيذ الأستعلام

echo 'حدث خطاء في الأدخال';
} 
else{
header("Location: compprofile.php");  
} 
?>