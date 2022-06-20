/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	$("form input[name='insert_edd']").click(function() { // triggred click 
		
		/************** قيم الفورم الذي سنقوم بتحقق من بياناته **************/
		val_holder 		= 0;
		var ed_name 		= jQuery.trim($("form select[name='ed_name']").val()); // first name field
		var dom_name 		= jQuery.trim($("form select[name='dom_name']").val()); // last name field
		var univ 			= jQuery.trim($("form [name='univ']").val()); // first name field
		var specialty 		= jQuery.trim($("form select[name='specialty']").val()); // first name field
		var avg_num 		= jQuery.trim($("form input[name='avg_num']").val()); // email field
		var start_date 		= jQuery.trim($("form select[name='start_date']").val()); // first name 
		var end_date 		= jQuery.trim($("form select[name='end_date']").val()); // first name field
		var arrayavg 		= jQuery.trim($("form select[name='arrayavg']").val()); // first name field

		
		if(ed_name == '0') {
			$("span.ed_name_val").html("يجب تعبئة الحقل . ");
			val_holder = 1;
			}
			else{
			$("span.ed_name_val").html("");
			}
		 
		 if(dom_name == '0') {
			$("span.dom_name_val").html("يجب أختيار قيمة .");
			val_holder = 1;
			}
			else{
			$("span.dom_name_val").html("");
			}
	
		 if(univ=="") {
			$("span.univ_val").html("يجب تعبئة الحقل .");
			val_holder = 1;
			}
			else{
			$("span.univ_val").html("");}
		
			if ((start_date == "من")|| (end_date =="الي")){
			$("span.startend_val").html("يجب تعبئة الحقل . ");
			}
			
			if(start_date >= end_date){
			$("span.startend_val").html("يجب أن يكون تاريخ الأنتهاء أقل من تاريخ البدء . ");
			val_holder = 1;
			}
			else{
			$("span.startend_val").html("");}
				
			
	
		if(val_holder == 1) {
			return false;
		}  
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end