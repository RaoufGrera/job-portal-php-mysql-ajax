/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	
	$("form input[name='register']").click(function() { // triggred click 
		
		/************** form validation **************/
		val_holder 		= 0;
		var fname 		= jQuery.trim($("form input[name='fname']").val()); // first name field
		var lname 		= jQuery.trim($("form input[name='lname']").val()); // last name field
		var fdate 		= jQuery.trim($("form select[name='fdate']").val()); // first name field
		var fdate1 		= jQuery.trim($("form select[name='fdate1']").val()); // first name field
		var fdate2 		= jQuery.trim($("form select[name='fdate2']").val()); // first name field
		var gender  	= jQuery.trim($("form input[name='gender']:checked").val());
		var email 		= jQuery.trim($("form input[name='email']").val()); // email field
		var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // reg ex email check	
	
		var txt_pass 		= jQuery.trim($("form input[name='txt_pass']").val()); // first name field
		
		
		if(fname == "") {
			$("span.fname_val").html("يجب تعبئة الحقل . ");
		val_holder = 1;}
		else{
		$("span.fname_val").html("");}
		 
		 if(lname == "") {
			$("span.lname_val").html("يجب تعبئة الحقل .");
		val_holder = 1;}
		else{
		$("span.lname_val").html("");}
		 
		 if ((fdate == '0')||(fdate1 == '0') ||(fdate2 == '0')){
			$("span.fdate_val").html("يجب تعبئة الحقل .");
		val_holder = 1;}
		else{
		$("span.fdate_val").html("");}
		
		if(gender=="") {
		$("span.gender_val").html("يجب أختيار الجنس .");
		val_holder = 1;
		}
		else{
		$("span.gender_val").html("");}
	
	
		if(txt_pass == "") {
			$("span.txt_pass_val").html("يجب تعبئة الحقل . ");
		val_holder = 1;}
		else if(txt_pass.length < 6){
		$("span.txt_pass_val").html("الرقم السري يجب ان يتكون من أكثر  من سته خانات . ");
		}
		else{
		$("span.txt_pass_val").html("");}
				
	
		if(email == "") {
			$("span.txt_email_val").html("يجب تعبئة الحقل .");
		val_holder = 1;
		}
		if(email != "") {
			if(!email_regex.test(email)){ // if invalid email
				$("span.txt_email_val").html("البريد الألكتروني غير صحيح .");
				val_holder = 1;
			} 
		}
	
		if(val_holder == 1) {
			return false;
		}  
		val_holder = 0;
		/************** form validation end **************/
		
		/************** start: email exist function and etc. **************/
		$("span.loading").html("<img src='images/ajax_fb_loader.gif'>");
		$("span.validation").html("");
		
		var datastring = 'fname='+ fname +'&lname='+ lname +'&fdate='+ fdate+'&fdate1='+ fdate1+'&fdate2='+ fdate2+'&email='+ email+'&gender='+ gender+'&txt_pass='+txt_pass; // get data in the form manual
		//var datastring = $('form#mainform').serialize(); // or use serialize

		$.ajax({
					type: "POST", // type
					url: "check_email.php", // request file the 'check_email.php'
					data: datastring, // post the data
					success: function(responseText) { // get the response
						if(responseText == 1) { // if the response is 1
							$("span.txt_email_val").html("<img src='images/invalid.png'/> البريد الألكتروني موجود من قبل الرجاء <a href='login.php'>تسجيل الدخول</a> أو <a href='forgetpass.php'>استعادة كلمة السر</a>");
									$("span.txt_user_val").html("<img src='images/invalid.png'/> أسم المستخدم يستعمله شخص أخر.");
							$("span.loading").html("");
						} else { // else blank response
							if(responseText == "") { 
								$("span.loading").html("<img src='images/correct.png'> قد تم أرسال رسالة تفعيل لبريدك الألكتروني .");
								$("span.validation").html("");
								$("form input[type='text']").val(''); // optional: empty the field after registration
								
								setTimeout(function(){ // deley 
								
								window.location = 'login.php'; // redirect
								
								},2000); // 1,5 sec 
							}
						}
					} // end success
		}); // ajax end
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end