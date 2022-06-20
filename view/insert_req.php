<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
$id = $_SESSION['id'];
$goal_name = $_POST['goal_name'];

unset($_SESSION['id']);	
/*
# 
#التأكد من الأن القيم تم أرسالها وكذالك التأكد من ان البيانات تحتوي علي قيم 
#
*/

if ((isset($_POST['desc_req'])) ||
	(isset($_POST['goal_name'])))  {

	

		$insert = $mysqli->query("insert into job_seeker_req  (`seeker_id`,`desc_id`,`req_date`,`goal_id`) value ($txt_user_id,$id,NOW(),'$goal_name')");
				if(!($insert)){
				$_SESSION["msg"] = "msg_false";
				header("location: job.php?id=$id");
				}
				else{
				$_SESSION["msg"] = "req_insert";
				header("location: job.php?id=$id");
				}
		}else{
		
		die('خطاء الرجاء المحاولة مرة أخري');
		}
