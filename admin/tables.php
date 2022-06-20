<?php 
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
error_reporting(0);



if((isset($_GET['delete_id']))&&(isset($_GET['tbl']))){//التأكد من وجود قيمة 
$tbl =$_GET['tbl'];
$delete_id= safe_input($_GET['delete_id']);
switch ($tbl) {
    case city:
        	$rsdelete = $mysqli->query("DELETE FROM `job_city` WHERE   city_id= '$delete_id'" ); 
        header("location: tables.php#city");
		break;
    case domain:
		$rsdelete = $mysqli->query("DELETE FROM `job_domain` WHERE   domain_id= '$delete_id'" ); 
		header("location: tables.php#domain");
        break;
    case edtype:
		$rsdelete = $mysqli->query("DELETE FROM `job_ed_type` WHERE   edt_id= '$delete_id'" ); 
		header("location: tables.php#edtype");
        break;
	case nat:
		$rsdelete = $mysqli->query("DELETE FROM `job_nat` WHERE   nat_id= '$delete_id'" ); 
		header("location: tables.php#nat");
        break;
	case lang:
		$rsdelete = $mysqli->query("DELETE FROM `job_lang` WHERE   lang_id= '$delete_id'" ); 
		header("location: tables.php#lang");
        break;
	case salary:
		$rsdelete = $mysqli->query("DELETE FROM `job_salary` WHERE   salary_id= '$delete_id'" ); 
		header("location: tables.php#salary");
        break;
	case type:
		$rsdelete = $mysqli->query("DELETE FROM `job_type` WHERE   type_id= '$delete_id'" ); 
		header("location: tables.php#type");
        break;
	case status:
		$rsdelete = $mysqli->query("DELETE FROM `job_status` WHERE   status_id= '$delete_id'" ); 
		header("location: tables.php#status");
        break;
	case comptype:
		$rsdelete = $mysqli->query("DELETE FROM `job_comp_type` WHERE   comp_type_id= '$delete_id'" ); 
		header("location: tables.php#comptype");
        break;
	case level:
		$rsdelete = $mysqli->query("DELETE FROM `job_level` WHERE   level_id= '$delete_id'" ); 
		header("location: tables.php#level");
        break;
	case explevel:
		$rsdelete = $mysqli->query("DELETE FROM `job_exp_type` WHERE   exp_type_id= '$delete_id'" ); 
		header("location: tables.php#explevel");
        break;
    default:
      
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
					<li>
						<a href="index.php" >لوحة التحكم</a>
					</li>
					<li  class="selected ">
						<a href="tables.php" >المحتوي</a>
					</li>
					<li>
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
						<li>
                            <a   href="tables.php#city">المدينة</a>
                        </li>
						<li>
                            <a   href="tables.php#domain">المجال</a>
                        </li>
							</li>
						<li>
                            <a   href="tables.php#edtype">المؤهل</a>
                        </li>
						<li>
                            <a   href="tables.php#nat">الجنسية</a>
                        </li>
							</li>
						<li>
                            <a href="tables.php#lang">اللغة</a>
                        </li>
						<li>
                            <a   href="tables.php#type">نوع الوظيفة</a>
                        </li>
						<li>
                            <a   href="tables.php#status">حالة الوظيفة</a>
                        </li>
						<li>
                            <a   href="tables.php#comptype">قطاع الشركة</a>
                        </li>
						<li>
                            <a   href="tables.php#level">المستوي</a>
                        </li>
						<li>
                            <a   href="tables.php#explevel">نوع الخبرة</a>
                        </li>					
                    </ul>
                </div>
                <!--/span-->
<div class="span9" >
	<div class="item">

   <div>		
			
			 <h4>المحتوي</h4>
				
		</div>


<fieldset class="grouppost">
	<legend><a name="city"></a>المدينة</legend>
	<br/>

<?php
$sql = "SELECT * FROM  job_city order by city_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
 <tr  class="colortop">
		<td width="20" >رقم المدينة</td>
		<td width="100"  >أسم المدينة</td>
		<td width="60" colspan="2"  >التحكم</td>
 </tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->city_id."</td>";
	echo '<td>'.$row->city_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_city.php?id='.$row->city_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->city_id.'&tbl=city"  ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_city.php'  > +أضافة</a>
	<br/>
</fieldset>
	<br/>
		<br/>
<fieldset class="grouppost">
	<legend><a name="domain"></a>المجال</legend>
	<br/>
<?php
$sql = "SELECT * FROM  job_domain order by domain_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
 <tr  class="colortop">
		<td width="20" >رقم المجال</td>
		<td width="100"  >أسم المجال</td>
		<td width="60" colspan="2"  >التحكم</td>
 </tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->domain_id."</td>";
	echo '<td>'.$row->domain_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_domain.php?id='.$row->domain_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->domain_id.'&tbl=domain" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_domain.php'  > +أضافة</a>
	<br/>
</fieldset>	
<br/>
<br/>
<fieldset class="grouppost">
	<legend><a name="edtype"></a>المؤهل</legend>
	<br/>

<?php
$sql = "SELECT * FROM  job_ed_type order by edt_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
 <tr  class="colortop">
		<td width="20" >رقم المؤهل</td>
		<td width="100"  >أسم المؤهل</td>
		<td width="60" colspan="2"  >التحكم</td>
 </tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->edt_id."</td>";
	echo '<td>'.$row->edt_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_ed.php?id='.$row->edt_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->edt_id.'&tbl=edtype"  ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_ed.php'  > +أضافة</a>
	<br/>
</fieldset>
<br/>
<br/>
<fieldset class="grouppost">
	<legend><a name="nat"></a>الجنسية</legend>
	<br/>

<?php
$sql = "SELECT * FROM  job_nat order by nat_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
 <tr  class="colortop">
		<td width="20" >رقم الجنسية</td>
		<td width="100"  >أسم الجنسية</td>
		<td width="60" colspan="2"  >التحكم</td>
 </tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->nat_id."</td>";
	echo '<td>'.$row->nat_name.'</td>';
	echo "<td>";
	if($row->nat_id!=1){
	echo '<a rel="facebox" href="modal_edit_nat.php?id='.$row->nat_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	}
	echo "</td>"; 
	echo "<td>";
	if($row->nat_id!=1){
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->nat_id.'&tbl=nat"  ><img src="../images/remove.png"/> حذف</a>';
	}
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_nat.php'  > +أضافة</a>
	<br/>
</fieldset>
<br/>
<br/>
<fieldset class="grouppost">
	<legend><a name="lang"></a>اللغة</legend>
	<br/>
<?php
$sql = "SELECT * FROM  job_lang order by lang_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
    <td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
 <tr  class="colortop">
		<td width="20" >رقم اللغة</td>
		<td width="100"  >أسم اللغة</td>
		<td width="60" colspan="2"  >التحكم</td>
 </tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->lang_id."</td>";
	echo '<td>'.$row->lang_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_lang.php?id='.$row->lang_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->lang_id.'&tbl=lang" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_lang.php'  > +أضافة</a>
	<br/>
</fieldset>		
<br/>
<br/>
<fieldset class="grouppost">
	<legend><a name="salary"></a>المرتب</legend>
	<br/>
<?php
$sql = "SELECT * FROM  job_salary order by salary_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
	<td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
<tr  class="colortop">
	<td width="20" >رقم المرتب</td>
	<td width="100"  > المرتب</td>
	<td width="60" colspan="2"  >التحكم</td>
</tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->salary_id."</td>";
	echo '<td>'.$row->salary_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_salary.php?id='.$row->salary_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->salary_id.'&tbl=salary" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_salary.php'  > +أضافة</a>
<br/>
</fieldset>		
<br/>
<br/>
<fieldset class="grouppost">
<legend><a name="type"></a>نوع الوظيفة</legend>
<br/>
<?php
$sql = "SELECT * FROM  job_type order by type_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
	<td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
<tr  class="colortop">
	<td width="20" >رقم نوع الوظيفة</td>
	<td width="100"  > نوع الوظيفة</td>
	<td width="60" colspan="2"  >التحكم</td>
</tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->type_id."</td>";
	echo '<td>'.$row->type_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_type.php?id='.$row->type_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->type_id.'&tbl=type" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_type.php'  > +أضافة</a>
	<br/>
</fieldset>	
<br/>
<br/>
<fieldset class="grouppost">
<legend><a name="status"></a>حالة الوظيفة</legend>
<br/>
<?php
$sql = "SELECT * FROM  job_status order by status_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
	<td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
<tr  class="colortop">
	<td width="20" >رقم حالة الوظيفة</td>
	<td width="100"  > حالة الوظيفة</td>
	<td width="60" colspan="2"  >التحكم</td>
</tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->status_id."</td>";
	echo '<td>'.$row->status_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_status.php?id='.$row->status_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->status_id.'&tbl=status" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_status.php'  > +أضافة</a>
	<br/>
</fieldset>	
	
<br/>
<br/>
<fieldset class="grouppost">
<legend><a name="comptype"></a>قطاع الشركة</legend>
<br/>
<?php
$sql = "SELECT * FROM  job_comp_type order by comp_type_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
	<td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
<tr  class="colortop">
	<td width="20" >رقم قطاع الشركة</td>
	<td width="100"  > قطاع الشركة</td>
	<td width="60" colspan="2"  >التحكم</td>
</tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->comp_type_id."</td>";
	echo '<td>'.$row->comp_type_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_comptype.php?id='.$row->comp_type_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->comp_type_id.'&tbl=comptype" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_comptype.php'  > +أضافة</a>
	<br/>
</fieldset>	
	
<br/>
<br/>
<fieldset class="grouppost">
<legend><a name="level"></a>المستوي</legend>
<br/>
<?php
$sql = "SELECT * FROM  job_level order by level_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
	<td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
<tr  class="colortop">
	<td width="20" >رقم المستوي</td>
	<td width="100"  >المستوي</td>
	<td width="60" colspan="2"  >التحكم</td>
</tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->level_id."</td>";
	echo '<td>'.$row->level_name.'</td>';
	echo "<td>";
	echo '<a rel="facebox" href="modal_edit_level.php?id='.$row->level_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	echo "</td>"; 
	echo "<td>";
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->level_id.'&tbl=level" ><img src="../images/remove.png"/> حذف</a>';
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_level.php'  > +أضافة</a>
	<br/>
</fieldset>		
<br/>
<br/>
<fieldset class="grouppost">
<legend><a name="explevel"></a>نوع الخبرة</legend>
<br/>
<?php
$sql = "SELECT * FROM  job_exp_type order by exp_type_id ASC ";

$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows>0) {

?>
<table width="300"  class="tblm table-bordered"  >
<tr  class="colortop">
	<td width="20" colspan="9" >عدد النتائج : <?php echo $sql_result->num_rows ?></td>
</tr>	
<tr  class="colortop">
	<td width="20" >رقم نوع الخبرة</td>
	<td width="100"  >نوع الخبرة</td>
	<td width="60" colspan="2"  >التحكم</td>
</tr>
 <?php  
 while ($row = $sql_result->fetch_object()) {
	echo "<tr>";
	echo "<td>".$row->exp_type_id."</td>";
	echo '<td>'.$row->exp_type_name.'</td>';
	echo "<td>";
	if($row->exp_type_id!=1){
	echo '<a rel="facebox" href="modal_edit_explevel.php?id='.$row->exp_type_id.'" ><img src="../images/edit.png"/> تعديل</a>';
	}
	echo "</td>"; 
	echo "<td>";
	if($row->exp_type_id!=1){
	echo '<a onclick="return confirm(\'هل أنت متأكد من الحذف ?\')"   href="'.$_SERVER['PHP_SELF'].'?delete_id='.$row->exp_type_id.'&tbl=explevel" ><img src="../images/remove.png"/> حذف</a>';
	}
	echo "</td>";   
	echo "</tr>";

	}
}
else {

	echo "<tr><td colspan='4'>لا توجد نتائج.</td>";

}
	$sql_result->free_result();
	echo "</table>";

?>
<br/>

<a rel='facebox' href='modal_add_explevel.php'  > +أضافة</a>
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
</body>

</html>