

	<div class="modal" >

		<div class="modal-footer">
			<div class="alert "><strong>تعديل الصورة الشخصية</strong></div>

			<form name="form2"  action="change_pic.php" method="POST"  enctype= "multipart/form-data">
			<div class="modal-body">
  	
		
				<table>
					<tr class="iteminli">
					
						<td>
							<label class="control-label" for="fname">
								الصورة الشخصية
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input type="file" name="fileField" required />
						</td>
					
					</tr>
				</table>
				
			<div class ="btninsert">
			<input type="hidden" name="MAX_FILE_SIZE" value="8005000" /> 
			<input name="change_pic" type="submit" value="حفظ" class="btn btn-info" /> 
		
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

				
   </form></div></div>
   </div>
   
   
   