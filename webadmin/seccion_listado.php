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
$_SESSION['rutaimages']  = "web/".$_SESSION['page']."/fotos";
if(isset($_POST['iddel']))
{
	db_query("DELETE FROM secciondetalle where ccodseccion = '".$_POST['iddel']."'");
	db_query("DELETE FROM seccioncontenido where ccodseccion = '".$_POST['iddel']."'");
	db_query("DELETE FROM seccionmenu where ccodseccion = '".$_POST['iddel']."'");
	db_query("DELETE FROM seccion WHERE ccodseccion = '".$_POST['iddel']. "'");
}
if(isset($_POST['idest']))
{
	$sqlest = db_query("SELECT cestseccion FROM seccion WHERE ccodseccion='".$_POST['idest']."'");
	$rowest = db_fetch_array($sqlest);
	if ($rowest['cestseccion']=='1') {
		$sqlup = "UPDATE seccion SET cestseccion = '0' WHERE ccodseccion='".$_POST['idest']."'";
	} else {
		$sqlup = "UPDATE seccion SET cestseccion = '1' WHERE ccodseccion='".$_POST['idest']."'";
	}
	db_query($sqlup);
}
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr >
		<td class='titlehome' width="30" align="center" >||</td>
		<td class='titlecen'>Seccion</td>
		<td class='titlecen' width="120" >Modulo</td>
		<td class='titlecen' width="70" >Nro Items</td>
		<td class='titlecen' width="70" >Visitas</td>
		<td class='titleend' align="center"  colspan="4">Opciones</td>
	</tr>
		<?php
		$row_campo = " ";
		$row_tabla = " ";
		$row_condi = " ";
		$row_query = " ";
		if($palabra != '' )
		{
			$row_query .= " and s.cnomseccion like '%".$palabra."%'";
		}
		if($fecha != '' )
		{
			$row_query .= " and s.dfecseccion = '".fechaymd($fecha)."'";
		}

		$sql_query = "SELECT s.*,m.cnommodulo FROM  seccion s, webmodulos m where s.ccodpage='".$website."' and  s.ccodmodulo=m.ccodmodulo  " . $row_query . " and s.cnivseccion='1' order by s.cnomseccion";
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
				<td colspan='9' class='colblancohome' align='center' height='420'>
					No existen secciones disponibles
				</td>
			</tr>
        <?php
		}
		else
		{
			$linea =0;;
			while($row = db_fetch_array($sql))
			{
				$codsec= substr($row['ccodseccion'],0,12);
				$linea = $linea + 1;
				if ($row['cestseccion']=='1')
				{
					$estado_imagen  ="estilos/images/wp_activado.gif";
					$estado_mensaje ="Activado";
				}
				else
				{
					$estado_imagen  ="estilos/images/wp_noactivado.gif";
					$estado_mensaje ="Desactivado";
				}
				if ($row['cnivseccion']=='1') $espacio="";
				if ($row['cnivseccion']=='2') $espacio="&nbsp;&nbsp;&nbsp;";
				if ($row['cnivseccion']=='3') $espacio="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				if ($row['cnivseccion']=='4') $espacio="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
			?>
			<tr>
				<td class='colgrishome' align="center"  ><a onclick="javascript:estado('<?=$row['ccodseccion']?>');" title="<?=$estado_mensaje?>"><img src="<?=$estado_imagen?>"  border="0"/></a> </td>
                <td class='colblancocen' valign="top"><?=$espacio?><a href="seccionedit.php?ids=<?=$row['ccodseccion']?>"><b><?=$row['cnomseccion']?></b></a></td>
				<td class='colblancocen' valign="top"><?=$row['cnommodulo']?></td>
				<td class='colblancocen' valign="top"><?=$row['cpagseccion']?></td>
				<td class='colblancocen' valign="top" align="right"><?=$row['nvisseccion']?></td>
				<td class='colgriscen' align="center" width="25" ><a href="seccionedit.php?ids=<?=$row['ccodseccion']?>"><img src="estilos/images/wp_modificar.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="25" ><a href="seccionsubnew.php?ids=<?=$row['ccodseccion']?>"><img src="estilos/images/wp_sub.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="25" ><a href="secciondetalle.php?ids=<?=$row['ccodseccion']?>"><img src="estilos/images/wp_pagina.gif"  border="0"/></a> </td>
				<td class='colgrisend' align="center" width="25" ><a  onclick="javascript:elimina('<?=$row['ccodseccion']?>');" style="cursor: pointer;"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>
			<?php
				$sql2_query = "SELECT s.*,m.cnommodulo FROM  seccion s, webmodulos m where  s.ccodmodulo=m.ccodmodulo and ccodseccion like '" . $codsec . "%' and s.cnivseccion<>'1' order by s.ccodseccion";
				$sql2 = db_query($sql2_query);
				while($row2 = db_fetch_array($sql2))
				{

				$linea = $linea + 1;
				if ($row2['cestseccion']=='1')
				{
					$estado_imagen2  ="estilos/images/wp_activado.gif";
					$estado_mensaje2 ="Activado";
				}
				else
				{
					$estado_imagen2  ="estilos/images/wp_noactivado.gif";
					$estado_mensaje2 ="Desactivado";
				}
				if ($row2['cnivseccion']=='1') $espacio2="";
				if ($row2['cnivseccion']=='2') $espacio2="&nbsp;&nbsp;&nbsp;";
				if ($row2['cnivseccion']=='3') $espacio2="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				if ($row2['cnivseccion']=='4') $espacio2="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
				?>
			<tr>
				<td class='colgrishome' align="center"  ><a onclick="javascript:estado('<?=$row2['ccodseccion']?>');" title="<?=$estado_mensaje2?>"><img src="<?=$estado_imagen2?>"  border="0"/></a> </td>
                <td class='colblancocen' valign="top"><?=$espacio2?><a href="seccionedit.php?ids=<?=$row['ccodseccion']?>"><?=$row2['cnomseccion']?></a></td>
				<td class='colblancocen' valign="top"><?=$row2['cnommodulo']?></td>
				<td class='colblancocen' valign="top"><?=$row2['cpagseccion']?></td>
				<td class='colblancocen' valign="top" align="right"><?=$row2['nvisseccion']?></td>
				<td class='colgriscen' align="center" width="25" ><a href="seccionsubedit.php?ids=<?=$row2['ccodseccion']?>"><img src="estilos/images/wp_modificar.gif"  border="0"/></a> </td>
				<td class='colgriscen' align="center" width="25" >
                <?php  if ($row2['cnivseccion'] < '4')
					{
					?>
	                <a href="seccionsubnew.php?ids=<?=$row2['ccodseccion']?>"><img src="estilos/images/wp_sub.gif"  border="0"/></a>
                    <?php
                      }
					?>

                </td>
				<td class='colgriscen' align="center" width="25" ><a href="secciondetalle.php?ids=<?=$row2['ccodseccion']?>"><img src="estilos/images/wp_pagina.gif"  border="0"/></a> </td>
				<td class='colgrisend' align="center" width="25" ><a  onclick="javascript:elimina('<?=$row2['ccodseccion']?>');"><img src="estilos/images/wp_eliminar.gif"  border="0"/></a></td>
			</tr>

				<?php
				}

			}
			if ($linea < 15)
			{
				$alturaesp=(15-$linea)*30;
			?>
		<tr>
	   		<td colspan='9' class='colgrishome' height="<?=$alturaesp?>" >&nbsp;</td>
		</tr>

    <?php  }
	}
	?>
	<tr>
   		<td colspan='9' class='formpie' ><?php  include "panel_paginacion.php"; ?></td>
	</tr>
</table>
<script>
$(document).ready(function(){

	$("#pg").change(function(){
		$.post("seccion_listado.php",{ idbuscar:'1',idpagina:$("#pg").val(),idweb:$("#selectpage").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),iditems:$("#nroitems").val()},function(data){$("#listado").html(data);})
	});
});


</script>
