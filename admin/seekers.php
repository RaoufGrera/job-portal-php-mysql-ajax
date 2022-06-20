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
	$rsdelete = $mysqli->query("DELETE FROM `job_seeker` WHERE   user_id= '$delete_id'" ); 
	
	if(!($rsdelete)){
	$_SESSION["msg"] = "msg_false";
	header("Location: seekers.php"); 
	} 
	else{
	$_SESSION["msg"] = "deleted";
	header("Location: seekers.php"); 
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
	$rsblock = $mysqli->query("UPDATE `job_seeker` SET `block_admin` = '$block'  WHERE user_id= '$id'" ); 
	
	if(!($rsblock)){
	$_SESSION["msg"] = "msg_false";
	header("Location: seekers.php"); 
	} 
	else{
	if ($block== 1){
	$_SESSION["msg"] = "block";
	header("Location:seekers.php"); 
	}
	else{
	$_SESSION["msg"] = "unblock";
	header("Location: seekers.php"); 
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
                            <a href="seekers.php"> الباحثين عن العمل</a>
                        </li>
                        <li > <a href="companys.php"></i>الشركات</a> </li>
					
				

						
			
					
                    </ul>
                </div>
                <!--/span-->
<div class="span9" >
	<div class="item">
      <div>		
			
				 <h4>السير الذايتة</h4>
				
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


	
<form id="form1" name="form1" method="GET" action="seekers.php">
<div class='search'>
<label>الأسم</label>
<input type="text" name="string" id="string" placeholder="الأسم ، اللقب ، رقم الباحث ..." value="<?php if(!empty($_GET['string'])){echo $_GET["string"];} ?>" />

&nbsp;<label>المدينة</label>
<select name="city_name">
<option value="">الكل</option>

<?php

	$sql_resultt = $mysqli->query ( "SELECT city_name FROM job_city " );
	while ($row = mysqli_fetch_assoc($sql_resultt)) {
		        ?>  
            <option value = "<?php echo $row['city_name']; ?>" 
            <?php
                if(!empty($_GET['city_name'])){
				if($_GET['city_name']==$row['city_name']){
				echo " selected ";}
				}
			
            ?> >
            <?php echo $row['city_name']; ?> 
            </option>
     <?php }  ?>  
	 
   </select>
   


   &nbsp; &nbsp;<input type="submit"  class="btn btn-info" id="button" value="بحث" />
  </label>
  <a href="seekers.php"> 
  إعادة</a>
  <div>
</form>
<br /><br />


<?php


if (!empty($_GET["string"])) {
	$search_string = " and (lname LIKE '%".mysql_real_escape_string($_GET["string"])."%' OR fname LIKE '%".mysql_real_escape_string($_GET["string"])."%' OR user_id LIKE '%".mysql_real_escape_string($_GET["string"])."%')";	

	}


if (!empty($_GET["city_name"])) {
	$search_city = " and job_city.city_name ='" .mysql_real_escape_string($_GET["city_name"])."'" ;
}






	

if(!isset($_GET['page']))
	$page=1;
	else
	$page=(int) $_GET['page'];

$records_at_page = 20;
$sql_result_row = "SELECT * from job_seeker,job_city where job_city.city_id = job_seeker.city_id  ";
$sql_result_row.=$search_string ;
$sql_result_row.=$search_city ;

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
$hide_val =  array (
"1"=>"مخفية","0"=>"غير مخفية"
);

$sql = "SELECT * from job_seeker,job_city where job_city.city_id = job_seeker.city_id ";
$sql.=$search_string ;
$sql.=$search_city ;
$sql.= " order by date_register DESC ";
$sql.= " LIMIT $start ,$end ";
?>
<table width="680"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $recodes_count ?></td>
</tr>	
 <tr  class="colortop">
    <td width="20" >رقم الباحث</td>
    <td width="100"  >الأسم</td>
    <td width="100"  >البريد الالكتروني</td>
    <td width="40" >الحالة </td>
	<td width="40" >السيرة </td>
     <td width="60"   >تاريخ التسجيل</td>
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
	echo "<td>".$row["user_id"]."</td>";
	echo '<td><a  href="../view/cvs.php?id='.$row['user_id'].'">'.$row['fname']." ".$row['lname'].'</a></td>';
	echo "<td>".$row['email']."</td>";
	echo "<td>".$ed_val[$row["is_active"]]."</td>";
	echo "<td>".$hide_val[$row["hide_cv"]]."</td>";
	echo "<td>".$row["date_register"]."</td>"; 
	echo "<td>";
		   
   echo '<a href="seekers.php?id='.$row['user_id'].'&block='.$row['block_admin'].'">';
	if($row['block_admin']==0){
	echo "حظر";
	}
	else{
	echo "إلغاء الحظر";
	}
	echo "</td>";
	echo "<td>";

	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="seekers.php?delete_id='.$row['user_id'].'" ><img src="../images/remove.png"/> حذف</a>';
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
if((!empty($_GET['city_name'])) || (!empty($_GET['string'])) ){
echo '<a href ="seekers.php?page=' .$i.'&string='.$_GET['string'].'&city_name='.$_GET['city_name'].'">'.$i.'</a>';
}else{

echo '<a href ="seekers.php?page=' .$i.'">'.$i.'</a>';
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