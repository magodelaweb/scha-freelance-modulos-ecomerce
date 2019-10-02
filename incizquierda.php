<?php $aclass->consulta("SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  sm WHERE s.ccodseccion=sm.ccodseccion  and sm.ccodmenu='2' and s.ccodpage='12172806' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY sm.cordmenu"); ?>
<div class="cajita">
	      <p class="title">VENTA DE EQUIPOS:</p>
		  <div class="textocont w7"><p class="texto">
		  <?php while($info=$aclass->respuesta()){
			  echo '- <a href="/'.$info[2].'" '.((url_amigable($info[2])==$paramSec)?'class="current"':'').'>'.$info[1].'</a><br/>';
		  }?>
		  </p></div>
</div>
<div class="cajita naranja">
	    <div class="cajitacont" style="width:210px;">
		  <p class="finan finantitle">FINANCIAMIENTO<br/>DIRECTO</p>
		  <p class="finan finantexto">Fijo: (511) 254-0995<br/>
		  	Cel: 965-903000<br/>
			RPM: #965-903000<br/>
			ENTEL: 981-578763</p>
		 </div>
</div>
<div class="rrss">
	<a href="https://www.facebook.com/samuel.chamochumbi.asociados"
	    title="Ir al fan page de schasociados.com en facebook" target="_blank"><picture>
	    <source srcset="/images/f_logo.png">
	    <img srcset="/images/f_logo.png" alt="Ir al fan page de schasociados.com en facebook"
	    height="60" width="60">
	</picture></a>
	<a href="https://wa.me/51981578763"
	    title="Escribir al WhatsApp de schasociados.com" target="_blank"><picture>
	    <source srcset="/images/w_logo.png">
	    <img srcset="/images/w_logo.png" alt="Escribir al WhatsApp de schasociados.com"
	    height="60" width="60">
	</picture></a>
</div>
