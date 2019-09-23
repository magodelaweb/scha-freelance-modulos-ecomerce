<?php
$sql = "Select c.ccodcontenido,c.cnomcontenido,c.camicontenido,c.crescontenido,c.curlcontenido,s.ccodseccion,c.cimgcontenido,c.ccodmodulo,c.dfeccontenido,ctipcontenido,curlcontenido
FROM contenido c, seccioncontenido s where c.ccodcontenido=s.ccodcontenido and  c.cestcontenido='1' and c.ccodmodulo='1200' and s.ccodseccion = '121728060002000000000000'
order by c.ccodcontenido desc  LIMIT 0 , 12";
$aclass->consulta($sql);
?>
<div>
	   <div id="response" class="image-container jscroll">
	    <?php
		$i = 1;
		while($info=$aclass->respuesta()){
			/*$codcont = $info['ccodcontenido'];
		    $bclass->consulta("UPDATE contenido SET nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '".$codcont."'");*/
			$nomurl = crearurl_articulo($info[5],$bclass);/*v ($i%4)==0)?'' <style="margin-right:0;"*/
			echo '<div class="celda left f-fila">
			<div class="celdacont"><a class="segura" href="'.
			CodificaUrlImg($nomurl.$info[2]).'"><img class="segura" src="'.
			CodificaUrlImg(str_replace('fotos','thumbs',substr($info[6],1))).
			/*'"  width="'.(40+(40*3)).'"  height="'.(30+(30*3))*/''.'"/></a><p>'
			.$info[1].'</p></div></div>';
			$i++;
		}
		?>
		</div>
		<input type="hidden" id="pageno" value="1">
		<a href="#" class="loader">
			<img id="loader" class="" src="/images/loader.svg"></a>
</div>
