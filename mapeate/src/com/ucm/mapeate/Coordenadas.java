package com.ucm.mapeate;

import java.io.IOException;
import java.io.PrintWriter;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Collection;
import java.util.Iterator;
import java.util.logging.Logger;
import javax.jdo.PersistenceManager;
import javax.jdo.Query;
import javax.servlet.ServletException;
import javax.servlet.ServletOutputStream;
import javax.servlet.http.*;
import com.google.appengine.api.users.User;
import com.google.appengine.api.users.UserService;
import com.google.appengine.api.users.UserServiceFactory;


import com.ucm.mapeate.Usuarios;
import com.ucm.mapeate.PMF;


@SuppressWarnings("serial")
public class Coordenadas extends HttpServlet {

    public void doPost(HttpServletRequest req, HttpServletResponse resp)
                throws IOException {
    	
        UserService userService = UserServiceFactory.getUserService();
        User user = userService.getCurrentUser();

        String texto = req.getParameter("texto");
        String latitud = req.getParameter("latitud");
        String longitud = req.getParameter("longitud");
                 
        PersistenceManager pm = PMF.get().getPersistenceManager();
        
        Query query = pm.newQuery(Usuarios.class);
        query.setFilter("(name == myParam)");
        query.declareParameters("String myParam");
        
        String usuario = "";
        int i = 0;
        Cookie[] cookies = req.getCookies();
        //se recorren las cookies en busca del nombre de usuario para buscar en la tabla
        for (i=0;i<cookies.length;i++){
        	
        	if (cookies[i].getName().equalsIgnoreCase("username")){
        		usuario = cookies[i].getValue();
        	}
        }
        
        Collection col = (Collection) query.execute(usuario);
        Iterator it = col.iterator();
        if (it.hasNext()) {
            //there is a result
            while(it.hasNext()) {
                Usuarios u = (Usuarios) it.next();
                
                float x = Float.parseFloat(latitud);
                float y = Float.parseFloat(longitud);
                
                u.addX(x);
                u.addY(y);
                u.setTexto(texto);
          
                //resp.sendRedirect("/mensajesFallo/mensajeEnviado.html");
                
        		resp.setContentType("text/html");
        		PrintWriter pw = resp.getWriter();
        		pw.println("<HTML><HEAD><TITLE>Coordenadas almacenadas correctamente</TITLE></HEAD>");
        		pw.println("<BODY>");
        		pw.println("<H2>Leyendo parámetros desde un formulario html</H2>");          
        		
        		pw.println("<H3>X: "+x+"</H3>");
        		pw.println("<H3>Y: "+y+"</H3>");
        		pw.println("<H3>TEXTO: "+texto+"</H3>");
        		pw.println("</BODY></HTML>");
        		
                
                pw.close();
                	
            }
        } else {
            //no persistent object found
        	resp.sendRedirect("/mensajesFallo/usuarioInvalido.html");
        }
        query.closeAll();

        pm.close();

    }
    
            
      
}
