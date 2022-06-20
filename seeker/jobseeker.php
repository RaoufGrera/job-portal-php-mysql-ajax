
<html>
    <meta charset="UTF-8">
<head>

<title>
تسجيل كباحث عن عمل
</title>
<link rel="icon" type="image/png" href="favicon.png" />
<!-- JavaScript -->
<link href="admin/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="admin/lib/jquery.js" type="text/javascript"></script>
<script src="admin/src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'admin/src/loading.gif',
      closeImage   : 'admin/src/closelabel.png'
    })
  })
</script>
 	<!-- CSS -->
<link rel="stylesheet" href="css/style1.css" type="text/css">
<link href="css/bootstrap1.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/structurep.css" rel="stylesheet">

<link href="css/silder.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/theme.css" type="text/css">
<!--[if IE]>
	<style>
		.item .tooltip .content{ display:none; opacity:1; }
		.item .tooltip:hover .content{ display:block; }
	</style>
	<![endif]-->
		

</head>
    <body>
		<div id="header">
		<div>
			<div id="logo">
				<a href="index.php"><img src="" alt="الشعار" ></a>
			</div>
			
				<ul id="navigation">
				
					<li>
						<a href="" class="hoverbut ">الوظائف</a>
					</li>
					<li>
						<a href="" class="hoverbut">السير الذاتية </a>
					</li>
				
				<li class="mm">|</li>
					
					
					<li class="selected hoverbut" >
						<a href="profile.php"  title=" تسجيل دخول"> الملف الشخصي</a>
					</li>
					<li>
						<a href="logout.php" title="تسجيل الخروج" >خروج</a>
					</li>
				</ul>
		</div>
	</div>

	<p/>
        <div id="container">
         
				<?php include('sidebar_profile.php'); ?>
                <!--/span-->
<div class="span9" >
    <div class="row-fluid"  id="containerr">
					
	<div class="item">
<section>
	<div class="item">		
		<!--<p class="pline"></p>-->
				
		</div>
		
	<div class=" media col-3-4  margin-bottom" >
	<div>		
			
				 <h4><a class="anchor" name="1">السير الذاتية</a></h4>
				
		</div>
		


	
		<table class="tblm table-bordered"  width="700"  >
		  <tr>
		 <th>اسم الباحث</th>
		  <th>الجامعة</th>
		   <th>الكلية</th>
		  <th>التخصص</th>
		   <th>المعدل</th>
		   <th>من</th>
		  <th>الي</th>
		  <th colspan="2">التحكم</th>
		</tr>
                                 <tbody>
                                  <?php 
								  require_once("db/db.php");
								  $user_query=mysqli_query($mysqli,"select fname, ed_id,education_name,domain_name,faculty,univ,tet,avg,end_date,seeker_id from job_ed,job_domain WHERE job_ed.domain_id = job_domain.domain_id   ")or die(mysql_error());
									$resultcount = mysqli_num_rows($user_query);
									while($row=mysqli_fetch_array($user_query)){
										
										$id=$row['ed_id'];										?>
									<tr>
                                    <td><?php echo $row['fname']; ?></td> 
                     
                                  
                                    <td><?php echo $row['univ']; ?></td> 
									
									  <td><?php echo $row['faculty']; ?></td> 
									    <td><?php echo $row['domain_name']; ?></td> 
									   <td><?php echo $row['avg']; ?></td> 
									   <td><?php echo $row['start_date']; ?></td> 
									    <td><?php echo $row['end_date']; ?></td> 
                                	   <td>
		   
		     <a rel="facebox" data-toggle="modal" href="modal_edit_ed.php?id=<?php echo $id; ?>">تعديل</a>
		   </td>
		    <td>
					<a rel="facebox" data-toggle="modal" href="modal_delete_ed.php?id=<?php echo $id; ?>">حذف</a>
			</td>
			</tr>
			<?php } ?>
                           
                              </tbody>
		</table>
<p>
	  	<?php if ($resultcount <=5){echo "<a rel='facebox' data-toggle='modal'  href='modal_add_user.php' > +أضافة</a> ";}else {echo "<span class='t'>وصلت للحد الأعلي من المؤهلات</span>"; }?>
			
 </div>  	
	 </section>

             
                </div>
        </div>

    </body>

</html>