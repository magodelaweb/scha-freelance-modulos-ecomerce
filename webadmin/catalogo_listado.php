<?php  header('Content-Type: text/html; charset=ISO-8859-15');
if (isset($_POST['idbuscar'])&& $_POST['idbuscar']=='1')
{
	ob_start();
	session_start();
	include '../config.php';
	include "include/funciones.php";
	$pagew    = $_POST['page'];
	$palabra = $_POST['idpalabra'];
	$codigo  = $_POST['codigo'];
	$fecha   = $_POST['idfecha'];
	$item    = $_POST['iditems'];
	$pag     = $_POST['idpagina'];
	$seccion = $_POST['idseccion'];
	$modulo  = $_POST['modulo'];
	$_SESSION['page']=$_POST['page'];
}
else
{
	$palabra = "";
	$codigo = "";
	$fecha   = "";
	$seccion = "";
	$item    = VAR_NROITEMS;
	$pag     =1;
	$pagew    =$_SESSION['page'];
}
$_SESSION['rutaimages']  = "web/".$_SESSION['page']."/fotos";

if(isset($_POST['iddel']))
{
	db_query("DELETE FROM seccioncontenido where ccodcontenido = '".$_POST['iddel']."'");
	db_query("DELETE FROM contenidogaleria where ccodcontenido = '".$_POST['iddel']."'");
	db_query("DELETE FROM contenidoopinion WHERE ccodcontenido = '".$_POST['iddel']. "'");
	db_query("DELETE FROM contenidodetalle WHERE ccodcontenido = '".$_POST['iddel']. "'");
	db_query("DELETE FROM contenido WHERE ccodcontenido = '".$_POST['iddel']. "'");
}
if(isset($_POST['idest']))
{
	$sqlest = db_query("SELECT cestcontenido FROM contenido WHERE ccodcontenido='".$_POST['idest']."'");
	$rowest = db_fetch_array($sqlest);
	if ($rowest['cestcontenido']=='1') {
		$sqlup = "UPDATE contenido SET cestcontenido = '0' WHERE ccodcontenido='".$_POST['idest']."'";
	} else {
		$sqlup = "UPDATE contenido SET cestcontenido = '1' WHERE ccodcontenido='".$_POST['idest']."'";
	}
	db_query($sqlup);
}

$row_campo = " ";
$row_tabla = " ";
$row_condi = " ";
$row_query = " ";

if($seccion   != '' && $seccion   != 'SS' )
{
	if (strlen($seccion)==24)
		$row_query .= " and s.ccodseccion = '".$seccion."'";
	else
		$row_query .= " and s.ccodseccion like '".$seccion."%'";


}
if($palabra != '' )
{
	$row_query .= " and c.cnomcontenido like '%".$palabra."%'";
}
if($codigo != '' )
{
	$row_query .= " and c.ccodinterno like '%".$codigo."%'";
}

if($fecha != '' )
{
	$row_query .= " and c.dfeccontenido = '".fechaymd($fecha)."'";
}
$sql_query = "SELECT  c.ccodcontenido, c.ccodcategoria,c.dfeccontenido,c.cnomcontenido, c.cestcontenido, c.nviscontenido,c.nnrocomentario,c.ctipcontenido FROM contenido c  left join seccioncontenido  s on c.ccodcontenido=s.ccodcontenido WHERE  c.ccodpage= '".$pagew."'   " . $row_query . " and c.ccodmodulo='".$modulo."' group by c.ccodcontenido desc";

$query = db_query($sql_query);
$total = db_num_rows($query);

$numPags = ceil($total/ $item);

if ($pag> $numPags) $pag= $numPags;
if ($pag < 1) $pag = 1;
$reg = ($pag-1) * $item;
$sql = db_query($sql_query  ." LIMIT " .$reg." , ".$item);

?>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr >
		<td class='titlehome' width="30" align="center" >||</td>
		<td class='titlecen' >Catalogo</td>
		<td class='titlecen' width="150" >Seccion</td>
		<td class='titlecen' width="80" >Visitas</td>
		<td class='titleend'  align="center" colspan="3"  >Opciones</td>
	</tr>
<?php
if ($total == 0)
	{
		echo "<tr><td colspan='9' class='colgrishome' align='center' height='420'>No existen items disponibles</td></tr>";
	}
	else
	{
	$linea =0;;
	while($row = db_fetch_array($sql))
		{
			$linea = $linea + 1;
			$xnomsec="";
			$sqlxsec = db_query("SELECT s.cnomseccion FROM seccion s, seccioncontenido sc  WHERE s.ccodseccion=sc.ccodseccion  and sc.ccodpage= '".$pagew."' and sc.ccodcontenido ='" .$row['ccodcontenido'] . "'");
			//$totalsec= db_num_rows($sqlxsec);
			//if ($totalsec=='0') $xnomsec = "&nbsp;";
			while($rowxsec = db_fetch_array($sqlxsec))
			{
				$xnomsec.= $rowxsec['cnomseccion']."<br>";
			}
			if ($row['cestcontenido']=='1')
			{
				$estado_imagen  ="estilos/images/wp_activado.gif";
				$estado_mensaje ="Activado";
			}
			else
			{
				$estado_imagen  ="estilos/images/wp_noactivado.gif";
				$estado_mensaje ="Desactivado";
			}
			if ($row['ctipcontenido']=='2') $fileedit ='catalogoedit.php';
			if ($row['ctipcontenido']=='9') $fileedit ='enlaceedit.php';

			?>
			<tr>
				<td class='colgrishome' align="center"><a  onclick="javascript:estado('<?=$row['ccodcontenido']?>');" title="<?=$estado_mensaje?>" style="cursor: pointer;"><img src="<?=$estado_imagen?>"  border="0"/></a> </td>
                <td class='colblancocen' valign="top" ><a href="catalogoedit.php?IDpro=<?=$row['ccodcontenido']?>"><?=$row['cnomcontenido']?></a></td>
				<td class='colblancocen' valign="top" ><?=$xnomsec?></td>
                <td class='colblancocen' valign="top"  align="right"><?=$row['nviscontenido']?></td>
				<td class='colgriscen' align="center" width="25"><a href="<?=$fileedit?>?IDpro=<?=$row['ccodcontenido']?>" title='Editar'><img src="estilos/images/wp_editar.gif"  border="0"/></a></td>
				<td class='colgriscen' align="center" width="25"><a href="galerias.php?IDpro=<?=$row['ccodcontenido']?>" title='Galerias'><img src="estilos/images/wp_gallery.gif"  border="0"/></a></td>
				<td class='colgriscen' align="center" width="25"><a  onclick="javascript:elimina('<?=$row['ccodcontenido']?>');" title='Eliminar' style="cursor: pointer;"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>
		<?php
		}
	if ($linea < 14)
	{
		$alturaesp=(14-$linea)*30;
	?>
	<tr>
		<td colspan='7' class='colgrishome' height="<?=$alturaesp?>" >&nbsp;</td>
	</tr>
    <?php  }
	}
	?>
	<tr>
   		<td colspan='7' class='formpie' ><?php
		include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){
	$("#pg").change(function(){
		$.post("catalogo_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});

});
</script>
