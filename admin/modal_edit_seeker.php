
<?php
	include('../db/db.php');
	$id=$_GET['id'];

	$results = $mysqli->query("SELECT * FROM job_seeker,job_city WHERE job_city.city_id= job_seeker.city_id AND user_id='$id' ");
	while($rows=mysqli_fetch_array($results))
	{
?>
<? echo $rows['user_id'];

?>
	

	
	<div id="add_user" class="modal"  >

		<div class="modal-footer">
			<div class="alert  "><strong>تعديل البيانات الشخصية</strong></div>

			<form id="form2" name="form2"  accept-charset="UTF-8"  action="edit_co.php?id=<?php  echo $id; ?>" method="POST" >
			<div class="modal-body">
  	
			<fieldset>
		
				<table >
				<!-- FIRST NAME -->
						<tr class="iteminli">
						<td>
							<label class="control-label" for="email">
								البريد الألكتروني
								
							</label>
						</td>
						<td>
							<span class='labbb'><?php echo $rows['email'];?></span>
						</td>
					<td><div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p>لا يمكنك تغيير البريد الألكتروني</p>
									</div>
								</div></td>
						<td>
						</td>
					</tr>
					
					<tr class="iteminli">
						<td>
							<label class="control-label" for="Gender">
								حالة التفعيل
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="Gender" name="Gender" class="field select medium" tabindex="1" > 
							<?php
						$ed_val =  array (
						"2"=>"حظر","0"=>"مفعل","1"=>"غير مفعل"
						);
							$sizee = count($ed_val);
							for($i=0;$i<=$sizee-1;$i++){
							echo "<option ";
							if( $i == $rows['is_active']){ echo " selected='selected' ";}
							echo "value=\"$ed_val[$i]\">$ed_val[$i]</option>\n";
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
							<label class="control-label" for="fname">
								الأسم
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="fname" name="fname" type="text"  value="<?php echo $rows['fname'];?>" maxlength="20" tabindex="3" placeholder="الجامعة"  />
						</td>
					<td><div class="tooltip">
									
									</div>
								</div></td>
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
							<input id="lname" name="lname" type="text"  value="<?php echo $rows['lname'];?>" maxlength="20" tabindex="2" placeholder="اللقب"  />
						</td>
						<td>
						</td>
						<td>
							<span class="lname_val validation"></span>
						</td>
					
					</tr>
			

					
						<!-- FIRST NAME -->
					<tr class="iteminli">
						<td>
							<label class="control-label" for="phone">
								رقم الهاتف
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="phone" name="phone" type="text"  value="<?php echo $rows['phone'];?>" maxlength="20" tabindex="3" placeholder="الجامعة"  />
						
						</td>
					<td></td>
						<td>
						<span class="dom_name_val validation"></span>
						</td>
					</tr>
					<!-- LAST NAME -->
						<tr class="iteminli">
						<td>
							<label class="control-label" for="city">
								المدينة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="city" name="city" class="field select medium" tabindex="1" > 
					<?php 	
						$queryy= "SELECT city_id,city_name FROM job_city order by city_id";
						$rss = $mysqli->query($queryy) or die(mysqli_error());
							while ($row =mysqli_fetch_array($rss)){
							echo "<option ";
							echo "value='".$row['city_id']."'";
							if ($row['city_id'] == $rows["city_id"]){echo " selected='selected' "; }
							echo " > ".$row["city_name"]."</option>\n";
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
							<label class="control-label" for="address">
							العنوان
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="address" name="address" type="text"  value="<?php echo $rows['address'];?>" maxlength="20" tabindex="3" placeholder="العنوان"  />
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
							<span class="address_val validation"></span>
						</td>
					
					</tr>
					
					<!-- college -->
					
	
								
				</table>
			<div class ="btninsert">
								<input name="edit_co" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 
		
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

				</fieldset>
   </form>
    </div>
    </div>
	<?php
}
?>