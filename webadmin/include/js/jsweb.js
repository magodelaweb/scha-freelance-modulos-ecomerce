function subir_imagen(texto,ruta,tit) 
{	window.open("panel_upload.php?name=" +texto+ "&ruta=" +ruta+ "&tit=" +tit, "", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,top=50,left=200,resizable=no,width=600,height=400")
}
function buscar_persona(texto1,texto2) 
{	window.open("juvame_buscarpersona.php?name1="+texto1+"&name2="+texto2,"","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,top=50,left=200,resizable=yes,width=360,height=300")
}

function convierteAlias (nuevoAlias) {

especiales = new Array('á','é','í','ó','ú','ñ',' ',"'",'"',"&","%",',','.',':','^','+','*');
normales   = new Array('a','e','i','o','u','n','-','','','','','','','','','','');
nuevoAlias = nuevoAlias.toLowerCase();

patron = /[$#(){}|¡?¿/!@]/g;
	 
nuevoAlias = nuevoAlias.replace(patron,'');

i=0;
while (i<especiales.length) 
{
	nuevoAlias = nuevoAlias.split(especiales[i]).join(normales[i]);
	i++
}

 return nuevoAlias;

}
function ReemplazarEspacios() {
	cadenatexto       = document.form.titulo.value;
	document.form.amigable.value = convierteAlias(cadenatexto);
}
