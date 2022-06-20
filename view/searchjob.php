<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

 error_reporting(0); 


		
		
		$get_city="";
		$search_nat=$search_salary=$search_time=$search_desc=$search_domain=$search_gender=$search_agemin=$search_agemax=$search_expmin=$search_expmax= $search_city=$search_string=$search_company=$search_health_status=$search_ed=$field=$sort=$get_herf_page=$search_salary="";
		$search_exp=$search_type=$search_status='';
		$herf_nat=$herf_string=$herf_comp=$herf_city=$herf_domain=$herf_health=$herf_ed=$herf_status=$herf_type='';
		
		$herf_exp=$herf_field = $herf_sort=$herf_gender=$herf_agemin=$herf_agemax=$herf_expmin=$herf_expmax=$herf_salary=$herf_time='';


				
				
if ((!empty($_GET["string"]))) {
	$search_string = " AND (job_name LIKE '%".safe_input($_GET["string"])."%' OR desc_id LIKE '%".safe_input($_GET["string"])."%')";	
$herf_string  =$_GET["string"];
	}

if (!empty($_GET["exp_type"])) {
	$search_exp = " AND job_exp_type.exp_type_name ='" .safe_input($_GET["exp_type"])."'";	
	$herf_exp  =$_GET["exp_type"];
}

if (!empty($_GET["nat"])) {
	$search_nat = " AND (job_nat.nat_name ='" .safe_input($_GET["nat"])."' OR job_nat.nat_id = 1 )"  ;	
	$herf_nat  =$_GET["nat"];
}

if (!empty($_GET["domain_name"])) {
	$search_domain = " and job_domain.domain_name ='" .safe_input($_GET["domain_name"])."'" ;	
	$herf_domain  =$_GET["domain_name"];
}

if (!empty($_GET["gender"])) {
	$search_gender = " and job_description.job_gender ='" .safe_input($_GET["gender"])."'" ;	
	$herf_gender =$_GET["gender"];
}

if (!empty($_GET["status_name"])) {
	$herf_status =safe_input($_GET["status_name"]);
	$search_status = " and job_status.status_name ='" .safe_input($_GET["status_name"])."'" ;	
}
if (!empty($_GET["type_name"])) {
$herf_type =$_GET["type_name"];
	$search_type = " and job_type.type_name ='" .safe_input($_GET["type_name"])."'" ;	
}
if (!empty($_GET["agemin"])) {
	$search_agemin = " and job_description.age_min >='" .safe_input($_GET["agemin"])."'" ;	
	$herf_agemin =$_GET["agemin"];
					
					
						
}

if (!empty($_GET["agemax"])) {
	$search_agemax = " and job_description.age_max <='" .safe_input($_GET["agemax"])."'" ;	
		$herf_agemax=$_GET["agemax"];
}

if (!empty($_GET["expmin"])) {
	$search_expmin = " and job_description.exp_min >='" .safe_input($_GET["expmin"])."'" ;	
		$herf_expmin =$_GET["expmin"];
}
if (!empty($_GET["expmax"])) {
	$search_expmax = " and job_description.exp_max <='" .safe_input($_GET["expmax"])."'" ;	
	$herf_expmax =$_GET["expmax"];
}
if (!empty($_GET["salary_name"])) {
	$search_salary = " and job_salary.salary_name ='" .safe_input($_GET["salary_name"])."'" ;	
	
						$herf_salary =$_GET["salary_name"];
						
					
}
if (!empty($_GET["time"])) {
	$herf_time =safe_input($_GET["time"]);
	$selecttime = safe_input($_GET["time"]);
	switch ($selecttime){
	case "today":
	$search_time = " and job_description.job_start = CURDATE() ";
	break;
	case "towday":
	$search_time = " and job_description.job_start >= DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND job_start <= CURDATE() ";	
	break;
	case "week":
	$search_time = " and job_description.job_start >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND job_start <= CURDATE() ";	
	break;
	case "week3":
	$search_time = " and job_description.job_start >= DATE_SUB(CURDATE(), INTERVAL 21 DAY) AND job_start <= CURDATE() ";	
	break;
	}

	
	
	
}


if (!empty($_GET["city_name"])) {
	$search_city = " and job_city.city_name ='".safe_input($_GET["city_name"])."'" ;
	$herf_city  =$_GET["city_name"];
}

if (!empty($_GET["comp_name"])) {
	$search_company = " AND comp_active = 0 and job_company.comp_name ='".safe_input($_GET["comp_name"])."'" ;
	$herf_comp  =$_GET["comp_name"];
}
if (!empty($_GET["health_status"])) {
	$search_health_status = " and job_description.health_status ='" .safe_input($_GET["health_status"])."'" ;
	$herf_health  =$_GET["health_status"];
}	
if (!empty($_GET["name_ed"])) {
	$search_ed = " and job_ed_type.edt_name ='" .safe_input($_GET["name_ed"])."'" ;
	$herf_ed =$_GET["name_ed"];
}

if ((!empty($_GET["field"])) && (!empty($_GET["sort"]))) {
	$field = " ORDER BY  " .safe_input($_GET["field"]);
	$sort = safe_input($_GET["sort"]);
	$herf_field =$_GET["field"];
	$herf_sort =$_GET["sort"];
}
else{
	$field = " ORDER BY  job_start ";
	$sort = " DESC ";
}
					
function get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort){
			$herf_result = "string=".$herf_string;
			$herf_result.= "&amp;type_name=".$herf_type;
			$herf_result.= "&amp;status_name=".$herf_status;
			$herf_result.= "&amp;agemin=".$herf_agemin;
			$herf_result.= "&amp;agemax=".$herf_agemax;
			$herf_result.= "&amp;expmin=".$herf_expmin;
			$herf_result.= "&amp;expmax=".$herf_expmax;
			$herf_result.= "&amp;health_status=".$herf_health;
			$herf_result.= "&amp;gender=".$herf_gender;

			$herf_result.= "&amp;nat=".$herf_nat;	
			$herf_result.= "&amp;city_name=".$herf_city;
			$herf_result.= "&amp;domain_name=".$herf_domain;
			$herf_result.= "&amp;comp_name=".$herf_comp;
			$herf_result.= "&amp;name_ed=".$herf_ed;
			$herf_result.= "&amp;exp_type=".$herf_exp;
			$herf_result.= "&amp;salary_name=".$herf_salary;
			$herf_result.= "&amp;time=".$herf_time;
			$herf_result.= "&amp;field=".$herf_field;
			$herf_result.= "&amp;sort=".$herf_sort;

			return $herf_result;
}
					
function get_result_sql($select_string,$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed,$group_by,$field,$sort,$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp){
			$sql_result_row = "SELECT ";
			$sql_result_row.= $select_string;
			$sql_result_row.= " FROM job_description, job_domain, job_employer, job_company,job_city,job_type,job_status,job_ed_type ,job_nat,job_salary,job_exp_type
			WHERE job_employer.emp_id = job_description.emp_id 
			AND job_city.city_id = job_description.city_id
			AND job_employer.comp_id = job_company.comp_id
			AND job_description.domain_id = job_domain.domain_id 
			AND job_description.type_id = job_type.type_id
			AND job_description.status_id = job_status.status_id
			AND job_ed_type.edt_id =  job_description.edt_id
			AND job_exp_type.exp_type_id =  job_description.exp_level
			AND job_nat.nat_id = job_description.nat_id 
			AND job_salary.salary_id = job_description.salary_id
			AND job_description.job_start <= CURDATE() 
			AND job_description.job_end >= CURDATE() 
			AND job_description.is_active = 0 
			AND job_company.block_admin = 0 ";
			$sql_result_row.= $search_domain;
			$sql_result_row.= $search_city;
			$sql_result_row.= $search_company;
			$sql_result_row.= $search_string;
			$sql_result_row.= $search_health_status;
			$sql_result_row.= $search_ed;
			$sql_result_row.= $search_agemin;
			$sql_result_row.= $search_agemax;
			$sql_result_row.= $search_expmin;
			$sql_result_row.= $search_expmax;
			$sql_result_row.= $search_type;
			$sql_result_row.= $search_status;
			$sql_result_row.= $search_nat;
			$sql_result_row.= $search_time;
			$sql_result_row.= $search_salary;
			$sql_result_row.= $search_gender;
			$sql_result_row.= $group_by;
			$sql_result_row.= $field." ";
			$sql_result_row.= $sort;
			return $sql_result_row;

}
						
if(!isset($_GET['page']))
	$page=1;
	else
	$page=(int) $_GET['page'];
			$records_at_page = 20;
			$select_st ="job_company.comp_id,desc_id,job_name, domain_name,city_name, comp_name,job_desc,type_name,job_start";
			$sql_result_row = get_result_sql($select_st,$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed,"GROUP BY desc_id","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);


			$sqll_result =  $mysqli->query($sql_result_row) or die ('request "Could not execute SQL query" '.$sql_result_row);
			$recodes_count = $sqll_result->num_rows;
			$page_count = (int) ceil($recodes_count / $records_at_page );
			if($recodes_count <> 0){
			if(($page > $page_count) || ($page <= 0)){
			die('noooo moore');
			}}
			$start= ($page -1) * $records_at_page;
			$end = $records_at_page;

			

			?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
الوظائف
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
			?><div class="hed">

					<ul id="navigation">
					<li>
						<a href="../index.php">الرئيسية</a>
					</li>
					<li  class="selected">
						<a href="searchjob.php">الوظائف</a>
					</li>
					<li>
						<a href="searchcvs.php" >السير الذاتية </a>
					</li>
				
				
				<li class="mm">|</li>
					<?php 
					if(!empty($_SESSION['txt_type'])){
						if($_SESSION['txt_type'] =='seeker'){
					
					echo "<li>";
					echo	"<a href='../seeker/profile.php' >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='../logout.php'>خروج</a>";
					echo "</li>";
					}
					else if(($_SESSION['txt_type'] =='employer') || ($_SESSION['txt_type'] =='company')){
					echo "<li>";
					echo	"<a href='../company/empprofile.php'  >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='../logout.php'   >خروج</a>";
					echo "</li>";
					
					}
					else if($_SESSION['txt_type'] =='admin'){
					echo '<li>';
					echo '<a href="../admin/index.php" >لوحة التحكم</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../admin/tables.php" >المحتوي</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../admin/seekers.php" >المستخدمين</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../admin/mange.php" >الأدارة</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="../logout.php">خروج</a>';
					echo '</li>';
					}
					}
					else{
					
					echo "<li class=' hoverbut'>";
					echo "<a href='../singup.php' >تسجيل</a>";
					echo "</li>";
					
					echo "<li class=' hoverbut' >";
					echo	"<a href='../login.php' >دخول</a>";
					echo "</li>";
					

					}
					?>
				
				
				</ul>
		</div>
	</div>
	 <div id="container">
		<div class="span3" >
                 <div class="menusearch"><br/>
						
					<div class="searchright" > 
					
					<div class="searchtitel">	
					
					حصر النتائج
					</div>
					<br/><div class="titel-search" >		
					<img src="../images/pin56.png" style="opacity:0.7;" alt="المدينة" />&nbsp;<label>المدينة</label></div>
					<div class="select_search">
					 <?php 
					
				
					 if((!isset($_GET['city_name'])) || ($_GET['city_name']=="")){ 

					$sql_result_row = get_result_sql("city_name,count( desc_id ) AS countcity",$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed,"GROUP BY city_name","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
					$sql_result_row.= " order by countcity DESC ";
					$sql_resultt = $mysqli->query($sql_result_row);
					while ($row = mysqli_fetch_object($sql_resultt)) {
						$urlll = "searchjob.php"."?".urldecode(get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$row->city_name,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort));
						?>  
						
					 <a class="searcha" href="<?php echo $urlll;  ?>">
					<?php echo $row->city_name." ( ".$row->countcity." )"; ?> 
					 </a>
					<?php } //end foreach ?>  
					<?php }else{ 
					 $get_get = urldecode(get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,"",$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort));
			?>
					
					<input type="hidden" name="city_name" value="<?php echo $_GET['city_name']; ?>"> 
					<?php echo  "".$_GET['city_name'];?> (<a class="adelete" href="searchjob.php?<?php echo $get_get; ?>">إزالة</a>) <?php } ?>
		</div>
		<br/>

			
	
				
<div class="titel-search" >
	<img src="../images/menu48.png" class="imgsearch" alt="المجال" />&nbsp;
	<label>المجال</label>
	<br/>
</div>
<div class="select_search">

<?php
	if(empty($_GET['domain_name'])){ 
	$sql_result_row = get_result_sql("domain_name,count( desc_id ) AS countdoamin",$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed,"GROUP BY domain_name","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
	$rs = $mysqli->query($sql_result_row);

	while ($row = $rs->fetch_object()) {
	$urlll= "searchjob.php"."?".urldecode(get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$row->domain_name,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort));
	?>
	<a class="searcha" href="<?php echo $urlll; ?>">
		<?php
		echo $row->domain_name." ( ".$row->countdoamin." ) "; 
		?>
		</a>
		<?php
		}  //end while
		} 
		else{ 
			$get_herf_domain = urldecode(get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,"",$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort));	
			?>
			<input type="hidden" name="domain_name" value="<?php echo $_GET['domain_name'];?>">
			<?php
			echo $_GET['domain_name'];
			echo '(<a href="'.$_SERVER['PHP_SELF'].'?'.$get_herf_domain.'">إزالة</a>)';
		} 
?>
</div>
<br/>					
<div class="titel-search" >
	<img src="../images/buildings10.png" class="imgsearch" alt="الشركة" />&nbsp;
	<label>الشركة</label>
	<br/>
</div>
<div class="select_search">
<?php 
	if((!isset($_GET['comp_name'])) || ($_GET['comp_name']=="")){ 
	$sql_result_row = get_result_sql("comp_name,count( desc_id ) AS countcompany",$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed,"AND comp_active = 0 GROUP BY comp_name","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
	$sql_result_row.= " order by countcompany DESC 	LIMIT 0 ,30";
	$rs = $mysqli->query($sql_result_row);
	while ($row = $rs->fetch_object()) { 
		echo '<a class="searcha" href="'.$_SERVER['PHP_SELF'].'?'.get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$row->comp_name,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort).'">';
		echo $row->comp_name." ( ".$row->countcompany." )"; 
		echo " </a>";
		} //end while
		}
		else{ 
			$get_herf_comp =get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,"",$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort); 
			echo '<input type="hidden" name="comp_name" value="'.$_GET['comp_name'].'">'; 
			echo  $_GET['comp_name'];
			echo '(<a href="'.$_SERVER['PHP_SELF'].'?'.$get_herf_comp.'">إزالة</a>)';
		}
?>
</div>
<br/>
<div class="titel-search" >
	<img src="../images/university2.png" class="imgsearch"  alt="الشهادة" />&nbsp;
	<label>الشهادة</label>
	<br/>
</div>
<div class="select_search">
<?php 
if((!isset($_GET['name_ed'])) || ($_GET['name_ed']=="")){ 
$sql_result_row = get_result_sql("edt_name,count( desc_id ) AS name_edcount",$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed," GROUP BY edt_name","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
$sql_result_row.= " order by name_edcount DESC ";
$rs = $mysqli->query($sql_result_row);
while ($row = $rs->fetch_object()) {
echo '<a class="searcha" href="'.$_SERVER['PHP_SELF'].'?'.get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$row->edt_name,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort).'">';
echo $row->edt_name." ( ".$row->name_edcount." )";
echo "</a>";
} //end while  
}
else{ 
$get_herf_ed =get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,"",$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort);
echo '<input type="hidden" name="edt_name" value="'.$_GET['name_ed'].'">';
echo $_GET['name_ed'];
echo '(<a href="'.$_SERVER['PHP_SELF'].'?'.$get_herf_ed.'">إزالة</a>)';
} 
?>			


</div>
<br/>
<div class="titel-search" >
	<img src="../images/university2.png" class="imgsearch"  alt="الخبرة" />&nbsp;
	<label>المستوي المهني</label>
	<br/>
</div>
<div class="select_search">
<?php 
if((!isset($_GET['exp_type'])) || ($_GET['exp_type']=="")){ 
$sql_result_row = get_result_sql("exp_type_name,count( desc_id ) AS name_expcount",$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed," GROUP BY exp_type_name","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
$sql_result_row.= " order by name_expcount DESC ";
$rs = $mysqli->query($sql_result_row);
while ($row = $rs->fetch_object()) {
echo '<a class="searcha" href="'.$_SERVER['PHP_SELF'].'?'.get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$row->exp_type_name,$herf_salary,$herf_time,$herf_field,$herf_sort).'">';
echo $row->exp_type_name." ( ".$row->name_expcount." )";
echo "</a>";
} //end while  
}
else{ 
$get_herf_ed =get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,"",$herf_salary,$herf_time,$herf_field,$herf_sort);
echo '<input type="hidden" name="exp_type_name" value="'.$_GET['exp_type'].'">';
echo $_GET['exp_type'];
echo '(<a href="'.$_SERVER['PHP_SELF'].'?'.$get_herf_ed.'">إزالة</a>)';
} 
?>			

</div>
			
			<br/>
				<div class="titel-search" >
				 <img src="../images/dollars.png" class="imgsearch"  alt="الشركة" />&nbsp;<label>المرتب</label><br/>
				 </div>
				 <div class="select_search">
				 <?php if((!isset($_GET['salary_name'])) || ($_GET['salary_name']=="")){ ?>
			
				
				<?php

				$sql_result_row = get_result_sql("salary_name,count( desc_id ) AS name_salcount",$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed," GROUP BY salary_name","","",$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
							$sql_result_row.= " order by name_salcount DESC ";
							$rs = $mysqli->query($sql_result_row);
					while ($row = $rs->fetch_object()) {
				
								?>  
							<a class="searcha" href="<?php echo "searchjob.php"."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$row->salary_name,$herf_time,$herf_field,$herf_sort);  ?>">
									<?php echo $row->salary_name." ( ".$row->name_salcount." )"; ?>  </a>
					 <?php } //end foreach ?>  
				<?php }else{ 
				$get_herf_ed =get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,"",$herf_time,$herf_field,$herf_sort);
				?>

				<input type="hidden" name="salary_name" value="<?php echo $_GET['salary_name']; ?>"> <?php echo  $_GET['salary_name'];?>
				 (<a href="<?php echo $_SERVER['PHP_SELF']."?".$get_herf_ed; ?>">إزالة</a>) <?php } ?>			


			</div>
			<br/>
				<div class="titel-search" >
				 <img src="../images/calendar146.png" class="imgsearch"  alt="الشركة" />&nbsp;<label>التاريخ</label><br/>
				 </div>
				 <div class="select_search">
				 <?php 
				 $job_time =  array (
							'today'=>"اليوم",'towday'=>"أخر يومين",'week'=>"أخر 7 أيام",'week3'=>"أخر 21 أيام"
							);
				 if((!isset($_GET['time'])) || ($_GET['time']=="")){ ?>
			
				
				<?php
					
					
							foreach($job_time as $key => $value){
								
						
								?>  
							<a class="searcha" href="<?php echo "searchjob.php"."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$key,$herf_field,$herf_sort);  ?>">
									<?php echo $value.""; ?>  </a>
					 <?php } //end foreach ?>  
				<?php }else{ 
				$get_herf_ed =get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,"",$herf_field,$herf_sort);
				
				
				?>

				<input type="hidden" name="time" value="<?php  echo $job_time[$_GET['time']]; ?>"> <?php echo  $job_time[$_GET['time']];?>
				 (<a href="<?php echo $_SERVER['PHP_SELF']."?".$get_herf_ed; ?>">إزالة</a>) <?php } ?>			


			</div>
			
		</div>	</div></div>
<div class="span9">		
	<div class="item">
			
				
 


	  <div>		
			
				 <h4>الوظائف</h4>
				
		</div>
<div class='search'>
<form id="form1" name="form1" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
<div style=" padding-bottom:8px;border-bottom :1px solid #eee;">
<label>الوظيفة</label>
<input type="text" name="string" id="string" style="width:246px" maxlength="40" value="<?php if(isset($_GET['string'])){echo $_GET["string"];} ?>"  placeholder="اسم الوظيفة" />
      &nbsp; &nbsp; 
	 
 &nbsp;&nbsp;<label>نوع التوظيف</label>&nbsp;
<select style="width:71px;" name="type_name" >
		
							<option value="">غير محدد</option>
						<?php
									$query= "SELECT type_id,type_name FROM job_type";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_array()){
							echo "<option ";
							if((!empty($_GET['type_name']))&&($_GET['type_name']==$row["type_name"])){echo " selected ";}
							echo "value='".$row["type_name"]."'>".$row["type_name"]."</option>\n";}
							?>
							</select>	
   &nbsp;&nbsp;<label>حالة الوظيفة</label>&nbsp;
<select style="width:71px;" name="status_name"  >


<option value="" >غير محدد</option>
		<?php
									$query= "SELECT status_id,status_name FROM job_status";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_array()){
							echo "<option ";
							if((!empty($_GET['status_name']))&&($_GET['status_name']==$row["status_name"])){echo " selected ";}
							echo "value='".$row["status_name"]."'>".$row["status_name"]."</option>\n";}
							?>
							</select>

   
   



 </div>
 <div style=" width:650px;border:0px solid #222 ;padding:12px 0px 0px 5px;"> 

العمر &nbsp; 
<input name="agemin" placeholder="من" style="width:40px;" maxlength="2" type="text"  /> -
<input name="agemax" placeholder="الي" style="width:40px;"  maxlength="2" type="text"  />&nbsp;&nbsp;&nbsp;
الخبرة &nbsp;<input name="expmin" placeholder="من" style="width:40px;"  maxlength="2" type="text" value=""/> - 
<input name="expmax" placeholder="الي" style="width:40px;" type="text" maxlength="2" value=""/>&nbsp;&nbsp;&nbsp;

      &nbsp;   &nbsp;
	  <label>الجنس</label>&nbsp;&nbsp;&nbsp;
<select name="gender" style="width:71px;" >

	<option value='' >الكل</option>
								<?php
							$job_gender =  array (
							'm'=>"ذكر",'f'=>"أنثي"
							);
							foreach($job_gender as $key => $value){
							echo "<option ";
							if(isset($_GET['gender'])){if($_GET['gender']== $key) echo 'selected="selected"';}
							echo "value=\"$key\">$value</option>\n";
							}?>
		
							</select>
&nbsp;   &nbsp;   &nbsp; 							
<label>الحالة الصحية</label>
<select name="health_status" style="width:71px;" >

<option value='' selected>الكل</option>
<?php
$health_status =  array (
'1'=>"سليم",'2'=>"معوق"
);
foreach($health_status as $key => $value){
echo "<option ";
if(isset($_GET['health_status'])){if($_GET['health_status']== $key) echo 'selected="selected"';}
echo "value=\"$key\">$value</option>\n";
}?>

</select>  
							<br/><br/>
<label>الجنسية</label>&nbsp;
<select  name="nat"  >
<option value="" >الكل</option>
<?php
$query= "SELECT nat_id,nat_name FROM job_nat";
$rs = $mysqli->query($query) or die(mysqli_error());
while ($row =$rs->fetch_array()){
if($row["nat_id"] ==1){
continue ;
}
echo "<option ";
if((!empty($_GET['nat']))&&($_GET['nat']==$row["nat_name"])){echo " selected ";}

echo "value='".$row["nat_name"]."'>".$row["nat_name"]."</option>\n";}
?>
</select>
<br /><br /><br />

&nbsp; <input type="submit" style='width:150px;height:35px;' class="btn btn-info" value="بحث" />

<a href="<?php  echo $_SERVER['PHP_SELF']; ?>" class="btn btn-danger">إزالة معايير البحث</a>
</form>

<input type="hidden" value="<?php echo $herf_city;?>" name="city_name" />
<input type="hidden" value="<?php echo $herf_domain;?>" name="domain_name" />
<input type="hidden" value="<?php echo $herf_comp;?>" name="comp_name" />
<input type="hidden" value="<?php echo $herf_ed;?>" name="name_ed" />
<input type="hidden" value="<?php echo $herf_exp;?>" name="exp_type" />
<input type="hidden" value="<?php echo $herf_time;?>" name="time" />
<input type="hidden" value="<?php echo $herf_salary;?>" name="salary_name" />
<input type="hidden" value="<?php echo $herf_field;?>" name="field" />
<input type="hidden" value="<?php echo $herf_sort;?>" name="sort" />
<br />
 </div>
 



</form>
<br/>
  </div>
<?php 
/* $sql="SELECT ";
$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if (mysqli_num_rows($sql_result)>0) {
	while ($row = $sql_result->fetch_object()) { */
?>



  <br /><br />
<?php




	


$select_st ="job_company.comp_id,desc_id,image,see_it, job_name, domain_name, city_name,comp_active, comp_name,job_desc,type_name,job_start,job_end,DAY(job_end) as job_endd";
$sql = get_result_sql($select_st,$search_domain,$search_city,$search_string,$search_health_status,$search_company,$search_ed,'',$field,$sort,$search_salary,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_type,$search_status,$search_gender,$search_nat,$search_exp);
$sql.= " LIMIT $start ,$end";
$sql_result =  $mysqli->query($sql) or die ('خطاء'.$sql);
?>
    <table class="tablejob table-bordered" id="t01" style="width:700px;">
	<tr style="background:#f9f9f9;">
	<td style="width:20px" colspan="6" >عدد النتائج  <?php echo $recodes_count;?></td>
	</tr>

 <tr style="height :26px;" >
        <th style="width:40px;">
  
        </th>
        <th style="width:270px;">
    
        </th>
        <th style="width:60px;">
          الشركة
        </th>
        <th style="width:60px;">
          المدينة
        </th>
        <th style="width:90px;">
   
	 <?php if($herf_field=='job_start'){
					if($herf_sort=='ASC'){
						echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,"job_start","DESC")."'".">"; 
						echo "<img src='../images/arrowtop.png' style='width:14px;height:14px;'>";
						}
						else{
	   echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,"job_start","ASC")."'".">";
	   echo "<img src='../images/arrowBottom.png' style='width:14px;height:14px;'>";}
	   }else{echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,"job_start","ASC")."'".">"; }
	   ?>
	 تاريخ الأضافة
	 </a></th> 
	 <th style="width:100;"  >	 <?php if($herf_field=='job_end'){
					if($herf_sort=='ASC'){
					echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,"job_end","DESC")."'".">"; 
						echo "<img src='../images/arrowBottom.png' style='width:14px;height:14px;'>";
						}
						else{
	 echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,"job_end","ASC")."'".">"; 
	   echo "<img src='../images/arrowtop.png' style='width:14px;height:14px;'>";}
	   }else{ echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,"job_end","ASC")."'".">";  }
	   ?>
	 تاريخ الأنتهاء
	 </a></th>
  </tr>
<?php

if (mysqli_num_rows($sql_result)>0) {
	while ($row = $sql_result->fetch_assoc()) {
	

?>
  <tr>
    <td><?php 

	$filename="../images/company/ll.jpg";
	if($row['image'] !=""){
	$filename = '../images/company/'.$row['image']; }	
	?>

			<a  href="job.php?id=<?php echo $row['desc_id']; ?>"><img class='imgview'  src=<?php if($row['image'] !=""){if ($row['comp_active']==0){echo $filename;}else{echo "../images/no_pic.gif";}}else {echo "../images/no_pic.gif";}?> alt="<?php echo $row['comp_name']; ?>" /></a> </td>
    <td><span class="title"><a  href="job.php?id=<?php echo $row['desc_id']; ?>"><?php echo $row['job_name']; ?></a></span><br>
	<span class='textssearch'>نوع العمل: <?php echo $row['type_name']; ?><br/><?php echo " المجال : ".$row['domain_name'] ;?></span>
	<br/><span class='textsss'><?php if(strlen($row['job_desc']) >= 200){ echo substr($row['job_desc'],0,200)."..."; }else {echo substr($row['job_desc'],0,200)."";} ?></span>

	<br/><span class='textsss'>عدد المشاهدات : <?php echo $row['see_it'];?></span>
	<?php

	?>
	
	</td>
		<td><?php if($row['comp_active']==1){echo "اسم الشركة محجوب";}else{echo '<a href="viewcompany.php?id='.$row['comp_id'].'" > '.$row['comp_name'].' </a>';}?></td>

	<td><?php echo $row["city_name"]; ?></td>
	<td><?php echo $row["job_start"]; ?></td>
	<td><?php
	$start=  strtotime(date("Y-m-d") );
	$end = strtotime($row["job_end"]);
	$days_between = ceil(($end - $start) / 86400);
	echo $row["job_end"]."<br/>";
	if($days_between+1 > 20 ){?>
	<span class="colornumgood">
	<?php
	echo "باقي ".($days_between+1) ." يوم ";?>
	<span/>
	 <?php
	 }
	else{?>
	<span class="colornum">

	<?php
	echo "باقي ".($days_between+1) ." يوم ";	?>
<span/>
<?php	
	}?></td>


	
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="6">لا توجد نتائج.</td>
<?php	
}
?>
</table>
<br/>
<?php
$pagination="";
$page    = (isset($_GET['page']) ? $_GET['page'] : 1);
$firstpage      = 1;
$lastpage       = $page_count;
$loopcounter = ( ( ( $page + 2 ) <= $lastpage ) ? ( $page + 2 ) : $lastpage );
$startCounter =  ( ( ( $page - 2 ) >= 3 ) ? ( $page - 2 ) : 1 );
if($page_count >= 1)
{
		$get_herf_page = get_herf($herf_string,$herf_type,$herf_status,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_health,$herf_gender,$herf_nat,$herf_city,$herf_domain,$herf_comp,$herf_ed,$herf_exp,$herf_salary,$herf_time,$herf_field,$herf_sort);
			$pagination .= '<div class="pagen" >';
					if($startCounter >= 3){
					$pagination .= '<a  href="'.$_SERVER['PHP_SELF'].'?page=1'.'&'.$get_herf_page.'">1</a>';
					$pagination .= " ... ";
					}	
					
			
                    for($i = $startCounter; $i <= $loopcounter; $i++)
                    {

					if($page == $i)
					$pagination .= '<a class="current">'.$page.'</a>';
					else
                        $pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'&'.$get_herf_page.'">'.$i.'</a>';
                    }
					if($page <= $lastpage-3  ){
					$pagination .= " ... ";
					$pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$page_count.'&'.$get_herf_page.'">'.$page_count.'</a>';
					}
				$pagination .= '</div>';
				
					
					
                }
echo $pagination;

?>
<br/>
</div>  	
</div>
</div>              
</div>
       
<?php
	include_once("../inc/footerdown.php");

	?>	
    </body>

</html>