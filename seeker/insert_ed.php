<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['ed_name']) 	|| 
	empty	($_POST["ed_name"]) 	||
	!isset	( $_POST['dom_name'])   || 
	empty	($_POST['dom_name'])	||
	!isset	($_POST['univ']) 		|| 
	empty	($_POST['univ'])		||
	!isset	($_POST['avg_num']) 	|| 
	!isset	($_POST['specialty']) 	|| 
	!isset	($_POST['start_date']) 	|| 
	empty	($_POST["start_date"]) 	||
	!isset	($_POST['end_date']) 	||
	!isset	($_POST['arrayavg']) 	|| 
	empty	($_POST["end_date"])) {
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

$ed_name		=	safe_input($_POST['ed_name']);
$dom_name		=	safe_input($_POST['dom_name']);
$univ 			= 	safe_input($_POST['univ']);
$avg_num 		= 	safe_input($_POST['avg_num']);
$specialty	 	= 	safe_input($_POST['specialty']);
$start_date 	= 	safe_input($_POST['start_date']);
$end_date 		= 	safe_input($_POST['end_date']);
if($avg_num != ""){
if($arrayavg ==0){
$avg_num = $avg_num;
}
else if($arrayavg ==1){
$avg_num = ($avg_num * 20);
}
else if($arrayavg ==2){
$avg_num = ($avg_num * 25);
}
}
$insert_ed = $mysqli->query("INSERT INTO `job_ed`(`edt_id` ,`domain_id`,`univ`,`specialty`,`avg`,`start_date`,`end_date`,`user_id`)
						VALUE ('$ed_name', '$dom_name','$univ', '$specialty','$avg_num','$start_date','$end_date','$txt_user_id')")or die($mysqli->error());

if(!($insert_ed)){
die("حدث خطاء أثناء أضافة البيانات");
} 
else{
header("location: profile.php#ed");
}
$mysqli->close();
?>