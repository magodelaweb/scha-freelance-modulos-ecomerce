<?php
$sql = "Select c.ccodcontenido,c.cnomcontenido,c.camicontenido,c.crescontenido,c.curlcontenido,s.ccodseccion,c.cimgcontenido,c.ccodmodulo,c.dfeccontenido,c.ctipcontenido,c.curlcontenido FROM contenido c, seccioncontenido s, seccion se where c.ccodcontenido=s.ccodcontenido and  c.cestcontenido='1' and se.ccodseccion = s.ccodseccion and se.camiseccion ='$paramSec' order by c.ccodcontenido desc";
$aclass->consulta($sql);
$numreg = $aclass->filas();
?>
	   <div style="clear:both; overflow:hidden;">
	    <?php
		echo '<div class="titdet"><p>'.strtoupper($paramSec).'</p></div>';
		if($numreg>0){
		 $i = 1;
		 while($info=$aclass->respuesta()){
			if($i==1){
				$codcont = $info['ccodcontenido'];
				$bclass->consulta("UPDATE contenido SET nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '".$codcont."'");
			}

			$ccodmodulo = $info[7];
			if($info[7]=='1100'){
				$bclass->consulta("select cdetcontenido from contenidodetalle where ccodcontenido = '".$info[0]."'");
				$info1 = $bclass->respuesta();
				if($paramSec=='blog'){
					echo '<div class="ac-container">';
					echo '<div class="textblog">
								<input id="ac-'.$i.'" name="accordion-1" type="checkbox">
								<label for="ac-'.$i.'">'.utf8_encode($info[1]).'</label>
								<article class="ac-small">
									<p>'.utf8_encode($info1[0]).'</p>
								</article>
						  </div>';
					//echo '<div class="textblog"><p><a class="fancy" data="blog.php?codcont='.$info[0].'" href="javascript:;">'.utf8_encode($info[1]).'</a></p></div>';
					echo '</div>';
				}elseif($paramSec=='empresa' || $paramSec=='servicio'){
					echo '<div>';// style="width:711px;"
					echo '<div class="textblog" style="border:none;">'.utf8_encode($info1[0]);
					if($paramSec=='servicio') echo '<div style="margin-top:5px;"><img class="segura" src="'.CodificaUrlImg($contenedor.'/images/servicios1.jpg').'"/><img class="segura" src="'.CodificaUrlImg($contenedor.'/images/servicios2.jpg').'"/><img class="segura" src="'.CodificaUrlImg($contenedor.'/images/servicios3.jpg').'"/></div>';
					else echo '<div style="margin-top:5px;"><img class="segura" src="'.CodificaUrlImg($contenedor.'/images/empresa1.jpg').'"/><img class="segura" src="'.CodificaUrlImg($contenedor.'/images/empresa2.jpg').'"/><img class="segura" src="'.CodificaUrlImg($contenedor.'/images/empresa3.jpg').'"/></div>';
					echo '</div></div>';
				}else{
					echo '<div>';
					echo '<div class="titfancy"><p>'.utf8_encode($info[1]).'</p></div>';
					echo '<div class="textfancy">'.utf8_encode($info1[0]).'</div>';
					echo '</div>';
				}
			}else{
				$nomurl = crearurl_articulo($info[5],$bclass);
				echo '<div><div class="celda left" '.((($i%4)==0)?'style="margin-right:0;"':'').'><div class="celdacont"><a class="segura" href="'.CodificaUrlImg($nomurl.$info[2]).'"><img class="segura" src="'.CodificaUrlImg(str_replace('fotos','thumbs',substr($info[6],1))).'"  width="'.(40+(40*3)).'"  height="'.(30+(30*3)).'"/></a><p>'.$info[1].'</p></div></div></div>';
			}
			$i++;
		 }
		}elseif($paramSec=='ubicacion'){
			//Ubicacion
			include("form_mapa.php");
		}elseif($paramSec=='contactos'){
			//Contacto
			include("form_contacto.php");
		}
		?>
		</div>
		<!--<div id="pagina" class="right">
		 <a href="#" class="current">1</a>
		 <a href="#">2</a>
		 <a href="#">3</a>
		</div>-->
