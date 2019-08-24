<?php  header('Content-Type: text/html; charset=ISO-8859-15');
if (isset($_POST['idbuscar'])&& $_POST['idbuscar']=='1')
{
	include "../config.php";
	include "include/funciones.php";
	$documento = $_POST['documento'];
	$nombre    = $_POST['nombre'];
	$correo    = $_POST['correo'];
	$nick    = $_POST['nick'];
	$pais    = $_POST['pais'];

	$fecha   = $_POST['idfecha'];
	$item    = $_POST['iditems'];
	$pag     = $_POST['idpagina'];
	$pagew    = $_POST['page'];
	$_SESSION['page']=$_POST['page'];

}
else
{
	$documento = "";
	$nombre    = "";
	$correo    = "";
	$nick      = "";
	$pais      = "";
	$fecha   = "";
	$item    = VAR_NROITEMS;
	$pag     =1;
	$pagew    =$_SESSION['page'];
}
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM persona WHERE ccodpersona = '".$_POST['iddel']. "'");
}
if(isset($_POST['idest']))
{
	$sqlest = db_query("SELECT cestpersona FROM persona WHERE ccodpersona='".$_POST['idest']."'");
	$rowest = db_fetch_array($sqlest);
	if ($rowest['cestpersona']=='1') {
		$sqlup = "UPDATE persona SET cestpersona = '0' WHERE ccodpersona='".$_POST['idest']."'";
	} else {
		$sqlup = "UPDATE persona SET cestpersona = '1' WHERE ccodpersona='".$_POST['idest']."'";
	}
	db_query($sqlup);
}
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr >
		<td class='titlehome' width="30" align="center" >||</td>
		<td class='titlecen'>Nombre</td>
		<td class='titlecen' width="150" >Ubicacion</td>
		<td class='titlecen' width="150" >Correo Electronico</td>
		<td class='titlecen' width="80" >Telefono</td>
		<td class='titleend' align="center"  colspan="3">Opciones</td>
	</tr>
		<?php

		$cadena        =" ";
		if($documento != '')
		{
			$cadena    .=" and p.cdnipersona='".$documento."' ";
		}
	   if($fecha != '')
		{
	  		$cadena      .=" and p.dfecpersona='".fechaymd($fecha)."'  ";
		}
	   if($nombre != '')
	   {
		    $cadena      .=" and p.cnompersona LIKE '".$nombre."%' ";
	   }
	   if($correo != '')
	   {
		    $cadena      .=" and p.cemapersona LIKE '%".$correo."%'  ";
	   }
	   if($nick != '')
	   {
		    $cadena      .=" and p.cnikpersona LIKE  '".$nick."%'  ";
	   }
	   if($pais!="00000000" && $pais!="")
	   {
	   		$dato         = substr($_POST['pais'],0,2);
			$cadena       .="  and p.ccodubigeo like '".$dato."%' ";
	   }

		$sql_query = "SELECT p.ccodpersona, p.cnompersona, p.cestpersona, p.dfecpersona,p.cemapersona,p.ntelefono FROM persona p, personapage w where p.ccodpersona=w.ccodpersona and w.ccodpage= '".$pagew."' and p.cnivpersona < 8 " . $cadena . " order by p.ccodpersona desc";
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
				<td colspan='8' class='colblancohome' align='center' height='350'>
					No existen Clientes registrados
				</td>
			</tr>
        <?php
		}
		else
		{
			while($row = db_fetch_array($sql))
			{

				if ($row['cestpersona']=='1')
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
				<td class='colgrishome' align="center" width="26"><a href="#"  onclick="javascript:estado('<?=$row['ccodpersona']?>');" title="<?=$estado_mensaje?>"><img src="<?=$estado_imagen?>"  border="0"/></a> </td>
                <td class='colblancocen' ><a href="personasedit.php?IDpro=<?=$row['ccodpersona']?>"><?=$row['cnompersona']?></a></td>
				<td class='colblancocen' valign="top"><?=isset($row['cnomubigeo'])?$row['cnomubigeo']:""?></td>
				<td class='colblancocen' valign="top"><?=$row['cemapersona']?></td>
				<td class='colblancocen' valign="top"><?=$row['ntelefono']?></td>
				<td class='colgriscen' align="center" width="26"><a href="personasedit.php?IDpro=<?=$row['ccodpersona']?>"><img src="estilos/images/wp_modificar.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="26"><a href="personasview.php?IDpro=<?=$row['ccodpersona']?>"><img src="estilos/images/wp_imprimir.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="26"><a href="#" onclick="javascript:elimina('<?=$row['ccodpersona']?>');"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>
			<?php
			}
		}
		?>
	<tr>
   		<td colspan='8' class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){
	$("#pg").change(function(){
		$.post("personas_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),iditems:$("#nroitems").val(),page:$('#selectpage').val(),idfecha:$("#fecha").val(),nombre:$("#nombre").val(),correo:$("#correo").val(),documento:$("#documento").val(),nick:$("#nick").val(),pais:$("#pais").val()},function(data){$("#listado").html(data);})
	});
});

</script>
