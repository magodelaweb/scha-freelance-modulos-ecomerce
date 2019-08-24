<?php
/*************************************/
//session_start();
if ($_SESSION['webuser_aut']!='1') {
	session_destroy();
	header ("Location: ./");
    exit;
}
/*************************************/
?>
