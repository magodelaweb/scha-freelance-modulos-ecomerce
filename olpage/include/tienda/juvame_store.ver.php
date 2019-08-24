<table  class="tableborder"  border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td class='colgrishome'>Producto</td>
      <td width="10%" class='colblancocen'>Cantidad</td>
      <td width="15%" class='colblancocen' align="center">Precio</td>
      <td width="15%" class='colblancoend' align="center">Importe</td>
    </tr>
	<?php 
	for ($i=0;$i<$this->num_productos;$i++)
		{
			$importe =$this->array_cant_prod[$i]*$this->array_precio_prod[$i];
			$suma= $suma+ $importe;
	?>
    <tr>
      <td class='colgrishome'><?=$this->array_nombre_prod[$i]?></td>
      <td class='colblancen'><?=$this->array_cant_prod[$i]; ?> - <?=$this->array_unid_prod[$i]?>  </td>
      <td align="right" class='colblancocen'><?=number_format($this->array_precio_prod[$i],2)?></td>
      <td align="right" class='colblancoend'><?=number_format($importe,2)?></td>
    </tr>
	<?php 
		} 
		$this->totaldocumento = $suma;
	?>
    <tr>
      <td colspan="3" align="right" class='colgrishome' >Sub Total ( <?=$this->simmoneda?> ) : </td>
      <td align="right" class='colblancoend'><?=number_format($suma,2)?></td>
    </tr>
    <tr>
      <td colspan="3" align="right" class='colgrishome' >Impuesto ( <?=$this->simmoneda?> ) : </td>
      <td align="right" class='colblancoend'><?=number_format($suma*0.19,2)?></td>
    </tr>

    <tr>
      <td colspan="3" align="right"  class='colgrishome'>Total ( <?=$this->simmoneda?> ) : </td>
      <td align="right" class='colblancoend'><?=number_format($suma*1.19,2)?></td>
    </tr>
</table>


<table  class="tableborder"  border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
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
      <td class='colblancocen'><input name="CANT<?=$this->array_unidadcod[$i]?>" type="text" id="cant" value="<? echo $this->array_unidadcan[$i]; ?>" size="6" maxlength="6" style="width:50px" onKeypress="return valida_numero();"><?=$this->array_unidadnom[$i]?></td>
      <td class='colblancocen'><a href=""> <?=$this->array_productonom[$i]?></a></td>
      <td class='colblancocen' align="right"><?=number_format($this->array_unidadpre[$i],2)?></td>
      <td class='colblancoend' align="right"><?=number_format($importe,2)?></td>
    </tr>
<?php 
	} 
	$this->totaldocumento = $suma;
?>
    <tr>
      <td class='colgrishome' colspan="3" align="right" >Total ( <?=$this->simmoneda?> ) : </td>
      <td class='colblancoend' align="right"><?=number_format($suma,2)?></td>
    </tr>
    <tr>
      <td class='colgrishome' colspan="3" align="right">Impuesto ( <?=$this->simmoneda?> ) : </td>
      <td class='colblancoend' align="right"><?=number_format($suma*0.19,2)?></td>
    </tr>

    <tr>
      <td class='colgrishome' colspan="4" align="right">Total ( <?=$this->simmoneda?> ) : </td>
      <td class='colblancoend' align="right"><?=number_format($suma*1.19,2)?></td>
    </tr>
</table>