
<?php 
//error_reporting(0); //لاخفاء الأخطاء
require_once("db/db.php"); // database connection 
session_start();  
$countjob = $countseeker ='';


$rs=$mysqli->query("SELECT *  FROM job_description,job_employer,job_company
					WHERE job_company.comp_id = job_employer.comp_id
					AND job_employer.emp_id = job_description.emp_id
					AND job_description.job_start <= CURDATE() 
					AND job_description.job_end >= CURDATE() 
					AND job_description.is_active = 0 
					AND job_company.block_admin = 0 ");
$countjob= $rs->num_rows;
$rs->free_result();

$rs=$mysqli->query("SELECT DISTINCT job_seeker.user_id  FROM job_seeker,job_ed
					WHERE job_ed.user_id = job_seeker.user_id
							and is_active = 0
			and hide_cv = 0
			and block_admin = 0 
");
$countseeker= $rs->num_rows;
$rs->free_result();
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
موقع التوظيف الليبي - ليبيا سي في
</title>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/style1.css" >
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
			<a href="index.php"><img src="images/logo44.png" alt="logo" /></a>
			</div>
			<div class="hed">
				<ul id="navigation">
				<li  class="selected">
						<a href="index.php">الرئيسية</a>
					</li>
					<li>
						<a href="view/searchjob.php">الوظائف</a>
					</li>
					<li>
						<a href="view/searchcvs.php">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
						<?php 
					if((!empty($_SESSION['txt_type'])) || (!empty($_COOKIE['txt_type']))){
						if(($_SESSION['txt_type'] =='seeker') || $_COOKIE['txt_type'] =='seeker'){
					
					echo "<li>";
					echo	"<a href='seeker/profile.php' >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='logout.php'>خروج</a>";
					echo "</li>";
					}
					else if(($_SESSION['txt_type'] =='employer') || ($_SESSION['txt_type'] =='company')  || ($_COOKIE['txt_type'] =='company')  || ($_COOKIE['txt_type'] =='employer')){
					echo "<li>";
					echo	"<a href='company/empprofile.php'  >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='logout.php'   >خروج</a>";
					echo "</li>";
					
					}else if($_SESSION['txt_type'] =='admin'){
					echo '<li>';
					echo '<a href="admin/index.php" >لوحة التحكم</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="admin/tables.php" >المحتوي</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="admin/seekers.php" >المستخدمين</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="admin/mange.php" >الأدارة</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="logout.php">خروج</a>';
					echo '</li>';
					}
					}
					else{
					
					echo "<li>";
					echo "<a href='singup.php' >تسجيل</a>";
					echo "</li>";
					
					echo "<li>";
					echo	"<a href='login.php' >دخول</a>";
					echo "</li>";
					

					}
					?>
				</ul>
		</div>
	</div>

<div id="container" >
	<div class="span1">

	<br/>
		<div class="item"  style="margin-right: 8px;">
			<div  style="text-align: center;padding-right:180px;color:#ccc;"><h1>ليبيا سي في</h1>
							<h2>التقدم للوظيفة أسهل مما تتوقع.</h2>
							</div>
							<p class="pline">
		<table style="width:900px ;">
			<tr>
				<td style="vertical-align:top; width:50%;text-align: right;" >
				 	<br/>
					<h2 >ليبيا سي في</h2>
						<span class="textsfooter">
						يـقـوم الموقــع بمـساعدة الباحثين عن العمل في انشاء سيرهم الذاتية الخاصه بهم، كذالك يساعد الموقع الموظيفين علي الأعلان علي الوظائف الشاغرة في الموقع .</span>
					
<br/><br/>
						 <a   href='singup.php'  style='width:270px;height:25px;' class='btn btn-success' title='التسجيل الأن'>
								التسجيل الأن</a>
				</td>
				
				<td style="vertical-align:top; width:50%;">
				<img src="images/photoweb.png" alt="صورة توضحية" />
				</td>
			</tr>
		</table>
		<br/>
		<br/>
		<br/>

		<p class="pline">
	<br/>
		<h2 >أحصاءات الموقع</h2>
		<br/>
		<br/>

				<table style="width:900px;margin-right:130px;" >
			<tr>

			<td style="valign:top text-align:center; width:50%;">
				<div class="titel-index" >		
					<img src="images/job7.png" style="opacity:0.7;" alt="الوظائف" /></div>
					<div class="select_index">
					<br/>
					<span>
					 الأعلانات
					</span>
					<br/>
					<span class="textb">
					<a href="view/searchjob.php">
					<?php
					echo $countjob;
					?>
					</a>
					</span>
					</div>
				</td>
				<td style="valign:top text-align:center; width:50%;">
									<div class="titel-index" >		
					<img src="images/cvs.png" style="opacity:0.7;" alt="السير الذاتية" /></div>
					<div class="select_index">
					<br/>
					<span>
					الباحثين عن عمل
					</span>
					<br/>
					<span class="textb">
					<a href="view/searchcvs.php">
					<?php
					echo $countseeker;
					?>
					</a>
					</span>
					</div>
				</td>
			</tr>
		</table>
		
		<br/>
		<br/>
		<br/>

		<p class="pline">
			<br/>
		<h2 >مميزات الموقع</h2>
		<br/>
		<br/>
		<br/>
			<table style="width:900px;margin-right:130px;" >
			<tr>

		
				<td style="valign:top  ; width:25%;">
										
					<img src="images/yes.png" style="width:96px;" alt="السير الذاتية" />
				
			
				</td>
				<td style="valign:top ; width:25%;">
										
					<img src="images/air.png" style="width:96px;" alt="السير الذاتية" />
				
				</td>
			
			<td style="valign:top  ; width:25%;">
										
					<img src="images/pen.png" style="width:96px;" alt="السير الذاتية" />
				
			
				</td>
				</tr>
		</table>
		<br/>


		</div>
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
		
</body>

</html>