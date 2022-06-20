
<div>
	<div class="alert  "><strong>تعديل بيانات الخبرة</strong></div>
	<?php
require_once("session.php"); //جلب بيانات الجلسة والكويكز
require_once("../db/db.php"); // الأتصال بقاعدة البيانات
$id = $_SESSION['id']=$_GET['id'];
$results = $mysqli->query("SELECT * 
								FROM job_exp,job_domain
								WHERE job_domain.domain_id = job_exp.domain_id
								AND job_exp.user_id='$txt_user_id' 
								AND job_exp.exp_id='$id'")or die($mysqli->error());
if($results->num_rows != 1) {
die("دخول خاطئ");
}
$rows = $results->fetch_object();
$results->free_result();
?>
		<div class="modal-body">
			<form  name="form2"  accept-charset="UTF-8"  action="edit_exp.php" method="POST" >
				<table class="iteminli" >				
					<tr>
						<td>
							<label class="control-label" for="exp_comp">
							الشركة
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="exp_comp" name="exp_comp" type="text"  maxlength="150" value="<?php echo $rows->exp_comp;?>"  placeholder="الشركة"  />
						</td>
						<td>
							<div class="tooltip">
								<span>?</span>
								<div class='content'>
									<b></b>
									<p> كتابة اسم الشركة أو المؤسسة</p>
								</div>
							</div>
						</td>
						<td>
							<span class="exp_comp_val validation"></span>
						</td>		
					</tr>
				
					<tr>
						<td>
							<label class="control-label" for="exp_name">
								المسمي الوظيفي
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="exp_name" name="exp_name" type="text"  maxlength="150" value="<?php echo $rows->exp_name;?>" placeholder="المسمي الوظيفي" />
						</td>
					<td></td>
						<td>
						<span class="exp_name_val validation"></span>
						</td>
					</tr>
				
					
					<tr>
						<td>
							<label class="control-label" for="dom_id">
								القطاع
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="dom_id" name="dom_id"  > 
							<option value="0" selected="selected">
							القطاع
							</option>
							<?php  
						$query= "SELECT domain_id,domain_name FROM job_domain";
						$rs = $mysqli->query($query) or die($mysqli->error());
							while ($row =$rs->fetch_object()){
							echo "<option ";
							if($row->domain_id == $rows->domain_id){
									echo " selected ";
									}
							echo "value='".$row->domain_id."'>".$row->domain_name."</option>\n";
							}
							$rs->free_result();
							?>
							</select>
						</td>
						<td></td>
						<td>
						<span class="dom_id_val validation"></span>
						</td>
					</tr>
					
				<tr>
						<td><label class="control-label" for="exp_desc">
							الوصف 
							
							
						</label>
						</td><td>
								<textarea  maxlength="1200" style="max-height:150px; height:100px; min-height:100px;" rows="80" name="exp_desc" id="exp_desc" ><?php echo $rows->exp_desc;?></textarea>
					</td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p> كتابة أهم الأنجازات التي قمت بها خلال العمل بهذه الوظيفة ، أذا لم يكن لديك أنجازات معينة يفضل ترك هذا الحقل فارغاً .</p>
									</div>
								</div>
								</td>
								<td>
								<span class="job_desc_val validation"></span>
								</td>
						</tr>
					<tr>
						<td>
							<label class="control-label" for="start_date_m">
								المدة من
								<?php $time = strtotime($rows->start_date); ?>
								<span  class="req">*</span>
							</label>
						</td>
						
						<td class="day">
				
					<select name="start_date_m"   > 
							<?php
							
							for($i=12;$i>=1;$i--){
							echo "<option ";
							if(date('m',$time) == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="start_date_y"  > 
							<?php
						
							$i = date("Y");
							for($i;$i>=1950;$i--){
							echo "<option ";
							if(date('Y',$time) == $i){
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
						
						</td>
						</tr>
							
<tr>
						<td>
							<label class="control-label" for="end_date_m">
								الي
								<span  class="req">*</span>
							</label>
						</td>
						
						
						<td class="day">
				<?php $time = strtotime($rows->end_date); ?>
					<select name="end_date_m"   > 
						
							<?php
							
							for($i=12 ;$i>=1;$i--){
							echo "<option ";
							if(date('m',$time) == $i){
							echo " selected ";
							}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
							-	
							<select name="end_date_y"  > 
						
							<option value="1" <?php if($rows->state == 1){echo " selected ";} ?>>لحد الأن</option>
							<?php
							$i = date("Y");
							for($i;$i>=1950;$i--){
							echo "<option ";
							if($rows->state == 0){
							if(date('Y',$time) == $i){
							echo " selected ";
							}}
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td>
						</td>
						<td>
						<span class="start_date_val validation"></span>
						</td>
						</tr>							
				</table>

				<div class ="btninsert">
				<input name="insert_exp" type="submit" value="حفظ" class="btn btn-info"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>
		
		
				 </form>
			
					</div><br/>
  
    </div>
<script type="text/javascript" src="../js/script_exp.js"  ></script> 
<?php 
$mysqli->close();
?>