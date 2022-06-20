<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
if(isset($_POST['change_pic'])) { // التأكد من أنه قد تم أرسال الصورة عن طريق 


if ((($_FILES["fileField"]["type"] == "image/gif")
		|| ($_FILES["fileField"]["type"] == "image/jpeg")
		|| ($_FILES["fileField"]["type"] == "image/jpg")
		|| ($_FILES["fileField"]["type"] == "image/png"))
		&& ($_FILES["fileField"]["size"] < 200000)){ // لايكون حجم الصورة أكثر من 200 كيلو بايت

		$type_pic= basename($_FILES["fileField"]["type"]); // حفظ اسم الصورة ونوعها
		$name_pic =$txt_user_id.".".$type_pic;
		$filename = "../images/company/".$name_pic;
		 if (file_exists($filename)) {
		 if(!unlink($filename)){
		 die("حدث خطاء أثناء حذف الصورة القديمة");
		 }
		 
		 }
		

	
  if (file_exists($filename)) {
  
  }
	if(move_uploaded_file($_FILES['fileField']['tmp_name'],$filename)){
		if (file_exists($filename)) {
		include("../inc/easyphpthumbnail.class.php");
		$thumb = new easyphpthumbnail;
		 $thumb -> Thumbsize = 140;
		 $thumb -> Createthumb($filename,'file');
		 $thumb =dirname(__FILE__)."/".$name_pic;
		$query_pic=$mysqli->query("UPDATE job_company,job_employer SET job_company.image ='$name_pic' WHERE  job_company.comp_id = job_employer.comp_id   AND job_employer.level ='1' AND emp_id ='$txt_user_id' ")or die(mysql_error());
			if(copy($thumb,$filename)){
			!unlink($thumb);
			
			}
			if(!$query_pic){
			$_SESSION["msg"] = "msg_false";
			header("location: compprofile.php");
			}
			else{
			 if (file_exists($filename)) {

			$_SESSION["msg"] = "msg_true";
			header("location: compprofile.php");
			}
			}
		}
	}
	
}

else {
	$_SESSION["msg"] = "msg_max";
 	header("location: compprofile.php");

}
		
}

?>
