<div>
	<div class="alert  "><strong>تعديل بيانات الأتصال للشركة</strong></div>
	<?php
	require_once("session.php"); //جلب بيانات الجلسة والكويكز
	require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

	$results = $mysqli->query("select fname,lname,email,emp_id,comp_name from job_employer,job_company where job_company.comp_id =job_employer.comp_id  and job_employer.emp_id='$txt_user_id' ");
	$rows=$results->fetch_object()
		
	?>
	<div class="modal-body">
	<form id="form2" name="form2"  accept-charset="UTF-8"  action="edit_pe.php" method="POST" >
		<table  class="iteminli">
				<tr>
					<td>
						<label class="control-label" for="ed_name">
							أسم الشركة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
			
						<input type="text" value="<?php echo $rows->comp_name;?>" id="ed_name" name="ed_name" disabled>
	
					</td>
				<td></td>
					<td>
					
					</td>
				</tr>	
					<tr>
						<td>
							<label class="control-label" for="email">
								البريد الألكتروني
								<span  class="req">*</span>
							</label>
						</td>
						<td>
								<input type="text" value="<?php echo $rows->email;?>" id="email" name="email" disabled>
						</td>
					<td></td>
						<td>
					
						</td>
					</tr>
					
					<tr>
						<td>
							<label class="control-label" for="fname">
								الأسم
								<span  class="req">*</span>
							</label>
						</td>
						<td>
								<input type="text" value="<?php echo $rows->fname;?>" id="fname" name="fname" >
						</td>
					<td></td>
						<td>
					
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label" for="lname">
								اللقب
								<span  class="req">*</span>
							</label>
						</td>
						<td>
								<input type="text" value="<?php echo $rows->lname;?>" id="lname" name="lname" >
						</td>
					<td></td>
						<td>
					
						</td>
					</tr>
				
				</table>
			<div class ="btninsert">
								<input name="insert_pe" type="submit" value="حفظ" class="btn btn-info" /> 
		
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

		
   </form>
    </div>
    </div>
