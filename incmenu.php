<?php
$q="SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  su, pagemenu pm WHERE s.ccodseccion=su.ccodseccion and su.ccodmenu = pm.ccodmenu and pm.cubimenu='1' and s.ccodpage='12172806' and s.cnivseccion=1 and  s.cestseccion='1' and camiseccion<>'inicio'  ORDER BY su.cordmenu";
$aclass->consulta($q);
$aclass2=clone $aclass;
$aclass2->consulta($q);
?>
<div id="logo"><a href="<?php echo $contenedor; ?>/inicio/schasoci"><img src="<?php echo $contenedor;?>/images/logo.png"/></a></div>
<div>
	   <ul class="sf-menu sf-js-enabled sf-arrows hidden">
	    <?php
			while($info=$aclass->respuesta()){
				echo '<li><a href="'.$contenedor.'/'.$info[2].'" class="w1 '.(($info[2]==$paramSec)?"current":"").'">'.$info[1].'</a></li>';
				//else echo '<li><a class="fancy w1" data="'.$contenedor.'/'.$info[2].'" href="javascript:;">'.$info[1].'</a></li>';
			}
		?>
	   </ul>
		 <ul class="iconos">
	    <?php
			while($info=$aclass2->respuesta()){
				echo '<li><a href="'.$contenedor.'/'.$info[2].'" class="'.(($info[2]==$paramSec)?"current":"").'">
				<img src="/images/'.$info[1].'.png"/>
				</a></li>';
			}
		?>
	   </ul>
</div>
