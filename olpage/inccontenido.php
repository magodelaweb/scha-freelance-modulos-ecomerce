<?php 
if ($webtipo=='1')
{
$webubica ="3";
if (empty($_GET['idsec']))
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and  ( d.ccoddestino='D' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
else
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and ( d.ccoddestino='".$codsecc."' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
while($rowc  = db_fetch_array($sqlc))
{
	if ($rowc['ctiphome']=='4') 
	{
		echo "<div id='".$rowc['ccodclase']."'>";
		echo "<div id='".$rowc['ccodclase']."titulo'><span>".$rowc['cnomhome']."</span></div>";
	    echo "<div id='".$rowc['ccodclase']."contenido'>";
		contenidosweb($rowc['ccodinicio']);
		echo "</div></div>";
	}
	else
	{
		contenidosweb($rowc['ccodinicio']);
	}
}

}
else
{

	?>
    <div id="perfilmural">
	<?php 
	$imural=0;
	$sqlmural= db_query("SELECT * FROM  contenido c, seccioncontenido s WHERE c.ccodcontenido=s.ccodcontenido and c.ccodpage ='".$codpage."' and c.ccodcategoria='2' and c.ccodmodulo='1400' limit 5"); 
	while($rowmural  = db_fetch_array($sqlmural))
	{
		$imural = $imural + 1;
		if ($imural<=4) 
			$margen ="style='margin-right:7px;float:left;'";
		else
			$margen ="style='float:right;'";
	?>
	    <a href="<?=$rowmural['cimgcontenido']?>" title="<?=$rowmural['cnomcontenido']?>" rel="gb_imageset[nice_pics]"><img src="<?=ereg_replace('fotos','thumbs',$rowmural['cimgcontenido'])?>" border="0" title="<?=$rowmural['cnomcontenido']?>"  alt="<?=$rowmural['cnomcontenido']?>" width="112"  height="75" <?=$margen?> ></a>
	<?php  } ?>
    </div>

	<?php 
	$sqlbienvenida= db_query("SELECT c.cnomcontenido,c.crescontenido,c.cimgcontenido,s.camiseccion FROM  contenido c, seccioncontenido x, seccion s WHERE c.ccodcontenido=x.ccodcontenido and x.ccodseccion=s.ccodseccion and s.ccodpage ='".$codpage."' and s.ccodgrupo ='9'"); 
	while($rowbienvenida  = db_fetch_array($sqlbienvenida))
	{
	?>
	    <div id="perfilbienvenida">
	    <a href="/<?=$rowbienvenida['camiseccion']?>"><img src="<?=$rowbienvenida['cimgcontenido']?>" title="<?=$rowbienvenida['cnomcontenido']?>" border="0" align="right" style="margin-left:10px;"  width="180"/></a>
	    <p align="justify"><?=$rowbienvenida['crescontenido']?>	<a href="/<?=$rowbienvenida['camiseccion']?>" title="<?=$rowbienvenida['cnomcontenido']?>"><br /><b>Más información</b></a></p>
        <br />
    </div>
	<?php  } ?>

<table  width="590" border"0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="titlehome">Tipo Habitación</td>
	    <td class="titlecen" width="100">Nro. Personas</td>
	    <td class="titleend" width="130">Num. Habitaciones </td>
	</tr>
	<tr>
		<td class="colgrishome">Habitación Personal</td>
	    <td class="colblancocen"><img src="/estilos/images/tphab1.png" /></td>
	    <td class="colblancoend" >
		<select name='selectnivel'  id='selectnivel'  style="width:70px;" >
        <option value='0'>0</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        <option value='6'>6</option>
        <option value='7'>7</option>
        <option value='8'>8</option>
        <option value='9'>9</option>
        </select>
        </td>
	</tr>
	<tr>
		<td class="colgrishome">Habitación Doble</td>
	    <td class="colblancocen"><img src="/estilos/images/tphab2.png" /></td>
	    <td class="colblancoend">Reservar</td>
	</tr>
	<tr>
		<td class="colgrishome">Habitación Matrimonial</td>
	    <td class="colblancocen"><img src="/estilos/images/tphab3.png" /></td>
	    <td class="colblancoend">Reservar</td>
	</tr>
	<tr>
		<td class="colgrishome">Habitación Triple</td>
	    <td class="colblancocen"><img src="/estilos/images/tphab3.png" /></td>
	    <td class="colblancoend">Reservar</td>
	</tr>
	<tr>
		<td colspan="2" class="formpie">&nbsp;</td>
		<td class="formpie">Reservar</td>
	</tr>
<tr>
	<td colspan="3"><h3>Servicios que brinda el Hotel</h3></td>
</tr>
<tr>
	<td colspan="3">
    <ul>
	<?php 
	$sqlservicios= db_query("select * from pageservicios s, webparametros p where s.ccodservicio= p.cvalparametro and s.ccodpage ='".$codpage."' and p.ccodparametro='0015' and p.ctipparametro='1'  "); 
	while($rowservicios  = db_fetch_array($sqlservicios))
	{
	?>	
	    <li><?=$rowservicios['cnomparametro']?></li>
    <?php  } ?>
    </ul>
    </td>
</tr>

</table>


<?php  } ?>


