<?php
/*
	
*/
require_once("../db/db.php"); // require the db connection

if ( (!isset($_POST['email'])) || (!isset($_POST['txt_pass'])))
	{
		die('bad Access');
	}

$email		=	$_POST['email'];

$txt_user		=	$_POST['email'];

$query  =	mysqli_query($mysqli,"(SELECT email FROM `job_employer` WHERE email ='$email' ) UNION (SELECT email FROM job_seeker WHERE email ='$email')"); 


 if(mysqli_num_rows($query)>=1){
echo '2';
}

else {
	$comp_name		=	$_POST['comp_name'];
	$fname		=	$_POST['fname'];
	$lname		=	$_POST['lname'];
	
	$txt_pass	=	@md5(mysqli_real_escape_string(strip_tags($_POST['txt_pass'])));
	$activation = md5(uniqid(rand(), true));
	$datereg=date("y-m-d H:i:s");
	$is_active 	= 2;
	$insert_comp = $mysqli->query("INSERT INTO `job_company` (`comp_name`)
						VALUE ('$comp_name')"); 
	  $get_query=mysqli_query($mysqli,"select comp_id  from job_company where comp_name='$comp_name'")or die(mysql_error());
                        $row=mysqli_fetch_array($get_query);
							$id =	$row['comp_id'];

	$inserts = mysqli_query($mysqli,"INSERT INTO `job_employer` (`fname` ,`lname`,`email`,`password`,`date_register`,`is_active`,`activation`,`comp_id`)
						VALUE ('$fname', '$lname','$email','$txt_pass','$datereg','$is_active','$activation','$id')"); 
		header("location: control_user.php");
					/* $to 	 = $email; 
					$subject = "تسجيل | تفعيل الحساب الشخصي";
 $newsubject='=?UTF-8?B?'.base64_encode($subject).'?=';
					$message  = '
					<html dir="rtl">
					<head>
					<title>email</title>
					</head>
					<body>
					
					
					موقع التوظيف لتوظيف الألكتروني
					
					<p>
					<br>
					
					شكراً لتسجيلك في موقع التوظيف لتوظيف الألكتروني.
					<p><br>
					قد تم تسجيلك بنجاح في الموقع الرجاء إتباع التعليمات التالية لتفعيل حسابك.
					<p><br>
					
					------------------------<p>
					أسم المستخدم: '.$fname.'<p>
					الرقم السري: '.$txt_pass.'<p>
					------------------------
					
					<p><p>
					
					الرجاء الضغظ علي العنوان التالي لتفعيل حسابك :<p><p>
					<a href=" http://localhost/2/1/Seekeractiv.php?email='.$email.'&Activation='.$activation.'"> http://localhost/2/1/Seekeractiv.php?email='.$email.'&Activation='.$activation.'</a>
					
					<p>
					
					</body>
					</html>
					'; 
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						
						$headers .= 'From: <webmaster@example.com>' . "\r\n";
						$headers .= 'Cc: myboss@example.com' . "\r\n";


  if(mail($to,$newsubject,$message,$headers)){
			header("location: control_user.php?fdsa");

		}else{
		header("location: control_user.php");
		}
	 */
	 }
?>