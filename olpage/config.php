<?php 
define('SERVER_MYSQL', 'localhost');
define('DATABASE',   'schasoci_web');
define('BD_USUARIO', 'schasoci_user');
define('BD_CLAVE',   'Web2012');
$_SESSION['RUTASERVIDOR']= '/home/schasoci/public_html/';
//$_SESSION['RUTASERVIDOR']= 'C:/AppServ/www/';

$conexion = db_data(SERVER_MYSQL,BD_USUARIO,BD_CLAVE,DATABASE);


function db_data($server = DB_SERVER, $user = USER_DB, $password = PASSWORD_DB, $database = DATABASE, $link = 'link_db'){
	global $$link;
	$$link   = @mysql_connect($server, $user, $password);
	if (!$$link) 
	{ 
  	 	die('Estamos en mantenimiento para brindar un mejor servicio (BD)'); 
	} 
	if($$link) mysql_select_db($database);
	return $$link;
}
function db_query($query, $link = 'link_db'){
	global $$link;
	$result = mysql_query($query);
	return $result;
}
function db_fetch_array($query){
	return mysql_fetch_array($query);
}
function db_num_rows($query){
	return mysql_num_rows($query);
}
function db_insert_id(){
	return mysql_insert_id();
}
function db_close(){
	return mysql_close();	
}

?>