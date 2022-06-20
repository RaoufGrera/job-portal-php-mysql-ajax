<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

  error_reporting(0); 

$id_comp= safe_input($_GET['id']);
						
if(!isset($_GET['page']))
	$page=1;
	else
	$page=(int) $_GET['page'];
			$records_at_page = 20;
			$select_st = "SELECT job_company.comp_id,job_name, domain_name,city_name, comp_name,job_desc,type_name,job_start 
			FROM job_description, job_domain, job_employer, job_company,job_city,job_type,job_status,job_ed_type ,job_nat,job_salary
			WHERE job_employer.emp_id = job_description.emp_id 
			AND job_city.city_id = job_description.city_id
			AND job_employer.comp_id = job_company.comp_id
			AND job_description.domain_id = job_domain.domain_id 
			AND job_description.type_id = job_type.type_id
			AND job_description.status_id = job_status.status_id
			AND job_ed_type.edt_id =  job_description.edt_id
			AND job_nat.nat_id = job_description.nat_id 
			AND job_salary.salary_id = job_description.salary_id
			AND job_description.job_end >= CURDATE() 
			AND job_description.is_active = 0 
			AND job_company.block_admin = 0
			AND job_company.comp_id ='$id_comp'
	
			";
			
		
			$sqll_result =  $mysqli->query($select_st) or die ('خطاء في التنفيذ الرجاء المحاولة مرة أخري" ');
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
<meta charset="UTF-8">
<head>
<title>
وظائف الشركة
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
					<li class="selected">
						<a href="searchjob.php">الوظائف</a>
					</li>
					<li>
						<a href="searchcvs.php">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
								<?php 
					if(!empty($_SESSION['txt_type'])){
				
						if($_SESSION['txt_type']=='seeker'){
					echo "<li>";
					echo	"<a href='../seeker/profile.php'>الملف الشخصي</a>";
					echo "</li>";
					}
					else if (($_SESSION['txt_type']=='company') ||($_SESSION['txt_type']=='employer')){
					echo "<li>";
					echo	"<a href='../company/empprofile.php'  title='تسجيل دخول'> الملف الشخصي</a>";
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

					}
					echo "<li>";
					echo	"<a href='../logout.php'   >خروج</a>";
					echo "</li>";
					}
					else{
					
					
					echo "<li>";
					echo "<a href='../singup.php' title=''>تسجيل</a>";
					echo "</li>";
					
					echo "<li>";
					echo	"<a href='../login.php' >دخول</a>";
					echo "</li>";
					
					
					
					}
					?>
				</ul>
		</div>
	</div>

	<div id="container">
	<div class="span3">
				<ul class="nav nav-list ">
				<li><span class="menus "><strong>القائمة الرئيسية</strong></span>
				</li>
				
				<li> <a href="viewcompany.php?id=<?php echo $id_comp; ?>">بيانات الشركة</a> 
				</li>
				<li   class="active"> <a href="jobcompany.php?id=<?php echo $id_comp; ?>">الوظائف الخاصة بالشركة</a> 
				</li>
			</ul>
	</div>
		<div class="span9">
	<div class="item">
				<h4 id="title_reg">
			الوظائف الخاصة بالشركة
				
				</h4>
		<p class="plinee"></p>

 



<br/>
<br/>
<?php

$sql ="SELECT desc_id,job_company.comp_id,image,job_name, domain_name, city_name,comp_active, comp_name,job_desc,type_name,job_start,job_end,DAY(job_end) as job_endd 
			FROM job_description, job_domain, job_employer, job_company,job_city,job_type,job_status,job_ed_type ,job_nat,job_salary
			WHERE job_employer.emp_id = job_description.emp_id 
			AND job_city.city_id = job_description.city_id
			AND job_employer.comp_id = job_company.comp_id
			AND job_description.domain_id = job_domain.domain_id 
			AND job_description.type_id = job_type.type_id
			AND job_description.status_id = job_status.status_id
			AND job_ed_type.edt_id =  job_description.edt_id
			AND job_nat.nat_id = job_description.nat_id 
			AND job_salary.salary_id = job_description.salary_id
			AND job_description.job_start <= CURDATE() 
			AND job_description.job_end >= CURDATE() 
			AND job_description.is_active = 0 
			AND job_company.block_admin = 0
			AND job_company.comp_id ='$id_comp'
			AND job_description.comp_active = 0
			";
			
$sql.= 	" ORDER BY  job_start  DESC ";
$sql.= " LIMIT $start ,$end";


$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
?>
<table id="t01" width="700"  class="tablejob table-bordered"  >
<tr  class="colortop">
<td width="20" colspan="6" >عدد النتائج  <?php echo $sql_result->num_rows ;?></td>
</tr>	
 <tr  class="colortop">
    <th width="40" >الشعار</th>
    <th width="320"  >العنوان</th>
    <th width="120"  >الشركة</th>
	<th width="80" >
	   المدينة
	 </th> 
     <th width="100"  >

	 تاريخ الأضافة
	 </th> 
	 <th width="80"  >الأيام المتبقية</th>
  </tr>
<?php

if ($sql_result->num_rows >0) {
	while ($row = $sql_result->fetch_assoc()) {
	

?>
  <tr>
    <td><?php 

	$filename="../images/company/ll.jpg";
	if($row['image'] !=""){
	$filename = '../images/company/'.$row['image']; }	
	?>

	<a  href="../view/job.php?id=<?php echo $row['desc_id']; ?>"><img class='imgview'  src=<?php if($row['image'] !=""){echo $filename;}else {echo "../images/no_pic.gif";}?> alt="شعار الشركة" /></a></td>
    <td><span class="title"><a  href="../view/job.php?id=<?php echo $row['desc_id']; ?>"><?php echo $row['job_name']; ?></a></span><br>
	<span class='textssearch'>نوع العمل: <?php echo $row['type_name']; ?>
	<br/><?php echo " المجال : ".$row['domain_name'] ;?></span>
	<br/><span class='textsss'><?php if(strlen($row['job_desc']) >= 200){ echo substr($row['job_desc'],0,200)."..."; }else {echo substr($row['job_desc'],0,200)."";} ?></span>


	</td>
		<td><?php if($row['comp_active']==1){echo "اسم الشركة محجوب";}else{echo '<a href="../view/viewcompany.php?id='.$row['comp_id'].'" > '.$row['comp_name'].' </a>';}?></td>

	<td><?php echo $row["city_name"]; ?></td>
	<td><?php echo $row["job_start"]; ?></td>
	<td><?php
	$start=  strtotime(date("Y-m-d") );
	$end = strtotime($row["job_end"]);
	$days_between = ceil(($end - $start) / 86400);
	echo $row["job_end"]."<br/>";
	echo "باقي";
	echo $days_between+1 ." يوم ";
	
	?></td>


	
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="5">لا توجد نتائج.</td>
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
			$pagination .= '<div class="pagen" >';
					if($startCounter >= 3){
					$pagination .= '<a  href="'.$_SERVER['PHP_SELF'].'?page=1">1</a>';
					$pagination .= " ... ";
					}	
					
			
                    for($i = $startCounter; $i <= $loopcounter; $i++)
                    {

					if($page == $i)
					$pagination .= '<a class="current">'.$page.'</a>';
					else
                        $pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
                    }
					if($page <= $lastpage-3  ){
					$pagination .= " ... ";
					$pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$page_count.'">'.$page_count.'</a>';
					}
				$pagination .= '</div>';
				
					
					
                }
echo $pagination;


?>
</div>
</div>
</div>
</div>

<?php
include_once("../inc/footerdown.php");
?>
</body>
</html>