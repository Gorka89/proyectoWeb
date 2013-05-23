function inicializar(){
            var mapa;
            var marcador;
            var myLatlng = new google.maps.LatLng(37.192869,-3.613186);
            var mapOptions = {
                  zoom: 10,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            mapa = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);    

            google.maps.event.addListener(mapa, 'click', function(event) {
                   // Crear marcador
            		placeMarker(event.latLng);
                   /*if (marcador) marcador.setMap(null);                   
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

                findAddress(event.latLng);*/

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
        	
        	function placeMarker(location) {
          	  var mark = new google.maps.Marker({
          	      position: location,
          	      map: mapa,
          	      draggable: true,
          	      title:valor,
          	      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/'+document.getElementById("colores").options[document.getElementById("colores").selectedIndex].text+'/blank.png'
          	  });
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
        				var valor = document.getElementById("texto").value;
        				var loc = new google.maps.LatLng(las[i],lgs[i]);
        				var marker = new google.maps.Marker({
        					position: loc, 
        					map: window.map,
        					title:valor,
        					icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/'+document.getElementById("colores").options[document.getElementById("colores").selectedIndex].text+'/blank.png'
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