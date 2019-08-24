<?php 
/*****************************************/
	include "include/config_seguro.php";
/*****************************************/
$retorno ="mibuzon.php";
$sql= db_query("SELECT * FROM personabuzon WHERE ccodmensaje = '" . $_GET['codigo']."'");
while($row = db_fetch_array($sql))
{
?>
<form name="form" method="post" action="buzon_view.php">
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborder" >
	<tr>
    	<td colspan="7"  class='titulo' >
        <div class="formtitulo">Ver Mensajes</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        
        </td>
	</tr>
	<tr>
		<td class='colgrishome' width="120"  height='30' align='right'>De :</td>
		<td class='colgriscen'><b><?=$row['cnommensaje']?></b> [<?=$row['cemamensaje']?>]</td>
	</tr>
	<tr>
		<td class='colgrishome'  height='30' align='right'>Para :</td>
		<td class='colgriscen'><?=$_SESSION['webuser_nombre']?></td>
	</tr>
	<tr>
		<td class='colgrishome' width="120"  height='30' align='right'>Fecha :</td>
		<td class='colgriscen'><?=$row['dfecmensaje']?></td>
	</tr>

	<tr>
		<td class='titlehome'  height='30'  colspan="2"><b>ASUNTO :</b><?=$row['casumensaje']?></td>
	</tr>
	<tr>
		<td class='colblancohome'  height='300'  colspan="2" valign="top"><?=$row['cdesmensaje']?></td>
	</tr>
	<tr>
		<td class='formpie'    colspan="2" align="center">
			<input type="Button" value="Cerrar mensaje" onclick="javascript:window.location = 'mibuzon.php'">
        
        </td>
	</tr>
    

</table>
</form>
<?php  }?>
