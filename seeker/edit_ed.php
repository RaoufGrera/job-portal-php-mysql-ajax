<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);	
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
$arrayavg 		=	$_POST['arrayavg'];
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
/* $results = $mysqli->query("SELECT ed_id 
								FROM job_ed
								WHERE ed_id='$id'
								AND user_id='$txt_user_id'")or die($mysqli->error());
if($results->num_rows != 1) {
die("دخول خاطئ");
} */

$update_ed = $mysqli->query("UPDATE `job_ed` SET `edt_id` = '$ed_name' ,`domain_id` = '$dom_name' ,`specialty` = '$specialty' ,`avg` = '$avg_num',`univ` = '$univ',`start_date` = '$start_date',`end_date` = '$end_date'
									WHERE ed_id = '$id'")or die($mysqli->error());
if(!($update_ed)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#ed");
}
$mysqli->close();
?>