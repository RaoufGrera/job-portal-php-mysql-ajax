<div>
	<div class="alert  "><strong>تعديل بيانات الأتصال للشركة</strong></div>
	<?php
	require_once("session.php"); //جلب بيانات الجلسة والكويكز
	require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات

	$results = $mysqli->query("SELECT url,comp_type_id,address,comp_name,comp_desc,city_id,start_comp,domain_id,phone,email,size_comp
										FROM job_company, job_employer
										WHERE 
										 job_company.comp_id = job_employer.comp_id
										AND job_employer.level = '1'
										AND job_employer.emp_id = '$txt_user_id'
										GROUP BY job_company.comp_id ");
	$rows=$results->fetch_object()
		
	?>
	<div class="modal-body">
	<form id="form2" name="form2"  accept-charset="UTF-8"  action="edit_comp.php" method="POST" >
		<table  class="iteminli">
				<tr>
					<td>
						<label class="control-label" for="comp_name">
							أسم الشركة
							<span  class="req">*</span>
						</label>
					</td>
					<td>
			
						<input type="text" value="<?php echo $rows->comp_name;?>" id="comp_name" name="comp_name" required>
	
					</td>
				<td></td>
					<td>
					
					</td>
				</tr>	
				<tr>
					<td>
						<label class="control-label" for="url">
							الموقع الألكتروني
							
						</label>
					</td>
					<td>
			
						<input type="text" value="<?php echo $rows->url;?>" id="url" name="url" >
	
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
							<label class="control-label" for="phone">
							رقم الهاتف
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="phone" name="phone" type="text"  value="<?php echo $rows->phone;?>" maxlength="20"  placeholder="رقم الهاتف" required />
						</td>
						<td><div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>رقم الهاتف الخاص بالشركة</p>
									</div>
								</div>
						</td>
						<td>
						
						</td>
					
					</tr>
					<tr>
						<td>
							<label class="control-label" for="city_id" >
								المدينة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="city_id" name="city_id" required> 
							
							<?php
							$query= "SELECT city_id,city_name FROM job_city order by city_id";
							$city_rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$city_rs->fetch_object()){
							echo "<option ";
							if($rows->city_id == $row->city_id){
							echo " selected " ;}
							echo "value='".$row->city_id."'>".$row->city_name."</option>\n";
							}
							$city_rs->free_result();
							?>
							
							</select>
						</td>
					<td></td>
						<td>
						
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label" for="domain_id" >
								مجال الشركة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="domain_id" name="domain_id" required> 
							<?php  
						$query= "SELECT domain_id,domain_name FROM job_domain";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =$rs->fetch_object()){
							if($row->domain_id == $rows->domain_id){
							echo " selected ";
							}
							echo "<option ";
							echo "value='".$row->domain_id."'>".$row->domain_name."</option>\n";
							}
							?>
							</select>
						</td>
					<td></td>
						<td>
						
						</td>
					</tr>
					
				
					
	<tr>
						<td>
							<label class="control-label" for="address" >
							العنوان
						
							
							</label>
						</td>
						<td>
							<input id="address" name="address" type="text"  value="<?php echo $rows->address;?>" maxlength="100"  placeholder="العنوان"  />
						</td>
						<td>
						</td>
						<td>
				
						</td>
					
					</tr>

					
					<tr>
						<td>
							<label class="control-label" for="comp_type_id" >
							قطاع الشركة
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
						
						<select id="comp_type_id" name="comp_type_id" required > 
							
						<?php
							$queryy= "SELECT comp_type_id,comp_type_name FROM job_comp_type";
							$type_rs = $mysqli->query($queryy) or die(mysqli_error());
							while ($row =$type_rs->fetch_object()){
							echo "<option ";
							if($rows->comp_type_id == $row->comp_type_id){
							echo " selected ";
							}
							echo "value='".$row->comp_type_id."'>".$row->comp_type_name."</option>\n";}
							$type_rs->free_result();
							?>
							</select>	
						</td>
						<td>
						</td>
						<td>
						
						</td>
					
					</tr>
				 
				
					
						<tr>
						<td>
							<label class="control-label" for="size_comp" >
							حجم الشركة
						
							
							</label>
						</td>
						<td>
							<input id="size_comp" name="size_comp" type="text"  value="<?php echo $rows->size_comp;?>"      />
						</td>
						<td>
						</td>
						<td>
				
						</td>
					
					</tr>
						<td><label class="control-label" for="start_comp">
							سنة التأسيس
		
							
						</label></td><td>
							<select name="start_comp" > 
					
							</option>
							<?php
							$years = date("Y");
							for($i=$years;$i>=1950;$i--){
							if($rows->start_comp == $i){
							echo " selected ";
							}
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</select>
						</td>
						<td>
						</td>
								<td>
					
						</td>
					</tr>
									<tr>
						<td><label class="control-label" for="comp_desc">
							 عن الشركة

						</label>
						</td><td>
			<textarea  maxlength="1200" rows="80" name="comp_desc" id="comp_desc"><?php echo$rows->comp_desc; ?></textarea>
						</select></td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>يجب أدخال البريد الألكتروني الخاص بك تأكد من كتابته بشكل صحيح مثل : exmplemail@mail.com </p>
									</div>
								</div>
								</td>
								<td>
								<span class="job_desc_val validation"></span>
								</td>
						</tr>
					<!-- PASSWORD -->						
								
	
					
					<!-- BIRTH DAY -->
					
				
				</table>
			<div class ="btninsert">
								<input name="insert_comp" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 
		
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

		
   </form>
    </div>
    </div>
