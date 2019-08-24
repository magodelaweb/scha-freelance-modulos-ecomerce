<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Samuel Chamochumbi & Asociados S.A.C. - Camiones y maquinaria pesada usada</title>
<meta name="description" content="How to create a parallax scrolling effect using jQuery, HTML5 and CSS3">
<meta name="author" content="Mohiuddin Parekh, Nettuts+">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
<!-- CSS Code -->
<!--link rel="stylesheet" href="<?php echo $contenedor;?>/css/style.css"-->
<link rel="stylesheet" href="<?=$contenedor;?>/css/style.css">
<!-- JS Code -->
<!--<script src="<?php echo $contenedor;?>/js/libs/jquery-1.6.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo $contenedor;?>/js/jquery.js"></script>
<script type="text/javascript" id="idscript" src="<?php echo $contenedor;?>/js/script.js?cont=<?php echo $contenedor; ?>" ></script>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script type="text/javascript" src="<?php echo $contenedor;?>/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo $contenedor;?>/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $contenedor;?>/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
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
      /*
      $('body').bind('cut copy paste', function (e) {
        $('#btnsec.btnsec').click();
        var urlscha="https://www.schasociados.com";
        if (e.target.value!=urlscha){
          e.preventDefault();
        }
      });
      $(document).bind("contextmenu",function(e){
        return false;
      });
      new ClipboardJS('.btnsec');
      var keyCtrl=false;
      $(document).on("keydown",function(event){
        var esF12=event.which==123;
        var esCtrl=event.which==17;
        var esU=event.which==85;
        //console.log(event.keyCode);
        if (esF12){
          event.preventDefault();
        }
        else if (esCtrl) {
          keyCtrl=true;
          //console.log("control presionado");
        }
        else if (esU) {
          if(keyCtrl==true){
            //console.log("u presionado");
            event.preventDefault();
          }
        }
    	});
      $(document).on("keyup",function(event){
      	if(event.keyCode==17)
      	{
      		keyCtrl=false;
      	}
      });*/
      var imgSec=$("img.segura");
      var enlaceSec=$("a.segura");
      var titSec=$("p.segura");
      var descSec=$(".textdet.segura");
      descSec.each(function(){
              var descSel=$(this);
              var tcif=descSel.html();
              var newtext=decodificaLargeText(tcif);
              descSel.html("<br/>"+newtext);
        	});
      titSec.each(function(){
              var titSel=$(this);
              var tcif=titSel.html();
              var newtext=decodificaImgUrl(tcif);
              titSel.html(newtext);
        	});
      imgSec.each(function(){
              var imgSel=$(this);
              var url=imgSel.attr("src");
              var newurl=decodificaImgUrl(url);
              imgSel.attr("src",newurl);
        	});
      enlaceSec.each(function(){
              var enlaceSel=$(this);
              var url=enlaceSel.attr("href");
              var newurl=decodificaImgUrl(url);
              enlaceSel.attr("href",newurl);
        	});
      function decodificaImgUrl(cif){
        var decodcif = atob(cif);
        return decodcif.split("").reverse().join("");
      }
      function decodificaLargeText(cif){
        var decodcif = atob(cif);
        return decodcif.split("").reverse().join("");
      }
		});
</script>
<script type="text/javascript" src="<?php echo $contenedor;?>/js/livevalidation.js"></script>
<link rel="stylesheet" href="<?php echo $contenedor;?>/css/accordion.css">
</head>

<body>
<!-- Section #1 -->
<section id="home" data-speed="10" data-type="background">
  <div id="header"><div id="headercont"></div></div>
  <div id="menu">
    <div id="menucont"><?php include("incmenu.php");?></div>
  </div>
  <div class="contenedor">
    <div id="central">
	 <div id="centralcont"><?php include("inccentral.php");?></div>
	</div>
	<?php include("inccuadro.php");?>
	<div id="footer">
	 <div id="footercont"><?php include("incfooter.php");?></div>
	</div>
	<div id="pxl"><div id="pxlcont"><?php include("incpxl.php");?></div></div>
  </div>
</section>
<div class="copySCHA">
  <!-- Target -->
   <input id="schaurl" value="https://www.schasociados.com">
   <!-- Trigger -->
   <button id="btnsec" class="btnsec" data-clipboard-target="#schaurl">
       Copy url scha
   </button>
</div>
<?php

 if($paramSec=='inicio' && empty($paramSec2)){
	 echo '<script type="text/javascript">';
	 echo '$(document).ready(function() {';
	 echo 'var linkLocation = "'.$contenedor.'/home";';
	 //echo 'event.preventDefault();';
	 /*echo '$(".contenedor").slideUp(5000); // effect*/
	 echo 'window.setTimeout(function(){document.location.href = linkLocation;}, 3000);';
	 echo 'function redirectPage() {
			window.location = linkLocation;
		   }';
	 echo '});';
	 echo '</script>';
 }
?>
</body>
</html>
