<body>
<?php
//Conexion con la base de datos y el archivo que contiene la funcion email
require_once('../RECUPERA/db.php');
include('../RECUPERA/funcion.php');
    //Si presionan el boton Enviar, ejecutamos el Script
    if(isset($_POST['Enviar']))
        {
            //Validacion por parte del servidor
            if($_POST['mail']!='')
                {
                    //Hacemos la consulta en la base de datos
                    $query = "SELECT * FROM Usuarios 
                    		 WHERE email = '".($_POST['mail'])."'";
                    $getEmail = mysql_query($query) or die(mysql_error());
                    $row = mysql_fetch_assoc($getEmail);
                    //Componemos el mensaje
                    $headers = "From: oscar_jar16@hotmail.com \r\n";
                    $headers .= "Reply-To: oscar_jar16@hotmail.com \r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion();
                    $subject = "Peticion de Contraseña desde oscar_jar16@hotmail.com";
                    $message .= "La contraseñ de tu cuenta es: \r\n";
                    $message .= $row['PASS'];
                    
                    if(mail($row['E_MAIL'], $subject, $message, $headers))
                        {
                        //Solo establecemos esta variable si el envio fue exitoso
                            $exito = 'La contraseña fue enviada a su direccion de correo electronico';
                        }
                    else
                        {
                            $error = 'El envio ha fallado, porfavor contacte al administrador sobre este problema';
                        }
                }
            else
                {
                    $error = 'Asegurese de que no ha dejado el campo vacio y que la direccion de correo electronica es una direccion de correo valida';
                }
        }
        
if(isset($exito))
    {
        echo $exito;
    }
if(isset($error))
    {
        echo $error;
    }
else
//Solo mostramos el formulario si tenemos un mensaje de error
    { ?>
    <form id="form1" name="form1" method="post" action="<?=$_SERVER['../RECUPERA_CONTRASEÑA/PHP_SELF']?>">
 
<table width="246" border="7" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="36">Email:</td>
<td width="192"><input name="mail" type="text" id="mail" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" size="32" /></td>
</tr>
<tr>
<td> </td>
<td><input name="Enviar" type="submit" id="Enviar" value="Enviar" /></td>
</tr>
</table>
</form>
<p>
      <?php } ?>
</p>
<p><a href="../index.php"><strong>Salir    </strong></a></p>
</body>
</html> 