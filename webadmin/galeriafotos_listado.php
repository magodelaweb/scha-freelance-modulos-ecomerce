<?php  header('Content-Type: text/html; charset=ISO-8859-15');
if (isset($_POST['idbuscar'])&&($_POST['idbuscar']=='1'))
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
	db_query("DELETE FROM seccioncontenido where ccodcontenido = '".$_POST['iddel']."'");
	db_query("DELETE FROM contenidogaleria where ccodcontenido = '".$_POST['iddel']."'");
	db_query("DELETE FROM contenidoopinion WHERE ccodcontenido = '".$_POST['iddel']. "'");
	db_query("DELETE FROM contenidounidad  WHERE ccodcontenido = '".$_POST['iddel']. "'");
	db_query("DELETE FROM contenidodetalle WHERE ccodcontenido = '".$_POST['iddel']. "'");
	db_query("DELETE FROM contenido WHERE ccodcontenido = '".$_POST['iddel']. "'");
}
if(isset($_POST['idcat']))
{
	$sqlcat = db_query("SELECT ccodcategoria FROM contenido WHERE ccodcontenido='".$_POST['idcat']."'");
	$rowcat = db_fetch_array($sqlcat);
	if ($rowcat['ccodcategoria']=='1') {
		$savecat = "UPDATE contenido SET ccodcategoria = '2' WHERE ccodcontenido='".$_POST['idcat']."'";
	} else {
		$savecat = "UPDATE contenido SET ccodcategoria = '1' WHERE ccodcontenido='".$_POST['idcat']."'";
	}
	db_query($savecat);
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
$sql_query = "SELECT  c.ccodcontenido, c.ccodcategoria,c.dfeccontenido,c.cnomcontenido, c.cestcontenido, c.nviscontenido,c.nnrocomentario,c.ctipcontenido,cimgcontenido FROM contenido c  left join seccioncontenido  s on c.ccodcontenido=s.ccodcontenido WHERE  c.ccodpage= '".$pagew."'   " . $row_query . " and c.ccodmodulo='".$modulo."' group by c.ccodcontenido desc";


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
		<td class='titlehome' >Listado de Fotos</td>
	</tr>
<?php
if ($total == 0)
	{
		echo "<tr><td colspan='8' class='colgrishome' align='center' height='420'>No existen items disponibles</td></tr>";
	}
	else
	{
	?>
	<tr>
		<td class='colgrishome'>
	<?php
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
            <div id="galeriafotos">
	            <div class="fotocontenedor<?=$row['ccodcategoria']?>"><img src="<?=ereg_replace('fotos','thumbs',$row['cimgcontenido'])?>" width="160" height="120" /><br />
                <span><?=$row['cnomcontenido']?><br /></span>
                <span>
	                <a href="galeriafotosedit.php?IDpro=<?=$row['ccodcontenido']?>"><img border="0" src="estilos/images/wp_editar.gif" alt="Editar Foto"></a>
	                <a  onclick="javascript:elimina('<?=$row['ccodcontenido']?>');" title='Eliminar' style="cursor: pointer;"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a>
	                <a  onclick="javascript:categorizar('<?=$row['ccodcontenido']?>');" title='Foto Mural' style="cursor: pointer;"><img src="estilos/images/wp_estrella.gif"  border="0"/></a>
                    <a href="comentarios.php?IDpro=<?=$row['ccodcontenido']?>" title='Comentarios'><img src="estilos/images/wp_comenta.gif"  border="0"/></a>
                 </span>
                 </div>
            </div>
		<?php
		} ?>
		</td>
	</tr>
	<?php 	}	?>
	<tr>
   		<td class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){
	$("#pg").change(function(){
		$.post("galeriafotos_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});

});
</script>
