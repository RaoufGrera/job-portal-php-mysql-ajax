
<div>
	<div class="alert"><strong>أضافة نوع خبرة</strong></div>
	<div class="modal-body">
		<form name="form2"  accept-charset="UTF-8"  action="insert_explevel.php" method="POST" >
			<table class="iteminli" >
				<tr>
					<td>
						<label class="control-label" for="explevel_name">
							نوع الخبرة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
					<input id="explevel_name" name="explevel_name" type="text" value=""  maxlength="99"  placeholder="نوع الخبرة " required  /></td>
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
