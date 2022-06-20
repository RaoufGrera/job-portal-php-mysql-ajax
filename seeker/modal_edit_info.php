<div>
	<div class="alert"><strong>تعديل المعرف</strong></div>
	<?php

require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
$id = $_SESSION['id']=$_GET['id'];
$results = $mysqli->query("SELECT * 
								FROM job_info
								WHERE job_info.user_id='$txt_user_id' 
								AND job_info.info_id='$id'")or die($mysqli->error());
if($results->num_rows != 1) {
die("دخول خاطئ");
}
$rows = $results->fetch_object();
	?>
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="edit_info.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="info_name">
							الأسم
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="info_name" name="info_name" type="text" value="<?php echo $rows->info_name; ?>" maxlength="99" required  />
					</td>
					<td></td>
					<td>
				
					</td>
				</tr>
				<tr>
				<td>
						<label class="control-label" for="info_date">
							السنة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<select name="info_date" required>
	
								<?php
								$y = date("Y");
								for($i=$y;$i>=1950;$i--){
								if($i == $rows->info_date){
								echo " selected ";
								}
								echo "<option ";
								echo "value=\"$i\">$i</option>\n";
								}
								?>
					</select>
								</td>
					<td></td>
					<td>
				
					</td>
				</tr>
				
			</table>

			<div class ="btninsert">
				<input name="insert_train" type="submit" value="حفظ" class="btn btn-info" /> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>
		</form>
		
	</div>
</div>
