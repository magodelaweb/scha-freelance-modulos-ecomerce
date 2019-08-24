	<?php 
	$suma =0;
	for ($i=0;$i<$this->num_productos;$i++)
		{
			$importe =$this->array_pcan[$i] * $this->array_uofe[$i];
			$suma= $suma+ $importe;
		} 
		$this->totaldocumento = $suma;
	?>

<table  width='650' border='0' cellpadding='0' cellspacing='0' align='center'>
    <tr >
      <td class='title'>Pedido Nro: <?=$this->numpedido?></td>
    </tr>
    <tr >
      <td class='formpie'  height="100" valign="middle" align="center">
      Muchas gracias su pedido fue realizado con exito, en breve nos estaremos contactando con Usted.
      </td>
	</tr>          
</table>


