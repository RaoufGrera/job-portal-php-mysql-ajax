<?php
session_start();
if(!empty($_SESSION['txt_user_id']))  {  
	if($_SESSION['txt_type'] =="seeker"){
	header("Location: seeker/profile.php");  
	exit();
	}else if(($_SESSION['txt_type'] =="employer") || ($_SESSION['txt_type'] =="company")){

	header("Location: company/empprofile.php");  
	exit();
}
}

?>
<!DOCTYPE html>
<html  Dir ="rtl" >
<head>

<title>
تفعيل الباحث عن عمل - ليبيا سي في
</title>

<!-- Meta Tags -->
<meta http-equiv="content" content="text/html; charset = utf-8"/>

	
	
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
			    <?php
				require_once('db/db.php');
			
			if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['activation']) && !empty($_GET['activation'])){
				
				$email = $_GET['email']; 
				$activation = $_GET['activation']; 
				
				$search = $mysqli->query("SELECT email, activation, is_active FROM job_employer WHERE email='".$email."' AND activation='".$activation."' AND is_active='3'"); 
				$match  = $search->num_rows;
				
				if($match > 0){
					
					$mysqli->query("UPDATE job_employer SET is_active='2' WHERE email='".$email."' AND activation='".$activation."' AND is_active='3'");
					echo '<div class="truee">قد تم تفعيل حسابك بنجاح يمكنك الأن تسجيل الدخول ، سيتم الأن أعادة توجيهك لصفحة تسجيل الدخول</div>';
					echo '<META http-equiv="refresh" content="3;URL=login.php">';
					echo '<br/>';
					echo 'إذا لم  يتم عرض صفحة تسجيل الدخول الرجاء ';
					echo '<a href="login.php" > أضغظ هنــــا </a>';
				}else{
				
					echo '<div class="error">عنوان التفعيل غير صحيح .</div>';
				}
				
			}else{
			
				echo '<div class="error">عنوان التفعيل غير صحيح .</div>';
			}
		?>
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