<?php 
if(isset($_POST['submitbutton'])) 
{
	    $mensaje = "Datos del mensaje:<br>";
		$mensaje .= "---------------------------------------------------------------------------<br>";
	    $mensaje .= "Nombres   : " . $_POST["nombre"] . "<br>";
	    $mensaje .= "Correo    : " . $_POST["correo"] . "<br>";
	    $mensaje .= "Empresa   : " . $_POST["empresa"] . "<br>";
	    $mensaje .= "Pais      : " . $_POST["pais"] . "<br>";
	    $mensaje .= "Ciudad    : " . $_POST["ciudad"] . "<br>";
	    $mensaje .= "Telefono  : " . $_POST["telefono"] . "<br>";
	    $mensaje .= "Mensaje   : " . $_POST["mensaje"] . "<br>";
		$mensaje .= "---------------------------------------------------------------------------<br>";
		$para    = $emailcontacto;
		$paraweb = $emailventas;
		$asunto  = "Consulta desde pagina web  ";
		
	if ($_SESSION['security_code'] == $_POST['security_code'])
	{		
		$sqlcontacto = "INSERT INTO personabuzon 
					(ccodpage,cdespersona,cnommensaje,cestmensaje,cemamensaje,casumensaje,cdesmensaje,dfecmensaje)
					VALUES
					('".$codpage."','11061212','".$_POST[nombre]."','1','".$_POST[correo]."','".$asunto."','".$mensaje."',now() )";
		db_query($sqlcontacto);
		
		require('include/sendmail/class.phpmailer.php');
		$mail = new phpmailer();
		$mail->Mailer    = "sendmail";
		$mail->SMTPAuth  = true;
		$mail->Host      = $mailserver;
		$mail->Username  = $mailuser;
		$mail->Password  = $mailpass;
		$mail->From      = $_POST["correo"];
		$mail->FromName  = $_POST["nombre"];
		$mail->IsHTML(true);
		$mail->AddAddress($para);
		$mail->AddAddress($paraweb);
		$mail->Subject   = $asunto;
		$mail->Body      = $mensaje;
		$mail->Send();
		
		echo "<br>";
		echo "<p align='center'><img src='/web/mensajeenviado.jpg'></p>";
    	echo "<p>".contactos_ok."</p>";
		echo "<br>";
	}
	else
	{
		echo "<br>";
		echo "<p align='center'><img src='/web/mensajeenviado.jpg'></p>";
    	echo "<p>".contactos_error."</p>";
		echo "<br>";
	}


}
else
{
include "modulos/web_seccioncab.php";
?>
<div id="articulo">
    <?php 
		$sqlsucursal=db_query("SELECT * FROM pagesucursal WHERE ccodpage='".$codpage."' and cestsucursal='1' ORDER BY ccodsucursal");
		while($rowsucursal=db_fetch_array($sqlsucursal))
		{
	?>
	<br />    
    <ul>
		<li><b><?=$rowsucursal['cnomsucursal']?>:</b> <?=$rowsucursal['cdiroficina']?></li>
		<li><b><?=contactos_telefono?>:</b> <?=$rowsucursal['ctelsucursal']?></li>
		<li><b><?=contactos_correo?>:</b> <?=$rowsucursal['cemasucursal']?></li>
	</ul>
    <br />
	<?php  } ?>        
</div>    

<div id="formcuenta">
	<form  name="frm_contactos" action="#" method="post">
		<label><?=contactos_nombre?></label><input name="nombre"  id="nombre" type="text"  size="54" class="cuadro"><br>
		<label><?=contactos_empresa?></label><input name="empresa"  id="empresa" type="text"  size="54" class="cuadro"><br>
		<label><?=contactos_correo?></label><input name="correo"  id="correo" type="text"  size="54" class="cuadro"><br>
        <label><?=contactos_pais?></label>
        <select name='pais' class="combo">
		<?php 
		$sqlpais=db_query("SELECT * FROM webubigeo WHERE  cnivubigeo='1' ORDER BY cnomubigeo");
		while($rowpais=db_fetch_array($sqlpais))
		{
			if ($rowpais['ccodubigeo']=='PE000000')
				echo "<option value=".$rowpais['ccodubigeo']." selected>".$rowpais['cnomubigeo']."</option>";
			else
				echo "<option value=".$rowpais['ccodubigeo'].">".$rowpais['cnomubigeo']."</option>";
			
		} 
		?>
		</select><br>
		<label><?=contactos_ciudad?></label><input name="ciudad"  id="ciudad" type="text"  size="30" class="cuadromin"><br>
		<label><?=contactos_telefono?></label><input name="telefono"  id="telefono" type="text"  size="20" class="cuadromin"><br>
        <label><?=contactos_consulta?></label><textarea name="mensaje" id="mensaje" cols="40" rows="5" class="cuadroarea"></textarea><br>
		<label>&nbsp;</label><img src="/include/captcha.php?width=100&height=40&characters=6"  class="imagen"><br>
		<label><?=contactos_seguro?></label><input id="security_code" name="security_code" type="text"  maxlength="6" class="cuadromin"><br>
		<label>&nbsp;</label><input type="submit" name="submitbutton" id="submitbutton" value="<?=contactos_enviar?>" class="formboton"><br>
	</form>
	<script type="text/javascript">
		var txtnombre = new LiveValidation('nombre',{ validMessage: "Ok" });
		txtnombre.add(Validate.Presence,{failureMessage: "x"});
		txtnombre.add(Validate.Length, { minimum: 3, tooShortMessage:"Min 3c "});
		var txtemail = new LiveValidation('correo',{ validMessage: "Ok" });
		txtemail.add(Validate.Presence, {failureMessage: "x"});
		txtemail.add(Validate.Email,{failureMessage: "Error email"} );
		var txtcodigo = new LiveValidation('security_code',{ validMessage: "Ok" });
		txtcodigo.add(Validate.Presence,{failureMessage: "x"});
		txtcodigo.add(Validate.Length, { minimum: 6, tooShortMessage:"Min 6c"});
	</script>  
</div>
<?php 
}
?>
