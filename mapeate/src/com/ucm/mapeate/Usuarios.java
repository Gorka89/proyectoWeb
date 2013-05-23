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
    
	@Persistent
    private Vector<Float> coordenadas;
	
	@Persistent
	private String texto;
    

    public Usuarios(User user, String name, String psw, String email) {
    	this.setUser(user);
        this.setName(name);
        this.setPsw(psw);
        this.setEmail(email);
        setCoordenadas(new Vector<Float>());
        setTexto("");
    }
    

    public Usuarios(String name, String psw, String email) {
        this.setName(name);
        this.setPsw(psw);
        this.setEmail(email);
        setCoordenadas(new Vector<Float>());
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


	public Vector<Float> getCoordenadas() {
		return coordenadas;
	}


	public void setCoordenadas(Vector<Float> coordenadas) {
		this.coordenadas = coordenadas;
	}

	/**
	 * Coordenada par
	 * @param x
	 */
	public void addX(float x) {
		coordenadas.add(x);		
	}

	/**
	 * posicion impar del vector
	 * @param y
	 */
	public void addY(float y) {
		coordenadas.add(y);
		
	}


	public String getTexto() {
		return texto;
	}


	public void setTexto(String texto) {
		this.texto = texto;
	}




}
