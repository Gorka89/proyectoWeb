<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="javax.jdo.PersistenceManager" %>
<%@ page import="com.google.appengine.api.users.User" %>
<%@ page import="com.google.appengine.api.users.UserService" %>
<%@ page import="com.google.appengine.api.users.UserServiceFactory" %>
<%@ page import="com.ucm.mapeate.Usuarios" %>
<%@ page import="com.ucm.mapeate.PMF" %>

<html>
  <body>

<%
    UserService userService = UserServiceFactory.getUserService();
    User user = userService.getCurrentUser();
    if (user != null) {
%>
<p>Hello, <%= user.getNickname() %>! (You can
<a href="<%= userService.createLogoutURL(request.getRequestURI()) %>">sign out</a>.)</p>
<%
    } else {
%>
<p>Hello!
<a href="<%= userService.createLoginURL(request.getRequestURI()) %>">Sign in</a>
to include your name with greetings you post.</p>
<%
    }
%>

<%
    PersistenceManager pm = PMF.get().getPersistenceManager();
    String query = "select from " + Usuarios.class.getName();

    List<Usuarios> usuarios = (List<Usuarios>) pm.newQuery(query).execute();
    if (usuarios.isEmpty()) {
%>
<p>No hay usuarios.</p>
<%
    } else {
        for (Usuarios u : usuarios) {
            if (u.getName() == null) {
%>
<p>Usuario sin nombre:</p>
<%
            } else {
%>
<p> password de usuariooo:</p>
<%
            }
%>
<blockquote><%= u.getPsw() %></blockquote>
<%
        }
    }
    pm.close();
%>

    <form action="/sign" method="post">
      <div><textarea name="content" rows="3" cols="60"></textarea></div>
      <div><input type="submit" value="Nuevo usuario" /></div>
    </form>

  </body>
</html>