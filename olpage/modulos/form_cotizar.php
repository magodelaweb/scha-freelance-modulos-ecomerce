<?php 
if(isset($_POST['submitbutton'])) 
{
$title         ="style='border:#72b1e1 1px solid;background-color:#72b1e1;padding:5px;color:#FFF;'";
$titlehome     ="style='background-color:#72b1e1;border-top:#ffffff 1px solid;border-bottom:#72b1e1 1px solid;border-left:#72b1e1 1px solid;border-right:#72b1e1 1px solid;padding:5px;'";
$titlecen      ="style='background-color:#72b1e1;border-top:#ffffff 1px solid;border-bottom:#72b1e1 1px solid;padding:5px;'";
$titleend      ="style='background-color:#72b1e1;border-top:#ffffff 1px solid;border-bottom:#72b1e1 1px solid;border-right:#72b1e1 1px solid;padding:5px;'";
$colgrishome   ="style='background-color:#d5edff;border-top:1px solid #FFFFFF;border-left:1px solid #72b1e1;border-right:1px solid #72b1e1;border-bottom:1px solid #72b1e1;	padding:3px;'";
$colgriscen    ="style='background-color:#d5edff;border-top:1px solid #FFFFFF;border-left:1px solid #FFFFFF;border-right:1px solid #72b1e1;border-bottom:1px solid #72b1e1;padding:3px;'";
$colgrisend    ="style='background-color:#d5edff;border-top:1px solid #FFFFFF;border-left:1px solid #FFFFFF;border-right:1px solid #72b1e1;border-bottom:1px solid #72b1e1;padding:3px;'";
$colblancohome ="style='background-color:#e9f6fe;border-top:1px solid #FFFFFF;border-bottom:1px solid #72b1e1;border-left:1px solid #72b1e1;border-right:1px solid #72b1e1;padding:3px;'";
$colblancocen  ="style='background-color:#e9f6fe;border-top:1px solid #FFFFFF;border-bottom:1px solid #72b1e1;border-left:1px solid #FFFFFF;border-right:1px solid #72b1e1;padding:3px;'";
$colblancoend  ="style='background-color:#e9f6fe;border-top:1px solid #FFFFFF;border-bottom:1px solid #72b1e1;border-left:1px solid #FFFFFF;border-right:1px solid #72b1e1;padding:3px;'";
$mensaje ="<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>";
$mensaje .="Estimado cliente,<br><br>
Ud. ha realizado un pedido en nuestra página web <br><br>";
$mensaje.="<table  width='700'  border='0' cellpadding='0' cellspacing='0'>
    <tr >
      <td colspan='2' ".$title." >Datos del Cliente</td>
    </tr>
    <tr>
      <td ".$colgrishome." width='150'>Nombre</td>
      <td ".$colblancoend."'>".$_POST["nombre"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Razón Social</td>
      <td ".$colblancoend.">".$_POST["empresa"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >RUC</td>
      <td ".$colblancoend.">".$_POST["ruc"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Teléfono</td>
      <td ".$colblancoend.">".$_POST["telefono"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Ciudad</td>
      <td ".$colblancoend.">".$_POST["ciudad"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Correo</td>
      <td ".$colblancoend.">".$_POST["correo"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Modelo de Motor</td>
      <td ".$colblancoend.">".$_POST["motor"]."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Número de Motor</td>
      <td ".$colblancoend.">".$_POST["nromotor"]."</td>
	</tr>
</table>
<table  width='700' border='0' cellpadding='0' cellspacing='0'>
    <tr >
      <td colspan='4' ".$title.">Datos del Pedido: </td>
    </tr>
    <tr>
      <td width='40' ".$titlehome." >ITEM</td>
      <td  ".$titlecen." >DESCRIPCION</td>
      <td width='50' ".$titlecen." >CANTIDAD</td>
      <td width='100' ".$titleend." >MARCA</td>
    </tr>
	<tr>
      <td ".$colblancohome.">01.-</td>
      <td ".$colblancocen.">".$_POST["p01"]."</td>
      <td ".$colblancocen.">".$_POST["c01"]."</td>
      <td ".$colblancoend.">".$_POST["m01"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">02.-</td>
      <td ".$colblancocen.">".$_POST["p02"]."</td>
      <td ".$colblancocen.">".$_POST["c02"]."</td>
      <td ".$colblancoend.">".$_POST["m02"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">03.-</td>
      <td ".$colblancocen.">".$_POST["p03"]."</td>
      <td ".$colblancocen.">".$_POST["c03"]."</td>
      <td ".$colblancoend.">".$_POST["m03"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">04.-</td>
      <td ".$colblancocen.">".$_POST["p04"]."</td>
      <td ".$colblancocen.">".$_POST["c04"]."</td>
      <td ".$colblancoend.">".$_POST["m04"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">05.-</td>
      <td ".$colblancocen.">".$_POST["p05"]."</td>
      <td ".$colblancocen.">".$_POST["c05"]."</td>
      <td ".$colblancoend.">".$_POST["m05"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">06.-</td>
      <td ".$colblancocen.">".$_POST["p06"]."</td>
      <td ".$colblancocen.">".$_POST["c06"]."</td>
      <td ".$colblancoend.">".$_POST["m06"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">07.-</td>
      <td ".$colblancocen.">".$_POST["p07"]."</td>
      <td ".$colblancocen.">".$_POST["c07"]."</td>
      <td ".$colblancoend.">".$_POST["m07"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">08.-</td>
      <td ".$colblancocen.">".$_POST["p08"]."</td>
      <td ".$colblancocen.">".$_POST["c08"]."</td>
      <td ".$colblancoend.">".$_POST["m08"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">09.-</td>
      <td ".$colblancocen.">".$_POST["p09"]."</td>
      <td ".$colblancocen.">".$_POST["c09"]."</td>
      <td ".$colblancoend.">".$_POST["m09"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">10.-</td>
      <td ".$colblancocen.">".$_POST["p10"]."</td>
      <td ".$colblancocen.">".$_POST["c10"]."</td>
      <td ".$colblancoend.">".$_POST["m10"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">11.-</td>
      <td ".$colblancocen.">".$_POST["p11"]."</td>
      <td ".$colblancocen.">".$_POST["c11"]."</td>
      <td ".$colblancoend.">".$_POST["m11"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">12.-</td>
      <td ".$colblancocen.">".$_POST["p12"]."</td>
      <td ".$colblancocen.">".$_POST["c12"]."</td>
      <td ".$colblancoend.">".$_POST["m12"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">13.-</td>
      <td ".$colblancocen.">".$_POST["p13"]."</td>
      <td ".$colblancocen.">".$_POST["c13"]."</td>
      <td ".$colblancoend.">".$_POST["m13"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">14.-</td>
      <td ".$colblancocen.">".$_POST["p14"]."</td>
      <td ".$colblancocen.">".$_POST["c14"]."</td>
      <td ".$colblancoend.">".$_POST["m14"]."</td>
    </tr>
	<tr>
      <td ".$colblancohome.">15.-</td>
      <td ".$colblancocen.">".$_POST["p15"]."</td>
      <td ".$colblancocen.">".$_POST["c15"]."</td>
      <td ".$colblancoend.">".$_POST["m15"]."</td>
    </tr>
	<tr>
      <td ".$titlehome." colspan='4'>".$_POST["mensaje"]."</td>
    </tr>
	
</TABLE>
<br>
Nota: En breve le estaremos respondiendo a su solicitud de cotización. 
<br>
Atentamente,
<br>
<br>
RYS DISTRIBUCIONES


";

$para    = "gerencia@rysdistribuciones.com";
$paraweb = $_POST["correo"];
$asunto  = "Cotizacion desde pagina web  ";
		
		
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
    	echo "<p>".contactos_ok."</p>";
		echo "<br>";


}
else
{
?>
<h1><?=$webtitu?></h1>

<div id="formcuenta">
 	<p><?=$webdesc?></p>
	<form  name="frm_contactos" action="#" method="post">
		<label>Nombres y Apellidos</label><input name="nombre"  id="nombre" type="text"  size="54" class="cuadro"><br>
		<label>Razon Social</label><input name="empresa"  id="empresa" type="text"  size="54" class="cuadro"><br>
		<label>Ruc</label><input name="ruc"  id="ruc" type="text"  size="54" class="cuadromin"><br>
		<label><?=contactos_correo?></label><input name="correo"  id="correo" type="text"  size="54" class="cuadro"><br>
		<label><?=contactos_ciudad?></label><input name="ciudad"  id="ciudad" type="text"  size="30" class="cuadromin"><br>
		<label><?=contactos_telefono?></label><input name="telefono"  id="telefono" type="text"  size="20" class="cuadromin"><br>
		<label>Modelo de Motor</label><input name="motor"  id="motor" type="text"  size="20" class="cuadromin"><br>
		<label>Número de Motor</label><input name="nromotor"  id="nromotor" type="text"  size="20" class="cuadromin"><br>
        <table width="680" align="center" cellpadding="0" cellspacing="0" border="0" style="border:1px #CCC solid">
        <tr>
        	<td width="30" class="titlehome">ITEM</td>
        	<td class="titlecen">DESCRIPCION</td>
            <td width="50" class="titlecen">CANTIDAD</td>
            <td width="100" class="titleend">MARCA</td>
        </tr>
        <tr>
        	<td class="colgrishome">01.-</td>
            <td class="colblancocen"><input name="p01"  id="p01" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c01"  id="c01" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m01"  id="m01" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">02.-</td>
            <td class="colblancocen"><input name="p02"  id="p02" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c02"  id="c02" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m02"  id="m02" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">03.-</td>
            <td class="colblancocen"><input name="p03"  id="p03" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c03"  id="c03" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m03"  id="m03" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">04.-</td>
            <td class="colblancocen"><input name="p04"  id="p04" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c04"  id="c04" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m04"  id="m04" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">05.-</td>
            <td class="colblancocen"><input name="p05"  id="p05" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c05"  id="c05" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m05"  id="m05" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">06.-</td>
            <td class="colblancocen"><input name="p06"  id="p06" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c06"  id="c06" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m06"  id="m06" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">07.-</td>
            <td class="colblancocen"><input name="p07"  id="p07" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c07"  id="c07" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m07"  id="m07" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">08.-</td>
            <td class="colblancocen"><input name="p08"  id="p08" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c08"  id="c08" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m08"  id="m08" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">09.-</td>
            <td class="colblancocen"><input name="p09"  id="p09" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c09"  id="c09" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m09"  id="m09" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">10.-</td>
            <td class="colblancocen"><input name="p10"  id="p10" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c10"  id="c10" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m10"  id="m10" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">11.-</td>
            <td class="colblancocen"><input name="p11"  id="p11" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c11"  id="c11" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m11"  id="m11" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">12.-</td>
            <td class="colblancocen"><input name="p12"  id="p12" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c12"  id="c12" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m12"  id="m12" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">13.-</td>
            <td class="colblancocen"><input name="p13"  id="p13" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c13"  id="c13" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m13"  id="m13" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">14.-</td>
            <td class="colblancocen"><input name="p14"  id="p14" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c14"  id="c14" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m14"  id="m14" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>
        <tr>
        	<td class="colgrishome">15.-</td>
            <td class="colblancocen"><input name="p15"  id="p15" type="text"   maxlength="150" class="cuadrocotiza" style="width:390px;"></td>
            <td class="colblancocen"><input name="c15"  id="c15" type="text"   maxlength="10" class="cuadrocotiza" style="width:40px;"></td>
            <td class="colblancoend"><input name="m15"  id="m15" type="text"   maxlength="30" class="cuadrocotiza"></td>
        </tr>

        </table>
        <br />
        <label>Comentarios adicionales</label><textarea name="mensaje" id="mensaje" cols="40" rows="5" class="cuadroarea"></textarea><br>
		<label>&nbsp;</label><input type="submit" name="submitbutton" id="submitbutton" value="<?=contactos_enviar?>" class="enviar"><br>
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
