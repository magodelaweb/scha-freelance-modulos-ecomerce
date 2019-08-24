<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";

$sql_contenido = db_query("SELECT * FROM pagehome WHERE ccodinicio = '" . $_GET['IDpro'] . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
?>
<div id="capaformulario">
<form name="form" id="form"> 
<input type="hidden" name="idpro" id="idpro" value="<?=$_GET['IDpro']?>">
<?php  $webdefa =$row_contenido['ccodpage']?>
<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborder" >
<tr>
   	<td class='titulo'  colspan="2">
        <div class="formtitulo">Edit Item</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>  	   
<tr>
    <td class='colgrishome' width="150"  height='30' align='right'>Nombre </td>
    <td class='colblancoend'>
    <input type="text" name="titulo"  size="90" maxlength="150" value="<?=$row_contenido['cnomhome']?>" >
    </td>
</tr> 	 
<tr>
    <td class='colgrishome'  height='30' align='right'>Tipo </td>
    <td class='colblancoend'>
      <select name="seltipo" id="seltipo" style="width:340px;">
	  <?php 
       $tipocontenido = db_query("select * from webparametros  where  ccodparametro='0014' and ctipparametro='1' order by cvalparametro asc");
       while($tip = db_fetch_array($tipocontenido)) 
       {	
        if($tip['cvalparametro']==$row_contenido['ctiphome']){
            echo '<option value="'.$tip['cvalparametro'].'" selected >'.utf8_encode($tip['cnomparametro']).'</option>';
        }
        else{
            echo '<option value="'.$tip['cvalparametro'].'" disabled >'.utf8_encode($tip['cnomparametro']).'</option>';
        }
              
       }
      ?>
      </select>
    </td>
</tr>
<tr>
	<td colspan="2">
    <div class="conten-tipo">
   	<?php 
    if($row_contenido['ctiphome'] == '1'){
    ?>
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
        <tr>
            <td width='150' class='colgrishome' align="right">Imagen</td>
            <td class="colblancoend">
            <input type='text' name='imagen' id='imagen' size='80'  maxlength='150' value="<?=$row_contenido['cimgpubli']?>" ><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" > 
            </td>
        </tr>
        <tr>
            <td width='150' class='colgrishome' align="right">Ancho</td>
            <td class="colblancoend">
            <input type='text' name='anchoimagen' id='anchoimagen' value="<?=$row_contenido['nancho']?>" > px
            </td>
        </tr>
        <tr>
            <td width='150' class='colgrishome' align="right">Alto</td>
            <td class="colblancoend">
            <input type='text' name='altoimagen' id='altoimagen' value="<?=$row_contenido['nalto']?>" > px
            </td>
        </tr>
        <tr>
            <td width='150' class='colgrishome' align="right">URL</td>
            <td class="colblancoend">
            <input type='text' name='urlimagen' id='urlimagen' size="80" value="<?=$row_contenido['curlpubli']?>" >
            </td>
        </tr>
        </table>
        <?php 
    }
    if($row_contenido['ctiphome'] == '2'){
     ?>
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
        <tr>
            <td width='150' class='colgrishome' align="right">Flash</td>
            <td class="colblancoend">
            <input type='text' name='flash' id='flash' size='80'  maxlength='150' value="<?=$row_contenido['cimgpubli']?>" ><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" > 
            </td>
        </tr>
        <tr>
            <td width='150' class='colgrishome' align="right">Ancho</td>
            <td class="colblancoend">
            <input type='text' name='anchoflash' id='anchoflash' value="<?=$row_contenido['nancho']?>" > px
            </td>
        </tr>
        <tr>
            <td width='150' class='colgrishome' align="right">Alto</td>
            <td class="colblancoend">
            <input type='text' name='altoflash' id='altoflash' value="<?=$row_contenido['nalto']?>" > px
            </td>
        </tr>
        </table>
        <?php 
    }
    if($row_contenido['ctiphome'] == '3'){
        ?>
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
        <tr>
            <td width='150' class='colgrishome' align="right">Copiar</td>
            <td class="colblancoend">
            <textarea name="htmlcodigo" id="htmlcodigo" cols="50"  rows="10"><?=$row_contenido['cadspubli']?></textarea>
            </td>
        </tr>
        </table>
        <?php 
        
    }
    if($row_contenido['ctiphome'] == '4'){
        ?>
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
        <tr>
            <td width='150' class='colgrishome' align="right">Pagina</td>
            <td class="colblancoend">
            <select name="paginadinam" id="paginadinam" style="width:340px" >
		<?php  
		if ($_SESSION['webuser_nivel'] == '9')
		  	$sql_page = db_query("select * from page  where  cestpage='1' and credpage='' order by cnompage");
		else
		  	$sql_page = db_query("select * from page p, personapage pp  where p.ccodpage=pp.ccodpage and pp.ccodpersona='".$_SESSION['webuser_id']."' and p.cestpage='1' and p.credpage='' order by p.cnompage");
		 while($row_page = db_fetch_array($sql_page)) 
		 {
			 if( $row_page['ccodpage']==$row_contenido['ccodpage'])
				echo '<option value="' . $row_page['ccodpage'] .'" selected>' . $row_page['cnompage'] . '</option>';
			 else
				echo '<option value="' . $row_page['ccodpage'] .'">' . $row_page['cnompage'] . '</option>';
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
		$sqlmod = db_query("select * from webmodulos where cestmodulo='1' order by ccodmodulo");
		while ($rowmod = db_fetch_array($sqlmod)) 
		{	
			if($rowmod['ccodmodulo']==$row_contenido['ccodmodulo']){
				echo '<option value='.$rowmod['ccodmodulo'].' selected>'.$rowmod['cnommodulo'].'</option>';
			}else{
				echo '<option value='.$rowmod['ccodmodulo'].'>'.$rowmod['cnommodulo'].'</option>';
			}
		}

            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td width='150' class='colgrishome' align="right">Seccion</td>
            <td class="colblancoend">
            <select name="secciondinam" id="secciondinam" style="width:340px" >
		<?php  
		   $sql_secniv = db_query("select * from seccion where ccodpage='".$row_contenido['ccodpage']."' and ccodmodulo = '".$row_contenido['ccodmodulo']."' and ctipseccion='1' order by ccodseccion");
           while($row_secniv = db_fetch_array($sql_secniv)) 
		   {
				if ($row_secniv['cnivseccion']=='1')
				{
					if ($row_secniv['ccodseccion']==$row_contenido['ccodseccion']) 
						echo "<option value='".$row_secniv['ccodseccion']."' selected>".$row_secniv['cnomseccion']."</option>";
					else
						echo "<option value='".$row_secniv['ccodseccion']."'>".$row_secniv['cnomseccion']."</option>";	
				}
					
				if ($row_secniv['cnivseccion']=='2') 
				{
					if ($row_secniv['ccodseccion']==$row_contenido['ccodseccion']) 
						echo "<option value='".$row_secniv['ccodseccion']."' selected>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";
					else
						echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";
				}
					
				if ($row_secniv['cnivseccion']=='3') 
				{
					if ($row_secniv['ccodseccion']==$row_contenido['ccodseccion']) 
						echo "<option value='".$row_secniv['ccodseccion']."' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";
					else
					 	echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
				}
				if ($row_secniv['cnivseccion']=='4') 
				{
					if  ($row_secniv['ccodseccion']==$row_contenido['ccodseccion']) 
						echo "<option value='".$row_secniv['ccodseccion']."' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";
					else
						echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";
				}
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
				  echo '<option value="'.$mod['cvalparametro'].'">'.$mod['cnomparametro'].'</option>';
		   }
        ?>
        </select>
        </td>
    </tr>
        
        <tr>
            <td width='150' class='colgrishome' align="right">Nro. Items</td>
            <td class="colblancoend">
            <input type='text' name='nroitems' id='nroitems' value="<?=$row_contenido['nnroitems']?>" >
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
				   if($mod['cvalparametro']==$row_contenido['ccodorden']){
					   echo '<option value="'.$ext['cvalparametro'].'" selected >'.$ext['cnomparametro'].'</option>';
				   }else{
					   echo '<option value="'.$ext['cvalparametro'].'">'.$ext['cnomparametro'].'</option>';
				   }
                      
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
	            <li><img border='0' src="estilos/images/estiloresumen.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='1' <?php  if ($row_contenido['ccodestilo']=='1') echo "checked";?> />Resumen</li>
	            <li><img border='0' src="estilos/images/estiloresumendoble.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='2'  <?php  if ($row_contenido['ccodestilo']=='2') echo "checked";?> />Resumen doble</li>
	            <li><img border='0' src="estilos/images/estilogaleria.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='3'  <?php  if ($row_contenido['ccodestilo']=='3') echo "checked";?> />Galeria</li>
	            <li><img border='0' src="estilos/images/estilogaleriasimple.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='4'  <?php  if ($row_contenido['ccodestilo']=='4') echo "checked";?> />Resumen Triple</li>
	            <li><img border='0' src="estilos/images/estilogaleriasimple.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='5'  <?php  if ($row_contenido['ccodestilo']=='5') echo "checked";?> />Slider</li>
	            <li><img border='0' src="estilos/images/estilolistado.gif"><br><input type='radio' name='selectestilo' id='selectestilo' value='9'  <?php  if ($row_contenido['ccodestilo']=='9') echo "checked";?>/>Marquesina</li>
            </ul>
            </div>
            <br />
            </td>
        </tr>
        </table>
        <?php 
    }
	if($row_contenido['ctiphome'] == '5')
	{
	?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho</td>
        <td class="colblancoend">
        <input type='text' name='anchoimagen' id='anchoimagen'  value="<?=$row_contenido['nancho']?>"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto</td>
        <td class="colblancoend">
        <input type='text' name='altoimagen' id='altoimagen' value="<?=$row_contenido['nalto']?>"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 1</td>
        <td class="colblancoend">
        <input type='text' name='imagen1' id='imagen1' size='80'  maxlength='150' value="<?=$row_contenido['cimagen1']?>"><input type="button" value="Seleccionar" onClick="openAsset('imagen1')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 1</td>
        <td class="colblancoend"><input type='text' name='url1' id='url1' size='80'  maxlength='150' value="<?=$row_contenido['curl1']?>"></td>
    </tr>
    
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 2</td>
        <td class="colblancoend">
        <input type='text' name='imagen2' id='imagen2' size='80'  maxlength='150' value="<?=$row_contenido['cimagen2']?>"><input type="button" value="Seleccionar" onClick="openAsset('imagen2')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 2</td>
        <td class="colblancoend"><input type='text' name='url2' id='url2' size='80'  maxlength='150' value="<?=$row_contenido['curl2']?>"></td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 3</td>
        <td class="colblancoend">
        <input type='text' name='imagen3' id='imagen3' size='80'  maxlength='150' value="<?=$row_contenido['cimagen3']?>"><input type="button" value="Seleccionar" onClick="openAsset('imagen3')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 3</td>
        <td class="colblancoend"><input type='text' name='url3' id='url3' size='80'  maxlength='150' value="<?=$row_contenido['curl3']?>"></td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 4</td>
        <td class="colblancoend">
        <input type='text' name='imagen4' id='imagen4' size='80'  maxlength='150' value="<?=$row_contenido['cimagen4']?>"><input type="button" value="Seleccionar" onClick="openAsset('imagen4')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 4</td>
        <td class="colblancoend"><input type='text' name='url4' id='url4' size='80'  maxlength='150' value="<?=$row_contenido['curl4']?>"></td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen 5</td>
        <td class="colblancoend">
        <input type='text' name='imagen5' id='imagen5' size='80'  maxlength='150' value="<?=$row_contenido['cimagen5']?>"><input type="button" value="Seleccionar" onClick="openAsset('imagen5')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Url 5</td>
        <td class="colblancoend"><input type='text' name='url5' id='url5' size='80'  maxlength='150' value="<?=$row_contenido['curl5']?>"></td>
    </tr>
    
    </table>
    
	<?php 
	}
	if($row_contenido['ctiphome'] == '6')
	{
	?>
    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho</td>
        <td class="colblancoend">
        <input type='text' name='anchoimagen' id='anchoimagen' value="<?=$row_contenido['nancho']?>"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto</td>
        <td class="colblancoend">
        <input type='text' name='altoimagen' id='altoimagen' value="<?=$row_contenido['nalto']?>"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Imagen </td>
        <td class="colblancoend">
        <input type='text' name='imagen' id='imagen' size='80'  maxlength='150' value="<?=$row_contenido['cimgpubli']?>"><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" > 
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right" valign="top">Codigo HTML</td>
        <td class="colblancoend">
        <textarea name="htmlcodigo" id="htmlcodigo"  cols="90" rows="15"><?=$row_contenido['cadspubli']?></textarea>
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Ancho ventana</td>
        <td class="colblancoend">
        <input type='text' name='anchowin' id='anchowin' value="<?=$row_contenido['anchowin']?>"> px
        </td>
    </tr>
    <tr>
        <td width='150' class='colgrishome' align="right">Alto Ventana</td>
        <td class="colblancoend">
        <input type='text' name='altowin' id='altowin' value="<?=$row_contenido['altowin']?>"> px
        </td>
    </tr>
    
    </table>
    
	<?php 
	}
	?>
    </div>
    </td>
</tr>
<tr>
    <td class='titlesub' colspan="2">Publicacion</td>
</tr>
<tr>
    <td width='150' class='colgrishome' align="right">Pagina</td>
    <td class="colblancoend">
    <select name="selectpage" id="selectpage" style="width:340px" >
    <?php  
       $sql_page = db_query("select * from page  where  cestpage='1' order by cnompage");
       while($row_page = db_fetch_array($sql_page)) 
       {
           if( $row_page['ccodpage']==$row_contenido['ccodpage'])
           {
              echo '<option value="' . $row_page['ccodpage'] .'" selected>'.utf8_encode($row_page['cnompage']).'</option>';
           }
           else{
			   if( $row_contenido['ctiphome']<>'4')  echo '<option value="' . $row_page['ccodpage'] .'">'.utf8_encode($row_page['cnompage']).'</option>';
           }
          
       }
    ?>
    </select>
    </td>
</tr>

<tr>
  <td width="130" class='colgrishome' align="right" valign="top">Secci&oacute;n </td>
  <td  class='colblancoend'>
    <button id="expand">+</button><button id="collapse">-</button><button id="default">::</button>
    <div id="cuadrobox"  style="border:1px #666666 solid; padding:5px; width:340px; height:200px; overflow:auto;background-color:#FFF;">
    <?php  
    include "jq_selectseccion2.php";
    ?>
    </div>
  </td>
</tr> 
<tr>
    <td width='150' class='colgrishome' align="right">Ubicacion</td>
    <td class="colblancoend">
    <select name="selectubicacion" id="selectubicacion" style="width:340px" >
    <?php 
	$tipocontenido = db_query("select * from webparametros  where  ccodparametro='0004' and ctipparametro='1' order by cvalparametro asc");
	while($tip = db_fetch_array($tipocontenido)) 
	{	
		if($tip['cvalparametro']==$row_contenido['cubidestino']){
			echo '<option value="'.$tip['cvalparametro'].'" selected >'.utf8_encode($tip['cnomparametro']).'</option>';
		}
		else{
			echo '<option value="'.$tip['cvalparametro'].'">'.utf8_encode($tip['cnomparametro']).'</option>';
		}	  
	}
	?>
    </select>
    </td>
</tr>

<tr>
    <td width='150' class='colgrishome' align="right">Fecha Inicio</td>
    <td class="colblancoend">
        <input type="text" name="fechaini" id="fechaini" size='18'  style="width:150px;" class="cuadrotexto" value="<?=fechadmy($row_contenido['dfecinicio'])?>">
		<input type="button" id="fechabus" value="" class="botonfecha">
		<script type="text/javascript"> 
		   Calendar.setup({ 
		    inputField     :  "fechaini",     // id del campo de texto 
		    ifFormat       :  "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		    button         :  "fechabus"     // el id del botón que lanzará el calendario 
			}); 
		</script>
    
    </td>
</tr>
<tr>
    <td width='150' class='colgrishome' align="right">Fecha Fin</td>
    <td class="colblancoend">
        <input type="text" name="fechafin" id="fechafin" size='18'  style="width:150px;" class="cuadrotexto" value="<?=fechadmy($row_contenido['dfecfinal'])?>">
		<input type="button" id="fechabus2" value="" class="botonfecha">
		<script type="text/javascript"> 
		   Calendar.setup({ 
		    inputField     :  "fechafin",     // id del campo de texto 
		    ifFormat       :  "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		    button         :  "fechabus2"     // el id del botón que lanzará el calendario 
			}); 
		</script>
    
    </td>
</tr>
<tr>
    <td colspan="2" align="center" class='colgrishome' >
    <div id="mensaje"></div>
	</td>
</tr>     
<tr>
    <td colspan="2" align="center" class='formpie' >
    <input type="button" value="Aceptar"   class='cssboton' onclick="xajax_procesar_formulario(xajax.getFormValues('form'))" />
    <input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	</td>
</tr>
</table>
</form>
</div>
<?php  } ?>

<script type="text/javascript">

$(document).ready(function(){
	$("#selectpage").change(function(){
		$.post("jq_selectseccion2.php",{ idopera:'1',iditem:$("#idpro").val(),idpage:$("#selectpage").val()},function(data){$("#cuadrobox").html(data);})
	});
	$("#paginadinam").change(function(){
		$.post("jq_secciones.php",{ idopera:'1',idmodulo:$("#modulodinam").val(),idpage:$("#paginadinam").val()},function(data){$("#secciondinam").html(data);});
		$.post("jq_selectpage.php",{ idopera:'1',idpage:$("#paginadinam").val()},function(data){$("#selectpage").html(data);});
		$.post("jq_selectseccion2.php",{ idopera:'1',iditem:$("#idpro").val(),idpage:$("#paginadinam").val()},function(data){$("#cuadrobox").html(data);});
	});
	$("#modulodinam").change(function(){
		$.post("jq_secciones.php",{ idopera:'1',idmodulo:$("#modulodinam").val(),idpage:$("#paginadinam").val()},function(data){$("#secciondinam").html(data);})
	});

});
function relleno(ass){
	
		aa = eval(ass);
		var num_asign = aa.length;
		document.getElementById(ass).length = num_asign;
		for(i=0;i<document.getElementById(ass).length;i++){
			if(document.getElementById(ass).options[i].selected){
				document.getElementById('selectpage').options[i].value= document.getElementById(ass).options[i].value;
				document.getElementById('selectpage').options[i].text = document.getElementById(ass).options[i].text;
			}
      	}
		
	}
</script>
