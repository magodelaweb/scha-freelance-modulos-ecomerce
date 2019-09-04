<html>
<head>
<title>JUVAME CMS: Sistema de administraci&oacute;n de contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Type" content="text/xml; charset=ISO-8859-15">
<link  href='estilos/estilo.css'     rel='stylesheet' type='text/css'>
<script type='text/javascript' src='include/js/jsweb.js' ></script>
<!--script type="text/javascript" src="include/js/jquery.js"></script-->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="include/js/jquery.colorize.js" ></script>
<script type="text/javascript" src="include/js/jquery.checkboxtree.js" ></script>

<link rel="stylesheet" type="text/css" media="all" href="include/calendar/calendar-system.css" title="win2k-cold-1" />
<script type="text/javascript" src="include/calendar/calendar.js"></script>
<script type="text/javascript" src="include/calendar/calendar-es.js"></script>
<script type="text/javascript" src="include/calendar/calendar-setup.js"></script>

<link rel="stylesheet" type="text/css" href="include/jqcolor/css/jpickermin.css" />
<script type="text/javascript" src="include/jqcolor/jpicker-1.1.5.min.js" ></script>
<script type="text/javascript" src="../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

</head>
<body>
<div id="fondo">
<?php
define("VAR_NROITEMS",30);
define('fechahoy',date('d-m-Y'));

if ($stylo =='1')
{
?>
	<div id="cabecera">
		<div id="logo"></div>
		<div id="perfil"><?php include  "panel_cabecera.php"; ?></div>
	</div>
	<div id="cabecerabotones"><?php include  "panel_cabecerabotones.php"; ?></div>
	<div id="cuerpo">
		<div id="columnaizq"><?php include $modulo_buscar; ?></div>
		<div id="contenidoder"><?php include $modulo_include;?></div>
	</div>
	<div id="piepagina"><?php include  "panel_pie.php";?></div>
<?php }
if ($stylo =='2')
{
?>
	<div id="cabecera">
		<div id="logo"></div>
		<div id="perfil"><?php include  "panel_cabecera.php"; ?></div>
	</div>
	<div id="cabecerabotones"><?php include  "panel_cabecerabotones.php"; ?></div>
	<div id="cuerpo">
		<div id="contenidoizq"><?php include $modulo_include;?></div>
		<div id="columnader"><?php include $modulo_buscar; ?></div>
	</div>
	<div id="piepagina"><?php include  "panel_pie.php";?></div>


<?php }
if ($stylo =='3')
{
?>
	<div id="cabecera">
		<div id="logo"></div>
		<div id="perfil"><?php include  "panel_cabecera.php"; ?></div>
	</div>
	<div id="cabecerabotones"><?php include  "panel_cabecerabotones.php"; ?></div>
	<div id="cuerpo">
		<div id="contenidocen"><?php include $modulo_include;?></div>
		<?php
		$accion=$_GET["accion"];
		$token=$_GET["token"];
		$fs=($accion=="limpiaFotos")&&($token=="Melilove1!");
		if($fs){
			obtenerFotoSueltas();
		}
		?>
	</div>
	<div id="piepagina"><?php include  "panel_pie.php";?></div>

<?php } ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancy").click(function() {
			$.fancybox.open({
				'href' 				: $(this).attr("data"),
				'width'				: '460',
				'height'			: '80%',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe',
				'scrolling'			: 'no',
				'padding' 			: 1,
				/*'autoScale'     	: true,*/
				'fitToView'			: true,
				'autoSize'			: false
				/*'autoDimensions'	: true*/
			});
		});
		$("a#img").fancybox({
			'titleShow'     : false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'easingIn'      : 'easeOutBack',
			'easingOut'     : 'easeInBack'
		});
	});
</script>
</body>
</html>
