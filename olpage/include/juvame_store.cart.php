<form name="form1" method="post" action="">
<table  width="98%"  border="0" cellpadding="0" cellspacing="0" align="center">
    <tr >
      <td colspan="2" class="title" >Datos Pedido</td>
    </tr>
<?php  
if ($_SESSION['usuario_aut'] =='1') 
{
$sqlclie = db_query("SELECT * FROM persona WHERE ccodpersona ='".$_SESSION['usuario_id']."' ");
while($rowcli  = db_fetch_array($sqlclie))
{
	$this->cliente_codigo = $rowcli['ccodersona'];
	$this->cliente_nombre = $rowcli['cnompersona'];
	$this->cliente_email  = $rowcli['cemapersona'];
	$this->cliente_tele   = $rowcli['ntelefono'];
	
?>
    <tr>
      <td  width="150" align="right" height="25" class='colgrishome'>Nombre</td>
      <td class='colblancoend'><?=$this->cliente_nombre; ?></td>
	</tr>
    <tr>
      <td  align="right" height="25" class='colgrishome'>Email</td>
      <td class='colblancoend'><?=$this->cliente_email;?></td>
	</tr>
    <tr>
      <td  align="right" height="25" class='colgrishome'>Telefono</td>
      <td class='colblancoend'><?=$this->cliente_tele?></td>
	</tr>
<?php  }
} 
else 
{ 
?>  
    <tr>
      <td width="150" align="right" height="25" class='colgrishome'>Nombre</td>
      <td class='colblancoend'><input type="text" name="nombre" id="nombre" size="70" value="<?=$nombre?>"></td>
	</tr>
    <tr>
      <td align="right" height="25" class='colgrishome'>Email</td>
      <td class='colblancoend'><input type="text" name="email" id="email" size="70" value="<?=$email?>"></td>
	</tr>
    <tr>
      <td align="right" height="25" class='colgrishome'>Telefono</td>
      <td class='colblancoend'><input type="text" name="telefono" id="telefono" size="20" maxlength="9" value="<?=$telefono?>"></td>
	</tr>

    <tr>
      <td  colspan="2" align="center" valign="middle" height="50" class='colgrishome'>
      Si ya se encuentra registrado en nuestra web, Inicie su session en la parte superior de la pagina web</a>
      </td>
	</tr>

<?php 
}
?>   
 
</table>
<table  width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="25" class='titlehome'><img src="/estilos/images/wp_eliminar.gif" /></td>
      <td class='titlecen' align="center" width="100">Imagen</td>
      <td class='titleend' align="center" >Producto</td>
    </tr>
	<?php 
	for ($i=0;$i<$this->num_productos;$i++)
		{
			$importe =$this->array_ppre[$i]*$this->array_pcan[$i];
			$suma= $suma+ $importe;
	?>
    <tr>
      <td class='colgrishome' align="center" ><input type="checkbox" name="DEL<?=$this->array_pcod[$i]?>" value="1" style="width:10px"> </td>
      <td class='colblancocen' align="center"><img src="<?=ereg_replace('fotos','thumbs',$this->array_pimg[$i])?>" border="0" width="80" ></td>
      <td class='colblancoend'><b><?=$this->array_pnom[$i]?></b><br /><?=$this->array_pres[$i]?></td>
      </td>
    </tr>
<?php 
	} 
	$this->totaldocumento = $suma;
?>
    <tr >
      <td colspan="2" class="colgrishome" align="right" valign="top">Consulta:</td>
      <td class="colblancoend"><textarea id="comenta" name="comenta" rows="3"  cols="40" style="width:450px" ></textarea></td>
    </tr>
    <tr >
      <td colspan="3" height="30"  class="colgrishome" align="center"><b><?=$mensajeerror?></b></td>
    </tr>
    <tr >
      <td colspan="3" height="30" align="right" class="formpie">
        <input type="submit" name="update"  id="update"  value="Actualizar" style="width:130px;" >
		<input type="button" name="boton"   id="boton"   value="Otro pedido"  style="width:130px" tabindex="1" onClick="Javascript:window.location='/index.php';">
	    <input type="submit" name="limpiar" id="limpiar" value="Anular pedido" style="width:130px;">
        <input type="submit" name="pedido"  id="pedido"  value="Enviar pedido" style="width:130px"> 
		</td>
    </tr>
</table>
</form>	
