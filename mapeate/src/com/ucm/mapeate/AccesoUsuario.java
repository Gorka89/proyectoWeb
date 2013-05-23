package com.ucm.mapeate;

import java.io.IOException;
import java.io.PrintWriter;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Collection;
import java.util.Iterator;
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
        UserService userService = UserServiceFactory.getUserService();
        User user = userService.getCurrentUser();
        //RequestDispatcher dispatcher;
        
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
                    	cookie.setComment("probando uso cookies en servlet");
                    	resp.addCookie(cookie);
                    	
                    	resp.sendRedirect("/php/visit.php");
                    
                    }
                    else{
                    	resp.sendRedirect("/mensajesFallo/invalidPass.html");                
                    }
                	
                }
            } else {
            	resp.sendRedirect("/mensajesFallo/invalidPass.html");
            }
        }catch (Exception e){
        	
        } finally {
            query.closeAll();
            pm.close();
        }
        
       /* Query query = pm.newQuery(Usuarios.class);
        query.setFilter("(name == myParam)");
        query.declareParameters("String myParam");
        Collection col = (Collection) query.execute(nombre);
        Iterator it = col.iterator();
        if (it.hasNext()) {
            //there is a result
            while(it.hasNext()) {
                Usuarios u = (Usuarios) it.next();
                
                String name = u.getName();
                
                String ps = u.getPsw();
                //se compara con el md5 de la pass almacenada en la BD
                String md5 = md5(psw);                
                
                if (ps.equalsIgnoreCase(md5)){
                	
                	//creo la cookie con el usuario
                	Cookie cookie = new Cookie("username",name);
                	cookie.setValue(name);
                	cookie.setComment("probando uso cookies en servlet");
                	resp.addCookie(cookie);
                	
                	resp.sendRedirect("/mensajesFallo/invalidPass.html");
                
                }
                else{
                	resp.sendRedirect("/mensajesFallo/invalidPass.html");                
                }
            }
        } else {
        	resp.sendRedirect("/php/visit.php");
        }
        query.closeAll();

        pm.close();*/

    }
    
    
    private static String md5(String s) { try {
        
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
         e.printStackTrace();
     }
     return "";
 
    }
    
    
}
