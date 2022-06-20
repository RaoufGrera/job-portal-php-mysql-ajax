
<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
if(isset($_SESSION['desc_id'])) { 
$desc_id = $_SESSION['desc_id'];
}
else{
die("دخول خاطئ");
}






if  (!isset($_POST['job_name'])||
	!isset($_POST['job_desc']))
	{
		die('دخول غير مسموح');
	}
	
require_once("../db/db.php"); // require the db connection
$job_name = safe_input($_POST['job_name']);
$job_desc = safe_input($_POST['job_desc']);
$job_skilles = safe_input($_POST['job_skilles']);
$city_id =  $_POST['city_id'] ;

$domain_id = $_POST['domain_id'];
$type_id =  $_POST['type_id'] ;

$salary_id =  $_POST['salary_id'] ;
$job_num = $_POST['job_num'];
$exp_min = $_POST['exp_min'];
$exp_max = $_POST['exp_max'];
$edt_id = $_POST['edt_id'];
$age_min = $_POST['age_min'];
$age_max = $_POST['age_max'];
$job_gender = $_POST['job_gender'];
$nat_id = $_POST['nat_id'];
$job_start =$_POST['job_start_y']."-".$_POST['job_start_m']."-".$_POST['job_start_d'];
$job_end = $_POST['job_end_y']."-".$_POST['job_end_m']."-".$_POST['job_end_d'];
if((strtotime($job_start)) > (strtotime($job_end))){
die('خطاء ، يجب ان يكون نهاية الأعلان اكبر من بداية الاعلان');

}

if(empty($_POST['health_status'])){
$health_status = 1;
}else{$health_status = 2;}

$is_active = $_POST['is_active'];
$exp_level = $_POST['exp_level'];
$comp_active = $_POST['comp_active'];


	
	$query = "UPDATE `job_description` SET  
              emp_id = '$txt_user_id',
              job_name = '$job_name',
              job_desc ='$job_desc',
              job_skilles =  '$job_skilles',
              city_id =  '$city_id',
              domain_id = '$domain_id',
              type_id =    '$type_id',
			  salary_id =  '$salary_id',
			  job_num =  '$job_num',
			  exp_min ='$exp_min',
			  exp_max = '$exp_max',
			  edt_id =  '$edt_id',
			  age_min = '$age_min',
			  age_max ='$age_max',
			  job_gender=  '$job_gender',
			  nat_id =  '$nat_id',
				exp_level		= '$exp_level',
			  job_start =	  '$job_start',
			  job_end ='$job_end',
			  health_status=   '$health_status',
			 
			  is_active ='$is_active',

			  comp_active =  '$comp_active' 
	
			  WHERE
			  desc_id ='$desc_id'
			  AND
			  emp_id ='$txt_user_id'
			  ";
$query_update = $mysqli->query($query);

if($query_update){
  	header("location: joblist.php");
 
} else {
	echo $query;
   die('حدث خطاء في الأستعلام.'); 
}

	
?>
