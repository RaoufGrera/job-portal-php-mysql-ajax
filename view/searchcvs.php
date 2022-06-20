<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

error_reporting(0); //لاخفاء الأخطاء


// أعطاء قيم مبدائية للمتغيرات	  
$get_city="";
$search_salary=$search_time=$search_desc=$search_domain=$search_gender=$search_agemin=$search_agemax=$search_expmin=$search_expmax= $search_city=$search_string=$search_company=$search_health_status=$search_ed=$field=$sort=$get_herf_page=$search_salary="";
$search_nat=$search_type=$search_status='';
$herf_string=$herf_comp=$herf_city=$herf_domain=$herf_health=$herf_ed=$herf_status=$herf_type='';
$herf_nat=$herf_field = $herf_sort=$herf_gender=$herf_agemin=$herf_agemax=$herf_expmin=$herf_expmax=$herf_salary=$herf_time='';


if (!empty($_GET["nat"])) {
	$search_nat = " AND (job_nat.nat_name ='" .safe_input($_GET["nat"])."'  )"  ;	
	$herf_nat  =$_GET["nat"];
	}
			
if (!empty($_GET["string"])) {
	$search_string = " AND (specialty LIKE '%".safe_input($_GET["string"])."%' OR job_seeker.user_id LIKE '%".safe_input($_GET["string"])."%')";	
$herf_string  =$_GET["string"];
	}

if (!empty($_GET["domain_name"])) {
	$search_domain = " and job_domain.domain_name ='" .safe_input($_GET["domain_name"])."'" ;	
	$herf_domain  =$_GET["domain_name"];
}

if (!empty($_GET["health_status"])) {
	$search_health_status = " and job_seeker.health_status ='" .safe_input($_GET["health_status"])."'" ;
	$herf_health  =$_GET["health_status"];
}	

if (!empty($_GET["gender"])) {
	$search_gender = " and job_seeker.gender ='" .safe_input($_GET["gender"])."'" ;	
	$herf_gender =$_GET["gender"];
}

if (!empty($_GET["agemin"])) {
	$search_agemin = " and {fn TIMESTAMPDIFF(YEAR,birth_day, CURDATE()) >=  '" .safe_input($_GET["agemin"])."' }" ;	
	$herf_agemin =$_GET["agemin"];					
}

if (!empty($_GET["agemax"])) {
	$search_agemax = " and {fn TIMESTAMPDIFF(YEAR,birth_day, CURDATE()) <=  '" .safe_input($_GET["agemax"])."' }" ;
		$herf_agemax=$_GET["agemax"];
}

if (!empty($_GET["expmin"])) {
	$search_expmin = " and {fn TIMESTAMPDIFF(year, job_exp.start_date,job_exp.end_date) >=  '" .safe_input($_GET["expmin"])."' }" ;	
		$herf_expmin =$_GET["expmin"];
}
if (!empty($_GET["expmax"])) {
	$search_expmax = " and {fn TIMESTAMPDIFF(year, job_exp.start_date,job_exp.end_date) <=  '" .safe_input($_GET["expmax"])."' }" ;	
	$herf_expmax =$_GET["expmax"];
}

if (!empty($_GET["time"])) {
	$herf_time =safe_input($_GET["time"]);
	$selecttime = safe_input($_GET["time"]);
	switch ($selecttime){
	case "today":
	$search_time = " and job_seeker.date_register = CURDATE() ";
	break;
	case "towday":
	$search_time = " and job_seeker.date_register >= DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND date_register <= CURDATE() ";	
	break;
	case "week":
	$search_time = " and job_seeker.date_register >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND date_register <= CURDATE() ";	
	break;
	case "week3":
	$search_time = " and job_seeker.date_register >= DATE_SUB(CURDATE(), INTERVAL 21 DAY) AND date_register <= CURDATE() ";	
	break;
	}
}

if (!empty($_GET["city_name"])) {
	$search_city = " and job_city.city_name ='".safe_input($_GET["city_name"])."'" ;
	$herf_city  =$_GET["city_name"];
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
}else{
	$field = " ORDER BY  date_register  ";
	$sort = " DESC ";
}
					
function get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,$herf_field,$herf_sort){
			$herf_result = "string=".$herf_string;
			$herf_result.= "&amp;health_status=".$herf_health;
			$herf_result.= "&amp;gender=".$herf_gender;
			$herf_result.= "&amp;agemin=".$herf_agemin;
			$herf_result.= "&amp;agemax=".$herf_agemax;
			$herf_result.= "&amp;expmin=".$herf_expmin;
			$herf_result.= "&amp;expmax=".$herf_expmax;
			$herf_result.= "&amp;nat=".$herf_nat;	
			$herf_result.= "&amp;city_name=".$herf_city;
			$herf_result.= "&amp;domain_name=".$herf_domain;
			$herf_result.= "&amp;name_ed=".$herf_ed;
			$herf_result.= "&amp;time=".$herf_time;
			$herf_result.= "&amp;field=".$herf_field;
			$herf_result.= "&amp;sort=".$herf_sort;
			return $herf_result;
}

function get_result_sql($select_string,$search_domain,$search_city,$search_string,$search_health_status,$search_ed,$group_by,$field,$sort,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_gender,$search_nat){
			$sql_result_row = "SELECT DISTINCT job_seeker.user_id ";
			$sql_result_row.= $select_string;
			$sql_result_row.= " FROM job_seeker
			left join job_city on job_city.city_id = job_seeker.city_id
			  JOIN job_ed on job_seeker.user_id =job_ed.user_id 
			left  JOIN job_ed_type on job_ed_type.edt_id  = job_ed.edt_id 
			left join job_domain on job_domain.domain_id = job_ed.domain_id
			left join job_nat on job_nat.nat_id = job_seeker.nat_id 
			left join job_exp on job_exp.user_id = job_seeker.user_id
			WHERE  (job_ed.end_date) in (select max(job_ed.end_date) 
			from job_seeker, job_ed where  job_ed.user_id = job_seeker.user_id  group by job_seeker.user_id ) 

			and is_active = 0
			and hide_cv = 0
			and block_admin = 0 ";
			$sql_result_row.= $search_domain;	
			$sql_result_row.= $search_city;
			$sql_result_row.= $search_string;
			$sql_result_row.= $search_health_status;
			$sql_result_row.= $search_ed;
			$sql_result_row.= $search_nat;
			$sql_result_row.= $search_agemin;
			$sql_result_row.= $search_agemax;
			$sql_result_row.= $search_expmin;
			$sql_result_row.= $search_expmax;
			$sql_result_row.= $search_time;
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
			$records_at_page =20;
			$select_st =",fname,email,lname,birth_day,edt_name,SUM(TIMESTAMPDIFF(year, job_exp.start_date,job_exp.end_date)) as sum_exp,domain_name,city_name";
			$sql_result_row = get_result_sql($select_st,$search_domain,$search_city,$search_string,$search_health_status,$search_ed,"GROUP BY job_seeker.user_id","","",$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_gender,$search_nat);
		
			$sqll_result =  $mysqli->query($sql_result_row) or die ('request "Could not execute SQL query" '.$sql_result_row);
			$recodes_count = $sqll_result->num_rows;
			$page_count = (int) ceil($recodes_count / $records_at_page );
			if($recodes_count <> 0){
			if(($page > $page_count) || ($page <= 0)){
			die('خطاء');
			}}
			$start= ($page -1) * $records_at_page;
			$end = $records_at_page;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
السير الذاتية
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
						<a href="searchjob.php">الوظائف</a>
					</li>
					<li class="selected">
						<a href="searchcvs.php">السير الذاتية </a>
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
					<span >
					حصر النتائج</span>
					</div>
					<br/><div class="titel-search" >		
					<img src="../images/pin56.png" style="opacity:0.7;" alt="المدينة" />&nbsp;<label>المدينة</label></div>
					<div class="select_search">
					 <?php 
					
				
					 if((!isset($_GET['city_name'])) || ($_GET['city_name']=="")){ ?>
					
					<?php
					
					$sql_result_row = get_result_sql(",city_name,count(DISTINCT job_seeker.user_id) AS countcity",$search_domain,$search_city,$search_string,$search_health_status,$search_ed,"GROUP BY city_name","","",$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_gender,$search_nat);
					$sql_result_row.= " order by countcity DESC ";
					$sql_resultt = $mysqli->query($sql_result_row);
					while ($row = mysqli_fetch_object($sql_resultt)) {
						?>  
					 <a class="searcha" href="<?php echo "searchcvs.php"."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$row->city_name,$herf_domain,$herf_ed,$herf_time,$herf_field,$herf_sort);  ?>">
					<?php echo $row->city_name." ( ".$row->countcity." )"; ?> 
					 </a>
					<?php } //end foreach ?>  
					<?php }else{ 
					 $get_get = get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,"",$herf_domain,$herf_ed,$herf_time,$herf_field,$herf_sort);
			?>
					
					<input type="hidden" name="city_name" value="<?php echo $_GET['city_name']; ?>"> 
					<?php echo  "".$_GET['city_name'];?> (<a class="adelete" href="searchcvs.php?<?php echo $get_get; ?>">إزالة</a>) <?php } ?>
		</div>
		<br/>

			
	
				
					<div class="titel-search" >
					<img src="../images/menu48.png" class="imgsearch" alt="المدينة" />&nbsp;<label>المجال</label><br/>
					</div>
					<div class="select_search">
					 <?php  if(empty($_GET['domain_name'])){ ?>
					
					<?php

					$sql_result_domain = get_result_sql(",domain_name,count( DISTINCT job_seeker.user_id ) AS countdoamin",$search_domain,$search_city,$search_string,$search_health_status,$search_ed,"GROUP BY domain_name","","",$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_gender,$search_nat);
		
					$sql_result_domain.= " order by countdoamin DESC ";	
					$rs = $mysqli->query($sql_result_domain);
					while ($row = $rs->fetch_object()) {
					?>  
					<a class="searcha" href="<?php echo "searchcvs.php"."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$row->domain_name,$herf_ed,$herf_time,$herf_field,$herf_sort);  ?>">
					<?php if($row->domain_name ==""){echo "ليس لهم مجال";} {echo $row->domain_name;} echo" ( ".$row->countdoamin." )"; ?>  </a>
					<?php } //end foreach ?>  
					<?php }else{ 
					$get_herf_domain = get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,"",$herf_ed,$herf_time,$herf_field,$herf_sort);
					?>
					<input type="hidden" name="domain_name" value="<?php echo $_GET['domain_name']; ?>"> <?php echo  $_GET['domain_name'];?>
					 (<a href="<?php echo $_SERVER['PHP_SELF']."?".$get_herf_domain; ?>">إزالة</a>) <?php } ?>
					 </div>
			<br/>			
			

				<div class="titel-search" >
				 <img src="../images/university2.png" class="imgsearch" alt="المدينة" />&nbsp;<label>الشهادة</label><br/>
				 </div>
				 <div class="select_search">
				 <?php if((!isset($_GET['name_ed'])) || ($_GET['name_ed']=="")){ ?>
			
				
				<?php

				$sql_result_row = get_result_sql(",edt_name,count( DISTINCT job_seeker.user_id  ) AS name_edcount",$search_domain,$search_city,$search_string,$search_health_status,$search_ed," GROUP BY edt_name","","",$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_gender,$search_nat);
$sql_result_row.= " order by name_edcount DESC ";						
						$rs = $mysqli->query($sql_result_row);
					while ($row = $rs->fetch_object()) {
								?>  
							<a class="searcha" href="<?php echo "searchcvs.php"."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$row->edt_name,$herf_time,$herf_field,$herf_sort);  ?>">
									<?php if($row->edt_name ==""){echo "ليس لديهم شهادة";} {echo $row->edt_name;} echo" ( ".$row->name_edcount." )"; ?>  </a>
					 <?php } //end foreach ?>  
				<?php }else{ 
				$get_herf_ed =get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,"",$herf_time,$herf_field,$herf_sort);
				?>

				<input type="hidden" name="edt_name" value="<?php echo $_GET['name_ed']; ?>"> <?php echo  $_GET['name_ed'];?>
				 (<a href="<?php echo $_SERVER['PHP_SELF']."?".$get_herf_ed; ?>">إزالة</a>) <?php } ?>			


			</div>
			<br/>
				<div class="titel-search" >
				 <img src="../images/calendar146.png" class="imgsearch" alt="المدينة" />&nbsp;<label>التاريخ</label><br/>
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
							<a class="searcha" href="<?php echo "searchcvs.php"."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$key,$herf_field,$herf_sort);  ?>">
									<?php echo $value.""; ?>  </a>
					 <?php } //end foreach ?>  
				<?php }else{ 
				$get_herf_ed =get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,"",$herf_field,$herf_sort);
				
				
				?>

				<input type="hidden" name="time" value="<?php  echo $job_time[$_GET['time']]; ?>"> <?php echo  $job_time[$_GET['time']];?>
				 (<a href="<?php echo $_SERVER['PHP_SELF']."?".$get_herf_ed; ?>">إزالة</a>) <?php } ?>			


			</div>
	
			<br/>
		</div>	
		</div>
		</div>		
<div class="span9">	
<div class="item">
<div>
<h4>السير الذاتية</h4>
</div>
<div class='search'>
<form  name="formsearch" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
<div class="insearch">
<label>الأسم</label>
<input type="text" name="string" id="string" style="width:246px" maxlength="40" value="<?php if(isset($_GET['string'])){echo $_GET["string"];} ?>"  placeholder="رقم السيرة الذاتية أو التخصص" />
&nbsp; &nbsp; 
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
							}
							?>
     
</select>
&nbsp; 
<label>الجنس</label>
&nbsp;&nbsp;&nbsp;
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


</div>

<br/>

<label>العمر</label>
&nbsp;
<input type="text" style="width:37px;" name="agemin" placeholder="من" maxlength="2" value="<?php if(!empty($_GET['agemin'])){echo $_GET['agemin'];} ?>" > - <input type="text" name="agemax" maxlength="2" style="width:37px;"   value="<?php if(!empty($_GET['agemax'])){echo $_GET['agemax'];} ?>" placeholder="الي">
&nbsp;&nbsp;
<label>الخبرة</label>
&nbsp;
<input type="text" style="width:37px;" name="expmin" maxlength="2" placeholder="من" value="<?php if(!empty($_GET['expmin'])){echo $_GET['expmin'];} ?>"> - <input type="text" style="width:37px;" maxlength="2" name="expmax" placeholder="الي" value="<?php if(!empty($_GET['expmax'])){echo $_GET['expmax'];} ?>" >
&nbsp;&nbsp;&nbsp;&nbsp;<label>الجنسية</label>&nbsp;
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

<input type="hidden" value="<?php echo $herf_city;?>" name="city_name" />
<input type="hidden" value="<?php echo $herf_domain;?>" name="domain_name" />
<input type="hidden" value="<?php echo $herf_comp;?>" name="comp_name" />
<input type="hidden" value="<?php echo $herf_ed;?>" name="name_ed" />
<input type="hidden" value="<?php echo $herf_time;?>" name="time" />
<input type="hidden" value="<?php echo $herf_salary;?>" name="salary_name" />
<input type="hidden" value="<?php echo $herf_field;?>" name="field" />
<input type="hidden" value="<?php echo $herf_sort;?>" name="sort" />

<br/>
<br/>
<br/>
&nbsp; <input type="submit" style='width:150px;height:35px;' class="btn btn-info" value="بحث" />

<a href="<?php  echo $_SERVER['PHP_SELF']; ?>" class="btn btn-danger">إزالة معايير البحث</a>
</form>
<br/><br/><br/>
<?php 
if(!empty($_SESSION['txt_type'])){
 if(($_SESSION['txt_type'] =='employer') || ($_SESSION['txt_type'] =='company')){
?>
<form name="formjob" action='<?php echo $_SERVER['PHP_SELF'];?>' method='get'>
تطابق حسب الوظيفة 
<select  onchange="location = this.options[this.selectedIndex].value;" >
<option >الوظيفة</option>
<?php
/*
*جلب بيانات الوظائف الشاغرة الخاصة بالموظف
*
*
*/

	$sql_desc = $mysqli->query ("SELECT job_name,city_name,domain_name,edt_name,exp_min,exp_max,age_min,age_max,job_gender,health_status from job_ed_type,job_city,job_domain,job_description,job_employer 
										WHERE job_ed_type.edt_id = job_description.edt_id AND job_domain.domain_id = job_description.domain_id AND job_city.city_id = job_description.city_id AND job_description.emp_id =job_employer.emp_id   and job_employer.emp_id ='$txt_user_id' " );
	while ($row = $sql_desc->fetch_object()) {
			$myjob_herf=$_SERVER['PHP_SELF']."?";
			// يتم تمرير بيانات الوظائف الشاغرة الي دالة عنوان البحث ، حتي نستطيع بمجرد الضغظ علي أحد الوظائف بعرض نتائج البحث الخاصة بها
			$myjob_herf.=get_herf("",$row->health_status,$row->job_gender,$row->age_min,$row->age_max,$row->exp_min,$row->exp_max,$row->nat_id,$row->city_name,$row->domain_name,$row->edt_name,"","","");
			    
			echo "<option value ='$myjob_herf'>";
			echo $row->job_name; 
			echo "</option>";
    } //نهاية الحلقة while ?>   
</select>

</form>

<br/>
<br/>
<?php }}?>


</div>
<br/>
<br/>
<?php

$select_st =",image,last_seen,see_it,date_register,fname,specialty,email,lname,birth_day,edt_name,TIMESTAMPDIFF(YEAR,birth_day,CURDATE()) as age,SUM(TIMESTAMPDIFF(year, job_exp.start_date,job_exp.end_date)) as sum_exp,domain_name,city_name";
$sql = get_result_sql($select_st,$search_domain,$search_city,$search_string,$search_health_status,$search_ed,' GROUP BY job_seeker.user_id ',$field,$sort,$search_time,$search_agemin,$search_agemax,$search_expmin,$search_expmax,$search_gender,$search_nat);

$sql.= " LIMIT $start ,$end";
$sql_result =  $mysqli->query($sql) or die ("خطاء في التنفيذ");
?>
<table id="t01"  class="tablejob table-bordered">
<tr style="background:#f9f9f9;">
<td style="width:20px" colspan="7" >عدد النتائج  <?php echo $recodes_count ;?></td>
</tr>

 <tr style="height :26px;" >
    <th style="width:50px" ></th>
    <th style="width:280px"  ></th>
<th style="width:70px" > المدينة
	   </th>    
   <th style="width:70px"  >	 <?php if($herf_field=='sum_exp'){
					if($herf_sort=='ASC'){
						echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"sum_exp","DESC")."'".">"; 
						echo "<img src='../images/arrowtop.png' style='width:14px;height:14px;'>";
						}
						else{
	   echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"sum_exp","ASC")."'".">";
	   echo "<img src='../images/arrowBottom.png' style='width:14px;height:14px;'>";}
	   }else{echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"sum_exp","ASC")."'".">"; }
	   ?>
	الخبرة
	 </a></th>
	
	   <!-- العمر-->
     <th style="width:60px"><?php if($herf_field=='age'){
					if($herf_sort=='ASC'){
						echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"age","DESC")."'".">"; 
						echo "<img src='../images/arrowtop.png' style='width:14px;height:14px;'>";
						}
						else{
	   echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"age","ASC")."'".">"; 
	   echo "<img src='../images/arrowBottom.png' style='width:14px;height:14px;'>";}
	   }else{echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"age","ASC")."'".">"; }
	   ?>
	العمر</a></th> 
	 	 <th style="width:100px"><?php if($herf_field=='date_register'){
					if($herf_sort=='ASC'){
						echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"date_register","DESC")."'".">"; 
						echo "<img src='../images/arrowtop.png' style='width:14px;height:14px;'>";
						}
						else{
	   echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"date_register","ASC")."'".">"; 
	   echo "<img src='../images/arrowBottom.png' style='width:14px;height:14px;'>";}
	   }else{echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"date_register","ASC")."'".">"; }
	   ?>
	تاريخ التسجيل</a></th>
	 <th style="width:100px"><?php if($herf_field=='last_seen'){
					if($herf_sort=='ASC'){
						echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"last_seen","DESC")."'".">"; 
						echo "<img src='../images/arrowtop.png' style='width:14px;height:14px;'>";
						}
						else{
	   echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"last_seen","ASC")."'".">"; 
	   echo "<img src='../images/arrowBottom.png' style='width:14px;height:14px;'>";}
	   }else{echo "<a href='".$_SERVER['PHP_SELF']."?".get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,"last_seen","ASC")."'".">"; }
	   ?>
	أخر ظهور</a></th>
	
  </tr>
<?php

if ($sql_result->num_rows >0) {
	while ($row = $sql_result->fetch_assoc()) {
	

?>
  <tr>
    <td><?php 

	$filename="../images/seeker/ll.jpg";
	if($row['image'] !=""){
	$filename = '../images/seeker/'.$row['image']; }	
	?>

			<a  href="cvs.php?id=<?php echo $row['user_id']; ?>"><img class='imgview'  src=<?php if($row['image'] !=""){echo $filename;}else {echo "../images/test.jpg";}?> alt="<?php echo $row['fname']. $row['lname']; ?>" /></a> </td>
    <td>
	<span class="title">
	<a  href="cvs.php?id=<?php echo $row['user_id']; ?>"><?php echo $row['fname']." ".$row['lname']; ?></a>
	</span>
	<br>
	<span class='textssearch'>
	<?php echo " المجال: ".$row['domain_name'] ;?>
	<br>
	<?php echo " الشهادة: ".$row['edt_name'] ;?>
	<br>
	<?php echo "التخصص: "; if($row['specialty']==''){echo "غير محدد";}{echo $row['specialty'];} ?>
	</span>

		<br/><span class='textsss'>عدد المشاهدات: <?php echo $row['see_it'];?></span>
	</td>
	<td><?php echo $row["city_name"]; ?></td>
	<td><?php if(($row['sum_exp'] == '') ||($row['sum_exp'] == '0') ){echo "0";}else{ echo $row['sum_exp']." سنة"; }?></td>
	
	<td><?php echo $row['age']; ?></td>
		<?php $time = strtotime($row['date_register']) ?>
	<td><?php echo date('Y-m-d',$time); ?></td>	
	<td><?php echo $row['last_seen']; ?></td>	
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="7">لا توجد نتائج.</td></tr>
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
				$get_herf_page = get_herf($herf_string,$herf_health,$herf_gender,$herf_agemin,$herf_agemax,$herf_expmin,$herf_expmax,$herf_nat,$herf_city,$herf_domain,$herf_ed,$herf_time,$herf_field,$herf_sort);
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