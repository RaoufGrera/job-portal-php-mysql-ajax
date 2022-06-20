<?php
require_once("session.php");
if(!empty($_GET['id'])){
switch  ($_GET['id']){
    
    case "ed":
    require_once('modal_add_ed.php');
    break;
}
}
?>