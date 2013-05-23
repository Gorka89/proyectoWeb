function validarCamposLogin () {
	var errores = 0;
	var usuarioLogin = document.getElementById ("usernameLogin");

	var passLogin = document.getElementById ("passwordLogin");

	if (usuarioLogin.value == ""){
		
		usuarioLogin.style.backgroundColor = "#FFCCCC";
		errores = 1;
	}else{
		usuarioLogin.style.backgroundColor = "rgb(12, 102, 102)";
	}

	if (passLogin.value == ""){
		
		passLogin.style.backgroundColor = "#FFCCCC";
		errores = 1;
	}else{
		passLogin.style.backgroundColor = "rgb(12, 102, 102)";
	}	
	
	if (errores == 0){
		
		var form = document.getElementById ("acceso");
		
		form.submit ();
	}
}

function validarCamposRegister () {
	var errores = 0;
	var usuarioText = document.getElementById ("username");

	var passText = document.getElementById ("password");
	
	var emailText = document.getElementById ("email");

	if (usuarioText.value == "")
	{
		usuarioText.style.backgroundColor = "#FFCCCC";
		errores = 1;
	}else{
		usuarioText.style.backgroundColor = "#12F4CC";
	}

	if (passText.value == "")
	{
		passText.style.backgroundColor = "#FFCCCC";
		errores = 1;
	}

    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(emailText.value) ){
        alert("Error: La dirección de correo " + emailText.value + " es incorrecta.");
        emailText.style.backgroundColor = "#FFCCCC";
    	errores = 1;
    }

	
	if (errores == 0)
	{
		var formR = document.getElementById ("registra");
		
		formR.submit ();
	}
}



function deshabilitar(form) {

    if (form.acepto.checked == true)
    {
    	form.registra.disabled = false;
    }
    if (form.acepto.checked == false)
    {
    	form.registra.disabled = true;
    }
}

function getCookie(c_name){
	
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	
	if (c_start == -1){
		c_start = c_value.indexOf(c_name + "=");
	}
	
	if (c_start == -1){
		c_value = null;
	}
	else{
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		
		if (c_end == -1){
			c_end = c_value.length;
		}
		
		c_value = unescape(c_value.substring(c_start,c_end));
	}
	
	return c_value;
}

function setCookie(c_name,value,exdays){
	
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;

}

function checkCookie(){
	
	var username=getCookie("username");
	
	if (username!=null && username!=""){
		alert("Welcome again " + username);
	}
	else
	  {
	  username=prompt("Please enter your name:","");
	  if (username!=null && username!="")
	    {
	    setCookie("username",username,365);
	    }
	  }
}

function Bienvenido(){

	var Visitante = getCookie("username");

	if (Visitante == null) {
		//se redirige al index por no estar registrado
		redireccionar("/index.html");
		//setTimeout ("redireccionar("/index.html")", 1000);
	}

	return Visitante;
}


function redireccionar(pagina) 
{
	location.href=pagina;

} 