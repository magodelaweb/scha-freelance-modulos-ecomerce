
<?php 
if ($_GET['idsec2']=='2')
{

	$savenva="0";
	if($_POST['nvoenviar'])
	{
		$sqlcontenido = db_query("SELECT ccodpersona FROM  persona WHERE cemapersona='".$_POST[email]."' and ccodautenticacion='".$_POST[idcod]."'");
		$row          = db_fetch_array($sqlcontenido);
		$total        = db_num_rows($sqlcontenido);
	    if($total>0)
		{
			$xcod       = $row['ccodpersona'];
			$xpas       = md5($_POST['nvopass']);
			$sql_update = "update persona set cpaspersona ='".$xpas."' , ccodautenticacion=''	where ccodpersona ='".$xcod."'";
			$query      = db_query($sql_update);
			$savenva="1";
		}
		else
		{
			$error_form = "verifique que su correo electronico y/o codigo de autorizacion sea el correcto";
		}
	}
	if ($savenva=="0")
	{
	?>
		<h1><?=recuperar_titulo?></h1>
		<div id="formcuenta">
		<form action="" method="post" >
			<label>Correo electrónico:</label><input type="text" name="email" size=30 class="cuadro">
			<label>Codigo de Verificacion:</label><input type="text" name="idcod" size=30 class="cuadro">
			<label>Nueva Contraseña :</label><input type="password" name="nvopass" size=30 class="cuadro">
			<label>Reescribir Contraseña :</label><input type="password" name="nvopass2" size=30 class="cuadro">
			<input type="submit" name="nvoenviar" value="Enviar" class="enviar">
		</form>
	    <p><font color="#FF0000"><b><?=$error_form?></b></font></p>
		</div>  
	<?php 
	}
	else
	{
	?>
		<p>Su contraseña fue cambiado existosamente</p> 
	    <p>Ingrese a su cuenta <a href="/micuenta"><b>Aquí</b></a></p>
		<p>Gracias por confiar en el equipo de <?=$webnombre?></p>
	<?php  }
	
}
else {
$saveok="0";
if($_POST['enviar'])
{
		$sqlcontenido = db_query("SELECT ccodpersona FROM  persona WHERE cemapersona='".$_POST['email'] ."'");
		$row          = db_fetch_array($sqlcontenido);
		$total        = db_num_rows($sqlcontenido);
	    if($total>0)
		{
			$ccodauto   = '2010'.generar_password (6);
			$sql_update = "update persona set ccodautenticacion='".$ccodauto."' where  cemapersona='".$_POST['email']."'";
			$query = db_query($sql_update);
			
		    $cuerpo  = "Le damos la bienvenida a la comunidad de <b>".$webnombre."</b><br><br>";
			$cuerpo .= "Para crear una nueva contraseña haga click en enlace siguiente<br>";
			$cuerpo .= "<a href='http://".$subdominio."/recuperar/2'>http://".$subdominio."/recuperar/2</a><br><br>";
			$cuerpo .= "<b>Datos de usuario:</b><br>";
			$cuerpo .= "Email: " . $_POST['email'] . "<br>";
			$cuerpo .= "Codigo Autenticacion: " . $ccodauto . "<br><br>";
		    $cuerpo .= "Atentamente,<br><br>".$webnombre."<br>";

			$para   = $_POST['email'];
			require('include/sendmail/class.phpmailer.php');
			$mail = new phpmailer();
			$mail->Mailer    = "sendmail";
			$mail->SMTPAuth  = true;
			$mail->Host      = $mailserver;
			$mail->Username  = $mailuser;
			$mail->Password  = $mailpass;
			$mail->From      = $webmailto;
			$mail->FromName  = $webempresa;
			$mail->IsHTML(true);
			$mail->AddAddress($para);
			$mail->Subject   = "Recuperacion de contraseña en ".$webnombre;
			$mail->Body      = $cuerpo;
			$mail->Send();
			$saveok="1";
		?>
        
        <?php 
		}
		else
		{
			$error_form = "Este correo electronico no ha sido registrado, verifique que su email sea el correcto";
		}
}
if ($saveok=="0")
{
?>
	<h1><?=recuperar_titulo?></h1>
    <p><?=recuperar_detalle?></p>
    
	<div id="formcuenta">
		<form action="#" method="post" >
		<label>Correo electrónico:</label><input type="text" name="email" size=30 class="cuadro">
		<label>&nbsp;</label><input type="submit" name="enviar" value="Enviar" class="formboton">
		</form>
		<p><font color="#FF0000"><b><?=$error_form?></b></font></p>
	</div>
<?php 
}
else
{
?>
	<p>En breve recibir&aacute; un mensaje para generar su nueva contraseña.<br /> Solo tiene que  verificar su cuenta de correo. Si no  lo recibiera, revise  su carpeta de correo no deseado, algunos sistemas pueden confundirlo con spam.</p> 
	<p>Gracias por confiar en el equipo de <?=$webnombre?></p>
<?php  
	echo $cuerpo;
}
}
?>
