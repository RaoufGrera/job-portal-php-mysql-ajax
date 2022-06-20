<?php
/*
	
*/
require_once("db/db.php"); // require the db connection

if ( (!isset($_POST['email'])) || (!isset($_POST['comp_name'])) || (!isset($_POST['txt_pass'])))
	{
		die('غير مسموح لك بالدخول');
	}



$email		=	$_POST['email'];

$query  =	$mysqli->query("(SELECT email FROM `job_employer` WHERE email ='$email' ) UNION (SELECT email FROM job_seeker WHERE email ='$email')"); 

 if(mysqli_num_rows($query)==1){
echo '2';
}

else {
	$fname		=	safe_input($_POST['fname']);
	$lname		=	safe_input($_POST['lname']);
	$comp_name = safe_input($_POST['comp_name']);
	$txt_pass	=	md5(safe_input($_POST['txt_pass']));
	$activation = md5(uniqid(rand(), true));
	$datereg=date("y-m-d H:i:s");
	$is_active 	= 3;
	$level 	= 1;
	$inserts_comp = $mysqli->query("INSERT INTO `job_company` (`comp_name`)
						VALUE ('$comp_name' )"); 
	$select_comp = $mysqli->query("SELECT comp_id FROM job_company WHERE comp_name ='$comp_name' ");
	$rows = $select_comp->fetch_object();
	$comp_id = $rows->comp_id;

	  	$inserts = $mysqli->query("INSERT INTO `job_employer` (`fname` ,`lname`,`email`,`password`,`date_register`,`is_active`,`activation`,`level`,`comp_id`)
						VALUE ('$fname', '$lname','$email','$txt_pass','$datereg','$is_active','$activation','$level','$comp_id' )"); 
						
	if(!($inserts)) { // if return 1, email exist.
	echo '1';

	}	
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
					اسم الشركة: '.$comp_name.'<br/>
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