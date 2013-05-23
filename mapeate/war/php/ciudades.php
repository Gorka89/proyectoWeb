<script type="text/javascript" >
	$.getJSON("../json/ciudades.json",function(data){
		for(ciudad in data.ciudades){
			$("#idciudad".append("<option>"+ data.ciudades[ciudad].nombre + "</option>"));
		}
	});
</script> 
