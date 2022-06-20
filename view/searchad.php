
<?php
	include('../db/db.php');
	$id=$_GET['id'];

	$results = $mysqli->query("SELECT * FROM job_company,job_employer,doamin_name,type_name WHERE job_type.type_id = job_company.type_id AND job_company.domain_id = job_domain.domain_id and job_company.comp_id = job_employer.comp_id AND job_employer.emp_id='$id' ");
	while($rows=mysqli_fetch_array($results))
	{
?>
<? echo $rows['emp_id'];?>
	
<script type="text/javascript" src="js/email.js"> </script> <!--- include the live jquery library -->
<!--- include the our jquery file  -->
<script type="text/javascript" src="js/script_ed.js"  ></script>
	
	<div id="add_user" class="modal"  >

		<div class="modal-footer">
			<div class="alert  "><strong>تعديل بيانات الأتصال للشركة</strong></div>

			<form id="form2" name="form2"  accept-charset="UTF-8"  action="edit_ed.php?id=<?php  echo $id; ?>" method="POST" >
			<div class="modal-body">
  	
			<fieldset>
		
				<table >
				<!-- FIRST NAME -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="ed_name">
								أسم الشركة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
				
							<input type="text" value="<?php echo $rows['comp_name'];?>" id="ed_name" name="ed_name" disabled>
		
						</td>
					<td></td>
						<td>
						<span class="ed_name_val validation"></span>
						</td>
					</tr>
					
						<!-- FIRST NAME -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="dom_name">
								البريد الألكتروني
								<span  class="req">*</span>
							</label>
						</td>
						<td>
								<input type="text" value="<?php echo $rows['email'];?>" id="email" name="email" disabled>
						</td>
					<td></td>
						<td>
						<span class="dom_name_val validation"></span>
						</td>
					</tr>
					<!-- LAST NAME -->
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="univ">
							رقم الهاتف
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="univ" name="univ" type="text"  value="<?php echo $rows['phone'];?>" maxlength="20" tabindex="3" placeholder="الجامعة"  />
						</td>
						<td><div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>يمكنك كتابة أسم الجامعة او المعهد اوالمدرسة الثانوية</p>
									</div>
								</div>
						</td>
						<td>
							<span class="univ_val validation"></span>
						</td>
					
					</tr>
					<tr class="iteminli">
						<td>
							<label class="control-label" for="city">
								المدينة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="city" name="city" class="field select medium" tabindex="1" > 
							<option value="<?php echo $rows['city'];?>" selected="selected">
							<?php echo $rows['city'];?>
							</option>
							<?php
						$ed_val =  array (
						"الكفرة","سبها","درنه","طبرق","البيضاء","أجدابيا","بنغازي","سرت","زليطن","العزيزية","الخمس","مصراته","الجبل الغربي(جبل نفوسة)","ترهونة","الزاوية","تاجوراء","قصر بن غشير","طرابلس"
						);
							$sizee = count($ed_val);
							for($i=$sizee-1;$i>0;$i--){
							echo "<option ";
							echo "value=\"$ed_val[$i]\">$ed_val[$i]</option>\n";
							}
							?>
							</select>
						</td>
					<td></td>
						<td>
						<span class="ed_name_val validation"></span>
						</td>
					</tr>
					<tr class="iteminli">
						<td>
							<label class="control-label" for="city">
								المدينة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
								<select id="dom_name" name="dom_name" class="field select medium" tabindex="2" > 
							<option value="<?php echo $rows['domain_name']?>" selected="selected">
							<?php echo $rows['domain_name']; ?>
							</option>
							<?php  require_once("../db/db.php");
						$query= "SELECT domain_id,domain_name FROM job_domain";
						$rs = $mysqli->query($query) or die(mysqli_error());
							while ($row =mysqli_fetch_array($rs)){
							echo "<option ";
							echo "value='".$row["domain_id"]."'>".$row["domain_name"]."</option>\n";
							}
							?>
							</select>
						</td>
					<td></td>
						<td>
						<span class="ed_name_val validation"></span>
						</td>
					</tr>
					
					<!-- college -->
					
	<tr class="iteminli">
						<td>
							<label class="control-label" for="faculty">
							العنوان
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="faculty" name="faculty" type="text"  value="<?php echo $rows['address'];?>" maxlength="20" tabindex="4" placeholder="الكلية"  />
						</td>
						<td>
						</td>
						<td>
							<span class="faculty_val validation"></span>
						</td>
					
					</tr>
						
				
						
						<!-- GENDER -->
	
						
					<!-- EMAIL -->
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="tet">
							القطاع
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="tet" name="tet" type="text"  value="<?php echo $rows['job_type'];?>" maxlength="20" tabindex="5" placeholder="التخصص"  />
						</td>
						<td>
						</td>
						<td>
							<span class="lname_val validation"></span>
						</td>
					
					</tr>
					<!-- USER NAME -->
					<tr class="iteminli">
						<td><label class="control-label" for="avg_num">
							سنة التأسيس
							<span class="req">*</span>
							
						</label></td><td>
							<select name="start_date" class="field select medium" tabindex="6" > 
							<option value="0" selected="selected">
					<?php echo $rows['start_comp']; ?>
							</option>
							<?php
							
							for($i=2014;$i>=1950;$i--){
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</select>
						</td>
						<td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>يجب أدخال أسم المستخدم بدون مسافات  مثل : أحمد_سالم </em></p>
									</div>
								</div></td>
								<td>
						<span class="avg_num_val validation"></span>
						</td>
					</tr>
									<tr class="iteminli">
						<td><label class="control-label" for="job_desc">
							 عن الشركة
							<span class="req">*</span>
							
						</label>
						</td><td>
  <textarea  maxlength="1200" rows="80" name="job_desc" id="job_desc"><?php echo$rows['comb_desc']; ?></textarea>
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
								<input name="insert_edd" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 
		
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

				</fieldset>
   </form>
    </div>
    </div>
	<?php
}
?>