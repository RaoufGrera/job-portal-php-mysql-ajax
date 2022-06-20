
	<?php 
	
	require_once("session.php"); //جلب بيانات الجلسة والكويكز
	if($txt_type=='employer'){
		die('دخول غير مسموح');
		}
 ?>


<script type="text/javascript" src="../js/script_add_user.js"  ></script>



		
			<div class="alert  "><strong>أضافة مستخدم جديد</strong></div>
			
			
			
			
			<div class="modal-body">
	
       	<form id="form2" name="form2"  accept-charset="UTF-8"   method="post" >
		
		
				<table class="iteminli" >
				<!-- FIRST NAME -->
					<tr>
						<td>
							<label class="control-label" for="fname">
								الأسم 
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input  id="fname" name="fname" type="text"    placeholder="الأسم"   ></input>
						</td>
						<td>
							<div class="tooltip">
								<span>?</span>
								<div class='content'>
									<b></b>
									<p>أدخال الاسم الشخصي الأول بدون مسافات مثل : أحمد</p>
								</div>
							</div>
						</td>
						<td>
						<span class="fname_val validation"></span>
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
							<input id="lname" name="lname" type="text"  value=""  placeholder="اللقب"  />
						</td>
						<td>
						</td>
						<td>
							<span class="lname_val validation"></span>
						</td>
					
					</tr>

						<tr>
						<td><label class="control-label" for="email">
							البريد الألكتروني
							<span class="req">*</span>
							
						</label>
						</td><td><input id="email" name="email" type="text"   placeholder="البريد الالكتروني"  />
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
								<span class="txt_email_val validation"></span>
								</td>
						</tr>
						
					<!-- PASSWORD -->						
					<tr >
							<td>
								<label class="control-label" for="txt_pass">
								الرقم السري
									<span  class="req">*</span>
								</label>
							</td>
							<td>
								<input id="txt_pass" name="txt_pass" type="password"  value=""  placeholder="الرقم السري"  />
							</td>
							<td>
								<div class="tooltip">
										<span>?</span>
									<div class='content'>
										<b></b>
										<p>يجب أن يتكون الرقم السري من 6 أرقام<br /></p>
									</div>
								</div>
							</td>
							<td>
						<span class="txt_pass_val validation"></span>
						</td>
					</tr>	
				</table>
				<div class ="btns">
					<!--<button name="submit" type="submit" class="btn btn-info">تسجيل</button> !--> 
					<input name="register_comp" type="button" value="تسجيل" class="btn btn-info" > <span class="loading"></span>
				</div>

		
			</fieldset>
		</form>
			
					</div>
  
    </div>
