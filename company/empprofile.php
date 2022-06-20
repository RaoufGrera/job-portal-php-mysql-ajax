<?php 
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

if(isset($_POST['delete_user'])){
$delete=$mysqli->query("DELETE FROM job_employer WHERE emp_id ='$txt_user_id' ");
header("Location: ../logout.php");
}

if((isset($_POST['submit'])) &&
	(!empty($_POST['pass_old'])) &&
	(!empty($_POST['pass_new']))){
	if(strlen($_POST['pass_new']) >= 6){
	$pass_new = md5(safe_input($_POST['pass_new']));
	$pass_old = md5(safe_input($_POST['pass_old']));
	$result = $mysqli->query("SELECT password  FROM job_employer WHERE emp_id = '$txt_user_id'  ");
	$rows = $result->fetch_object();

	if($rows->password  == $pass_old ){
 	$query_pass = $mysqli->query("UPDATE `job_employer` SET `password` = '$pass_new' WHERE emp_id = '$txt_user_id'");
	if($query_pass){
	$_SESSION["msg"] = "pass_true";

	}else{ 
	$_SESSION["msg"] = "pass_error";
}

	}else{
	$_SESSION["msg"] = "pass_false"; // كلمة السر خطاء
	

	}
	
	}else{
		$_SESSION["msg"] = "pass_min"; //  السر خطاءقصيرة
	
	}
	}

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
الملف الشخصي - معلومات الحساب
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
							
							<li class="active"> <a href="empprofile.php">بيانات الحساب</a>
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
	<div class="item">
				<h4 id="title_reg">
				أسم الشركة : 
				<?php
				 require_once("../db/db.php");
						
                        $rs=mysqli_query($mysqli,"select fname,lname,email,emp_id,comp_name from job_employer,job_company where job_company.comp_id =job_employer.comp_id  and job_employer.emp_id='$txt_user_id'")or die(mysql_error());
                        $row=$rs->fetch_object();
						$id=$row->emp_id;
							$user_idd =	$row->emp_id;
                        echo $row->comp_name;

                    ?>
		
				</h4>
				
<p class="plinee"></p>
		<?php
		if(!empty($msg)){
		switch ($msg) {
		case "pass_min":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/>كلمة السر الجديدة قصيرة ، يجب ان تتكون من أكثر من 5 خانات.</p>";
		break;
		case "truee":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>قد تم تنفيذ العملية بنجاح</p>";
		break;
		case "msg_false":
		echo "<p class='error'><img width='13' height='13' src='../images/tick.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "pass_error":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/> حدث خطاء ما ، لم يتم تغيير كلمة السر.</p>";
		break;
		case "pass_false":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/>كلمة السر غير صحيحة.</p>";
		break;
		case "pass_true":
		echo "<p class='truee' ><img width='13' height='13' src='../images/tick.png'/>تم تغيير كلمة السر بنجاح.</p>";
		break;
		default:
		echo "حدث خطاء ما الرجاء المحاولة مرة أخري";
		}
		} 
		?>
		<br/><br/>
	
		<fieldset class="grouppost">
			<legend><a name="personalinfo"></a>تغيير كلمة السر</legend><br/>
			<form  name="change"    action="" method="POST" >
				<table class=" tabe iteminli" width="690">
			

				<tr>
						<!-- -->
						<td>
							<label class="control-label" for="pass_old">
								الرقم السري 
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input autocomplete="off" id="pass_old" name="pass_old" type="password" placeholder="الرقم السري الحالي" required />
						
						</td>
						<td>
								<div>
								</div>
						</td>
						<td>
					
						</td>
					</tr>
					<tr>
						<!-- -->
						<td>
							<label class="control-label" for="pass_new">
								الرقم السري الجديد
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input autocomplete="off" id="pass_new" name="pass_new" type="password" placeholder="الرقم السري الجديد" required />
						</td>
						<td>
								<div>
								</div>
						</td>
						<td>
					
						</td>
					</tr>	
									
					</table>

	
<p>
<input class="btn btn-info " name="submit" type="submit" value="تغيير" />
</form>
		</fieldset>

		<fieldset class="grouppost">
			<legend><a name="personalinfo"></a>المعلومات الشخصية</legend><br/>
<table class=" iteminli tabe" width="700">
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
الأسم :
</label><span class="texttt"><?php echo $row->fname; ?></span>
</td>
</tr>
<tr>
<td>
<label class="control-labe">
اللقب :
</label><span class="texttt"><?php echo $row->lname; ?></span> 
</td>
</tr>
</table>

<p>
<a href="modal_edit_pe.php"  class="btn btn-info facebox" >تعديل</a>

	</fieldset>   
<p>	
<fieldset class="grouppost">
		<legend><a name="contact"></a>حذف الحساب</legend><br/>
			<form name="fooorm" action="" method="post" onsubmit="return confirm('هل أنت متأكد من حذف الحساب الخاص بك ؟');" >
<span class="texts">عند النقر علي زر حذف الحساب سيتم حذف حسابك نهائياً من الموقع . </span><br/><br/>
		<input name="delete_user" class="btn btn-info " onclick="return confirm(\'هل أنت متأكد من الحذف ?\')" type="submit" value="حذف الحساب " />
		</form><p>
	
	</fieldset>	
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