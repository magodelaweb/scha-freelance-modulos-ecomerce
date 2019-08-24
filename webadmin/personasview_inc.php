<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
$sql   = db_query("SELECT * FROM persona   WHERE ccodpersona='".$_GET['IDpro']."'");
while($row = db_fetch_array($sql))
{
?>
<div id="capaformulario">
<form id="formpersona" >
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborderfull" >
<tr>
	<td colspan='2' align="left" class='titulo'>
		<div class="formtitulo">Ficha Cliente</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
	</td>
</tr>
<tr >
	<td class='titlehome' width="30"  colspan="2">Datos del Cliente</td>
</tr>
<tr>
	<td class='colgrishome'  width="250" align="center" valign="middle"><img src="..<?=$row['cimgpersona']?>" /> </td>
	<td >
    
	    <table border='0' width="100%" align='center' cellpadding='0' cellspacing='0' >
        <tr>
        	<td width="30%" height="28" class='colgriscen'>Nombres :</td>
            <td width="70%" class='colblancocen'><?=$row['cnompersona']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Email </td>
            <td class='colblancocen'><?=$row['cemapersona']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Sexo </td>
            <td class='colblancocen'><?=$row['csexpersona']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Documento </td>
            <td class='colblancocen'><?=$row['cdnipersona']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Fecha Nacimiento </td>
            <td class='colblancocen'><?=fechadmy($row['dnacpersona'])?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Pais </td>
            <td class='colblancocen'><?=nombre_pais($row['ccodubigeo'])?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Ciudad </td>
            <td class='colblancocen'><?=$row['cciudad']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Direccion </td>
            <td class='colblancocen'><?=$row['cdireccion']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Codigo Postal</td>
            <td class='colblancocen'><?=$row['ccodpostal']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Telefono </td>
            <td class='colblancocen'><?=$row['ntelefono']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Movil </td>
            <td class='colblancocen'><?=$row['nmovil']?></td>
        </tr>
        <tr>
        	<td height="28" class='colgriscen'>Registrado el </td>
            <td class='colblancocen'><?=fechadmy($row['dfecpersona'])?></td>
        </tr>
        
        </table>
    </td>
</tr>
<tr >
	<td class='titlehome' width="30"  colspan="2">Actividad en la pagina web</td>
</tr>

<tr>
	<td colspan="2" align="center" class='formpie' >
	<input type="Button" value="Cerrar vista" onClick ="javascript:window.location = '<?=$retorno?>'" class='cssboton'>
	</td>
</tr>
</table>
</form>
</div>
<?php  } ?>