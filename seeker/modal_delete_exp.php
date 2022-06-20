<div>
	<div class="alert  "><strong>حذف بيانات الخبرة</strong></div>
	<?php
	require_once("session.php"); //جلب بيانات الجلسة والكويكز	
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات	
	$id = $_SESSION['id']=$_GET['id'];
	$results = $mysqli->query("SELECT  exp_id,exp_name,exp_comp
									FROM job_exp
									WHERE job_exp.user_id='$txt_user_id' 
									AND job_exp.exp_id='$id'")or die($mysqli->error());
	if($results->num_rows != 1) {
	die("دخول خاطئ");
	}
	$rows = $results->fetch_object();
	$results->free_result();
	$mysqli->close();
	?>
	<div class="modal-body">
		<form  name="form2"  accept-charset="UTF-8"  action="delete_exp.php" method="POST" >
			<span class='delete_text'><?php echo " هل أنت متأكد من حذف الخبرة "." ". $rows->exp_name." في ". $rows->exp_comp."  ؟"; ?></span> 
			
			<div class ="btninsert">
				<input name="delete_exp" type="submit" value="حفظ" class="btn btn-info"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>		
		</form>
	</div> 
</div> 
   
