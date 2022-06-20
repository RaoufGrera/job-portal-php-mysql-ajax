<?php 
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
<head>

<title>
لوحة التحكم - ليبيا سي في
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
				<ul id="navigation">
					<li>
						<a href="../index.php">الرئيسية</a>
					</li>
					<li>
						<a href="../view/searchjob.php">الوظائف</a>
					</li>
					<li>
						<a href="../view/searchcvs.php" >السير الذاتية </a>
					</li>

				<li class="mm">|</li>
					<li class="selected ">
						<a href="index.php" >لوحة التحكم</a>
					</li>
					<li>
						<a href="tables.php" >المحتوي</a>
					</li>
					<li>
						<a href="seekers.php" >المستخدمين</a>
					</li>
				
					<li>
						<a href="mange.php" >الأدارة</a>
					</li>
					<li>
						<a href="logout.php" title="تسجيل الخروج" >خروج</a>
					</li>
				</ul>
		</div>
	</div>
<div id="container" >
	<div class="span1">

<div class="item">
<div class="item">
<h4>لوحة التحكم </h4>
<p class="pline"></p>
			
		</div></div>

			<table class="iteminc" >
				<tr>
				
					<td width="360" valign="top"><a href="seekers.php"><img src="../images/users.png" alt="الشعار" ></a><p>
						<strong>المستخدمين</strong><p>
						<ul>
							<li><a href='seekers.php'>الباحثين عن العمل</a></li>
							<li><a href='companys.php'>الشركات</a></li>
							<li><a href='employers.php'>الموظيفين</a></li>
							<li><a href='jobs.php'>الوظائف</a></li>
						</ul>
						<br/>	
					</td>
					
					<td width="300" valign="top"><a href="tables.php"><img src="../images/tables.png" alt="الشعار" ></a>		
						<p>
						<strong>المحتوي</strong><p>
						<ul>
							<li><a href='tables.php#city'>المدن</a></li>
							<li><a href="tables.php#domain">المجالات</a></li>
							<li> <a   href="tables.php#edtype">المؤهل</a></li>
							<li><a href="tables.php#nat">الجنسية</a></li>
							<li><a href="tables.php#lang">اللغة</a></li>
							<li><a href="tables.php#type">نوع الوظيفة</a></li>
							<li> <a href="tables.php#status">حالة الوظيفة</a></li>
							<li> <a   href="tables.php#comptype">قطاع الشركة</a></li>
							<li>  <a   href="tables.php#level">المستوي</a></li>
							<li> <a   href="tables.php#explevel">نوع الخبرة</a></li>
						</ul>
						<br/>	
					</td>
					
					<td width="300" valign="top"><a href="mange.php"><img src="../images/manager.png" alt="الشعار" ></a>		
						<p>
						<strong>الأدارة</strong><p>
						<ul>
							
							<li><a href='mange.php'>أضافة مدير</a></li>
						
					
						</ul>
						<br/>	
					</td>
				</tr>
						
		
			</table>

		</fieldset>
	
	</section>
</div>

    </body>

</html>