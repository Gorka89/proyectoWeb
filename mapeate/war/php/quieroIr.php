<?php 
if($_COOKIE['username']==''){
	header('Location: /index.html');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Gorkas Company" />
    <meta name="keywords" content="sistemas web, mapeate, comparte, mundo" />
    <meta name="description" content="Controla tus viajes y los de tus amigos.
    Comenta lugares visitados, y los que te apetece descubrir. Comparte tu mundo." />
    
    <title>Sitios a los que quiero ir</title>    
	    
    <link rel="icon" href="../images/mapa.gif" type="image/png" />
    
 
 	<!-- Scripts necesarios para el control de mapas -->
 	
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqXn2gWzmyke3FwAw_zfgvEos8tFeDDQ4&sensor=false">
    </script>
    
      <script type="text/javascript" src="../js/mapaIr.js"></script> 
    <script type="text/javascript" src="http://swfobject.googlecode.com/svn/trunk/swfobject/swfobject.js"></script>
    
    <link href="../css/fondo.css" rel="stylesheet" type="text/css" />
    <link href="../css/pruebaMap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/estiloPrueba.css" />
    
  </head>
  
  <body>
    	
  		<div id="principal">
  		
  			<?php 
  				$name = $_REQUEST['usuario'];
  				$psw = $_REQUEST['psw'];
  			?>
  		
  			<!-- Menú de navegación del sitio -->
  			<div id="menuLat">
				<ul class="navbar">
				  <li><a href="visit.php">Visitados</a></li>
				  <li><a href="quieroIr.php">Quiero visitar</a></li>
				  <li><a href="../presentacion.html">Recomendaciones de otros viajeros</a></li>
				  <li><a href="../comentarios.html">Comentarios</a></li>
				  <li><a href="/">Logout</a></li>
				</ul>
  			</div>
  		
  			<h2>
  				Tus visitas pendientes: <?php echo $_COOKIE['username']?>
  			</h2>
  			
  			<p>Situa en ROJO los sitios pendientes de descubrir</p>  				
			
			<p>Coordenada pulsada:</p>
        	<form action="/coordenada" method="post" name="formulario">
        	
	            Latitud: <input type="text" id="latitud" name="latitud"/> 
	            Longitud: <input type="text" id ="longitud" name="longitud"/><br/><br/>
	            Mensaje del lugar pendiente de visitar: <input type="text" id="texto" name="texto" />   
	  		
	            <input type="submit" value="Guardar visita pendiente"/>
	            
	            <input type="reset" value="Limpiar"/>           
            
        	</form>    
        	
				<input type="submit" value="Borrar ultimo pendiente situado" id="borrar" />
				
				<input type="submit" value="Situar pendiente de visitar" id="pendiente" />
  		
  			<br/>
	  		
	  			<div id="map_canvas">
	
    			</div>	
    	
   	   </div> 	
    	
  </body>
</html>