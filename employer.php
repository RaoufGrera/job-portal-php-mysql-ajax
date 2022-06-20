<?php 
error_reporting(0); //لاخفاء الأخطاء
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
require_once("db/db.php"); // database connection 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
موقع التوظيف الليبي - ليبيا سي في
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
						<li   class="selected">
						<a href="singup.php"> تسجيل </a>
					</li>
					<li >
						<a href="login.php" > دخول</a>
						</li>
				</ul>
		</div>
	</div>

<div id="container" >
	<div class="span1">
	<br/>
	<br/>
	<br/>
<ul id="tabnav">
<li><a href="seeker.php">كباحث عن عمل</a></li>
<li  class="se"><a href="employer.php">كشركة</a></li>

</ul>

		<div class="item">
				<h4>
			تسجيل كشركة
				</h4>
				<div >البيانات التي تسبقها علامة<span  class="req"> * </span>بيانات ضرورية</div>
	
		
		</div>
	<br/>	<br/>
       	<form id="form2" name="form2"  accept-charset="UTF-8"   method="post" >
			
		
				<table class="itemin" >
			
					<tr class="iteminli">
						<td>
							<label class="control-label" for="fname">
								الأسم 
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input  id="fname" name="fname" type="text" maxlength="30"  placeholder="الأسم"  required /> 
						</td>
						<td>

						</td>
						<td>
						<span class="fname_val validation"></span>
						</td>
					</tr>
					
					
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="lname">
							اللقب
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="lname" name="lname" type="text"  value="" maxlength="30"  placeholder="اللقب" required  />
						</td>
						<td>
						</td>
						<td>
							<span class="lname_val validation"></span>
						</td>
					
					</tr>
					
				<tr class="iteminli">
						<td>
							<label class="control-label" for="comp_name">
							أسم الشركة
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="comp_name" name="comp_name" type="text"  value="" maxlength="40" placeholder="أسم الشركة" required />
						</td>
						<td>
						<div class="tooltip">
								<span>?</span>
								<div class='content'>
									<b></b>
									<p>يمكنك تغيير اسم شركتك بعد التسجيل</p>
								</div>
							</div>
						</td>
						<td>
							<span class="comp_name_val validation"></span>
						</td>
					
					</tr>
					
						<tr class="iteminli">
						<td><label class="control-label" for="email">
							البريد الألكتروني
							<span class="req">*</span>
							
						</label>
						</td><td><input id="email" name="email" type="text"  maxlength="30" placeholder="البريد الالكتروني" required />
						 </td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>يجب أدخال البريد الألكتروني الخاص بك تأكد من كتابته بشكل صحيح مثل : exmplemail@mail.com <p>
									</div>
								</div>
								</td>
								<td>
								<span class="txt_email_val validation"></span>
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
								<input id="txt_pass" name="txt_pass" type="password" maxlength="20" value="" placeholder="الرقم السري" required />
							</td>
							<td>
								<div class="tooltip">
										<span>?</span>
									<div class='content'>
										<b></b>
										<p>يفضل ان يكون الرقم السري متكون من اكثر من 6 أرقام<br />
									</div>
								</div>
							</td>
							<td>
						<span class="txt_pass_val validation"></span>
						</td>
					</tr>	
				</table>
				
				<div class ="btns">
					<!--<button name="submit" type="submit" class="btn btn-info">تسجيل</button> !--> 
					<input name="register_comp" type="button" value="تسجيل" class="btn btn-info"> <span class="loading"></span>
				</div>

		
			
		</form>
		<br/>
		<br/>
</div>
</div></div>

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
<script type="text/javascript" src="js/email.js"> </script> <!--- include the live jquery library -->
<script type="text/javascript" src="js/script_comp.js"  ></script> <!--- include the our jquery file  -->	
</body>
</html>
