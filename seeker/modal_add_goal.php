<div>
	<div class="alert  "><strong>أضافة هدف جديد</strong></div>
		<?php
			require_once("session.php"); //جلب بيانات الجلسة والكويكز
			require_once("../db/db.php"); // الأتصال بقاعدة البيانات
		?>
		<div class="modal-body">
			<form  name="form2"  accept-charset="UTF-8"  action="insert_goal.php" method="POST" >
				<table class="iteminli" >				

		

				<tr>
						<td><label class="control-label" for="goal_text">
							الهدف الوظيفي
							
							
						</label>
						</td><td>
								<textarea  maxlength="2000" style="max-height:150px; height:100px; min-height:100px;" rows="80" name="goal_text" id="goal_text" required></textarea>
					</td><td>
					<div class="tooltip">
					<span>?</span>
					<div class='content'>
					<b></b>
					<p>يمكنك ذكر الهدف الوظيفي الذي تستطيع تنفيذه</p>
					</div>
					</div>
								</td>
								<td>
								
								</td>
						</tr>
											
				</table>

				<div class ="btninsert">
				<input name="insert_exp" type="submit" value="حفظ" class="btn btn-info" /> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>
		
		
				 </form>
			
					</div><br/>
  
    </div>

<?php  
$mysqli->close();
?>