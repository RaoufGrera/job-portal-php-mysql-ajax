<div>
	<div class="alert"><strong>تعديل المهارة</strong></div>
	<?php
		require_once("session.php"); //جلب بيانات الجلسة والكويكز
		require_once("../db/db.php"); // الأتصال بقاعدة البيانات
		$id = $_SESSION['id']=$_GET['id'];
		$results = $mysqli->query("SELECT * 
										FROM job_skilles,job_level
										WHERE job_level.level_id = job_skilles.level_id
										AND job_skilles.user_id='$txt_user_id' 
										AND job_skilles.skilles_id='$id'")or die($mysqli->error());
		if($results->num_rows != 1) {
		die("دخول خاطئ");
		}
		$rows = $results->fetch_object();
		$results->free_result();
		?>		
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="edit_skilles.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="skilles_name">
							المهارة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="skilles_name" name="skilles_name" type="text"  maxlength="60" value="<?php echo $rows->skilles_name; ?>" placeholder="اسم المهارة"  />
					</td>
					<td></td>
					<td>
					<span class="skilles_name_val validation"></span>
					</td>
				</tr>
					<tr>
					<td>
						<label class="control-label" for="level_id">
							المستوي
							<span  class="req">*</span>
						</label>
					</td>
					<td>
						<select id="level_id" name="level_id"  > 
							المستوي
							</option>
							<?php
							$rs = $mysqli->query("SELECT level_name,level_id FROM job_level")or die($mysqli->error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($row->level_id == $rows->level_id){
							echo " selected ";
							}
							echo "value=\"$row->level_id\">$row->level_name</option>\n";
							}
							$rs->free_result();
							$mysqli->close();
							
							?>
							</select>
					</td>
				<td></td>
					<td>
					<span class="level_id_val validation"></span>
					</td>
				</tr>											
			</table>

			<div class ="btninsert">
				<input name="insert_skilles" type="submit" value="حفظ" class="btn btn-info" /> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>
		</form>
		
	</div>
</div>
<script type="text/javascript" src="../js/script_skilles.js"  ></script>