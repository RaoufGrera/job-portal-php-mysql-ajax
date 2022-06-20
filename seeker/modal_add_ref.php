<div>
	<div class="alert"><strong>أضافة معرف جديد</strong></div>
	<?php
	require_once("session.php"); //جلب بيانات الجلسة والكويكز
	require_once("../db/db.php"); // الأتصال بقاعدة البيانات
	?>
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="insert_ref.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="ref_name">
							الأسم
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="ref_name" name="ref_name" type="text"  maxlength="99" required  />
					</td>
					<td></td>
					<td>
				
					</td>
				</tr>
				<tr>
					<td>
						<label class="control-label" for="ref_adj">
							الصفة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="ref_adj" name="ref_adj" type="text"  maxlength="99" required  />
					</td>
					<td></td>
					<td>
				
					</td>
				</tr>
						<tr>
					<td>
						<label class="control-label" for="ref_email">
							البريد الألكتروني
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="ref_email" name="ref_email" type="text"  maxlength="99"   />
					</td>
					<td></td>
					<td>
				
					</td>
				</tr>	
						<tr>
					<td>
						<label class="control-label" for="ref_phone">
							الهاتف
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="ref_phone" name="ref_phone" type="text"  maxlength="99"   />
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
