<?php 
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

//لتأكد من عملية تعديل الصورة أو حذفها
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 	
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
<head>

<title>
الملف الشخصي - بيانات الشركة
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
					
					
					<li class="selected" >
						<a href="empprofile.php">الملف الشخصي</a>
					</li>
					<li>
						<a href="../logout.php" title="تسجيل الخروج" >خروج</a>
					</li>
				</ul>
		</div>
	</div>

	 <div id="container">
   
        
				     <div class="span3" >
						<ul class="nav nav-list ">
							<li><span class="menus "><strong>القائمة الرئيسية</strong></span>
							</li>
							
							<li> <a href="empprofile.php">بيانات الحساب</a> 
							</li>
							
							
							<li  class="active"><a href='compprofile.php'>بيانات الشركة</a></li>
							
							<li><a href='controluser.php'>إدارة الموظفين</a></li>
						
							<li>
								<a href="jobpost.php"> أعلن عن وظيفية</a>
							</li>		
							<li>
								<a href="joblist.php">الوظائف الخاصة بي</a>
							</li>
							<li>
								<a href="jobrequest.php"> طلبات التوظيف</a>
							</li>
							<li>
								<a href="jobsave.php">السير المحفوظة</a>
							</li>
						</ul>
					</div>
<div class="span9" >
 
					
	<div class="item">
				<h4>
				أسم الشركة : 
				<?php
				 require_once("../db/db.php");		
                        $get_query=$mysqli->query("select url,image,comp_desc,comp_type_name,comp_name,email,domain_name,emp_id,city_name,address,phone,fname,lname,start_comp,size_comp 
													from job_comp_type,job_employer,job_company,job_domain,job_city 
													where job_city.city_id = job_company.city_id and job_comp_type.comp_type_id = job_company.comp_type_id AND job_domain.domain_id = job_company.domain_id AND job_employer.comp_id = job_company.comp_id AND job_employer.emp_id='$txt_user_id'")or die(mysql_error());
                        $row=$get_query->fetch_object();
						$id=$row->emp_id;
							$user_idd =	$row->emp_id;
                        echo $row->comp_name ;

                    ?>
					
				</h4>
			<p class="plinee">
			
<div>		
<h4>معلومات الشركة</h4>
</div>
<?php 
$filename="../images/company/ll.jpg";
if($row->image !=""){
$filename = '../images/company/'.$row->image; }
?>
		<img class="imgseeker"  src=<?php if($row->image !=""){echo $filename;}else {echo "../images/no_pic.gif";}?> /> 
		
		<br><br>
		<a href="modal_change_pic.php" class='facebox' ><img src="../images/edit.png"/> تعديل الصورة</a>
		<a class="facebox" href="modal_delete_pic.php"><img src="../images/remove.png"/> حذف الصورة</a>
		
		<?php
		if(!empty($msg)){
		switch ($msg) {
		case "msg_true":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>قد تم تنفيذ العملية بنجاح إذا لم يتم عرض الصورة الرجاء الأنتظار قليلاً ثم <a href='compprofile.php'> أضغظ هنا </a></p>";
		break;
		case "msg_false":
		echo "<p class='error'><img width='13' height='13' src='../images/invalid.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "msg_max":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/> لايمكن تحميل الصورة ؛ يحب أن يكون الحجم الأقصي للصورة 200kb </p>";
		break;
		default:
		echo "<p class='error'>خطاء في التنفيذ الرجاء أعادة المحاولة مرة أخري</p>";
		}
		} 
		?>

		<table class=" tabe iteminli" width="700">
			<tr>

			<td>
			<label class="control-labe">
			اسم الشركة :
			</label><span class="texttt"><?php echo $row->comp_name; ?></span> 
			</td>
			</tr>
		<tr>

			<td>
			<label class="control-labe">
			الموقع الألكتروني :
			</label><span class="texttt"><?php echo $row->url; ?></span> 
			</td>
			</tr>
		  <tr>
		 
	<td>
			 <label class="control-labe">
									البريد الألكتروني :
								</label><span class="texttt"><?php echo $row->email; ?></span> 
			</td>
			</tr>
			 <tr>
		 
	<td>
			 <label class="control-labe">
								رقم الهاتف :
								</label><span class="texttt"><?php echo $row->phone; ?></span>
			</td>
			</tr>
			 <tr>
			 <td>
			 <label class="control-labe">
								المدينة :
								</label><span class="texttt"><?php echo $row->city_name; ?></span> 
			</td>
			</tr>
				 <tr>
			 <td>
			 <label class="control-labe">
								العنوان :
								</label><span class="texttt"><?php echo $row->address; ?></span>
			</td>
			</tr>
			 
		
		
		
			<tr>
			 <td>
			 <label class="control-labe">
								قطاع الشركة :
								</label><span class="texttt"> <?php echo$row->domain_name;?></span>
			</td>
			</tr>
			 
			
			
			<tr>
			 <td>
			 <label class="control-labe">
								طبيعة عمل الشركة :
								</label><span class="texttt"> <?php echo $row->comp_type_name;?></span>
			
			 
			</td>
			</tr>
				
				<tr>
			 <td>
			 <label class="control-labe">
								حجم الشركة :
								</label><span class="texttt"><?php echo $row->size_comp;?></span> 
			</td>
			</tr>
			 
			
			<tr>
			 <td>
			 <label class="control-labe">
								سنة التأسيس :
								</label><span class="texttt"><?php echo $row->start_comp; ?></span>
			</td>
			</tr>
			 <tr>
			 <td>
			 <label class="control-labe">
								معلومات عن الشركة :
								</label><br><br><span class="texttt"><?php echo nl2br($row->comp_desc); ?></span> 
			</td>
			</tr>
			
		
	  
		</table>
		<br/>
		
	 <a href="modal_edit_comp.php" class='btn btn-info facebox' >تعديل</a>


</div>
</div>
</div>              
</div>  

		<?php
		include_once("../inc/footerdown.php");
		include_once("../inc/footer.php");
		?>
	
    </body>

</html>