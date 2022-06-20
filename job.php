<?php

require_once("db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
	  error_reporting(0); //لاخفاء الأخطاء


$id = $_GET['id'];
if(!empty($id)) {
$id_desc=safe_input($id);
                         $rs=$mysqli->query("SELECT job_description.user_id,comp_active,specialty,age_min,age_max,salary_name,status_name,see_it,job_employer.comp_id,job_skilles, job_name, job_description.desc_id,job_start,job_end,comp_name,job_desc,job_gender,domain_name,exp_max,exp_min,job_num,email,phone,address,type_name,edt_name,health_status,nat_name,city_name,comp_active,image,comp_type_name,last_seen,exp_type_name
							FROM job_description, job_domain, job_employer, job_comp_type,job_company, job_city, job_type, job_status, job_ed_type, job_nat, job_salary,job_exp_type
							WHERE job_employer.user_id = job_description.user_id
							AND job_city.city_id = job_description.city_id
						
							AND job_company.comp_type_id = job_comp_type.comp_type_id
							AND job_employer.comp_id = job_company.comp_id
							AND job_description.domain_id = job_domain.domain_id
							AND job_exp_type.exp_type_id = job_description.exp_level
							AND job_description.type_id = job_type.type_id
							AND job_description.status_id = job_status.status_id
							AND job_ed_type.edt_id = job_description.edt_id
							AND job_nat.nat_id = job_description.nat_id
							AND job_salary.salary_id = job_description.salary_id
							AND job_description.job_end >= CURDATE( )
							AND job_description.is_active =0
							AND job_description.desc_id = '$id_desc'
							GROUP BY job_description.desc_id ")or die($mysql->error());
							$resultcount = $rs->num_rows;
							if($resultcount > 0){

$_SESSION['id']   = $_GET['id'];
}
else{
die('أنتهت صلاحية الأعلان');
}
}
else{
die('الصفحة غير موجودة');
}

$query = $mysqli->query("UPDATE `job_description` SET `see_it` = (see_it +1) WHERE  desc_id='$id_desc'");

 $req=0;
$saved=0;
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
}

if(!empty($_SESSION['txt_type'])){

if($_SESSION['txt_type'] =="seeker"){
$check	=$mysqli->query("select seeker_id from job_desc_save where seeker_id='$txt_user_id' and desc_id='$id_desc'");
if($check->num_rows >= 1) {  
	 $saved=1;

	}
$checkreq	=$mysqli->query("select seeker_id from job_seeker_req where seeker_id='$txt_user_id' and desc_id='$id_desc'");
		if($checkreq->num_rows >= 1) {  
	 $req=1;

	}
	}
	}
	
if (!empty($_POST['desc_id']))  {
	$desc_id = $_POST['desc_id'];
		if($saved ==1){
		$delete = $mysqli->query("delete from job_desc_save  where desc_id='$desc_id' and seeker_id='$txt_user_id'");
				if(!($delete)){
				$_SESSION["msg"] = "msg_false";
				header("location: job.php?id=$seeker_id");
				}
				else{
				$_SESSION["msg"] = "msg_unsaved";
				header("location: job.php?id=$desc_id");
				}
		}
		else if($saved ==0){
		$insert = $mysqli->query("insert into job_desc_save  (`seeker_id`,`desc_id`) value ($txt_user_id,$desc_id)");
				if(!($insert)){
				$_SESSION["msg"] = "msg_false";
				header("location: job.php?id=$desc_id");
				}
				else{
				$_SESSION["msg"] = "msg_save";
				header("location: job.php?id=$desc_id");
				}
		}
}




 
 
 
 
	$sum_job =0;


	$row=$rs->fetch_object();
	$comp_id =	$row->comp_id;

if (isset($_POST['desc_req']))  {

	$desc_req = $_POST['desc_req'];
		if($req ==1){
		$delete = $mysqli->query("delete from job_seeker_req  where desc_id='$desc_req' and seeker_id='$txt_user_id'");
				if(!($delete)){
				$_SESSION["msg"] = "msg_false";
				header("location: job.php?id=$desc_req");
				}
				else{
				$_SESSION["msg"] = "req_delete";
				header("location: job.php?id=$desc_req");
				}
		}
		else if($req == 0){
		$req_date = date("Y-m-d");
		$insert = $mysqli->query("insert into job_seeker_req  (`seeker_id`,`desc_id`,`req_date`) value ($txt_user_id,$desc_req,NOW())");
				if(!($insert)){
				$_SESSION["msg"] = "msg_false";
				header("location: job.php?id=$desc_req");
				}
				else{
				$_SESSION["msg"] = "req_insert";
				header("location: job.php?id=$desc_req");
				}
		}
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
<title>
<?php
echo $row->job_name;
?>
</title>
<?php
include_once("../inc/logos.php");
include_once("../inc/header.php");
?>
</head>
    <body>
		<script type="text/javascript">
		function printcontent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();	
		document.body.innerHTML = restorepage;

		}
		</script>

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
		<script type="text/javascript"> 
		function submitform() { document.myform.submit(); } 
		function submitformreq() { document.myformreq.submit(); } 
		</script>
		 <div class="span3" >
                 <div class="menucv"><div  class="bordbottom">
				  <form action='job.php?id=<?php echo $id_desc; ?>' name="myformreq" method='post'>   <input type='hidden' name='desc_req' value='<?php echo $id_desc;?>'/>
				 
				 <?php if(!empty($_SESSION['txt_type'])){
				   if ($_SESSION['txt_type']=="seeker"){
						if($req==1){
				 ?>
				   <a  name='req' href='javascript: submitformreq()'    style='width:150px;height:25px;' class='btn btn-danger' title='سحب الطلب'><span style='font-family:tahoma;'>سحب الطلب</a>
				 <?php
				  }else if($req==0){
				   ?>
				   <a  name='req' href='javascript: submitformreq()'   style='width:150px;height:25px;' class='btn btn-success' title='التقدم الأن'><span style='font-family:tahoma;'>تقدم الأن</a>
				 <?php
				  }
				  }
				  }else{?>
				   <a  name='req' onclick="return confirm('يجب عليك التسجيل كباحث عن عمل لتقدم لهذه الوظيفة هل تريد  التسجيل كباحث عن عمل ؟')"   href="../seeker.php"  style='width:150px;height:25px;' class='btn btn-success' title='هذه الخدمه مفعله للمسجلين فقط' ><span style='font-family:tahoma;'>تقدم الأن</a>
				  <?php
				  }?>
				  </form>
				 </div><br/><br/>
				 <div class="tools">
					 
				
				<img width='18' height='18' src='../images/printer63.png'/>
			 <a  href="" onclick="printcontent('div1')"  title="طباعة" ><span class='textsss' >طباعة</span></a> <p/>
			<form name='myform' action='job.php?id=<?php echo $id_desc; ?>' method='post'>			
			<input type='hidden' name='desc_id' value='<?php echo $id_desc;?>'/>
</form>
			 <?php 
				 if(!empty($txt_type)){
					 if ($txt_type== 'seeker'){
						if($saved==1){
						 echo "<img  src='../images/save.png'/>";
						 echo "<a  href='javascript: submitform()'   title='إلغاء حفظ هذه الوظيفة'   ";
						 echo "<span class='textsss' >إلغاء حفظ هذه الوظيفة</span></a></p>";
						 }
						 else{
						  echo "<img  src='../images/unsave.png'/>";
						  echo "<a href='javascript: submitform()'  title='حفظ هذه الوظيفة'> ";
						 echo "<span class='textsss' > حفظ هذه الوظيفة</span></a></p>";
						 }
					}
					else {	  echo "<img  src='../images/unsave.png'/>";
						 echo "<a style='cursor: default;text-decoration:none'  title='لايمكنك تمييز هذه السيرة إلا اذا كنت كباحث عن عمل'> ";
						 echo "<span class='textsss' >حفظ  الوظيفة</span></a></p>";
				 }
				}else {	  echo "<img  src='../images/unsave.png'/>";
				 echo "<a style='cursor: default;text-decoration:none'  title='لايمكنك تمييز هذه السيرة إلا اذا كنت مسجل كموظف'> ";
				 echo "<span class='textsss' >حفظ  الوظيفة</span></a></p>";
				 }?>
				 
				

			</div>
				
				  <br>
				  <div style="text-align:right;color:#565656;background-color:#f6f6f6;border:1px solid #dbdbdb; padding:8px 8px;font-size:11px;" >
		
			<label >رقم الوظيفة : <?php echo $row->desc_id;?></label><p/>
			<label >تاريخ نشر الأعلان : <?php echo date('d-m-Y',strtotime($row->job_start));?></label><p/>
			<label>نهاية الأعلان : <?php echo date('d-m-Y',strtotime($row->job_end)); ?></label><p/>
				<label title="أخر دخول لصاحب الأعلان">أخر دخول: <?php echo date('d-m-Y',strtotime($row->last_seen)); ?></label><p/>
				<?php 
			$rs_count  = $mysqli->query("SELECT count(job_seeker_req.seeker_id) as countreq
				FROM job_description
				LEFT JOIN job_seeker_req ON job_seeker_req.desc_id = job_description.desc_id
				WHERE job_description.job_end >= CURDATE( )
				AND job_description.is_active =0
				AND job_description.desc_id = '$id_desc'
				");
				$rows = $rs_count->fetch_object();
			?>
			<label>عدد المتقدمين: <?php echo $rows->countreq; ?></label><p/>
		<?php
		$rs_count->free_result();
		?>
				<label>عدد المشاهدات: <?php echo $row->see_it; ?></label><p/>
		
				  </div>
				  <br/>
			
                </div>
				
				</div>
            <div class="span9" >
			
			
		
            

			

 

	<div id="div1" >	
	   <div class="item">
				<?php
		if(!empty($msg)){
		switch ($msg) {
		case "msg_false":
		echo "<p class='error'><img width='13' height='13' src='../images/tick.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "msg_unsaved":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>تم إلغاء حفظ الوظيفة   <a href='../seeker/seekersave.php'>الوظائف المحفوظة</a></p>";
		break;
		case "msg_save":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>تم  حفظ الوظيفة <a href='../seeker/seekersave.php'>الوظائف المحفوظة</a></p>";
		break;
		case "req_insert":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>تم التقدم الي الوظيفة لرؤية ملف <a href='../seeker/seekerreq.php'>طلبات التوظيف </a></p>";
		break;
		case "req_delete":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>تم سحب التقدم من الوظيفة <a href='../seeker/seekerreq.php'>طلبات التوظيف</a></p>";
		break;
		default:
		echo "حدث خطاء الرجاء المحاولة مرة أخري";
		}
		} 
		?>

	
			
			<div>
		<br/>
							<table class="cvview">
					<tr >
					<td width='160' >
						<div id="logopro">
						<?php 
						$filename="../images/company/";
						if($row->image !=""){
						$filename = '../images/company/'.$row->image; }
						?>
								<img class="imgseeker"   src=<?php if($row->image !=""){if ($row->comp_active ==0){echo $filename;}else{echo "../images/no_pic.gif";}}else {echo "../images/no_pic.gif";}?> >  </img>
	
						</div>
					</td><td width='250'>
					<div>
						<h3 >
						<?php
						if($row->comp_active==0){
						echo '<a href="viewcompany.php?id='.$row->comp_id.'">'.$row->comp_name.'</a>';
						}
						else{
						echo "أسم الشركة محجوب";
						}?>
						</h3>
						<span class="texts">
						<?php echo "مكان الوظيفة"." , ".$row->city_name;?><br/><br/>
						<?php  echo "قطاع الشركة ,".$row->comp_type_name; ?>
						</span>
						
						
					</div>
					</td>
					
					</tr>
					
				</table>
								</div>

<p class="plinee"></p>

				<h4>	الوظيفة : 
				 <a href="job.php?id=<?php echo $row->desc_id;?>"><?php echo $row->job_name;?></a>    
				</h4>

	  
<p class="plinee"></p>
<?php
if(nl2br($row->job_desc) != ""){
?>
	  <div class="post" >الوصف الوظيفي 	
		</div><div class="item"></br>

<span class="textdesc"><?php echo nl2br($row->job_desc); ?></span> 
			
			<br/>
		<br/>		 
</div>
		
<?php
}

if(nl2br($row->job_skilles) != ""){
?>
	  
	  <div class="post" >المهارات
		</div><div class="item"></br>

	<span class="textdesc"><?php echo nl2br($row->job_skilles); ?></span> 
	
		</br>
		</br></br>

	  </div>
<?php
}
?>
	   <div class="post" >تفاصيل الوظيفة
		</div><div class="item"></br>


		<table style="width:700px;" >
<tr >
    <td align="top"  width="46%" >
	<span class="textb">تفاصيل الوظيفة</span>
	<br/>
	<br/>
		<label class="control-labe">
	المسمي الوظيفي :
	</label>
	
	<span class="texttt"><?php echo $row->job_name; ?></span>
		<br/>
	<br/>
	<label class="control-labe">
	منطقة الوظيفة :
	</label>
	<span class="texttt"><?php echo $row->city_name; ?></span>
	<br/>
	<br/>
	<label class="control-labe">
	مجال الوظيفة :
	</label>
	<span class="texttt"><?php echo $row->domain_name; ?></span> 
	<br/>
	<br/>
	<label class="control-labe">
	نوع التوظيف :
	</label><span class="texttt"><?php echo $row->type_name; ?></span> 

	<br/>
	<br/>
	<label class="control-labe">
	حالة الوظيفة :
	</label><span class="texttt"><?php echo $row->status_name; ?></span> 
	<br/>
	<br/>
	<label class="control-labe">
	المرتب:
	</label><span class="texttt"><?php echo $row->salary_name; ?></span>

	<br/>
	<br/>
	<label class="control-labe">
	عدد الوظائف الشاغرة:
	</label><span class="texttt"><?php echo $row->job_num; ?></span>
	<br/>
	<br/>
		<br/>


	</td>
	
	
    <td align="top" width="54%" >
	<span class="textb">متطلبات الوظيفة</span>
	<br/>
	<br/>
	<label class="control-labe">
									الشهادة :
	</label><span class="texttt"><?php echo $row->edt_name; ?></span>
	<br/>
	<br/>
	<label class="control-labe">
									التخصص :
	</label><span class="texttt"><?php if(empty($row->specialty)){echo "غير محدد";}else {echo $row->specialty;} ?></span>
	<br/>
	<br/>
	<label class="control-labe">
	عدد سنوات الخبرة :
	</label>
	<span class="texttt"><?php echo "الحد الأدني: ".$row->exp_min." الحد الأقصي : ".$row->exp_max; ?></span>

	<br/>
	<br/>
		<label class="control-labe">
									مستوي الخبرة :
	</label><span class="texttt"><?php echo $row->exp_type_name; ?></span>
	<br/>
	<br/>
	<label class="control-labe">
	العمر :
	</label>
	<span class="texttt"><?php echo "الحد الأدني: ".$row->age_min." الحد الأقصي : ".$row->age_max; ?></span> 
	<br/>
	<br/>
	<label class="control-labe">
				الجنس :
	</label><span class="texttt"><?php $job_gender =  array (
																'm'=>"ذكر",'f'=>"أنثي",'n'=>"لا أفضلية"
																); 
	echo $job_gender[$row->job_gender]; ?></span>
	<br/>
	<br/>
	<label class="control-labe">
	الجنسية :
	</label><span class="texttt"><?php echo $row->nat_name; ?></span>
	<br/>
	<br/>
	<label class="control-labe">
	الحالة الصحية :
	</label><span class="texttt">
	<?php 
	$health_status =  array (
	'1'=>"سليم",'2'=>"معوق"
	); 

	echo $health_status[$row->health_status]; 
	?>
	</span>

	
	
	</td>
</tr>
</table>		
		
<br/>
<br/>
<br/>
 
		
		

	 

	 </div>
	<?php
 if($row->comp_active==0){?>
	   <div class="post" >معلومات الأتصال
		</div><div class="item"></br>


		<table width="700">

		
		  <tr class="iteminli">
		 
	<td>
			<label class="control-labe">
									البريد الألكتروني :
								</label><span class="texttt"><?php echo $row->email; ?></span> 
			</td>
			</tr>
			
			 <tr class="iteminli">
		 
	<td>
			<label class="control-labe">
									الهاتف :
								</label><span class="texttt"><?php echo $row->phone; ?></span>
			</td>
			</tr>
	

			
		
			
				 <tr class="iteminli">
			 <td>
			 <label class="control-labe">
								العنوان :
								</label><span class="texttt"><?php echo $row->address;?></span> 
			</td>
</tr>
</table>
<p>
<?php }?>

	  </div >	

			</div>
			</div>
			</div>
    </div>              
                </div>

	<?php
		include_once("../inc/footerdown.php");
		?>
    </body>

</html>