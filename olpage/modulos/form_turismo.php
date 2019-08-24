<?php 
include "modulos/seccion_titulo.php";
if(isset($_POST['submitbutton'])) 
{
	    $cuerpo = "Datos del mensaje:<br>";
		$cuerpo .= "---------------------------------------------------------------------------<br>";
	    $cuerpo .= "Nombres   : " . $_POST["nombre"] . "<br>";
	    $cuerpo .= "Correo    : " . $_POST["correo"] . "<br>";
	    $cuerpo .= "Pais      : " . $_POST["selectpais"] . "<br>";
	    $cuerpo .= "Ciudad    : " . $_POST["ciudad"] . "<br>";
	    $cuerpo .= "Telefono  : " . $_POST["telefono"] . "<br>";
	    $cuerpo .= "Destinos  : ";
		$sqlsec = db_query("SELECT * FROM destinos order by ccoddestino");
		while($rowsec = db_fetch_array($sqlsec)) 
		{
			$varcamp = "s".$rowsec['ccoddestino'];
			$varsecc = $_POST[$varcamp];
			if($varsecc)
			{
				$cuerpo .=	$rowsec['cnomdestino'].", ";
			}
		}
		$cuerpo .= "<br>";
		$cuerpo .= "Fecha de viaje   : " . $_POST["entradadia"] . "-".$_POST["entradames"]."-".$_POST["entradaano"]."<br>";
		$cuerpo .= "Nro de dias   : " . $_POST["nrodias"] . "<br>";
		$cuerpo .= "Nro de Personas   : " . $_POST["nropersonas"] . "<br>";
		$cuerpo .= "Tipo Hotel   : " . $_POST["hcategorias"] . "<br>";
		$cuerpo .= "Tipo Habitacion   : " . $_POST["hhabitacion"] . "<br>";
		$cuerpo .= "Tipo Regimen   : " . $_POST["hregimen"] . "<br>";
	    $cuerpo .= "Comentarios   : " . $_POST["mensaje"] . "<br>";
		$cuerpo .= "---------------------------------------------------------------------------<br>";
		$para    = "informes@turismoperu.com";
		$asunto   = "Consulta Turismo Peru ";
		
		$sqlcontacto = "INSERT INTO personabuzon 
					(ccodpersona,cnommensaje,cemamensaje,casumensaje,cdesmensaje,dfecmensaje)
					VALUES
					('".WEB_CODEMPRESA."','".$_POST[nombre]."','".$_POST[correo]."','".$asunto."','".$cuerpo."',now() )";
		// db_query($sqlcontacto);
		
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
		$mail->Subject   = $asunto;
		$mail->Body      = $cuerpo;
		$mail->Send();
		
		echo "<br>";
		echo "<p align='center'>&nbsp;</p>";
    	echo "<p>Su consulta ha sido enviado correctamente. <br>En las proximas horas le estaremos atendiendo con la información solicitada.</p>";
		echo "<br>";

}
else
{
?>

<div id="formcuenta">
	<br>
    <br>
	<p>Esta interesado en conocer el Perú, escribe en el formulario las preferencias turisticas, servicios y fechas aproximadas para tu viaje, para asi nosotros enviarte la informacion correcta: </p>
	<form  name="frm_contactos" action="#" method="post">
		<label>Nombres </label><input name="nombre"  id="nombre" type="text"  size="54" class="cuadro"><br>
		<label>Email</label><input name="correo"  id="correo" type="text"  size="54" class="cuadro"><br>
        <label>Pais de Procedencia</label>
        <select name='selectpais' class="cuadropais">
        <option value=AF000000>AFGANISTÁN</option><option value=AL000000>ALBANIA</option><option value=DE000000>ALEMANIA</option><option value=AD000000>ANDORRA</option><option value=AO000000>ANGOLA</option><option value=AI000000>ANGUILLA</option><option value=AQ000000>ANTÁRTIDA</option><option value=AG000000>ANTIGUA Y BARBUDA</option><option value=AN000000>ANTILLAS HOLANDESAS</option><option value=SA000000>ARABIA SAUDÍ</option><option value=DZ000000>ARGELIA</option><option value=AR000000>ARGENTINA</option><option value=AM000000>ARMENIA</option><option value=AW000000>ARUBA</option><option value=MK000000>ARY MACEDONIA</option><option value=AU000000>AUSTRALIA</option><option value=AT000000>AUSTRIA</option><option value=AZ000000>AZERBAIYÁN</option><option value=BS000000>BAHAMAS</option><option value=BH000000>BAHRÉIN</option><option value=BD000000>BANGLADESH</option><option value=BB000000>BARBADOS</option><option value=BE000000>BÉLGICA</option><option value=BZ000000>BELICE</option><option value=BJ000000>BENIN</option><option value=BM000000>BERMUDAS</option><option value=BT000000>BHUTÁN</option><option value=BY000000>BIELORRUSIA</option><option value=BO000000>BOLIVIA</option><option value=BA000000>BOSNIA Y HERZEGOVINA</option><option value=BW000000>BOTSUANA</option><option value=BR000000>BRASIL</option><option value=BN000000>BRUNÉI</option><option value=BG000000>BULGARIA</option><option value=BF000000>BURKINA FASO</option><option value=BI000000>BURUNDI</option><option value=CV000000>CABO VERDE</option><option value=KH000000>CAMBOYA</option><option value=CM000000>CAMERÚN</option><option value=CA000000>CANADÁ</option><option value=TD000000>CHAD</option><option value=CL000000>CHILE</option><option value=CN000000>CHINA</option><option value=CY000000>CHIPRE</option><option value=VA000000>CIUDAD DEL VATICANO</option><option value=CO000000>COLOMBIA</option><option value=KM000000>COMORAS</option><option value=CG000000>CONGO</option><option value=KP000000>COREA DEL NORTE</option><option value=KR000000>COREA DEL SUR</option><option value=CI000000>COSTA DE MARFIL</option><option value=CR000000>COSTA RICA</option><option value=HR000000>CROACIA</option><option value=CU000000>CUBA</option><option value=DK000000>DINAMARCA</option><option value=DM000000>DOMINICA</option><option value=EC000000>ECUADOR</option><option value=EG000000>EGIPTO</option><option value=SV000000>EL SALVADOR</option><option value=AE000000>EMIRATOS ÁRABES UNIDOS</option><option value=ER000000>ERITREA</option><option value=SK000000>ESLOVAQUIA</option><option value=SI000000>ESLOVENIA</option><option value=ES000000 >ESPAÑA</option><option value=US000000>ESTADOS UNIDOS</option><option value=EE000000>ESTONIA</option><option value=ET000000>ETIOPÍA</option><option value=PH000000>FILIPINAS</option><option value=FI000000>FINLANDIA</option><option value=FJ000000>FIYI</option><option value=FR000000>FRANCIA</option><option value=GA000000>GABÓN</option><option value=GM000000>GAMBIA</option><option value=GE000000>GEORGIA</option><option value=GH000000>GHANA</option><option value=GI000000>GIBRALTAR</option><option value=GD000000>GRANADA</option><option value=GR000000>GRECIA</option><option value=GL000000>GROENLANDIA</option><option value=GP000000>GUADALUPE</option><option value=GU000000>GUAM</option><option value=GT000000>GUATEMALA</option><option value=GF000000>GUAYANA FRANCESA</option><option value=GN000000>GUINEA</option><option value=GQ000000>GUINEA ECUATORIAL</option><option value=GW000000>GUINEA-BISSAU</option><option value=GY000000>GUYANA</option><option value=HT000000>HAITÍ</option><option value=HN000000>HONDURAS</option><option value=HK000000>HONG KONG</option><option value=HU000000>HUNGRÍA</option><option value=IN000000>INDIA</option><option value=ID000000>INDONESIA</option><option value=IR000000>IRÁN</option><option value=IQ000000>IRAQ</option><option value=IE000000>IRLANDA</option><option value=BV000000>ISLA BOUVET</option><option value=CX000000>ISLA DE NAVIDAD</option><option value=NF000000>ISLA NORFOLK</option><option value=IS000000>ISLANDIA</option><option value=KY000000>ISLAS CAIMÁN</option><option value=CC000000>ISLAS COCOS</option><option value=CK000000>ISLAS COOK</option><option value=FO000000>ISLAS FEROE</option><option value=GS000000>ISLAS GEORGIAS DEL SUR Y SANDWICH DEL SUR</option><option value=AX000000>ISLAS GLAND</option><option value=HM000000>ISLAS HEARD Y MCDONALD</option><option value=FK000000>ISLAS MALVINAS</option><option value=MP000000>ISLAS MARIANAS DEL NORTE</option><option value=MH000000>ISLAS MARSHALL</option><option value=PN000000>ISLAS PITCAIRN</option><option value=SB000000>ISLAS SALOMÓN</option><option value=TC000000>ISLAS TURCAS Y CAICOS</option><option value=UM000000>ISLAS ULTRAMARINAS DE ESTADOS UNIDOS</option><option value=VG000000>ISLAS VÍRGENES BRITÁNICAS</option><option value=VI000000>ISLAS VÍRGENES DE LOS ESTADOS UNIDOS</option><option value=IL000000>ISRAEL</option><option value=IT000000>ITALIA</option><option value=JM000000>JAMAICA</option><option value=JP000000>JAPÓN</option><option value=JO000000>JORDANIA</option><option value=KZ000000>KAZAJSTÁN</option><option value=KE000000>KENIA</option><option value=KG000000>KIRGUISTÁN</option><option value=KI000000>KIRIBATI</option><option value=KW000000>KUWAIT</option><option value=LA000000>LAOS</option><option value=LS000000>LESOTHO</option><option value=LV000000>LETONIA</option><option value=LB000000>LÍBANO</option><option value=LR000000>LIBERIA</option><option value=LY000000>LIBIA</option><option value=LI000000>LIECHTENSTEIN</option><option value=LT000000>LITUANIA</option><option value=LU000000>LUXEMBURGO</option><option value=MO000000>MACAO</option><option value=MG000000>MADAGASCAR</option><option value=MY000000>MALASIA</option><option value=MW000000>MALAWI</option><option value=MV000000>MALDIVAS</option><option value=ML000000>MALÍ</option><option value=MT000000>MALTA</option><option value=MA000000>MARRUECOS</option><option value=MQ000000>MARTINICA</option><option value=MU000000>MAURICIO</option><option value=MR000000>MAURITANIA</option><option value=YT000000>MAYOTTE</option><option value=MX000000>MÉXICO</option><option value=FM000000>MICRONESIA</option><option value=MD000000>MOLDAVIA</option><option value=MC000000>MÓNACO</option><option value=MN000000>MONGOLIA</option><option value=MS000000>MONTSERRAT</option><option value=MZ000000>MOZAMBIQUE</option><option value=MM000000>MYANMAR</option><option value=NA000000>NAMIBIA</option><option value=NR000000>NAURU</option><option value=NP000000>NEPAL</option><option value=NI000000>NICARAGUA</option><option value=NE000000>NÍGER</option><option value=NG000000>NIGERIA</option><option value=NU000000>NIUE</option><option value=NO000000>NORUEGA</option><option value=NC000000>NUEVA CALEDONIA</option><option value=NZ000000>NUEVA ZELANDA</option><option value=OM000000>OMÁN</option><option value=NL000000>PAÍSES BAJOS</option><option value=PK000000>PAKISTÁN</option><option value=PW000000>PALAU</option><option value=PS000000>PALESTINA</option><option value=PA000000>PANAMÁ</option><option value=PG000000>PAPÚA NUEVA GUINEA</option><option value=PY000000>PARAGUAY</option><option value=PE000000 selected>PERÚ</option><option value=PF000000>POLINESIA FRANCESA</option><option value=PL000000>POLONIA</option><option value=PT000000>PORTUGAL</option><option value=PR000000>PUERTO RICO</option><option value=QA000000>QATAR</option><option value=GB000000>REINO UNIDO</option><option value=CF000000>REPÚBLICA CENTROAFRICANA</option><option value=CZ000000>REPÚBLICA CHECA</option><option value=CD000000>REPÚBLICA DEMOCRÁTICA DEL CONGO</option><option value=DO000000>REPÚBLICA DOMINICANA</option><option value=RE000000>REUNIÓN</option><option value=RW000000>RUANDA</option><option value=RO000000>RUMANIA</option><option value=RU000000>RUSIA</option><option value=EH000000>SAHARA OCCIDENTAL</option><option value=WS000000>SAMOA</option><option value=AS000000>SAMOA AMERICANA</option><option value=KN000000>SAN CRISTÓBAL Y NEVIS</option><option value=SM000000>SAN MARINO</option><option value=PM000000>SAN PEDRO Y MIQUELÓN</option><option value=VC000000>SAN VICENTE Y LAS GRANADINAS</option><option value=SH000000>SANTA HELENA</option><option value=LC000000>SANTA LUCÍA</option><option value=ST000000>SANTO TOMÉ Y PRÍNCIPE</option><option value=SN000000>SENEGAL</option><option value=CS000000>SERBIA Y MONTENEGRO</option><option value=SC000000>SEYCHELLES</option><option value=SL000000>SIERRA LEONA</option><option value=SG000000>SINGAPUR</option><option value=SY000000>SIRIA</option><option value=SO000000>SOMALIA</option><option value=LK000000>SRI LANKA</option><option value=SZ000000>SUAZILANDIA</option><option value=ZA000000>SUDÁFRICA</option><option value=SD000000>SUDÁN</option><option value=SE000000>SUECIA</option><option value=CH000000>SUIZA</option><option value=SR000000>SURINAM</option><option value=SJ000000>SVALBARD Y JAN MAYEN</option><option value=TH000000>TAILANDIA</option><option value=TW000000>TAIWÁN</option><option value=TZ000000>TANZANIA</option><option value=TJ000000>TAYIKISTÁN</option><option value=IO000000>TERRITORIO BRITÁNICO DEL OCÉANO ÍNDICO</option><option value=TF000000>TERRITORIOS AUSTRALES FRANCESES</option><option value=TL000000>TIMOR ORIENTAL</option><option value=TG000000>TOGO</option><option value=TK000000>TOKELAU</option><option value=TO000000>TONGA</option><option value=TT000000>TRINIDAD Y TOBAGO</option><option value=TN000000>TÚNEZ</option><option value=TM000000>TURKMENISTÁN</option><option value=TR000000>TURQUÍA</option><option value=TV000000>TUVALU</option><option value=UA000000>UCRANIA</option><option value=UG000000>UGANDA</option><option value=UY000000>URUGUAY</option><option value=UZ000000>UZBEKISTÁN</option><option value=VU000000>VANUATU</option><option value=VE000000>VENEZUELA</option><option value=VN000000>VIETNAM</option><option value=WF000000>WALLIS Y FUTUNA</option><option value=YE000000>YEMEN</option><option value=DJ000000>YIBUTI</option><option value=ZM000000>ZAMBIA</option><option value=ZW000000>ZIMBABUE</option>
		</select><br>
		<label>Ciudad</label><input name="ciudad"  id="ciudad" type="text"  size="30" class="cuadromin"><br>
		<label>Telefono</label><input name="telefono"  id="telefono" type="text"  size="20" class="cuadromin"><br>

        <label><b>Destinos de Interes</b></label><br>
        <div id="cuadrobox"  style="border:1px #666666 solid; width:500px; height:250px; overflow:auto; padding:10px; margin-bottom:10px;">
        <?php 
			$seccion_sql = db_query("SELECT * FROM destinos order by ccoddestino");
			while($row = db_fetch_array($seccion_sql)) 
				{
				if ($row['cnivdestino']=="1")
				{	
					$espacio ="&nbsp;";
					echo $espacio.$row['cnomdestino']."<br>";
				}
				if ($row['cnivdestino']=="2")
				{
					$espacio ="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				?>
			        <?=$espacio?>
                    <input type="checkbox" name="s<?=$row['ccoddestino']?>"  >&nbsp;<?=$row['cnomdestino']?><br />
                <?php 
				}
				}		
				?>
        </div>
        
        
        <label>Numero de Dias</label><input name="nrodias"  id="nrodias" type="text"  size="30" class="cuadromin"><br>
        <label>Numero de Personas</label><input name="nropersonas"  id="nropersonas" type="text"  size="30" class="cuadromin"><br>

		<label>Tipo  Alojamiento/ Hotel</label>
        <select name='hcategorias' id='hcategorias'  class="cuadropais">
        <option value="1EST">1 estrella</option>
        <option value="2EST">2 estrellas</option>
        <option value="3EST" selected="selected">3 estrellas</option>
        <option value="4EST">4 estrellas</option>
        <option value="5EST">5 estrellas</option>
        <option value="APAR">Apartamentos</option>
        </select><br>
		<label>Tipo  habitacion</label>
        <select name='hhabitacion' id='hhabitacion'  class="cuadropais">
        <option value="HAB1" selected="selected">Habitacion Simple / Personal</option>
        <option value="HAB2">Habitacion Doble</option>
        <option value="HAB3">Habitacion Triple</option>
        <option value="HABM">Habitacion Matrimonial</option>
        </select><br>
        
        <label>Regimen</label>
        <select name='hregimen' id='hregimen' class="cuadropais">
        <option value="PXXX" selected="selected">Solo Alojamiento</option>
        <option value="PDES">Alojamiento y desayuno</option>
        <option value="PMED">Media pension</option>
        <option value="PCOM">Pension Completa</option>
        <option value="TODO">Todo incluido</option>
        </select><br>
        <label>Fecha de viaje</label>
	<select name="entradadia" style="width:60px" class="selectmin">
	  	<option value="01">01</option>
	  	<option value="02">02</option>
	  	<option value="03">03</option>
	  	<option value="04">04</option>
	  	<option value="05">05</option>
	  	<option value="06">06</option>
	  	<option value="07">07</option>
	  	<option value="08">08</option>
	  	<option value="09">09</option>
	  	<option value="10">10</option>
	  	<option value="11">11</option>
	  	<option value="12">12</option>
	  	<option value="13">13</option>
	  	<option value="14">14</option>
	  	<option value="15">15</option>
	  	<option value="16">16</option>
	  	<option value="17">17</option>
	  	<option value="18">18</option>
	  	<option value="19">19</option>
	  	<option value="20">20</option>
	  	<option value="21">21</option>
	  	<option value="22">22</option>
	  	<option value="23">23</option>
	  	<option value="24">24</option>
	  	<option value="25">25</option>
	  	<option value="26">26</option>
	  	<option value="27">27</option>
	  	<option value="28">28</option>
	  	<option value="29">29</option>
	  	<option value="30">30</option>
	  	<option value="31">31</option>
	  </select> -
	  <select name="entradames" style="width:130px" class="selectmax">
	  	<option value="ENE">Enero</option>
	  	<option value="FEB">Febrero</option>
	  	<option value="MAR">Marzo</option>
	  	<option value="ABR">Abril</option>
	  	<option value="MAY">Mayo</option>
	  	<option value="JUN">Junio</option>
	  	<option value="JUL">Julio</option>
	  	<option value="AGO">Agosto</option>
	  	<option value="SET">Septiembre</option>
	  	<option value="OCT">Octubre</option>
	  	<option value="NOV">Noviembre</option>
	  	<option value="DIC">Diciembre</option>
	</select> - 
	  <select name="entradaano" style="width:70px" class="selectmin">
	  	<option value="2011">2011</option>
	  	<option value="2012">2012</option>
	  	<option value="2013">2013</option>
	  </select><br>
        
        <label>Comentario</label><textarea name="mensaje" id="mensaje" cols="40" rows="5" class="cuadroarea"></textarea><br>
		<label>&nbsp;</label><input type="submit" name="submitbutton" id="submitbutton" value="Enviar Consultas"><br>
	</form>
	<script type="text/javascript">
		var txtnombre = new LiveValidation('nombre',{ validMessage: "Ok" });
		txtnombre.add(Validate.Presence,{failureMessage: "Nombre"});
		txtnombre.add(Validate.Length, { minimum: 3, tooShortMessage:"Min 3c "});
		
		var txtemail = new LiveValidation('correo',{ validMessage: "Ok" });
		txtemail.add(Validate.Presence, {failureMessage: "Email"});
		txtemail.add(Validate.Email,{failureMessage: "Email"} );


		var txtdias = new LiveValidation('nrodias',{ validMessage: "Ok" });
		txtdias.add(Validate.Presence,{failureMessage: "Dias"});
		txtdias.add(Validate.Numericality,{failureMessage: "Ingrese numero"} );

		var txtpersona = new LiveValidation('nropersonas',{ validMessage: "Ok" });
		txtpersona.add(Validate.Presence,{failureMessage: "Personas"});
		txtpersona.add(Validate.Numericality,{failureMessage: "Ingrese numero"} );

</script>  
</div>

<?php  } ?>
