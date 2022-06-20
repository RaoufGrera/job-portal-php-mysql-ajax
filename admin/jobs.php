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
	$rsdelete = $mysqli->query("DELETE FROM `job_description` WHERE   desc_id= '$delete_id'" ); 
	
	if(!($rsdelete)){
	$_SESSION["msg"] = "msg_false";
	header("Location: jobs.php"); 
	} 
	else{
	$_SESSION["msg"] = "deleted";
	header("Location: jobs.php"); 
	}	
	}

/* if((!empty($_GET['id'])) && (isset($_GET['block']))){

$id=safe_input($_GET['id']);
$block=safe_input($_GET['block']);

	if ($block== 0){
		$block = 1;
		}
		else{
		$block = 0;
		}
	$rsblock = $mysqli->query("UPDATE `job_company` SET `block_admin` = '$block'  WHERE comp_id= '$id'" ); 
	
	if(!($rsblock)){
	$_SESSION["msg"] = "msg_false";
	header("Location: employers.php"); 
	} 
	else{
	if ($block== 1){
	$_SESSION["msg"] = "block";
	header("Location: employers.php"); 
	}
	else{
	$_SESSION["msg"] = "unblock";
	header("Location: employers.php"); 
	}
	}	
} */

$search_string=$search_city='';

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
					<li class="selected ">
						<a href="seekers.php" >المستخدمين</a>
					</li>
				
					<li>
						<a href="index.php" >الأدارة</a>
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
						<li >
                            <a href="seekers.php"> الباحثين عن العمل</a>
                        </li>
                        <li class="active"> <a href="companys.php"></i>الشركات</a> </li>
					
				

						
			
					
                    </ul>
                </div>
                <!--/span-->
<div class="span9" >
	<div class="item">
   
<ul id="tabnav">
<li ><a href="companys.php">الشركات</a></li>
<li><a href="employers.php">الموظفين</a></li>
<li  class="se" ><a href="jobs.php">الوظائف</a></li>
</ul>	
   <div>		
			
				 <h4>الشركات</h4>
				
		</div>
	
			
		<?php
		if(!empty($msg)){
		switch ($msg) {
		case "deleted":
		echo "<p class='truee'><img width='13' height='13' src='../images/tick.png'/>قد تم حذف الوظيفة بنجاح</p>";
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


	
<form id="form1" name="form1" method="GET" action="jobs.php">
<div class='search'>
<label>الأسم</label>
<input type="text" name="string" id="string" placeholder="اسم الوظيفة , رقم الوظيفة , اسم المعلن" value="<?php if(!empty($_GET['string'])){echo $_GET["string"];} ?>" />

   &nbsp; &nbsp;<input type="submit"  class="btn btn-info" id="button" value="بحث" />
  </label>
  <a href="jobs.php"> 
  إعادة</a>
  <div>
</form>
<br /><br />


<?php


if (!empty($_GET["string"])) {
	$search_string = " WHERE ( job_employer.emp_id = '".safe_input($_GET["string"])."'   OR job_name LIKE '".safe_input($_GET["string"])."'OR job_description.desc_id = '".mysql_real_escape_string($_GET["string"])."' )";	

	}



	

if(!isset($_GET['page']))
	$page=1;
	else
	$page=(int) $_GET['page'];

$records_at_page = 20;
$sql_result_row = "SELECT job_company.comp_id,email,job_employer.emp_id,comp_name,fname,lname,job_employer.emp_id,job_name,job_description.is_active
				FROM job_description
				LEFT JOIN job_employer ON job_description.emp_id = job_employer.emp_id
				LEFT JOIN job_company ON job_employer.comp_id = job_company.comp_id           
		
				
				";
				
$sql_result_row.=$search_string ;

$sql_result_row.= " group by job_description.desc_id " ;

$sqll_result =  $mysqli->query($sql_result_row) or die ('request "Could not execute SQL query" '.$sql_result_row);
$recodes_count = mysqli_num_rows($sqll_result);
$page_count = (int) ceil($recodes_count / $records_at_page );
if($recodes_count <> 0){
if(($page > $page_count) || ($page <= 0)){
die('noooo moore');
}}
$start= ($page -1) * $records_at_page;
$end = $records_at_page;


	$ed_val =  array (
						"0"=>"مفعل","1"=>"غير مفعل"
						);

$sql = "SELECT job_end,job_company.comp_id,email,comp_name,fname,lname,job_employer.emp_id,job_name,desc_id,job_description.is_active
				FROM job_description
				LEFT JOIN job_employer ON job_description.emp_id = job_employer.emp_id
				LEFT JOIN job_company ON job_employer.comp_id = job_company.comp_id           
				

				";
$sql.=$search_string ;

$sql.=" group by job_description.desc_id " ;
/* $sql.= " order by date_register DESC "; */
$sql.= " LIMIT $start ,$end ";

?>
<table width="680"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $recodes_count ?></td>
</tr>	
 <tr  class="colortop">
    <td width="20" >رقم الأعلان</td>
    <td width="100"  >أسم الوظيفة</td>
    <td width="100"  >اسم المعلن</td>
<td width="40" >الحالة </td>
<td width="40" >الشركة </td>
	 <td width="20" colspan="1"  >التحكم</td><?php
$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if (mysqli_num_rows($sql_result)>0) {
	while ($row = $sql_result->fetch_assoc()) {

	/* $row['sum_exp'] =ceil($row['sum_exp']/12);
	$datereg=date("Y"); $age =  $datereg - $row["birth_day"];
	 */
?>

	 
  </tr>
 <?php  
 
	echo "<tr>";
	echo "<td>".$row["desc_id"]."</td>";

	echo '<td><a  href="../view/job.php?id='.$row['desc_id'].'">'.$row['job_name'].'</td>';
	echo '<td><a  href="employers.php?string='.$row['emp_id'].'">'.$row['fname']." ".$row['lname'].'</td>';
	if(($row['is_active'] == 0) && ($row['job_end'] >=date('Y-m-d'))){
	echo '<td>مفعله</td>';
	}else{
	echo '<td>غير مفعله</td>';
	}
	
	echo '<td><a  href="companys.php?string='.$row['comp_id'].'">'.$row['comp_name'].'</a></td>';


	echo "<td>";

	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="jobs.php?delete_id='.$row['desc_id'].'" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='5'>لا توجد نتائج.</td>";

}
	echo "</table>";

for($i=1;$i <= $page_count ;$i++){
if($page == $i)
echo $page;
else
if(!empty($_GET['string']) ){
echo '<a href ="jobs.php?page=' .$i.'&string='.$_GET['string'].'">'.$i.'</a>';
}else{

echo '<a href ="jobs.php?page=' .$i.'">'.$i.'</a>';
}

if($i != $page_count)
echo ' - ';
}



?>







                     </div>
                </div>
        </div>
 </div>
  </div>
   </div>
    </div>

    </body>

</html>