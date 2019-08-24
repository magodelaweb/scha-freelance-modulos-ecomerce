<?php  header('Content-Type: text/html; charset=ISO-8859-15');
if (isset($_POST['idbuscar'])&& $_POST['idbuscar']=='1')
{
	ob_start();
	session_start();
	include "../config.php";
	include "include/funciones.php";
	$palabra = $_POST['idpalabra'];
	$fecha   = $_POST['idfecha'];
	$item    = $_POST['iditems'];
	$pag     = $_POST['idpagina'];
	$web     = $_POST['idweb'];
	$_SESSION['page']=$_POST['idweb'];
}
else
{
	$palabra = "";
	$fecha   = "";
	$seccion = "";
	$item    = VAR_NROITEMS;
	$pag     =1;
	$web     =$_SESSION['page'];
}
$_SESSION['rutaimages']  = "web/".$_SESSION['page']."/banners";
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM pagehome where ccodinicio = '".$_POST['iddel']."'");
	db_query("DELETE FROM pagehomedet where ccodinicio = '".$_POST['iddel']."'");
}
if(isset($_POST['idest']))
{
	$sqlest = db_query("SELECT cesthome FROM pagehome WHERE ccodinicio='".$_POST['idest']."'");
	$rowest = db_fetch_array($sqlest);
	if ($rowest['cesthome']=='1') {
		$sqlup = "UPDATE pagehome SET cesthome = '0' WHERE ccodinicio='".$_POST['idest']."'";
	} else {
		$sqlup = "UPDATE pagehome SET cesthome = '1' WHERE ccodinicio='".$_POST['idest']."'";
	}
	db_query($sqlup);
}
$row_campo = " ";
$row_tabla = " ";
$row_condi = " ";
$row_query ="";

if($web  != '' && $web   != 'SS' )
{
	$row_query .= " and h.ccodpage = '".$web."'";
}
if($palabra != '' )
	{
	$row_query .= " and h.cnomhome like '%".$palabra."%'";
	}
if($fecha != '' )
	{
		$row_query .= " and h.dfechome = '".fechaymd($fecha)."'";
	}
$sql_query = "SELECT h.*,p.cnompage FROM pagehome h, page p where h.ccodpage=p.ccodpage ".$row_query ." order by h.cubidestino,h.cordpublica";
$query = db_query($sql_query);
$total = db_num_rows($query);

$numPags = ceil($total/ $item);
if ($pag> $numPags) $pag= $numPags;
$reg = ($pag-1) * $item;
$sql = db_query($sql_query  ." LIMIT " .$reg." , ".$item);
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr >
		<td class='titlehome' width="30" align="center" >||</td>
		<td class='titlecen'>Item</td>
		<td class='titlecen' width="100">Pagina</td>
		<td class='titlecen' width="60" >Tipo</td>
		<td class='titlecen' width="120" >Ubicación</td>
		<td class='titlecen' width="50" >Orden</td>
		<td class='titlecen' width="80" >Tamaño</td>
		<td class='titleend' align="center"  colspan="2">Opciones</td>
	</tr>
<?php
if ($total > 0)
{
	$linea =0;;
	while($row = db_fetch_array($sql))
	{
		$ubica_sql  =db_query("SELECT * FROM webparametros where ccodparametro='0004' and ctipparametro='1' and cvalparametro='".$row['cubidestino']."' ");
		$rowu  = db_fetch_array($ubica_sql);
		$tipo = $row['ctiphome'];
		switch($tipo)
			{
			case  1:
			$tiposec="Imagen";
			break;
			case  2:
			$tiposec="Flash";
			break;
			case  3:
			$tiposec="Html";
			break;
			case  4:
			$tiposec="Items";
			break;
			case  5:
			$tiposec="Slider";
			break;
			case  6:
			$tiposec="Popup";
			break;
			}
		if ($row['cesthome']=='1')
		{
				$estado_imagen  ="estilos/images/wp_activado.gif";
				$estado_mensaje ="Activado";
		}
		else
		{
				$estado_imagen  ="estilos/images/wp_noactivado.gif";
				$estado_mensaje ="Desactivado";
		}
		?>
			<tr>
				<td class='colgrishome' align="center" width="26"><a onclick="javascript:estado('<?=$row['ccodinicio']?>');" title="<?=$estado_mensaje?>"><img src="<?=$estado_imagen?>"  border="0"/></a> </td>
                <td class='colblancocen' ><a href="tablero_edit.php?IDpro=<?=$row['ccodinicio']?>"><?=$row['cnomhome']?></a></td>
                <td class='colblancocen' ><?=$row['cnompage']?></td>
				<td class='colblancocen' ><?=$tiposec?></td>
				<td class='colblancocen' ><?=$rowu['cnomparametro']?></td>
                <td class='colblancocen' ><?=$row['cordpublica']?></td>
                <td class='colblancocen' ><?=$row['nancho']." x ".$row['nalto']?></td>
				<td class='colgriscen' align="center" width="26"><a href="tablero_edit.php?IDpro=<?=$row['ccodinicio']?>"><img src="estilos/images/wp_modificar.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="26"><a onclick="javascript:elimina('<?=$row['ccodinicio']?>');"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>
	<?php
	}
	if ($linea < 15)
	{
		$alturaesp=(15-$linea)*30;
		echo "<tr><td colspan='9' class='colgrishome' height='".$alturaesp."' >&nbsp;</td></tr>";
    }
	echo "<tr><td colspan='9' class='formpie' >";
	include "panel_paginacion.php"; echo "</td></tr>";
}
else
{
	echo"<tr><td colspan='9' class='colgrishome' align='center' height='250'>No existen items disponibles</td></tr>";
}
?>
</table>
<script>
$(document).ready(function(){
	$("#pg").change(function(){
		$.post("tablero_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idweb:$("#selectpage").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});
});
</script>
