<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idnew']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
	$tipocontenido = $_POST['tipocontenido'];
	$pagew         = $_POST['idpage'];
	$_SESSION['page']=$_POST['idpage'];
}
else
{
	$tipocontenido = "1";	
}

if($tipocontenido == '1')
{
	?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen</td>
        <td class="colblancoend">
        <input type='text' name='imagen' id='imagen' size='70'  maxlength='150' class="box400"><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset"style="height:30px;vertical-align:middle;" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho</td>
        <td class="colblancoend">
        <input type='text' name='anchoimagen' id='anchoimagen' class="box100"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto</td>
        <td class="colblancoend">
        <input type='text' name='altoimagen' id='altoimagen' class="box100"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">URL</td>
        <td class="colblancoend">
        <input type='text' name='urlimagen' id='urlimagen' size="80" class="box500">
        </td>
    </tr>
    </table>
	<?php 
}
if($tipocontenido == '2'){
	?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Flash</td>
        <td class="colblancoend">
        <input type='text' name='flash' id='flash' size='70'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" style="height:30px;vertical-align:middle;" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho</td>
        <td class="colblancoend">
        <input type='text' name='anchoflash' id='anchoflash' > px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto</td>
        <td class="colblancoend">
        <input type='text' name='altoflash' id='altoflash' > px
        </td>
    </tr>
    </table>
	<?php 
}
if($tipocontenido == '3'){
	?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right" valign="top">Codigo HTML</td>
        <td class="colblancoend">
        <textarea name="htmlcodigo" id="htmlcodigo"  cols="90" rows="15"></textarea>
        </td>
    </tr>
    </table>
	<?php 
	
}
if($tipocontenido == '4'){
	?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Pagina</td>
        <td class="colblancoend">
        <select name="paginadinam" id="paginadinam" style="width:340px" >
  <?php  
	if ($_SESSION['webuser_nivel'] == '9')
	  	$sql_page = db_query("select * from page  where  cestpage='1' and credpage='' order by cnikpage");
	else
	  	$sql_page = db_query("select * from page p, personapage pp  where p.ccodpage=pp.ccodpage and pp.ccodpersona='".$_SESSION['webuser_id']."' and p.cestpage='1' and p.credpage='' order by p.cnikpage");
	
	 while($row_page = db_fetch_array($sql_page)) 
	 {
		 if( $row_page['ccodpage']==$_SESSION['page'])
			echo '<option value="' . $row_page['ccodpage'] .'" selected>' . $row_page['cnikpage'] . '</option>';
		 else
			echo '<option value="' . $row_page['ccodpage'] .'">' . $row_page['cnikpage'] . '</option>';
	 }
  ?>
        </select>
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Modulo</td>
        <td class="colblancoend">
        <select name="modulodinam" id="modulodinam" style="width:340px" >
		<?php  
		   $modulo = db_query("select * from webmodulos  where  cestmodulo='1' order by ccodmodulo asc");
           while($mod = db_fetch_array($modulo)) 
		   {
				  echo '<option value="'.$mod['ccodmodulo'].'">'.$mod['cnommodulo'].'</option>';
		   }
        ?>
        </select>
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Seccion</td>
        <td class="colblancoend">
        <select name="secciondinam" id="secciondinam" style="width:340px" >
        <option value='00'> Todas</option>
		<?php  
		   $sql_secniv = db_query("select * from seccion where ccodpage='".$pagew."' and ccodmodulo = '1100' and ctipseccion='1' order by ccodseccion");
           while($row_secniv = db_fetch_array($sql_secniv)) 
		   {
				if ($row_secniv['cnivseccion']=='1') echo "<option value='".$row_secniv['ccodseccion']."'>".$row_secniv['cnomseccion']."</option>";		
				if ($row_secniv['cnivseccion']=='2') echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
				if ($row_secniv['cnivseccion']=='3') echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
				if ($row_secniv['cnivseccion']=='4') echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
		   }
        ?>
        </select>
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Categoria</td>
        <td class="colblancoend">
        <select name="selectcategoria" id="selectcategoria" style="width:340px" >
        <option value='0'> Todas</option>
		<?php  
		   $modulo = db_query("select * from webparametros  where  ccodparametro='0013' and ctipparametro='1' order by cvalparametro asc");
           while($mod = db_fetch_array($modulo)) 
		   {
				  echo '<option value="'.$mod['cvalparametro'].'">'.utf8_encode($mod['cnomparametro']).'</option>';
		   }
        ?>
        </select>
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Nro. Items</td>
        <td class="colblancoend">
        <input type='text' name='nroitems' id='nroitems' value="1">
        </td>
    </tr>
    
    <tr>
        <td width='150' class='colgrishome' align="right">Orden Extraccion</td>
        <td class="colblancoend">
        <select name="ordendinam" id="ordendinam" style="width:340px" >
            <?php  
               $extra = db_query("select * from webparametros  where  ccodparametro='0007' and ctipparametro='1' order by cvalparametro asc");
               while($ext = db_fetch_array($extra)) 
               {
				   echo '<option value="'.$ext['cvalparametro'].'">'.$ext['cnomparametro'].'</option>';
               }
            ?>
        </select>
        </td>
    </tr>
    <tr>
        <td class='titlesub' colspan="2">Estilo Seccion</td>
    </tr>
    <tr>
        <td class='colgrishome' colspan="2">
        <br>
        <div id="estilos">
        <ul class="stylos">
            <li><img border='0' src="estilos/images/estiloresumen.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='1' checked="checked" />Resumen</li>
            <li><img border='0' src="estilos/images/estiloresumendoble.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='2' />Resumen Doble</li>
            <li><img border='0' src="estilos/images/estilogaleria.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='3' />Galeria</li>
            <li><img border='0' src="estilos/images/estilogaleriasimple.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='4' />Slider</li>
            <li><img border='0' src="estilos/images/estilolistado.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='9' />Marquesina</li>
        </ul>
        </div>
        <br />
        </td>
    </tr>
    </table>
	<?php 
}

if($tipocontenido == '5')
{
?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho</td>
        <td class="colblancoend">
        <input type='text' name='anchoimagen' id='anchoimagen' > px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto</td>
        <td class="colblancoend">
        <input type='text' name='altoimagen' id='altoimagen' > px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 1</td>
        <td class="colblancoend">
        <input type='text' name='imagen1' id='imagen1' size='70'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen1')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 1</td>
        <td class="colblancoend"><input type='text' name='url1' id='url1' size='80'  maxlength='150' ></td>
    </tr>
    
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 2</td>
        <td class="colblancoend">
        <input type='text' name='imagen2' id='imagen2' size='70'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen2')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 2</td>
        <td class="colblancoend"><input type='text' name='url2' id='url2' size='80'  maxlength='150' ></td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 3</td>
        <td class="colblancoend">
        <input type='text' name='imagen3' id='imagen3' size='70'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen3')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 3</td>
        <td class="colblancoend"><input type='text' name='url3' id='url3' size='80'  maxlength='150' ></td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 4</td>
        <td class="colblancoend">
        <input type='text' name='imagen4' id='imagen4' size='70'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen4')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 4</td>
        <td class="colblancoend"><input type='text' name='url4' id='url4' size='80'  maxlength='150' ></td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 5</td>
        <td class="colblancoend">
        <input type='text' name='imagen5' id='imagen5' size='70'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen5')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 5</td>
        <td class="colblancoend"><input type='text' name='url5' id='url5' size='80'  maxlength='150' ></td>
    </tr>
    
    </table>
<?php  } 
if($tipocontenido == '6')
{
?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho</td>
        <td class="colblancoend">
        <input type='text' name='anchoimagen' id='anchoimagen' > px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto</td>
        <td class="colblancoend">
        <input type='text' name='altoimagen' id='altoimagen' > px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen </td>
        <td class="colblancoend">
        <input type='text' name='imagen' id='imagen' size='80'  maxlength='150' ><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right" valign="top">Codigo HTML</td>
        <td class="colblancoend">
        <textarea name="htmlcodigo" id="htmlcodigo"  cols="90" rows="15"></textarea>
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho ventana</td>
        <td class="colblancoend">
        <input type='text' name='anchowin' id='anchowin' > px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto Ventana</td>
        <td class="colblancoend">
        <input type='text' name='altowin' id='altowin' > px
        </td>
    </tr>
    
    </table>
<?php  } ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#paginadinam").change(function(){
		$.post("jq_secciones.php",{ idopera:'1',idmodulo:$("#modulodinam").val(),idpage:$("#paginadinam").val()},function(data){$("#secciondinam").html(data);})
	});
	$("#modulodinam").change(function(){
		$.post("jq_secciones.php",{ idopera:'1',idmodulo:$("#modulodinam").val(),idpage:$("#paginadinam").val()},function(data){$("#secciondinam").html(data);})
	});

});
</script>
