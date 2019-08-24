<?php  header('Content-Type: text/html; charset=ISO-8859-15');
if ($_POST['idbuscar']=='1')
{
	include "../config.php";
	include "include/funciones.php";
	$idpro    = $_POST['idpro'];
	$idmodulo = ($_POST['modulo']!='null')?$_POST['modulo']:'1400';
	$item     = $_POST['iditems'];
	$pag      = $_POST['idpagina'];

}
else
{
	$idpro    = $_GET['IDpro'];
	$idmodulo = "1400";
	$item     = VAR_NROITEMS;
	$pag      =1;
}
if(isset($_POST['iddel']))
{
	$sql = "DELETE FROM contenidogaleria where ccodgaleria = '".$_POST['iddel']."'";
	db_query($sql);
}


$sql_query = "SELECT *  FROM contenidogaleria WHERE ccodcontenido='".$idpro."' and ccodmodulo='".$idmodulo."'  order by ccodgaleria desc  ";
//echo $sql_query;
$query = db_query($sql_query);
$total = db_num_rows($query);

$numPags = ceil($total/ $item);

if ($pag> $numPags) $pag= $numPags;
if ($pag < 1) $pag = 1;
$reg = ($pag-1) * $item;
$sql = db_query($sql_query  ." LIMIT " .$reg." , ".$item);

?>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td  class='titlehome'  align="right">
			<input type="button" name="new" value="Agregar Fotos"  onclick="javascript:window.location = 'galeriasnew.php?IDpro=<?=$_GET['IDpro']?>'">

        </td>
	</tr>
	<tr >
		<td class='titlehome' >Listado de Galerias</td>
	</tr>
	<tr >
		<td class='colblancohome' >
<?php
	if ($total == 0)
	{
		echo "<tr><td colspan='8' class='colgrishome' align='center' height='420'>No existen items disponibles</td></tr>";
	}
	while($row = db_fetch_array($sql))
	{
		if ($row['ccodmodulo']=="1100")
		{
	?>
			<tr>
                <td class='colblancohome' valign="top" >&nbsp;</td>
				<td class='colblancocen' valign="top" ><?=$row['cnomgaleria']?></td>
				<td class='colgriscen' align="center" width="25"><a href="articuloedit.php?IDpro=<?=$row['ccodgaleria']?>" title='Editar'><img src="estilos/images/wp_editar.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="25"><a  onclick="javascript:elimina('<?=$row['ccodgaleria']?>');" title='Eliminar' style="cursor: pointer;"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>
<?php 	}
	 if ($row['ccodmodulo']=="1400")
	 { ?>

            <div id="galeriafotos">
	            <div class="fotocontenedor1">
								<a id="img" href="<?=$row['cimggaleria']?>">
								   <img src="<?=ereg_replace('fotos','thumbs',$row['cimggaleria'])?>" width="160" height="120" />
							  </a>
								<br />
                <span><?=$row['cnomgaleria']?><br /></span>
                <span>
	                <!--<a href="galeriafotosedit.php?IDpro=<?php //=$row['ccodgaleria']?>"><img border="0" src="estilos/images/wp_editar.gif" alt="Editar Foto"></a>-->
	                <a  onclick="javascript:elimina('<?=$row['ccodgaleria']?>');" title='Eliminar' style="cursor: pointer;"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a>
                 </span>
                 </div>
            </div>

<?php 	}
	}	?>
        </td>
	</tr>
	<tr>
   		<td colspan='4' class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){
	$("#pg").change(function(){
		$.post("articulo_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});

});
</script>
