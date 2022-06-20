<?php 
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
if($txt_type=='employer'){
die('دخول غير مسموح');
}
if(!empty($_SESSION["msg"])){
$msg=$_SESSION["msg"];
unset($_SESSION['msg']);
}
if(!empty($_GET['delete_id'])){//التأكد من وجود قيمة 
$delete_id= safe_input($_GET['delete_id']);
	// التحقق من أن الموظف الذي سيتم حذفه يعمل لدي هذه الشركة
	
	$rsdelete = $mysqli->query("DELETE FROM `job_employer` WHERE   emp_id= '$delete_id'" ); 
	
	if(!($rsdelete)){
	$_SESSION["msg"] = "msg_false";
	header("Location: controluser.php"); 
	} 
	else{
	$_SESSION["msg"] = "deleted";
	header("Location: controluser.php"); 
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
	$rsblock = $mysqli->query("UPDATE `job_employer` SET `block` = '$block'  WHERE emp_id= '$id'" ); 
	
	if(!($rsblock)){
	$_SESSION["msg"] = "msg_false";
	header("Location: controluser.php"); 
	} 
	else{
	if ($block== 1){
	$_SESSION["msg"] = "block";
	header("Location:controluser.php"); 
	}
	else{
	$_SESSION["msg"] = "unblock";
	header("Location: controluser.php"); 
	}
	}	
}

?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
<head>

<title>
أدارة المستخدمين
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
						<a href="../view/searchjob.php" >الوظائف</a>
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
							
							<li> <a href="empprofile.php">بيانات الحساب</a> 
							</li>
							
							
							<li><a href='compprofile.php'>بيانات الشركة</a></li>
							
							<li class="active"><a href='controluser.php'>إدارة الموظفين</a></li>
							
					
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
			
						
                        $rs=$mysqli->query("SELECT comp_name, job_company.comp_id, email, domain_name, emp_id, city_name, address, phone, fname, lname, start_comp, size_comp
												FROM job_city, job_employer, job_company, job_domain
												WHERE job_domain.domain_id = job_company.domain_id
												AND job_employer.comp_id = job_company.comp_id
												AND job_city.city_id = job_company.city_id
												AND job_employer.emp_id='$txt_user_id'
												AND level = '1'")or die(mysql_error());
                        $row=$rs->fetch_array();
							$comp_id =	$row['comp_id'];
                        echo $row['comp_name'] ;

                    ?>
					
				</h4>
				
			<p class="plinee"></p>

	  <div >		
	 <h4>المستخدمين</h4>
	</div>
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

		<table class="tblm table-bordered"  width="700"  >
		 
		  <col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 70px;">
<col style="width: 70px;">
		 <th>أسم المستخدم</th>
		  <th>عدد الوظائف</th>
		   <th>عدد مرات الدخول</th>
		  <th>تاريخ اخر دخول</th>
		   <th>الأشتراك</th>
	
		  <th colspan="2" >التحكم</th>
		
                                 <tbody>
								
				<?php 
				$type_active =array('3'=>"غير مفعل",'2'=>"مفعل");
				$user_query=$mysqli->query("SELECT job_employer.emp_id, block, fname, lname, last_seen, count_in, comp_id, count( desc_id ) as countdesc, job_employer.is_active
												FROM job_employer
												LEFT JOIN job_description ON job_employer.emp_id = job_description.emp_id
												WHERE job_employer.comp_id = '$comp_id'
												AND job_employer.emp_id NOT
												IN ( '$txt_user_id' )
												GROUP BY job_employer.emp_id")or die($mysql->error());
				$resultcount = mysqli_num_rows($user_query);
				while($row=mysqli_fetch_array($user_query)){
				$block= $row['block']; $id = $row['emp_id'];		
				echo "<tr>";
				echo "<td>";
				echo $row['fname']." ".$row['lname']; 
				echo "</td>"; 
				echo "<td>". $row['countdesc']."</td>";
				echo "<td>".$row['count_in']."</td>";
				echo "<td>".$row['last_seen']."</td>";
				echo "<td>".$type_active[$row['is_active']]."</td>";
				echo "<td>";
			   echo '<a  href="controluser.php?id='.$id.'&block='.$row['block'].'">';
				if($row['block']==0){
				echo "حظر";
				}
				else{
				echo "إلغاء الحظر";
				}
				echo "</a>";
				echo "</td>";
				echo "<td>";
				echo '<a href="controluser.php?delete_id='.$id.'">حذف</a>';
				echo"</td>";
				echo "</tr>";
			  } 
			  ?>
                          
          </tbody>
		</table>
		<br/>
	  	<?php if ($resultcount <=20){echo "<a   class='btn btn-info facebox' href='modal_add_user.php?id=$comp_id ' > +أضافة</a> ";}else {echo "<span class='t'>وصلت للعدد الأعلي من الموظفين</span>"; }?>
			

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