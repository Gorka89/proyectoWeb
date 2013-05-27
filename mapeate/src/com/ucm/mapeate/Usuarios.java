package com.ucm.mapeate;
import java.util.Vector;

import com.google.appengine.api.datastore.Key;
import com.google.appengine.api.users.User;

import javax.jdo.annotations.IdGeneratorStrategy;
import javax.jdo.annotations.PersistenceCapable;
import javax.jdo.annotations.Persistent;
import javax.jdo.annotations.PrimaryKey;

@PersistenceCapable
public class Usuarios{
    @PrimaryKey
    @Persistent(valueStrategy = IdGeneratorStrategy.IDENTITY)
    private Key key;

    @Persistent
    private User user;
    
    @Persistent
    private String name;

    @Persistent
    private String psw;
    
    @Persistent
    private String email;
    
    //almacena coordenadas de sitios visitados
	@Persistent
    private Vector<Float> coordVisit;
	
	//almacena coordenadas de sitios pendientes de visitar
	@Persistent
    private Vector<Float> coordPend;
	
	@Persistent
	private String texto;
    
	/**
	 * Constructor Usuario
	 * @param user
	 * @param name
	 * @param psw
	 * @param email
	 */
    public Usuarios(User user, String name, String psw, String email) {
    	this.setUser(user);
        this.setName(name);
        this.setPsw(psw);
        this.setEmail(email);
        setCoordVisit(new Vector<Float>());
        setCoordPend(new Vector<Float>());
        setTexto("");
    }
    
    /**
     * 
     * @param name
     * @param psw
     * @param email
     */
    public Usuarios(String name, String psw, String email) {
        this.setName(name);
        this.setPsw(psw);
        this.setEmail(email);
        setCoordVisit(new Vector<Float>());
        setCoordPend(new Vector<Float>());
        setTexto("");
	}


	public Key getKey() {
        return key;
    }


	public String getPsw() {
		return psw;
	}

	public void setPsw(String psw) {
		this.psw = psw;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public User getUser() {
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	/**
	 * Para conseguir el mensaje de la etiqueta del mapa
	 * @return
	 */
	public String getTexto() {
		return texto;
	}

	/**
	 * Poner el mensaje de la etiqueta
	 * @param texto
	 */
	public void setTexto(String texto) {
		this.texto = texto;
	}

	public Vector<Float> getCoordVisit() {
		return coordVisit;
	}

	public void setCoordVisit(Vector<Float> coordVisit) {
		this.coordVisit = coordVisit;
	}

	public Vector<Float> getCoordPend() {
		return coordPend;
	}

	public void setCoordPend(Vector<Float> coordPend) {
		this.coordPend = coordPend;
	}

	/**
	 * Coordenada par
	 * @param x
	 */
	public void addVisitX(float x) {
		getCoordVisit().add(x);		
	}

	/**
	 * posicion impar del vector
	 * @param y
	 */
	public void addVisitY(float y) {
		getCoordVisit().add(y);
		
	}
	
	/**
	 * Coordenada par
	 * @param x
	 */
	public void addPendX(float x) {
		getCoordPend().add(x);		
	}

	/**
	 * posicion impar del vector
	 * @param y
	 */
	public void addPendY(float y) {
		getCoordPend().add(y);
		
	}


}
