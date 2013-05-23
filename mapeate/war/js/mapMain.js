window.onload = function(){
    var options = {
        zoom: 10
        , center: new google.maps.LatLng(40.447190, -3.727841)
        , mapTypeId: google.maps.MapTypeId.ROADMAP
    };
 
    var map = new google.maps.Map(document.getElementById('map_canvas'), options);
    var puntos = [];
    var valor = document.getElementById("texto").value;
    
    var b = document.getElementById("borrar");
    b.addEventListener("click",function(){	

    		puntos[puntos.length-1].setMap(null);
    		puntos.pop(puntos[puntos.length-1]);
 	
    });
    

    
    
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
        
        // Rellenar X e Y
		document.getElementById('latitud').value = loc.lat();
		document.getElementById('longitud').value = loc.lng();
		
        
      });
    



    
    function placeMarker(location) {
    	  var marker = new google.maps.Marker({
    	      position: location,
    	      map: map,
    	      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/'+document.getElementById("colores").options[document.getElementById("colores").selectedIndex].text+'/blank.png'
    	  });
    	  
    	  marker.setTitle(valor);
    	  attachSecretMessage(marker);
    	  
    	  //Guardo el punto clicado
    	  puntos.push(marker);

    	  //map.setCenter(location);
    	  findAddress(location);
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
    
    
    function attachSecretMessage(marker) {

    	  var infowindow = new google.maps.InfoWindow(
    	      { content: document.getElementById("texto").value,
    	        size: new google.maps.Size(50,50)
    	      });
    	  google.maps.event.addListener(marker, 'click', function() {
    	    infowindow.open(map,marker);
    	  });
    }
    
       
    
    
};
