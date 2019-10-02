<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Samuel Chamochumbi & Asociados S.A.C. - Camiones y maquinaria pesada usada</title>
<meta name="description" content="How to create a parallax scrolling effect using jQuery, HTML5 and CSS3">
<meta name="author" content="Mohiuddin Parekh, Nettuts+">
<!--meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS Code -->
<!--link rel="stylesheet" href="/css/style.css"-->
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/touch-sideswipe.css">
<script type="text/javascript" src="/js/touch-sideswipe.js"></script>
<!-- JS Code -->
<!--<script src="/js/libs/jquery-1.6.1.min.js"></script>-->
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" id="idscript" src="/js/script.js?cont=" ></script>

<script type="text/javascript" src="/js/clipboard.min.js"></script>
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="/js/jquery.inview.js"></script>
<link rel="stylesheet" type="text/css" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
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
      var touchSideSwipe = new TouchSideSwipe({
        // container element
        elementID: 'touchSideSwipe',
        // width and height
        elementWidth: 340, //px
        elementMaxWidth: 0.95, // *100%
        sideHookWidth: 10, //px
        // animation speed in seconds
        moveSpeed: 0.2,
        // opacity of background
        opacityBackground:0,
        // in pixels
        shiftForStart: 10,
        // max width of window
        windowMaxWidth: 768,
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
      decodecifconten();
		});
		function decodecifconten(){
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
							$.ajax({
								url:newurl,
								type:'HEAD',
								error: function(){
										imgerror(imgSel);
						    },
						    success: function(){
						        imgSel.attr("href",newurl);
						    }
							});
        	});
      enlaceSec.each(function(){
              var enlaceSel=$(this);
              var url=enlaceSel.attr("href");
              var newurl=decodificaImgUrl(url);
							enlaceSel.attr("href",newurl);
        	});
		}
		function codificaImgUrl(nocif){
			nocif.split("").reverse().join("")
			return cif = btoa(cif);
		}
		function decodificaImgUrl(cif){
			var decodcif = atob(cif);
			return decodcif.split("").reverse().join("");
		}
		function decodificaLargeText(cif){
			var decodcif = atob(cif);
			return decodcif.split("").reverse().join("");
		}
		function imgerror(image){
			$(image).attr("src","/images/imgvoid.jpg");
		}
</script>
<script type="text/javascript" src="/js/livevalidation.js"></script>
<link rel="stylesheet" href="/css/accordion.css">
</head>

<body>
<!-- Section #1 -->
<section id="home" data-speed="10" data-type="background">
  <div id="header"><div id="headercont"></div></div>
  <div id="menu">
    <div id="menucont"><?php include("incmenu.php");?></div>
  </div>
  <div class="contenedor contenedor-margen">
    <div id="central">
	 <div id="centralcont"><?php include("inccentral.php");?></div>
	</div>
	<?php //include("inccuadro.php");?>
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
<input type="hidden" id="stopscroll" value="0">
<?php

 if($paramSec=='inicio' && empty($paramSec2)){
	 echo '<script type="text/javascript">';
	 echo '$(document).ready(function() {';
	 echo 'var linkLocation = "home";';
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
<script type="text/javascript">
		$(document).ready(function() {
      $('#loader').on('inview', function(event, isInView) {
               if (isInView) {
                   var nextPage = parseInt($('#pageno').val())+1;
                   $.ajax({
                       type: 'POST',
                       url: 'inchomenext.php',
                       data: { pageno: nextPage },
                       success: function(data){
												 //console.log("data: "+data);
                           if(data != ''){
                               $('.jscroll').append(data);
                               $('#pageno').val(nextPage);
                           }
													 else if (data == ''){
                               $("#loader").hide();
                           } else {
                               //$("#loader").hide();
                           }
                       }
                   });
               }
           });
					 $(window).scroll(function() {
						 //debugger;
						 var flag=$("#stopscroll").val();
						 if (flag=="0"){
							 	//console.log("0");
							 	$("#loader").fadeOut(1000, function() {});
	 							setTimeout(
	 						  function()
	 						  {
	 						    $("#loader").show();
	 						  }, 1000);
								$("#stopscroll").val("1");
						 }
					 });
		});
		function imgError(image){
			/*var cif=codificaImgUrl("images/imgvoid.jpg")
			$(image).attr("src",cif);*/
			imgerror(image);
		}


</script>
</body>
</html>
