<div>
	<div class="alert"><strong>تعديل الهواية</strong></div>
	<?php
		require_once("session.php"); //جلب بيانات الجلسة والكويكز
		require_once("../db/db.php"); // الأتصال بقاعدة البيانات
		$id = $_SESSION['id']=$_GET['id'];
		$results = $mysqli->query("SELECT * 
										FROM job_hobby
										WHERE job_hobby.user_id='$txt_user_id' 
										AND job_hobby.hobby_id='$id'")or die($mysqli->error());
		if($results->num_rows != 1) {
		die("دخول خاطئ");
		}
		$rows = $results->fetch_object();
		$results->free_result();
		?>		
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="edit_hobby.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="hobby_name">
							الهواية
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="hobby_name" name="hobby_name" type="text" value="<?php echo $rows->hobby_name; ?>"  maxlength="99"  placeholder="الهواية"  /></td>
					<td></td>
					<td>
					
					</td>
				</tr>
							
			</table>

			<div class ="btninsert">
				<input name="insert_hobby" type="submit" value="حفظ" class="btn btn-info" /> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>
		</form>
		
	</div>
</div>
<script type="text/javascript" src="../js/script_skilles.js"  ></script>
<?php
$mysqli->close();
?>