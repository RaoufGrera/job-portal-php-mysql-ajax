
<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
/*
# 
#التأكد من ان القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if (!isset	($_POST['fname']) || 
	empty	($_POST["fname"])||
	!isset	($_POST['lname']) || 
	empty	($_POST["lname"])||
	!isset	($_POST['email']) || 
	empty	($_POST["email"])||
	!isset	($_POST['txt_pass']) || 
	empty	($_POST["txt_pass"])
	) {
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

$fname		=	safe_input($_POST['fname']);
$lname		=	safe_input($_POST['lname']);
$email		=	safe_input($_POST['email']);
$txt_pass		=	safe_input($_POST['txt_pass']);



$insert_city = $mysqli->query("INSERT INTO `job_admin`(`fname`,`lname`,`email`,`password`)
					VALUE ('$fname','$lname','$email','$txt_pass')"); 

if(!($insert_city)){
die("حدث خطاء أثناء تحديث البيانات");
} 
else{
header("location: mange.php");
}
$mysqli->close();
?>


