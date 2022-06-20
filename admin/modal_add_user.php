	<div class="alert  "><strong>أضافة مستخدم جديد</strong></div>
			
			
			
			
			<div class="modal-body">
	
       	<form id="form2" name="form2" action="insert_user.php" accept-charset="UTF-8"   method="post" >
		
		
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
							<input  id="fname" name="fname" type="text"    placeholder="الأسم"  required ></input>
						</td>
						<td>
							
						</td>
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
							<input id="lname" name="lname" type="text"  value=""  placeholder="اللقب" required />
						</td>
						<td>
						</td>
						<td>

						</td>
					
					</tr>

						<tr>
						<td><label class="control-label" for="email">
							البريد الألكتروني
							<span class="req">*</span>
							
						</label>
						</td><td><input id="email" name="email" type="text"   placeholder="البريد الالكتروني" required />
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
								<input id="txt_pass" name="txt_pass" type="password"  value=""  placeholder="الرقم السري" required />
							</td>
							<td>
								
							</td>
							<td>
		
						</td>
					</tr>	
				</table>
				<div class ="btns">
					<!--<button name="submit" type="submit" class="btn btn-info">تسجيل</button> !--> 
					<input name="register_comp" type="submit" value="تسجيل" class="btn btn-info" > <span class="loading"></span>
				</div>

		

		</form>
			
					</div>
  
    </div>
