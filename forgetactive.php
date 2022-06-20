<?php
require_once("db/db.php");

if(!empty($_POST['login'])) {
				
		$txt_email		 = safe_input(trim($_POST['txt_email']));
		$datenow = date("Y-m-d");
		$txt_pass		=	md5(safe_input($_POST['txt_pass']));
			
	 
		$remember = $_POST['remember'];
			
		$query = $mysqli->query("(SELECT user_id,count_in,email,is_active from job_seeker where email='$txt_email' AND password='$txt_pass' AND is_active in('0')) UNION (SELECT user_id,count_in,email,is_active from job_employer where email='$txt_email' AND password='$txt_pass' AND is_active in('2')) ");
		if(!$query) {
			die("خطاء في تسجيل الدخول ");
		}
?>
<!DOCTYPE html>
<html>
<head>

<title>
اعادة تفعيل البريد الألكتروني
</title>

<!-- Meta Tags -->
<meta http-equiv="content" content="text/html; charset = utf-8"/>

<link href="css/bootstrap.css" rel="stylesheet">	
	
<!-- CSS -->
<link rel="stylesheet" href="css/style1.css" type="text/css">
<link href="css/structurep.css" rel="stylesheet">
<link href="css/silder.css" rel="stylesheet">
</head>
    <body>

		<div class="wrapper">
		<div id="header">
			<div class="had">
			<a href="index.php"><img src="images/logo44.png" alt="logo" ></a>
			</div>
			<div class="hed">
</div>
	</div>

<div id="container" >
	<div class="span1">
		<div class="item">	
	<br/>
	<br/>
	<br/>
       	<div id="wrap">
			<br/>
البريد الألكتروني : <input type='text' name="email"></input>
	<br/><br/>
	<input type="submit" class="btn btn-info" value="أستعادة كلمة السر"/>
		</div>
	<br/>
	<br/>
	<br/>
</div>
</div>
</div>
</div>


		
</body>

</html>