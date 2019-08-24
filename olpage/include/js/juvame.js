function swf(id,filename, width, height, flashvars, params, attributes)
{
	var arrayFlvars = new Array();
	for(var i in flashvars){ arrayFlvars.push(i+'='+flashvars[i]); }
	flashvars = arrayFlvars.join('&');
	
	var arrayAttrs = new Array();
	for(var i in attributes){ arrayAttrs.push(i + '="' + attributes[i] + '"'); }
	attributes = arrayAttrs.join(' ');
	
	var html = '<object id="'+id+'" width="'+width+'" height="'+height+'" type="application/x-shockwave-flash" data="'+filename+'"><param name="movie" value="'+filename+'?'+flashvars+'"></param>';
	var arrayParams = new Array();
	for(var i in params){
		html += '<param name="'+i+'" value="' + params[i] + '" />';
		arrayParams.push(i+'="'+params[i]+'"');
	}
	html += '<param name="flashvars" value="' + flashvars + '" />';
	params = arrayParams.join(' ');
	html += '</object>';
	return html;
}

function Validar_busqueda(frm_buscar){
	if(frm_buscar.palabra.value.length < 3) {
		alert('La referencia de Búsqueda  debe tener como minimo 3 caracteres');
		frm_buscar.palabra.focus();

		return false;
	}
	return true;
}


function valida_numero() 
{
	if (event.keyCode < 46 || event.keyCode > 57 || event.keyCode == 47)
	event.returnValue = false;
}


function valida_email(email)
{
    if(email.length <= 8)
	{
	  return false;
	}
    if(!email.match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i)){
		return false;
	}else{
		return true;
	}
}

function valida_fecha(Cadena)
{  
     var Fecha= new String(Cadena)  
     var RealFecha= new Date()  
     var Dia= new String(Fecha.substring(0,Fecha.indexOf("-")))  
     var Mes= new String(Fecha.substring(Fecha.indexOf("-")+1,Fecha.lastIndexOf("-")))  
     var Ano= new String(Fecha.substring(Fecha.lastIndexOf("-")+1,Fecha.length))  
   
     if (isNaN(Ano) || Ano.length<4 || parseFloat(Ano)<1900){  
         return false  
     }  
     // Valido el Mes  
     if (isNaN(Mes) || parseFloat(Mes)<1 || parseFloat(Mes)>12){  
         return false  
     }  
     // Valido el Dia  
     if (isNaN(Dia) || parseInt(Dia, 10)<1 || parseInt(Dia, 10)>31){  
         return false  
     }  
     if (Mes==4 || Mes==6 || Mes==9 || Mes==11 || Mes==2) {  
         if (Mes==2 && Dia > 28 || Dia>30) {  
             return false  
         }  
     }  
       
   return true    
}  
function convierteAlias (nuevoAlias) {

especiales = new Array('@','á','é','í','ó','ú','ñ',' ','´',':',',',';','.');
normales   = new Array('','a','e','i','o','u','n','-','','','','','');
nuevoAlias = nuevoAlias.toLowerCase();
i=0;
while (i<especiales.length) 
{
	nuevoAlias = nuevoAlias.split(especiales[i]).join(normales[i]);
	i++
}
 return nuevoAlias;
}

function validarnick(e,v){
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    if (tecla==32) return false; // 3
	patron =/[A-Za-z0-9\s-]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6

}

function validar_contactos(form){
	if (form.nombre.value == ""){ alert("Por favor, ingrese su nombre"); form.nombre.focus(); return false;}
	if (form.apellido.value == ""){ alert("Por favor, ingrese su apellido"); form.apellido.focus(); return false;}
	if (form.ciudad.value == ""){ alert("Por favor, ingrese su ciudad"); form.ciudad.focus(); return false;}
	
	if (form.correo.value == ""){ alert("Por favor, ingrese su dirección de correo"); form.correo.focus(); return (false); }
	if (form.correo.value.length!=0)
		if (form.correo.value.indexOf('@', 0) == -1 || form.correo.value.indexOf('.', 0) == -1)
			{ alert("Dirección de correo inválida"); form.correo.focus(); return (false); }
			
	if (form.asunto.value == ""){ alert("Por favor, ingrese el asuento del mensaje"); form.asunto.focus(); return false;}
	if (form.mensaje.value == "")	{ alert("Por favor, ingrese su mensaje"); form.mensaje.focus(); return false;}
			
	return true;
}

function validar_registrousuarios(form) 
{
	if (form.nick.value =="") { alert("Escribir nombre de usuario"); form.nick.focus(); return (false); }
	if (form.password.value =="") { alert("Escribir contraseña "); form.password.focus(); return (false); }
	if (form.password2.value =="") { alert("Confirme su contraseña "); form.password2.focus(); return (false); }
	if (form.password.value != form.password2.value ){ alert("Las contraseñas no son iguales"); form.password.focus(); return (false); }
	if (form.nombre.value =="") { alert("Escribir nombres "); form.nombre.focus(); return (false); }
	if (form.email.value == "") { alert("Escribir un correo electronico valido"); form.email.focus(); return (false); }
		if (form.email.value.length!=0)
		if (form.email.value.indexOf('@', 0) == -1 || form.email.value.indexOf('.', 0) == -1)
			{ alert("Escribir un correo electronico valido "); form.email.focus(); return (false); }

	if (form.fechanac.value =="") { alert("Por favor, Seleccione una fecha usando el calendario "); form.fechanac.focus(); return (false); }
}

function validar_recomendar(form) 
{
	if (form.nombre.value =="") { alert("Escribir nombres "); form.nombre.focus(); return (false); }
	if (form.email.value == "") { alert("Escribir un correo electronico valido"); form.email.focus(); return (false); }
	if (form.email.value.length!=0)
		if (form.email.value.indexOf('@', 0) == -1 || form.email.value.indexOf('.', 0) == -1)
			{ alert("Escribir un correo electronico valido "); form.email.focus(); return (false); }
	if (form.paranombre.value =="") { alert("Escribir nombre destino "); form.paranombre.focus(); return (false); }
	if (form.paraemail.value == "") { alert("Escribir un correo electronico destino"); form.paraemail.focus(); return (false); }
	if (form.paraemail.value.length!=0)
		if (form.paraemail.value.indexOf('@', 0) == -1 || form.paraemail.value.indexOf('.', 0) == -1)
			{ alert("Escribir un correo electronico valido "); form.paraemail.focus(); return (false); }
	if (form.security_code.value =="") { alert("Escribir codigo de seguridad "); form.security_code.focus(); return (false); }
}


/*********** form login de usuarios **************/
function valid_formlogin(form){
	if (form.email.value == "")
	{ alert("Por favor ingrese su dirección de correo"); form.email.focus(); return (false); }
	if (form.email.value.length!=0)
		if (form.email.value.indexOf('@', 0) == -1 || form.email.value.indexOf('.', 0) == -1)
			{ alert("Dirección de correo inválida"); form.email.focus(); return (false); }
	if (form.clave.value == "")
	{ alert("Por favor ingrese su contraseña"); form.clave.focus(); return (false); }
 }

function valid_pasnuevo(form) 
{
	if (form.pasnuevo.value == "" )
		{ alert("Escriba en nuevo contraseña"); form.pasnuevo.focus(); return (false); }
	if (form.pasnuevor.value == "" )
		{ alert("Vuelva escribir la nueva contraseña"); form.pasnuevor.focus(); return (false); }
	if (form.pasnuevo.value == form.pasnuevor.value )
		{ alert("Las nuevas contraseñas no son iguales"); form.pasnuevo.focus(); return (false); }
}

function validar_recuperarclave(form)
{
	if (form.email.value == "")
	{ alert("Por favor ingrese su dirección de correo"); form.email.focus(); return (false); }
	if (form.email.value.length!=0)
		if (form.email.value.indexOf('@', 0) == -1 || form.email.value.indexOf('.', 0) == -1)
			{ alert("Dirección de correo inválida"); form.email.focus(); return (false); }
			
	return true;
}

function buscar_persona(texto1,texto2) 
{	window.open("zonap_buscarpersona.php?name1="+texto1+"&name2="+texto2,"","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,top=50,left=200,resizable=yes,width=400,height=300")
}

function subir_imagen(texto,ruta,tit) {
	window.open("webadmin_subir.php?name=" +texto+ "&ruta=" +ruta+ "&tit=" +tit, "", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,top=50,left=200,resizable=no,width=600,height=400")
}


function nuevoAjax() {
	var xmlhttp=false;
	try {
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp=false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp=new XMLHttpRequest();
	}
	return xmlhttp;
}



function cargarZona(frm,pais)
{
	if (frm.hidajax.value=="")
	{
		frm.hidajax.value="x";
		contenedor=document.getElementById('zonas');
		contenedor.innerHTML='<font face=Verdana color=red>Espere</font>';
		contenedor2=document.getElementById('zciudad');
		contenedor2.innerHTML='<select name=ciudad><option value=00000000>Todos</option></select>';
		ajax=nuevoAjax();
		ajax.open("GET","ajaxzonas.php?pais="+pais,true);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4) 
			{
				contenedor.innerHTML=ajax.responseText;
				frm.hidajax.value="";
			}
		}
		ajax.send(null);
	}
}

function cargarCiudad(frm,ciudad)
{
	if (frm.hidajax2.value=="")
	{
		frm.hidajax2.value="x";
		contenedor2=document.getElementById('zciudad');
		contenedor2.innerHTML='<font face=Verdana color=red>Espere</font>';
		ajax2=nuevoAjax();
		ajax2.open("GET","ajaxciudad.php?codciudad="+ciudad,true);
		ajax2.onreadystatechange=function()
		{
			if (ajax2.readyState==4) 
			{
				contenedor2.innerHTML=ajax2.responseText;
				frm.hidajax2.value="";
			}
		}
		ajax2.send(null);
	}
}

function enviar()
{
		document.frm_buscar.action="buscador";
		document.frm_buscar.submit();
}
