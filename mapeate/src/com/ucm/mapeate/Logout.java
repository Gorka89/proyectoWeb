package com.ucm.mapeate;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Logout
 */
@SuppressWarnings("serial")
public class Logout extends HttpServlet {
	
		protected void doGet(HttpServletRequest request, HttpServletResponse response) 
	    		throws ServletException, IOException {
	       
	        try{	
	        	// Destruimos la session
	            request.getSession().invalidate();
	            
	            //destruyo la cookie de usuario seteando la validez a 0.
	            Cookie[] cookies = request.getCookies();
	            if (cookies != null)
	                for (int i = 0; i < cookies.length; i++) {
	                    if (cookies[i].getName().equalsIgnoreCase("username")){
		                    cookies[i].setPath("/");
		                    cookies[i].setMaxAge(0);
		                    response.addCookie(cookies[i]);
	                    }
	                    if (cookies[i].getName().equalsIgnoreCase("coordVisit")){
		                    cookies[i].setPath("/");
		                    cookies[i].setMaxAge(0);
		                    response.addCookie(cookies[i]);
	                    }
	                    if (cookies[i].getName().equalsIgnoreCase("coordPend")){
		                    cookies[i].setPath("/");
		                    cookies[i].setMaxAge(0);
		                    response.addCookie(cookies[i]);
	                    }
	                }
	            
	            // Redirigimos al servlet de login
	            response.sendRedirect("/mensajeAcierto/logoutOK.html");
	        }catch(Exception e){
	        	response.sendRedirect("/mensajesFallo/logoutFail.html");
	        }
	    
	    
		}

        protected void doPost(HttpServletRequest request, HttpServletResponse response) 
        		throws ServletException, IOException {
           
	        try{	
	        	// Destruimos la session
	            request.getSession().invalidate();
	            
	            //destruyo la cookie de usuario seteando la validez a 0.
	            Cookie[] cookies = request.getCookies();
	            if (cookies != null)
	                for (int i = 0; i < cookies.length; i++) {
	                    if (cookies[i].getName().equalsIgnoreCase("username")){
		                    cookies[i].setPath("/");
		                    cookies[i].setMaxAge(0);
		                    response.addCookie(cookies[i]);
	                    }
	                }
	            
	            // Redirigimos al servlet de login
	            response.sendRedirect("/mensajeAcierto/logoutOK.html");
	        }catch(Exception e){
	        	response.sendRedirect("/mensajesFallo/logoutFail.html");
	        }
        
        
        }

}
