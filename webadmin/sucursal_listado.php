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
	$pagew    = $_POST['idpage'];
	$_SESSION['page']=$_POST['idpage'];

}
else
{
	$palabra = "";
	$fecha   = "";
	$item    = VAR_NROITEMS;
	$pag      =1;
	$pagew    =$_SESSION['page'];
}
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM pagesucursal WHERE ccodsucursal = '".$_POST['iddel']. "'");
}
if(isset($_POST['idest']))
{
	$sqlest = db_query("SELECT cestsucursal FROM pagesucursal WHERE ccodsucursal='".$_POST['idest']."'");
	$rowest = db_fetch_array($sqlest);
	if ($rowest['cestsucursal']=='1') {
		$sqlup = "UPDATE pagesucursal SET cestsucursal = '0' WHERE ccodsucursal='".$_POST['idest']."'";
	} else {
		$sqlup = "UPDATE pagesucursal SET cestsucursal = '1' WHERE ccodsucursal='".$_POST['idest']."'";
	}
	db_query($sqlup);
}

?>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
		<tr>
			<td class='titlehome'>||</td>
			<td class='titlecen'>Nombre</td>
			<td class='titlecen' width="250">Direcion</td>
			<td class='titlecen' width="180">Pagina</td>
			<td width="52" colspan="2" class='titleend' align="center">Opciones</td>
		</tr>
		<?php
		$row_campo = " ";
		$row_tabla = " ";
		$row_condi = " ";
		$row_query = " ";
		
		if($palabra != '' )
		{
			$row_query .= " and s.cnomsucursal = '".$palabra."'";
		}

		if($fecha != '' )
		{
			$row_query .= " and s.dfecsucursal = '".fechaymd($fecha)."'";
		}
		$sql_query = "SELECT s.*,p.cnompage FROM pagesucursal s, page p where s.ccodpage=p.ccodpage and s.ccodpage='".$pagew."'  ".$row_query." order by s.ccodsucursal desc";
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
				<td colspan='6' class='colblancohome' align='center' height='420'>
					No existen sucursales disponibles
				</td>
			</tr>
        <?php
		}
		else
		{
			$linea =0;;
			while($row = db_fetch_array($sql))
			{
				$linea = $linea + 1;
				if ($row['cestsucursal']=='1')
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
				<td class='colgrishome'  align="center" width="26"><a onclick="javascript:estado('<?=$row['ccodsucursal']?>');" title="<?=$estado_mensaje?>"><img src="<?=$estado_imagen?>"  border="0"/></a> </td>
				<td class='colblancocen' ><?=$row['cnomsucursal']?></td>
				<td class='colblancocen' ><?=$row['cdiroficina']?></td>
				<td class='colblancocen' ><?=$row['cnompage']?></td>
				<td class='colgriscen' align="center" width="25"><a href="sucursal_edit.php?IDpro=<?=$row['ccodsucursal']?>"><img border="0" src="estilos/images/wp_modificar.gif" alt="Editar Sucursal"></a></td>
				<td class='colgrisend' align="center" width="26"><a onclick="javascript:elimina('<?=$row['ccodsucursal']?>');"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>

			<?php
			}
			if ($linea < 15)
			{
				$alturaesp=(15-$linea)*30;
			?>
		<tr>
	   		<td colspan='7' class='colgrishome' height="<?=$alturaesp?>" >&nbsp;</td>
		</tr>

    <?php  }
	}
	?>
	<tr>
   		<td colspan='8' class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){

	$("#pg").change(function(){
		$.post("sucursal_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idpage:$("#selectpage").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});
});


</script>
