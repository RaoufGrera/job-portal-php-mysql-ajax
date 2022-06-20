
	<div>
		<div class="alert"><strong>تعديل بيانات المؤهل العلمي</strong></div>
		<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
$id = $_SESSION['id']=$_GET['id'];
$results = $mysqli->query("SELECT * 
								FROM job_ed,job_domain,job_ed_type
								WHERE job_ed_type.edt_id = job_ed.edt_id
								AND job_ed.domain_id = job_domain.domain_id
								AND job_ed.user_id='$txt_user_id' 
								AND job_ed.ed_id='$id'")or die($mysqli->error());
if($results->num_rows != 1) {
die("دخول خاطئ");
}
$rows = $results->fetch_object();
$results->free_result();
?>
			<form  name="form2"  accept-charset="UTF-8"  action="edit_ed.php" method="POST" >
				<div class="modal-body">
					<table  class="iteminli">
						<!-- اسم المؤهل العلمي -->
							<tr>
								<td>
									<label class="control-label" for="ed_name">
										المؤهل
										<span  class="req">*</span>
									</label>
								</td>
								<td>
									<select id="ed_name" name="ed_name" > 
									<?php 
									$rss=$mysqli->query("SELECT * FROM job_ed_type");
									while($row = $rss->fetch_object()){
									echo "<option ";
									if($row->edt_name == $rows->edt_name){
									echo " selected ";
									}
									echo "value=\"$row->edt_id\">$row->edt_name</option>\n";
									}
									$rss->free_result();
									?>
									</select>
								</td>
								<td>
								</td>
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
									<select id="dom_name" name="dom_name"  > 
									<?php
									$rss=$mysqli->query("SELECT * FROM job_domain");
									while($row = $rss->fetch_object()){
									echo "<option ";
									if($row->domain_id == $rows->domain_id){
									echo " selected ";
									}
									echo "value=\"$row->domain_id\">$row->domain_name</option>\n";
									}
									$rss->free_result();
									?>
									</select>
								</td>
								<td>
								</td>
								<td>
									<span class="dom_name_val validation"></span>
								</td>
							</tr>
					<!-- المؤسسة أو الجامعة -->
					
							<tr>
							<td>
							<label class="control-label" for="univ">
							الجامعة
							<span  class="req">*</span>

							</label>
							</td>
							<td>
							<input id="univ" name="univ" type="text"  value="<?php echo $rows->univ;?>" maxlength="120"   placeholder=" الجامعة أو المؤسسة التعليمية"  />
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
								
					<!-- التخصص -->
					
					<tr>
						<td>
							<label class="control-label" for="specialty">
							التخصص
							</label>
						</td>
						<td>
							<input id="specialty" name="specialty" type="text"  value="<?php echo $rows->specialty;?>" maxlength="120" placeholder="التخصص"  />
						</td>
						<td>
						</td>
						<td>
							<span class="specialty_val validation"></span>
						</td>
					
					</tr>
					
					<tr >
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
						<input id="avg_num" name="avg_num" type="text" style="width:58px" value="<?php echo $rows->avg;?>" maxlength="5"  placeholder="المعدل"  />
						
						</td>
						<td>
				</td>
								<td>
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
				
					<select name="start_date" > 
							<?php
							
							for($i=2014;$i>=1950;$i--){
							echo "<option ";
							if($rows->start_date == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="end_date"  > 
							<?php
							$y = date("Y") + 8;
							for($i=$y;$i>=1950;$i--){
							echo "<option ";
							if($rows->end_date == $i){
							echo " selected ";
							}
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
								<input name="insert_edd" type="submit" value="حفظ" class="btn btn-info" /> 
		
			<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>

			
   </form>
</div>
<br/>
  
  </div>
<script type="text/javascript" src="../js/script_ed.js"  ></script> 
<?php  
$mysqli->close();
?>