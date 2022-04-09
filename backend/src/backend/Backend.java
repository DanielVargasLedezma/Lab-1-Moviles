/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package backend;

import backend.controllers.ProfesorController;
import backend.models.ProfesorModel;
import java.util.Scanner;

/**
 *
 * @author danil
 */
public class Backend {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        ProfesorModel pm = new ProfesorModel();
        ProfesorController pf = new ProfesorController(pm);
        
        Scanner myObj = new Scanner(System.in);
        int opcion = 0;
        
        do {
            clearScreen();
            System.out.println("[1] - Insertar Profesor");
            System.out.println("[2] - Editar Profesor");
            System.out.println("[3] - Buscar Profesor");
            System.out.println("[4] - Listar Profesores");
            System.out.println("[5] - Eliminar Profesor");
            System.out.println("[6] - Salir");
            System.out.print("-> ");
            opcion = myObj.nextInt();
            
            switch(opcion) {
                case 1 -> {
                    if(!pm.getErrores().isEmpty() || pm.getMensaje().length() != 0) {
                        System.out.println("a");
                    } else {
                        pf.guardar("118160545", "Daniel Jesús Vargas Ledezma", 60729328, "danilevl229@gmail.com");
                    }
                }
                case 2 -> {
                }
                case 3 -> {
                    
                }
                case 4 -> {
                }
                case 5 -> {
                }
                case 6 -> System.out.println("Adios Mundo");
            }
        } while(opcion != 6);
    }
    
    public static void clearScreen() {  
        System.out.print("\033[H\033[2J");  
        System.out.flush();  
    }  
}
//////