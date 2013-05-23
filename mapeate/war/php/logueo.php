<?php
   setcookie("ejemusuario", "nombre", time()+3600,"/","");    
?>
<html>
<head>
<title>Login</title>
</head>
<body>
<?php

	session_start();
		
	 echo "Sesion iniciada correctamente.";
	 echo 'La sesión actual es: '.session_id();
	 

?>
</body>
</html> 