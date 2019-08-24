<?php
session_start();
if ($_SESSION['webuser_aut']!='1') {
	session_destroy();
	header ("Location: /"); 
    exit; 
}
$bReturnAbsolute=false;


$sBaseVirtual0="/".$_SESSION['rutaimages']; 
$sBase0=$_SESSION['RUTASERVIDOR'].$_SESSION['rutaimages']; //The real path
// echo "<script language='JavaScript'> 
//                 alert('sBase0: : ".$sBase0."'); 
//                 </script>";
$sName0="fotos";


$sBaseVirtual1="";
$sBase1=""; //The real path
$sName1="";

$sBaseVirtual2="";
$sBase2="";
$sName2="";

$sBaseVirtual3="";
$sBase3="";
$sName3="";
?>