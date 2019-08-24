<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idbuscar']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
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
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM seccioncontenido where ccodcontenido = '".$_GET['iddel']."'");
	db_query("DELETE FROM contenidogaleria where ccodcontenido = '".$_GET['iddel']."'");
	db_query("DELETE FROM contenidoopinion WHERE ccodcontenido = '".$_POST['iddel']. "'");
	db_query("DELETE FROM contenidounidad WHERE ccodcontenido = '".$_POST['iddel']. "'");
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

if($seccion   != '' && $seccion   != 'SS' ) 
{
	$row_campo  = ", s.ccodseccion";
	$row_tabla  = ", seccioncontenido s";
	$row_condi  = " c.ccodcontenido = s.ccodcontenido  and ";
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
$sql_query = "select * from (SELECT  c.ccodcontenido, c.ccodcategoria,c.dfeccontenido,c.cnomcontenido,crescontenido, c.cestcontenido, c.nviscontenido,c.nnrocomentario ".$row_campo." FROM contenido c ".$row_tabla." WHERE ".$row_condi." c.ccodpage= '".$pagew."' and c.ccodmodulo='".$modulo."'  " . $row_query . " group by c.ccodcontenido ) t order by t.ccodcontenido desc ";
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
		<td class='titlecen' >Video</td>
		<td class='titlecen' width="180" >Seccion</td>
		<td class='titleend'  align="center" colspan="4"  >Opciones</td>
	</tr>
<?php     
if ($total == 0)
	{
		echo "<tr><td colspan='7' class='colgrishome' align='center' height='420'>No existen items disponibles</td></tr>";
	}
	else
	{
	$linea =0;;
	while($row = db_fetch_array($sql))
		{
			$linea = $linea + 1;
			$xnomsec="";
			$sqlxsec = db_query("SELECT s.cnomseccion FROM seccion s, seccioncontenido sc  WHERE s.ccodseccion=sc.ccodseccion and sc.ccodcontenido ='" .$row['ccodcontenido'] . "'");
			$totalsec= db_num_rows($sqlxsec);
			if ($totalsec=='0') $xnomsec = "&nbsp;";
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
			?>
			<tr>
				<td class='colgrishome' align="center"><a  onclick="javascript:estado('<?=$row['ccodcontenido']?>');" title="<?=$estado_mensaje?>" style="cursor: pointer;"><img src="<?=$estado_imagen?>"  border="0"/></a> </td>
                <td class='colblancocen' valign="top" ><a href="videosedit.php?IDpro=<?=$row['ccodcontenido']?>"><?=$row['cnomcontenido']?></a></td>                
				<td class='colblancocen' valign="top" ><?=$xnomsec?></td>
				<td class='colgriscen' align="center" width="25"><a href="videosedit.php?IDpro=<?=$row['ccodcontenido']?>" title='Editar'><img src="estilos/images/wp_editar.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="25"><a href="comentarios.php?IDpro=<?=$row['ccodcontenido']?>" title='Comentarios'><img src="estilos/images/wp_comenta.gif"  border="0"/></a></td>
				<td class='colgriscen' align="center" width="25"><a  onclick="javascript:elimina('<?=$row['ccodcontenido']?>');" title='Eliminar' style="cursor: pointer;"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
				<td class='colgrisend' align="center" width="25"><a href="social.php?IDpro=<?=$row['ccodcontenido']?>" title='Redes Sociales'><img src="estilos/images/wp_social.gif"  border="0"/></a></td>
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
   		<td colspan='7' class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){
	$("#pg").change(function(){
		$.post("videos_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});

});
</script>
