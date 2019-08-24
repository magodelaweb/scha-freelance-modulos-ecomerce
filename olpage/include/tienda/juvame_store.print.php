<table  class="tableborder"  border="0" cellpadding="0" cellspacing="0" align="center">
    <tr >
      <td colspan="2" class="title">DATOS DEL CLIENTE</td>
    </tr>
<?php  
if ($_SESSION['usuario_aut'] =='1') 
{
?>
    <tr>
      <td class='colgrishome' width="150" align="right">Cliente</td>
      <td class='colblancoend'><?=$_SESSION['usuario_nombre']; ?></td>
	</tr>
    <tr>
      <td class='colgrishome' width="150" align="right">Email</td>
      <td class='colblancoend'><?=$_SESSION['usuario_email']?></td>
	</tr>
    <tr>
      <td class='colgrishome' width="150" align="right">Documento</td>
      <td class='colblancoend'><?=$_SESSION['usuario_dni']?></td>
	</tr>
    <tr>
      <td class='colgrishome' width="150" align="right">Dirección</td>
      <td class='colblancoend'><?=$_SESSION['usuario_dir']?></td>
	</tr>
    <tr>
      <td class='colgrishome' width="150" align="right">Ubicación</td>
      <td class='colblancoend'><?=$_SESSION['usuario_city']?></td>
	</tr>
    <tr>
      <td class='colgrishome' width="150" align="right">Telefono</td>
      <td class='colblancoend'><?=$_SESSION['usuario_telefono']?></td>
	</tr>
<?php  
} 
else 
{ 
?>  
    <tr>
      <td class='colgrishome'  colspan="2" align="center" valign="middle" height="150">
      Si ya se encuentra registrado en nuestra web, Ingrese a su cuenta <a href="/micuenta"><b>aqui</b></a><br /><br />
      o cree una nueva cuenta de acceso <a href="registro"><b>aqui</b></a>
      
      </td>
	</tr>

<?php 
}
?>   
 
</table>
<form name="form1" method="post" action="">

<table  class="tableborder"  border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="25" class='titlehome'><img src="<?=WEB_DOMINIO?>/webimages/wp_eliminar.gif" /></td>
      <td width="100" class='titlecen'>Cantidad</td>
      <td class='titlecen'>Producto</td>
      <td width="70" class='titlecen' align="center">Precio</td>
      <td width="80" class='titleend' align="center">Importe</td>
    </tr>
	<?php 
	for ($i=0;$i<$this->num_productos;$i++)
		{
			$importe =$this->array_unidadcan[$i]*$this->array_unidadpre[$i];
			$suma= $suma+ $importe;
	?>
    <tr>
      <td class='colgrishome' align="center" ><input type="checkbox" name="DEL<?=$this->array_unidadcod[$i]?>" value="1" style="width:10px"> </td>
      <td class='colblancocen'><input name="CANT<?=$this->array_unidadcod[$i]?>" type="text" id="cant" value="<?php  echo $this->array_unidadcan[$i]; ?>" size="6" maxlength="6" style="width:50px" onKeypress="return valida_numero();"><?=$this->array_unidadnom[$i]?></td>
      <td class='colblancocen'><a href=""> <?=$this->array_productonom[$i]?></a></td>
      <td class='colblancocen' align="right"><?=number_format($this->array_unidadpre[$i],2)?></td>
      <td class='colblancoend' align="right"><?=number_format($importe,2)?></td>
    </tr>
<?php 
	} 
	$this->totaldocumento = $suma;
?>
    <tr>
      <td class='colgrishome' colspan="4" align="right" >Total ( <?=$this->simmoneda?> ) : </td>
      <td class='colblancoend' align="right"><?=number_format($suma,2)?></td>
    </tr>
    <tr>
      <td class='colgrishome' colspan="4" align="right">Impuesto ( <?=$this->simmoneda?> ) : </td>
      <td class='colblancoend' align="right"><?=number_format($suma*0.19,2)?></td>
    </tr>

    <tr>
      <td class='colgrishome' colspan="4" align="right">Total ( <?=$this->simmoneda?> ) : </td>
      <td class='colblancoend' align="right"><?=number_format($suma*1.19,2)?></td>
    </tr>
    <tr >
      <td colspan="5" height="30" align="right" class="formpie">
        <input type="submit" name="update"  id="update"  value="Actualizar" style="width:100px;" >
		<input type="button" name="boton"   id="boton"   value="Continuar"  style="width:100px" tabindex="1" onClick="Javascript:window.location='index.php';">

	    <input type="submit" name="limpiar" id="limpiar" value="Vaciar Cesta" style="width:100px;">
        <input type="submit" name="pedido"  id="pedido"  value="Enviar Pedido" style="width:100px"> 
		</td>
    </tr>
</table>
</form>	
