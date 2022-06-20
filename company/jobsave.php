<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

	 error_reporting(0); 


						
if(!isset($_GET['page']))
	$page=1;
	else
	$page=(int) $_GET['page'];
			$records_at_page = 20;
			$select_st =" SELECT DISTINCT job_seeker.user_id FROM job_seeker_save
			join job_seeker on job_seeker.user_id = job_seeker_save.seeker_id
			join job_city on job_city.city_id = job_seeker.city_id
			left  JOIN job_ed 
			on job_seeker.user_id =job_ed.user_id 
			left  JOIN job_ed_type on job_ed_type.edt_id  = job_ed.edt_id 
			left join job_domain on job_domain.domain_id = job_ed.domain_id
			left join job_exp on job_exp.user_id = job_seeker.user_id
			WHERE  (job_ed.end_date) in (select max(job_ed.end_date) 
			from job_seeker, job_ed where  job_ed.user_id = job_seeker.user_id  group by job_seeker.user_id ) 
			and is_active = 0
			and hide_cv = 0
			and block_admin = 0 
			and job_seeker_save.emp_id ='$txt_user_id' 
			group by job_seeker_save.seeker_id ";
			$sql_result_row = $select_st ;
		
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
<head>
<meta charset="UTF-8">
<title>
السير الذاتية المحفوظة
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
						<a href="../view/searchjob.php" class="hoverbut">الوظائف</a>
					</li>
					<li>
						<a href="../view/searchcvs.php" class="hoverbut">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
					
					
				
										<?php 
					if(!empty($_SESSION['txt_type'])){
					 if(($_SESSION['txt_type'] =='employer') || ($_SESSION['txt_type'] =='company')){
					echo "<li  class='selected'>";
					echo	"<a href='../company/empprofile.php'  >الملف الشخصي</a>";
					echo "</li>";
					echo "<li>";
					echo	"<a href='../logout.php'   >خروج</a>";
					echo "</li>";
					
					}
					else{
					die('غير مسموح لك بالدخول');
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
             <ul class="nav nav-list ">
							<li><span class="menus "><strong>القائمة الرئيسية</strong></span>
							</li>
							
							<li> <a href="empprofile.php"></i>بيانات الحساب</a> </li>
							</li>
							
							<?php 
						
							if($_SESSION['txt_type'] =='company'){
							echo "<li><a href='compprofile.php'>بيانات الشركة</a></li>";
							echo "<li><a href='controluser.php'>إدارة الموظفين</a></li>";
							}
							?>
					
							<li>
								<a href="jobpost.php"> أعلن عن وظيفية</a>
							</li>		
							<li >
								<a href="joblist.php">الوظائف الخاصة بي</a>
							</li>
							<li >
								<a href="jobrequest.php"> طلبات التوظيف</a>
							</li>
							<li class="active">
								<a href="jobsave.php">السير المحفوظة</a>
							</li>
						</ul> 
		</div>		
<div class="span9">	
<div class="item">
<div>
<h4>السير الذاتية المحفوظة</h4>
</div>

 



<br/>
<br/>
<?php

$sql ="SELECT DISTINCT job_seeker.user_id,date_register,image,last_seen,fname,specialty,email,lname,birth_day,edt_name,TIMESTAMPDIFF(YEAR,birth_day,CURDATE()) as age,SUM(TIMESTAMPDIFF(year, job_exp.start_date,job_exp.end_date)) as sum_exp,domain_name,city_name
			FROM job_seeker_save
			join job_seeker on job_seeker.user_id = job_seeker_save.seeker_id
			join job_city on job_city.city_id = job_seeker.city_id
			left  JOIN job_ed 
			on job_seeker.user_id =job_ed.user_id 
			left  JOIN job_ed_type on job_ed_type.edt_id  = job_ed.edt_id 
			left join job_domain on job_domain.domain_id = job_ed.domain_id
			left join job_exp on job_exp.user_id = job_seeker.user_id
			WHERE  (job_ed.end_date) in (select max(job_ed.end_date) 
			from job_seeker, job_ed where  job_ed.user_id = job_seeker.user_id  group by job_seeker.user_id ) 
			and is_active = 0
			and hide_cv = 0
			and block_admin = 0 
			and job_seeker_save.emp_id ='$txt_user_id' 
			GROUP BY job_seeker_save.seeker_id ";
			

$sql.= " LIMIT $start ,$end";
$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
?>
<table id="t01" width="700"  class="tablejob table-bordered">
<tr class="colortop">
<td width="20" colspan="7" >عدد النتائج  <?php echo $sql_result->num_rows ;?></td>
</tr>	
 <tr  class="colortop">
    <th width="50" >الصورة</th>
    <th width="320"  >الأسم</th>
    <th width="120"  >الخبرة</th>
	<th width="80" >
	<!-- المدينة-->	

	   المدينة
	  
	   </th> 
	   <!-- العمر-->
     <th width="100"  >
	
	العمر
	</th> 
	 <th width="80"  >تاريخ التسجيل</th>
	 <th width="80"  >أخر ظهور</th>
  </tr>
<?php
$sql_result =  $mysqli->query($sql) or die ('request "Could not execute SQL query" '.$sql);
if ($sql_result->num_rows >0) {
	while ($row = $sql_result->fetch_assoc()) {
	

?>
  <tr>
    <td><?php 

	$filename="../images/seeker/ll.jpg";
	if($row['image'] !=""){
	$filename = '../images/seeker/'.$row['image']; }	
	?>

<a  href="../view/cvs.php?id=<?php echo $row['user_id']; ?>"><img class='imgview'  src=<?php if($row['image'] !=""){echo $filename;}else {echo "../images/test.jpg";}?> alt="الصورة الشخصية" />  </a></td>
    <td>
	<span class="title">
	<a  href="../view/cvs.php?id=<?php echo $row['user_id']; ?>"><?php echo $row['fname']." ".$row['lname']; ?></a>
	</span>
	<br>
	<span class='textssearch'>
	<?php echo " المجال : ".$row['domain_name'] ;?>
	<br>
	<?php echo " الشهادة : ".$row['edt_name'] ;?>
	<br>
	<?php echo "التخصص : "; if($row['specialty']==''){echo "غير محدد";}{echo $row['specialty'];} ?>
	</span>
	</td>
	
	<td><?php if(($row['sum_exp'] == '') ||($row['sum_exp'] == '0') ){echo "0";}else{ echo $row['sum_exp']." سنة"; }?></td>
	<td><?php echo $row["city_name"]; ?></td>
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
<br/>

</div>  	
</div>
</div>       
<?php
include_once("../inc/footerdown.php");

?>				                    
</body>
</html>