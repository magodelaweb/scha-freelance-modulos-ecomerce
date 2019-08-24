<?php
function addTextWatermark($src, $watermark, $save, $thumbs=false) {
  list($width, $height) = getimagesize($src);
  $image_color = imagecreatetruecolor($width, $height);
  $image = imagecreatefromjpeg($src);
  imagecopyresampled($image_color, $image, 0, 0, 0, 0, $width, $height, $width, $height);
  $txtcolor = imagecolorallocatealpha ($image_color, 255, 255, 255,75);
  $font = dirname(__FILE__) .'/monofont.ttf';
  $font_size = 70; //12 thumbs

  $x=$width/2-350;
  $y=$height-50;
  if ($thumbs){
    $font_size = 12;
    $x=50;
    $y=$height-10;
  }
  imagettftext($image_color, $font_size, 30, $x, $y, $txtcolor, $font, $watermark);
  if ($save<>'') {
    unlink($save);
    imagejpeg ($image_color, $save, 100);
  }
  /*else {
    header('Content-Type: image/jpeg');
    imagejpeg($image_color, null, 100);
  }*/
  imagedestroy($image);
  imagedestroy($image_color);
}
/*************** Funcion Base de datos ****************/
function fechadmy($fecha){
    list($anio,$mes,$dia)=explode("-",$fecha);
    return $dia."-".$mes."-".$anio;
}

function fechaymd($fecha){
    list($dia,$mes,$anio)=explode("-",$fecha);
    return $anio."-".$mes."-".$dia;
}

function codigo_azar($length)
{
    $str = "A1B2C3D4E5F6G7H8I9J0KLMNOPQRSTUVWXYZ";

    for($i=0;$i<$length;$i++)
        $key .= $str[mt_rand(0,strlen($str)-1)];

    return $key;
}


function get_file_extension($filename)
{		preg_match("/(.*)\.([a-zA-Z0-9]{0,5})$/", $filename, $regs);
		return($regs[2]);
}


function tep_redirect($url)
{
	echo "<script language:javascript>";
	echo "window.location.href='".$url."';";
	echo "</script>";
}
function validar_letras($cadena)
{	if(ereg("^[a-zA-Z�������\ ]+$",$cadena))	return true;
	else 								return false;
}

function validar_amigable($cadena)
{	if(ereg("^[a-zA-Z0-9\_\-]+$",$cadena))	return true;
	else 								return false;
}
function validar_fecha($cadena)
{
	$anho= substr($cadena,0,4);
	$mes = substr($cadena,5,2);
	$dia = substr($cadena,8,2);
	if(!ereg("^([0-9]{4})+\-([0-9]{2})+\-([0-9]{2})+$",$cadena))	{	return false;	}
	else	{

		if($anho<1940 || $anho>2007)  {		return false;	}
		else 						  {

	switch ($mes) {
    		case '01':
			        if($dia>=1 && $dia<=31) return true;
					else					 return false;
		    break;
		    case '02':
					if($anho%4==0 && $anho%100!=0 || $anho%400==0)
					{	if($dia>=1 && $dia<=29)	return true;
						else						return false;
					}
					else
					{	if($dia>=1 && $dia<=28)	 return true;
						else					   	  	 return false;
					}
			break;

    		case '03':
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
			break;

			case '04':
        			if($dia>=1 && $dia<=30) return true;
					else					   return false;
			break;

			case '05':
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
	        break;

			case '06':
			        if($dia>=1 && $dia<=30) return true;
					else					   return false;
		    break;

			case '07':
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
		    break;

			case '08':
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
	        break;

			case '09':
	 			   if($dia>=1 && $dia<=30) return true;
				   else					   return false;
	        break;

			case '10':
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
		    break;

			case '11':
        			if($dia>=1 && $dia<=30) return true;
					else					   return false;
		   	break;

			case '12':
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
		    break;
		 	} // switch
		}//else
	 } // else

}


function restaFechas($dFecIni, $dFecFin)
{
	$ano1 = substr($dFecIni,0,4);
	$mes1 = substr($dFecIni,5,2);
	$dia1 = substr($dFecIni,8,2);
	$ano2 = substr($dFecFin,0,4);
	$mes2 = substr($dFecFin,5,2);
	$dia2 = substr($dFecFin,8,2);
	$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
	$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);
	$segundos_diferencia = $timestamp1 - $timestamp2;
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
	$dias_diferencia = abs($dias_diferencia);
	$dias_diferencia = floor($dias_diferencia);
	return($dias_diferencia);
}



function nombre_pais($ubigeo)
{
	$xpais = substr($ubigeo,0,2);
	$xdpto = substr($ubigeo,2,2);
	$xcity = substr($ubigeo,4,4);
	$sqlpais = db_query("SELECT cnomubigeo FROM webubigeo WHERE  ccodubigeo like '".$xpais."%' and cnivubigeo='1' ");
	$rowpais = db_fetch_array($sqlpais);
	if ($xdpto=="00")
	{
		$nompais =	$rowpais['cnomubigeo'];
		return $nompais;
	}
	else
	{
		$sqldpto = db_query("SELECT cnomubigeo FROM webubigeo WHERE  ccodubigeo like '".$xpais.$xdpto."%' and cnivubigeo='2' ");
		$rowdpto = db_fetch_array($sqldpto);
		if ($xcity=="00")
		{
			$nompais = $rowpais['cnomubigeo'].' / '.$rowdpto['cnomubigeo'];
			return $nompais;
		}
		else
		{
			$sqlcity = db_query("SELECT cnomubigeo FROM webubigeo WHERE  ccodubigeo = '".$ubigeo."' ");
			$rowcity = db_fetch_array($sqlcity);
			$nompais = $rowpais['cnomubigeo'].' / '.$rowdpto['cnomubigeo'].' / '.$rowcity['cnomubigeo'];
			return $nompais;
		}
	}
}


function validar_passwd($cadena)
{	if(ereg("^[a-zA-Z0-9]+$",$cadena))	return true;
	else 								return false;
}

function validar_email($address)
{	if(ereg("^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-\.]+$",$address))		return true;
	else		return false;
}
function validar_alfanum($cadena)
{	if(ereg("^[a-zA-Z0-9�������\@\_\,\.\:\ \?\-]+$",$cadena))	return true;
	else 								return false;
}
function validar_direccion($cadena)
{	if(ereg("^[a-zA-Z0-9�������\,\.\ \-]+$",$cadena))	return true;
	else 								return false;
}
function validar_numero($cadena)
{	if(ereg("^[0-9]+$",$cadena))		return true;
	else 							return false;
}
function validar_letrasbd($cadena)
{	if(ereg("^[a-zA-Z0-9\ \/\:]+$",$cadena))		return true;
	else 							return false;
}
function validar_nick($cadena)
{	if(ereg("^[a-zA-Z0-9\_\-]+$",$cadena))		return true;
	else 									return false;
}
function validar_alfanumerico($cadena)
{	if(ereg("^[a-zA-Z0-9\_]+$",$cadena))		return true;
	else 									return false;
}
function validar_cadena($cadena)
{	if(ereg("^[a-zA-Z0-9]+$",$cadena))		return true;
	else 									return false;
}
function validar_color($cadena)
{	if(ereg("^#.[0-9a-zA-Z]+$",$cadena))		return true;
	else 									return false;
}




function validar_web($cadena)
{	if(ereg("^www.[a-zA-Z0-9\/\_\.]+$",$cadena))		return true;
	else 							return false;
}

function validar_pagweb($cadena)
{	if(ereg("^http://[a-zA-Z0-9\/\_\.]+$",$cadena))		return true;
	else 							return false;
}
function validar_inc($cadena)
{	if(ereg("^[a-zA-Z0-9\_\.]+$",$cadena))		return true;
	else 							return false;
}
function validar_enlace($cadena)
{	if(ereg("^http://www.[a-zA-Z0-9\/\_\.]+$",$cadena))		return true;
	else 							return false;
}
function validar_seccion($cadena)
{	if(ereg("^[a-zA-Z�������0-9\ \_]+$",$cadena))	return true;
	else 								return false;
}
function validar_decimal($cadena)
{	if(ereg("^[0-9\.]+$",$cadena))		return true;
	else 							return false;
}

function CalendarioPHP($year, $month)
{
$ColorFondoCelda = '#CCCCCC';
$ColorFondoTabla = '#006699';



//Calculo la fecha actual
$dia_actual=date("j",time());
$mes_actual=date("n",time());
$anio_actual=date("Y",time());

$first_of_month = mktime (0,0,0, $month, 1, $year);
$maxdays = date('t', $first_of_month); #number of days in the month
$date_info = getdate($first_of_month); #get info about the first day of the month
$month = $date_info['mon'];
$year = $date_info['year'];

//Traduzco los meses de ingles a Espa�ol
switch ($date_info['mon'])
{
	case "January" : $date_info[$month]="Enero";break;
	case "February" : $date_info[$month]="Febrero";break;
	case "March" : $date_info[$month]="Marzo";break;
	case "April" : $date_info[$month]="Abril";break;
	case "May" : $date_info[$month]="Mayo";break;
	case "June" : $date_info[$month]="Junio";break;
	case "July" : $date_info[$month]="Julio";break;
	case "August" : $date_info[$month]="Agosto";break;
	case "September": $date_info[$month]="Septiembre";break;
	case "October" : $date_info[$month]="Octubre";break;
	case "November" : $date_info[$month]="Noviembre";break;
	case "December" : $date_info[$month]="Diciembre";break;
};

//Comienzo la tabla que contiene el calendario
$calendar = ("<table border='0' width='245' cellspacing='1' cellpadding='2' bgcolor='#006699'>\n");
$calendar .= "<tr>\n";
$calendar .= "<td height='35' colspan='7' class='maintitle'>".$date_info[month]." - ".$year."</td>\n";
$calendar .= "<tr>\n";
$calendar .= "<td height='30' class='titlemedium'>D</td>\n";
$calendar .= "<td class='titlemedium'>L</td>\n";
$calendar .= "<td class='titlemedium'>M</td>\n";
$calendar .= "<td class='titlemedium'>M</td>\n";
$calendar .= "<td class='titlemedium'>J</td>\n";
$calendar .= "<td class='titlemedium'>V</td>\n";
$calendar .= "<td class='titlemedium'>S</td>\n";
$calendar .= "</tr>\n";

//$weekday = $date_info['wday']-1; //Para que sea el Lunes el primer dia de la semana
$weekday = $date_info['wday'];

$day = 1;
// Los primeros dias "vacios" del mes
if($weekday > 0)
{
	$calendar .= ("<td colspan='".$weekday."'></td>\n");
}

//Imprimimos los dias del mes
while ($day <= $maxdays)
{
	if($weekday == 7)
	{ //Empieza una nueva semana
		$calendar .= "</tr>\n<tr>\n";
		$weekday = 0;
	}
	$colorcelda = "background-color:#EEF2F7;";
	$nvafecha = $year."-".$month."-".$day;
	$sqlfecha = db_query("SELECT * FROM hoteltemporada t, hotelfechas f where t.ccodtemporada = f.ccodtemporada and f.dfechotel='".$nvafecha."'");
	while($rowfecha = db_fetch_array($sqlfecha))
	{
			$colorcelda = "background-color:".$rowfecha['ccoltemporada'].";";
	}


	// Aqui es donde le pongo lo que tiene que hacer en caso de exista enlace
	//$link = (basename($_SERVER["PHP_SELF"]))."?fecha=".$month."/".$day."/".$year;
	$xfecha = $day."-".$month."-".$year;
	$link="javascript:asignartemporada('".$xfecha."')";

	$calendar .= "<td width='50' height=25' align='center' valign='middle' style='".$colorcelda."' ><a href=".$link.">".$day."</a></td>\n";
	$day++;
	$weekday++;
}
	//Cuidadin con los ultimos dias vacios del mes
if($weekday != 7)
{
	$calendar .= '<td colspan="' . (7 - $weekday) . '"></td>';
}
$calendar.="</tr>\n</table>\n";
return $calendar;
}

//Formato $fecha yyyymmdd
function nextDate($fecha,$dias) {
$diaActual = substr($fecha,6,2);
$mesActual = $mesProx = substr($fecha,4,2);
$anioActual = $anioProx = substr($fecha,0,4);
$diaProx = $diaActual + $dias;
$diasMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
if ($diaProx > $diasMes) {
$diaProx = $dias - ($diasMes - $diaActual);
$mesProx = $mesActual + 1;
if ($mesProx > 12) {
$mesProx = "01";
$anioProx = $anioActual + 1;
}
$diasProxMes = cal_days_in_month(CAL_GREGORIAN, $mesProx, $anioProx);
if ($diaProx > $diasProxMes) {
$dias = $diaProx - $diasProxMes;
$diaProx = (strlen($diaProx) == 1)?"0".$diaProx:$diaProx;
$mesProx = (strlen($mesProx) == 1)?"0".$mesProx:$mesProx;
return nextDate($anioProx.$mesProx.$diasProxMes,$dias);
}
}

$diaProx = (strlen($diaProx) == 1)?"0".$diaProx:$diaProx;
$mesProx = (strlen($mesProx) == 1)?"0".$mesProx:$mesProx;
return $anioProx.'-'.$mesProx.'-'.$diaProx;
}

/************* Crear Url  **************/
function crearurl_articulo($articulocod)
{
$codniv1 =substr($articulocod,0,12).'000000000000';
$codniv2 =substr($articulocod,0,16).'00000000';
$codniv3 =substr($articulocod,0,20).'0000';
$codniv4 =substr($articulocod,0,24);
$urlweb .="";
$sqlurl = db_query("SELECT ccodseccion, camiseccion FROM seccion WHERE ccodseccion ='".$codniv1."' or ccodseccion ='".$codniv2."'or ccodseccion ='".$codniv3."'or ccodseccion ='".$codniv4."'");
while($row_url  = db_fetch_array($sqlurl))
{
	$urlweb .= $row_url['camiseccion'].'/';
}
return $urlweb;
}

/************* devuelve el pais desde un Ip  **************/
function getCountry($ip_address){
      $url = "http://ip-to-country.webhosting.info/node/view/36";
      $inici = "src=/flag/?type=2&cc2=";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST,"POST");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "ip_address=$ip_address");

      ob_start();

      curl_exec($ch);
      curl_close($ch);
      $cache = ob_get_contents();
      ob_end_clean();

      $resto = strstr($cache,$inici);
      $pais = substr($resto,strlen($inici),2);

      return $pais;
   }

?>
