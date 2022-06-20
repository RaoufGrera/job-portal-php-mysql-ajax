<div>
	<div class="alert"><strong>تعديل التدريب</strong></div>
	<?php
		require_once("session.php"); //جلب بيانات الجلسة والكويكز
		require_once("../db/db.php"); // الأتصال بقاعدة البيانات
		$id = $_SESSION['id']=$_GET['id'];
		$results = $mysqli->query("SELECT * 
										FROM job_train
										WHERE job_train.user_id='$txt_user_id' 
										AND job_train.train_id='$id'")or die($mysqli->error());
		if($results->num_rows != 1) {
		die("دخول خاطئ");
		}
		$rows = $results->fetch_object();
		$results->free_result();
		?>		
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="edit_train.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="train_name">
							اسم التدريب
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="train_name" name="train_name" type="text"  maxlength="99"  value="<?php echo $rows->train_name; ?>" placeholder="اسم التدريب"  />
					</td>
					<td></td>
					<td>
					<span class="train_name_val validation"></span>
					</td>
				</tr>
						<tr>
					<td>
						<label class="control-label" for="train_comp">
							اسم معهد التدريب
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="train_comp" name="train_comp" type="text"  maxlength="99" value="<?php echo $rows->train_comp; ?>" placeholder="اسم المعهد التدريب"  />
					</td>
					<td></td>
					<td>
					<span class="train_comp_val validation"></span>
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
<script type="text/javascript" src="../js/script_skilles.js"  ></script>