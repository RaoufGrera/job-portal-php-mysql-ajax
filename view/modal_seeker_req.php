
<div>
	<div class="alert  "><strong>التقدم لهذه الوظيفة</strong></div>
	<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
$id = $_SESSION['id']=$_GET['id'];


?>
		<div class="modal-body">
			<form  name="form2"  accept-charset="UTF-8"  action="insert_req.php" method="POST" >
				<table class="iteminli" >				
					
				
					<tr>
						<td>
							<label class="control-label" for="goal_name">
								المسمي الوظيفي
					
							</label>
						</td>
						<td>
						<select name="goal_name">
						<option value="" selected >بدون هدف وظيفي</option>
							<?php
							$rs = $mysqli->query("SELECT * 
								FROM job_seeker,job_goal
								WHERE job_seeker.user_id = job_goal.user_id
								AND job_seeker.user_id='$txt_user_id' ")or die($mysqli->error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							echo "value=\"$row->goal_id\">$row->goal_name</option>\n";
							}
							$rs->free_result();
							$mysqli->close();
							?>
						</select>
					
						</td>
					<td>
													<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>يمكنك أختيار الهدف الوظيفي ليتم عرضه للشركة التي تقدمت لها ، أذا لم تقم بأختيار هدف وظيفي سيتم اظهار السيرة الذاتية فقط بدون الهدف الوظيفي</p>
									</div>
								</div></td>
						<td>

						</td>
					</tr>

					
				</table>

				<div class ="btninsert">
				<input name="desc_req" type="submit" value="تقدم الأن" class="btn btn-info"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>
		
		
				 </form>
			
					</div><br/>
  
    </div>
