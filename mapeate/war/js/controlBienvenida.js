function Bienvenido(){

	var Visitante = getCookie("username");

	if (Visitante == null) {
		//se redirige al index por no estar registrado
		//redireccionar("/index.html");
		location.href="http://mapeate.appspot.com/index.html";
		//setTimeout ("redireccionar("/index.html")", 1000);
	}

	return Visitante;
}


function redireccionar(pagina) 
{
	location.href=pagina;

} 