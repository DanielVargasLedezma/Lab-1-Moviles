/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package backend.controllers;

import backend.entities.Profesor;
import backend.models.ProfesorModel;
import backend.services.GlobalException;
import backend.services.NoDataException;
import backend.services.ProfesorService;
import java.util.ArrayList;

/**
 *
 * @author danil
 */
public class ProfesorController {
    
    private final ProfesorModel model;

    public ProfesorController(ProfesorModel model) {
        
        this.model = model;
        this.model.setCurrent(new Profesor());
        this.model.clearErrors();
    }

    public void guardar(String cedula, String nombre, int telefono, String correoE) {

        Profesor nuevo_profesor = new Profesor();
        
        model.clearErrors();
        
        if (cedula.length() == 0) {
            model.getErrores().put("Cedula", "Cedula requerida");
            return;
        }
        
        nuevo_profesor.setCedula(cedula);

        if (nombre.length() == 0) {
            model.getErrores().put("Nombre", "Nombre requerido");
            return;
        }
        
        nuevo_profesor.setNombre(nombre);

        if (telefono == 0) {
            model.getErrores().put("Telefono", "Telefono requerido");
            return;
        }
        
        nuevo_profesor.setTelefono(telefono);
        
        if (correoE.length() == 0) {
            model.getErrores().put("Email", "Email requerido");
            return;
        }
        
        nuevo_profesor.setCorreoE(correoE);

        if (model.getErrores().isEmpty()) {

            try {
                
                ProfesorService.getInstancia().insertar_profesor(nuevo_profesor);
                model.setMensaje("Nueva profesor agregado");
                
            } catch (Exception e) {
                
                model.setCurrent(nuevo_profesor);
            }
        } else {
            
            model.setMensaje("Error!");
            model.setCurrent(nuevo_profesor);
        }
    }
    
    public void editar(String cedula, String nombre, int telefono, String correoE) {
                
        Profesor nuevo_profesor = null;
        
        model.clearErrors();

        if (cedula.length() == 0) {
            model.getErrores().put("Cedula", "Cedula requerida");
            return;
        }
        
        try {
            nuevo_profesor = ProfesorService.getInstancia().buscar_profesor(cedula);
        } catch (GlobalException | NoDataException ex) {
            
            model.setMensaje(ex.getMessage());
            return;
        }
        
        if(nuevo_profesor == null) {
            
            model.setMensaje("No se ha encontrado una instancia con la cedula " + cedula);
            return;
        }
        
        if (nombre.length() != 0) {
            nuevo_profesor.setNombre(nombre);
        }
        
        if (telefono != 0) {
            nuevo_profesor.setTelefono(telefono);
        }
        
        if (correoE.length() != 0) {
            nuevo_profesor.setCorreoE(correoE);
        }
        
        try {
            
            ProfesorService.getInstancia().modificar_profesor(nuevo_profesor);
            model.setMensaje("Nueva profesor agregado");
            
        } catch (GlobalException | NoDataException ex) {
            
            model.setMensaje(ex.getMessage());
        }
    }
    
    public Profesor verUno(String cedula) {
        
        Profesor nuevo_profesor = null;
        
        model.clearErrors();
        
        if (cedula.length() == 0) {
            model.getErrores().put("Cedula", "Cedula requerida");
            return nuevo_profesor;
        }
        
        try {
            nuevo_profesor = ProfesorService.getInstancia().buscar_profesor(cedula);
            
        } catch (GlobalException | NoDataException ex) {
            
            model.setMensaje(ex.getMessage());
        }
        
        if(nuevo_profesor == null) {
            
            model.setMensaje("No se ha encontrado una instancia con la cedula " + cedula);
            return nuevo_profesor;
        }
        
        return nuevo_profesor;
    }
    
    public ArrayList verMuchos() {
        
        ArrayList colecccion = null;
        
        model.clearErrors();

        try {
            colecccion = ProfesorService.getInstancia().listar_profesor();
            
        } catch (GlobalException | NoDataException ex) {
            
            model.setMensaje(ex.getMessage());
        }
        
        return colecccion;
    }
    
    public void eliminar(String cedula) {

        model.clearErrors();

        if (cedula.length() == 0) {
            model.getErrores().put("Cedula", "Cedula requerida");
            return;
        }
        
        try {
            ProfesorService.getInstancia().eliminar_profesor(cedula);
            
        } catch (GlobalException | NoDataException ex) {
            
            model.setMensaje(ex.getMessage());
        }
    }
}
