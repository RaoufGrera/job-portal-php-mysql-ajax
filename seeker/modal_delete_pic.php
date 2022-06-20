<div>
		<div class="alert  "><strong>حذف الصورة الشخصية</strong></div>
		<?php
		require("session.php"); //جلب بيانات الجلسة والكويكز
		?>
		<div class="modal-body">
			<form id="form2" name="form2"  accept-charset="UTF-8"  action="delete_pic.php" method="POST" >
			
					<span class='delete_text'><?php echo " هل أنت متأكد من حذف الصورة  ؟"; ?></span> 
								<div class ="btninsert">
				<input name="delete_pic" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 

				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

				
				</form>
			</div> 
	</div> 