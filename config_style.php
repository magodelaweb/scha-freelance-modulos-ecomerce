<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=$webtitu?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Type" content="text/xml; charset=ISO-8859-1">
<meta name="author"        content="JUVAME CMS">
<meta name="description"   content="<?=$webdesc?>">
<meta name="keywords"      content="<?=$webtags?>">
<meta name="Language"      content="<?=$webidio?>">
<meta name="Copyright"     content="Juvame">
<meta name="revisit-after" content="1 days">
<meta name="robots" 	   content="all">
<link rel="shortcut icon" href="/webfiles/favicon.ico">

<link  href="/estilos/<?='p'.$webplan?>.css"	rel="stylesheet" type="text/css">
<link  href="/estilos/juvame.css"      	rel="stylesheet" type="text/css">
<link  href="/estilos/contenido.css" 		rel="stylesheet" type="text/css">

<script type="text/javascript" src="/include/js/swfobject.js"></script>
<script type="text/javascript" src="/include/js/juvame.js"></script>
<script type="text/javascript" src="/include/js/livevalidation.js"></script>
<script type="text/javascript" src="/include/js/jstexto.js"></script>
<script type="text/javascript" src="/include/js/jquery.js" ></script>
<script type="text/javascript" src="/include/js/jquery.corner.js"></script>
<script type="text/javascript" src="/include/js/easySlider1.7.js"></script>
<script type="text/javascript" src="/include/js/jcarousellite.js"></script>

<?php  if ($modsecc <>"8800"){	?>
<script type="text/javascript">
var GB_ROOT_DIR = "/include/greybox/";
</script>
<script type="text/javascript" src="/include/greybox/AJS.js"></script>
<script type="text/javascript" src="/include/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="/include/greybox/gb_scripts.js"></script>
<link  href="/include/greybox/gb_styles.css" rel="stylesheet" type="text/css">
<?php  }?>
<script type="text/javascript">
    $('#hometitulo').corner("5px");
    $('#homecontenido').corner("5px");
    $('#hometitular').corner("5px");

</script>
<script type="text/javascript" src="/include/js/jquery.vticker-min.js"></script>
<link rel="stylesheet" href="/include/js/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="/include/js/jquery.nivo.slider.pack.js"></script>

<script type="text/javascript">
$(window).load(function() {
        $('#slider1').nivoSlider({
			animSpeed:500,
			pauseTime:5000
		});
        $('#slider2').nivoSlider({
			animSpeed:500,
			pauseTime:5000
		});
        $('#slider3').nivoSlider({
			animSpeed:500,
			pauseTime:5000
		});
        $('#slider4').nivoSlider({
			animSpeed:500,
			pauseTime:5000
		});
        $('#slider5').nivoSlider({
			animSpeed:500,
			pauseTime:5000
		});
	$('#news-container').vTicker({
		speed: 500,
		pause: 3000,
		animation: 'fade',
		mousePause: false,
		showItems: 3
	});
	$("#easyslider").easySlider({
		auto: true,
		numeric: true,
		pause:	5000,
		continuous: true
	});


	$("#jCarouselLite").jCarouselLite({
	    auto: 300,
	    speed: 1500,
		visible:4
	});
	$("#jCarouselLite2").jCarouselLite({
	    auto: 300,
	    speed: 1500,
		visible:1
	});

    });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#izqmenu li,#cabmenu li").hover( function() { $(this).addClass("iehover"); }, function() { $(this).removeClass("iehover"); } );
	});
</script>
<script language="javascript">
function ventanapopup(idcodigo,wancho,walto)
{	window.open("/ventana.php?ids="+idcodigo, "", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,top=50,left=200,resizable=no,width="+wancho+",height="+walto+"")
}
</script>
</head>
<body >
<?php

$sql_website = "SELECT * FROM estilopagina where ccodplantilla='".$webplan."'";
$res_website = db_query($sql_website);
while ($row_website = db_fetch_array($res_website))
{
	$webestilo  	= $row_website['webestilo'];
	$webancho  		= $row_website['webancho'];
	$webalineahor 	= $row_website['webalineahor'];
	$columnacenancho =$row_website['columnacenancho']-30;
	$columnaizqancho =$row_website['columnaizqancho'];
	$columnaderancho =$row_website['columnaderancho'];
}
	?>
	<div id="cabecerabarra"><?php  include "inccabecerabarra.php"?></div>
	<div id="cabecera"><?php  include "inccabecera.php"?></div>
	<div id="cabeceramenu"><?php  include "inccabeceramenu.php"?></div>
	<div id="cabeceracontenido"><?php  include "inccabeceracontenido.php"?></div>
	<div id="cuerpo">
    <?php  if ($webestilo == 1 or $webestilo == 3){ ?>
		<div id="columnaizquierda"><?php  include "incizquierda.php"?></div>
    <?php  } ?>
		<div id="columnacentro">
        <?php  if (!empty($_GET['idsec'])) { ?>
            <div id="pagetitulo"><?php  include "modulos/web_ruta.php"?></div>
        <?php  } ?>
			<div id="pagecontenido">
			<?php  	include $contenidoinc;	?>
            </div>
            <div id="pagepie"></div>
		</div>
    <?php  if ($webestilo == 2 or $webestilo == 3){ ?>
		<div id="columnaderecha"><?php  include "incderecha.php"?></div>
    <?php  } ?>
	</div>
	<div id="piecontenido"><?php  include "incpiecontenido.php"?></div>
	<div id="piemenu"><?php  include "incpiemenu.php"?></div>
	<div id="pie"><?php  include "incpie.php"?></div>

<?php  if ($webanalytics<>"" ) { ?>
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("<?=$webanalytics?>");
	pageTracker._trackPageview();
	</script>
<?php  } ?>
</body>
</html>
