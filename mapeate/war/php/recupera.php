<html>
<head>
<title>Recuperando clave</title>
</head>
<body>
<?php
	$email = $_POST['email'];
	
	if ($email == "")
	{
		echo "Debes ingresar un email para recuperar la clave.";
	}
	// Forma para validar el email, usando la funcion "strpos":
	elseif (!strpos($email,"@hotmail.") && !strpos($email,"@gmail.") && !strpos($email,"@yahoo.") && !strpos($email,"live.com."))
	{
		echo "El email ingresado es incorrecto.";
	}
	else
	{
		
		//$from = "recuperaMapping@gmail.com";
		//$java_obj = new Java("SendEmail");
		// llamamos al metodo saludarAlMundo
		//$str = $java_obj->gaeMail($from,$email, 'Nueva clave Mapping', 'Aqui esta tu nueva clave generada');
		//echo $str;
		
		
		//mail($email, "Asunto", "mensaje") or die ("No se ha podido enviar tu mensaje. Ha ocurrido un error") ;
	 //mail("pepittyo@desarrolloweb.com","asuntillo","Este es el cuerpo del mensaje");
	 echo "Mensaje enviado correctamente.";
	 echo "Vuelve a la página principal y logueate con la clave recibida por correo.";
	 
	
	}
?>
</body>
</html> 