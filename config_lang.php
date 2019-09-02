<?php
if ($webidio=="es")
{
	define("menu_inicio", "Inicio");

	/***********************  Formulario Contactenos **************/
	define("contactos_nombre",    "Nombres y apellidos");
	define("contactos_empresa",   "Empresa");
	define("contactos_correo",    "Correo Electrónico");
	define("contactos_pais",      "Pais");
	define("contactos_ciudad",    "Ciudad");
	define("contactos_telefono",  "Telefono");
	define("contactos_consulta",  "Consulta");
	define("contactos_seguro",    "Codigo de Seguridad");
	define("contactos_enviar",    "Enviar Consulta");
	define("contactos_ok",        "Su mensaje ha sido enviado correctamente. En las proximas horas le estaremos atendiendo. Utilice los botones de navegaci&oacute;n para continuar.");
	define("contactos_error",     "Su mensaje no ha sido enviado. por error en el codigo de seguridad.");

	/***********************  Formulario Buscador **************/
	define("buscador_miga",      "Buscador");
	define("buscador_titulo",    "Buscador de contenidos");
	define("buscador_detalle",   "Mostramos los resultados de su consulta");


	/***********************  Formulario registro **************/
	define("registro_miga",      "Registro");
	define("registro_titulo",    "Crea una cuenta");
	define("registro_detalle",   "Rellene los datos");
	define("registro_nombre",    "Nombres");
	define("registro_correo",    "Correo Electrónico");
	define("registro_pais",      "Pais");
	define("registro_ciudad",    "Ciudad");
	define("registro_fecha",     "Fecha Nacimiento");
	define("registro_sexo",      "Sexo");
	define("registro_password",  "Cree una contraseña");
	define("registro_suscripcion","Acepto suscribirme para recibir boletines de noticias y ofertas");
	define("registro_enviar",    "Registrarse");

	/***********************  Formulario Buscador **************/
	define("recuperar_miga",      "Recuperar contraseña");
	define("recuperar_titulo",    "Recuperar contraseña");
	define("recuperar_detalle",   "Escriba su correo electronico registrado para poder enviar los pasos para crear una nueva contrase�a de acceso a nuestra comunidad");


	/***********************  Formulario Login de usuarios **************/
	define("micuenta_correo",    "Correo Electronico");
	define("micuenta_password",  "Contraseña");
	define("micuenta_enviar",    "Ingresar");
	define("hotel_cate","Categoria de Hotel");
	define("hotel_tipo","Precio por persona");


}

if ($webidio=="en")
{
	define("menu_inicio",    "Home");
	/***********************  Formulario Contactenos **************/
	define("contactos_nombre",    "Name");
	define("contactos_empresa",   "Company");
	define("contactos_correo",    "Email");
	define("contactos_pais",      "Country");
	define("contactos_ciudad",    "City");
	define("contactos_telefono",  "Telephone");
	define("contactos_consulta",  "Message");
	define("contactos_seguro",    "Security Code");
	define("contactos_enviar",    "Send");
	define("contactos_ok",        "");
	define("contactos_error",     "");

	define("micuenta_correo",    "Email");
	define("micuenta_password",  "Password");
	define("micuenta_enviar",    "Star");

	define("hotel_cate","Hotels Category ");
	define("hotel_tipo"," Price per person");

}


?>
