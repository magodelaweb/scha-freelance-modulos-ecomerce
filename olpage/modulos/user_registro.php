<?php 
$saveok="0";
if($_POST['submitbutton'])
{
	$error_form = "";
	$saveok="0";
	$sql    = "SELECT cnompersona FROM persona  WHERE cemapersona ='".$_POST['correo']."'";
    $query  = db_query($sql);
   	$total  = db_num_rows($query);
    if($total>0) 
	{						
		$error_form = "Esta correo electronico ya ha sido registrada, intente con otro correo electronico";	 
  	}	
	if ($error_form == "")
	{
		if ($_POST['bole']) $boletin="1"; else $boletin='0';
		
		$sqlcad     = db_query("SELECT MAX(ccodpersona)+1 FROM persona");
		list($new_cod) = mysql_fetch_array($sqlcad);
		if(!isset($new_cod))	$new_cod='11061213';

		$ccodauto = generar_password (10);

		$sql_insert= "INSERT INTO persona(
						ccodpersona,cnompersona,cemapersona,cpaspersona,cnivpersona,cestpersona,cestsuscripcion,
						csexpersona,dnacpersona,ntelefono,cimgpersona,ccodubigeo,cciudad,ccodidioma,
						nvispersona,ccodautenticacion,dfecpersona)				    VALUES (
					'".$new_cod."',
					'".$_POST['nombre']."',
					'".$_POST['correo']."',
					'".md5($_POST['password'])."',
					'1',
					'0',
					'".$boletin."',
					'M',
					'1980-01-01',
					'',
					'hnohayfoto.jpg',
					'".$_POST['pais']."',
					'".$_POST['ciudad']."',
					'es',
					'0',
					'".$ccodauto."',
					now())";
		$query = db_query($sql_insert);
		$sqlenlace= "INSERT INTO personapage(ccodpersona,ccodpage,ccodperfil) VALUES('".$new_cod."','".$codpage."','')";
		$query = db_query($sqlenlace);
		

	    $cuerpo  = "Le damos la bienvenida a la comunidad de <b>".$webnombre."</b><br><br>";
	    $cuerpo .= "<b>Datos registrados :</b><br>";
	    $cuerpo .= "Nombres y apellidos  : " . $_POST["nombre"] . "<br>";
	    $cuerpo .= "Correo Electronico: " . $_POST["correo"] . "<br>";
	    $cuerpo .= "Contraseña: " . $_POST["password"] . "<br>";
	    $cuerpo .= "Pais : " . nombre_pais($_POST["pais"]) . "<br>";
	    $cuerpo .= "Ciudad  : " . $_POST["ciudad"] . "<br>";
		$cuerpo .= "Para confirmar su registro haga click en el enlace adjunto<br>";
	    $cuerpo .= "<a href='http://".$subdominio."/confirmar.php?idok=".$ccodauto."'>http://".$subdominio."/confirmar.php?idok=".$ccodauto."</a><br><br>";
	    $cuerpo .= "Para cualquier duda no dude en escribir a <a href='mailto:".$emailsoporte."'>".$emailsoporte."</a><br><br>";
		$cuerpo .= "Atentamente,<br><br>";
		$cuerpo .= "<b>".$webnombre."</b><br><br>";
		
		$para   = $_POST['correo'];
		require('include/sendmail/class.phpmailer.php');
		$mail = new phpmailer();
		$mail->Mailer    = "sendmail";
		$mail->SMTPAuth  = true;
		$mail->Host      = $mailserver;
		$mail->Username  = $mailuser;
		$mail->Password  = $mailpass;
		$mail->From      = $emailsoporte;
		$mail->FromName  = $webnombre;
		$mail->IsHTML(true);
		$mail->AddAddress($para);
		$mail->Subject   = "Confirmación registro en ".$webnombre;
		$mail->Body      = $cuerpo;
		$mail->Send();
		$saveok="1";
	}
}
if ($saveok=="0")
{
?>
<h1><?=registro_titulo?></h1>
 <p><?=registro_detalle?></p>
<div id="formcuenta">
<br />
	<form name="form1" method="post" action="" onSubmit="return validar_registrousuarios(this)" >
		<label><?=registro_nombre?></label><input type="text" id="nombre" name="nombre" maxlength="100"  size="50"  class="cuadro"/><br>
		<label><?=registro_correo?></label><input type="text" id="correo" name="correo" maxlength="100"  size="50"  class="cuadro"/><br>
		<label><?=registro_password?></label><input type="password" id="password"  name="password" class="cuadromin"/><br>
        <label><?=registro_pais?></label><select name='pais' class="combo" >
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
		</select><br />
        
		<label><?=registro_ciudad?></label><input type="text" id="ciudad" name="ciudad" maxlength="100"  size="50"  class="cuadromin"/><br>
        <label>&nbsp;</label><input name="bole" id="bole" type="checkbox"  checked="checked"/> <?=registro_suscripcion?><br><br />
		<label>&nbsp;</label><input type="submit" name="submitbutton" id="submitbutton" value="<?=registro_enviar?>"  style="width:100px;padding:3px; border:1px solid #cc0000; color:#fff;  background-color:#cc0000; cursor:pointer; margin-top:8px;"><br>
       
	</form>
<p><font color="#FF0000"><?php   echo $error_form;?></font></p><br>
</div>
		<script type="text/javascript">
			var txtnombre = new LiveValidation('nombre',{ validMessage: "ok" });
			txtnombre.add(Validate.Presence,{failureMessage: "(*)"});

			var txtemail = new LiveValidation('correo',{ validMessage: "ok" });
			txtemail.add(Validate.Presence, {failureMessage: "(*)"});
			txtemail.add(Validate.Email,{failureMessage: "Error"} );

			var txtpas = new LiveValidation('password',{ validMessage: "ok" });
			txtpas.add(Validate.Presence, {failureMessage: "(*)"});
			txtpas.add(Validate.Length, { minimum: 6, maximum: 20,tooShortMessage:"6 Caracteres como minimos",tooLongMessage:"6 caracteres"});
</script>  

<?php 
}
else
{
?>
<br />
	<h1>¡Bienvenido a <?=$webnombre?>!</h1>
	<p>En breve recibir&aacute; un mensaje para validar su registro. Solo tiene que  verificar su cuenta de correo. Si no  lo recibiera, revise  su carpeta de correo no deseado, algunos sistemas pueden confundirlo con spam.</p> 
    <p>Si tiene alguna duda o consulta escr&iacute;banos a <a href="<?=$emailsoporte?>"><?=$emailsoporte?></a></p><br>
	<p>Gracias por confiar en el equipo de <?=$webnombre?></p>
<?php 
}
?>

