<?php 
/***********************************/
$modulo_include="juvame_config_inc.php";
$modulo_buscar ="juvame_config_bus.php";
$retorno ="panel.php";
$stylo='1';
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
if(isset($_POST['aceptar'])) 
{
	$save_contenido= "UPDATE page 	SET
					cnompage   ='" .addslashes($_POST['nombre']) . "',
					cdocpage   ='" .$_POST['ruc'] . "',
					crazpage   ='" .addslashes($_POST['razon']) . "',
					ccodidioma ='" .$_POST['selectidioma'] . "',
					ctitpage   ='" .addslashes($_POST['pagtit']) . "',
					ctagpage   ='" .addslashes($_POST['pagtags']) . "',
					cdespage   ='" .addslashes($_POST['pagdes']) . "',
					cpiepage   ='" .addslashes($_POST['pagpie']) . "',
					clogo      ='" .$_POST['imagen'] . "',
					cfavicon   ='" .$_POST['favicon'] . "',
					nmosprecio   ='" .$_POST['selectprecio'] . "',
					ntasa        ='" .$_POST['tasaint'] . "',
					ccodmoneda   ='" .$_POST['selectmoneda'] . "',
					cemacontacto ='" .$_POST['emacontacto'] . "',
					cemaventas   ='" .$_POST['emaventas'] . "',
					canagoogle   ='" .$_POST['apiana'] . "',
					cmapgoogle   ='" .$_POST['apimap'] . "'
					WHERE ccodpage = '" . $_POST['idcodigo'] . "'";
$query   =db_query($save_contenido);
}

include "panel_template.php";
/***********************************/
?>
