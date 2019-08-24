<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idbuscar']=='1')
{
	include "../config.php";
	include "include/funciones.php";
	$palabra = $_POST['idpalabra'];
	$fecha   = $_POST['idfecha'];
	$item    = $_POST['iditems'];
	$pag     = $_POST['idpagina'];
	$seccion = $_POST['idseccion'];

}
else
{
	$palabra = "";
	$fecha   = "";
	$seccion = "";
	$item    = VAR_NROITEMS;
	$pag     =1;
}
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM seccioncontenido where ccodcontenido = '".$_GET['iddel']."'");
	db_query("DELETE FROM contenidogaleria where ccodcontenido = '".$_GET['iddel']."'");
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
?>	
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr >
		<td class='titlehome' >Listado de Fotos</td>
	</tr>
		<?php 
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
		if($fecha != '' ) 
		{
			$row_query .= " and c.dfeccontenido = '".fechaymd($fecha)."'";
		}

		$sql_query = "SELECT c.ccodcontenido, c.cimgcontenido,c.ccodcategoria,c.dfeccontenido,c.cnomcontenido,crescontenido, c.cestcontenido, c.nviscontenido,c.nnrocomentario ".$row_campo." FROM contenido c ".$row_tabla." WHERE ".$row_condi." c.ccodmodulo='1400'  " . $row_query . " group by c.ccodcontenido desc";
		$query = db_query($sql_query);
		$total = db_num_rows($query);
		
		$numPags = ceil($total/ $item);
		if ($pag> $numPags) $pag= $numPags;
		$reg = ($pag-1) * $item;
		$sql = db_query($sql_query  ." LIMIT " .$reg." , ".$item);	
		
	    if ($total=='0')
		{
		?>
			<tr>
				<td class='colblancohome' align='center' height='400'>
					No existen fotos disponibles
				</td>
			</tr>
        <?php 
		}
		else
		{
		?>
			<tr>
            <td class='colgrishome'>
        
        <?php 
			while($row = db_fetch_array($sql))
			{
				$xnomsec = "";
				$sqlxsec = db_query("SELECT s.cnomseccion FROM seccion s, seccioncontenido sc  WHERE s.ccodseccion=sc.ccodseccion and sc.ccodcontenido ='" .$row['ccodcontenido'] . "'");
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
	            <div class="fotocontenedor"><img src="<?=$row['cimgcontenido']?>" width="120" /><br />
                <span>
	                <a href="fotos_edit.php?IDpro=<?=$row['id']?>"><img border="0" src="estilos/images/wp_modificar.gif" alt="Editar Foto"></a>
	                <a href="fotos.php?iddelete=<?=$row['id']?>"><img border="0" src="estilos/images/wp_eliminar.gif" alt="Eliminar Foto" onclick="willSubmit=confirm('&iquest;Esta seguro de eliminar este registro?'); return willSubmit;"></a>
                    </span>
                 </div>
            </div>
			<?php 
			} 
			?>
            </td>
            </tr>
		<?php 
		}
		?>
	<tr>
   		<td class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){
	$("#buscar").click(function(){
		$.post("articulos_listado.php",{ idbuscar:'1',idpagina:'1',idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
						   
	$("#pg").change(function(){
		$.post("articulos_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});
});

function elimina(id)
{
	var confirma = confirm('Desea eliminar este articulo?');
	
	if(confirma){
		$.post("articulos_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val(),iddel: id },function(data){$("#listado").html(data);})
	}
}
function estado(id)
{
	$.post("articulos_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val(),idest: id },function(data){$("#listado").html(data);})
}

</script>
