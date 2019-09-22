<?php
 $aclass->consulta("SELECT c.ccodcontenido,c.ccodestcontenido,c.cnomcontenido,c.crescontenido,cd.cdetcontenido,c.ctagcontenido,ec.cincestcontenido FROM contenido c, estilocontenido ec, contenidodetalle cd WHERE c.ccodcontenido=cd.ccodcontenido and c.ccodestcontenido=ec.ccodestcontenido and c.camicontenido ='$paramSec2'");
 $info = $aclass->respuesta();
 ?>
<div style="">
<div style="clear:both; overflow:hidden;">
	     <div class="titdet"><p class="segura"><?php echo CodificaTexto($info[2]);?></p></div>
		   <div class="textdet segura"><?php
       if(CF_UTF8){
         echo CodificaTextoLargo(utf8_encode($info[4]));
       }
       else{
         echo CodificaTextoLargo($info[4]);
       }
       ?></div>
</div>
<div style="clear:both; overflow:hidden;">
	    <?php
		  $aclass->consulta("UPDATE contenido SET nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '".$info[0]."'");
		  $aclass->consulta("select * from contenidogaleria where ccodcontenido='".$info[0]."' order by ccodmodulo,ccodcontenido");
		  $i = 1;
		  while($info = $aclass->respuesta()){
			 echo '<div class="left f-fila" '.((($i%4)==0)?'':'').'><div class="celdadet" '.((($i%4)==0)?'style="padding-right:0;"':'').'><a class="segura" id="img" href="'.CodificaUrlImg($contenedor.$info['cimggaleria']).'"><img class="segura" src="'.CodificaUrlImg($contenedor.str_replace('fotos','thumbs',$info['cimggaleria'])).'"  width="154" height="116"/></div></div>';
			 $i++;
		  }
		?>
</div>
</div>
