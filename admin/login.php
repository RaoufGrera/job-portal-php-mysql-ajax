<?php 
session_start(); 

if(!empty($_SESSION['txt_user_id']) && (!empty($_SESSION['txt_type'])))  {  
	if($_SESSION['txt_type'] == "admin"){
	header("Location: index.php");
	exit();
}
}

require_once("../db/db.php"); 

if(isset($_POST['login'])) {

				
		$txt_email		 = safe_input(trim($_POST['txt_email']));
		$datenow = date("Y-m-d");
		$txt_pass		=	md5(safe_input(trim($_POST['txt_pass'])));

		$query = $mysqli->query("SELECT admin_id,email,block_admin from job_admin where email='$txt_email' AND password='$txt_pass' ");
		if(!$query) {
			die("حدث خطاء ما الرجاء أعادة المحاولة مرة أخري " . mysql_error());
		}
		if($query->num_rows == 1) { 
			
			$found_user = $query->fetch_array();
				if ( $found_user['block_admin']== 0){
				$_SESSION['txt_user_id'] 	= $found_user['admin_id'];
				$_SESSION['txt_type'] = "admin";
				header("Location:index.php");
				exit();
	
		}
		else { 
			$_SESSION['msg'] = 'msg_block';
			}
		}
		else { 
			$_SESSION['msg'] = 'msg_false';

		  
		}
		}
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 		
	
?>
<!DOCTYPE html>
<html  >
<head>

<title>
تسجيل الدخول  للوحة التحكم
</title>
<?php
include_once("../inc/logos.php");
include_once("../inc/header.php");
?>
</head>
<body>

		<div class="wrapper">
		<div id="header">
			<?php
			include_once("../inc/logo.php");
			?>
			<div class="hed">
				
		</div>
	</div>
<div id="container" >
	<div class="span1">
		<div class="item">
		
				<h4 id="title_reg">
			 تسجيل الدخول - لوحة التحكم
				</h4>

		</div>
<div>
       	<form   action="<?php echo $_SERVER['PHP_SELF']; ?>"    method="POST" >
				<?php 
		if(!empty($msg)){
		switch ($msg) {
		case "msg_false":
		echo "<p class='error'>الرقم السري أو البريد الألكتروني غير صحيح</p>";
		break;
		case "msg_block":
		echo "<p class='error'>قد تم حظرك ، غير مسموح لك بالدخول</p>";
		break;
		default:
		echo "<p class='error'>حدث خطاء في عملية تسجيل الدخول الرجاء المحاولة مرة أخري";
		}
		} 
	
       	 	
     ?>
				<table class="itemin" >

	<br/><br/>

					<tr class="iteminli">
						<td><label class="control-label" for="txt_email">
							البريد الألكتروني
							<span class="req">*</span>
							
						</label>
						</td><td><input id="txt_email" name="txt_email" type="text"  tabindex="1" placeholder="البريد الالكتروني" maxlength="30" required  />
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
								<input id="txt_pass" name="txt_pass" type="password"  value="" maxlength="20" tabindex="3" placeholder="الرقم السري" required />
							</td>
					</tr>	
	
				</table>
					
				<div class ="btns">
				
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
				<table width="940">
					<tr>
						<td width="50%" valign="top" >
						<a href="#">
						<img src="../images/logofooter.png"/>
						</a>
						<br/>
						<br/>
						<span class="textbfooter">نبذة عن ليبيا سي في </span>
						<br/>
						<br/>
						<span class="textsfooter">ليبيا سي في موقع يقدم خدمة التوظيف للشركات ويقدم</span>
							
						</td>
						<td width="35%" valign="top">
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
						<td width="15%" valign="top" >
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