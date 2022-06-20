

	<div>
			<div class="alert  "><strong>تعديل البيانات الشخصية</strong></div>
			<?php
			require_once("session.php"); //جلب بيانات الجلسة والكويكز	

			require_once("../db/db.php"); // الأتصال بقاعدة البيانات

			$results = $mysqli->query("SELECT fname, lname, gender, nat_name, birth_day,city_name,health_status,address
								FROM job_seeker
							left join job_city on job_city.city_id = job_seeker.city_id
							left join job_nat on job_nat.nat_id = job_seeker.nat_id
								WHERE user_id='$txt_user_id' ");
								
			$rows = $results->fetch_object();
			?>

<div class="modal-body">
			<form name="form2"  accept-charset="UTF-8"  action="edit_pe.php" method="POST" >
			
  	
		
				<table >
				<!-- FIRST NAME -->
					
					
					
					<tr class="iteminli">
					
						<td>
							<label class="control-label" for="fname">
								الأسم
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="fname" name="fname" type="text"  value="<?php echo $rows->fname;?>" maxlength="20" tabindex="3" placeholder="الجامعة"  />
						</td>
					<td></td>
						<td>	<span class="fname_val validation"></span>
						</td>
					</tr>
					
						<!-- FIRST NAME -->
								<tr class="iteminli">
						<td>
							<label class="control-label" for="lname">
							اللقب
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="lname" name="lname" type="text"  value="<?php echo $rows->lname;?>" maxlength="20" tabindex="2" placeholder="اللقب"  />
						</td>
						<td>
						</td>
						<td>
							<span class="lname_val validation"></span>
						</td>
					
					</tr>
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="fdate">
								تاريخ الميلاد
								<span  class="req">*</span>
							</label>
						</td>
						
						
						<td class="day">
						<?php $time = strtotime($rows->birth_day);?>
								<select id="fdate" name="fdate"  tabindex="3" > 
							
							<?php
						
							for($i=1;$i<=31;$i++){
							echo "<option ";
							if(date('d',$time) == $i){
							echo " selected " ;
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							- 
							<select  name="fdate1"  > 	
						
							<?php
							
							for($i=1;$i<=12;$i++){
							if(date('m',$time) == $i){
							echo " selected " ;
							}
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-		
							<select name="fdate2"   > 

							<?php
							
							for($i=1930;$i<=2014;$i++){
							echo "<option ";
							if(date("Y",$time) == $i){
							echo " selected " ;
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td>
						</td>
						<td>
						<span class="fdate_val validation"></span>
						</td>
						</tr>
						
					<!-- LAST NAME -->
						<tr class="iteminli">
						<td>
							<label class="control-label" for="Gender">
								الجنس
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="Gender" name="gender" tabindex="1" > 
						
							</option>
							<?php
						$job_gender =  array (
						'm'=>"ذكر",'f'=>"أنثي"
						);
							foreach($job_gender as $key => $value){
							echo "<option ";
							if($rows->gender == $key){
							echo " selected ";
							}
							echo "value=\"$key\">$value</option>\n";
							}
							?>
							</select>
						</td>
					<td></td>
						<td>
						<span class="gender_val validation"></span>
						</td>
					</tr>
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="nat_name">
								الجنسية
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="nat_name" name="nat_name" class="field select medium"  > 
							
							
							</option>
							<?php
						$results = $mysqli->query("SELECT * FROM job_nat");
							while($row = $results->fetch_object()){
							echo "<option ";
							if($rows->nat_name == $row->nat_name){
							echo " selected ";}
							echo "value=\"$row->nat_id\">$row->nat_name</option>\n";
							}
							?>
							</select>
						</td>
					<td></td>
						<td>
						<span class="gender_val validation"></span>
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
							<select id="city" name="city"  > 
						<?php
						$results = $mysqli->query("SELECT * FROM job_city");
							while($row = $results->fetch_object()){
							echo "<option ";
							if($rows->city_name == $row->city_name){
							echo " selected ";}
							echo "value=\"$row->city_id\">$row->city_name</option>\n";
							}
							
							?>
							</select>
						</td>
					<td></td>
						<td>
						<span class="ed_name_val validation"></span>
						</td>
					</tr>
					
					<!-- العنوان -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="address">
							العنوان
							
							
							</label>
						</td>
						<td>
							<input id="address" name="address" type="text"  value="<?php echo $rows->address;?>" maxlength="60" placeholder="العنوان"   />
						</td>
						<td>
						</td>
						<td>
							<span class="address_val validation"></span>
						</td>
					
					</tr>	
					<tr class="iteminli">
						<td>
							<label class="control-label" for="health_status">
							الحالة الصحية
							
							
							</label>
						</td>
						<td>
							<select name="health_status"  >


			<?php
							$health_status =  array (
							'1'=>"سليم",'2'=>"معوق"
							);
							foreach($health_status as $key => $value){
							echo "<option ";
							if($rows->health_status== $key){ echo 'selected="selected"';}
							echo "value=\"$key\">$value</option>\n";
							}
							?>
							 
						</select>
						</td>
						<td>
						</td>
						<td>
							<span class="address_val validation"></span>
						</td>
					
					</tr>	
			
					<!-- college -->
					
	
								
				</table>
				<div class ="btninsert">
				<input name="edit_pe" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 

				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

			
   </form>
    </div>
    </div>
	<?php
	$mysqli->close();
	?>
