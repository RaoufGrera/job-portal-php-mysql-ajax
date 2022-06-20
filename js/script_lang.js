/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	$("form input[name='insert_lang']").click(function() { // triggred click 
		var val_holder=0;
		/************** قيم الفورم الذي سنقوم بتحقق من بياناته **************/

		var lang_id 		= jQuery.trim($("form select[name='lang_id']").val()); // last name field
		var level_id 		= jQuery.trim($("form select[name='level_id']").val()); // last name field
	

		
		if(level_id == "") {
			$("span.level_id_val").html("ييجب أختيار قيمة .");
			val_holder = 1;
			}
			else{
			$("span.level_id_val").html("");
			}
		 
		 if(lang_id == "") {
			$("span.lang_id_val").html("يجب أختيار قيمة .");
			val_holder = 1;
			}
			else{
			$("span.lang_id_val").html("");
			}
	
	
			
			
	
		if(val_holder == 1) {
			return false;
		}  
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end