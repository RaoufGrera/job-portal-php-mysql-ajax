<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات




$edit=0;
if(!empty($_GET['id'])){
$desc_id = $_GET['id'];
$query=$mysqli->query("SELECT emp_id FROM job_description WHERE desc_id= '$desc_id' AND emp_id = '$txt_user_id' ");
if($query->num_rows == 1){
$found_user = $query->fetch_object();
if($found_user->emp_id == $txt_user_id){
$edit=1;
$query->free_result();
}else{
die("دخول خاطئ.");
}
}else{
die("دخول خاطئ.");
}}
?>



<!DOCTYPE html>
<html>  
<head>
 <meta charset="UTF-8">
<title>
تعديل الأعلان
</title>
<?php
include_once("../inc/logos.php");
include_once("../inc/header.php");
?>

</head>
    <body>
	<?php 
	if($edit==1){
	$result = $mysqli->query("SELECT * FROM job_description WHERE desc_id ='$desc_id' ");
	$job = $result->fetch_object();
	$result->free_result();
	$_SESSION['desc_id'] = $job->desc_id;
	$_SESSION['txt_user_id']=$job->emp_id;
	}
	?>
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
						<a href="../view/searchcvs.php">السير الذاتية </a>
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
							
							<li> <a href="empprofile.php"></i>بيانات الحساب</a> </li>
							</li>
							
							<?php 
						
							if($_SESSION['txt_type'] =='company'){
							echo "<li><a href='compprofile.php'>بيانات الشركة</a></li>";
							echo "<li><a href='controluser.php'>إدارة الموظفين</a></li>";
							}
							?>
					
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
		
		<div>		
			<h4><a class="anchor" name="1">
			<?php
			if(!empty($_GET['id'])){
			echo "تعديل الأعلان";
			}
			else{
			echo "أضافة أعلان جديد";
			}
			?>
			</a></h4>
		</div>
			<form id="form2" name="form2"  accept-charset="UTF-8"  action="editjob.php" method="post" >
			
			<fieldset class="grouppost">
			<legend>وصف الوظيفة</legend><br/>
			<span class="texts">يجب تعبئة الحقول التي تسبقها علامة النجمة " <span  class="req">*</span> "</span><br/><br/>
				<table class=" tabe" width="710">
			

				<tr class="iteminli">
						<!-- -->
						<td>
							<label class="control-label" for="job_name">
								المسمي الوظيفي
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input  id="job_name" name="job_name" type="text" tabindex="1"  value="<?php echo $job->job_name;?>" placeholder="المسمّى الوظيفي" required />
						</td>
						<td>
								<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>المسمي الوظيفي الخاص بالوظيفة
										مثال ، مهندس برمجيات، مدير مبيعات ...</p>
									</div>
								</div>
						</td>
						<td>
						<span class="job_name_val validation"></span>
						</td>
					</tr>	
					
					<tr class="iteminli">
						<td><label class="control-label" for="job_desc">
							الوصف الوظيفي
							<span class="req">*</span>
							
						</label>
						</td><td>
								<textarea  maxlength="1200" rows="80" name="job_desc" id="job_desc" required><?php echo $job->job_desc;?></textarea>
						</td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>الوصف الوظيفي للوظيفة ماهي المهام التي يقوم بها والمسؤوليات التي تتعلق بهذه الوظيفة .</p>
									</div>
								</div>
								</td>
								<td>
								<span class="job_desc_val validation"></span>
								</td>
						</tr>
						
						
							<tr class="iteminli ">
						<td><label class="control-label" for="job_skilles">
							المهارات 
							<span class="req">*</span>
							
						</label>
						</td><td>
  <textarea  maxlength="1200" rows="80"  name="job_skilles" tabindex="3" id="job_skilles" required ><?php echo $job->job_skilles;?></textarea>
						</td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>المهارات المطلوبة للقيام بهذه الوظيفة </p>
									</div>
								</div>
								</td>
								<td>
								<span class="job_skilles_val validation"></span>
								</td>
									
			
					<!--
					#
					#
					#
					#جدول 
					#
					#
					#
					#
					-->
					</table>
					<br/>
					<p><p>
					</fieldset>
					<fieldset class="grouppost">
			<legend>معلومات الوظيفة</legend><br/>
			<table class="tabe">
										</tr>
						<tr class="iteminli">
						<td>
							<label class="control-label" for="city_id">
								منطقة الوظيفية
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
					<select id="city_id" name="city_id" required > 
							<option value="" >
							-المدينة-
							</option>
							<?php 
						$query= "SELECT city_id,city_name FROM job_city order by city_id";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->city_id == $row->city_id){
							echo " selected " ;}
							echo "value='".$row->city_id."'>".$row->city_name."</option>\n";
							}
							$rs->free_result();
							?>
					
							</select>						
							</td>
						<td>
						<div>
								
								</div>
						</td>
						<td>
							<span class="city_id_val validation"></span>
						</td>
					
					</tr>
					<tr class="iteminli">
						<td><label class="control-label" for="domain_id">
							مجال الوظيفة 
							<span class="req">*</span>				
						</label></td><td>
						<select id="domain_id" name="domain_id" required > 
							<option value="" >
							-مجال الوظيفة -
							</option>
							<?php 
						$query= "SELECT domain_id,domain_name FROM job_domain";
						$rs = $mysqli->query($query) or die($mysqli->error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->domain_id == $row->domain_id){
							echo " selected ";}
							echo "value='".$row->domain_id."'>".$row->domain_name."</option>\n";
							}
							$rs->free_result();
							?>
							</select>
						</td>
						<td>
								<div>
									</div>
								</td>
								<td>
						<span class="job_domain_val validation"></span>
						</td>
					</tr>
						
					<!-- PASSWORD -->						
					<tr class="iteminli">
							<td>
								<label class="control-label" for="status_id">
								الحالة الوظيفية
									<span  class="req">*</span>
								</label>
							</td>
							<td>
								<select id="status_id" name="status_id" required > 
							<?php
									$query= "SELECT status_id,status_name FROM job_status";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->status_id == $row->status_id){
							echo " selected";
							}
							echo "value='".$row->status_id."'>".$row->status_name."</option>\n";}
							$rs->free_result();
							?>
							</select>	
							</td>
							<td>
								<div>
								</div>
							</td>
							<td><span></span>
						</td>
					</tr>	
					
					<tr class="iteminli">
							<td>
								<label class="control-label" for="type_id">
							نوع التوظيف
									<span  class="req">*</span>
								</label>
							</td>
							<td>
								<select id="type_id" name="type_id" required > 
							
						<?php
							$query= "SELECT type_id,type_name FROM job_type";
							$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->type_id == $row->type_id){
							echo " selected ";
							}
							echo "value='".$row->type_id."'>".$row->type_name."</option>\n";}
							$rs->free_result();
							?>
							</select>	
							</td>
							<td>
								<div>
								</div>
							</td>
							<td><span></span>
						</td>
					</tr>	
					
					<tr class="iteminli">
							<td>
								<label class="control-label" for="salary_id">
							الراتب الشهري
									
								</label>
							</td>
							<td>
								<select id="salary_id" name="salary_id"  > 
							
							<?php
						$query= "SELECT salary_id,salary_name FROM job_salary";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->salary_id == $row->salary_id){
							}
							echo "value='".$row->salary_id."'>".$row->salary_name."</option>\n";}
							$rs->free_result();
							?>
							
							</select>	
							</td>
							<td>
								<div>
								</div>
							</td>
							<td>
						<span></span>
						</td>
					</tr>	
					
					
					<tr class="iteminli">
							<td>
								<label class="control-label" for="job_num">
							عدد الوظائف الشاغرة
									
								</label>
							</td>
							<td>
							<select id="job_num" name="job_num"   > 
								<option value="1" selected="selected">
							غير محدد
							</option>
							<?php
							for($i=1;$i<=100;$i++){
							
							echo "<option ";
							if($job->job_num == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							} ?>
							</select>	
							</td>
							<td>
								<div>
								</div>
							</td><span></span>
							<td>
						</td>
					</tr>	
				</table><br/>
				</fieldset>
				  	<!--
					#
					#
					#
					#
					#
					#
					#
					#
					-->
			
				<p>
				<fieldset class="grouppost">
				<legend>الشروط الواجب توفرها في الباحث عن العمل  : المؤهل العلمي ، الخبرة</legend><br>
	
				<table class="tabe" width="700">
			
					<tr class="iteminli">
						<td><label class="control-label" for="specialty">
							التخصص
							
						</label></td><td>
						<input id="specialty" name="specialty" type="text" tabindex="10" value="<?php if($job->specialty !=0){echo $job->specialty;} ?>" > 
						</td>
						<td>
								<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>تخصص المؤهل العلمي مثل ، مهندس معماري مهندس برمجيات مهندس اتصالات </p>
									</div>
								</div></td>
								<td>
					<span></span>
						</td>
					</tr>
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="edt_id">
								الشهادة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="edt_id" name="edt_id" required > 
							<option value="" selected>
							الشهادة
							</option>
							<?php
						$query= "SELECT edt_id,edt_name FROM job_ed_type";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->edt_id == $row->edt_id){
							echo " selected ";
							}
							echo "value='".$row->edt_id."' >".$row->edt_name."</option>\n";}
							$rs->free_result();
							?>
					
							</select>
						</td>
					<td><div>
						</div></td>
						<td>
						<span class="edt_id_val validation"></span>
						</td>
					</tr>
					
						<tr class="iteminli">
						<td>
							<label class="control-label" for="exp_level">
								المستوي المهني
							<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="exp_level" name="exp_level" required  > 
					<option value="" selected>
							المستوي المهني
							</option>
							
							<?php
						$query= "SELECT exp_type_id,exp_type_name FROM job_exp_type order by exp_type_id ASC";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->exp_level == $row->exp_type_id){
							echo " selected ";
							}
							echo "value='".$row->exp_type_id."'>".$row->exp_type_name."</option>\n";}
							$rs->free_result();
							?>
							
							</select>
						</td>
					<td><div>
						</div></td>
						<td>
						<span class="exp_level_val validation"></span>
						</td>
					</tr>
									<tr class="iteminli">
						<td>
							<label class="control-label" for="exp_min">
								عدد سنوات الخبرة
								
							</label>
						</td>
			<td class="exp">
				
					<select name="exp_min"> 
							<option value="0" >
							الحد الادني
							</option>
							<?php
							
							for($i=0;$i<=50;$i++){
							echo "<option ";
							if($job->exp_min == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="exp_max" > 
							<option value="0" >
							الحد الأعلي
							</option>
							<?php
							
							for($i=0;$i<=50;$i++){
							echo "<option ";
							if($job->exp_max == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td><div>
						</div>
						</td>
						<td>
						<span class="exp_job_val validation"></span>
						</td>
						</tr>
			</table>
			</fieldset>
				<p>
				<fieldset class="grouppost">
				<legend> المعلومات الشخصية</legend><br>
	
				<table class="tabe" width="700">
					<tr class="iteminli">
						<td>
							<label class="control-label" for="age_min">
								العمر
								
							</label>
						</td>
			<td class="exp">
				
					<select name="age_min"  > 
							<option value="18" >
							الحد الادني
							</option>
							<?php
							
							for($i=18;$i<=65;$i++){
							echo "<option ";
							if($job->age_min == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="age_max"   > 
							<option value="60" selected="selected">
							الحد الأعلي
							</option>
							<?php
							
							for($i=18;$i<=65;$i++){
							echo "<option ";
							if($job->age_max == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td><div>
						</div>
						</td>
						<td>
						<span ></span>
						</td>
						</tr>
						<tr class="iteminli">
							<td>
								<label class="control-label" for="job_gender">
							الجنس
									
								</label>
							</td>
							<td>
							<select id="job_gender" name="job_gender"> 
						
							
							<?php
						$job_gender =  array (
						'm'=>"ذكر",'f'=>"أنثي",'n'=>"لا أفضلية"
						);
							foreach($job_gender as $key => $value){
							echo "<option ";
							if($job->job_gender == $key){
							echo " selected ";
							}
							echo "value=\"$key\">$value</option>\n";
							}
							?>
							</select>	
							</td>
							<td>
								<div>
									</div>
								</div>
							</td>
							<td>
						<span class="gender_val validation"></span>
						</td>
					</tr>
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="nat_id">
								الجنسية
								
							</label>
						</td>
						<td>
							<select id="nat_id" name="nat_id"> 
							<option value="" selected="selected">
						الجنسية
							</option>
							<?php
						$query ="SELECT nat_id,nat_name FROM job_nat";
							$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($job->nat_id == $row->nat_id){
							echo " selected ";
							}
							echo "value='".$row->nat_id."'>".$row->nat_name."</option>\n";
							}
							$rs->free_result();
							?>
							</select>
						</td>
					<td><div>
						</div></td>
						<td>
						<span class="nat_id_val validation"></span>
						</td>
					</tr>
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="health_status">
								بيئة العمل
								
							</label>
						</td>
						<td>			
					 <input type="checkbox" name="health_status" value="2" <?php if($job->health_status == 2){echo "checked"; }?> >مهيئة لذوي الأعاقة<br>
						</td>
					<td><div>
						</div></td>
						<td>
						<span></span>
						</td>
					</tr>
					
					</table>
					</fieldset>
											<p>
				<fieldset class="grouppost">
				<legend> إعدادات الوظيفة</legend><br>
	
				<table class="tabe" width="700">
				<tr class="iteminli">
						<td>
							<label class="control-label" for="job_end">
								تاريخ بداء الأعلان
								
							</label>
						</td>
			<td class="day">
				
					<select name="job_start_d"> 

							<?php
						 $time = strtotime($job->job_start) ;
							for($i=1;$i<=30;$i++){
							echo "<option ";
							if(date('d',$time) == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="job_start_m"> 

							<?php
							
							for($i=1;$i<=12;$i++){
							echo "<option ";
							if(date('m',$time) == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-		
							<select name="job_start_y" > 

							<?php
							$i = date("Y");

							$end_y= $i+1;
							for($i;$i<=$end_y;$i++){
						if(date('Y',$time) == $i){
							echo " selected ";
							}
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
					
						</td>
						<td><div>
						</div>
						</td>
						<td>
						<span ></span>
						</td>
						</tr>	
					<tr class="iteminli">
						<td>
							<label class="control-label" for="job_end">
								تاريخ أنتهاء الأعلان
								
							</label>
						</td>
			<td class="day">
				<?php $time = strtotime($job->job_end) ?>
					<select name="job_end_d"> 
 
							<?php
							
							for($i=1;$i<=30;$i++){
							echo "<option ";
							if(date('d',$time) == $i){
							echo " selected " ;
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="job_end_m"  > 
 
							<?php
							
							for($i=1;$i<=12;$i++){
							echo "<option ";
							if(date('m',$time) == $i){
							echo " selected " ;
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-		
							<select name="job_end_y" > 
 
							<?php
							$end_y= date('Y') +1 ;
							for($i=date('Y');$i<=$end_y;$i++){
							echo "<option ";
							if(date('Y',$time) == $i){
							echo "  selected " ;
							}
							echo "value=\"$i\">$i</option>\n";
							}
						
							?>
							</select>
					
						</td>
						<td><div>
						</div>
						</td>
						<td>
						<span ></span>
						</td>
						</tr>
						

					
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="comp_active">
								اسم الشركة
								
							</label>
						</td>
						<td>			
			<select name="comp_active" >
			<option value="0" <?php if($job->comp_active ==0){echo "selected";} ?>> أظهار اسم الشركة</option>
			<option value="1" <?php if($job->comp_active == 1){echo "selected";}?>>أخفاء اسم الشركة</option>
	
						</td>
					<td><div>
						</div></td>
						<td>
						<span></span>
						</td>
					</tr>
					

					
						<tr class="iteminli">
						<td>
							<label class="control-label" for="is_active">
								حالة الأعلان
								
							</label>
						</td>
						<td>			
					 <select name="is_active" >
			<option value="0" <?php if($job->is_active == 0){echo "selected";}?>>تنشيط الأعلان</option>
			<option value="1" <?php if($job->is_active == 1){echo "selected";}?> >إلغاء تنشيط الأعلان</option>
					</select>
						</td>
					<td><div>
						</div></td>
						<td>
						<span></span>
						</td>
					</tr>
					</table>
					</fieldset>
				<div class ="btns">
					<button name="submit" type="submit" class="btn btn-info"> حفظ </button>
					 <a href="joblist.php" >إلغاء </a>
				</div>

		
			
	
		</form>
		
		</div>
		</div>

		<?php
		include_once("../inc/footerdown.php");
		?>
		<script src="../js/email.js"></script>
		<script src="../js/jobpost.js"></script>

    </body>

</html>