<?php

	//Comprobar que nos envien las variables
	if(!empty($_POST["username"]))
	{
	  //sleep(2); //only for debug
	  
	  //Super rutina de seguridad para la comprobación de usuarios
	  if($_POST["username"] == "admin" && $_POST["password"] == "admin")
	  {
	    echo "OK!"; //Dato clave, de esto depende el Formulario AJAX
	  }
	  else
	  {
	    echo "NO!"; //Dato clave, de esto depende el Formulario AJAX
	  }
	
	}
	elseif (!empty($_POST["password"]))
	{
		echo "Ha llegado content.";
		echo $_POST["content"];
	}
	else
	{
	  echo "eyyy yeajjj";  
	  //$_SESSION["username"] = $_POST["password"];
	  //echo "<html>
	  		
	  //		<head></head><meta HTTP-EQUIV='Refresh' CONTENT='3; URL=bienvenido-usuario-inicio-session.html'>
	  		
	  	//	<body>Hola ".$_SESSION['username']." Te Vamos a Redireccionar a Tu Cuenta</body></html>";
	  //include("login_template.html");
	}

?>