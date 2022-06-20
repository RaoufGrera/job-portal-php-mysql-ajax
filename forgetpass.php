<?php
session_start();  

if(!empty($_SESSION['txt_user_id']))  {  
	if($_SESSION['txt_type'] =="seeker"){
	header("Location: seeker/profile.php");  
	exit();
	}else if(($_SESSION['txt_type'] =="employer") || ($_SESSION['txt_type'] =="company")){

	header("Location: company/empprofile.php");  
	exit();
}
}
require_once("db/db.php");
if((!empty($_POST['login'])) && (!empty($_POST['txt_email']))) {
		$txt_email='';
		$txt_email		 = safe_input(trim($_POST['txt_email']));


		$query = $mysqli->query("(SELECT user_id,count_in,email,is_active,activation from job_seeker where email='$txt_email' AND is_active in('0') AND block_admin in('0') ) UNION (SELECT emp_id as user_id,count_in,email,is_active,activation from job_employer where email='$txt_email' AND is_active in('2') AND block_admin in('0')) ");
		if(!$query) {
			die("حدث خطاء في التنفيذ ، الرجاء اعادة الطلب مرة أخري");
		}
			if($query->num_rows == 0) {
			$_SESSION['msg'] = 'msg_false';
			header("Location: forgetpass.php");
			exit();	
}else if($query->num_rows == 1){

$found = $query->fetch_object();
if(($found->is_active ==0) || ($found->is_active ==1) ){
$type = "seeker";
}else if(($found->is_active == 2)  || ($found->is_active == 3) ){
$type ="employer";
}
$activation = $found->activation;
$to 	 = $txt_email; 
$subject = "استعادة كلمة السر | موقع التوظيف الألكتروني";
$newsubject='=?UTF-8?B?'.base64_encode($subject).'?=';
$message  = '
<html dir="rtl">
<head>
<title>email</title>
</head>
<body>


استعادة كلمة السر الخاصة بك .

<p>
<p><br>
بيانات الحساب
<p><br>

------------------------<p>
البريد الالكتروني: '.$txt_email.'<p>

------------------------

<p><p>


لتغيير كلمة السر الخاصة بك   <a href=" http://localhost/www/ab_swe/AB/2/1.2/changepass.php?email='.$txt_email.'&activation='.$activation.'&type='.$type.'">أضغط هنـــا </a>

<p>

</body>
</html>
'; 
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	
	$headers .= 'From: <joblibya@joblibya.com>' . "\r\n";
	$headers .= 'Cc: it1992t@gmail.com' . "\r\n";

mail($to,$newsubject,$message,$headers);
if(mail){
$_SESSION['msg'] = 'msg_true';
header("Location: forgetpass.php");
exit();	

}else{

$_SESSION['msg'] = 'msg_errorsend';
header("Location: forgetpass.php");
exit();	
}
}
}

if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
} 
?>
<!DOCTYPE html>
<html>
<head>

<title>
أستعادة كلمة السر - ليبيا سي في
</title>

<!-- Meta Tags -->
<meta http-equiv="content" content="text/html; charset = utf-8"/>

<link href="css/bootstrap.css" rel="stylesheet">	
	
<!-- CSS -->
<link rel="stylesheet" href="css/style1.css" type="text/css">
<link href="css/structurep.css" rel="stylesheet">
<link href="css/silder.css" rel="stylesheet">
</head>
    <body>

		<div class="wrapper">
		<div id="header">
			<div class="had">
			<a href="index.php"><img src="images/logo44.png" alt="logo" ></a>
			</div>
			<div class="hed">
</div>
	</div>

<div id="container" >
	<div class="span1">
		<div style="padding:0 20px 0 0;">
		<h4>إستعادة كلمة السر</h4>
		</div>
	<br/>
	<br/>
	<?php
	if(!empty($msg)){
		switch ($msg) {
		case "msg_false":
		echo "<p class='error'>الرقم السري أو البريد الألكتروني غير صحيح</p>";
		break;
		case "msg_errorsend":
		echo "<p class='error'>حدث خطاء في الأرسال الرجاء أعادة المحاولة مرة أخري</p>";
		break;
		case "msg_true":
		echo "<p class='truee'>قد تم أرسال رسالة أستعادة كلمة السر لبريدك الألكتروني</p>";
		break;
		default:
		echo "<p class='error'>حدث خطاء ";
		}
		} 	
		?>
	<br/>
       	<div id="wrap">
			<br/>
			<form   action="<?php echo $_SERVER['PHP_SELF']; ?>"    method="POST" >
البريد الألكتروني  <input type='text' name="txt_email"  required ></input>
	<br/><br/>
	<input type="submit" name="login" class="btn btn-info" value="أستعادة كلمة السر"/>
	<br/><br/>
	</form>
		</div>
	<br/>
	<br/>
	<br/>
</div>
</div>
</div>



		
</body>

</html>