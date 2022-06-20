<?php 

require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
	
$rs=$mysqli->query("SELECT *
							FROM job_seeker, job_city
							WHERE job_city.city_id = job_seeker.city_id
							
							AND user_id ='$txt_user_id'")or die($mysql->error());

$row = $rs->fetch_object();
$rs->free_result();
$id=$row->user_id;
$_SESSION['user_idd'] = $row->user_id;

if(isset($_POST['delete_user'])){
$delete=$mysqli->query("DELETE FROM job_seeker WHERE user_id='$txt_user_id' ");
header("Location: ../logout.php");
}

if((isset($_POST['submit'])) &&
	(!empty($_POST['pass_old'])) &&
	(!empty($_POST['pass_new']))){

	$pass_new = md5(safe_input($_POST['pass_new']));
	$pass_old = md5(safe_input($_POST['pass_old']));
	$result = $mysqli->query("SELECT password  FROM job_seeker WHERE user_id = '$txt_user_id'  ");
	$rows = $result->fetch_object();

	if($rows->password  == $pass_old ){
 	$query_pass = $mysqli->query("UPDATE `job_seeker` SET `password` = '$pass_new' WHERE user_id = '$txt_user_id'");
	if($query_pass){
	$_SESSION["msg"] = "pass_true";

	}else{ 
	$_SESSION["msg"] = "pass_error";
}

	}else{
	$_SESSION["msg"] = "pass_false"; // كلمة السر خطاء
	

	}
	}

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
إعدادات الحساب
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
					<li class="selected " >
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
                        <li > <a href="profile.php"></i>السيرة الذاتية</a> </li>
					
				
						<li>
								<a href="seekerreq.php"> طلبات التوظيف</a>
							</li>
							<li>
							<a href="seekersave.php">الوظائف المحفوظة</a>
							</li>
						<li class="active">
                            <a href="settings.php">أعدادات الحساب</a>
                        </li>
                    </ul>
                </div>
		
		<div class="span9" >		
				<div class="item">
			<h4 id="title_reg">
			<h4>أعدادات الحساب</h4>	
			</h4>
			<p class="plinee"></p>
			</div>
		<?php
		if(!empty($msg)){
		switch ($msg) {
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
		 
		<br/>
		<br/>
	
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
		<legend><a name="contact"></a>أعدادات السيرة الذاتية</legend><br/>
			<form id="form2" name="form2"  accept-charset="UTF-8"  action="hide_cv.php" method="post" >
		<table  class=" tabe" width="700">

		<tr class="iteminli">
						<td>
							<label class="control-label" for="hide_cv">
							حالةالسيرة الذاتية
								
							</label>
						</td>
						<td>			
						<input type="radio" name="hide_cv" value="0"  <?php if( $row->hide_cv ==0){echo "checked";}?>>أظهار السيرة الذاتية<br>
						<input type="radio" name="hide_cv" value="1" <?php if( $row->hide_cv ==1){echo "checked";} ?>>أخفاء السيرة الذاتية
						
					
						</td>
					<td><div>
						</div></td>
						<td>
						<span></span>
						</td>
					</tr>
		
		</table>
		<input class="btn btn-info " type="submit" value="تغيير" />
		</form><p>
	
	</fieldset>
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


<?php
include_once("../inc/footerdown.php");
include_once("../inc/footer.php");
?> 
    </body>

</html>