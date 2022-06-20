<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['exp_comp']) 	|| 
	!isset	($_POST['dom_id'])   || 
	!isset	($_POST['exp_name']) 	|| 
	!isset	($_POST['exp_desc']) 	|| 
	!isset	($_POST['start_date_m']) || 
	!isset	($_POST['start_date_y']) || 
	!isset	($_POST['end_date_y']) 	||
	!isset	($_POST['end_date_m']) 	||

	empty	($_POST["exp_comp"]) 	||
	empty	($_POST['dom_id'])	||
	empty	($_POST['exp_name'])	||
	empty	($_POST["start_date_y"]) ||
	empty	($_POST["start_date_m"]) ||
	empty	($_POST["end_date_y"])	||
	empty	($_POST["end_date_m"])) {
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

$exp_comp			=	safe_input($_POST['exp_comp']);
$dom_id				=	safe_input($_POST['dom_id']);
$exp_name 			= 	safe_input($_POST['exp_name']);
$start_date 		= 	safe_input($_POST['start_date']);
$exp_desc	 		= 	safe_input($_POST['exp_desc']);
$start_date_y 		= 	safe_input($_POST['start_date_y']);
$start_date_m 		= 	safe_input($_POST['start_date_m']);
$end_date_y 		= 	safe_input($_POST['end_date_y']);
$end_date_m 		= 	safe_input($_POST['end_date_m']);

	$start_date		=	$start_date_y."-".$start_date_m."-"."01";
	if($end_date_y == "1"){
	$state ='1';
	$end_date = date("y-m-d");
	}
	else{
	$end_date		=  $end_date_y."-".$end_date_m ."-"."01";
	$state ='0';
	}
	
	$update_exp = $mysqli->query("UPDATE `job_exp` SET `exp_comp` = '$exp_comp' ,`domain_id` ='$dom_id',`exp_name` ='$exp_name',`start_date`='$start_date',`end_date`='$end_date',`state`=$state,`exp_desc` ='$exp_desc'
									WHERE `user_id` ='$txt_user_id' AND `exp_id`='$id'"); 


 
if(!($update_exp)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#exp");
}
$mysqli->close();
?>
