<div  class="miga">
<?php 
if ($nivsecc >='1') 
{ 
?>
	<a href='/index.php'><?=menu_inicio?></a> &gt
	<a href='/<?=$_GET['idsec']?>'><?=$rowseccion['cnomseccion']?></a>
<?php 
}
if ($nivsecc >='2') 
{ 
?>
	&gt <a href='/<?=$_GET['idsec']?>/<?=$_GET['idsec2']?>'><?=$rowseccion2['cnomseccion']?></a> 
	<?php 
}
if ($nivsecc >='3') 
{ 
?>
	&gt <a href='/<?=$_GET['idsec']?>/<?=$_GET['idsec2']?>/<?=$_GET['idsec3']?>'><?=$rowseccion3['cnomseccion']?></a> 
<?php 
}
if ($nivsecc >='4') 
{ 
?>
	&gt <a href='/<?=$_GET['idsec']?>/<?=$_GET['idsec2']?>/<?=$_GET['idsec3']?>/<?=$_GET['idsec4']?>'><?=$rowseccion4['cnomseccion']?></a> 
<?php 
}

if ($_GET['idsec']=="panel")
{
?>
	<a href='/index.php'><?=menu_inicio?></a> &gt
	<a href='/<?=$_GET['idsec']?>'><?=$panelweb?></a>
<?php 
}     
if ($_GET['idsec']=="registro")  
{
?>
	<a href='/index.php'><?=menu_inicio?></a> &gt
	<a href='/<?=$_GET['idsec']?>'><?=registro_miga?></a>
<?php 
}     
if ($_GET['idsec']=="recuperar") 
{
?>
	<a href='/index.php'><?=menu_inicio?></a> &gt
	<a href='/<?=$_GET['idsec']?>'><?=recuperar_miga?></a>
<?php 
}     
if ($_GET['idsec']=="buscador")  
{
?>
	<a href='/index.php'><?=menu_inicio?></a> &gt
	<a href='/<?=$_GET['idsec']?>'><?=buscador_miga?></a>
<?php 
}     
?>
</div>
