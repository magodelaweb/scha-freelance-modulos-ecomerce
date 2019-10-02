<?php
$q="SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  su, pagemenu pm WHERE s.ccodseccion=su.ccodseccion and su.ccodmenu = pm.ccodmenu and pm.cubimenu='1' and s.ccodpage='12172806' and s.cnivseccion=1 and  s.cestseccion='1' and camiseccion<>'inicio'  ORDER BY su.cordmenu";
$aclass->consulta($q);
$aclass2=clone $aclass;
$aclass2->consulta($q);
?>
<div id="logo"><a href="/home"><img src="/images/logo.png"/></a></div>
<div>
	   <ul class="sf-menu sf-js-enabled sf-arrows hidden">
	    <?php
			while($info=$aclass->respuesta()){
				echo '<li><a href="/'.$info[2].'" class="w1 '.(($info[2]==$paramSec)?"current":"").'">'.$info[1].'</a></li>';
				//else echo '<li><a class="fancy w1" data="/'.$info[2].'" href="javascript:;">'.$info[1].'</a></li>';
			}
		?>
	   </ul>
		 <ul class="iconos">
	    <?php
			while($info=$aclass2->respuesta()){
				echo '<li><a href="/'.$info[2].'" class="'.(($info[2]==$paramSec)?"current":"").'">
				<img src="/images/'.strtolower($info[1]).'.png"/><span>'.$info[1].'</span>
				</a></li>';
			}
		?>
	   </ul>
</div>
<div class="cajita naranja cajita-header">
	    <div class="cajitacont">
		  <p class="finan finantitle">FINANCIAMIENTO<br/>DIRECTO</p>
			<div class="rrss rrss-header">
 		 	<a href="https://www.facebook.com/samuel.chamochumbi.asociados"
 		 	    title="Ir al fan page de schasociados.com en facebook" target="_blank"><picture>
 		 	    <source srcset="/images/f_logo.png">
 		 	    <img srcset="/images/f_logo.png" alt="Ir al fan page de schasociados.com en facebook"
 		 	    height="25" width="25">
 		 	</picture></a>
 		 	<a href="https://wa.me/51981578763"
 		 	    title="Escribir al WhatsApp de schasociados.com" target="_blank"><picture>
 		 	    <source srcset="/images/w_logo.png">
 		 	    <img srcset="/images/w_logo.png" alt="Escribir al WhatsApp de schasociados.com"
 		 	    height="25" width="25">
 		 	</picture></a>
 		 </div>
		  <p class="finan finantexto">Fijo: 254-0995<br/>
		  	Cel: 965-903000<br/>
			RPM: #965-903000<br/>
			ENTEL: 981-578763</p>
		 </div>
</div>
