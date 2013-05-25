package com.ucm.mapeate;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Collection;
import java.util.Iterator;
import java.util.List;

import javax.jdo.PersistenceManager;
import javax.jdo.Query;

import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.AddressException;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.google.appengine.api.users.User;
import com.google.appengine.api.users.UserService;
import com.google.appengine.api.users.UserServiceFactory;

import com.ucm.mapeate.Usuarios;
import com.ucm.mapeate.PMF;


@SuppressWarnings("serial")
public class SendEmail extends HttpServlet {

    public void doPost(HttpServletRequest req, HttpServletResponse resp)
                throws IOException {
        UserService userService = UserServiceFactory.getUserService();
        User user = userService.getCurrentUser();

        String email = req.getParameter("email");       
        
        PersistenceManager pm = PMF.get().getPersistenceManager();
        
        Query query = pm.newQuery(Usuarios.class,
                "email == '"+email+"'");
        
        try {
            List<Usuarios> results = (List<Usuarios>) query.execute();
            if (!results.isEmpty()) {
                for (Usuarios u : results) {
                
		                String nombre = u.getName();
		                
		                String mail = u.getEmail();
		                
		                if (mail.equalsIgnoreCase(email)){
		
		                	//generamos clave aleatoria
		                	int clave = (int) Math.floor(Math.random()*(0-9999+1)+9999);  // Valor entre 0 y 9999, ambos incluidos.
		                	String cadena= String.valueOf(clave);
		                	
		                	String md5 = md5(cadena);
		                	
		                	u.setPsw(md5);
		                	
		                	envia(email,nombre,cadena);
		                	resp.sendRedirect("/mensajeAcierto/mensajeEnviado.html");
		                }
		                else{
		                	resp.sendRedirect("/mensajesFallo/emailInvalido.html");
		                }
                }
	        } else {
	            //no persistent object found
	        	resp.sendRedirect("/mensajesFallo/emailInvalido.html");
	        }
        }catch (Exception e){
        	e.printStackTrace();
        	resp.sendRedirect("/mensajesFallo/falloBaseDatos.html");
        }finally{
        	query.closeAll();
        	pm.close();
        }
        
    }
    
    //envia el mail con la clave aleatoria generada
    public void envia(String email,String usuario, String clave) throws UnsupportedEncodingException{
    	
    	
    	Properties props = new Properties();
        Session session = Session.getDefaultInstance(props, null);

        String msgBody = usuario+" ,prueba a entrar con la clave generada de nuevo: "+clave;

        try {
            Message msg = new MimeMessage(session);
            msg.setFrom(new InternetAddress(email, "Mapping Admin"));
            msg.addRecipient(Message.RecipientType.TO,
                             new InternetAddress(email, "Usuario"));
            msg.setSubject("Mapping, nueva clave generada.");
            msg.setText(msgBody);
            Transport.send(msg);

        } catch (AddressException e) {
        	//e.printStackTrace();
        } catch (MessagingException e) {
        	//e.printStackTrace();
        }
    	
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
