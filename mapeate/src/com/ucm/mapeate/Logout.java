package com.ucm.mapeate;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Logout
 */
@SuppressWarnings("serial")
public class Logout extends HttpServlet {

        protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
                // Destruimos la session
                request.getSession().invalidate();
                
                // Redirigimos al servlet de login
                response.sendRedirect("index.html");         
        }


        protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
            // Destruimos la session
            request.getSession().invalidate();
            
            // Redirigimos al servlet de login
            response.sendRedirect("index.html");
        }

}
