<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
error_reporting(0); //لاخفاء الأخطاء
$id_comp= safe_input($_GET['id']);
     $get_query=$mysqli->query("SELECT url,job_employer.email,comp_name,image,job_company.phone,comp_desc,comp_type_name,domain_name,city_name,size_comp,start_comp,job_company.address
										FROM job_comp_type,job_domain,job_city,job_company,job_employer
										WHERE job_comp_type.comp_type_id = job_company.comp_type_id 
										AND job_company.comp_id = job_employer.comp_id
										AND job_domain.domain_id = job_company.domain_id
										AND job_city.city_id = job_company.city_id
										 AND job_company.comp_id = '$id_comp'")or die(mysql_error());
																$row=$get_query->fetch_array();
																	$comp_id =	$row['comp_id'];
						
                        
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
<title>
<?php
echo $row['comp_name'] ;
?>
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
					<li class="selected">
						<a href="searchjob.php">الوظائف</a>
					</li>
					<li>
						<a href="searchcvs.php">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
					
					<?php 
					if(!empty($_SESSION['txt_type'])){
				
						if($_SESSION['txt_type']=='seeker'){
					echo "<li>";
					echo	"<a href='../seeker/profile.php'>الملف الشخصي</a>";
					echo "</li>";
					}
					else if (($_SESSION['txt_type']=='company') ||($_SESSION['txt_type']=='employer')){
					echo "<li>";
					echo	"<a href='../company/empprofile.php'  title='تسجيل دخول'> الملف الشخصي</a>";
					echo "</li>";
					}
					else if($_SESSION['txt_type'] =='admin'){
					echo '<li>';
					echo '<a href="../admin/index.php" >لوحة التحكم</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../admin/tables.php" >المحتوي</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../admin/seekers.php" >المستخدمين</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../admin/mange.php" >الأدارة</a>';
					echo '</li>';

					}
					echo "<li>";
					echo	"<a href='../logout.php'   >خروج</a>";
					echo "</li>";
					}
					else{
					
					
					echo "<li>";
					echo "<a href='../singup.php' title=''>تسجيل</a>";
					echo "</li>";
					
					echo "<li>";
					echo	"<a href='../login.php' >دخول</a>";
					echo "</li>";
					
					
					
					}
					?>
				</ul>
		</div>
	</div>

	<div id="container">
	<div class="span3">
				<ul class="nav nav-list ">
				<li><span class="menus "><strong>القائمة الرئيسية</strong></span>
				</li>
				
				<li  class="active"> <a href="viewcompany.php?id=<?php echo $id_comp; ?>">بيانات الشركة</a> 
				</li>
				<li> <a href="jobcompany.php?id=<?php echo $id_comp; ?>">الوظائف الخاصة بالشركة</a> 
				</li>
			</ul>
	</div>
		<div class="span9">
	<div class="item">
				<h4 id="title_reg">
				أسم الشركة : 
				<?php
			echo $row['comp_name'] ;

                    ?>
				
				</h4>
</div>
  
	<fieldset class="grouppost">
			<legend>معلومات عن الشركة</legend>

		<table class="iteminli" >
		<tr>
		<td  >
						<div id="logopro">
						<?php 
						$filename="../images/company/";
						if($row['image'] !=""){
						$filename = '../images/company/'.$row['image']; }
						?>
								<img class="imgseeker"  src=<?php if($row['image'] !=""){echo $filename;}else {echo "../images/test.jpg";}?> >  </img>
	
						</div>
					</td>
					</tr>
 <tr>
		 
	<td>
			 <div><label class="control-labe">
									المدينة :
								</label><span class="texttt"><?php echo $row['city_name']; ?></span> </font></div>
			</td>
			</tr>
		  <tr>
		 
	<td>
			 <div><label class="control-labe">
									مجال الشركة :
								</label><span class="texttt"><?php echo $row['domain_name']; ?></span> </font></div>
			</td>
			</tr>
			
			 <tr>
		 
	<td>
			 <div><label class="control-labe">
									قطاع الشركة :
								</label><span class="texttt"><?php echo $row['comp_type_name']; ?></span> </font></div>
			</td>
			</tr>
	

			
		
			
				 <tr>
			 <td>
			 <label class="control-labe">
								حجم الشركة :
								</label><span class="texttt"><?php echo $row['size_comp'];?></span> 
			</td>
			</tr>
			 <tr>
			 <td>
			 <label class="control-labe">
								سنة التأسيس :
								</label><span class="texttt"><?php echo $row['start_comp'];?></span> 
			</td>
			</tr>
				
		
	  
		</table>
		</fieldset>
		 	<fieldset class="grouppost">
			<legend>عن الشركة</legend><br/>
		<table class="iteminli">

		
		  <tr >
		 
	<td>
<span class="texttt"><?php echo nl2br($row['comp_desc']); ?></span> 
			</td>
			</tr>
	
		
	  
		</table>
		</fieldset>

		
<fieldset class="grouppost">
			<legend>معلومات الأتصال</legend>
		<table  class="iteminli">

			<tr>

			<td>
			<div><label class="control-labe">
			الموقع الألكتروني :
			</label><span class="texttt"><?php echo $row['url']; ?></span> </font></div>
			</td>
			</tr>

			<tr>

			<td>
			<div><label class="control-labe">
			البريد الألكتروني :
			</label><span class="texttt"><?php echo $row['email']; ?></span> </font></div>
			</td>
			</tr>

			<tr>

			<td>
			<div><label class="control-labe">
			الهاتف :
			</label><span class="texttt"><?php echo $row['phone']; ?></span> </font></div>
			</td>
			</tr>





			<tr>
			<td>
			<label class="control-labe">
			العنوان :
			</label><span class="texttt"><?php echo $row['address'];?></span> 
			</td>
			</tr>




			</table>
			</fieldset>
			</div>
			</div>
			</div>


<?php
include_once("../inc/footerdown.php");
?>
            

    </body>

</html>