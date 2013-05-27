package com.ucm.mapeate;

import java.io.IOException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import javax.jdo.PersistenceManager;
import javax.servlet.http.*;

import com.google.appengine.api.users.User;
import com.google.appengine.api.users.UserService;
import com.google.appengine.api.users.UserServiceFactory;


import com.ucm.mapeate.Usuarios;
import com.ucm.mapeate.PMF;


@SuppressWarnings("serial")
public class AlmacenamientoUsuarios extends HttpServlet {

    public void doPost(HttpServletRequest req, HttpServletResponse resp)
                throws IOException {
    	//este try se usa por posibles problemas del server de google
    	try{
    	
	        UserService userService = UserServiceFactory.getUserService();
	        User user = userService.getCurrentUser();
	
	        String nombre = req.getParameter("username");
	        String psw = req.getParameter("password");
	        String email = req.getParameter("email");
	        
	        String md5 = md5(psw);
	        
	        Usuarios usuario = new Usuarios(user,nombre,md5,email);
	                 
	
	        PersistenceManager pm = PMF.get().getPersistenceManager();
	        try {
	            pm.makePersistent(usuario);
	        }catch(Exception e){
	        	resp.sendRedirect("/mensajesFallo/usuarioInvalido.html");
	        	//resp.sendRedirect("/mensajesFallo/falloBaseDatos.html");
	        } finally {
	            pm.close();
	        }
	        
	        //Si llega aqui todo ha ido bien, se crea la cookie
	        //y se redirige a un html que indica el registro exitoso
	        //y este a su vez redirige al main privado
	        
	        //creo la cookie con el usuario
	    	Cookie cookie = new Cookie("username",nombre);
	    	cookie.setValue(nombre);
	    	cookie.setComment("cookies username");
	    	resp.addCookie(cookie);
	        
	        resp.sendRedirect("/mensajeAcierto/registroOK.html");
	        
        }catch(Exception e){
        	e.printStackTrace();
        	resp.sendRedirect("/mensajesFallo/falloBaseDatos.html");
        }
    	
    }
    
    /**
     * Funcion encargada de encriptar la password
     * @param s
     * @return
     * @throws IOException 
     */
    private static String md5(String s) { 
    
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
