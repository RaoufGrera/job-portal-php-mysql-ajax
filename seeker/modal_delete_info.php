<div>
	<div class="alert  "><strong>حذف المعرف</strong></div>
	<?php
	require_once("session.php"); //جلب بيانات الجلسة والكويكز	
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات	
	$id = $_SESSION['id']=$_GET['id'];
	$results = $mysqli->query("SELECT * 
										FROM job_info
										WHERE  job_info.user_id='$txt_user_id' 
										AND job_info.info_id='$id'")or die($mysqli->error());
	if($results->num_rows != 1) {
	die("دخول خاطئ");
	}
	$rows = $results->fetch_object();
	$results->free_result();
	$mysqli->close();
	?>
	<div class="modal-body">
		<form  name="form2"  accept-charset="UTF-8"  action="delete_info.php" method="POST" >
			<span class='delete_text'><?php echo " هل أنت متأكد من حذف المعرف "." ' ". $rows->info_name." ' "."  ؟"; ?></span> 
			
			<div class ="btninsert">
				<input name="delete_info" type="submit" value="حفظ" class="btn btn-info"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>		
		</form>
	</div> 
</div> 