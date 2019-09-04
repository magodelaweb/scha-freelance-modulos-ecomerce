<?php
define('SERVER_MYSQL', 'localhost');
define('DATABASE',   'schasoci_web');
define('BD_USUARIO', 'schasoci_user');
define('BD_CLAVE',   'Web2012.4833!');
//$_SESSION['RUTASERVIDOR']= '/var/www/schasociados.com/public_html/';
$_SESSION['RUTASERVIDOR']= 'C:/xampp/htdocs/';

$conexion = db_data(SERVER_MYSQL,BD_USUARIO,BD_CLAVE,DATABASE);
//var_dump($conexion);

function db_data($server = DB_SERVER, $user = USER_DB, $password = PASSWORD_DB, $database = DATABASE, $link = 'link_db'){
	global $$link;
	$$link   = @mysql_connect($server, $user, $password);
	if (!$$link)
	{
  	 	die('Estamos en mantenimiento para brindar un mejor servicio (BD)');
	}
	if($$link) {
		if (!mysql_select_db($database,$$link))
			{
			echo "Error seleccionando la base de datos, verifique que el nombre de usuario utilizado este asociado a la base de datos.";
			exit();
			}
	}
	return $$link;
}
function db_inicialize(){
	//echo "inicializando...";
	$conexion = db_data(SERVER_MYSQL,BD_USUARIO,BD_CLAVE,DATABASE);
	return $conexion;
}
function db_query($query, $link = 'link_db'){
	global $$link;
	$result = mysql_query($query);
	return $result;
}
function db_fetch_array($query, $link = 'link_db'){
	global $$link;
	//echo $query." >>";
	//echo function_exists("mysql_fetch_array");
	$rs=mysql_fetch_array($query);
	//var_dump($$link);
	//var_dump($rs);
	//echo " <br />";
	return $rs;
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
