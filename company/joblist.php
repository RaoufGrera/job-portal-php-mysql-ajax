<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
	
?>
<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
<head>

<title>
الوظائف المعلن عنها
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
						<a href="../view/searchcvs.php">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
					
					
					<li class="selected " >
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
							<li class="active">
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

			 <div class="item" >		

	 <h4>الأعلانات </h4>
	 		<p class="plinee"><br/>
			<span class="texts">
			بعض التوضيحات
			<br/>
			إذا أنتهت صلاحية الأعلان ولايزال الأعلان مفعل ، تستطيع رؤية طلبات التوظيف
			
			<br/>
			إذا قمت بإلغاء تفعيل الأعلان ، فلن يتم اظهار طلبات توظيف هذا الأعلان
			</span>
		<table class="tblm table-bordered" style="width:700px"  >
		 
		  <col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 100px;">
<col style="width: 70px;">
<col style="width: 70px;">
		 <th>المسمي الوظيفي</th>
		  <th>رقم الوظيفة</th>
		   <th>مرات العرض</th>
		  <th>عدد الطلبات</th>
		  <th>حالة الوظيفة</th>
		  		   <th>بداية الأعلان</th>
		   <th>نهاية الأعلان</th>
		
		  <th colspan="2" >التحكم</th>
	
                                 <tbody>
                                  <?php 
								  $type_active =array(
								  '1'=>"غير مفعله",'0'=>"مفعله"
								  );
								  require_once("../db/db.php");
								  $user_query=$mysqli->query("SELECT job_start,job_description.is_active,job_name,job_description.desc_id,see_it,count(job_seeker_req.seeker_id),fname,lname,job_end,level,job_employer.emp_id,block
									FROM  job_employer
									JOIN job_description
									ON job_employer.emp_id =job_description.emp_id
									LEFT JOIN job_seeker_req
									ON job_seeker_req.desc_id = job_description.desc_id WHERE  job_employer.emp_id='$txt_user_id' group by job_description.desc_id
									ORDER BY job_end DESC")or die('خطاء في التنفيذ');
									$resultcount = $user_query->num_rows;
													while($row=$user_query->fetch_array()){
													$block= $row['block']; 
													$id = $row['desc_id'];		
									
									echo "<tr>";
									echo '<td><a href="../view/job.php?id='.$row['desc_id'].'">'.$row['job_name'].'</a></td>';

									echo "<td>".$row['desc_id']."</td>";
									echo "<td>".$row['see_it']."</td>";
									echo "<td>".$row['count(job_seeker_req.seeker_id)']."</td>"; 
									
									echo "<td>".$type_active[$row['is_active']]."</td>" ;
									echo "<td>".$row['job_start']."</td>" ;
									echo "<td>".$row['job_end']."</td>" ;

									echo "<td>";
									   ?>
		  
		   <a  href='updatejob.php?id=<?php echo $row['desc_id']; ?>'>تعديل</a>
		   </td>
		    <td>
					<a rel='facebox'  href='modal_delete_job.php?id=<?php echo $id; ?>'>حذف</a>
			</td>
			</tr>
			<?php 
			} 
			$user_query->free_result();
			$mysqli->close();
			?>
                           
                              </tbody>
		</table>
<p>
	 <a href='jobpost.php ' > +الأعلان عن وظيفة جديدة</a>
			
 </div>  	

  

			</div>
                    </div>              
                </div>
     
<?php
include_once("../inc/footerdown.php");
?>
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