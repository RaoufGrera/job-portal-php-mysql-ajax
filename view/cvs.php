<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
if(empty($_SESSION['txt_type'])){
echo " السيرة الذاتية لاتعرض إلا للمسجلين فقط ";
echo '<a href="../login.php">لتسجيل الدخول</a>';
die();
}
if(!empty($_GET['id'])) {
$user_id=safe_input($_GET['id']);
 $rs=$mysqli->query("SELECT *
							FROM job_seeker, job_city,job_nat
							WHERE job_city.city_id = job_seeker.city_id
							AND job_nat.nat_id = job_seeker.nat_id
							AND user_id ='$user_id'")or die($mysql->error());
							$resultcount = $rs->num_rows;
							if($resultcount > 0){

								$_SESSION['id']   = $_GET['id'];
								}
								else{
								die('الصفحة غير موجودة');
								}
								}
								else{
								die('الصفحة غير موجودة');
								}
$row = $rs->fetch_object();
$rs->free_result();
$id=$row->user_id;
$user_idd=$row->user_id;

//insert see it
$query = $mysqli->query("UPDATE `job_seeker` SET `see_it` = (see_it +1) WHERE  user_id='$user_id'");
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
}

$saved=0;
if(!empty($_SESSION['txt_type'])){
if(($_SESSION['txt_type'] =="employer")||($_SESSION['txt_type'] =="company")){
$rss	=$mysqli->query("select emp_id from job_seeker_save where emp_id='$txt_user_id' and seeker_id='$user_id'");
if($rss ->num_rows >= 1) {  
	 $saved=1;

	}
	}
	}
 

if (isset($_POST['seeker_id']))  {
$seeker_id = $_POST['seeker_id'];
	if($saved ==1){

	$delete = $mysqli->query("delete from job_seeker_save  where emp_id='$txt_user_id' and seeker_id='$seeker_id'");
			if(!($delete)){
			$_SESSION["msg"] = "msg_false";
			header("location: cvs.php?id=$seeker_id");
			}
			else{
			$_SESSION["msg"] = "msg_unsaved";
			header("location: cvs.php?id=$seeker_id");
			}
	}
	else if($saved ==0){
	
	$insert = $mysqli->query("insert into job_seeker_save  (`seeker_id`,`emp_id`) value ($seeker_id,$txt_user_id)");
			if(!($insert)){
			$_SESSION["msg"] = "msg_false";
			header("location: cvs.php?id=$seeker_id");
			}
			else{
			$_SESSION["msg"] = "msg_saved";
			header("location: cvs.php?id=$seeker_id");
}
}
}



?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
<title>
<?php echo $row->fname." ".$row->lname; ?>
</title>
<?php
include_once("../inc/logos.php");
include_once("../inc/header.php");
?>
<link rel="stylesheet" href="../css/print.css" type="text/css" media="print" />
</head>
    <body>

	
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5472700d334221ac" async="async"></script>
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
					<li>
						<a href="searchjob.php">الوظائف</a>
					</li>
					<li class="selected">
						<a href="searchcvs.php">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
					
					
				
					<?php 
					if(!empty($_SESSION['txt_type'])){
						if($_SESSION['txt_type'] =='seeker'){
					
					echo "<li>";
					echo	"<a href='../seeker/profile.php' >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='../logout.php'>خروج</a>";
					echo "</li>";
					}
					else if(($_SESSION['txt_type'] =='employer') || ($_SESSION['txt_type'] =='company')){
					echo "<li>";
					echo	"<a href='../company/empprofile.php'  >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='../logout.php'   >خروج</a>";
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
					echo '<li>';
					echo '<a href="../logout.php">خروج</a>';
					echo '</li>';
					}
					}
					else{
					
					echo "<li class=' hoverbut'>";
					echo "<a href='../singup.php' >تسجيل</a>";
					echo "</li>";
					
					echo "<li class=' hoverbut' >";
					echo	"<a href='../login.php' >دخول</a>";
					echo "</li>";
					

					}
					?>
				
				
				</ul>
		</div>
	</div>

	 <div id="container">

  <script type="text/javascript"> 
        function submitform() {   document.myform.submit(); } 
   </script> 
		 <div class="span3" >
                 <div class="menucv"><div  class="bordbottom">
				 </div><br/><br/>
				 <div class="tools">
					   <form name='myform' action='cvs.php?id=<?php echo $user_id; ?>' method='post'>
				
				<img width='18' height='18' src='../images/printer63.png'/>
			 <a  href="" onclick="printcontent('div1')"  title="طباعة" ><span class='textsss' >طباعة</span></a> <p/>
			 <input type='hidden' name='seeker_id' value='<?php echo $user_idd;?>'/>

				 <?php 
				 if(!empty($txt_type)){
					 if (($txt_type== 'employer')||($txt_type== 'company')){
						if($saved==1){
						 echo "<img  src='../images/save.png'/>";
						 echo "<a  href='javascript: submitform()'   title='إلغاء حفظ هذه السيرة'   ";
						 echo "<span class='textsss' >إلغاء حفظ هذه السيرة</span></a></p>";
						 }
						 else{
						 
						  echo "<img  src='../images/unsave.png'/>";
						  echo "<a href='javascript: submitform()'  title='حفظ هذه السييرة'> ";
						 echo "<span class='textsss' > حفظ هذه السيرة</span></a></p>";
						 }
						}
				}
				 else {?>
				   <img  src='../images/unsave.png'/><a  name='req' onclick="return confirm('يجب عليك التسجيل كشركة لحفظ هذه السيرة')"   href="../employer.php"  ><span class='textsss' > حفظ هذه الوظيفة</span> </a>
				  <?php
				 
				 }?>

			 <img  src='../images/sendfriend.png'/>
			 <a  href='#' ><span class='textsss' >أرسل الي صديق</span> </a>
<p/>
				 <img  src='../images/report.png'/>
			 <a  href='#' ><span class='textsss' >إبلاغ</span> </a>
<p>
مشاركة:
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>

			</div>
				
				  <br>
				  <div style="text-align:right;color:#565656;background-color:#f6f6f6;border:1px solid #dbdbdb; padding:8px 8px;font-size:11px;" >
		<label>رقم السيرة الذاتية: <?php echo $row->user_id; ?></label><p/>
			<label >تاريخ التسجيل: <?php echo date('d-m-Y',strtotime($row->date_register));?></label><p/>
			<label>أخر دخول: <?php echo date('d-m-Y',strtotime($row->last_seen)); ?></label><p/>
			<label>عدد المشاهدات: <?php echo $row->see_it; ?></label><p/>
			
				  </div>
				  <br>
			
                </div>
				
				</div>
            <div class="span9 " >
  <div  class="item">
 
			<h4>السيرة الذاتية</h4>	
		
			<p class="plinee"></p>
  <?php
		if(!empty($msg)){
		switch ($msg) {

		case "msg_false":
		echo "<p class='error'><img class='imgmsg' src='../images/invalid.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "msg_unsaved":
		echo "<p class='truee'><img class='imgmsg' src='../images/tick.png'/>قد تم إلغاء تمييز هذه السيرة   <a href='../company/jobsave.php'>السير المحفوظة</a></p>";
		break;
		case "msg_saved":
		echo "<p class='truee'><img class='imgmsg' src='../images/tick.png'/>قد تم تمييز هذه السيرة   <a href='../company/jobsave.php'>السير المحفوظة</a></p>";
		break;
		default:
		echo "<p class='error'><img class='imgmsg' src='../images/invalid.png'/>حدث خطاء ما الرجاء أعادة تنفيذ العملية مرة أخري";
		}
		} 
		?>
		  
	
					
	
		
		</div>

<div id="div1">

<div class="item">
<div>
				<table class="cvview">
					<tr >
					<td width='160' >
						<div id="logopro">
						<?php 
						$filename="../images/seeker/";
						if($row->image !=""){
						$filename = '../images/seeker/'.$row->image; }
						?>
								<img class="imgseeker"  src=<?php if($row->image !=""){echo $filename;}else {echo "../images/test.jpg";}?> >  </img>
	
						</div>
					</td><td width='250'>
					<div>
						<h3 >
						<?php echo $row->fname."  ".$row->lname; ?></h3>
						<span class="texts textlines">
						<?php echo "الجنسية: ".$row->nat_name;  ?>
						<br/>
						<?php echo "العنوان: ".$row->city_name;if($row->address !=""){ " ـ ".$row->address;} ?><br/>
						<?php $datereg=date("Y"); $age =  $datereg - $row->birth_day  ; echo "العمر: ".$age." سنة"; ?>
						<br/>

						<?php if($row->health_status== 2){echo "الحالة الصحية: معوق"; } ?>
						</span>
						
						
					</div>
					</td>
					<td  class="cvinfo" >
					<span class='titleinfo' style="display:block;"> معلومات الأتصال </span>
					<br/>
					<img  src="../images/email.png"/>
					<span class="texts" ><?php echo "  ".$row->email;?></span>
					<br/><br/>
					<?php
					if($row->phone !=""){?>
					<img  src="../images/telephone38.png"/>
					<span class='texts' > <?php echo " ".$row->phone;?></span></a>
					<?php }?>
					</td>
					</tr>
					
				</table>
			</div>

				
			<p class="plinee">

<?php
	$rs= $mysqli->query("SELECT  goal_text
							FROM job_seeker
							WHERE job_seeker.user_id ='$user_idd' 
							 ")or die($mysqli->error());
	$resultcount = $rs->num_rows;
	$row=$rs->fetch_object();
			if($row->goal_text!=""){
?>
<div  class="post">
	الهدف الوظيفي</div><div class="item"><br/>
	<?php


	echo "<span class='textdesc'>".$row->goal_text."</span>";
	echo "<br/>";
	echo "<br/>";	


	$rs->free_result();
	?>

	</div>	
		<br/>
	<?php
	}
	$rs= $mysqli->query("SELECT start_date,ed_id,edt_name,domain_name,univ,specialty,avg,end_date,user_id
							FROM job_ed,job_domain,job_ed_type
							WHERE job_ed_type.edt_id = job_ed.edt_id
							AND job_ed.domain_id = job_domain.domain_id
							AND user_id ='$user_idd' 
							ORDER BY end_date DESC ")or die($mysqli->error());
											
	$resultcount = $rs->num_rows;
	if($resultcount > 0){
	?>
	<div class="post">
	المؤهل العلمي</div><div class="item"><br/>
	
	<?php
	while($row=$rs->fetch_object()){
	$id=$row->ed_id;
	
	
	echo "<span class='textb textlineb'>".$row->univ."</span>";
	echo "<span class='texts textlines'><br>".$row->edt_name;
	if(!empty($row->specialty)){
	echo "، ";}
	echo $row->specialty;
	if(!empty($row->avg)){
	echo "، ";}
	echo $row->avg;
	echo "<br>".$row->start_date." - ".$row->end_date."</span>";
	echo "<br/><span class='texts textlines'>"."المجال "."</span><span class='texts textlines'>".$row->domain_name."</span>";
	echo "<br/>";
	echo "<br/>";	
	echo "<br/>";
	}
	$rs->free_result();
	
	?>
	</div>
	<?php
	}	
	$rs=$mysqli->query("select *  
							FROM job_exp,job_domain 
							WHERE job_exp.domain_id = job_domain.domain_id  
							AND user_id ='$user_idd'
							ORDER BY state DESC ,end_date DESC")or die($mysql->error());
	$resultcount = $rs->num_rows;
				if($resultcount > 0){
							
	?>
	
			<div class="post"><a name="exp"></a>
	الخبرة</div><div class="item"><br/>
	<?php
									  
	while($row=$rs->fetch_object()){
	$id=$row->exp_id; 
	$state =$row->state;
	$timeend = strtotime($row->end_date);
	$timestart = strtotime($row->start_date);

	echo "<span class='textb textlineb'>".$row->exp_name."</span>";
	echo "<span class='texts textlines'><br>في "."</span>";
	echo "<span class='texts textlines'>".$row->exp_comp;
	echo "<br>".date('Y-m',$timestart)." - ";if($state ==0){echo date('Y-m',$timeend);}else{echo "الي حد الأن";}
	echo "<br/>"."مجال الشركة ";
	echo "</span><span class='texts textlines'>".$row->domain_name."</span>";
	echo "<br/>";
	echo "<br/><span class='textdesc'>".nl2br($row->exp_desc);
	echo "<br/>";

		
			echo "<br/>";	
	}
	$rs->free_result();
	
	?>

	</div>
	<?php
	}
		$rs=$mysqli->query("select job_lang.lang_id,level_name,user_id,lang_name
			from job_lang_seeker,job_lang,job_level
			WHERE job_lang_seeker.lang_id = job_lang.lang_id
			AND job_lang_seeker.level_id = job_level.level_id
			AND user_id ='$user_idd' order by job_lang_seeker.level_id DESC")or die(mysql_error());
			$resultcount = $rs->num_rows;
			if($resultcount > 0){
			
	?>
	
			<div class="post"><a name="lang"></a>
	اللغات</div><div class="item"><br/>
	<?php 
	

			while($row=$rs->fetch_object()){
			$id=$row->user_id; 
			$id_lang=$row->lang_id;
			echo "<span class='textb textlineb'>".$row->lang_name."</span>";
			echo "<span class='textdesc textlines'><br>المستوي : "."</span>";
			echo "<span class='texts textlines'>".$row->level_name;
		
			echo "<br/>";
	echo "<br/>";
			}
			$rs->free_result(); 
			
			?>
					

	</div>

<?php
}
	$rs=$mysqli->query("select skilles_id,level_name,skilles_name from job_skilles,job_level WHERE job_level.level_id = job_skilles.level_id AND user_id ='$user_idd' order by job_skilles.level_id DESC ")or die($mysqli->error());
		$resultcount = $rs->num_rows;
		if($resultcount > 0){
	?>
	
			<div class="post"><a name="skilles"></a>
	المهارات</div><div class="item"><br/>
	<?php 
	
			while($row=$rs->fetch_object()){
			$skilles_id=$row->skilles_id;
			echo "<span class='textb textlineb'>".$row->skilles_name."</span>";
			echo "<span class='textdesc textlines'><br>المستوي : "."</span>";
			echo "<span class='texts textlines'>".$row->level_name;
			echo "<br/>";
		echo "<br/>";
			}
			$rs->free_result(); 
			
			?>
					

	</div>
<br/>
<?php
}
	$rs=$mysqli->query("select cert_id,cert_name  from job_cert WHERE user_id ='$user_idd' ")or die($mysqli->error());
	$resultcount = $rs->num_rows;
		if($resultcount > 0){
?>		
			<div class="post"><a name="cert"></a>
	الشهادات</div><div class="item"><br/>
	<?php 
	
			while($row=$rs->fetch_object()){
			$cert_id=$row->cert_id;
			echo "<span class='textb textlineb'>".$row->cert_name."</span>";
			echo "<br/>";
		echo "<br/>";
			echo "<br/>";
		
			}
			$rs->free_result(); 
		
			?>
					
	
		</div>

		<?php
			}
			$rs=$mysqli->query("select train_id,train_name,train_comp  from job_train WHERE user_id ='$user_idd' ")or die($mysqli->error());
$resultcount = $rs->num_rows;
	if($resultcount > 0){
	?>
		
			<div class="post"><a name="train"></a>
	التدريب</div><div class="item"><br/>
	<?php 
	

			while($row=$rs->fetch_object()){
			$train_id=$row->train_id;
			echo "<span class='textb textlineb'>".$row->train_name."</span>";
			echo "<span class='textdesc textlines'><br>اسم المعهد : "."</span>";
			echo "<span class='texts textlines'>".$row->train_comp;
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			
			?>
					
	  
	</div>
		


<?php
}
	$rs=$mysqli->query("select hobby_id,hobby_name  from job_hobby WHERE user_id ='$user_idd' ")or die($mysqli->error());
	$resultcount = $rs->num_rows;
		if($resultcount > 0){
?>		
			<div class="post">
	الهوايات</div><div class="item"><br/>
	<?php 
	
			while($row=$rs->fetch_object()){
			$hobby_id=$row->hobby_id;
			echo "<span class='textb textlineb'>".$row->hobby_name."</span>";
			echo "<br/>";
		echo "<br/>";
			echo "<br/>";
		
			}
			$rs->free_result(); 
			
			?>
					
	
		</div>
<?php
}
	$rs=$mysqli->query("select ref_name,ref_phone,ref_email,ref_adj  from job_ref WHERE user_id ='$user_idd' ")or die($mysqli->error());
	$resultcount = $rs->num_rows;
		if($resultcount > 0){
?>		
			<div class="post">
	المعرفون</div><div class="item"><br/>
	<?php 
	
			while($row=$rs->fetch_object()){
			echo "<span class='textb textlineb'>".$row->ref_name."</span>";
			echo "<span class='textdesc textlines'><br>الصفة : "."</span>";
			echo "<span class='texts textlines'>".$row->ref_adj;	
			if($row->ref_email !=""){
			echo "<span class='textdesc textlines'><br>البريد الألكتروني : "."</span>";
			echo "<span class='texts textlines'>".$row->ref_email;		
			}
			if($row->ref_phone !=""){
			echo "<span class='textdesc textlines'><br>الهاتف : "."</span>";
			echo "<span class='texts textlines'>".$row->ref_phone;		
			}
			echo "<br/>";
			echo "<br/>";
		
			}
			$rs->free_result(); 
			
			?>
		</div>
<?php
}
	$rs=$mysqli->query("select info_id,info_name,info_date  from job_info WHERE user_id ='$user_idd' order by info_date DESC ")or die($mysqli->error());
	$resultcount = $rs->num_rows;
		if($resultcount > 0){
?>		
			<div class="post">
	معلومات أضافية</div><div class="item"><br/>
	<?php 
			while($row=$rs->fetch_object()){
			echo "<span class='textb textlineb'>".$row->info_name."</span>";
			echo "<span class='textdesc textlines'><br>سنة : "."</span>";
			echo "<span class='texts textlines'>".$row->info_date;	

			echo "<br/>";
			echo "<br/>";
		
			}
			$rs->free_result(); 
			
			?>
			</div>
			<?php
			}
			?>
<br/>
</div>              
</div>
</div>
</div></div>
<?php
include_once("../inc/footerdown.php");
?>	
    </body>

</html>