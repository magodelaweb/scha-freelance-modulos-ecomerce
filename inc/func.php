<?php
function CodificaTextoLargo($cad){
  $newCad=AgregaDispersores($cad);
  $inv = strrev ($newCad);
  return base64_encode($inv);
}
function CodificaTexto($cad){
  $newCad=AgregaDispersores($cad);
  $inv = strrev ($newCad);
  return base64_encode($inv);
}
function AgregaDispersores($cad){
  $arrCad= str_split($cad);
  $newcad="";
  $disp=true;
  $disp2=true;
  foreach ($arrCad as $value) {
    if($value=="<"){
      $disp=false;
    }
    else if($value==">"){
      $disp=true;
    }
    if($value=="&"){
      $disp2=false;
    }
    else if($value==";"){
      $disp2=true;
    }
    if ($disp&&$disp2){
      $newcad.="$value<x>$value</x>";
    }
    else{
      $newcad.=$value;
    }
  }
  return $newcad;
}
 function CodificaUrlImg($url){
   $inv = strrev ($url);
   return base64_encode($inv);
 }
 function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
 }

 function validVar($variable){
	$var = (get_magic_quotes_gpc()) ? $variable : limpieza1(addslashes($variable));
	$var = preg_replace("/[^0-9a-z\-_,.]+/i", "", $var);
    $var = addslashes(htmlentities($var,ENT_QUOTES));
	return $var;
 }

 function limpieza1($valor) {
    $valor = str_replace('"',"//////",strtolower($valor));
	$valor = str_replace("'","//////",strtolower($valor));
	$valor = str_replace('@',"//////",strtolower($valor));
	$valor = str_replace('or',"//////",strtolower($valor));
	$valor = str_replace('union',"//////",strtolower($valor));
	$valor = str_replace('select',"//////",strtolower($valor));
	$valor = str_replace('%2527',"//////",strtolower($valor));
	$valor = str_replace('%2725',"//////",strtolower($valor));
	$valor = str_replace('%20',"//////",strtolower($valor));
	return $valor;
 }

 function nomMes($mes){
  switch(intval($mes)){
   case 1 : $nombreM = "Enero"; break;
   case 2 : $nombreM = "Febrero"; break;
   case 3 : $nombreM = "Marzo"; break;
   case 4 : $nombreM = "Abril"; break;
   case 5 : $nombreM = "Mayo"; break;
   case 6 : $nombreM = "Junio"; break;
   case 7 : $nombreM = "Julio"; break;
   case 8 : $nombreM = "Agosto"; break;
   case 9 : $nombreM = "Setiembre"; break;
   case 10 : $nombreM = "Octubre"; break;
   case 11 : $nombreM = "Noviembre"; break;
   case 12 : $nombreM = "Diciembre"; break;
  }
  return $nombreM;
 }

 function numFecha($fecha){
  $array1 = explode("-",trim(substr($fecha,0,10)));
  $array2 = explode(":",trim(substr($fecha,11,strlen($fecha))));
  return $array1[0].$array1[1].$array1[2]."~".$array2[0].$array2[1].$array2[2];
 }

 function converFecha($fecha){
  $array = explode("-",$fecha);
  return $array[2]."/".$array[1]."/".$array[0];
 }

 function inverFecha($fecha){
  $array = explode("/",$fecha);
  return $array[2]."-".$array[1]."-".$array[0];
 }

 function escribirFecha($fecha){
  $array = explode("-",$fecha);
  return $array[2]." de ".nomMes($array[1]).", ".$array[0];
 }

 function paginacion($contreg,$pag,$contPag){
  $totnumpag=$contreg/$contPag;
  if($contreg%$contPag!=0) $totnumpag=intval($totnumpag)+1;
  else $totnumpag=intval($totnumpag);
  if($totnumpag==0) $totnumpag=1;
  $numpag=$pag;
  $numreg=$numpag*$contPag;
  $cont=($numpag-1)*$contPag;
  if($numreg>$contreg)$numreg=$contreg;

  $varPaginacion = array(
  						 "contreg" => $contreg,
						 "contpag" => $contPag,
						 "totnumpag" => $totnumpag,
						 "numpag" => $numpag,
						 "numreg" => $numreg,
						 "cont" => $cont
  						);
  return $varPaginacion;
 }

 function print_paginas($numreg,$contreg,$totnumpag,$pag,$url){
  $pagina='<table width="100%" border="0" cellspacing="0" align="right">
           <tr>';
  $pagina.='<td align="right"><p>P&aacute;ginas : ';
			if($contreg>0){
			 $i=1;
			 while($i <= $totnumpag){
			  if(intval($pag)==intval($i)){
			   $pagSel="<span style='color:#fefb03'><b>".$i."</b></span>";
			  }else{
			   $pagSel="".$i."";
			  }
			  if($i!=$numreg && $i!=1) $pagina.=" | ";
			  $pagina.="<a href=".$url."&pag=".$i.">".$pagSel."</a> ";
			  $i++;
			 }
			 $pagina.="&nbsp;";
			}
  $pagina.='</p></td>';
  $pagina.='</tr>
           </table>';
  return $pagina;
 }

 function charset($texto){
  $texto = str_replace("�","&aacute;",$texto);
  $texto = str_replace("�","&eacute;",$texto);
  $texto = str_replace("�","&iacute;",$texto);
  $texto = str_replace("�","&oacute;",$texto);
  $texto = str_replace("�","&uacute;",$texto);
  $textoC = str_replace("�","&ntilde;",$texto);
  return $textoC;
 }

?>
