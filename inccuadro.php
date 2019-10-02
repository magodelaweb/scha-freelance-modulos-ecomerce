<?php
if($paramSec=='x'){
?>
<div id="cuadro">
	 <div id="cuadrocont">
		<div class="caja">
		 <div class="cajacont">
		  <p class="title">EQUIPOS:</p>
		  <div class="textocont left w7"><p class="texto">
		   <?php
		   $aclass->consulta("SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  sm WHERE s.ccodseccion=sm.ccodseccion  and sm.ccodmenu='2' and s.ccodpage='12172806' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY sm.cordmenu");
		   while($info=$aclass->respuesta()){
			  echo '- <a href="/'.$info[2].'" '.((url_amigable($info[2])==$paramSec)?'class="current"':'').'>'.$info[1].'</a><br/>';
		   }?>
		  </p></div>
		  <div class="left"><img src="/images/equipos.jpg"/></div>
		 </div>
		</div>
		<div class="caja">
		 <div class="cajacont">
		  <p class="title">OFERTAS:</p>
		  <div class="textocont"><p class="texto">
		  <?php
		  $sql = "Select c.ccodcontenido,c.cnomcontenido,c.camicontenido,c.crescontenido,c.curlcontenido,s.ccodseccion,c.cimgcontenido,c.ccodmodulo,c.dfeccontenido,ctipcontenido,curlcontenido FROM contenido c, seccioncontenido s, seccion se where c.ccodcontenido=s.ccodcontenido and  c.cestcontenido='1' and se.ccodseccion = s.ccodseccion and se.camiseccion ='ofertas' order by c.ccodcontenido desc limit 0,6";
		  $aclass->consulta($sql);
		  while($info=$aclass->respuesta()){
			  $nomurl = crearurl_articulo($info[5],$bclass);
			  echo '- <a href="/'.$nomurl.$info[2].'" >'.$info[1].'</a><br/>';
		  }
		  ?>
		  - <a href="<?php echo '/ofertas';?>">MAS OFERTAS</a>
		  </p></div>
		 </div>
		</div>
		<div class="caja naranja">
		 <div class="cajacont" style="width:285px;">
		  <p class="finan finantitle">FINANCIAMIENTO<br/>DIRECTO</p>
		  <p class="finan finantexto">Fijo: (511) 254-0995<br/>
		  	Cel: 965 903000<br/>
			RPM: #965-903000<br/>
			ENTEL: 981-578763 41*157*8763</p>
		 </div>
		</div>
	 </div>
</div>
<?php }?>
