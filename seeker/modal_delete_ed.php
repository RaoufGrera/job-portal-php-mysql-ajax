<div>
	<div class="alert  "><strong>حذف بيانات المؤهل العلمي</strong></div>
	<?php
	require_once("session.php"); //جلب بيانات الجلسة والكويكز	
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات	
	$id = $_SESSION['id']=$_GET['id'];
	$results = $mysqli->query("SELECT  edt_name 
									FROM job_ed,job_ed_type
									WHERE job_ed.edt_id = job_ed_type.edt_id
									AND job_ed.user_id='$txt_user_id' 
									AND job_ed.ed_id='$id'")or die($mysqli->error());
	if($results->num_rows != 1) {
	die("دخول خاطئ");
	}
	$rows = $results->fetch_object();
	$results->free_result();
	$mysqli->close();
	?>
	<div class="modal-body">
		<form  name="form2"  accept-charset="UTF-8"  action="delete_ed.php" method="POST" >
			<span class='delete_text'><?php echo " هل أنت متأكد من حذف المستوي التعليمي "." ' ". $rows->edt_name." ' "."  ؟"; ?></span> 
			
			<div class ="btninsert">
				<input name="delete_ed" type="submit" value="حفظ" class="btn btn-info"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>		
		</form>
	</div> 
</div> 
   
