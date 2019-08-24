<?php  if ($row['cestcomentario']=='1') { ?>
<div id='hometitulo'>Escribir Comentario</div>
<div id="homecontenido">
<div id="formcuenta">
<?php 
if ($_SESSION['usuario_aut']=="1")
{
?>
	<p><b>Para comentar:</b> Usted es integrante de la comunidad de lectores de HuarazNoticias. Por favor haga uso inteligente y mesurado de la opción de comentar. No realice ataques personales contra otros lectores y mantenga su lenguaje dentro de los límites adecuados.</p>
	<form name="form1" method="post" action="">
		<input type="hidden" id="idcont" name="idcont" value="<?=$codcont?>" >
		<textarea name="mensaje" rows="5" cols="80"></textarea><br /><br />
		<input name="submitcomenta" id="submitcomenta"  type="submit" value='Enviar tu Comentario'>
	</form>
<?php  } else {?>
	<p><b>Para comentar este articulo:</b> Usted debe ser integrante de la comunidad de lectores de HuarazNoticias. Si tiene una cuenta inicie su session en la parte superior de la web, caso contrario registrese <a href="/registro" title="Registro de usuarios"><b>Aquí</b></a></p>

<?php  } ?>
</div>
</div>
<br />
<div id='hometitulo'>Comentarios</div>
<div id="homecontenido">
<?php 
$sqlcomenta= db_query("select * from contenidoopinion where ccodcontenido='".$codcont."' order by ccodopinion desc");
while($rowc=db_fetch_array($sqlcomenta))
{
?>
	<div class="seccionindex100">
		<dl class="seccionindex" >
			<dt><?=$rowc['cnompersona'];?>
            </dt>
            <dd><?=$rowc['cdesopinion']?><br />
            <h6><?=traducefecha($row['dfeccontenido'],'S')?></h6>
            </dd>
		</dl>
	</div>                   
<?php  } ?>
</div>
<?php  } ?>