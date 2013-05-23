<html>
<body>

<?php

include "conexion.php";

$sql="INSERT INTO mapping.Usuarios (nombre ,email ,password) VALUES ('appengine', 'pep@gmail.com', MD5('asdf'))";

$result=mysql_query($sql, $conexion);

$result = mysql_query("SELECT * FROM Usuarios", $conexion);

echo "Nombre: ".mysql_result($result, 2, "nombre")."<br>";  
echo "Password :".mysql_result($result, 2, "password")."<br>"; 
echo "E-Mail :".mysql_result($result, 2, "email")."<br>";

$namer = $_POST["usuario"];
$pass = $_POST["password"];
$mail = $_POST["email"];

echo "namer : $namer";
echo "pass : $pass";
echo "mail : $mail";

$sql="INSERT INTO Usuarios (nombre ,email ,password) VALUES ('$namer', '$mail', MD5('$pass'))";
$result=mysql_query($sql, $conexion);

include "desconectar.php";

?> 

</body>
</html>