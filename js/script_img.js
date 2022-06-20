/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	
	$("form input[name='insert_edd']").click(function() { // triggred click 
		
		/************** form validation **************/
		val_holder 		= 0;

	
		var fileField 		= jQuery.trim($("form input[name='fileField']").val()); // email field
		

		
		
		if(sizee == '1') {
			$("span.ed_name_val").html("يجب تعبئة الحقل . ");
		val_holder = 1;}
		else{
		$("span.ed_name_val").html("");}
		 
		 if(dom_name == '0') {
			$("span.dom_name_val").html("يجب تعبئة الحقل .");
		val_holder = 1;}
		else{
		$("span.dom_name_val").html("");}
	
		 		if(univ=="") {
		$("span.univ_val").html("يجب أختيار الجنس .");
		val_holder = 1;
		}
		else{
		$("span.univ_val").html("");}
	/*
		 if ((faculty == ""){
			$("span.faculty_val").html("يجب تعبئة الحقل .");
		val_holder = 1;}
		else{
		$("span.faculty_val").html("");}
		
	*/
		
		
		if ((start_date == "من")|| (end_date =="الي")){
			$("span.startend_val").html("يجب تعبئة الحقل . ");
		val_holder = 1;}
		else{
		$("span.startend_val").html("");}
				
	
		
		/*
		if(avg_num == "") {
			$("span.avg_num_val").html("يجب تعبئة الحقل .");
		val_holder = 1;
		}*/
		
	
		if(val_holder == 1) {
			return false;
		}  
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end