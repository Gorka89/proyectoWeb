<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="javax.jdo.PersistenceManager" %>
<%@ page import="javax.jdo.Query" %>
<%@ page import="java.util.Collection" %>
<%@ page import="java.util.Iterator" %>
<%@ page import="java.io.PrintWriter" %>
<%@ page import="com.google.appengine.api.users.User" %>
<%@ page import="com.google.appengine.api.users.UserService" %>
<%@ page import="com.google.appengine.api.users.UserServiceFactory" %>
<%@ page import="com.ucm.mapeate.Usuarios" %>
<%@ page import="com.ucm.mapeate.PMF" %>

<html>
  <body>

<%     
//jsp encargado de almacenar y crear la cookie de las coordenadas
//para recuperarlas cuando el usuario desee
//es la misma funcionalidad que los servlets encargados de la gestion de
//coordenadas, por lo que se ha decidido no usar este jsp en la
//version final, pero es igual de valido

	try{

		UserService userService = UserServiceFactory.getUserService();
		User user = userService.getCurrentUser();  
		
		PersistenceManager pm = PMF.get().getPersistenceManager();
		
		String usuario = "";
		int i = 0;
		Cookie[] cookies = request.getCookies();
		
		//Si no hay cookies se redirecciona al index
		if ((cookies == null) || (cookies.length == 0)) {
			response.sendRedirect("/index.html");
		}
		else{
		
		
		//se recorren las cookies en busca del nombre de usuario para buscar en la tabla
			for (i=0;i<cookies.length;i++){
				
				if (cookies[i].getName().equalsIgnoreCase("username")){
					usuario = cookies[i].getValue();
				}
			}
		
			if (usuario != ""){
				
		        Query query = pm.newQuery(Usuarios.class,
		                "name == '"+usuario+"'");
		        
		        try{
		        	
			        String texto = request.getParameter("texto");
			        String latitud = request.getParameter("latitud");
			        String longitud = request.getParameter("longitud");
		        
			        List<Usuarios> results = (List<Usuarios>) query.execute();
		            if (!results.isEmpty()) {
		                for (Usuarios u : results) {
		                	
			                float x = Float.parseFloat(latitud);
			                float y = Float.parseFloat(longitud);
		                	
			                u.addVisitX(x);
			                u.addVisitY(y);
			                u.setTexto(texto);
					        
					        %>
					        	<p><%= u.getCoordVisit().toString() %></p>
					        <%
					        
					      //creo cookie con las coordenadas recuperadas
					        Cookie coordenadas = new Cookie("coordVisit", u.getCoordVisit().toString());
					        coordenadas.setValue(u.getCoordVisit().toString());
					        coordenadas.setComment("coordenadas del usuario");
					        coordenadas.setPath("/");
			            	response.addCookie(coordenadas);
					    }   		
					    
					}
		            
		            //response.sendRedirect("/php/visit.php");
		            
		        }catch(Exception e){
		        	response.sendRedirect("/index.html");
		        }finally{
		    		query.closeAll();		    		
		    		pm.close();
		        }
				
				
			}
			else{
				response.sendRedirect("/mensajesFallo/coordInvalid.html"); 
			}
		
		}//not cookies			

		
	}catch(Exception e){
		response.sendRedirect("/mensajesFallo/falloBaseDatos.html");
	}



%>


  </body>
</html>