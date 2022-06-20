<div>
	<div class="alert"><strong>تعديل المهارة</strong></div>
	<?php
		require_once("session.php"); //جلب بيانات الجلسة والكويكز
		require_once("../db/db.php"); // الأتصال بقاعدة البيانات
		$id = $_SESSION['id']=$_GET['id'];
		$results = $mysqli->query("SELECT * 
										FROM job_cert
										WHERE job_cert.user_id='$txt_user_id' 
										AND job_cert.cert_id='$id'")or die($mysqli->error());
		if($results->num_rows != 1) {
		die("دخول خاطئ");
		}
		$rows = $results->fetch_object();
		$results->free_result();
		?>		
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="edit_cert.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="cert_name">
							الشهادة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="cert_name" name="cert_name" type="text" value="<?php echo $rows->cert_name; ?>"  maxlength="99"  placeholder="اسم الشهادة" required /></td>
					<td></td>
					<td>
					<span class="skilles_name_val validation"></span>
					</td>
				</tr>
							
			</table>

			<div class ="btninsert">
				<input name="insert_cert" type="submit" value="حفظ" class="btn btn-info" /> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>
		</form>
		
	</div>
</div>
<script type="text/javascript" src="../js/script_skilles.js"  ></script>
<?php
$mysqli->close();
?>