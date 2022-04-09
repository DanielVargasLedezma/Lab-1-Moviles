/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package backend.models;

import backend.entities.Profesor;
import java.util.HashMap;
import java.util.Observable;
import java.util.Observer;

/**
 *
 * @author danil
 */
public class ProfesorModel extends Observable {
    
    Profesor current;
    HashMap<String,String> errores;
    String mensaje;
    int modo;  
    
    public int getModo(){
        return modo;
    }

    public void setModo(int modo){
        this.modo = modo;
    }
    
    public String getMensaje(){
        return mensaje;
    }

    public void setMensaje(String mensaje){
        this.mensaje = mensaje;
    }

    public HashMap<String, String> getErrores(){
        return errores;
    }

    public void setErrores(HashMap<String, String> errores){
        this.errores = errores;
    }
    
    public void clearErrors(){
        setErrores(new HashMap<>());
        setMensaje("");      
    }
    
    public Profesor getCurrent(){
        return current;
    }
    
    public void setCurrent(Profesor current){
        this.current = current;
        setChanged();
        notifyObservers();  
    } 
    
    @Override
    public void addObserver(Observer o){
        super.addObserver(o);
        setChanged();
        notifyObservers();
    } 
}
