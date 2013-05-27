package com.ucm.mapeate;

import java.io.IOException;
import java.util.List;
import javax.jdo.PersistenceManager;
import javax.jdo.Query;
import javax.servlet.http.*;
import com.ucm.mapeate.Usuarios;
import com.ucm.mapeate.PMF;


@SuppressWarnings("serial")
public class CoordPend extends HttpServlet {

    public void doPost(HttpServletRequest req, HttpServletResponse resp)
                throws IOException {
    	
        //UserService userService = UserServiceFactory.getUserService();
        //User user = userService.getCurrentUser();
    	
    	//este try se usa por posibles problemas del server de google
    	try{
    		
	        String texto = req.getParameter("texto");
	        String latitud = req.getParameter("latitud");
	        String longitud = req.getParameter("longitud");
	                 
	        PersistenceManager pm = PMF.get().getPersistenceManager();
	        
	        String usuario = "";
	        int i = 0;
	        Cookie[] cookies = req.getCookies();
	        //se recorren las cookies en busca del nombre de usuario para buscar en la tabla
	        for (i=0;i<cookies.length;i++){
	        	
	        	if (cookies[i].getName().equalsIgnoreCase("username")){
	        		usuario = cookies[i].getValue();
	        	}
	        }
	        
	        Query query = pm.newQuery(Usuarios.class,
	                "name == '"+usuario+"'");
	        
	        try {
	            List<Usuarios> results = (List<Usuarios>) query.execute();
	            if (!results.isEmpty()) {
	                for (Usuarios u : results) {
	                
	                float x = Float.parseFloat(latitud);
	                float y = Float.parseFloat(longitud);
	                
	                u.addPendX(x);
	                u.addPendY(y);
	                u.setTexto(texto);
	                //codigo html para ver que todo ha ido bien
	                /*
	        		resp.setContentType("text/html");
	        		PrintWriter pw = resp.getWriter();
	        		pw.println("<HTML><HEAD><TITLE>Coordenadas almacenadas correctamente</TITLE></HEAD>");
	        		pw.println("<BODY>");
	        		pw.println("<H2>Leyendo parámetros desde un formulario html</H2>");          
	        		
	        		pw.println("<H3>X: "+x+"</H3>");
	        		pw.println("<H3>Y: "+y+"</H3>");
	        		pw.println("<H3>TEXTO: "+texto+"</H3>");
	        		pw.println("</BODY></HTML>");
	        		
	                
	                pw.close();*/
	                
				      //creo cookie con las coordenadas recuperadas
			        Cookie coordenadas = new Cookie("coordPend", u.getCoordPend().toString());
			        coordenadas.setValue(u.getCoordPend().toString());
			        coordenadas.setComment("coordenadas pendientes del usuario");
			        coordenadas.setPath("/");
	            	resp.addCookie(coordenadas);
	                
	                resp.sendRedirect("/php/quieroIr.php");
	                	
	            }
		        } else {
		            //no persistent object found
		        	resp.sendRedirect("/mensajesFallo/coordInvalid.html");
		        }
	            
	        }catch(Exception e){
	        	resp.sendRedirect("/mensajesFallo/coordInvalid.html");
	        }finally{
		        query.closeAll();	
		        pm.close();
	        }
	        
    	}catch(Exception e){
    		resp.sendRedirect("/mensajesFallo/falloBaseDatos.html");
    	}

    }
    
            
      
}
