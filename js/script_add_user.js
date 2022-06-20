/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	
	$("form input[name='register_comp']").click(function() { // triggred click 
		
		/************** form validation **************/
		val_holder 		= 0;
		var fname 		= jQuery.trim($("form input[name='fname']").val()); // first name field
		var lname 		= jQuery.trim($("form input[name='lname']").val()); // last name field
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
		 
		
		
		if(txt_pass == "") {
			$("span.txt_pass_val").html("يجب تعبئة الحقل . ");
		val_holder = 1;}
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
		$("span.loading").html("<img src='../images/ajax_fb_loader.gif'>");
		$("span.validation").html("");
		
		var datastring = 'fname='+ fname +'&lname='+ lname +'&email='+ email+'&txt_pass='+txt_pass; // get data in the form manual
		//var datastring = $('form#mainform').serialize(); // or use serialize

		$.ajax({
					type: "POST", // type
					url: "check_email_user.php", // request file the 'check_email.php'
					data: datastring, // post the data
					success: function(responseText) { // get the response
					 if(responseText == 2) { // if the response is 1
							$("span.txt_email_val").html("<img src='../images/invalid.png'/> البريد الألكتروني موجود من قبل الرجاء ");
							$("span.loading").html("");
						} else { // else blank response
							if(responseText == "") { 
								$("span.loading").html("<img src='../images/tick.png'/> قد تم تسجيلك بنجاح");
								$("span.validation").html("");
								$("form input[type='text']").val(''); // optional: empty the field after registration
								
								setTimeout(function(){ // deley 
								
								window.location = 'controluser.php'; // redirect
								
								},500); // 1,5 sec 
							}
						}
					} // end success
		}); // ajax end
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end