//recuperamos la query string
var qs = document.getElementById("idscript").src.match(/\w+=\w+/g);
 
//array para almacenar las variables
var _GET= {};
 
var t;
var i = (qs!=null)?qs.length:0;
while (i--) {
 
     //t[0] nombre del parametro y t[1] su valor
     t = qs[i].split("=");
 
     //opción 1: a modo de PHP
     _GET[t[0]] = t[1];
 
    //opción2: variables con el mismo nombre usando eval
    eval('var '+t[0]+'="'+t[1]+'";');
}
 
//mostrar el nombre 2 veces
//alert(_GET['cont']);
 
function include(url) {
    if(_GET['cont']==undefined) _GET['cont'] = '';
    document.write('<script src="' + _GET['cont'] + '/' + url + '"></script>');
    return false;
}
 
$(document).ready(function(){
	// Cache the Window object
	$window = $(window);
                
   $('section[data-type="background"]').each(function(){
     var $bgobj = $(this); // assigning the object
                    
      $(window).scroll(function() {
                    
		// Scroll the background at var speed
		// the yPos is a negative value because we're scrolling it UP!								
		var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
		
		// Put together our final background position
		var coords = '50% '+ yPos + 'px';

		// Move the background
		$bgobj.css({ backgroundPosition: coords });
		
}); // window scroll Ends

 });	

}); 
/* 
 * Create HTML5 elements for IE's sake
 */

document.createElement("article");
document.createElement("section");

/*toTop*/
include('js/jquery.ui.totop.js');
$(function () {
    $().UItoTop({ easingType: 'easeOutQuart' });
});

/* Superfish menu
 ========================================================*/
/*include('js/superfish.js');
include('js/jquery.mobilemenu.js');*/


/* Orientation tablet fix
 ========================================================*/
/*$(function () {
// IPad/IPhone
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
        ua = navigator.userAgent,

        gestureStart = function () {
            viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0";
        },

        scaleFix = function () {
            if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                document.addEventListener("gesturestart", gestureStart, false);
            }
        };

    scaleFix();
    // Menu Android
    if (window.orientation != undefined) {
        var regM = /ipod|ipad|iphone/gi,
            result = ua.match(regM)
        if (!result) {
            $('.sf-menu li').each(function () {
                if ($(">ul", this)[0]) {
                    $(">a", this).toggle(
                        function () {
                            return false;
                        },
                        function () {
                            window.location.href = $(this).attr("href");
                        }
                    );
                }
            })
        }
    }
});
var ua = navigator.userAgent.toLocaleLowerCase(),
    regV = /ipod|ipad|iphone/gi,
    result = ua.match(regV),
    userScale = "";
if (!result) {
    userScale = ",user-scalable=0"
}
document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0' + userScale + '">');*/