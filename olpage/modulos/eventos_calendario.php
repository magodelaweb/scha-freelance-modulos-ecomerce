<?php  
if (isset($_POST['idfecha']))
{
	include "../config.php";
	include "../include/juvame.php";
	$fecha =$_POST['idfecha'];
}
else
{
	$fecha = date('d-m-Y');
}
$fechafin  = date("d-m-Y", strtotime( "$fecha + 6 day"));
$fecha2 = date('d-m-Y', strtotime( "$fecha + 1 day"));
$fecha3 = date('d-m-Y', strtotime( "$fecha + 2 day"));
$fecha4 = date('d-m-Y', strtotime( "$fecha + 3 day"));
$fecha5 = date('d-m-Y', strtotime( "$fecha + 4 day"));
$fecha6 = date('d-m-Y', strtotime( "$fecha + 5 day"));
$fecha7 = date('d-m-Y', strtotime( "$fecha + 6 day"));

$anterior  = date('d-m-Y', strtotime( "$fecha - 1 day"));
$siguiente = date('d-m-Y', strtotime( "$fecha + 7 day"));
$dia1 = diasemana($fecha);
echo "
<table border='0'  width='750'  align='center' cellpadding='0' cellspacing='0'  >
	<tr>
    	<td class='title' colspan='8' align='center'> Del ".$fecha." hasta ".$fechafin."</td>
	</tr>
<tr>
    	<td class='titlehome' >Hora</td>
    	<td class='titleend' >".diasemana($fecha)."<br>".$fecha."</td>
    	<td class='titleend' >".diasemana($fecha2)."<br>".$fecha2."</td>
    	<td class='titleend' >".diasemana($fecha3)."<br>".$fecha3."</td>
    	<td class='titleend' >".diasemana($fecha4)."<br>".$fecha4."</td>
    	<td class='titleend' >".diasemana($fecha5)."<br>".$fecha5."</td>
    	<td class='titleend' >".diasemana($fecha6)."<br>".$fecha6."</td>
    	<td class='titleend' >".diasemana($fecha7)."<br>".$fecha7."</td>
	</tr>";
$sqlh=db_query("SELECT * FROM eventoshora order by ccodhora ");
while($rowh=db_fetch_array($sqlh))
{
$sqld1  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha)."' and ccodhora='".$rowh['ccodhora']."' ");
$total1 = db_num_rows($sqld1);
$rowh1  = db_fetch_array($sqld1);
$sqld2  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha2)."' and ccodhora='".$rowh['ccodhora']."' ");
$total2 = db_num_rows($sqld2);
$rowh2  = db_fetch_array($sqld2);
$sqld3  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha3)."' and ccodhora='".$rowh['ccodhora']."' ");
$total3 = db_num_rows($sqld3);
$rowh3  = db_fetch_array($sqld3);
$sqld4  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha4)."' and ccodhora='".$rowh['ccodhora']."' ");
$total4 = db_num_rows($sqld4);
$rowh4  = db_fetch_array($sqld4);
$sqld5  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha5)."' and ccodhora='".$rowh['ccodhora']."' ");
$total5 = db_num_rows($sqld5);
$rowh5  = db_fetch_array($sqld5);

$sqld6  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha6)."' and ccodhora='".$rowh['ccodhora']."' ");
$total6 = db_num_rows($sqld6);
$rowh6  = db_fetch_array($sqld6);

$sqld7  = db_query("SELECT * FROM documentoreserva where dfecreserva ='".fechaymd($fecha7)."' and ccodhora='".$rowh['ccodhora']."' ");
$total7 = db_num_rows($sqld7);
$rowh7  = db_fetch_array($sqld7);

echo "<tr>
    	<td class='colgrishome'  height='30'>".$rowh['cnomhora']."</td>";

	if ($total1=='0')
	{  	
	echo"<td class='colblancocen' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha."'>Disponible</a></td>";
	} else 	{
		if ($rowh1['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh1['cnikreserva']."</td>";
	}
	if ($total2=='0')
	{  	
	echo"<td class='colblancocen' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha2."'>Disponible</a></td>";
	} else {   
		if ($rowh2['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh2['cnikreserva']."</td>";
	}
	if ($total3=='0')
	{  	
	echo"<td class='colblancocen' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha3."'>Disponible</a></td>";
	} else {   
		if ($rowh3['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh3['cnikreserva']."</td>";
	}
	if ($total4=='0')
	{  	
	echo"<td class='colblancocen' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha4."'>Disponible</a></td>";
	} else {   
		if ($rowh4['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh4['cnikreserva']."</td>";
	}
	if ($total5=='0')
	{  	
	echo"<td class='colblancocen' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha5."'>Disponible</a></td>";
	} else {   
		if ($rowh5['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh5['cnikreserva']."</td>";
	}

	if ($total6=='0')
	{  	
	echo"<td class='colblancocen' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha6."'>Disponible</a></td>";
	} else {   
		if ($rowh6['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh6['cnikreserva']."</td>";
	}
	if ($total7=='0')
	{  	
	echo"<td class='colblancoend' ><a href='/pedidos/".$rowh['ccodhora']."-".$fecha7."'>Disponible</a></td>";
	} else {   
		if ($rowh7['cestreserva']=='0')
			echo"<td class='colnaracen' >RESERVADO</td>";
		else
			echo"<td class='colrojocen' >CONFIRMADO<br>".$rowh7['cnikreserva']."</td>";
	}

		
echo"</tr>";
}
echo "</table>";
?>
<input type="hidden" id="inicio" name="inicio" value="<?=$anterior?>">
<input type="hidden" id="final" name="final" value="<?=$siguiente?>">
