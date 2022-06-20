
<div>
	<div class="alert  "><strong>تعديل بيانات الهدف</strong></div>
	<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات

$results = $mysqli->query("SELECT goal_text 
								FROM job_seeker
								WHERE job_seeker.user_id='$txt_user_id' ")or die($mysqli->error());
if($results->num_rows != 1) {
die("دخول خاطئ");
}
$rows = $results->fetch_object();
$results->free_result();
?>
		<div class="modal-body">
			<form  name="form2"  accept-charset="UTF-8"  action="edit_goal.php" method="POST" >
				<table class="iteminli" >				
					
		
					

					
				<tr>
						<td><label class="control-label" for="goal_text">
							الوصف 	
						</label>
						</td><td>
								<textarea  maxlength="2000" style="max-height:150px; height:100px; min-height:100px;"  required rows="80" name="goal_text" id="goal_text" ><?php echo $rows->goal_text;?></textarea>
					</td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p> كتابة أهم الأنجازات التي قمت بها خلال العمل بهذه الوظيفة ، أذا لم يكن لديك أنجازات معينة يفضل ترك هذا الحقل فارغاً .</p>
									</div>
								</div>
								</td>
								<td>

								</td>
						</tr>
					
				</table>

				<div class ="btninsert">
				<input name="insert_exp" type="submit" value="حفظ" class="btn btn-info"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>
		
		
				 </form>
			
					</div><br/>
  
    </div>
<?php 
$mysqli->close();
?>