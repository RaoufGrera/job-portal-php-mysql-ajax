<?php 

require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
	
$rs=$mysqli->query("SELECT *
							FROM job_seeker, job_city, job_nat
							WHERE job_city.city_id = job_seeker.city_id
							AND job_nat.nat_id = job_seeker.nat_id
							AND user_id ='$txt_user_id'")or die($mysql->error());
	
$row = $rs->fetch_object();
$rs->free_result();
$id=$row->user_id;
$_SESSION['user_idd'] = $row->user_id;

//لتأكد من عملية تعديل الصورة أو حذفها
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 
?>
	
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>
الملف الشخصي
</title>


<?php
include_once("../header.php");// جلب ملفات css
?>
		
</head>
<body>
	<div class="wrapper">
		<div id="header">
				<div class="had">
					<a href="../index.php"><img src="../images/logo44.png" alt="الشعار" ></a>		
				</div>
			<div class="hed">
				<div id="logo">
				</div>
				<ul id="navigation">
					<li>
					<a href="../view/searchJob.php" class="hoverbut ">الوظائف</a>
					</li>
					<li>
					<a href="jobseeker.php" class="hoverbut selected">السير الذاتية </a>
					</li>
					<li class="mm">|</li>
					<li class="selected hoverbut" >
					<a href="profile.php"  title=" تسجيل دخول"> الملف الشخصي</a>
					</li>
					<li>
					<a href="logout.php" title="تسجيل الخروج" >خروج</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="container">
		
		 <!--القائمة الرئيسية-->
		<?php 
		include('sidebar_profile.php'); 
		?>
		
		<div class="span9" >		
			<div class="item">
			<h4 id="title_reg">
			أسم المستخدم : <?php echo $row->fname ." ".$row->lname; ?>
			</h4>
			<p class="plinee"></p>
			<div>		
			<h4><a class="anchor" name="pic">السيرة الذاتية</a></h4>	
			</div>
<?php 
$filename="../images/seeker/ll.jpg";
if($row->image !=""){
$filename = '../images/seeker/'.$row->image; }
?>
		<img class="imgseeker"  src=<?php if($row->image !=""){echo $filename;}else {echo "../images/test.jpg";}?> >  </img>
		
		<br><br>
		<a href="modal_change_pic.php" rel='facebox' ><img src="../images/edit.png"/> تعديل الصورة</a>
		<a rel="facebox" href="modal_delete_pic.php"><img src="../images/remove.png"/> حذف الصورة</a>
		</div>
		<?php
		if(!empty($msg)){
		switch ($msg) {
		case "msg_true":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>قد تم تنفيذ العملية بنجاح</p>";
		break;
		case "msg_false":
		echo "<p class='error'><img width='13' height='13' src='../images/tick.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "msg_max":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/> لايمكن تحميل الصورة ؛ يحب أن يكون الحجم الأقصي للصورة 200kb </p>";
		break;
		default:
		echo "Your favorite color is neither red, blue, or green!";
		}
		} 
		?>
		  <?php  if((isset($_GET['log']))   && ($_GET['log'] =='errorimage')) { 
       	 	echo "<p class='error' ><img width='13' height='13' src='images/invalid.png'/> لايمكن تحميل الصورة ؛ يحب أن يكون الحجم الأقصي للصورة 200kb </p>";
       } elseif  ((isset($_GET['log']))  && ($_GET['log'] == 'trueimage')) { 
     		echo "<p class='truee'><img width='13' height='13' src='images/tick.png'/> قد تم تحميل الصورة بنجاح</p>";
		}
		?>
		<br/>
		<br/>
	
		<fieldset class="grouppost">
			<legend><a name="personalinfo"></a>لمعلومات الشخصية </legend><br/>
<table class="tabe" width="700">	
	<tr>
		<td>
			<label class="control-labe">
										الأسم :
			</label>
			<span class="texttt"><?php echo $row->fname; ?></span>
		</td>
	</tr>		
	<tr>	 
		<td>
			 <label class="control-labe">
									اللقب :
			</label><span class="texttt"><?php echo $row->lname; ?></span>
			</td>
			</tr>
			 <tr>
		 
			<td>
			<label class="control-labe">
								العمر :
			</label><span class="texttt"><?php $datereg=date("Y"); $age =  $datereg - $row->birth_day  ; echo $age; ?></span> 
			</td>
			</tr>
			 <tr>
			 <td>
			 <label class="control-labe">
								الجنس :
			</label><span class="texttt"><?php if($row->gender = 'm'){echo 'ذكر';}else{echo 'أنثي';} ?></span> 
			</td>
			</tr>
				 <tr>
			 <td>
			<label class="control-labe">
							الجنسية :
								</label><span class="texttt"><?php echo $row->nat_name; ?></span>
			</td>
			</tr>

		
		</table>
	
<p>
<a href="modal_edit_pe.php" rel='facebox' ><img src="../images/edit.png"/> تعديل</a>
		</fieldset>


<fieldset class="grouppost">
		<legend><a name="contact"></a>معلومات الأتصال</legend><br/>
		<table class=" tabe" width="700">

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
		رقم الهاتف :
		</label><span class="texttt"><?php echo $row->phone; ; ?></span> 
		</td>
		</tr>
		<tr class="iteminli">
		<td>
		<label class="control-labe">
		المدينة :
		</label><span class="texttt"><?php echo $row->city_name; ?></span> 
		</td>
		</tr>
		<tr class="iteminli">
		<td>
		<label class="control-labe">
		العنوان :
		</label><span class="texttt"><?php echo $row->address; ?></span> 
		</td>
		</tr>

		</td>
		</tr>
		</table><p>
		<a href="modal_edit_co.php" rel='facebox' ><img src="../images/edit.png"/> تعديل</a>
	</fieldset>
	
<fieldset class="grouppost">
	<legend><a name="ed"></a>المؤهل العلمي</legend>
	<br/>	

<table class="tblm table-bordered textcenter"  width="700"  >
	<tr>
		<th>المؤهل</th>
		<th>الجامعة</th>
		<th>التخصص</th>
		<th>المجال</th>
		<th>المعدل</th>
		<th>من</th>
		<th>الي</th>
		  <th colspan="2" width="50">التحكم</th>
	</tr>
	<tbody>
   
<?php 
/*
#
#المؤهل العلمي
#يتم عرض البيانات الناتجة من الأستعلام داخل الجدول
#
#*/
$rs= $mysqli->query("SELECT start_date,ed_id,edt_name,domain_name,univ,specialty,avg,end_date,user_id
							FROM job_ed,job_domain,job_ed_type
							WHERE job_ed_type.edt_id = job_ed.edt_id
							AND job_ed.domain_id = job_domain.domain_id
							AND user_id ='$txt_user_id' 
							ORDER BY end_date DESC ")or die($mysqli->error());
											
$resultcount = $rs->num_rows;
while($row=$rs->fetch_object()){
	$id=$row->ed_id;
	echo "<tr>";
	echo "<td>".$row->edt_name."</td>"; 
	echo "<td>".$row->univ."</td>"; 
	echo "<td>".$row->specialty."</td>";
	echo "<td>".$row->domain_name."</td>";  
	echo "<td>".$row->avg."</td>";  
	echo "<td>".$row->start_date."</td>";  
	echo "<td>".$row->end_date."</td>";  
	echo "<td>";	   
	echo "<a rel='facebox' href='modal_edit_ed.php?id=$id'><img src='../images/edit.png'/> تعديل</a>";
	echo "</td>";
	echo "<td>";
	echo "<a rel='facebox' href='modal_delete_ed.php?id=$id'><img src='../images/remove.png'/> حذف</a>";
	echo "</td>";
	echo "</tr>";	
}
$rs->free_result(); // تقوم بتنظيف الأستعلام
?>                      
     </tbody>
</table>
		<p>
	  	<?php 
		if ($resultcount <=8){
		echo "<a rel='facebox' href='modal_add_ed.php' > +أضافة</a> ";
		}
		else{
		echo "<span class='t'>وصلت للحد الأعلي من المؤهلات</span>"; 
		}
		?>	
</fieldset>

<!--
#
#الخبرة
#
#
-->

<fieldset class="grouppost">
	<legend><a name="exp"></a>الخبـرة</legend>
	<br/>	
	<table class="tblm table-bordered textcenter"  width="700"  >
	 <tr>
		<th width="100">الشركة	</th>
		<th width="100"> الوظيفة	</th>
		<th width="100">القطاع	</th>
		<th width="100">من		</th>
		<th width="100">إلي		</th>
		<th colspan="2" width="50">التحكم</th>
	</tr>
      <tbody>
		  
		  <?php 
		  $rs=$mysqli->query("select *  
									FROM job_exp,job_domain 
									WHERE job_exp.domain_id = job_domain.domain_id  
									AND user_id ='$txt_user_id'
									ORDER BY state DESC ,end_date DESC")or die($mysql->error());
									  
			while($row=$rs->fetch_object()){
				$id=$row->exp_id; 
				$state =$row->state;
				$end_date =$row->end_date;
				echo "<tr>";
				echo "<td>".$row->exp_comp."</td>"; 
				echo "<td>".$row->exp_name."</td>"; 
				echo "<td>".$row->domain_name."</td>"; 
				echo "<td>".$row->start_date."</td>"; 
				echo "<td>";
				if($state=='0'){ 
				echo $end_date; 
				}
				else{
				echo "الي حد الأن";
				} 
				echo "</td>";
				echo "<td>";
				echo "<a rel='facebox' href='modal_edit_exp.php?id=$id'><img src='../images/edit.png'/> تعديل</a>";
				echo "</td>";
				echo "<td>";
				echo "<a rel='facebox'  href='modal_delete_exp.php?id=$id'><img src='../images/remove.png'/> حذف</a>";
				echo "</td>";
				echo "</tr>";
			} 
			$rs->free_result();
			?>              
           </tbody>
		</table>
		<p>
	  <?php 
	  if ($resultcount <=15){
	  echo "<a rel='facebox' data-toggle='modal'  href='modal_add_exp.php' > +أضافة</a> ";
	  }
	  else {
	  echo "<span class='t'>وصلت للحد الأعلي من الخبرات</span>"; 
	  }
	  ?>
</fieldset>
<!--
#
#اللغة
#
#
-->
<fieldset class="grouppost">
	<legend><a name="lang"></a>اللغة</legend>
	<br/>	
		<table class="tblm table-bordered textcenter"  width="700">
			<tr>
				<th width="250">اللغة</th>
				<th width="250">المستوي</th>
				<th colspan="2" width="50">التحكم</th>
			</tr>
			<tbody>
			<?php 
			$rs=$mysqli->query("select job_lang.lang_id,level_name,user_id,lang_name
			from job_lang_seeker,job_lang,job_level
			WHERE job_lang_seeker.lang_id = job_lang.lang_id
			AND job_lang_seeker.lang_id = job_level.level_id
			AND user_id ='$txt_user_id' ")or die(mysql_error());
			while($row=$rs->fetch_object()){
			$id=$row->user_id; 
			$id_lang=$row->lang_id;
			
			echo "<tr>";
			echo "<td>".$row->lang_name."</td>"; 
			echo "<td>".$row->level_name."</td>";
			echo "<td>";
			echo "<a rel='facebox'  href='modal_edit_lang.php?id=$id_lang'><img src='../images/edit.png'/> تعديل </a>";
			echo "</td>";
			echo "<td>";
			echo "<a rel='facebox' href='modal_delete_lang.php?id=$id_lang'><img src='../images/remove.png'/> حذف</a>";
			echo "</td>";
			echo "</tr>";
			} 
			?>               
			</tbody>
		</table>
		<p>
	  	 <?php
		 if ($resultcount <=6){
		 echo "<a rel='facebox'  href='modal_add_lang.php' > +أضافة</a> ";
		 }else {
		 echo "<span class='t'>وصلت للحد الأعلي من المؤهلات</span>"; 
		 }
		 ?>

			
 
</fieldset>
<!--
#
#المهارات
#
#
-->
<fieldset class="grouppost">
	<legend><a name="skilles"></a>المهارات</legend>
	<br/>	
		<table class="tblm table-bordered textcenter"  width="700">
		<tr>
			<th width="250">المهارة</th>
			<th width="250">المستوي</th>
			<th width="50"colspan="2">التحكم</th>
		</tr>
			<tbody>
			<?php 
			$rs=$mysqli->query("select skilles_id,level_name,skilles_name from job_skilles,job_level WHERE job_level.level_id = job_skilles.level_id AND user_id ='$txt_user_id' ")or die($mysqli->error());
			while($row=$rs->fetch_object()){
			$skilles_id=$row->skilles_id;
			echo "<tr>";
			echo "<td>".$row->skilles_name."</td>";
			echo "<td>".$row->level_name."</td>"; 
			echo "<td><a rel='facebox'  href='modal_edit_skilles.php?id=$skilles_id '><img src='../images/edit.png'/> تعديل </a></td>";
			echo "<td><a rel='facebox'  href='modal_delete_skilles.php?id=$skilles_id '><img src='../images/remove.png'/> حذف </a></td>";
			echo "</tr>";
               } 
			   ?>
                           
		    </tbody>
		</table>
		<p>
	  	 <?php if ($resultcount <=8){echo "<a rel='facebox' data-toggle='modal'  href='modal_add_skilles.php' > +أضافة</a> ";}else {echo "<span class='t'>وصلت للحد الأعلي من المهارات</span>"; }?>
		</fieldset>
<!--
#
#الشهادات
#
#
-->
<fieldset class="grouppost">
	<legend><a name="skilles"></a>الشهادات</legend>
	<br/>	
		<table class="tblm table-bordered textcenter"  width="700">
		<tr>
			<th width="250">المهارة</th>
			<th width="250">المستوي</th>
			<th width="50"colspan="2">التحكم</th>
		</tr>
			<tbody>
			<?php 
			$rs=$mysqli->query("select skilles_id,level_name,skilles_name from job_skilles,job_level WHERE job_level.level_id = job_skilles.level_id AND user_id ='$txt_user_id' ")or die($mysqli->error());
			while($row=$rs->fetch_object()){
			$skilles_id=$row->skilles_id;
			echo "<tr>";
			echo "<td>".$row->skilles_name."</td>";
			echo "<td>".$row->level_name."</td>"; 
			echo "<td><a rel='facebox'  href='modal_edit_skilles.php?id=$skilles_id '><img src='../images/edit.png'/> تعديل </a></td>";
			echo "<td><a rel='facebox'  href='modal_delete_skilles.php?id=$skilles_id '><img src='../images/remove.png'/> حذف </a></td>";
			echo "</tr>";
               } 
			   ?>
                           
		    </tbody>
		</table>
		<p>
	  	 <?php if ($resultcount <=8){echo "<a rel='facebox' data-toggle='modal'  href='modal_add_skilles.php' > +أضافة</a> ";}else {echo "<span class='t'>وصلت للحد الأعلي من المهارات</span>"; }?>
		</fieldset>
 </div>
	

</div>
</div>
<?php
include_once("../footer.php");// جلب ملفات js
?>
    </body>

</html>