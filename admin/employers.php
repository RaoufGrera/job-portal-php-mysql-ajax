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
	$rsdelete = $mysqli->query("DELETE FROM `job_employer` WHERE   emp_id= '$delete_id'" ); 
	
	if(!($rsdelete)){
	$_SESSION["msg"] = "msg_false";
	header("Location: employers.php"); 
	} 
	else{
	$_SESSION["msg"] = "deleted";
	header("Location: employers.php"); 
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
	$rsblock = $mysqli->query("UPDATE `job_employer` SET `block_admin` = '$block'  WHERE emp_id= '$id'" ); 
	
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
} 

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
<li class="se" ><a href="employers.php">الموظفين</a></li>
<li ><a href="jobs.php">الوظائف</a></li>
</ul>	
   <div>		
			
				 <h4>الشركات</h4>
				
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


	
<form id="form1" name="form1" method="GET" action="employers.php">
<div class='search'>
<label>الأسم</label>
<input type="text" name="string" id="string" placeholder="اسم الشركة ، رقم الشركة ..." value="<?php if(!empty($_GET['string'])){echo $_GET["string"];} ?>" />

   &nbsp; &nbsp;<input type="submit"  class="btn btn-info" id="button" value="بحث" />
  </label>
  <a href="employers.php"> 
  إعادة</a>
  <div>
</form>
<br /><br />


<?php


if (!empty($_GET["string"])) {
	$search_string = " WHERE (comp_name LIKE '%".mysql_real_escape_string($_GET["string"])."%'  OR job_employer.emp_id LIKE '%".mysql_real_escape_string($_GET["string"])."%')";	

	}



	

if(!isset($_GET['page']))
	$page=1;
	else
	$page=(int) $_GET['page'];

$records_at_page = 20;
$sql_result_row = "SELECT count(job_description.emp_id) as countdesc,job_company.comp_id,job_employer.block_admin,email,job_employer.emp_id,comp_name,fname,lname,job_employer.emp_id,date_register
				FROM job_employer
				LEFT JOIN job_description ON job_description.emp_id = job_employer.emp_id
				LEFT JOIN job_company ON job_employer.comp_id = job_company.comp_id
				 ";
				
$sql_result_row.=$search_string ;
$sql_result_row.=$search_city ;
$sql_result_row.= " group by job_employer.emp_id ";

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

$sql = "SELECT count(job_description.emp_id) as countdesc,job_company.comp_id,job_employer.block_admin,email,job_employer.emp_id,comp_name,fname,lname,job_employer.emp_id,date_register
				FROM job_employer
				LEFT JOIN job_description ON job_description.emp_id = job_employer.emp_id
				LEFT JOIN job_company ON job_employer.comp_id = job_company.comp_id
				
				";
$sql.=$search_string ;
$sql.=$search_city ;
$sql.=" group by job_employer.emp_id " ;
$sql.= " order by date_register DESC "; 
$sql.= " LIMIT $start ,$end ";

?>
<table width="680"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $recodes_count ?></td>
</tr>	
 <tr  class="colortop">
    <td width="20" >رقم الموظف</td>
    <td width="100"  >الأسم</td>
    <td width="100"  >البريد الالكتروني</td>
    <td width="40" >عدد الأعلانات </td>
<td width="40" >الشركة </td>
<td width="40" >تاريخ الأضافة </td>
	 <td width="20" colspan="2"  >التحكم</td><?php
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
	echo "<td>".$row["emp_id"]."</td>";
	echo '<td>'.$row['fname']." ".$row['lname'].'</td>';
	echo "<td>".$row['email']."</td>";
	echo '<td><a  href="jobs.php?string='.$row['emp_id'].'">'.$row['countdesc'].'</td>';
	echo '<td><a  href="companys.php?string='.$row['comp_id'].'">'.$row['comp_name'].'</a></td>';
	echo "<td>".$row['date_register']."</td>";
	echo "<td>";
		   
   echo '<a href="employers.php?id='.$row['emp_id'].'&block='.$row['block_admin'].'">';
	if($row['block_admin']==0){
	echo "حظر";
	}
	else{
	echo "إلغاء الحظر";
	}
	echo "</td>";
	echo "<td>";

	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="employers.php?delete_id='.$row['emp_id'].'" ><img src="../images/remove.png"/> حذف</a>';
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
echo '<a href ="employers.php?page=' .$i.'&string='.$_GET['string'].'">'.$i.'</a>';
}else{

echo '<a href ="employers.php?page=' .$i.'">'.$i.'</a>';
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