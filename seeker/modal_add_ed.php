<div>
	<div class="alert  "><strong>أضافة مؤهل جديدة</strong></div>
		<?php
			require_once("session.php"); //جلب بيانات الجلسة والكويكز
			require_once("../db/db.php"); // الأتصال بقاعدة البيانات
		?>
		<div class="modal-body">
	<form  name="form2"  accept-charset="UTF-8" action="insert_ed.php"  method="POST" >
			
			
					<table class="iteminli">
						<tr>
							<td>
								<label class="control-label" for="ed_name">
									المؤهل
									<span  class="req">*</span>
								</label>
							</td>
							<td>
								<select id="ed_name" name="ed_name" > 
								<option value="0" selected="selected">
								المؤهل
								</option>
								<?php 
									$rss=$mysqli->query("SELECT * FROM job_ed_type");
									while($row = $rss->fetch_object()){
									echo "<option ";
									echo "value=\"$row->edt_id\">$row->edt_name</option>\n";
									}
									$rss->free_result();
									?>
								</select>
							</td>
							<td></td>
							<td>
								<span class="ed_name_val validation"></span>
							</td>
						</tr>
						<!-- المجال -->
						<tr>
							<td>
								<label class="control-label" for="dom_name">
									المجال
									<span  class="req">*</span>
								</label>
							</td>
							<td>
								<select id="dom_name" name="dom_name" > 
								<option value="0" selected="selected">
								المجال
								</option>
								<?php
									$rss=$mysqli->query("SELECT * FROM job_domain");
									while($row = $rss->fetch_object()){
									echo "<option ";
									
									echo "value=\"$row->domain_id\">$row->domain_name</option>\n";
									}
									$rss->free_result();
								?>
								</select>
							</td>
						<td></td>
							<td>
							<span class="dom_name_val validation"></span>
							</td>
						</tr>
						<!--الجامعة -->
						<tr>
							<td>
								<label class="control-label" for="univ">
								الجامعة
								<span  class="req">*</span>
								
								</label>
							</td>
							<td>
								<input id="univ" name="univ" type="text"  value="" maxlength="120" placeholder="الجامعة"  />
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
						<tr>
							<td>
								<label class="control-label" for="specialty">
								التخصص
								
								</label>
							</td>
							<td>
								<input id="specialty" name="specialty" type="text"  value="" maxlength="120" placeholder="التخصص"  />
							</td>
							<td>
							</td>
							<td>
							
							</td>				
						</tr>
						<tr>
							<td><label class="control-label" for="avg_num">
								المعدل					
							</label></td><td>
							<select name="arrayavg" style="width:180px"  > 
								<?php
								$arrayavg= array(
								"نظام النسبة المئوية 100","من 5","من4"
								);
								foreach($arrayavg as $key => $value){
								echo "<option ";
								echo "value=\"$key\">$value</option>\n";
								}
								?>
								</select>
							<input id="avg_num" name="avg_num" type="text" style="width:58px"  maxlength="5" tabindex="9" placeholder="المعدل"  />
							
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
						
						<tr>
							<td>
								<label class="control-label" for="start_date">
									المدة
									<span  class="req">*</span>
								</label>
							</td>
							
							
							<td class="day">
					
						<select name="start_date" class="field select medium" tabindex="6" > 
								<option value="0" selected="selected">
								من
								</option>
								<?php
								
								for($i=2014;$i>=1950;$i--){
								echo "<option ";
								echo "value=\"$i\">$i</option>\n";
								}
								?>
								</select>
								-	
								<select name="end_date"  > 
								<option value="0" selected="selected">
								إلي
								</option>
								<?php
								$y = date("Y") + 8;
								for($i=$y;$i>=1950;$i--){
								echo "<option ";
								echo "value=\"$i\">$i</option>\n";
								}
								?>
								</select>
							</td>
							<td>
							</td>
							<td>
							<span class="startend_val validation"></span>
							</td>
							</tr>
									
					</table>

			<div class ="btninsert">
				<input name="insert_edd" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
			</div>
	
		</form>	<br/>	



		</div><br/>
  
  </div>
<script type="text/javascript" src="../js/script_ed.js"  ></script> 
<?php  
$mysqli->close();
?>