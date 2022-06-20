/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	$("form input[name='insert_skilles']").click(function() { // الحدث الذي سيتم فيه تنفيذ الدالة
		var val_holder=0;
		/************** قيم الفورم الذي سنقوم بتحقق من بياناته **************/

		var skilles_name 		= jQuery.trim($("form input[name='skilles_name']").val()); // last name field
		var level_id 		= jQuery.trim($("form select[name='level_id']").val()); // last name field
	

		
		if(level_id == "") {
			$("span.level_id_val").html("يجب أختيار قيمة .");
			val_holder = 1;
			}
			else{
			$("span.level_id_val").html("");
			}
		 
		 if(skilles_name == "") {
			$("span.skilles_name_val").html("يجب تعبئة هذا الحقل .");
			val_holder = 1;
			}
			else{
			$("span.skilles_name_val").html("");
			}

		if(val_holder == 1) {
			return false;
		}  
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end