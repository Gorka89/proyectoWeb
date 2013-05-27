package com.ucm.mapeate;

import java.io.IOException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.List;

import javax.jdo.PersistenceManager;
import javax.jdo.Query;

import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


import com.google.appengine.api.users.User;
import com.google.appengine.api.users.UserService;
import com.google.appengine.api.users.UserServiceFactory;

import com.ucm.mapeate.Usuarios;
import com.ucm.mapeate.PMF;


@SuppressWarnings("serial")
public class AccesoUsuario extends HttpServlet {

    public void doPost(HttpServletRequest req, HttpServletResponse resp)
                throws IOException {
    	//este try se usa por posibles problemas del server de google
    	try{
    		
	        //UserService userService = UserServiceFactory.getUserService();
	        //User user = userService.getCurrentUser();
	        
	        String nombre = req.getParameter("usernameLogin");
	        String psw = req.getParameter("passwordLogin");
	        
	        PersistenceManager pm = PMF.get().getPersistenceManager();
	        
	        Query query = pm.newQuery(Usuarios.class,
	                "name == '"+nombre+"'");
	        
	        try {
	            List<Usuarios> results = (List<Usuarios>) query.execute();
	            if (!results.isEmpty()) {
	                for (Usuarios u : results) {
	                    
	                	String name = u.getName();
	                    
	                    String ps = u.getPsw();
	                    //se compara con el md5 de la pass almacenada en la BD
	                    String md5 = md5(psw);                
	                    
	                    if (ps.equalsIgnoreCase(md5)){
	                    	
	                    	//creo la cookie con el usuario
	                    	Cookie cookie = new Cookie("username",name);
	                    	cookie.setValue(name);
	                    	cookie.setComment("cookies username");
	                    	resp.addCookie(cookie);
	                    	
	                    	//recupero coordenadas si las hubiera
	                    	Cookie coordenadas = new Cookie("coordVisit", u.getCoordVisit().toString());
					        coordenadas.setValue(u.getCoordVisit().toString());
					        coordenadas.setComment("coordenadas visitados del usuario");
					        coordenadas.setPath("/");
			            	resp.addCookie(coordenadas);
			            	
	                    	Cookie coordenadasP = new Cookie("coordPend", u.getCoordPend().toString());
					        coordenadasP.setValue(u.getCoordPend().toString());
					        coordenadasP.setComment("coordenadas pendientes visita del usuario");
					        coordenadasP.setPath("/");
			            	resp.addCookie(coordenadasP);
	                    	
	                    	resp.sendRedirect("/php/visit.php");
	                    
	                    }
	                    else{
	                    	resp.sendRedirect("/mensajesFallo/invalidPass.html");                
	                    }
	                	
	                }
	            } else {
	            	resp.sendRedirect("/mensajesFallo/usuarioInvalido.html");
	            }
	        }catch (Exception e){
	        	e.printStackTrace();
	        	resp.sendRedirect("/mensajesFallo/usuarioInvalido.html");
	        	//resp.sendRedirect("/mensajesFallo/falloBaseDatos.html");
	        } finally {
	            query.closeAll();
	            pm.close();
	        }
	        
    	}catch (Exception e) {
    		e.printStackTrace();
	    	resp.sendRedirect("/mensajesFallo/falloBaseDatos.html");
		}

    }
    
    
    private static String md5(String s) throws IOException { 
    	
    try {        
        // Create MD5 Hash
        MessageDigest digest = java.security.MessageDigest.getInstance("MD5");
        digest.update(s.getBytes());
        byte messageDigest[] = digest.digest();
 
         // Create Hex String
         StringBuffer hexString = new StringBuffer();
         for (int i=0; i<messageDigest.length; i++)
             hexString.append(Integer.toHexString(0xFF & messageDigest[i]));
        return hexString.toString();
 
     } catch (NoSuchAlgorithmException e) {

     }
     return "";
 
    }
    
    
}
