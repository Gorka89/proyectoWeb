 <?php
 
	$recom[] = "Descubre Turqu&iacute;a y sus lugares ocultos";
	$recom[] = "Ven a Portugal este fin de semana";
	$recom[] = "Surca el Nilo y siente la m&aacute;gia de Egipto";
	$recom[] = "Dubrovnik, Croacia";
	$recom[] = "San Petersburgo y todo su encanto";
	$recom[] = "Mosc&uacute; . Ven a visitarlo.";
	$recom[] = "Verano en Ibiza. Calas de pel&iacute;cula";
	$recom[] = "Praga, en cualquier &eacute;poca";
	$recom[] = "New York, la ciudad del mundo";
	$recom[] = "Escapada a San Francisco";
	shuffle($recom);
	$recom[0] = addslashes($recom[0]);
	
	print "document.getElementById('mirecomendacion').innerHTML='".$recom[rand(0,9)]."';";

?> 