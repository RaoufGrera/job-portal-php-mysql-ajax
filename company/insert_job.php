<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز

if  ((empty($_POST['job_name'])) ||

			(empty($_POST['job_name']))||
			(empty($_POST['job_desc']))||
			(empty($_POST['job_skilles'])))
	{
		die('دخول غير مسموح');
	}
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات	
$user_id = $_SESSION['txt_user_id'];
$job_name = safe_input($_POST['job_name']);
$job_desc = safe_input($_POST['job_desc']);
$job_skilles = safe_input($_POST['job_skilles']);
$city_id =  safe_input($_POST['city_id']) ;

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
$exp_level = $_POST['exp_level'];
$job_start =$_POST['job_start_y']."-".$_POST['job_start_m']."-".$_POST['job_start_d'];
$job_end = $_POST['job_end_y']."-".$_POST['job_end_m']."-".$_POST['job_end_d'];
if((strtotime($job_start)) > (strtotime($job_end))){
die('خطاء ، يجب ان يكون نهاية الأعلان اكبر من بداية الاعلان');

}
if(empty($_POST['health_status'])){
$health_status = 1;
}else{$health_status = 2;}

$is_active = $_POST['is_active'];

$comp_active = $_POST['comp_active'];

  

	
	$query = "INSERT INTO `job_description` (
              emp_id,
              job_name,
              job_desc,
              job_skilles,
              city_id,
              domain_id,
              type_id,
			  salary_id,
			  job_num,
			  exp_min,
			  exp_max,
			  edt_id,
			  age_min,
			  age_max,
			  job_gender,
			  nat_id,
			  exp_level,
			  job_start,
			  job_end,
			  health_status,
			
			  is_active,
			 
			  comp_active
			

          ) VALUE (
		   '$user_id',
             '$job_name',
              '$job_desc',
              '$job_skilles',
              '$city_id',
              '$domain_id',
              '$type_id',
			  '$salary_id',
			  '$job_num',
			  '$exp_min',
			  '$exp_max',
			  '$edt_id',
			  '$age_min',
			  '$age_max',
			  '$job_gender',
			  '$nat_id',
			  '$exp_level',
			  '$job_start',
			  '$job_end',
			  '$health_status',
		
			  '$is_active',
		
			  '$comp_active'
			
            
          )";
 



$insertjob = $mysqli->query($query);

if($insertjob){
   header("location: joblist.php");
    die();
} else {
	echo $query;
   die('حدث خطاء في الأستعلام.'); 
}



?>