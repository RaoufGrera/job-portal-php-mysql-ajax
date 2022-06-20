<div>
	<div class="alert"><strong>أضافة مرتب</strong></div>
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="insert_salary.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="salary_name">
							المرتب
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="salary_name" name="salary_name" type="text" value=""  maxlength="99"  placeholder="المرتب " required  /></td>
					<td></td>
					<td>
					
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
