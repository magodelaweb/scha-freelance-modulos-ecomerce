<?php
if (!isset($_SESSION['CONTADOR'])) $_SESSION['CONTADOR']='0';
$domain = $_SERVER['HTTP_HOST'];
$domain_parts = explode('.',$domain);
$nropartes = count($domain_parts);
$subdominio = '';
if ($nropartes == 2 )
{ 
	$subdominio = $domain_parts[0].".".$domain_parts[1];
	$midominio  = $domain_parts[0].".".$domain_parts[1];
}
if ($nropartes == 3 )
{
	$midominio  = $domain_parts[1].".".$domain_parts[2];
	if ($domain_parts[0]=="www")
		$subdominio = $domain_parts[1].".".$domain_parts[2];
	else
		$subdominio = $domain_parts[0].".".$domain_parts[1].".".$domain_parts[2];
}
if ($nropartes == 4 )
{
	$midominio  = $domain_parts[1].".".$domain_parts[2].".".$domain_parts[3];
	if ($domain_parts[0]=="www")
		$subdominio = $domain_parts[1].".".$domain_parts[2].".".$domain_parts[3];
	else
		$subdominio = $domain_parts[0].".".$domain_parts[1].".".$domain_parts[2].".".$domain_parts[3];
}
$sqlpagew  = $aclass->consulta("SELECT * FROM  page WHERE camipage='".$subdominio."' and cestpage ='1'");
$nrosub    = $aclass->filas();
if ( $nrosub >0 ){
	$rowpagew    = $aclass->respuesta();
	$codpage     = $rowpagew['ccodpage'];
	$webvisitas  = $rowpagew['nvispage'];
	if ($rowpagew['credpage']<>""){
		$sqlpageweb  = $aclass->consulta("SELECT * FROM  page WHERE ccodpage='".$rowpagew['credpage']."' ");
		$rowpageweb  = $aclass->respuesta();
		$codpage     = $rowpageweb['ccodpage'];
		$webvisitas  = $rowpageweb['nvispage'];
	}
	if ($rowpagew['ctippage']=='2'){
		$sqlpageweb  = $aclass->consulta("SELECT * FROM  page WHERE camipage='".$dominio."' ");
		$rowpageweb  = $aclass->respuesta();
		$logoweb     = $rowpageweb['clogo'];
		$webpie      = $rowpageweb['cpiepage'];
		$webanalytics  = $rowpageweb['canagoogle'];
		$webgooglemaps = $rowpageweb['cmapgoogle'];
	}
}

if  ($_SESSION['CONTADOR']=='0') { 
	if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&   $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ){ 
		$nroip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$nroip = $_SERVER['REMOTE_ADDR'];
	}
	$webvisitas = $webvisitas + 1; 
	$_SESSION['CONTADOR'] ='1';
	if(isset($codpage)){
	 $aclass->consulta("UPDATE page SET nvispage = nvispage + 1 where ccodpage='".$codpage."'");
	 $aclass->consulta("INSERT INTO visitas (ccodpage, ccodvisita, cnroip,dfecvisita) VALUES ('".$codpage."','".$webvisitas."','".$nroip."', NOW())");
	}
}
?>