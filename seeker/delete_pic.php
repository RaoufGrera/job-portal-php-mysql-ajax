<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
if(isset($_POST['delete_pic'])) { // التأكد من أنه قد تم أرسال الصورة عن طريق 
$query_pic=$mysqli->query("SELECT image FROM job_seeker 
							WHERE user_id ='$txt_user_id' ")or die(mysql_error());
$rows = $query_pic->fetch_object();
$query_pic->free_result();
$filename = "../images/seeker/".$rows->image;
if (file_exists($filename)) {
	unlink($filename);
	if (file_exists($filename)) {
		 if (file_exists($filename)) {
		 if(!unlink($filename)){
		 die("حدث خطاء أثناء حذف الصورة القديمة");
		 }
		 
		 }
		 }
$query_pic=$mysqli->query("UPDATE job_seeker SET image ='' WHERE user_id ='$txt_user_id' ")or die(mysql_error());	 	 
$_SESSION["msg"] = "msg_true";
header("location: profile.php#pic");
}else{
$_SESSION["msg"] = "msg_false";
header("location: profile.php#pic");
}
}
 ?>