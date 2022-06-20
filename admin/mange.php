<?php 
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
error_reporting(0);

if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
}
if(!empty($_GET['delete_id'])){//التأكد من وجود قيمة 
$delete_id= safe_input($_GET['delete_id']);

	//حذف الموظف
	$rsdelete = $mysqli->query("DELETE FROM `job_admin` WHERE   admin_id= '$delete_id'" ); 
	
	if(!($rsdelete)){
	$_SESSION["msg"] = "msg_false";
	header("Location: mange.php"); 
	} 
	else{
	$_SESSION["msg"] = "deleted";
	header("Location: mange.php"); 
	}	
	}

if((!empty($_GET['id'])) && (isset($_GET['block']))){

$id=safe_input($_GET['id']);
$block=safe_input($_GET['block']);

	if ($block== 0){
		$block = 1;
		}
		else{
		$block = 0;
		}
	$rsblock = $mysqli->query("UPDATE `job_admin` SET `block_admin` = '$block'  WHERE admin_id= '$id'" ); 
	
	if(!($rsblock)){
	$_SESSION["msg"] = "msg_false";
	header("Location: mange.php"); 
	} 
	else{
	if ($block== 1){
	$_SESSION["msg"] = "block";
	header("Location:mange.php"); 
	}
	else{
	$_SESSION["msg"] = "unblock";
	header("Location: mange.php"); 
	}
	}	
}



?>
<!DOCTYPE html>
<html>
   
<head>
 <meta charset="UTF-8">
<title>
لوحة التحكم - الباحثين عن عمل
</title>
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
					<li >
						<a href="index.php" >لوحة التحكم</a>
					</li>
					<li>
						<a href="tables.php" >المحتوي</a>
					</li>
					<li>
						<a href="seekers.php" >المستخدمين</a>
					</li>
				
					<li  class="selected ">
						<a href="mange.php" >الأدارة</a>
					</li>
					<li>
						<a href="logout.php" title="تسجيل الخروج" >خروج</a>
					</li>
				</ul>
		</div>
	</div>

	<p/>
        <div id="container">
         
				     <div class="span3" >
                    <ul class="nav nav-list   ">
					<li><span class="menus "><strong>القائمة الرئيسية</strong></span>
							</li>
						<li class="active">
                            <a href="mange.php">الأدارة</a>

                    </ul>
                </div>
                <!--/span-->
<div class="span9" >
	<div class="item">
      <div>		
			
				 <h4>الأدارة</h4>
				
		</div>
<p class="plinee"></p>	


<?php
		if(!empty($msg)){
		switch ($msg) {
		case "deleted":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>قد تم حذف المستخدم بنجاح</p>";
		break;
		case "msg_false":
		echo "<p class='error'><img width='13' height='13' src='../images/invalid.png'/>حدث خطاء  أثناء التنفيذ</p>";
		break;
		case "block":
		echo "<p class='truee' ><img width='13' height='13' src='../images/tick.png'/>قد تم حظر المستخدم</p>";
		break;
		case "unblock":
		echo "<p class='truee' ><img width='13' height='13' src='../images/tick.png'/>قد تم إلغاء حظر المستخدم</p>";
		break;
		default:
		echo "<p class='error'>خطاء في التنفيذ الرجاء أعادة المحاولة مرة أخري</p>";
		}
		} 
		?>
<?php
$sql = $mysqli->query("SELECT * FROM job_admin ");
$recodes_count = $sql->num_rows;

$level_val =  array (
"1"=>"مدير","0"=>"مستخدم"
);
?>
<table width="680"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="6" >عدد النتائج : <?php echo $recodes_count ?></td>
</tr>	
 <tr  class="colortop">
    <td width="20" >رقم المدير</td>
    <td width="100"  >الأسم</td>
    <td width="100"  >البريد الالكتروني</td>
  <td width="100"  >الوصف</td>
	 <td width="20" colspan="2"  >التحكم</td>
<?php
$sql_result =  $mysqli->query("SELECT * FROM job_admin ") or die ('request "Could not execute SQL query" '.$sql);


?>

	 
  </tr>
 <?php  
 if (mysqli_num_rows($sql_result)>0) {
	while ($row = $sql_result->fetch_assoc()) {

	echo "<tr>";
	echo "<td>".$row["admin_id"]."</td>";
	echo '<td>'.$row['fname']." ".$row['lname'].'</td>';
	echo "<td>".$row['email']."</td>";
	echo "<td>".$level_val[$row["level"]]."</td>";

if($row["level"] == 0){
	echo "<td>";
		   
   echo '<a href="mange.php?id='.$row['admin_id'].'&block='.$row['block_admin'].'">';
	if($row['block_admin']==0){
	echo "حظر";
	}
	else{
	echo "إلغاء الحظر";
	}
	echo "</td>";
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="mange.php?delete_id='.$row['admin_id'].'" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";
}else{
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
}
	}
}
else {

	echo "<tr><td colspan='5'>لا توجد نتائج.</td>";

}
	echo "</table>";?>			
<br/>
<a rel='facebox' href='modal_add_user.php'  > +أضافة</a>
<br/>

	<br/>
</fieldset>		
</div>
</div>
</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/facebox.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : '../images/loading.gif',
      closeImage   : '../images/closelabel.png'
    })
  })
</script>