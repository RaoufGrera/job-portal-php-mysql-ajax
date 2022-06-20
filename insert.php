<?php

$arrayname = 
array (
	"أحمد",
	"سليم",
	"فاطمة",
	"سهام",
	"عماد",
	"جمال",
	"فوزي",
	"سراج",
	"مصعب",
	"محمد",
	"محمود",
	"كمال",
	"علاء",
	"عصام",
	"عادل",
	"خالد",
	"ايمن",
	"سعيد",
	"عبدالسلام",
	"عبدالرحمن",
	"يوسف",
	"منصور",
	"عامر",
	"ريان",
	"عبدالله",
	"حاتم",
	"صالح",
	"صلاح"
)
						
						
require_once("db/db.php"); 
for($i =200; $i>250 ; i++){
	
		$insertstmt= "INSERT INTO `job_seeker` (`fname` ,`lname` ,`birth_day`,`gender`,`email`,`password`,`date_register` ,`is_active`,`activation`)";
		
		$insertstmt="VALUE ('$fname', '$lname', '$rdate','m', '$email','$txt_pass','$datereg','1','$activation' )"); 
					
		$inserts = mysqli_query($mysqli,"INSERT INTO `job_seeker` (`fname` ,`lname` ,`birth_day`,`gender`,`email`,`password`,`date_register` ,`is_active`,`activation`)")
					VALUE ('$fname', '$lname', '$rdate','$gender', '$email','$txt_pass','$datereg','$is_active','$activation' )"); 
} 
?>