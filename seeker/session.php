<?php
session_start(); 
if( isset($_SESSION['txt_user_id']) || isset($_COOKIE['txt_user_id']) ) {  // if session or cookie is stored, put this in every private page
	// 
} else { // else not stored
header("Location: ../logout.php"); 
	exit();
	}
	
if( isset($_SESSION['txt_user_id'])) {
	if($_SESSION['txt_type'] =='seeker'){
	$txt_user_id	=	$_SESSION['txt_user_id'];
	$txt_type	 	= 	$_SESSION['txt_type'];	
} 
elseif($_COOKIE['txt_user_id']) {
		$txt_user_id = $_COOKIE['txt_user_id'];
			$txt_type	 	= 	$_COOKIE['txt_type'];	

		}
}

?>
