<?php 
error_reporting(0); //لاخفاء الأخطاء
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
	
$rs=$mysqli->query("SELECT *
							FROM job_seeker
							left join job_city on job_city.city_id = job_seeker.city_id
							left join job_nat on job_nat.nat_id = job_seeker.nat_id
							WHERE  user_id ='$txt_user_id'")or die($mysql->error());
	
$row = $rs->fetch_object();

$id=$row->user_id;


//لتأكد من عملية تعديل الصورة أو حذفها
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 
?>
	
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
الملف الشخصي
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
					<a href="profile.php">الملف الشخصي</a>
					</li>
					<li>
					<a href="../logout.php" title="تسجيل الخروج" >خروج</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="container">
		
		 <!--القائمة الرئيسية-->
		     <div class="span3" >

                    <ul class="nav nav-list   ">
					
						<li><span class="menus "><strong>القائمة الرئيسية</strong></span>
						</li>
                        <li class="active"> <a href="profile.php">السيرة الذاتية</a> </li>
					
				
						<li>
								<a href="seekerreq.php"> طلبات التوظيف</a>
							</li>
							<li>
								<a href="seekersave.php">الوظائف المحفوظة</a>
							</li>
						<li>
                            <a href="settings.php">أعدادات الحساب</a>
                        </li>
                    </ul>
                </div>
		
		<div class="span9" >		
			<div class="item">
			<h4 id="pic">
			 
			السيرة الذاتية</h4>	
		
			<p class="plinee">
		
				<?php
				//الرسالة المراد اظهارها للمستخدم عند تنفيذ اي امر من المستخدم
		if(!empty($msg)){
		switch ($msg) {
		case "msg_true":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>قد تم تنفيذ العملية بنجاح إذا لم يتم عرض الصورة الرجاء القيام بتحديث الصفحة .</p>";
		break;
		case "msg_false":
		echo "<p class='error'><img width='13' height='13' src='../images/tick.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "msg_max":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/> لايمكن تحميل الصورة ؛ يحب أن يكون الحجم الأقصي للصورة 200kb </p>";
		break;
		default:
		echo "حدث خطاء الرجاء المحاولة مرة أخري";
		}
		} 
		?>
		 
			<div>
				<table class="cvview">
					<tr >
					<td style="width:160px" >
						<div id="logopro">
						<?php 
						$filename="../images/seeker/";
						if($row->image !=""){
						$filename = '../images/seeker/'.$row->image; }
						?>
								<img class="imgseeker"  src=<?php if($row->image !=""){echo $filename;}else {echo "../images/test.jpg";}?> alt="الصورة الشخصية" /> 
	
						</div>
					</td><td style="width:250px">
					<div>
						<h3 >
						<?php echo '<a href="../view/cvs.php?id='.$row->user_id.'">'.$row->fname."  ".$row->lname.'</a>'; ?></h3>
						<span class="texts textlines">
						<?php echo "الجنسية: ".$row->nat_name;  ?>
						<br/>
						<?php echo " العنوان: ".$row->city_name; if($row->address !=""){ echo "، ".$row->address; } ?><br/>
						<?php $datereg=date("Y"); $age =  $datereg - $row->birth_day  ; echo "العمر:".$age." سنة"; ?><br/>
					
						<?php if($row->health_status== 2){echo "الحالة الصحية: معوق"; } ?>
						</span>
						<br/>
						<a href="modal_edit_pe.php" class="facebox" ><img src="../images/edit.png" alt="تعديل" /> تعديل</a>
					</div>
					</td>
					<td  class="cvinfo" >
					<span class='titleinfo' style="display:block;"> معلومات الأتصال </span>
					<br/>
					<img  src="../images/email.png" alt="email"/>
					<span class="texts" ><?php echo "  ".$row->email;?></span>
					<br/><br/>
					<?php if($row->phone !=""){?>
					<img  src="../images/telephone38.png" alt="email"/>
					<span class='texts' > <?php echo " ".$row->phone;?></span></a><br/><br/>
					<?php }?>
					<a href="modal_edit_co.php" class="facebox" ><img src="../images/edit.png" alt="تعديل"/> تعديل</a>
					</td>
					</tr>
					
				</table>
			</div>
			
		<a href="modal_change_pic.php" class="facebox" ><img src="../images/edit.png" alt="تعديل"/> تعديل </a>
		<a class="facebox" href="modal_delete_pic.php"><img src="../images/remove.png" alt="حذف" /> حذف </a><br/><br/>
		<p class="plinee">
		<br/>
		
	
		
		

	
				<div id="goal" class="post">
	الهدف الوظيفي</div><div class="item"><br/>
	<?php
	$rs= $mysqli->query("SELECT  goal_text
							FROM job_seeker
							WHERE job_seeker.user_id ='$txt_user_id' 
							 ")or die($mysqli->error());
	$resultcount = $rs->num_rows;
	$row=$rs->fetch_object();
			if($row->goal_text==""){
			echo "<span class='texts' > هذا الجزء مخصص لذكر هدفك الوظيفي،ماهي المهام والأهداف التي لديك التي تستيطع أن تقدمها والتي تطمح اليها.</span>";
			echo "<br/>";
			echo "<br/>";
			echo '<a class="facebox" href="modal_edit_goal.php">+ أضافة</a>';	}else{								


	echo "<span class='textdesc textlines'><br/>".$row->goal_text;
	echo "<br/>";
	echo "<br/>";
	echo '<a class="facebox" href="modal_edit_goal.php"><img src="../images/edit.png" alt="تعديل"/> تعديل</a>';
	echo '<a class="facebox" href="modal_delete_goal.php"><img src="../images/remove.png"/> حذف</a>';
	echo "<br/>";
	echo "<br/>";	
}

	$rs->free_result();
	?>

	</div>	
            
		<br/>
            <script src="../jquery8.js"></script>
            
<script>
$(document).ready(function(){
    $("#added").click(function(){
        $("#edd").html("<div class='loader'></div>");   
        
        $("#edd").load("usingfile.php?id=ed");
        
    });
            $("#removeed").click(function(){
        $("#edd").html("<div class='loader'></div>");   
        
        $("#edd").load("ed.php");

         });
});
</script>
			<div id="ed" class="post">
	المؤهل العلمي</div><div id="eddd"  class="item"><div id="edd"><br/>
	<?php
	$rs= $mysqli->query("SELECT start_date,ed_id,edt_name,domain_name,univ,specialty,avg,end_date,user_id
							FROM job_ed,job_domain,job_ed_type
							WHERE job_ed_type.edt_id = job_ed.edt_id
							AND job_ed.domain_id = job_domain.domain_id
							AND user_id ='$txt_user_id' 
							ORDER BY end_date DESC ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' >هذا الجزء مخصص لذكر المؤهلات العلمية الخاصة بك ، إذا كنت تملك شهادة البكالوريس أو شهادة أعلي منها يفضل عدم ذكرك لشهادتك الثانوية، إذاكان معدلك جيد أو اكثر فيفضل ذكر معدلك</span>";
			echo "<br/>";
			echo "<br/>";
			}										
	$resultcount = $rs->num_rows;
	while($row=$rs->fetch_object()){
	$id=$row->ed_id;
	
	
	echo "<span class='textb textlineb'>".$row->univ."</span>";
	echo "<span class='texts textlines'><br/>".$row->edt_name;
	if(!empty($row->specialty)){
	echo "، ";}
	echo $row->specialty;
	if(!empty($row->avg)){
	echo "، ";}
	echo $row->avg;
	echo "<br>".$row->start_date." - ".$row->end_date."";
	echo "<br/>"."المجال "."</span><span class='texts textlines'>".$row->domain_name."</span>";
	echo "<br/>";
	echo "<br/>";
	echo '<a class="facebox" href="modal_edit_ed.php?id='.$id.'"><img src="../images/edit.png" alt="تعديل"/> تعديل</a>';
	echo '<a class="facebox" href="modal_delete_ed.php?id='.$id.'"><img src="../images/remove.png"/> حذف</a>';
		echo "<br/>";
			echo "<br/>";	echo "<br/>";
	}
	$rs->free_result();
	?>
    	  	<?php 
		if ($resultcount <=10){
		echo '<a class="facebox" href="modal_add_ed.php" > +أضافة</a>';

		}
		else{
		echo "<span class='t'>وصلت للحد الأعلي من المؤهلات</span>"; 
		}
		?>   
</div>
                        <a id='removeed'></a>

</div>


		

	

            
	<br/>
		<br/>
			<div id="exp" class="post">
	الخبرة</div><div class="item"><br/>
	<?php
	
	$rs=$mysqli->query("select *  
							FROM job_exp,job_domain 
							WHERE job_exp.domain_id = job_domain.domain_id  
							AND user_id ='$txt_user_id'
							ORDER BY state DESC ,end_date DESC")or die($mysql->error());
		if($rs->num_rows==0){
		echo "<span class='texts' >أذا كنت حديث التخرج ولم تعمل من قبل فيفضل ترك هذا الجزاء فارغاً ، إذا كانت  لديك خبرة سابقة  يمكنك ذكرها هنا .</span>";
		echo "<br/>";
		echo "<br/>";
		}								  
	while($row=$rs->fetch_object()){
	$id=$row->exp_id; 
	$state =$row->state;
	$timeend = strtotime($row->end_date);
	$timestart = strtotime($row->start_date);

	echo "<span class='textb textlineb'>".$row->exp_name."</span>";
	echo "<span class='texts textlines'><br>في "."</span>";
	echo "<span class='texts textlines'>".$row->exp_comp;
	echo "<br>".date('Y-m',$timestart)." - ";if($state ==0){echo date('Y-m',$timeend);}else{echo "الي حد الأن";}
	echo "</span><br><span class='texts textlines'>"."مجال الشركة ";
	echo "".$row->domain_name."</span>";
	echo "<br/>";
	echo "<br/><span class='texts'>".nl2br($row->exp_desc)."</span>";
	echo "<br/>";

	echo "<br/>";
	echo '<a class="facebox" href="modal_edit_exp.php?id='.$id.'"><img src="../images/edit.png" alt="تعديل"/> تعديل</a>';
	echo '<a class="facebox" href="modal_delete_exp.php?id='.$id.'"><img src="../images/remove.png"/> حذف</a>';
		echo "<br/>";
			echo "<br/>";	echo "<br/>";
	}
	$rs->free_result();

	?>
		</div>
	  	<?php 
		if ($resultcount <=20){
		echo '<a class="facebox" href="modal_add_exp.php" > +أضافة</a>';
		}
		else{
		echo "<span class='t'>وصلت للحد الأعلي من المؤهلات</span>"; 
		}
		?>
	
	<br/>
		<br/>
			<div id="lang" class="post">
	اللغات</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select job_lang.lang_id,level_name,user_id,lang_name
			from job_lang_seeker,job_lang,job_level
			WHERE job_lang_seeker.lang_id = job_lang.lang_id
			AND job_level.level_id = job_lang_seeker.level_id
			AND user_id ='$txt_user_id'
			ORDER BY job_lang_seeker.level_id DESC ")or die(mysql_error());
			if($rs->num_rows==0){
			echo '<span class="texts" >هذا الجزء خاص بذكر اللغات التي لك ألمام بها ، يمكنك تحديد مستواك في اللغة .</span>';
			echo "<br/>";
			echo "<br/>";
			}
			while($row=$rs->fetch_object()){
			$id=$row->user_id; 
			$id_lang=$row->lang_id;
			echo "<span class='textb textlineb'>".$row->lang_name."</span>";
			echo "<span class='textdesc textlines'><br>المستوي : "."</span>";
			echo "<span class='texts textlines'>".$row->level_name."</span>";
			echo "<br/>";
			echo "<br/>";
			echo '<a class="facebox" href="modal_edit_lang.php?id='.$id_lang.'">';
			echo '<img src="../images/edit.png"/> تعديل</a>';
			echo "<a class='facebox' href='modal_delete_lang.php?id=$id_lang'>";
			echo "<img src='../images/remove.png'/> حذف</a>";
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
			</div>		
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_lang.php' > +أضافة</a> ";
		echo "<br/>";
		?>
	
<br/>
		<br/>
			<div id="skilles" class="post">
	المهارات</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select skilles_id,level_name,skilles_name from job_skilles,job_level WHERE job_level.level_id = job_skilles.level_id AND user_id ='$txt_user_id' ORDER BY job_skilles.level_id DESC ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' >هل تملك مهارات مثل استخدام برنامج محرر النصوص او خبرة في تصفح أدخال البيانات أو غيرها من المهارات ، يمكنك كتابتها هنا .</span>";
			echo "<br/>";
			echo "<br/>";
			}			
			while($row=$rs->fetch_object()){
			$skilles_id=$row->skilles_id;
			echo "<span class='textb textlineb'>".$row->skilles_name."</span>";
			echo "<span class='textdesc textlines'><br>المستوي : "."</span>";
			echo "<span class='texts textlines'>".$row->level_name."</span>";
			echo "<br/>";
			echo "<br/>";
			echo "<a class='facebox' href='modal_edit_skilles.php?id=$skilles_id'>";
			echo "<img src='../images/edit.png'/> تعديل</a>";
			echo "<a class='facebox' href='modal_delete_skilles.php?id=$skilles_id'>";
			echo "<img src='../images/remove.png'/> حذف</a>";
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
				</div>		
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_skilles.php' > +أضافة</a> ";
		echo "<br/>";
		?>

<br/>
		<br/>
			<div id="cert" class="post">
	الشهادات</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select cert_id,cert_name  from job_cert WHERE user_id ='$txt_user_id' ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' >هل لديك شهادات أخري بأسثناء الشهادات العلمية المعروفة ، يمكنك ذكرها هنا .</span>";
			echo "<br/>";
			echo "<br/>";
			}			
			while($row=$rs->fetch_object()){
			$cert_id=$row->cert_id;
			echo "<span class='textb textlineb'>".$row->cert_name."</span>";
			
			echo "<br/>";
			echo "<br/>";
			echo "<a class='facebox' href='modal_edit_cert.php?id=$cert_id'>";
			echo "<img src='../images/edit.png'/> تعديل</a>";
			echo "<a class='facebox' href='modal_delete_cert.php?id=$cert_id'>";
			echo "<img src='../images/remove.png'/> حذف</a>";
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
				</div>		
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_cert.php' > +أضافة</a> ";
		echo "<br/>";
		?>
	
<br/>
		<br/>
			<div id="train" class="post">
	التدريب</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select train_id,train_name,train_comp  from job_train WHERE user_id ='$txt_user_id' ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' >هل قمت بأخذ دورات  من قبل ، هذا المكان المناسب لذكرها في سيرتك الذاتية .</span>";
			echo "<br/>";
			echo "<br/>";
			}
			while($row=$rs->fetch_object()){
			$train_id=$row->train_id;
			echo "<span class='textb textlineb'>".$row->train_name."</span>";
			echo "<span class='textdesc textlines'><br>اسم المعهد : "."</span>";
			echo "<span class='texts textlines'>".$row->train_comp;
			echo "<br/>";
			echo "<br/>";
			echo "<a class='facebox' href='modal_edit_train.php?id=$train_id'>";
			echo "<img src='../images/edit.png'/> تعديل</a>";
			echo "<a class='facebox' href='modal_delete_train.php?id=$train_id'>";
			echo "<img src='../images/remove.png'/> حذف</a>";
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
				</div>		
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_train.php' > +أضافة</a> ";
		echo "<br/>";
		?>
	
<br/>
		<br/>
			<div id="hobby"  class="post">
	الهويات</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select hobby_id,hobby_name  from job_hobby WHERE user_id ='$txt_user_id' ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' > الهويات التي تهواها التي ربما تساهم في التعزيز من فرصك للحصول علي وظيفة .</span>";
			echo "<br/>";
			echo "<br/>";
			}
			while($row=$rs->fetch_object()){
			$hobby_id=$row->hobby_id;
			echo "<span class='textb textlineb'>".$row->hobby_name."</span>";
			
			echo "<br/>";
			echo "<br/>";
			echo "<a class='facebox' href='modal_edit_hobby.php?id=$hobby_id'>";
			echo "<img src='../images/edit.png'/> تعديل</a>";
			echo "<a class='facebox' href='modal_delete_hobby.php?id=$hobby_id'>";
			echo "<img src='../images/remove.png'/> حذف</a>";
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
			</div>		
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_hobby.php' > +أضافة</a> ";
		echo "<br/>";
		?>
		
<br/>
		<br/>
			<div id="ref" class="post">
	المعرفون</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select ref_id,ref_name,ref_phone,ref_email,ref_adj  from job_ref WHERE user_id ='$txt_user_id' ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' > اكتب اسم اثنين ممن يعرفون مستواك العلمي و المهني -  هذا الجزء ليس إلزامي .</span>";
			echo "<br/>";
			echo "<br/>";
			}
			while($row=$rs->fetch_object()){
			$ref_id=$row->ref_id;
			echo "<span class='textb textlineb'>".$row->ref_name."</span>";
			echo "<span class='textdesc textlines'><br>الصفة : "."</span>";
			echo "<span class='texts textlines'>".$row->ref_adj;	
			echo "<span class='textdesc textlines'><br>البريد الألكتروني : "."</span>";
			echo "<span class='texts textlines'>".$row->ref_email;		
		
			echo "<span class='textdesc textlines'><br>الهاتف : "."</span>";
			echo "<span class='texts textlines'>".$row->ref_phone."</span>";		

			echo "<br/>";
			echo "<br/>";
			echo "<a class='facebox' href='modal_edit_ref.php?id=$ref_id'>";
			echo '<img src="../images/edit.png"  alt="تعديل" /> تعديل</a>';
			echo "<a class='facebox' href='modal_delete_ref.php?id=$ref_id'>";
			echo '<img src="../images/remove.png" alt="تعديل"/> حذف</a>';
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
			</div>		
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_ref.php' > +أضافة</a> ";
		echo "<br/>";
		?>
		
		<br/>
			<div id="info" class="post">
	معلومات أضافية</div><div class="item"><br/>
	<?php 
	
	$rs=$mysqli->query("select info_id,info_name,info_date  from job_info WHERE user_id ='$txt_user_id' ORDER BY info_date DESC ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' >أذا كان لديك معلومات اخري تود اضافتها ولم تجد المكان المناسب لها يمكنك ذكرها هنا ،مثل العضويات والجوائز والأنجازات وغيرها </span>";
			echo "<br/>";
			echo "<br/>";
			}
			while($row=$rs->fetch_object()){
			$info_id=$row->info_id;
			echo "<span class='textb textlineb'>".$row->info_name."</span>";
			echo "<span class='textdesc textlines'><br>سنة : "."</span>";
			echo "<span class='texts textlines'>".$row->info_date;	

			echo "<br/>";
			echo "<br/>";
			echo "<a class='facebox' href='modal_edit_info.php?id=$info_id'>";
			echo "<img src='../images/edit.png' alt='تعديل' /> تعديل</a>";
			echo "<a class='facebox' href='modal_delete_info.php?id=$info_id'>";
			echo "<img src='../images/remove.png'  alt='حذف' /> حذف</a>";
			echo "<br/>";
			echo "<br/>";
			}
			$rs->free_result(); 
			?>
				
	  	<?php 
	
		echo "<a class='facebox' href='modal_add_info.php' > +أضافة</a> ";

		echo "<br/>";
		?>
            		

		</div>	
          
<br/>
<br/>
<br/>


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