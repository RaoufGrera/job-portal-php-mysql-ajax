<?php 
error_reporting(0); //لاخفاء الأخطاء
require_once("db/db.php"); // database connection 
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
<html>
<head>
<meta charset="UTF-8">
<title>
تسجيل كباحث عن عمل -  ليبيا سي في
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
<li class="se"><a href="seeker.php">كباحث عن عمل</a></li>
<li><a href="employer.php">كشركة</a></li>

</ul>

		<div class="item">
				<h4>
				تسجيل كباحث عن العمل
				</h4>
				<div >البيانات التي تسبقها علامة<span  class="req"> * </span>بيانات ضرورية</div>

		</div>

       	<form id="form2" name="form2"  accept-charset="UTF-8"   method="post" >
	
		
				<table class="itemin" >
				<!-- FIRST NAME -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="fname">
								الأسم
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input  id="fname" name="fname" type="text"  maxlength="30"  placeholder="الأسم"  required />
						</td>
						<td>
							<div class="tooltip">
								<span>?</span>
								<div class='content'>
									<b></b>
									<p>أدخال الاسم الشخصي الأول بدون مسافات مثل : أحمد<p>
								</div>
							</div>
						</td>
						<td>
						<span class="fname_val validation"></span>
						</td>
					</tr>
					
						
					<!-- LAST NAME -->
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="lname">
							اللقب
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="lname" name="lname" type="text"  value=""  maxlength="30" placeholder="اللقب" required />
						</td>
						<td>
						</td>
						<td>
							<span class="lname_val validation"></span>
						</td>
					
					</tr>
					
					<!-- BIRTH DAY -->
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="fdate">
								تاريخ الميلاد
								<span  class="req">*</span>
							</label>
						</td>
						
						
						<td class="day">
								<select id="fdate" name="fdate" required > 
							<option value="0" selected="selected" >
							اليوم
							</option>
							<?php
						
							for($i=1;$i<=31;$i++){
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							- 
							<select  name="fdate1" > 	
							<option value="0" selected="selected">
							الشهر
							</option>
							<?php
							
							for($i=1;$i<=12;$i++){
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-		
							<select name="fdate2" > 
							<option value="0" selected="selected">
							السنة
							</option>
							<?php
							
							for($i=1930;$i<=2014;$i++){
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td>
						</td>
						<td>
						<span class="fdate_val validation"></span>
						</td>
						</tr>
				
                    <tr id="fun">
                    </tr>
				
				
						
						<!-- GENDER -->
					<tr class="iteminli">
						<td><label class="control-label" >
							الجنس
							<span  class="req">*</span>
							
						</label></td><td>
						<label for="man">ذكر</label><input type="radio"  id="man" name="gender" value="m"  required /> 
						<label for="woman">أنثي</label><input type="radio"  id="woman" name="gender" value="f" required /> 
								</td>
								<td>
						</td>
						<td>
						<span class="gender_val validation"></span>
						</td>
					</tr>
						
					<!-- EMAIL -->
					
					<tr class="iteminli">
						<td><label class="control-label" for="email">
							البريد الألكتروني
							<span class="req">*</span>
							
						</label>
						</td><td><input id="email" name="email" type="text"  maxlength="30" placeholder="البريد الالكتروني"  />
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
								<input id="txt_pass" name="txt_pass" type="password"  value="" maxlength="20" placeholder="الرقم السري" required />
							</td>
							<td>
								<div class="tooltip">
										<span>?</span>
									<div class='content'>
										<b></b>
										<p>يجب ان يتكون الرقم السري من اكثر من 6 خانات<br /><p>
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
					<input name="register" type="button" value="تسجيل" class="btn btn-info" > <span class="loading"></span>
                    	

				</div>

	
		</form>

<br/>
<br/>
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
<script type="text/javascript" src="js/email.js"> </script> <!--- include the live jquery library -->
<script type="text/javascript" src="js/script.js"  ></script> <!--- include the our jquery file  -->			
<script type="text/javascript">
        			function insertinput(){
				document.getElementById("fun").innerHTML = 
					    '<td><label class="control-label" for="lname">اللقب<span  class="req">*</span></label></td><td><input id="lname" name="lname" type="text"  value=""  maxlength="30" placeholder="اللقب" required /></td><td></td><td><span class="lname_val validation"></span></td>	';
                    }
     			function cc(){
				document.getElementById("fun").innerHTML = "";}
        
        </script>
    </body>
</html>