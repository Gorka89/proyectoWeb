<?
if (!$HTTP_POST_VARS){
?>
<br>
<form action="<? echo $PHP_SELF ?>" method=post>
<table width="384" height="280" border="0">
<tr>
	<td height="131" colspan="3">
		<p>
			<span class="Estilo2">Nombre: </span>
			<input type=text name="nombre" size=30>
		</p>
		
		<p>
			<span class="Estilo2">Email: </span>
			<input type=text name="email" size=30>
		</p>
	</td>
</tr>

<tr>
	<td width="71">
		<span class="Estilo2">Comentario:</span>
	</td>
	
	<td width="297" colspan="2">
		<div align="left">
			<textarea name="comment" cols=40 rows=6></textarea>
		</div>
	</td>
</tr>

<tr>
	<td colspan="3">
			<input name="submit" type=submit value="Enviar" />
	</td>
</tr>
</table>
<br>
<br>
</form>
<?
}else{
	//Estoy recibiendo el formulario, compongo el cuerpo
	$cuerpo = "Formulario enviado\n";
	$cuerpo .= "Nombre: " . $HTTP_POST_VARS["nombre"] . "\n";
	$cuerpo .= "Email: " . $HTTP_POST_VARS["email"] . "\n";
	$cuerpo .= "Comentario:" . $HTTP_POST_VARS["comment"] . "\n";
	
	$name = $HTTP_POST_VARS["nombre"];
	$com= $HTTP_POST_VARS["comment"];
	
	$user = new Java("Comments");
	//$user->Comments($name,$com);
	
	$coment = $user->getComment();
	
	
	$java_obj = new Java("HolaMundo");
	// llamamos al metodo saludarAlMundo
	$str = $java_obj->saludar($name);
	echo $str;
		
	
	echo "OK";
}
?>