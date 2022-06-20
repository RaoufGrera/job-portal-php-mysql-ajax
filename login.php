<?php 
session_start();  
if(!empty($_SESSION['txt_user_id']))  {  
	if($_SESSION['txt_type'] =="seeker"){
	header("Location: seeker/profile.php");  
	exit();
	}else if(($_SESSION['txt_type'] =="employer") || ($_SESSION['txt_type'] =="company")){
	header("Location: company/empprofile.php");  
	}else if($_SESSION['txt_type'] == "admin"){
	header("Location: admin/index.php");
	exit();
}
}

error_reporting(0); //لاخفاء الأخطاء

require_once("db/db.php"); 

if(!empty($_POST["login"])) {
				
		$txt_email		 = safe_input(trim($_POST['txt_email']));
		$datenow = date("Y-m-d");
		$txt_pass		=	md5(safe_input($_POST['txt_pass']));
			
	 
	
			
		$query = $mysqli->query("(SELECT user_id,count_in,email,is_active from job_seeker where email='$txt_email' AND password='$txt_pass' AND is_active in('0') AND block_admin in('0') ) UNION (SELECT emp_id as user_id,count_in,email,is_active from job_employer where email='$txt_email' AND password='$txt_pass' AND is_active in('2') AND block_admin in('0') )");
		if(!$query) {
			die("خطاء في تسجيل الدخول ");
		}
		if(mysqli_num_rows($query) == 1) { // if found the user in database, store session 
			$found_user = $query->fetch_array();
		$user_id=$found_user['user_id'];
			
			if ($found_user['is_active'] == 0){
							if($remember == "yes") { // if checked the 'Remember me' checkbox, store the user id in cookie
						
						  // name,    value,                    ,expire date,      path	
				setcookie('txt_user_id', $found_user['user_id'] , time()+(60*60*24*7), ""); // seconds,  minutes,  day, week
				setcookie('txt_type', 'seeker', time()+(60*60*24*7), ""); // seconds,  minutes,  day, week
			} else { 
				$_SESSION['txt_user_id'] 	= $found_user['user_id'];
				$_SESSION['txt_type'] = 'seeker';
			}
				
				$count_in=$found_user['email'];
		$query_insert_lang = $mysqli->query("UPDATE `job_seeker` SET `last_seen` = '$datenow' ,`count_in` = (count_in +1) WHERE  `email` ='$txt_email'");
		if(!($query_insert_lang)){echo 'rrrrrrorr';} 
			else{
			header("Location:seeker/profile.php");}
			
			exit();

			
		} elseif ($found_user['is_active'] ==2){
		$queryy = $mysqli->query("SELECT emp_id,level FROM job_employer WHERE emp_id='$user_id'");
		if(!$queryy) {
			die("خطاء في تسجيل الدخول ");
		}
		if($queryy->num_rows == 1) {
		$found_user = $queryy->fetch_array();
			if($found_user['level'] == 1){
			if($remember == "yes") { // if checked the 'Remember me' checkbox, store the user id in cookie
						
						  // name,    value,                    ,expire date,      path	
				setcookie('txt_user_id', $found_user['emp_id'] , time()+(60*60*24*7), ""); // seconds,  minutes,  day, week
				setcookie('txt_type', 'company', time()+(60*60*24*7), ""); // seconds,  minutes,  day, week
								header("Location:company/jobrequest.php");

			} else { 
				$_SESSION['txt_type'] = 'company';
				$_SESSION['txt_user_id'] 	= $found_user['emp_id'];
				$query = $mysqli->query("UPDATE `job_employer` SET last_seen = '$datenow' ,`count_in` = (count_in +1) WHERE  email='$txt_email'");
			header("Location:company/jobrequest.php");}
			}
				else if($found_user['level'] == 0){
												if($remember == "yes") { // if checked the 'Remember me' checkbox, store the user id in cookie
						
						  // name,    value,                    ,expire date,      path	
				setcookie('txt_user_id', $found_user['emp_id'] , time()+(60*60*24*7), ""); // seconds,  minutes,  day, week
				setcookie('txt_type', 'company', time()+(60*60*24*7), ""); // seconds,  minutes,  day, week
								header("Location:company/jobrequest.php");

			} else { 
				$_SESSION['txt_type'] = 'employer';
				$_SESSION['txt_user_id'] 	= $found_user['emp_id'];
				$query = $mysqli->query("UPDATE `job_employer` SET last_seen = '$datenow' ,`count_in` = (count_in +1) WHERE  email='$txt_email'");
				header("Location:company/jobrequest.php");
				}
				}
		
		}
		}
		else { 
		$_SESSION['msg'] = 'msg_false';
			header("Location: login.php");
			exit();
		  
		  }
	}else { 
		$_SESSION['msg'] = 'msg_false';
			header("Location: login.php");
			exit();
		  
		  }
}

if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
دخول - ليبيا سي في
</title>
<!-- CSS -->

<link rel="stylesheet" href="css/style1.css" >

<!--[if IE]>
	<style>
		.item .tooltip .content{ display:none; opacity:1; }
		.item .tooltip:hover .content{ display:block; }
	</style>
<![endif]-->
<link rel="icon" type="image/png" href="images/logos.png" />
</head>
    <body>

		<div class="wrapper">
		<div id="header">
			<div class="had">
			<a href="index.php"><img src="images/logo44.png" alt="logo" ></a>
			</div>
			<div class="hed">
				<ul id="navigation">
				<li>
						<a href="index.php">الرئيسية</a>
					</li>
					<li>
						<a href="view/searchjob.php">الوظائف</a>
					</li>
					<li>
						<a href="view/searchcvs.php">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
						<li>
						<a href="singup.php"> تسجيل </a>
					</li>
					<li class="selected">
						<a href="login.php" > دخول</a>
						</li>
				</ul>
		</div>
	</div>

<div id="container" >
	<div class="span1">
		<div class="item">
		
				<h4 id="title_reg">
			تسجيل الدخول
				</h4>

		</div>
<div class="item" >
       	<form   action="<?php echo $_SERVER['PHP_SELF']; ?>"    method="POST" >
		
		<?php 
		if(!empty($msg)){
		switch ($msg) {
		case "msg_false":
		echo "<p class='error'>الرقم السري أو البريد الألكتروني غير صحيح</p>";
		break;
		default:
		echo "<p class='error'>حدث خطاء في عملية تسجيل الدخول الرجاء المحاولة مرة أخري";
		}
		} 
	
       	 	
     ?>
	 <br/>

	 <table class="tblm table-bordered">
		<thead>
			<tr>
				<th>Email</th>
				<th>Password</th>
				<th>Type</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td scope="row">it5t@yahoo.com</td>
				<td>102030</td>
				<td>Admin-company admin</td>
			</tr>
			<tr>
				<td scope="row">iteet@yahoo.com</td>
				<td>102030</td>
				<td>Admin-company user</td>
			</tr>
			<tr>
				<td scope="row">sarah@yahoo.com</td>
				<td>102030</td>
				<td>Seeker</td>
			</tr>
		</tbody>
	 </table>
				<table class="itemin" >


					<tr class="iteminli">
						<td><label class="control-label" for="txt_email">
							البريد الألكتروني
							<span class="req">*</span>
							
						</label>
						</td><td><input id="txt_email" name="txt_email" type="text"  placeholder="البريد الألكتروني" maxlength="60" required  />
						</td>
							
						</tr>
				
					<tr class="iteminli">
							<td>
								<label class="control-label" for="txt_pass">
								الرقم السري
									<span  class="req">*</span>
								</label>
							</td>
							<td>
								<input id="txt_pass" name="txt_pass" type="password"  value="" maxlength="20" placeholder="الرقم السري" required />
							
							</td>
					</tr>	
				<tr class="iteminli">
							<td>
								
							</td>
							<td>
	<input name="remember" type="checkbox" value="yes"> تذكرني							</td>
					</tr>	
				</table>

				<div class ="btns">
						
					<a href="forgetpass.php">أستعادة كلمة السر</a>
					<br/>
					<br/>
					<br/>
					<input name="login" type="submit" class="btn btn-info" value="دخول" >
				</div>

					

		</form>
		<br/>
		<br/>
		<br/>
		<br/>
</div>
	
</div>
</div>
		</div>
<div class="clearfooter" ></div>
<div id="footer">
		<br />
			<div>
				<table style ="width:940px;">
					<tr>
						<td style="width:50%; valign:top;">
						<a href="#">
						<img src="images/logofooter.png" alt="شعار الموقع" />
						</a>
						<br/>
						<br/>
						<span class="textbfooter">نبذة عن ليبيا سي في </span>
						<br/>
						<br/>
						<span class="textsfooter">ليبيا سي في موقع يقدم خدمة التوظيف للشركات ويقدم</span>
							
						</td>
						<td style="width:35%; valign:top;">
							<span class="textbbfooter">وصلات سريعة</span>
							<br/>
							<br/>
							<a href="#">
							<span class="textsfooter">مساعدة</span>
							</a>
							<br/>
							<a href="#">
							<span class="textsfooter">أتصل بنا</span>
							</a>
						</td>
						<td style="width:15%; valign:top;" >
							<span class="textbbfooter">تابعنا</span>
							<br/>
							<br/>
							<a href="#"><span class="textsfooter">Facebook</span></a>
							<br/>
							<a href="#"><span class="textsfooter">+googel</span></a>
							<br/>
							<a href="#"><span class="textsfooter">Twitter</span></a>
							<br/>
						</td>
						
				</tr>
			</table>
	</div>
	
</div>
	
</body>

</html>