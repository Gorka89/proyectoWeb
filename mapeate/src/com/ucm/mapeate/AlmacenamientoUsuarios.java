package com.ucm.mapeate;

import java.io.IOException;
import java.io.PrintWriter;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.logging.Logger;
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
        } finally {
            pm.close();
        }
        
        resp.setContentType("text/html");
        PrintWriter out = resp.getWriter();
        out.println("<html>");
        out.println("<head><title>Prueba de rastreo de usuario</title></head>");
        out.println("<body>");
        out.println("<h1>el usuario se ha registrado con exito</h1>");
        out.println("</body></html>");
        
        //resp.sendRedirect("login.html");
    }
    
    /**
     * Funcion encargada de encriptar la password
     * @param s
     * @return
     */
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
