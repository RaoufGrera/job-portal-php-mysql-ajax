	<div>
		<div class="alert  "><strong>تعديل بيانات الأتصال</strong></div>
		<?php
			require_once("session.php"); //جلب بيانات الجلسة والكويكز	
			require_once("../db/db.php"); // الأتصال بقاعدة البيانات	
			$results = $mysqli->query("SELECT email, phone, address
										FROM job_seeker
										WHERE  user_id ='$txt_user_id' ");						
			$rows = $results->fetch_object();
			?>

			<div class="modal-body">
			<form  name="form2"  accept-charset="UTF-8"  action="edit_co.php" method="POST" >
			
				<table>
				<!-- Email -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="email">
								البريد الألكتروني
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="eamil" name="email" type="text"  value="<?php echo $rows->email;?>" disabled />
						</td>
					<td><div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>لا يمكنك تغيير البريد الألكتروني</p>
									</div>
								</div></td>
						<td>
						</td>
					</tr>
					
						<!-- رقم الهاتف -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="phone">
								رقم الهاتف
							
							</label>
						</td>
						<td>
							<input id="phone" name="phone" type="text"  value="<?php echo $rows->phone;?>" maxlength="20"   placeholder="رقم الهاتف"  />
						
						</td>
					<td></td>
						<td>
						<span class="dom_name_val validation"></span>
						</td>
					</tr>
					<!-- المدينة -->
					
				</table>
				
			<div class ="btninsert">
			<input name="edit_co" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>

			
		</form>
    </div>
    </div>
