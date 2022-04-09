/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package backend.entities;

/**
 *
 * @author danil
 */
public class Profesor {
    private String cedula;
    private String nombre;
    private int telefono;
    private String correoE;

    public Profesor() {
        this.cedula = "";
        this.nombre = "";
        this.telefono = 0;
        this.correoE = "";
    }
    
    public Profesor(String cedula, String nombre, int telefono, String correoE) {
        this.cedula = cedula;
        this.nombre = nombre;
        this.telefono = telefono;
        this.correoE = correoE;
    }

    public String getCedula() {
        return cedula;
    }

    public void setCedula(String cedula) {
        this.cedula = cedula;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public int getTelefono() {
        return telefono;
    }

    public void setTelefono(int telefono) {
        this.telefono = telefono;
    }

    public String getCorreoE() {
        return correoE;
    }

    public void setCorreoE(String correoE) {
        this.correoE = correoE;
    }

    @Override
    public String toString() {
        return "Profesor{" + "cedula=" + cedula + ", nombre=" + nombre + ", telefono=" + telefono + ", correoE=" + correoE + '}';
    }
}
