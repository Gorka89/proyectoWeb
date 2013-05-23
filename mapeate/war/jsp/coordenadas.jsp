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

<%     UserService userService = UserServiceFactory.getUserService();
User user = userService.getCurrentUser();  

PersistenceManager pm = PMF.get().getPersistenceManager();

Query query = pm.newQuery(Usuarios.class);
query.setFilter("(name == myParam)");
query.declareParameters("String myParam");

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
		Collection col = (Collection) query.execute(usuario);
		Iterator it = col.iterator();
		
		if (it.hasNext()) {
		
		    //there is a result
		    while(it.hasNext()) {
		        Usuarios u = (Usuarios) it.next();
		        
		        %>
		        	<p><%= u.getCoordenadas().toString() %></p>
		        <%
		        
		      //creo cookie con las coordenadas recuperadas
		        Cookie coordenadas = new Cookie("coordenadas", u.getCoordenadas().toString());
		        coordenadas.setValue(u.getCoordenadas().toString());
		        coordenadas.setComment("coordenadas del usuario");
		        coordenadas.setPath("/");
            	response.addCookie(coordenadas);
		    }   		
		    
		}
		
		
		
	}
	else{
		response.sendRedirect("/index.html"); 
	}

}//not cookies
	
query.closeAll();

pm.close(); 



%>


  </body>
</html>