<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['ref_name']) || 
	empty	($_POST["ref_name"])||
	!isset	($_POST['ref_adj']) || 
	empty	($_POST["ref_adj"])) {
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
$ref_name	=	safe_input($_POST['ref_name']);
$ref_adj	=	safe_input($_POST['ref_adj']);
$ref_email	=	safe_input($_POST['ref_email']);
$ref_phone	=	safe_input($_POST['ref_phone']);

$update_ed = $mysqli->query("UPDATE `job_ref` SET `ref_name` = '$ref_name' ,`ref_adj` = '$ref_adj' ,`ref_email` = '$ref_email' ,`ref_phone` = '$ref_phone'
									WHERE ref_id = '$id' AND user_id='$txt_user_id'")or die($mysqli->error());
if(!($update_ed)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#ref");
}
$mysqli->close();
?>