<?php $aclass->consulta("SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  sm WHERE s.ccodseccion=sm.ccodseccion  and sm.ccodmenu='2' and s.ccodpage='12172806' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY sm.cordmenu"); ?>
<div class="cajita">
	      <p class="title" style="font-size:16px; width:171px;">VENTA DE EQUIPOS:</p>
		  <div class="textocont w7"><p class="texto">
		  <?php while($info=$aclass->respuesta()){
			  echo '- <a href="'.$contenedor.'/'.$info[2].'" '.((url_amigable($info[2])==$paramSec)?'class="current"':'').'>'.$info[1].'</a><br/>';
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