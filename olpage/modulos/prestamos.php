<div id="formcuenta">
	<form  name="frm_contactos" action="#" method="post">
		<label>Precio </label><input name="monto"  id="monto" type="text"  size="54" class="cuadro"><br>
		<label>Nro de Cuotas</label><input name="cuotas"  id="cuotas" type="text"  size="54" class="cuadro"><br>
		<input name="tasa"  id="tasa" type="hidden"  size="54"  value="<?=$tasaweb?>">
		<label>Inicial</label><input name="inicial"  id="inicial" type="text"  size="54" class="cuadro"><br>
		<label>&nbsp;</label><input type="submit" name="submitbutton" id="submitbutton" value="Calcular" class="formboton"><br>
	</form>
</div>

<?php 
if(isset($_POST['submitbutton'])) 
{
	$capital = $_POST["monto"]-$_POST["inicial"];
	$saldo = $_POST["monto"]-$_POST["inicial"];
	$ncuotas = $_POST["cuotas"];
	$tasames = ($_POST["tasa"]/100);
	$montocuota   = round($capital*(($tasames*pow((1+$tasames),$ncuotas))/(pow((1+$tasames),$ncuotas)-1)),2);
	?>
    <p><b>Precio : </b><?=$_POST["monto"]?></p>
    <p><b>Financiamiento : </b><?=$capital?></p>
    <p><b>Nro Cuotas : </b><?=$_POST["cuotas"]?></p>
    
    <table width="500" border="0" class="tablanormal">
    <tr>
    	<th align="center" width="80">Nro. Cuota</th>
        <th align="center">Interes</th>
        <th align="center">Capital</th>
        <th align="center">Cuota</th>
    </tr>
	<?php 
	$x=0;
	$y=0;
	for ($i = 1; $i <= $ncuotas; $i++) {
	    $mesinteres = round($capital*(($tasames*pow((1+$tasames),1))/(pow((1+$tasames),1)-1)),2)-$capital;
		$mescapital = $montocuota - $mesinteres;
		$capital   = $capital - $mescapital;
		$y = $y + $mesinteres;
		?>
		<tr>
        	<td align="right"><?=$i?></td>
        	<td align="right"><?=number_format($mesinteres,2)?></td>
        	<td align="right"><?=number_format($mescapital,2)?></td>
        	<td align="right"><?=number_format($montocuota,2)?></td>
        </tr>
        <?php 
		}
	?>
		<tr>
        	<td align="right">Totales</td>
        	<td align="right"><?=number_format($y,2)?></td>
        	<td align="right"><?=number_format($saldo,2)?></td>
        	<td align="right"><?=number_format($saldo+$y,2)?></td>
        </tr>
    
    </table>
    <?php 
}
?>
