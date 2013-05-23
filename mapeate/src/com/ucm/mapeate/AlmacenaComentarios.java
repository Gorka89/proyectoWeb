package com.ucm.mapeate;

import java.io.IOException;
import java.util.Date;

import javax.jdo.PersistenceManager;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.google.appengine.api.users.User;
import com.google.appengine.api.users.UserService;
import com.google.appengine.api.users.UserServiceFactory;

@SuppressWarnings("serial")
public class AlmacenaComentarios extends HttpServlet{
	
	
	public void doPost(HttpServletRequest req, HttpServletResponse resp)
            throws IOException {
		
	    UserService userService = UserServiceFactory.getUserService();
	    User user = userService.getCurrentUser();
	
	    //String nombre = req.getParameter("nombre");
	    String comentario = req.getParameter("comentario");
	    	    
	    Comments c = new Comments(user,comentario);
	
	    PersistenceManager pm = PMF.get().getPersistenceManager();
	    try {
	        pm.makePersistent(c);
	    } finally {
	        pm.close();
	    }
	
	    resp.sendRedirect("jsp/comentarios.jsp");
	}
	
	

}
