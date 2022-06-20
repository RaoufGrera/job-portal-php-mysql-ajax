<?php
session_start(); 
if( isset($_SESSION['txt_user_id'])) {  
	if($_SESSION['txt_type'] =='admin'){
	$txt_user_id	=	$_SESSION['txt_user_id'];
	$txt_type	 	= 	$_SESSION['txt_type'];	
} 
else { 
header("Location: logout.php"); 
exit();
}
}
else { 
header("Location: logout.php"); 
exit();}
?>