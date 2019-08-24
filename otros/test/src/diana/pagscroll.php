<?php 
  /**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 * Paginador datos para PHP y Mysql, HTML5
 */
sleep(1);
$CantidadMostrar=3;
//Conexion  al servidor mysql

                    // Validado  la variable GET
    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 

	//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
	$TotalRegistro  = 10;
	
	 //Operacion matematica para mostrar los siquientes datos.
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):0;
	//Consulta SQL
	$consultavistas ="SELECT
				table_pag.id,
				table_pag.Title,
				table_pag.Image,
				table_pag.Descritption,
				table_pag.Url
				FROM
				table_pag
				ORDER BY
				table_pag.id ASC LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
	
?>

								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item-event">
                                    <div class="detail-event">
                                        <div class="event-img">
                                            <img src="http://babyhappy.life/diana/assets/img/evento.png" width="100%" height="auto" />
                                            <div class="date">
                                                <span class="day">19</span>
                                                <span class="month">Mayo</span>
                                            </div>
                                            <div class="etiqueta cerrado">Cerrado</div>
                                        </div>
                                        <div class="title-event">
                                            <a href="#">Titulo de evento 01</a>
                                            <p><strong>Toro Bar</strong> - Barranco</p>
                                        </div>
                                        <div class="products_event">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inactive">
                                                <a href=""><i class="fa fa-list-alt" aria-hidden="true"></i>
                                                <span class="name_pe">Listas</span>
                                                <span class="price_pe">FREE</span></a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inactive">
                                                <a href=""><i class="fa fa-ticket" aria-hidden="true"></i>
                                                <span class="name_pe">Entradas</span>
                                                <span class="price_pe">desde s/100</span></a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inactive">
                                                <a href=""><i class="fa fa-ticket" aria-hidden="true"></i>
                                                <span class="name_pe">Box</span>
                                                <span class="price_pe">desde s/280</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item-event">
                                    <div class="detail-event">
                                        <div class="event-img">
                                            <img src="http://babyhappy.life/diana/assets/img/evento.png" width="100%" height="auto" />
                                            <div class="date">
                                                <span class="day">19</span>
                                                <span class="month">Mayo</span>
                                            </div>
                                            <div class="etiqueta abierto">Abierto</div>
                                        </div>
                                        <div class="title-event">
                                            <a href="#">Titulo de evento 01</a>
                                            <p><strong>Toro Bar</strong> - Barranco</p>
                                        </div>
                                        <div class="products_event">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 active">
                                                <a href=""><i class="fa fa-list-alt" aria-hidden="true"></i>
                                                <span class="name_pe">Listas</span>
                                                <span class="price_pe">FREE</span></a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inactive">
                                                <a href=""><i class="fa fa-ticket" aria-hidden="true"></i>
                                                <span class="name_pe">Entradas</span>
                                                <span class="price_pe">desde s/100</span></a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inactive">
                                                <a href=""><i class="fa fa-ticket" aria-hidden="true"></i>
                                                <span class="name_pe">Box</span>
                                                <span class="price_pe">desde s/280</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item-event">
                                    <div class="detail-event">
                                        <div class="event-img">
                                            <img src="http://babyhappy.life/diana/assets/img/evento.png" width="100%" height="auto" />
                                            <div class="date">
                                                <span class="day">19</span>
                                                <span class="month">Mayo</span>
                                            </div>
                                            <div class="etiqueta abierto">Abierto</div>
                                        </div>
                                        <div class="title-event">
                                            <a href="#">Titulo de evento 01</a>
                                            <p><strong>Toro Bar</strong> - Barranco</p>
                                        </div>
                                        <div class="products_event">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inactive">
                                                <a href=""><i class="fa fa-list-alt" aria-hidden="true"></i>
                                                <span class="name_pe">Listas</span>
                                                <span class="price_pe">FREE</span></a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 active">
                                                <a href=""><i class="fa fa-ticket" aria-hidden="true"></i>
                                                <span class="name_pe">Entradas</span>
                                                <span class="price_pe">desde s/100</span></a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 active">
                                                <a href=""><i class="fa fa-ticket" aria-hidden="true"></i>
                                                <span class="name_pe">Box</span>
                                                <span class="price_pe">desde s/280</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<?php

	 echo '<a href="pagscroll.php?pag='.$IncrimentNum.'">Siguie</a>';
?>
