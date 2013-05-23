<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <title>Insertar nuevo contacto</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
         <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false">
        </script>
         <script src="../js/controlBienvenida.js" type="text/javascript"></script>
            <script type="text/javascript">
            function inicializar(){
            var mapa;
            var marcador;
            var myLatlng = new google.maps.LatLng(37.192869,-3.613186);
            var mapOptions = {
                  zoom: 10,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            mapa = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);    

            google.maps.event.addListener(mapa, 'click', function(event) {
                   // Crear marcador
                   if (marcador) marcador.setMap(null);                   
                   marcador = new google.maps.Marker({
                   position: event.latLng,
                   draggable: true, 
                   map: mapa
                });
                mapa.setCenter(event.latLng);
                 // Rellenar X e Y
                document.formulario.latitud.value=event.latLng.lat();
                document.formulario.longitud.value=event.latLng.lng();

                // Modificar X e Y al mover
                google.maps.event.addListener(marcador,'drag',function(event){
                    document.formulario.latitud.value=event.latLng.lat();
                    document.formulario.longitud.value=event.latLng.lng();
                    mapa.setCenter(event.latLng);
                });

                findAddress(event.latLng);

            });

            }

            function placeMarkerCoord(x,y) {
                
            	  var marker = new google.maps.Marker({
            	      position: new google.maps.LatLng(x, y),
            	      map: mapa,
            	      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/orange/blank.png'
            	  });
            	  
            	  alert("estamos en coord");
            	  
            	  prompt("hola esto es x"+x+" Y: "+y);
            	              	  

            }


            function placeMarker(latitud, longitud) {
          	  var marker = new google.maps.Marker({
          	      position: new google.maps.LatLng(latitud, longitud),
          	      map: mapa,
          	      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/blank.png'
          	  });
          	  
          	  marker.setTitle("vaaa");
          	  attachSecretMessage(marker);
          	  
          }

            function attachSecretMessage(marker) {

          	  var infowindow = new google.maps.InfoWindow(
          	      { content: "einn",
          	        size: new google.maps.Size(50,50)
          	      });
          	  google.maps.event.addListener(marker, 'click', function() {
          	    infowindow.open(mapa,marker);
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

            function alerta(){
            	alert("estamios en alertaaaaa");
            }

        	// initialize the array of markers
        	var markers = new Array();
        	
        	// the function that adds the markers to the map
        	function addMarkers()
        	{
        		// get the values for the markers from the hidden elements in the form
        		var lats = document.getElementById('latitud').value;
        		var lngs = document.getElementById('longitud').value;
        		
        		var las = lats.split(";;");
        		var lgs = lngs.split(";;");

        		
        		// for every location, create a new marker and infowindow for it
        		for (i=0; i<las.length; i++)
        		{
        			if (las[i] != "")
        			{
        				// add marker
        				var loc = new google.maps.LatLng(las[i],lgs[i]);
        				var marker = new google.maps.Marker({
        					position: loc, 
        					map: window.map,
        					title: nms[i]
        				});
        				
        				markers[i] = marker;
        				
        				var contentString = [
        				  '<div id="tabs">',
        				  '<ul>',
        					'<li><a href="#tab-1"><span>photo</span></a></li>',
        					'<li><a href="#tab-2"><span>description</span></a></li>',
        					'<li><a href="#tab-3"><span>location</span></a></li>',
        				  '</ul>',
        				  '<div id="tab-1">',
        					'<p><h1>'+nms[i]+'</h1></p>',
        					'<p><img src="./photos/'+phs[i]+'"/></p>'+
        				  '</div>',
        				  '<div id="tab-2">',
        				   '<p><h1>'+nms[i]+'</h1></p>',
        				   '<p>Added by: '+usrn[i]+' from '+usrl[i]+'</p>'+
        				   '<p>'+dss[i]+'</p>'+
        				  '</div>',
        				  '<div id="tab-3">',
        					'<p><h1>'+nms[i]+'</h1></p>',
        					'<p>Address: '+ads[i]+'</p>'+
        					'<p>Location: '+loc+'</p>'+
        				  '</div>',
        				  '</div>'
        				].join('');
        				
        				var infowindow = new google.maps.InfoWindow;
        				
        				bindInfoWindow(marker, window.map, infowindow, contentString);
        			}
        		}
        	}
        	
        	// make conection between infowindow and marker (the infowindw shows up when the user goes with the mouse over the marker)
        	function bindInfoWindow(marker, map, infoWindow, contentString)
        	{
        		google.maps.event.addListener(marker, 'mouseover', function() {
        			
        			map.setCenter(marker.getPosition());
        			
        			infoWindow.setContent(contentString);
        			infoWindow.open(map, marker);
        			$("#tabs").tabs();
        		 });
        	}
        	
        	// highlighting a marker
        		// make the marker show on top of the others
        		// change the selected markers icon
        	function highlightMarker(index)
        	{
        		// change zindex and icon
        		for (i=0; i<markers.length; i++)
        		{
        			if (i == index)
        			{
        				markers[i].setZIndex(10);
        				markers[i].setIcon('http://www.google.com/mapfiles/arrow.png');
        			}
        			else
        			{
        				markers[i].setZIndex(2);
        				markers[i].setIcon('http://www.google.com/mapfiles/marker.png');
        			}
        		}
        	}

        	function prueba(index)
        	{

        			if (index == 2)
        			{
        				var mapa;
        	            var myLatlng = new google.maps.LatLng(46.850033, -87.6500523);
        	            var mapOptions = {
        	                  zoom: 10,
        	                  center: myLatlng,
        	                  mapTypeId: google.maps.MapTypeId.ROADMAP
        	            }
        	            mapa = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);    

        	            google.maps.event.addListener(mapa, 'click', function(event) {
        	                   // Crear marcador
                   
        	                   marcador = new google.maps.Marker({
        	                   position: event.latLng,
        	                   draggable: true, 
        	                   map: mapa
        	                });
        	                mapa.setCenter(event.latLng);



        	                findAddress(event.latLng);

        	            });
        			}
        			else
        			{
        				var mapa;

        	            var myLatlng = new google.maps.LatLng(41.850033, -87.6500523);
        	            var mapOptions = {
        	                  zoom: 10,
        	                  center: myLatlng,
        	                  mapTypeId: google.maps.MapTypeId.ROADMAP
        	            }
        	            mapa = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);    

        	            google.maps.event.addListener(mapa, 'click', function(event) {
        	                   // Crear marcador
                   
        	                   marcador = new google.maps.Marker({
        	                   position: event.latLng,
        	                   draggable: true, 
        	                   map: mapa
        	                });
        	                mapa.setCenter(event.latLng);


        	                findAddress(event.latLng);

        	            });
        			}

        	}


            
            </script>
    </head>
    <body onload="inicializar();  ">
        
    
    
        <h1>Sitios visitados por <?php echo $_COOKIE['username'] ?>:</h1>
        <form action="/coordenada" method="post" name="formulario">
            <div style="float:right">Latitud: <input type="text" name="latitud"/> 
            Longitud: <input type="text" name="longitud"/><br/><br/>
            <div id="map_canvas" style="width:500px;height:500px">&nbsp;</div>
            </div>Nombre: <input type="text" name="nombre"/><br/>
            <br/>
            <input type="submit" value="Guardar sitio visitado"/>
            <input type="reset" value="Limpiar"/>           
            
        </form>
        
        
          	   <?php 
		    $dat1=23; 
		    $dat2="nombre"; 
		    $x = 37.765142;
		    $y = -3.795776;
		    echo "opero con variables php y al tener resultados trato de ejecutar funcion javascript  asi:" ;
		    echo "<script type='text/javascript'>";
		    echo "placeMarkerCoord(".$x.",".$y.")"; 
		    echo "</script> ";
 		?>
 		
 		          	   <?php 
		    $dat1=23; 
		    $dat2="nombre"; 
		    $x = 37.765142;
		    $y = -3.795776;
		    echo "opero con variables php y al tener resultados trato de ejecutar funcion javascript  asi:" ;
		    echo "<script type='text/javascript'>";
		    echo "alerta()"; 
		    echo "</script> ";
 		?>
        
        <?php 
			/*$ch = curl_init("http://mapeate.appspot.com/jsp/coordenadas.jsp");
			$sew = curl_exec($ch);
			$hola = curl_close($ch);
			

        	echo $ch;
        	echo $sew;
        	echo $hola;*/
        
			
			// create curl resource
			//$ch = curl_init();
			/*$ch = curl_init("http://mapeate.appspot.com/jsp/coordenadas.jsp");
			// set url
			curl_setopt($ch, CURLOPT_URL, "http://mapeate.appspot.com/jsp/coordenadas.jsp");
			
			//return the transfer as a string
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			// $output contains the output string
			$output = curl_exec($ch);
			
			// close curl resource to free up system resources
			curl_close($ch);
			
			
			echo $output;*/
			
			echo $_COOKIE['coordenadas'];
			
			$output = $_COOKIE['coordenadas'];
			
			echo "Coord";
			echo $output, "<br>";
			
			$long = strlen($output)-1;
			
			echo "Longitud";
			echo $long, "<br>";
			
			$sub = substr($output, 1, $long-1);
			
			echo "cadena sin principio ni final";
			echo $sub, "<br>";
 
			
			$cad = split(",",$sub);
			for($i=0;$cad[$i];$i++){
				//$count = substr_count($cad[$i],"[");
				if ($count<=0){

				}
				else{

				}
				echo $cad[$i],"<br>";
			}
			
			$num = 3;
			
			$x = 37.765142;
			$y = -3.795776;
			
			echo '<script languaje="JavaScript">
		
		
		      var x="'.$x.'";
              var y="'.$y.'";
			
			
		      placeMarker(x,y);
                		
                		alerta();
			
			
			</script>';
			
			
			$variable_php="variable en php";
			echo '<script languaje="JavaScript">
			
			
		      var variable="'.$num.'";
					
					
		      prueba(variable);
                		
              
					
					
			</script>';

			
        ?>

    </body>
</html>
