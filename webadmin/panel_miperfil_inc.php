<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
if(isset($_POST['Grabar'])) 
{
	
		$sql_update="UPDATE persona SET 
		cnompersona   ='". $_POST['nombre'] ."',
		csexpersona   ='". $_POST['selectsexo'] ."',
		cdnipersona   ='". $_POST['numerodoc'] ."',
		cimgpersona   ='". $_POST['avatar'] ."',
		ccodubigeo    ='". $_POST['ciudad'] ."',
		cdireccion    ='". $_POST['direccion'] ."',
		dnacpersona   ='". $_POST['fechanac'] ."'
		WHERE ccodpersona ='". $_SESSION['webuser_id'] ."'";
		db_query($sql_update);
		
		
	tep_redirect("panel_miperfil.php");  
}


$sql_select   = "SELECT * FROM persona   WHERE ccodpersona='".$_SESSION['webuser_id']."'";
$query_select = db_query($sql_select);
$row          = db_fetch_array($query_select);

?>
<div id="capaformulario">
<form name="frm_config" method="post" action="panel_miperfil.php">
<input type="hidden" name="codigo" value="<?=$_GET['codigo']?>" >
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborderfull" >
<tr>
    <td   class='titulo' colspan="2" >
        <div class="formtitulo">Mi Perfil</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>
<tr>
	<td colspan='2' class='titlehome'>Datos basicos </td>
</tr>
<tr>
	<td class='colgrishome' align='right' width="180">Correo electronico</td>
	<td class='colblancocen'><input type="text" name="email" maxlength="100"  size="80"  readonly value="<?=$row['cemapersona']?>" class="box500"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Nombres y Apellidos </td>
	<td class='colblancocen'><input type="text" name="nombre" maxlength="100" size="80" value="<?=$row['cnompersona']?>" class="box500"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Sexo</td>
	<td class='colblancocen'>
	<select name="selectsexo" style="width:250px" class="box">
<?php  	$sql_sex       = "SELECT * FROM webparametros where ccodparametro='0006' and ctipparametro='1'";
	$querysex     = db_query($sql_sex);
	while($filasex = db_fetch_array($querysex))
	{	if($filasex['cvalparametro']==$row['csexpersona'])
			echo "<option value=".$filasex['cvalparametro']." selected>".$filasex['cdesparametro']."</option>";
		else
			echo "<option value=".$filasex['cvalparametro'].">".$filasex['cdesparametro']."</option>";
	}
?>
	</select></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Documento Identidad</td>
	<td class='colblancocen'><input type="text" name="numerodoc" maxlength="20"  size="20" value="<?=$row['cdnipersona']?>" class="box200"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Fecha Aniversario</td>
	<td class='colblancocen'>
	<input type="text" name="fechanac" id="fechanac" maxlength="10" size="10" value="<?=$row['dnacpersona']?>" class="box200"/>
	<input type="button" id="fechabus" value="..." class="botonfecha">
			<script type="text/javascript"> 
			   Calendar.setup({ 
			    inputField	:    "fechanac",     // id del campo de texto 
			    ifFormat	:     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		  	    button	    :    "fechabus"     // el id del botón que lanzará el calendario 
				}); 
			</script> 		
	</td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Foto</td>
	<td  class='colblancocen'>
	<input type="text" name="avatar" id="avatar" size="100" value="<?=$row['cimgpersona']?>" class="box500"><input type="button" value="Seleccionar" onClick="openAsset('avatar')" id="btnAsset" name="btnAsset" >
	</td>

</tr>
<tr>
	<td colspan='2' class='titlehome'>Datos Ubicacion</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Pais</td>
    <td class='colblancocen'>
<select name='pais' onChange='javascript:cargarZona(this.form,this.value);' style='width:250px;' class="box">
<?php 
	$pais =$row['ccodubigeo'];
	$codpais=substr($pais,0,2);
	$sql="SELECT * FROM webubigeo WHERE  cnivubigeo='1' ORDER BY cnomubigeo";
	$result=db_query($sql);
	while($filaprov=db_fetch_array($result))
	{
			echo "<option value=".$filaprov['ccodubigeo']; 
			if (substr($filaprov['ccodubigeo'],0,2) == $codpais) 
			{
			$selprov=1;
				echo " selected";
			} 
			echo ">".$filaprov['cnomubigeo']."</option>\n";
	} 
	
?>
	</select>	
	</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Region</td>
    <td class='colblancocen'>
	<div id='zonas'>
	<select name='dpto'  onChange="javascript:cargarCiudad(this.form,this.value);" style='width:250px;' class="box" >
	<?php 
	$coddpto=substr($row['ccodubigeo'],0,4);
	$npais  =substr($row['ccodubigeo'],0,2);
	$sql    ="SELECT * FROM webubigeo WHERE ccodubigeo like '".$npais."%' AND cnivubigeo='2' ORDER BY cnomubigeo";
	$result =db_query($sql);
	while($filaprov=db_fetch_array($result))
	{
			echo "<option value=".$filaprov['ccodubigeo']; 
			if (substr($filaprov['ccodubigeo'],0,4) == $coddpto) 
			{
			$selprov=1;
				echo " selected";
			} 
			echo ">".$filaprov['cnomubigeo']."</option>\n";
	} 
		echo "<option value='00000000'>No especificado</option>";
	?>
	</select>
	</div>
			


</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'> Ciudad:</td>   
    <td class='colblancocen'>
	<div id='zciudad'>
	<select name='ciudad' style='width:250px;' class="box">
	<?php 
	$coddpto=substr($row['ccodubigeo'],0,10);
	$npais1  =substr($row['ccodubigeo'],0,4);
	$sql="SELECT * FROM webubigeo WHERE ccodubigeo like '".$npais1."%' AND cnivubigeo='3' ORDER BY cnomubigeo";
	$result=db_query($sql);
	while($filaprov=db_fetch_array($result))
	{
		echo "<option value=".$filaprov['ccodubigeo']; 
		if (substr($filaprov['ccodubigeo'],0,10) == $coddpto) 
		{
			$selprov=1;
			echo " selected";
		} 
		echo ">".$filaprov['cnomubigeo']."</option>\n";
	} 
		echo "<option value='00000000'>No especificado</option>";
	?>
	</select>
	</div>
	<input type='hidden' name='hidajax' value='' />
	<input type='hidden' name='hidajax2' value='' />


	</td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Dirección </td>
	<td class='colblancocen'><input type="text" name="direccion" id="direccion" maxlength="100" size="80" value="<?=$row['cdireccion']?>" class="box500"/></td>
</tr>
<tr>
	<td colspan='2' class='titlehome'>Cambiar Contraseña </td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Contraseña Actual</td>
	<td class='colblancocen'><input type="password" name="passactual" maxlength="20"  size="20"  class="box200"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Contraseña Nueva</td>
	<td class='colblancocen'><input type="password" name="passnueva" maxlength="20"  size="20"  class="box200"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Confirme Contraseña</td>
	<td class='colblancocen'><input type="password" name="passnueva2" maxlength="20"  size="20"  class="box200"/></td>
</tr>

<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   
<tr>
	<td colspan="2" align="center" class='formpie' >
	<input type="submit" name="Grabar" value="Grabar" class="formboton" >
	<input type="Button" value="Cancelar" onClick ="javascript:window.location = '<?=$retorno?>'" class='cssboton'>
	</td>
</tr>

</table>
</form>
</div>
