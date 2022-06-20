<?php
/*
	
*/
require_once("db/db.php"); // require the db connection

if ((!isset($_POST['fname']) ))
	{
		die('دخول غير مسموح');
	}

$email		=safe_input($_POST['email']);



$query  =	$mysqli->query("(SELECT email from job_seeker where email='$email ' ) UNION (SELECT email from job_employer where email='$email ' ) "); 


if((mysqli_num_rows($query) == 1)) { // if return 1, email exist.
	echo '1';
	}


else {
	$fname		=	$_POST['fname'];
	$lname		=	$_POST['lname'];
	$gender 	= 	$_POST['gender']; 
	$rdate		=	$_POST['fdate2']."-".$_POST['fdate1']."-".$_POST['fdate'];
	$txt_pass	=	md5(safe_input($_POST['txt_pass']));
	$activation = md5(uniqid(rand(), true));
	$datereg=date("y-m-d H:i:s");
	$is_active 	= 1;

					$to 	 = $email; 
					$subject = "تفعيل الحساب الشخصي | موقع التوظيف الألكتروني";
					$newsubject='=?UTF-8?B?'.base64_encode($subject).'?=';
					$message  = '
					<html dir="rtl">
					<head>
					<title>email</title>
					</head>
					<body>
					
					
					شكراً لتسجيلك في موقع التوظيف لتوظيف الألكتروني.
					
					<br/>
					<br/>
					بيانات الحساب
					<br/>
					<br/>
					
					------------------------<br/>
					البريد الالكتروني: '.$email.'<br/>
					الرقم السري: '.$_POST['txt_pass'].'<br/>
					------------------------
					
					<br/>
					<br/>
					
				
					لتفعيل حسابك <a href=" http://localhost/www/ab_swe/AB/2/1.2/seekeractiv.php?email='.$email.'&activation='.$activation.'">أضغط هنـــا </a>
					
					<br/>
					
					</body>
					</html>
					'; 
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						
						$headers .= 'From: <joblibya@joblibya.com>' . "\r\n";
						$headers .= 'Cc: it1992t@gmail.com' . "\r\n";


  
if(!(mail($to,$newsubject,$message,$headers))){
	echo '1';
}
	$inserts = mysqli_query($mysqli,"INSERT INTO `job_seeker` (`fname` ,`lname` ,`birth_day`,`gender`,`email`,`password`,`date_register` ,`is_active`,`activation`)
						VALUE ('$fname', '$lname', '$rdate','$gender', '$email','$txt_pass','$datereg','$is_active','$activation' )"); 
	if(!($inserts)) { // if return 1, email exist.
	echo '1';
	}

		}
	
?>