<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
$id = $_SESSION['id'];
unset($_SESSION['id']);	


/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['info_name']) || 
	empty	($_POST["info_name"])||
	!isset	($_POST['info_date']) || 
	empty	($_POST["info_date"])) {
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

$info_name	=	safe_input($_POST['info_name']);
$info_date	=	safe_input($_POST['info_date']);


$update_ed = $mysqli->query("UPDATE `job_info` SET `info_name` = '$info_name' ,`info_date` = '$info_date' 
									WHERE info_id = '$id' AND user_id='$txt_user_id'")or die($mysqli->error());
if(!($update_ed)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#info");
}
$mysqli->close();
?>