<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Gorkas Company" />
    <meta name="keywords" content="sistemas web, mapeate, comparte, mundo" />
    <meta name="description" content="Controla tus viajes y los de tus amigos.
    Comenta lugares visitados, y los que te apetece descubrir. Comparte tu mundo." />
    
    <title>Visitados</title>    
	    
    <link rel="icon" href="../images/mapa.gif" type="image/png" />
    
 
 	<!-- Scripts necesarios para el control de mapas -->
 	
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqXn2gWzmyke3FwAw_zfgvEos8tFeDDQ4&sensor=false">
    </script>
    

    <script type="text/javascript" src="http://swfobject.googlecode.com/svn/trunk/swfobject/swfobject.js"></script>
    
    <link href="../css/fondo.css" rel="stylesheet" type="text/css" />
    <link href="../css/pruebaMap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/estiloPrueba.css" />
    <link rel="stylesheet" type="text/css" href="../css/buttonCSS.css" />
    
    <script type="text/javascript">

    var map;
    var marcador;
    var myLatlng = new google.maps.LatLng(37.192869,-3.613186);
    var mapOptions = {
          zoom: 10,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    

    function inicializar(){


		//control de cookies
		var Tools = {
		  createCookie: function(name, value,days) {
		    if (days) {
		      var date = new Date();
		      date.setTime(date.getTime()+(days*24*60*60*1000));
		      var expires = "; expires="+date.toGMTString();
		    }else var expires = "";
		      document.cookie = name+"="+value+expires+"; path=/";
		  },
		
		  readCookie: function(name) {
		    var nameEQ = name + "=";
		    var ca = document.cookie.split(';');
		    for(var i=0;i < ca.length;i++) {
		      var c = ca[i];
		      while (c.charAt(0)==' ') c = c.substring(1,c.length);
		      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		    }
		    return null;
		  },
		
		  eraseCookie: function(name) {
		    Tools.createCookie(name,"",-1);
		  }
		};
        


        var b = document.getElementById("recarga");
        b.addEventListener("click",function(){	


    			placeMarkerx(37.192869,-3.613186);

    			var coo = Tools.readCookie("coordenadas");

    			alert(coo);

    			var porcion = coo.substring(1, 4);
    			
    			prompt("porcion 1 a 4  "+porcion);
    			

    			var str_array = coo.split(',');



    			var l = coo.length;

    			prompt("Longitud "+l);

    			var li = l-2;
    			prompt("Long menos 2 "+li);
				var lon = parseFloat(li);
    			var porcion = coo.substring(2, lon);
    			var palabras = porcion.split(",");

    			prompt("sin paren "+porcion);
    			prompt("con split "+palabras);

    			for(var i = 0; i < palabras.length; i=i+2){
    			   // Trim the excess whitespace.
    			   //str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
    			   // Add additional code here, such as:
    			   alert(palabras[i]);
					var coorx = palabras[i];
					var coory = palabras[i+1];

					placeMarkerx(coorx,coory);
    			   
    			}
    			


     	
        });
        

        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);    

        google.maps.event.addListener(map, 'click', function(event) {

        	var myLatLngg = event.latLng;
            var lat = myLatLngg.lat();
            var lng = myLatLngg.lng();

         	alert("oigaa");

			placeMarkerx(lat,lng);
         	//placeMarkerCoord(lat,lng);
            
            map.setCenter(event.latLng);
             // Rellenar X e Y
            document.formulario.latitud.value=event.latLng.lat();
            document.formulario.longitud.value=event.latLng.lng();

            // Modificar X e Y al mover
            google.maps.event.addListener(marcador,'drag',function(event){
                document.formulario.latitud.value=event.latLng.lat();
                document.formulario.longitud.value=event.latLng.lng();
                map.setCenter(event.latLng);
            });

            findAddress(event.latLng);

        });

        }

        
        function placeMarker(location) {
                   
            var marcador = new google.maps.Marker({
            position: location,
            draggable: true, 
            map: map
            });

        }

        //funcion para posicionar coordenadas en el mapa
        function placeMarkerx(x,y) {

            var xx = parseFloat(x);
            var yy = parseFloat(y);
                   
            marcador = new google.maps.Marker({
            position: new google.maps.LatLng(xx, yy),
            draggable: true, 
            map: map,
            icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/blank.png'
            });

        }
        
        
        
     // finds the address for the given location
    	function findAddress(loc)
    	{
    		geocoder = new google.maps.Geocoder(); 
    		
    		if (geocoder) 
    		{
    			geocoder.geocode({'latLng': loc}, function(results, status) 
    			{
    				if (status == google.maps.GeocoderStatus.OK) 
    				{
    					if (results[0]) 
    					{
    						address = results[0].formatted_address;
    						
    						// fill in the results in the form
    						document.getElementById('latitud').value = loc.lat();
    						document.getElementById('longitud').value = loc.lng();

    					}
    				} 
    				else 
    				{
    					alert("Geocoder failed due to: " + status);
    				}
    			});
    		}
    	}
        
        //letrero con el mensaje recogido del elemento con id=texto
        function attachSecretMessage(marker) {

        	  var infowindow = new google.maps.InfoWindow(
        	      { content: document.getElementById("texto").value,
        	        size: new google.maps.Size(50,50)
        	      });
        	  google.maps.event.addListener(marker, 'click', function() {
        	    infowindow.open(map,marker);
        	  });
        }
        
            		
    </script>
    
  </head>
  
  <body onload="inicializar();">
    	
  		<div id="principal">
  		
  		
  			<!-- Menú de navegación del sitio -->
  			<div id="menuLat">
				<ul class="navbar">
				  <li><a href="/php/visit.php">Visitados</a></li>
				  <li><a href="/php/quieroIr.php">Quiero visitar</a></li>
				  <li><a href="/php/recomAleatorio.php">Recomendaciones de otros viajeros</a></li>
				  <li><a href="../comentarios.html">Comentarios</a></li>
				  <li><a href="../mapas.html">Logout</a></li>
				</ul>
  			</div>
  		
  			<h2>
  				Bienvenido a tus lugares <?php echo $_COOKIE['username']?>
  			</h2>
  			<p>Accede a las etiquetas de tus sitios ya vistos, y coloca nuevos puntos
  			a la vuelta de tus viajes.</p>
  			
  			
  			<p>VERDE: son tus sitios YA visitados </p>  				
			
			<p>Coordenada pulsada:</p>
        	<form action="/coordenada" method="post" name="formulario">
        	
	            Latitud: <input type="text" id="latitud" name="latitud"/> 
	            Longitud: <input type="text" id ="longitud" name="longitud"/><br/><br/>
	            Mensaje de la etiqueta VISITADO: <input type="text" id="texto" name="texto" />   
	  		
	            <input type="submit" value="Guardar visitado"/>
	            
	            <input type="reset" value="Limpiar"/>           
            
        	</form>    
        	
				<input type="submit" value="Borrar visitado" id="borrar" />
				
				<input type="submit" value="Recargar visitados" id="recarga" class="boton" />
				
				<button type="button" class="boton" >Genera una recomendaci&oacute;n aleatoria</button>
  		
  			<br/>
	  		
	  			<div id="map_canvas">
	
    			</div>	
    	
   	   </div> 
				
 		
 		<?php 
		    $dat1=23; 
		    $dat2="nombre"; 
		    $x = 37.765142;
		    $y = -3.795776;
		    echo "opero con variables php y al tener resultados trato de ejecutar funcion javascript  asi:" ;
		    echo "<script type='text/javascript'>";
		    echo "placeMarkerx(".$x.",".$y.")"; 
		    echo "</script> ";
 		?>
 		

    	
  </body>
</html>