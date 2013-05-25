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
    


    var recar = document.getElementById("recarga");
    recar.addEventListener("click",function(){	

    		//recupero las coordenadas almacenadas en la cookie
			var coo = Tools.readCookie("coordenadas");

			//es un array string de numeros
			//parseo para sacar las coordenadas numericas
			//y situarlas en el mapa
			var l = coo.length;
			//quito los corchetes [ ]
			var li = l-2;
			var lon = parseFloat(li);
			var porcion = coo.substring(2, lon);
			var palabras = porcion.split(",");

			for(var i = 0; i < palabras.length; i=i+2){

				var coorx = palabras[i];
				var coory = palabras[i+1];

				placeMarkerx(coorx,coory);
			   
			}
 	
    });
    
    
    google.maps.event.addListener(map, 'click', function(event) {
        //placeMarker(event.latLng);
    	
    	var myLatLng = event.latLng;
        var lat = myLatLng.lat();
        var lng = myLatLng.lng();
    	
        
        // Rellenar X e Y
		document.getElementById('latitud').value = loc.lat();
		document.getElementById('longitud').value = loc.lng();
		
		placeMarkerx(lat, lng);
        
      });


    
    function placeMarker(location) {
    	  var marker = new google.maps.Marker({
    	      position: location,
    	      map: map,
    	      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/red/blank.png'
    	  });
    	  
    	  marker.setTitle(valor);
    	  attachSecretMessage(marker);
    	  
    	  //Guardo el punto clicado
    	  puntos.push(marker);

    	  //map.setCenter(location);
    	  findAddress(location);
    }
    
    
  //funcion para posicionar coordenadas en el mapa
    function placeMarkerx(x,y) {

        var xx = parseFloat(x);
        var yy = parseFloat(y);
               
        var marcador = new google.maps.Marker({
        position: new google.maps.LatLng(xx, yy),
        draggable: true, 
        map: map,
        icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/blank.png'
        });
        
        marcador.setTitle(valor);
  	  	attachSecretMessage(marcador);
  	  
  	    //Guardo el punto clicado
  	    puntos.push(marker);

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
					alert("Fallo en el Geocoder debido a: " + status);
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




