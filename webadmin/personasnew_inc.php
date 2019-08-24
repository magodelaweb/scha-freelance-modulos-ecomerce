<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/

?>
<div id="capaformulario">
<form id="form" >
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborderfull" >
	<tr>
		<td colspan='2' align="left" class='titulo'>
		<div class="formtitulo">Nuevo Cliente</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        </td>
	</tr>
<tr>
	<td colspan='2' class='titlehome'>Datos basicos </td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Correo electronico</td>
	<td class='colblancoend'><input type="text" name="email" maxlength="100"  size="50" /></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Nombres y Apellidos </td>
	<td class='colblancoend'><input type="text" name="nombre" maxlength="100" size="50"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Sexo</td>
	<td class='colblancoend'><select name="selectsexo" style="width:220px">
<?php  	$sql_select="SELECT * FROM webparametros where ccodparametro='0006' and ctipparametro='1'";
	$result    =db_query($sql_select);
	while($fila=db_fetch_array($result))
	{  echo "<option value=".$fila['cvalparametro'].">".$fila['cdesparametro']."</option>";
	}
?>
	</select></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Documento Identidad</td>
	<td class='colblancoend'><input type="text" name="numerodoc" maxlength="20"  size="20"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Fecha Aniversario</td>
	<td class='colblancoend'>
	<input type="text" name="fechanac" id="fechanac" maxlength="10" size="10"/>
	<input type="button" id="fechabus" value="..." class="cssboton">
			<script type="text/javascript"> 
			   Calendar.setup({ 
			    inputField	:    "fechanac",     // id del campo de texto 
			    ifFormat	:     "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		  	    button	    :    "fechabus"     // el id del botón que lanzará el calendario 
				}); 
			</script> 		
	</td>
</tr>

<tr>
	<td colspan='2' class='titlehome'>Datos de Contactos</td>

<tr>
      <td align='right' class='colgrishome' height='25'>Pais </td>
      <td class='colblancoend'>
<select name='pais' id="pais"  style="width:320px">
<?php   
	$pais    = substr($_SESSION['spais'],0,2);
	$sqlpais = db_query("SELECT * FROM webubigeo WHERE  cnivubigeo='1' ORDER BY cnomubigeo");
	while($rowpais = db_fetch_array($sqlpais))
	{
			if (substr($rowpais['ccodubigeo'],0,2) == $pais) 
				echo "<option value=".$rowpais['ccodubigeo']." selected>".$rowpais['cnomubigeo']."</option>";
			else
				echo "<option value=".$rowpais['ccodubigeo']." >".$rowpais['cnomubigeo']."</option>";
	} 
?>
</select>
			
	  </td>
	</tr>
    <tr>
      <td align='right' class='colgrishome' height='25'>Region /Dpto</td>
      <td class='colblancoend'>

	<select name='dpto' id="dpto" style='width:320px;'>
	<option value='00000000' selected="selected">Seleccione</option>
	<?php 
	$dpto = substr($_SESSION['spais'],0,4);
	$sqldpto = db_query("SELECT * FROM webubigeo WHERE ccodubigeo like '".$pais."%' and cnivubigeo='2' ORDER BY cnomubigeo");
	while($rowdpto = db_fetch_array($sqldpto))
	{
		echo "<option value=".$rowdpto['ccodubigeo']." >".$rowdpto['cnomubigeo']."</option>";
	} 
	?>
	</select>
			
	  </td>
	</tr>
    <tr>
      <td align='right' class='colgrishome' height='25'>Ciudad</td>
      <td class='colblancoend'>
	<select name='city' id="city"  style="width:320px"">
    <option value='00000000'>Seleccione</option>
	</select>

	  </td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Ciudad</td>
	<td class='colblancoend'><input type="text" name="ciudad" maxlength="20"  size="20"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Codigo Postal</td>
	<td class='colblancoend'><input type="text" name="codpostal" maxlength="20"  size="20"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Dirección</td>
	<td class='colblancoend'><input type="text" name="direccion" maxlength="100"  size="50"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Telefono</td>
	<td class='colblancoend'><input type="text" name="telefono" maxlength="20"  size="20"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Movil</td>
	<td class='colblancoend'><input type="text" name="movil" maxlength="20"  size="20"/></td>
</tr>


<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   

<tr>
	<td colspan="2" align="center" class='formpie' >
		<input type="button" value="Grabar"   class='cssboton' onclick="xajax_procesar_formulario(xajax.getFormValues('form'))" />
		<input type="Button" value="Cancelar" onClick ="javascript:window.location = 'personas.php'" class='cssboton'>
	</td>
</tr>
</table>
</form>
<script>
$(document).ready(function(){

	$("#pais").change(function(){
		$.post("jquery_ubigeo.php",{ pais:$('#pais').val() },function(data){$("#dpto").html(data);$("#city").html("");$("<option value='00000000'>Seleccione</option>").appendTo("#city");})
		
	});
	$("#dpto").change(function(){
		$.post("jquery_ubigeo.php",{ dpto:$('#dpto').val() },function(data){$("#city").html(data);})
	});
})
</script>


