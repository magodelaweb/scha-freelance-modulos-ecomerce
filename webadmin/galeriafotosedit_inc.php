<?php 
include "include/config_seguro.php";
$retorno ="galeriafotos.php";
if(isset($_POST['aceptar'])) 
{
	$sql_update="UPDATE contenido SET 
		cnomcontenido   ='". $_POST['titulo'] ."',
		crescontenido   ='". $_POST['resumen'] ."'
		WHERE ccodcontenido ='". $_POST['IDpro'] ."'";
		db_query($sql_update);
	$save_seccion="UPDATE seccioncontenido  SET ccodseccion ='".$_POST['selectseccion']."' WHERE ccodcontenido='" . $_POST['IDpro'] . "' ";
	db_query($save_seccion);
	tep_redirect("galeriafotos.php");  
}

$sql_contenido = db_query("SELECT * FROM contenido c,seccioncontenido s  WHERE c.ccodcontenido=s.ccodcontenido and c.ccodcontenido = '" . $_GET['IDpro'] . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
?>
<form name="frm_galeria_new" method="post"  action="galeriafotosedit.php" enctype="multipart/form-data">
<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborder" >
<tr>
   	<td class='titulo'  colspan="2">
        <div class="formtitulo">Editar Foto</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>
<tr >
	<td class='colgrishome'  valign="top" align="right">Pagina</td>
    <td class='colgrisend' >
  <?php  
	$sql_page = db_query("select * from page  where ccodpage='".$row_contenido['ccodpage']."' and cestpage='1' and credpage='' order by cnompage");
	while($row_page = db_fetch_array($sql_page)) 
	 {
		echo '<input type="hidden" name="selectpage" id="selectpage" value="' . $row_page['ccodpage'] .'">' . $row_page['cnompage'];
	 }
  ?>
    
    </td>
</tr>
  	   
<tr>
	<td class='colgrishome'  valign="top" align="right">Secciones</td>
    <td class='colgrisend' >
<select name='selectseccion' id='selectseccion' style='width:190px;' class="box" >";
<?php 
$sqlsec1 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$row_contenido['ccodpage']."' and ccodmodulo='".$modulo."' and cnivseccion='1' and ctipseccion='1'  order by cnomseccion");
while($row1 = db_fetch_array($sqlsec1)) 
		{
			$cod1 = substr($row1['ccodseccion'],0,12);
			if( $row1['ccodseccion']==$row_contenido['ccodseccion'])
				echo '<option value="' . $row1['ccodseccion'] . '" selected>'.$row1['cnomseccion'] . '</option>';
			else
				echo '<option value="' . $row1['ccodseccion'] . '">'.$row1['cnomseccion'] . '</option>';
			$sqlsec2 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod1."%' and ccodmodulo='".$modulo."' and cnivseccion='2'  and ctipseccion='1'  order by cnomseccion");
			while($row2 = db_fetch_array($sqlsec2)) 
			{
				$cod2 = substr($row2['ccodseccion'],0,16);
				if( $row2['ccodseccion']==$row_contenido['ccodseccion'])
					echo '<option value="' . $row2['ccodseccion'] . '" selected>&nbsp;- ' . $row2['cnomseccion'] . '</option>';
				else
					echo '<option value="' . $row2['ccodseccion'] . '">&nbsp;- ' . $row2['cnomseccion'] . '</option>';
				
				$sqlsec3 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod2."%' and ccodmodulo='".$modulo."' and cnivseccion='3'  and ctipseccion='1'  order by cnomseccion");
				while($row3 = db_fetch_array($sqlsec3)) 
				{
					$cod3 = substr($row3['ccodseccion'],0,20);
					if( $row3['ccodseccion']==$row_contenido['ccodseccion'])
						echo '<option value="' . $row3['ccodseccion'] . '" selected>&nbsp;&nbsp;&nbsp;- ' . $row3['cnomseccion'] . '</option>';
					else
						echo '<option value="' . $row3['ccodseccion'] . '">&nbsp;&nbsp;&nbsp;- ' . $row3['cnomseccion'] . '</option>';
					
					$sqlsec4 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod3."%' and ccodmodulo='".$modulo."' and cnivseccion='4'  and ctipseccion='1'  order by cnomseccion");
					while($row4 = db_fetch_array($sqlsec4)) 
					{
						echo '<option value="' . $row4['ccodseccion'] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $row4['cnomseccion'] . '</option>';
					}
				}
		}
	}
?>
</select>
</td>	
</tr>
<tr>
	<td class='colgrishome' width="150"  align="right">Titulo :  </td>
    <td class='colgrisend'>
    <input type="text" name="titulo" id="titulo" maxlength="150"  class="box500" value="<?=$row_contenido['cnomcontenido']?>" >
    </td>
</tr>        
<tr>
	<td class='colgrishome'   valign="top" align="right">Resumen</td>
    <td class='colgrisend' valign="top">
    <textarea name='resumen' id='resumen' cols="50" rows="4"><?=$row_contenido['crescontenido']?></textarea>
	</td>
</tr>
<tr>
	<td  colspan="2" class='formpie' align="center" >
    <input type="hidden" name="IDpro" id="IDpro" value="<?=$_GET['IDpro']?>">
		<input type="submit" value="Aceptar" name="aceptar"  class='cssboton' />
		<input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	</td>
	</td>
	</tr>
</table>
</form>
<?php  } ?>