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
	$website = $_POST['idweb'];
	$_SESSION['page']=$_POST['idweb'];

}
else
{
	$website = $_SESSION['page'];
	$palabra = "";
	$fecha   = "";
	$item    = VAR_NROITEMS;
	$pag     =1;
}
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM personabuzon where ccodmensaje = '".$_POST['iddel']."'");
}
?>
<form name="form" method="post" action="mibuzon.php">
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborder" >
	<tr>
		<td width="250"class='titlehome'>De</td>
		<td width="250" class='titlecen'>Asunto</td>
		<td width="160" class='titlecen'>Fecha</td>
		<td width="80" colspan="2" class='titleend' align="center">Opciones</td>
	</tr>
		<?php
		$sql_query = "SELECT * FROM personabuzon WHERE ccodpage = '" . $_SESSION['page']."' order by ccodmensaje desc";
		$query = db_query($sql_query);
		$total = db_num_rows($query);
		
		$numPags = ceil($total/ $item);

		if ($pag> $numPags) $pag= $numPags;
		if ($pag < 1) $pag = 1;
		$reg = ($pag-1) * $item;
		$sql = db_query($sql_query  ." LIMIT " .$reg." , ".$item);
	    if ($total=='0')
		{
		?>
			<tr>
				<td colspan='5' class='colgrishome' align='center' height='350'>
					No existen mensajes disponibles
				</td>
			</tr>
        <?php
		}
		else
		{
			while($row = db_fetch_array($sql))
			{
			?>
			<tr>
				<td  height="25" class='colblancohome' valign="top" ><b><?=$row['cnommensaje']?></b></td>
				<td class='colblancocen' ><?=$row['casumensaje']?></td>
				<td class='colgriscen'><?=$row['dfecmensaje']?></td>
				<td class='colgriscen' align="center" width="40"><a href="mibuzon.php?iddelete=<?=$row['ccodmensaje']?>"><img border="0" src="estilos/images/wp_eliminar.gif" alt="Eliminar mensaje" onclick="willSubmit=confirm('&iquest;Esta seguro de eliminar este registro?'); return willSubmit;"></a></td>
				<td class='colgrisend' align="center" width="40"><a href="mibuzon_view.php?codigo=<?=$row['ccodmensaje']?>"><img border="0" src="estilos/images/wp_comenta.gif" alt="ver mensaje"></a></td>
			</tr>
			<?php
			}
		}
		?>

	<tr>
   		<td colspan='5' class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
</form>
<script>
$(document).ready(function(){

	$("#pg").change(function(){
		$.post("mibuzon_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),idweb:$("#selectpage").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});
});


</script>
