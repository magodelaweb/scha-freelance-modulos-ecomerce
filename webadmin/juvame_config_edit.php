<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idopera']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
	include "include/funciones.php";
	$pagew  = $_POST['page'];
	$_SESSION['page'] = $_POST['page'];
}
else
{
	$pagew = $_SESSION['page'];
}
$_SESSION['rutaimages']  = "web/".$_SESSION['page']."/fotos";
$sql  = db_query("SELECT * FROM page WHERE ccodpage = '" . $pagew . "' ");
while ($row = db_fetch_array($sql))
{
?>
<input type="hidden" name="idcodigo" id="idcodigo" value="<?=$pagew?>">
<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborder" >
<tr>
    <td class='titlehome'  colspan="2">Config Basica : </td>
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Nombre </td>
    <td class='colblancocen' ><b><?=$row['cnikpage']?></b></td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">URL Pagina</td>
    <td class='colblancocen' ><b><?=$row['camipage']?></b></td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Redirección</td>
    <td class='colblancocen' >
  <?php   $sql_page = db_query("select * from page  where ccodpage='".$row['credpage']."'");
	 while($row_page = db_fetch_array($sql_page)) 
	 {
			echo '<b>',$row_page['camipage'] . '</b>';
	 }
  ?>
    </td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Plan</td>
    <td class='colblancocen' ><b></b></td>
</tr>

<tr>
    <td class='titlehome'  colspan="2">Datos Empresa</td>
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Nombre Comercial</td>
    <td class='colblancocen' ><input name='nombre' type='text' id='nombre'  size='90'  maxlength="150" value="<?=$row['cnompage']?>" class="box500">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Razon Social</td>
    <td class='colblancocen' ><input name='razon' type='text' id='razon'  size='90'  maxlength="150" value="<?=$row['crazpage']?>" class="box500">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Documento</td>
    <td class='colblancocen' ><input name='ruc' type='text' id='ruc'  size='30'  maxlength="15" value="<?=$row['cdocpage']?>" class="box200">
	</td>
</tr>
<tr>
	<td class='colgrishome' align="right">Logo </td>
    <td class='colblancocen'>
    <input type="text" name="imagen" id="imagen" size="60"  maxlength="150" value='<?=$row['clogo']?>' class="box400"><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" >
	</td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right">Tipo de Empresa</td>
    <td class='colblancocen' >
	<select name="selectempresa" class="box300">
	<?php 	$sql_empresa=db_query("SELECT * FROM seccion where ccodpage='12172806' and  ccodmodulo='1900' and cnivseccion='1'");
		while($row_empresa=db_fetch_array($sql_empresa))
		{ 
			if ($row_empresa['ccodseccion']==$row['ccodseccion'])
				echo "<option value=".$row_empresa['ccodseccion']." selected>".$row_empresa['cnomseccion']."</option>";
			else
				echo "<option value=".$row_empresa['ccodseccion'].">".$row_empresa['cnomseccion']."</option>";
		}
	?>
		</select>
    
	</td>
</tr>

<tr>
    <td class='titlehome'  colspan="2">Personalizacion de pagina web</td>
	</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Idioma</td>
	<td class='colblancoend'>
	<select name="selectidioma" class="box300">
	<?php 	$sql_idioma=db_query("SELECT * FROM webparametros where ccodparametro='0010' and ctipparametro='1'");
		while($row_idioma=db_fetch_array($sql_idioma))
		{ 
			if ($row_idioma['cvalparametro']==$row['ccodidioma'])
				echo "<option value=".$row_idioma['cvalparametro']." selected>".$row_idioma['cdesparametro']."</option>";
			else
				echo "<option value=".$row_idioma['cvalparametro'].">".$row_idioma['cdesparametro']."</option>";
		}
	?>
		</select>
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Titulo :</td>
    <td class='colblancocen' ><input name='pagtit' type='text' id='pagtit'  size='90'  maxlength="150" value="<?=$row['ctitpage']?>"  class="box500">
	</td>
</tr>
<tr>
	<td class='colgrishome' align="right">Favicon </td>
    <td class='colblancocen'>
    <input type="text" name="favicon" id="favicon" size="60"  maxlength="150" value='<?=$row['cfavicon']?>' class="box400"><input type="button" value="Seleccionar" onClick="openAsset('favicon')" id="btnAsset" name="btnAsset" >
	</td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Descripción :</td>
    <td class='colblancocen' ><textarea id="pagdes" name="pagdes" rows="5" cols="65"  class="area500"><?=$row['cdespage']?></textarea></td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Tags :</td>
    <td class='colblancocen' ><textarea name="pagtags" id="pagtags" cols="65" rows="4"  class="area500"><?=$row['ctagpage']?></textarea></td>
</tr>



<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Pie de Pagina</td>
    <td class='colblancocen' ><textarea id="pagpie" name="pagpie" rows=5 cols=65  class="area500"><?=$row['cpiepage']?></textarea></td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right">Email Contactos :</td>
    <td class='colblancocen' ><input name='emacontacto' type='text' id='emacontacto'  size='50'  maxlength="80" value="<?=$row['cemacontacto']?>" class="box500">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Email Ventas :</td>
    <td class='colblancocen' ><input name='emaventas' type='text' id='emaventas'  size='50'  maxlength="80" value="<?=$row['cemaventas']?>" class="box500">
	</td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Moneda</td>
    <td class='colblancocen' >
		<select name="selectmoneda" class="box300">
	<?php 	$categoria_sql=db_query("SELECT * FROM webparametros where ccodparametro='0002' and ctipparametro='1'");
		while($row_categoria=db_fetch_array($categoria_sql))
		{ 
			if( $row_categoria['cvalparametro']==$row['ccodmoneda']) 
				echo "<option value='".$row_categoria['cvalparametro']."' selected>".$row_categoria['cnomparametro']."</option>";
			else
				echo "<option value='".$row_categoria['cvalparametro']."'>".$row_categoria['cnomparametro']."</option>";
		}
	?>
		</select>
    
    </td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Precios</td>
    <td class='colblancocen' >
    <input type="radio" name="selectprecio" value="0" <?php if($row['nmosprecio']=='0') echo "checked";?> /> No Mostrar Precios<br />
    <input type="radio" name="selectprecio" value="1" <?php if($row['nmosprecio']=='1') echo "checked";?>/> Mostrar Precios<br />
    
    
    </td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Tasa Interes mensual :</td>
    <td class='colblancocen' ><input name='tasaint' type='text' id='tasaint'  size='50'  maxlength="10" value="<?=$row['ntasa']?>" class="box100">
	</td>
</tr>


<tr>
    <td class='titlehome'  colspan="2">Api</td>
	</td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right">Google Analytics :</td>
    <td class='colblancocen' ><input name='apiana' type='text' id='apiana'  size='50'  maxlength="30" value="<?=$row['canagoogle']?>"  class="box200">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Google Maps</td>
    <td class='colblancocen' ><input name='apimap' type='text' id='apimap'  size='90'  maxlength="150" value="<?=$row['cmapgoogle']?>" class="box500">
	</td>
</tr>

<tr>
	<td colspan="2"  class='formpie' align="center" >
		<input name="aceptar" id="aceptar" type="submit"  value="Aceptar" class="cssboton"/>
	</td>
</tr>
</table>
<?php } ?>
