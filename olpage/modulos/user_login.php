<?php 
if ($_SESSION['usuario_aut']<>"1")
{
include "modulos/web_seccioncab.php";	

?>
	<div id="formcuenta">
	<form name="form1" method="post" action="">
		<label><?=micuenta_correo?></label><input name="email" id="email" type="text" size="100" maxlength="100" class="cuadro"><br />
		<label><?=micuenta_password?></label><input name="clave" id="clave" type="password" size="25"  maxlength="30" class="cuadro" /><br />
		<input name="submitlogin" id="submitlogin"  type="submit" value='<?=micuenta_enviar?>' class="enviar">
	</form>
	<p><font color="#FF0000"><b><?=$mensajeerror?></b></font></p>
	<p>Si es un usuario nuevo registrese <a href="/registro">aquí</a></p>
	<p>Se olvido su contraseña, recupere <a href="/recuperar">aquí</a></p>
	</div>
<?php  
} 
else 
{
include "modulos/panel/menupanel.php";	
if (!empty($_GET['idsec2']))	
{
	$sqlop = db_query("SELECT * FROM  weboperaciones WHERE camioperacion ='".$_GET['idsec2']."' and ctipoperacion='U' ");
	while ($rowop = db_fetch_array($sqlop))
		{
			include "modulos/panel/".$rowop['cincoperacion'];
		}
}
else
{
?>
	<table width="100%" border='0' align='center' cellpadding='0' cellspacing='0'  >
	<tr>
		<td class="title" colspan="2"><b>Mensajes para el usuario panel</td>
	</tr>
	<tr>
		<td width="90" align="center" class="colgrishome"><img src="/estilos/images/user.png" /></td>
		<td  class="colblancocen">
	    <b>Administrador </b>Recomienda<br />
	    <p><b>Actualize sus datos</b></p>
	    <p>Muchas gracias por visitar nuestra zona de clientes, aqui le ofreceremos información acerca de nuestra promociones y ofertas de servicios que brindamos, por ello le recomendamos que actualize sus datos del perfil de usuario en el icono mi perfil</p>
	    <b>Publicado el  1 diciembre de 2010</b><br />
	    num <?=$_SESSION['ocarrito']->array_codfec[0]?>
		</td>
	</tr>    
	</table>
<?php  }} ?>
