<?php 
include "config.php";
include "include/juvame_store.php";
include "include/juvame.php";
/**********************   Configuracion de la pagina web *******************/
$submenu ='0';
$dominio ='schasociados.com';
$mailserver ="mail.aquaplus.com";
$mailuser   ="informes@aquaplussac.com";
$mailpass   ="123456abc";

$domain       = $_SERVER['HTTP_HOST'];
$domain_parts = explode('.',$domain);
$nropartes = count($domain_parts);
if ($nropartes == 2 )
{ 
	$subdominio = $domain_parts[0].".".$domain_parts[1];
	$midominio  = $domain_parts[0].".".$domain_parts[1];
}
if ($nropartes == 3 )
{
	$midominio  = $domain_parts[1].".".$domain_parts[2];
	if ($domain_parts[0]=="www")
		$subdominio = $domain_parts[1].".".$domain_parts[2];
	else
		$subdominio = $domain_parts[0].".".$domain_parts[1].".".$domain_parts[2];
}
if ($nropartes == 4 )
{
	$midominio  = $domain_parts[1].".".$domain_parts[2].".".$domain_parts[3];
	if ($domain_parts[0]=="www")
		$subdominio = $domain_parts[1].".".$domain_parts[2].".".$domain_parts[3];
	else
		$subdominio = $domain_parts[0].".".$domain_parts[1].".".$domain_parts[2].".".$domain_parts[3];
}
$sqlpagew  = db_query("SELECT * FROM  page WHERE camipage='".$subdominio."' and cestpage ='1'");
$nrosub    = db_num_rows($sqlpagew);
if ( $nrosub >0 )
{
	$rowpagew    = db_fetch_array($sqlpagew);
	$webanalytics  = $rowpagew['canagoogle'];
	$webgooglemaps = $rowpagew['cmapgoogle'];
	$pais          = $rowpagew['ccodpais'];
	$webtipo       = $rowpagew['ctippage'];
	$codpage       = $rowpagew['ccodpage'];
	$webnombre     = $rowpagew['cnompage'];
	$webplan       = $rowpagew['ccodplantilla'];
	$webidio       = $rowpagew['ccodidioma'];
	$webtitu       = $rowpagew['ctitpage'];
	$webdesc       = $rowpagew['cdespage'];
	$webtags       = $rowpagew['ctagpage'];
	$webpie        = $rowpagew['cpiepage'];
	$webvisitas    = $rowpagew['nvispage'];
	$webpais       = $rowpagew['ccodpais'];
	$logoweb       = $rowpagew['clogo'];
	$emailsoporte  = $rowpagew['cemasoporte'];
	$emailcontacto = $rowpagew['cemacontacto'];
	$emailventas   = $rowpagew['cemaventas'];
	$tasaweb       = $rowpagew['ntasa'];
		
	$mostrarprecios = $rowpagew['nmosprecio'];
	$mostrarpedidos = $rowpagew['nsispedidos'];
	
	if ($rowpagew['credpage']<>"")
	{
		$sqlpageweb  = db_query("SELECT * FROM  page WHERE ccodpage='".$rowpagew['credpage']."' ");
		$rowpageweb  = db_fetch_array($sqlpageweb);
		
		$codpage     = $rowpageweb['ccodpage'];
		$webnombre   = $rowpageweb['cnompage'];
		$webplan     = $rowpageweb['ccodplantilla'];
		$webidio     = $rowpageweb['ccodidioma'];
		$webtitu     = $rowpageweb['ctitpage'];
		$webdesc     = $rowpageweb['cdespage'];
		$webtags     = $rowpageweb['ctagpage'];
		$webpie      = $rowpageweb['cpiepage'];
		$webvisitas  = $rowpageweb['nvispage'];
		$webpais     = $rowpageweb['ccodpais'];
		$logoweb     = $rowpageweb['clogo'];
		$emailsoporte = $rowpageweb['cemasoporte'];
		$emailcontacto= $rowpageweb['cemacontacto'];
		$emailventas  = $rowpageweb['cemaventas'];
		
		$mostrarprecios = $rowpageweb['nmosprecio'];
		$mostrarpedidos = $rowpageweb['nsispedidos'];
	}
	if ($rowpagew['ctippage']=='2')
	{
		$sqlpageweb  = db_query("SELECT * FROM  page WHERE camipage='".$dominio."' ");
		$rowpageweb  = db_fetch_array($sqlpageweb);
		$logoweb     = $rowpageweb['clogo'];
		$webpie      = $rowpageweb['cpiepage'];
		$webanalytics  = $rowpageweb['canagoogle'];
		$webgooglemaps = $rowpageweb['cmapgoogle'];
	}

}
else
{
	tep_redirect('/404.php');
}

if  ($_SESSION['CONTADOR']=='0') 
{ 
	if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&   $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
		{ 
		$nroip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	else
		{
		$nroip = $_SERVER['REMOTE_ADDR'];
		}
		$webvisitas = $webvisitas + 1; 
		$_SESSION['CONTADOR'] ='1';
		db_query("UPDATE page SET nvispage = nvispage + 1 where ccodpage='".$codpage."'");
		db_query("INSERT INTO visitas (ccodpage, ccodvisita, cnroip,dfecvisita) VALUES ('".$codpage."','".$webvisitas."','".$nroip."', NOW())");
}

if (!empty($_GET['idsec']))
{
		$sqlseccion = db_query("SELECT s.*, es.cincsecestilo FROM  seccion s, estiloseccion es WHERE s.ccodsecestilo = es.ccodsecestilo and s.ccodpage='".$codpage."' and s.camiseccion ='".$_GET["idsec"]."' and s.cnivseccion ='1'");
		$nrosec     = db_num_rows($sqlseccion);
		if ( $nrosec >0 )
		{
			$rowseccion     = db_fetch_array($sqlseccion);
			$webplan   = $rowseccion['ccodplantilla'];
			$webtitu   = $rowseccion['ctitseccion'];
			$webdesc   = $rowseccion['cdesseccion'];
			$webtags   = $rowseccion['ctagseccion'];
			$codsecc   = $rowseccion['ccodseccion'];
			$nivsecc   = $rowseccion['cnivseccion'];
			$nomsecc   = $rowseccion['cnomseccion'];
			$menusup   = $rowseccion['cnomseccion'];
			$imgsecc   = $rowseccion['cimgseccion'];
			$modsecc   = $rowseccion['ccodmodulo'];
			$webestilo = $rowseccion['cincsecestilo'];
			$subestilo = $rowseccion['ccodsubestilo'];
			$pagsecc   = $rowseccion['cpagseccion'];
			$publica   = $rowseccion['cestpublico'];
			$ubigeo    = $rowseccion['ccodubigeo'];
			$submenu   = $rowseccion['cnewmenu'];
			$rutasec   = "/".$_GET['idsec'];
			$cat       = substr($codsecc,0,12); 
			$pagina    = 1;
			$contenidoinc = "modulos/".$webestilo; 
			echo $contenidoinc;
			if (!empty($_GET['idsec2'])  and $_GET['idsec']<>'panel')
			{	
				if ($_GET['idsec2']>0)
				{
					/** Seccion con paginacion **/
					$pagina       = $_GET['idsec2'];
					$contenidoinc = "modulos/".$webestilo; 
				}
				else
				{
					$sqlseccion2 = db_query("SELECT s.*, es.cincsecestilo FROM  seccion s, estiloseccion es WHERE s.ccodsecestilo = es.ccodsecestilo and s.ccodseccion like '".$cat."%' and s.cnivseccion ='2' and s.camiseccion ='".$_GET["idsec2"]."' ");
					$nrosec2     = db_num_rows($sqlseccion2);
					if ( $nrosec2 >0 )
					{
					 // Seccion 2
						$rowseccion2    = db_fetch_array($sqlseccion2);
						$webplan  = $rowseccion2['ccodplantilla'];
						$webtitu  = $rowseccion2['ctitseccion'];
						$webdesc  = $rowseccion2['cdesseccion'];
						$webtags  = $rowseccion2['ctagseccion'];
						$codsecc    = $rowseccion2['ccodseccion'];
						$nivsecc    = $rowseccion2['cnivseccion'];
						$nomsecc    = $rowseccion2['cnomseccion'];
						$imgsecc    = $rowseccion2['cimgseccion'];
						$modsecc    = $rowseccion2['ccodmodulo'];
						$webestilo  = $rowseccion2['cincsecestilo'];
						$subestilo  = $rowseccion2['ccodsubestilo'];
						$pagsecc    = $rowseccion2['cpagseccion'];
						$ubigeo     = $rowseccion2['ccodubigeo'];

						$rutasec    = "/".$_GET['idsec']."/".$_GET['idsec2'];
						$cat        = substr($codsecc,0,16); 
						$pagina     = 1;
						$contenidoinc = "modulos/".$webestilo;
						if (!empty($_GET['idsec3']))
						{
							if ($_GET['idsec3']>0)
								{
									/** Seccion  2 con paginacion  **/
									$pagina       = $_GET['idsec3'];
									$contenidoinc = "modulos/".$webestilo; 
								}
								else
								{
									/**  Seccion  3 ********/
									$sqlseccion3 = db_query("SELECT s.*, es.cincsecestilo FROM  seccion s, estiloseccion es WHERE s.ccodsecestilo = es.ccodsecestilo and s.ccodseccion like '".$cat."%' and s.cnivseccion ='3' and s.camiseccion ='".$_GET["idsec3"]."' ");
									$nrosec3     = db_num_rows($sqlseccion3);
									if ($nrosec3 >0 )
									{
										$rowseccion3    = db_fetch_array($sqlseccion3);
										$webplan  = $rowseccion3['ccodplantilla'];
										$webtitu  = $rowseccion3['cnomseccion'];
										$webdesc  = $rowseccion3['cdesseccion'];
										$webtags  = $rowseccion3['ctagseccion'];
										$codsecc    = $rowseccion3['ccodseccion'];
										$nivsecc    = $rowseccion3['cnivseccion'];
										$nomsecc    = $rowseccion3['cnomseccion'];
										$imgsecc    = $rowseccion3['cimgseccion'];
										$modsecc    = $rowseccion3['ccodmodulo'];
										$webestilo  = $rowseccion3['cincsecestilo'];
										$subestilo  = $rowseccion3['ccodsubestilo'];
										$pagsecc    = $rowseccion3['cpagseccion'];
										$ubigeo     = $rowseccion3['ccodubigeo'];

										$rutasec    = $_GET['idsec']."/".$_GET['idsec2']."/".$_GET['idsec3'];
										$cat        = substr($codsecc,0,20); 
										$pagina     = 1;
										$contenidoinc = "modulos/".$webestilo;
					
										if (!empty($_GET['idsec4']))
										{
											if ($_GET['idsec4']>0)
											{
												/** Seccion  3 con paginacion  **/
												$pagina       = $_GET['idsec4'];
												$contenidoinc = "modulos/".$webestilo;
											}
											else
											{
												/******* Seccion 4 ************/
												$sqlseccion4 = db_query("SELECT s.*, es.cincsecestilo FROM  seccion s, estiloseccion es WHERE s.ccodsecestilo = es.ccodsecestilo and s.ccodseccion like '".$cat."%' and s.cnivseccion ='4' and s.camiseccion ='".$_GET["idsec4"]."' ");
												$nrosec4     = db_num_rows($sqlseccion4);
												if ($nrosec4 >0 )
												{
													$rowseccion4    = db_fetch_array($sqlseccion4);
													$webplan  = $rowseccion4['ccodplantilla'];
													$webtitu  = $rowseccion4['cnomseccion'];
													$webdesc  = $rowseccion4['cdesseccion'];
													$webtags  = $rowseccion4['ctagseccion'];
													$codsecc    = $rowseccion4['ccodseccion'];
													$nivsecc    = $rowseccion4['cnivseccion'];
													$nomsecc    = $rowseccion4['cnomseccion'];
													$imgsecc    = $rowseccion4['cimgseccion'];
													$modsecc    = $rowseccion4['ccodmodulo'];
													$webestilo  = $rowseccion4['cincsecestilo'];
													$subestilo  = $rowseccion4['ccodsubestilo'];
													$pagsecc    = $rowseccion4['cpagseccion'];
													$ubigeo     = $rowseccion4['ccodubigeo'];
													
													$rutasec    = $_GET['idsec']."/".$_GET['idsec2']."/".$_GET['idsec3']."/".$_GET['idsec4'];
													$cat        = substr($codsecc,0,24); 

													$pagina = 1;
													$contenidoinc = "modulos/".$webestilo;

													
													if (!empty($_GET['idsec5']))
													{
														if ($_GET['idsec5']>0)
														{
														/** Seccion  4 con paginacion  **/
															$pagina       = $_GET['idsec5'];
															$contenidoinc = "modulos/".$webestilo; 
														}
														else
														{
															/** Contenido 4 ***/
															$sqlproducto4 = db_query("SELECT c.ccodcontenido,c.ccodestcontenido,c.cnomcontenido,c.crescontenido,c.ctagcontenido,ec.cincestcontenido FROM contenido c, estilocontenido ec WHERE c.ccodestcontenido=ec.ccodestcontenido and c.camicontenido ='".$_GET["idsec5"]."'");
															$nropro4      = db_num_rows($sqlproducto4);
															if ( $nropro4 >0 )
															{
																$rowproducto4 = db_fetch_array($sqlproducto4);
																$codcont        = $rowproducto4['ccodcontenido'];
																
																$webtitu = $rowproducto4['cnomcontenido'];
																$webdesc = $rowproducto4['crescontenido'];
																$webtags = $rowproducto4['ctagcontenido'];

																$webestilo = $rowproducto4['cincestcontenido'];

																$contenidoinc = "modulos/".$webestilo;


																db_query("UPDATE contenido SET   nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '" . $codcont . "'");
															}
															else
															{
																/***** Error Url idsec5 ********/
																$contenidoinc = "404.php";
															}
														}
													}
												}
												else
												{
													/** Contenido 3 ***/
													$sqlproducto3 = db_query("SELECT c.ccodcontenido,c.ccodestcontenido,c.cnomcontenido,c.crescontenido,c.ctagcontenido,ec.cincestcontenido FROM contenido c, estilocontenido ec WHERE c.ccodestcontenido=ec.ccodestcontenido and c.camicontenido ='".$_GET["idsec4"]."'");
													$nropro3      = db_num_rows($sqlproducto3);
													$rutasec    = $_GET['idsec']."/".$_GET['idsec2']."/".$_GET['idsec3']."/".$_GET['idsec4'];
													if ( $nropro3 >0 )
													{
														$rowproducto3 = db_fetch_array($sqlproducto3);
														$codcont    = $rowproducto3['ccodcontenido'];

														$webtitu = $rowproducto3['cnomcontenido'];
														$webdesc = $rowproducto3['crescontenido'];
														$webtags = $rowproducto3['ctagcontenido'];

														$webestilo = $rowproducto3['cincestcontenido'];

														$contenidoinc = "modulos/".$webestilo;

														db_query("UPDATE contenido SET   nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '" . $codcont . "'");
													}
													else
													{
														/***** Error Url idsec4 ********/
														$contenidoinc = "404.php";
													}
												}
											}
										}
									}
								else
								{
									/** Contenido 2 ***/
									$sqlproducto2 = db_query("SELECT c.ccodcontenido,c.ccodestcontenido,c.cnomcontenido,c.crescontenido,c.ctagcontenido,ec.cincestcontenido FROM contenido c, estilocontenido ec WHERE c.ccodestcontenido=ec.ccodestcontenido and c.camicontenido ='".$_GET["idsec3"]."'");
									$nropro     = db_num_rows($sqlproducto2);
									$rutasec    = $_GET['idsec']."/".$_GET['idsec2']."/".$_GET['idsec3'];
									if ( $nropro >0 )
									{
										$rowproducto2 = db_fetch_array($sqlproducto2);
										$codcont = $rowproducto2['ccodcontenido'];

										$webtitu = $rowproducto2['cnomcontenido'];
										$webdesc = $rowproducto2['crescontenido'];
										$webtags = $rowproducto2['ctagcontenido'];

										$webestilo = $rowproducto2['cincestcontenido'];

										$contenidoinc = "modulos/".$webestilo;
										
										db_query("UPDATE contenido SET   nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '" . $codcont . "'");
									}
									else
									{
										/***** Error Url idsec3 ********/
										//tep_redirect('/404.php');
										$contenidoinc = "404.php";
									}
								}
							}
						}
					}
				else
					{
						/** Contenido 1 ***/
						$sqlproducto = db_query("SELECT c.ccodcontenido,c.ccodestcontenido,c.cnomcontenido,c.crescontenido,c.ctagcontenido,ec.cincestcontenido FROM contenido c, estilocontenido ec WHERE c.ccodestcontenido=ec.ccodestcontenido and c.camicontenido ='".$_GET["idsec2"]."'");
						$nropro      = db_num_rows($sqlproducto);
						$rutasec    = $_GET['idsec']."/".$_GET['idsec2'];
						if ( $nropro >0 )
						{
							$rowproducto = db_fetch_array($sqlproducto);
							$codcont = $rowproducto['ccodcontenido'];

							$webtitu = $rowproducto['cnomcontenido'];
							$webdesc = $rowproducto['crescontenido'];
							$webtags = $rowproducto['ctagcontenido'];

							$webestilo = $rowproducto['cincestcontenido'];

							$contenidoinc = "modulos/".$webestilo;
							
							db_query("UPDATE contenido SET   nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '" . $codcont . "'");
						}
						else
						{
							/***** Error Url idsec2 ********/
							$contenidoinc = "404.php";
						}
					}
				}
			}
		}
		else
		{
			$contenidoinc = "404.php";
		}
}
else
{
	$contenidoinc = "inccontenido.php";
	
	
}
if ($_GET['idsec']=="panel")     $contenidoinc = "modulos/user_login.php";
if ($_GET['idsec']=="registro")  $contenidoinc = "modulos/user_registro.php";
if ($_GET['idsec']=="recuperar") $contenidoinc = "modulos/user_recuperar.php";
if ($_GET['idsec']=="buscador")  $contenidoinc = "modulos/buscador_estilo01.php";

include "config_lang.php";
if(isset($_POST['submitlogin'])) 
{
	if (isset($_POST['email']) && isset($_POST['clave'])) 
	{
		$password = md5($_POST['clave']);
		$sqlogin = "SELECT ccodpersona,cnompersona,cemapersona,cnikpersona,cdireccion,cciudad,cpaspersona,cestpersona,nvispersona,ccodubigeo FROM persona WHERE cemapersona = '".$_POST['email']."' AND cpaspersona = '".$password."' AND cestpersona='1'";
		$reslogin = db_query($sqlogin);
		if (mysql_num_rows($reslogin) != 0) 
		{
		 	$user_data = db_fetch_array($reslogin);
			unset ($password);
			session_cache_limiter('nocache,private');
			$_SESSION['usuario_id']     =$user_data['ccodpersona'];
			$_SESSION['usuario_email']  =$user_data['cemapersona'];
			$_SESSION['usuario_pais']   =$user_data['ccodubigeo'];
			$_SESSION['usuario_city']   =$user_data['cciudad'];
			$_SESSION['usuario_dir']    =$user_data['cdireccion'];
			$_SESSION['usuario_nombre'] =$user_data['cnompersona'];
			$_SESSION['usuario_nick']   =$user_data['cnikpersona'];
			$_SESSION['usuario_visita'] =$user_data['nvispersona'];

			$_SESSION['usuario_aut']    ='1';
			$sqlvis = "UPDATE visitas  SET ccodusuario='".$user_data['ccodpersona']."', dlogvisita= now(), cestvisita = 1  where ccodvisita=".$_SESSION['NROCONTENIDO']." ";
			db_query($sqlvis);
		} 
		else
		{
		 $mensajeerror = "Error en nombre de usuario y/o  Contraseña ";
		}
	}
}
if(isset($_POST['submitcomenta'])) 
{
	
}

if ($publica=="1" and $_SESSION['usuario_aut']<>'1' )
{
	$contenidoinc = "modulos/user_login.php";
}
include "config_style.php";
?>
