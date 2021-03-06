
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Disgo</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="jquery.jscroll.js"></script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="assets/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/fontlinear.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,400i,600,600i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="registro/css/material-bootstrap-wizard.css" rel="stylesheet" />

</head>

<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
<style>
    #eventos .event-img{position: relative;}
    #eventos .event-img .date{
        position: absolute;
        top: 0;
        background: #A84EE6;
        left: 10px;
        text-align: center;
        font-weight: 600;
        color: #fff;
        padding: 6px;
            width: 45px;
            border-radius: 0 0 3px 5px;
    }
    #eventos .event-img .date span{
        width: 100%;
        clear: both;
        display: block;
        font-size: 13px;
    }
    #eventos .event-img img{height: 135px; width: 100%;}
    #eventos .event-img .date span.day{font-size: 18px;line-height: 12px;}
    #eventos .detail-event{
        background: #fff;
        -webkit-box-shadow: 2px 2px 10px 0px rgba(105, 103, 103, 0.26);
        -moz-box-shadow: 2px 2px 10px 0px rgba(105, 103, 103, 0.26);
        box-shadow: 2px 2px 10px 0px rgba(105, 103, 103, 0.26);
        margin-bottom: 20px;
        border-radius: 0 0 7px 7px;
    }
    #eventos .title-event{padding: 5px 12px;}
    #eventos .title-event a{    
        margin: 0;
        color: #a84de6;
        font-size: 15px;
        font-weight:600;}
    #eventos .title-event p{margin: 0;line-height: 20px;font-size: 13px;margin-top: -3px;}
    #search1 input{width: 250px;border-radius: 20px; margin-bottom: 0;margin: 0 auto;display: inline-block;}
    #search1 .btn.btn-fab{
        height: 36px;
        min-width: 40px;
        width: 35px;
        color: #fff;
        box-shadow: none;
        background: #a84de6;
        margin-left: -40px;
        border-radius: 0 20px 20px 0;
        margin-top: -6px;
    }
    #eventos .bloque-search{background: #4e4b50; padding: 10px}
    #eventos .tab-pane{ padding: 15px 0;}
    #eventos .nav-tabs > li > a{letter-spacing: 0.2px;font-weight: bold;cursor: pointer;}
    #eventos .nav-tabs > li > a, 
    #eventos .nav-tabs > li > a:hover, 
    #eventos .nav-tabs > li > a:focus{outline:none; box-shadow:none;background-color: rgba(165, 165, 165, 0.67);}

    #eventos .nav-tabs > li.active > a, 
    #eventos .nav-tabs > li.active > a:hover, 
    #eventos .nav-tabs > li.active > a:focus{background-color: transparent!important;color: #828282;font-weight: bold}

    #eventos .form-group {margin-bottom: 0;display: inline-block;}
    #eventos .form-group input.form-control{border: 1px solid rgb(168, 77, 230);}
    .etiqueta{
            position: absolute;
            right: 8px;
            bottom: 8px;
            color: #ffffff;
            width: 80px;
            padding: 0px;
            border-radius: 15px;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 13px;
    }
    .etiqueta.abierto{background: #acf344ad;}
    .etiqueta.cerrado{background: #ff3c3ccc;}
    .products_event{background: #000; display: block; overflow: hidden;padding: 0;border-radius: 0 0 7px 7px;}
    .products_event .col-md-4{text-align: center;padding: 5px 0 5px;border-right: 1px solid black;border-radius:0 0 6px 6px;background:white;}
    .products_event .col-md-4 a{color: #30054e}
    .products_event .col-md-4 .fa, .products_event .col-md-4 span{display: block;float: none;clear: both;}
    .products_event .col-md-4 span{font-size: 12px;}
    .products_event .col-md-4 .fa{font-size: 22px;color: #929292;}
    .name_pe{font-weight: bold}
    .products_event .col-md-4 span.price_pe{margin-top: -4px;font-size: 11px;}
    .products_event .col-md-4.inactive{opacity: 0.4}
    .products_event .col-md-4.active{opacity:1}
    
    .products_event .col-md-4:first-child{border-left:none;}
    .products_event .col-md-4:last-child{border-right:none;}
    
    .products_event .col-md-4.active { background: white;}

    select{
        width: 160px;
        height: 36px;
        font-size: 14px;
        line-height: 1.42857;
        transition: background 0s ease-out;
        float: none;
        box-shadow: none;
        font-weight: 400;
        padding: 0 20px;
        color: #2C1342;
        background-color: #fff;
        background-image: none;
        border-radius: 20px;
    }
     @media (min-width: 420px) and (max-width: 768px){
        #eventos .detail-event{width: 350px;    margin: 0 auto 15px;}
        #eventos .item-event {width: 350px;margin: 0 auto;float: none;}
    }
    @media (max-width: 420px){
        #eventos .item-event {width: 100%;margin: 0 auto;float: none;padding: 0 8px;}
        #eventos .event-img img {height: auto;width: 100%;}
        #eventos .detail-event{margin-bottom:15px;}
        #search1 .btn.btn-fab{margin-top:-5px;}
        #search1 input {width: 98%;}
    }
    @media (max-width: 768px){
        #eventos .filter{display: none;}
        #eventos .bmd-form-group{text-align: center;}
        #eventos .form-group{width: 87%;}
    }
    @media (min-width: 768px){
        .form-inline .form-control {vertical-align: initial;}
    }

</style>
<body style="background: #000;">
        <div id="eventos">
            <div class="container" style="padding: 10px 0">
                <div class="row" style="margin:0">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px; padding:0 8px;">
                         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbox" style="padding: 0">
                             <form id="search1" class="form-inline ml-auto">
                                <div class="has-white bmd-form-group">
                                  <input type="text" class="form-control" placeholder="Buscar">
                                  <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                  </button>
                                </div>
                            </form>
                        </div>
                         <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right text-right filter" style="padding: 0">
                             <span style="color: #fff;margin-right: 10px;"><i class="fa fa-filter"></i> Filtrar por:</span>
                             <select name="" id="">
                                 <option value="">Destacados</option>
                                 <option value="">Pr??ximos</option>
                                 <option value="">Anteriores</option>
                             </select>
                         </div>-->
                    </div>
			    	<div class="scroll col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

<?php
//Se importa el archivo php de paginacion simple
require_once 'pagscroll.php';
?>

</div>
</div>
</div>

</div>

<script>
//Simple codigo para hacer la paginacion scroll
$(document).ready(function() {
	$('.scroll').jscroll({
    loadingHtml: '<img src="gif.gif" alt="Loading" height="150" style="display:block; margin: 0 auto; float:none">'
});
});
</script>
</body>
</html>
