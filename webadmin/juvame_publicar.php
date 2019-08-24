<?php
/***********************************/
	ob_start();
	session_start();

	include "../config.php";
	include "include/funciones.php";
	include "include/config_seguro.php";
	include "juvame_cabecera.php";
	
/***********************************/
?>
<table  class="cuerpo" border='0'cellspacing='0' cellpadding='0'>
	<tr>
		<td>
		<?php include  "juvame_cabecera_inc.php"; ?>
		</td>
	</tr>
	<tr>
	    <td class="contenido">
		<?php include "juvame_publicar_inc.php";?>
		</td>
 	</tr>
	<tr>
		<td class="piepagina">
		<?php include  "juvame_pie.php";?>
		</td>
	</tr>
</table>
