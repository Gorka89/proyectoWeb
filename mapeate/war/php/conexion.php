<?php
$db_host="mysql.webcindario.com";
$db_usuario="mapping";
$db_password="mapping_psw";
$db_nombre="mapping";
$conexion = @mysql_connect($db_host, $db_usuario, $db_password) or die(mysql_error());
$db = @mysql_select_db($db_nombre, $conexion) or die(mysql_error());
?> 