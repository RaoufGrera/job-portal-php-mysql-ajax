<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
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


$insert_train = $mysqli->query("INSERT INTO `job_info`(`info_name`,`info_date`,`user_id`)
						VALUE ('$info_name','$info_date','$txt_user_id')"); 

if(!($insert_train)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: profile.php#info");
}
$mysqli->close();
?>


