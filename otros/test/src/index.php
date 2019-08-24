<?php
$nombre="prueba.gif";
require_once("funciones.php");
$test=new Pruebas();
$res=$test->prueba1($nombre);
$res2=$test->prueba1($res);
echo "Prueba1<hr>"."file: ".$nombre."<br/>newFile: ".$res."<hr>";
echo "Prueba2<hr>"."file: ".$res."<br/>newFile: ".$res2."<hr>";
 ?>
