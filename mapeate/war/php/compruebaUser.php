<?php
// Conectar a la base de datos 
	//mysql_connect ($dbhost, $dbusername, $dbuserpass); 
	//mysql_select_db($dbname) or die('No se puede seleccionar la base de datos'); 
	
	if ($_POST['usuario']) { 
		//Comprobacion del envio del nombre de usuario y password 
		$username=$_POST['usuario']; 
		$password=$_POST['password']; 
		
		if ($password==NULL) { 
			echo "La password no fue enviada, haz Click ".'<a href="javascript:history.back(1)"> 
			Aqui</a>'." para regresar"; 
		}else{ 			

			$query = mysql_query("SELECT username,password FROM usuarios WHERE username = '$username'") or die(mysql_error()); 
			$data = mysql_fetch_array($query); 
			
			if($data['password'] != $password) { 
				header("Location:error_usuario.php"); 
			}
			else{ 
				$query = mysql_query("SELECT username,password FROM usuarios WHERE username = '$username'") or die(mysql_error()); 
				$row = mysql_fetch_array($query); 
				$_SESSION["s_username"] = $row['username']; 
				header("Location: usuarios_reg/principal.php");  
			}
		}
	}
?>