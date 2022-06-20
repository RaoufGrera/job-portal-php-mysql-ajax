<?php
require_once("db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
if((isset($_POST['submit'])) &&
	(!empty($_POST['pass_c'])) &&
	(!empty($_POST['pass_new']))){
	if(strlen($_POST['pass_new']) >= 6){
	$email = safe_input($_GET['email']); 
	$pass_new = md5(safe_input($_POST['pass_new']));
	$pass_c = md5(safe_input($_POST['pass_c']));
	if($pass_new  == $pass_c ){
	
	if($_GET['type']=='employer'){
 	$query_pass = $mysqli->query("UPDATE `job_seeker` SET `password` = '$pass_c',is_active ='0' WHERE email = '$email'");
	if($query_pass){
	$_SESSION["msg"] = "pass_true";
	header("Location: login.php");  
	}else{ 
	$_SESSION["msg"] = "pass_error";
	}
}else if($_GET['type']=='seeker'){
 	$query_pass = $mysqli->query("UPDATE `job_employer` SET `password` = '$pass_c',is_active ='2' WHERE email = '$email'");
	if($query_pass){
	$_SESSION["msg"] = "pass_true";
	header("Location: login.php");  
	}else{ 
	$_SESSION["msg"] = "pass_error";
	}

}

	}else{
	$_SESSION["msg"] = "pass_worng"; // كلمة السر خطاء
	

	}
	}else{
		$_SESSION["msg"] = "pass_min"; //  السر خطاءقصيرة
	}
	}
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 	
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['activation']) && !empty($_GET['activation']) && !empty($_GET['type'])){
				
				$email = safe_input($_GET['email']); 
				$activation = safe_input($_GET['activation']); 
				if($_GET['type'] == "seeker"){
				$search = $mysqli->query("SELECT email, activation, is_active FROM job_seeker WHERE email='".$email."' AND activation='".$activation."' AND block_admin='0'"); 
				$match  = $search->num_rows;
				}else if($_GET['type'] == "employer"){
				$search = $mysqli->query("SELECT email, activation, is_active FROM job_employer WHERE email='".$email."' AND activation='".$activation."' AND block_admin='0'"); 
				$match  = $search->num_rows;				
				}
				}
				
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
تغيير كلمة السر
</title>
<!-- CSS -->

<link rel="stylesheet" href="css/style1.css" >

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
			<a href="index.php"><img src="images/logo44.png" alt="logo" ></a>
			</div>
			</div>	
			
			<div id="container" >
	<div class="span1">
	

	<div class="item">
	<?php if($match > 0){ ?>	
				<h4>
			أضافة كلمة سر جديدة
				</h4>
<?php
		if(!empty($msg)){
		switch ($msg) {
		case "pass_min":
		echo "<p class='error' ><img width='13' height='13' src='../images/invalid.png'/>كلمة السر الجديدة قصيرة ، يجب ان تتكون من أكثر من 5 خانات.</p>";
		break;		
		case "pass_error":
		echo "<p class='error' ><img width='13' height='13' src='images/invalid.png'/> حدث خطاء ما ، لم يتم تغيير كلمة السر.</p>";
		break;
		case "pass_worng":
		echo "<p class='error' ><img width='13' height='13' src='images/invalid.png'/>كلمة السر غير صحيحة.</p>";
		break;
		case "pass_true":
		echo "<p class='truee' ><img width='13' height='13' src='images/tick.png'/>تم تغيير كلمة السر بنجاح.</p>";
		break;
		default:
		echo "حدث خطاء ما الرجاء المحاولة مرة أخري";
		}
		} 
		?>
		
<div>
<form  name="change"    action="" method="POST" >
				<table class=" tabe iteminli" width="690">
			

				<tr>
						<!-- -->
						<td>
							<label class="control-label" for="pass_new">
								الرقم السري 
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input autocomplete="off" id="pass_new" name="pass_new" type="password"  maxlength="20" placeholder="الرقم السري الجديد" required />
						
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
							<label class="control-label" for="pass_c">
								إعادة الرقم السري
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input autocomplete="off" id="pass_c" name="pass_c" type="password"  maxlength="20" placeholder="أعادة الرقم السري" required />
						</td>
						<td>
								<div>
								</div>
						</td>
						<td>
					
						</td>
					</tr>	
									
					</table>

	
<div class ="btns">
<input class="btn btn-info " name="submit" type="submit" value="تغيير" />
</div>
</form>
		</div>
		<br/>
		<br/>
		<br/>
		<?php }else{  ?>


<br/>
<br/>
العنوان غير صحيح
<br/>
<br/>
<?php }  ?>
</div>	
</div></div>
		
</body>
</html>