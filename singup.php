<?php 
session_start();  
if(!empty($_SESSION["txt_user_id"]))  {  
	if($_SESSION["txt_type"] =="seeker"){
	header("Location: seeker/profile.php");  
	exit();
	}else if(($_SESSION["txt_type"] =="employer") || ($_SESSION["txt_type"] =="company")){

	header("Location: company/empprofile.php");  
	exit();
}
}
error_reporting(0); //لاخفاء الأخطاء
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
			<a href="index.php"><img src="images/logo44.png" alt="logo"/></a>
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

		<div class="item">
		<div class="item">
				<h4>
				أختيـــار نوع التسجيـــل
				</h4>
				<!--<div id="title_com">الرجاء أختيار نوع التسجيل.</div> -->
		
			</div>
		</div>
			
	
			<table class="iteminc" >
				<tr>
				
					<td style="width:360px"><a href="seeker.php"><img src="images/sek.png" alt="الشعار" /></a><p>
						تسجيل كباحث عن العمل<p>
						<ul>
							<li>عرض الوظائف الشاغرة.</li>
							<li>أختصار الوقت.</li>
							<li>سهولة الحصول علي باحثين عن العمل</li>
						</ul>
						<br/>	
					</td>
					
					<td style="width:360px" ><a href="employer.php"><img src="images/job1.png" alt="الشعار" /></a>		
						<p>
						تسجيل كشركة<p>
						<ul>
							<li>عرض الوظائف الشاغرة.</li>
							<li>أختصار الوقت.</li>
							<li>سهولة الحصول علي باحثين عن العمل</li>
						</ul>
						<br/>
					</td>
			
				</tr>
						
				<tr>
					<td>
						<a  href="seeker.php" class="btn btn-info">تسجيل</a>
					</td>
						
					<td>
						<a  href="employer.php" class="btn btn-info">تسجيل</a>
					</td>
				</tr>			
			</table>

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
		
</body>
</html>