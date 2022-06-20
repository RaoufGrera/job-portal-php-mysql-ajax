<?php

require_once("../db/db.php"); 
require_once("session.php");
if ( (!isset($_POST['email'])) || (!isset($_POST['txt_pass'])))
	{
		die('غير مسموح لك بالدخول');
	}
$email		=	$_POST['email'];
$query  =	$mysqli->query("(SELECT email FROM `job_employer` WHERE email ='$email' ) UNION (SELECT email FROM job_seeker WHERE email ='$email')"); 

 if(mysqli_num_rows($query)>=1){
echo '2';
}

else {
$result  =	$mysqli->query("SELECT job_company.comp_id FROM job_employer,job_company WHERE job_employer.comp_id = job_company.comp_id AND job_employer.emp_id ='$txt_user_id' AND level='1' ");
	if($result){
		$rows = $result->fetch_object();
	}else{die('خطاء');}


	$fname		=	$_POST['fname'];
	$lname		=	$_POST['lname'];
	$comp_idd = $rows->comp_id;
	$txt_pass	=	md5(safe_input($_POST['txt_pass']));
	$activation = md5(uniqid(rand(), true));
	$datereg=date("y-m-d H:i:s");
	$is_active 	= 3;
	$level 	= '0';
	$inserts =$mysqli->query("INSERT INTO `job_employer` (`fname` ,`lname`,`email`,`password`,`date_register`,`is_active`,`activation`,`comp_id`)
						VALUE ('$fname', '$lname','$email','$txt_pass','$datereg','$is_active','$activation','$comp_idd')"); 
	
					$to 	 = $email; 
					$subject = "تسجيل | تفعيل الحساب الشخصي";
					$newsubject='=?UTF-8?B?'.base64_encode($subject).'?=';
					$message  = '
					<html dir="rtl">
					<head>
					<title>email</title>
					</head>
					<body>
					
					
					موقع التوظيف لتوظيف الألكتروني
					
					<br/>
					<br/>
					
					شكراً لتسجيلك في موقع التوظيف لتوظيف الألكتروني.
					<p><br>
					قد تم تسجيلك بنجاح في الموقع الرجاء إتباع التعليمات التالية لتفعيل حسابك.
					<br/>
					
					------------------------<br/>
					البريد الألكتروني: '.$email.'<br/>
					الرقم السري: '.$_POST['txt_pass'].'<br/>
					------------------------
				
					<br/>
					<br/>
					
					الرجاء الضغظ علي العنوان التالي لتفعيل حسابك :<p><p>
					<a href=" http://localhost/www/ab_swe/AB/2/1.2/empactiv.php?email='.$email.'&activation='.$activation.'"> أضغط هنـــا </a>
					
					<br/>
					
					</body>
					</html>
					'; 
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						
						$headers .= 'From: <webmaster@example.com>' . "\r\n";
						$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$newsubject,$message,$headers);
  			
  			
}
	
?>