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
    
    
    
    

    
    
    google.maps.event.addListener(map, 'click', function(event) {
        //placeMarker(event.latLng);
    	
    	var myLatLng = event.latLng;
        var lat = myLatLng.lat();
        var lng = myLatLng.lng();
    	
        
        // Rellenar X e Y
		//document.getElementById('latitud').value = loc.lat();
		//document.getElementById('longitud').value = loc.lng();
		
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
    	
    	alert("estamos en placeMarkerx");

        var xx = parseFloat(x);
        var yy = parseFloat(y);
               
        var marcador = new google.maps.Marker({
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




