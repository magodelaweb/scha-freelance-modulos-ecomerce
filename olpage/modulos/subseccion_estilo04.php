<script type='text/javascript'>
      $(window).load( function() {
           $('a.link_out').bind("click", function() {
              url = $(this).attr("href");
              $.post("/modulos/contador.php",
		         { "url": url },
			  function() {
				window.location=url;
		         } );
	      return false;
           });
     });
</script>
<?php 
$sql_seccion = "SELECT * FROM  seccion WHERE ccodseccion like '".$cat."%' and cnivseccion='".($nivsecc+1)."' AND cestseccion='1' order by cnomseccion";
$que_seccion = db_query($sql_seccion);
$fila = 0;
while ($row_seccion=db_fetch_array($que_seccion))
{ 
	$enlaceurl     = $rutasec."/".$row_seccion['camiseccion'];
	$fila = $fila +1;
	if (($fila % 2)==0)
		$filaclase="2";
	else 
		$filaclase="1";
	
?>
	<div class="seccionindex50<?=$filaclase?>">
		<dl class="seccionindex" >
			<dt><a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>"><?=$row_seccion['cnomseccion']?></a></dt>
			<dd></dd>
		</dl>
	</div>
<?php  } ?>
