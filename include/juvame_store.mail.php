<?php 
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
Ud. ha realizado un consulta en nuestra pagina web <br><br>";
$mensaje.="<table  width='700'  border='0' cellpadding='0' cellspacing='0'>
    <tr >
      <td colspan='2' ".$title." >Datos del Cliente</td>
    </tr>
    <tr>
      <td ".$colgrishome." width='150'>Nombre</td>
      <td ".$colblancoend."'>".$this->cliente_nombre."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Email</td>
      <td ".$colblancoend.">".$this->cliente_email."</td>
	</tr>
    <tr>
      <td ".$colgrishome." >Telefono</td>
      <td ".$colblancoend.">".$this->cliente_tele."</td>
	</tr>
</table>
<table  width='700' border='0' cellpadding='0' cellspacing='0'>
    <tr >
      <td colspan='3' ".$title.">Pedido Nro: ".$this->numpedido."</td>
    </tr>
    <tr>
      <td width='80' ".$titlehome." >Codigo</td>
      <td width='100' ".$titlecen." >Imagen</td>
      <td ".$titleend." >Producto</td>
    </tr>";
	$suma =0;
	for ($i=0;$i<$this->num_productos;$i++)
		{
			$importe =$this->array_pcan[$i] * $this->array_ppre[$i];
			$suma= $suma+ $importe;
$mensaje .="<tr>
      <td ".$colblancohome."> S/N</td>
      <td ".$colblancocen."><img src='http://www.schasociados.com/".$this->array_pimg[$i]."' width='100'></td>
      <td ".$colblancoend."><b>".$this->array_pnom[$i]."</b><br>".$this->array_pres[$i]."</td>
    </tr>";
		} 
		$this->totaldocumento = $suma;
$mensaje .="   
    <tr >
      <td  ".$colgrishome.">Comentarios</td>
      <td colspan='2' ".$colblancoend.">".$comenta."</td>
    </tr>
    <tr >
      <td colspan='3' ".$colgrishome.">
      <b>Muchas gracias, En breve le estaremos le estaremos enviando una cotizacion, para cualquier consulta adicional quedamos a su disposición </b><br>
      </td>
	</tr>          
</table><br>";
$mensaje .="Atentamente,<br><br>";
$mensaje .="Samuel Chamochumbe & Asociados SAC <br>";

$asunto   = "Pedido Nro.  ".$nrodoc;
$para     = "informes@schasociados.com";
$paracliente = $this->cliente_email;
require('include/sendmail/class.phpmailer.php');
$mail = new phpmailer();
$mail->Mailer    = "sendmail";
$mail->SMTPAuth  = true;
$mail->Host      = $mailserver;
$mail->Username  = $mailuser;
$mail->Password  = $mailpass;
$mail->From      = "informes@schasociados.com";
$mail->FromName  = "Samuel Chamochumbi & Asociados";
$mail->IsHTML(true);
$mail->AddAddress($para);
$mail->AddAddress($paracliente);
$mail->Subject   = $asunto;
$mail->Body      = $mensaje;
$mail->Send();
?>

