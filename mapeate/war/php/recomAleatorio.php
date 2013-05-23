<html>
<head><title>Generador de recomendacioes</title>

	<link rel="stylesheet" type="text/css" media="screen" href="../css/fondo.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../css/buttonCSS.css" />

	

	<script type="text/javascript">
		function genera(){
		    var minuevoscript = document.createElement("script");
		    minuevoscript.src = 'recomiendan.php';
		    minuevoscript.setAttribute('language', 'javascript');
		    minuevoscript.setAttribute('type', 'text/javascript');
		    document.body.appendChild(minuevoscript);    
		}
	</script>
	
</head>
<body>	

	<div id="mirecomendacion"></div>
	<button type="button" onClick="genera();" class="boton" >Genera una recomendaci&oacute;n aleatoria</button>
	
</body>
</html> 