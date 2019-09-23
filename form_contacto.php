
<div>
<div class="textblog" style="border:none;">

<?php
/*echo "<script language='JavaScript'>
                alert('paramSec: ".$paramSec."');
                </script>";*/
if(isset($_POST['submitbutton'])) {
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
		$destinatario = 'jchojeda@schasociados.com';
		$asunto  = "Consulta desde pagina web  ";

	if ($_SESSION['security_code'] == $_POST['security_code']){
		$sqlcontacto = "INSERT INTO personabuzon
						(ccodpage,cdespersona,cnommensaje,cestmensaje,cemamensaje,casumensaje,cdesmensaje,dfecmensaje)
						VALUES
						('".$codpage."','11061212','".$_POST[nombre]."','1','".$_POST[correo]."','".$asunto."','".$mensaje."',now() )";
		$aclass->consulta($sqlcontacto);

		$server='nextsoluciones.nslatino.com';
		$nombre=$_POST["nombre"];;
		$nomDest='Jonatan Chojeda';
	    $pass='wmscha.4833';
		// Pear Mail Library
		require("include/sendmail/class.phpmailer.php");
		require("include/sendmail/class.smtp.php");
		$from = 'webmaster@schasociados.com';
		$ReplyTo=$_POST["correo"];

		$mail = new PHPMailer();

	    $mail->SetLanguage("es", "");
	    $mail->CharSet = "UTF-8";
	    $mail->IsSMTP();
	    $mail->SMTPAuth = true;
	 	$mail->SMTPSecure = 'tls';
	    $mail->Host = $server;
	    $mail->Port = 25;

	    $mail->Username = $from;
	    $mail->Password = $pass;

	    $mail->AddAddress($destinatario,$nomDest);
	    $mail->AddReplyTo($ReplyTo ,$nombre);
	    $mail->SetFrom($from ,$nombre);

	    $mail->IsHTML(true);
	    $mail->Subject = $asunto;
	    $mail->Body =$mensaje;
	    $mail->AltBody = htmlspecialchars($mensaje);


		/*echo "<script language='JavaScript'>
                alert('host: ".$mailserver."');
		        alert('username: ".$mailuser."');
		        alert('password: ".$mailpass."');
		        alert('From: ".$_POST["correo"]."');
		        alert('FromName: ".$_POST["nombre"]."');
		        alert('AddAddress: ".$para."');
		        alert('AddAddress: ".$paraweb."');
		        alert('Asunto: ".$asunto."');
		        alert('Mensaje: ".$mensaje."');
		        </script>"; */
		if( !$mail->Send() )
		    {
		        echo "<br>";
				echo "<p align='center'><img src='/web/mensajeNoenviado.png'></p>";
		    	echo "<p>El mensaje se envi&oacute; a la p&aacute;gina web pero ocurri&oacute; un error en el servicio de correo electr&oacute;nico. Vuelva a intentar en unos minutos</p>";
				echo "<br>";
		        exit();
		    }
		    else
		    {
		        echo "<br>";
				echo "<p align='center'><img src='/web/mensajeenviado.png'></p>";
		    	echo "<p>Su mensaje ha sido enviado correctamente. En las proximas horas le estaremos atendiendo. Utilice los botones de navegaci&oacute;n para continuar.</p>";
				echo "<br>";
		        exit();
		    }

	}else{
		echo "<br>";
		echo "<p align='center'><img src='/web/mensajeenviado.png'></p>";
    	echo "<p>Su mensaje no ha sido enviado. por error en el codigo de seguridad.</p>";
		echo "<br>";
	}
}
?>

 <p>Si desea mas informaci&oacute;n sobre nuestros equipos y servicios que brindamos puede contactarse usando la informaci&oacute;n adjunta o puede rellenar el formulario siguiente:</p><br/>
 <p>&bull;&nbsp;<b>Direcci&oacute;n:</b> Calle San Luis Mza G1 Lte 3 Urb. Villa Marina, Chorrillos<br/>
 &bull;&nbsp;<b>Telefonos:</b> (511) 254-0995 – 965-903000 – RPM #965-903000 - Entel: 981-578763 <!--– 41*157*8763--><br/>
 &bull;&nbsp;<b>Contacto:</b> Jonathan Chojeda B.<br/>
 &bull;&nbsp;<b>Correo Electr&oacute;nico:</b> jchojeda@schasociados.com</p>
<br/>
<div id="formcuenta">
	<form  name="frm_contactos" action="#" method="post">
		<div><label style="padding-right:21px;">Nombres y Apellidos</label><input name="nombre"  id="nombre" type="text"  size="30" class="cuadro"></div>
		<div><label style="padding-right:100px;">Empresa</label><input name="empresa"  id="empresa" type="text"  size="30" class="cuadro"></div>
		<div><label style="padding-right:36px;">Correo Electr&oacute;nico</label><input name="correo"  id="correo" type="text"  size="30" class="cuadro"></div>
        <div><label style="padding-right:129px;">Pa&iacute;s</label>
        <select name='pais' class="combo">
		<?php
		$aclass->consulta("SELECT * FROM webubigeo WHERE  cnivubigeo='1' ORDER BY cnomubigeo");
		while($rowpais = $aclass->respuesta()){
			if ($rowpais['ccodubigeo']=='PE000000')
				echo "<option value=".$rowpais['ccodubigeo']." selected>".utf8_encode($rowpais['cnomubigeo'])."</option>";
			else
				echo "<option value=".$rowpais['ccodubigeo'].">".utf8_encode($rowpais['cnomubigeo'])."</option>";
		}
		?>
		</select></div>
		<div><label style="padding-right:115px;">Ciudad</label><input name="ciudad"  id="ciudad" type="text"  size="30" class="cuadromin"></div>
		<div><label style="padding-right:103px;">Tel&eacute;fono</label><input name="telefono"  id="telefono" type="text"  size="20" class="cuadromin"></div>
        <div><label style="padding-right:103px;">Consulta</label><textarea name="mensaje" id="mensaje" cols="25" rows="5" class="cuadroarea"></textarea></div>
		<div><label style="padding-right:155px;">&nbsp;</label><img src="/include/captcha.php?width=100&height=40&characters=6"  class="imagen"></div>
		<div><label style="padding-right:22px;">C&oacute;digo de Seguridad</label><input id="security_code" name="security_code" type="text"  maxlength="6" class="cuadromin"></div><br/>
		<div style="margin:0 auto; text-align:center;"><input type="submit" name="submitbutton" id="submitbutton" value="Enviar Consulta" class="formboton"></div><br/>
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
</div>
</div>
