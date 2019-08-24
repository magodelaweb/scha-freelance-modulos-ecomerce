<?php  header('Content-Type: text/html; charset=ISO-8859-15');
if (isset($_POST['idopera'])&& $_POST['idopera']=='1')
{
	include "../config.php";
	include "include/funciones.php";
	$codigo  = $_POST['codigo'];
	if ($_POST['idsave']=='1')
	{
		$saveorden = db_query("update seccionmenu set cordmenu='".$_POST['idorden']."' WHERE ccodseccion = '".$_POST['idseccion']."' and ccodmenu='".$_POST['idmenu']."' ");
		if ($_POST['idorden']<= $_POST['idactual'])
		{
			$yorden=$_POST['idorden'];
			$sqlm  = db_query("SELECT * FROM seccionmenu WHERE ccodmenu='".$_POST['idmenu']."' and cordmenu>='".$_POST['idorden']."' and ccodseccion<> '".$_POST['idseccion']."' order by cordmenu ");
			while ($rowm = db_fetch_array($sqlm))
			{
				$yorden = $yorden +1;
				$save_orden = db_query("update seccionmenu set cordmenu='".$yorden."' where ccodseccion='".$rowm['ccodseccion']."' and ccodmenu='".$_POST['idmenu']."'");
			}

		}
		else
		{
			$yorden=0;
			$sqlm  = db_query("SELECT * FROM seccionmenu WHERE ccodmenu='".$_POST['idmenu']."' and cordmenu<='".$_POST['idorden']."' and ccodseccion<> '".$_POST['idseccion']."' order by cordmenu ");
			while ($rowm = db_fetch_array($sqlm))
			{
				$yorden = $yorden +1;
				$save_orden = db_query("update seccionmenu set cordmenu='".$yorden."' where ccodseccion='".$rowm['ccodseccion']."' and ccodmenu='".$_POST['idmenu']."'");
			}

		}
	}

}
else
{
	$codigo = $_SESSION['page'];
}

$sql  = db_query("SELECT * FROM pagemenu WHERE ccodpage = '" . $codigo . "' ");
while ($row = db_fetch_array($sql))
{
?>
<input type="hidden" name="idcodigo" id="idcodigo" value="<?=$codigo?>">
<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborder" >
<tr>
    <td class='titlehome'  colspan="2">Menu : <?=$row['cnommenu']?></td>
</tr>
<?php
$iorden=0;
$sqlmenu  = db_query("SELECT * FROM seccionmenu sm, seccion s  WHERE sm.ccodseccion=s.ccodseccion and sm.ccodmenu='".$row['ccodmenu']."' order by sm.cordmenu ");
while ($rowmenu = db_fetch_array($sqlmenu))
{
	$iorden = $iorden +1;
	$save_orden = db_query("update seccionmenu set cordmenu='".$iorden."' where ccodseccion='".$rowmenu['ccodseccion']."' and ccodmenu='".$row['ccodmenu']."'");
?>
<tr>
    <td class='colgrishome' width="280"><?=$rowmenu['cnomseccion']?></td>
    <td class='colblancoend'>
    <input type="text" name="orden<?=$row['ccodmenu'].$iorden?>" id="orden<?=$row['ccodmenu'].$iorden?>" value="<?=$iorden?>"  size="5" maxlength="3"/>
    <a onclick="javascript:ordenar('<?=$rowmenu['ccodseccion']?>','<?=$row['ccodmenu']?>','<?=$iorden?>');"  style="cursor:pointer">Orderna</a>
    </td>
</tr>

<?php
}
?>
</table>
<?php  } ?>
<script>
function ordenar(id,menu,fila)
{
	var campo = $('#orden'+menu+fila);
	var valora=fila;
	var valor = $('#orden'+menu+fila).val();
	if(!isNaN(valor))
	{
		$.post("menu_listado.php",{ idopera:'1',codigo:$('#selectp').val(),idsave:'1',idmenu:menu, idactual:fila, idorden:valor, idseccion:id },function(data){$("#listado").html(data);})
	}
	else{
		alert("por favor, ingrese solo valores numericos.");
		campo.attr('value',fila);
	}

}

</script>
