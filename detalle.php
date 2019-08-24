<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<title>Samuel Chamochumbi & Asociados S.A.C. - Camiones y maquinaria pesada usada</title>
<meta name="description" content="How to create a parallax scrolling effect using jQuery, HTML5 and CSS3">
<meta name="author" content="Mohiuddin Parekh, Nettuts+">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
<!-- CSS Code -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/reset.css">
<!-- JS Code -->
<script src="js/libs/jquery-1.6.1.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript">
    $(window).scroll(function()
            {
                if ($(this).scrollTop() > 112){
					 $('#menu').addClass("fixed").fadeIn();
					 $('.contenedor').addClass("margen").fadeIn();
				}
                else {
					$('#menu').removeClass("fixed");
					$('.contenedor').removeClass("margen");
				}
            });
</script>
</head>

<body>
<!-- Section #1 -->
<section id="home" data-speed="10" data-type="background">
  <div id="header"><div id="headercont"></div></div>
  <div id="menu">
    <div id="menucont">
	  <div id="logo"><a href="inicio.php"><img src="images/logo.png"/></a></div>
	  <div>
	   <ul class="sf-menu sf-js-enabled sf-arrows">
		<li class="current"><a href="#" class="w1">EMPRESA</a></li>
		<li><a href="#" class="w2">OFERTAS</a></li>  
		<li><a href="#" class="w3">SERVICIOS</a></li>
		<li><a href="#" class="w4">UBICACI&Oacute;N</a></li>
		<li><a href="#" class="w5">BLOG</a></li>  
		<li><a href="#" class="w6">CONTACTO</a></li>
	   </ul>
	   <select class="select-menu sf-menu sf-js-enabled sf-arrows" style="display: inline-block;">
	    <option value="#" selected="selected">EMPRESA</option>
		<option value="#" selected="selected">OFERTAS</option>
		<option value="#" selected="selected">SERVICIOS</option>
		<option value="#" selected="selected">UBICACI&Oacute;N</option>
		<option value="#" selected="selected">BLOG</option>
		<option value="#" selected="selected">CONTACTO</option>
	   </select>	
	  </div>
	</div>
  </div>
  <div class="contenedor">
    <div id="central">
	 <div id="centralcont">
	  <div class="left">
	   <div class="cajita">
	      <p class="title">EQUIPOS:</p>
		  <div class="textocont w7"><p class="texto">
		  - <a href="#" class="current">Volquetes y Tractos</a><br/>
		  - <a href="#">Cargadores Frontales</a><br/>
		  - <a href="#">Excavadoras</a><br/>
		  - <a href="#">Retroexcavadoras</a><br/>
		  - <a href="#">Tractores</a><br/>
		  - <a href="#">Consignaciones</a><br/>
		  - <a href="#">Otros</a>
		  </p></div>
	   </div>
	   <div class="cajita naranja">
	    <div class="cajitacont" style="width:210px;">
		  <p class="finan finantitle">FINANCIAMIENTO<br/>DIRECTO</p>
		  <p class="finan finantexto">Cel: 965 903000<br/>
			RPM: # 965 903000<br/>
			Nextel: 41*157*8763<br/>
			511 254-0995</p>
		 </div>
	   </div>
	  </div>
	  <div class="left" style="width:711px;">
	    <div style="clear:both; overflow:hidden;">
	     <div class="titdet"><p>VOLQUETE VOLVO FM420 2005</p></div>
		 <div class="textdet"><p>
		 <strong>SOY PROPIETARIO NO REVENDEDOR - VOLVO FM420 DEL 2005</strong><br/><br/>
		 <strong>Motor:</strong> D12E de 6 cilindros<br/>
		 <strong>Potencia:</strong> 420 Hp Inyector Bomba<br/>
		 <strong>Tracci&oacute;n:</strong> 6x4 Torton Cubo Solar<br/>
		 <strong>Tolva:</strong> 17 mts3<br/>
		 <strong>Piston:</strong> De 3 cuerpos marca HYVA<br/>
		 <strong>Llantas:</strong> 12R24<br/><br/>
		 <span style="font-size:20px"><strong>Precio Oferta: $70,000 inc IGV</strong></span><br/><br/>

		 100% OPERATIVOS - DOCUMENTOS EN REGLA - FINANCIAMIENTO DIRECTO<br/> COMUNICARSE CON JONATHAN CHOJEDA 254-0995 / 965-903000 / RPM #965-903000 /<br/> NEXTEL 41*157*8763
		 </p></div>
		</div>
		<div style="clear:both; overflow:hidden;">
	    <div class="left"><div class="celdadet"><img src="images/catalogo.jpg"/></div></div>
		<div class="left"><div class="celdadet"><img src="images/catalogo.jpg"/></div></div>
		<div class="left"><div class="celdadet"><img src="images/catalogo.jpg"/></div></div>
		<div class="left" style="margin-right:0;"><div class="celdadet" style="padding-right:0;"><img src="images/catalogo.jpg"/></div></div>
		<div class="left"><div class="celdadet"><img src="images/catalogo.jpg"/></div></div>
		<div class="left"><div class="celdadet"><img src="images/catalogo.jpg"/></div></div>
		<div class="left"><div class="celdadet"><img src="images/catalogo.jpg"/></div></div>
		<div class="left" style="margin-right:0;"><div class="celdadet" style="padding-right:0;"><img src="images/catalogo.jpg"/></div></div>
		</div>
	  </div>
	 </div>
	</div>
	<div id="footer">
	 <div id="footercont">
	  <div id="footerleft">
	  <p>Copyright &copy; 2014 Samuel Chamochumbi & Asociados S.A.C. Todos los derechos reservados<br/>
		Calle San Luis Mza G1 Lte 3 Urb. Villa Marina - Chorrillos - Lima - Per&uacute;<br/>
		Telefax: (511) 254-0995 - Nextel: 41*157*8763 RUC 20501730468
	  </p>
	  </div>
	  <div id="footerright"><a href="#" target="_blank"><img src="images/facebook.png"/></a></div>
	 </div>
	</div>
	<div id="pxl"><div id="pxlcont"><p>Dise&ntilde;o y Desarrollo: <a href="http://www.pxlperu.net" target="_blank">www.pxlperu.net</a></p></div></div>
  </div>
</section>

</body>

</html>
