<?php
require_once("crypto.php");
class Pruebas{
  public function prueba1($nombre){
    $f=$this->renombraString($nombre);
    return $f;
  }
  private function renombraString($nombreFile){
    //return "test 2";
    $guid=GUIDv4();
    try {
      list($nom, $ext) = explode (".", $nombreFile);
      list($base) = explode ("_", $nom);
      $nomFinal=$base."_".$guid.".".$ext;
      return $nomFinal;
    } catch (\Exception $e) {
      return $e;
    }
  }
}
?>
