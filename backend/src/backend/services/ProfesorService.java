/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package backend.services;

import backend.entities.Profesor;
import java.sql.CallableStatement;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;
import oracle.jdbc.internal.OracleTypes;

/**
 *
 * @author danil
 */
public class ProfesorService extends Servicio{
    
    private static ProfesorService instancia = null;
    
    public static ProfesorService getInstancia() {
        
        if(instancia == null) {
            instancia = new ProfesorService();
        }
        
        return instancia;
    }
    
    private ProfesorService() {
    }
    
    private static final String INSERTAR_PROFESOR = "{call insertarProfesor(?,?,?,?)}";
    private static final String MODIFICAR_PROFESOR = "{call modificarProfesor(?,?,?,?)}";
    private static final String BUSCAR_PROFESOR = "{?=call buscarProfesor(?)}";
    private static final String LISTAR_PROFESOR = "{?=call listarProfesores()}";
    private static final String ELIMINAR_PROFESOR = "{call eliminarProfesor(?)}";
    
    /*Insertar profesores*/
    public void insertar_profesor(Profesor elProfesor) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {
            pstmt = conexion.prepareCall(INSERTAR_PROFESOR);
            
            pstmt.setString(1, elProfesor.getCedula());
            pstmt.setString(2, elProfesor.getNombre());
            pstmt.setInt(3, elProfesor.getTelefono());
            pstmt.setString(4, elProfesor.getCorreoE());
            
            boolean resultado = pstmt.execute();
            
            if (resultado == true) {
                throw new NoDataException("No se realizo la insercion");
            }

        } catch (SQLException e) {
            e.printStackTrace();
            throw new GlobalException("Llave duplicada");
            
        } finally {
            try {
                if (pstmt != null) {
                    pstmt.close();
                }
                
                desconectar();
                
            } catch (SQLException e) {
                
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
    }

    /*Modificar profesores*/
    public void modificar_profesor(Profesor elProfesor) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        PreparedStatement pstmt = null;
        try {
            pstmt = conexion.prepareStatement(MODIFICAR_PROFESOR);
            pstmt.setString(1, elProfesor.getCedula());
            pstmt.setString(2, elProfesor.getNombre());
            pstmt.setInt(3, elProfesor.getTelefono());
            pstmt.setString(4, elProfesor.getCorreoE());
            int resultado = pstmt.executeUpdate();

            if (resultado == 0) {
                throw new NoDataException("No se realizo la actualización");
            } else {
                System.out.println("\nModificación Satisfactoria!");
            }
        } catch (SQLException e) {
            throw new GlobalException("Sentencia no valida");
        } finally {
            try {
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
    }

    /*Buscar profesores*/
    public Profesor buscar_profesor(String id) throws GlobalException, NoDataException {

        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccion = new ArrayList();
        Profesor elProfesor = null;
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(BUSCAR_PROFESOR);
            pstmt.registerOutParameter(1, OracleTypes.CURSOR);
            pstmt.setString(2, id);
            pstmt.execute();
            rs = (ResultSet) pstmt.getObject(1);
            while (rs.next()) {
                elProfesor = new Profesor(rs.getString("CEDULA_PROFESOR"),
                        rs.getString("NOMBRE"),
                        rs.getInt("TELEFONO"),
                        rs.getString("EMAIL"));
                coleccion.add(elProfesor);
            }
        } catch (SQLException e) {
            e.printStackTrace();

            throw new GlobalException("Sentencia no valida");
        } finally {
            try {
                if (rs != null) {
                    rs.close();
                }
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
        if (coleccion == null || coleccion.size() == 0) {
            throw new NoDataException("No hay datos");
        }
        return elProfesor;
    }

    /*Listar profesores*/
    public ArrayList listar_profesor() throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el Driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }

        ResultSet rs = null;
        ArrayList coleccion = new ArrayList();
        Profesor elProfesor = null;
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTAR_PROFESOR);
            pstmt.registerOutParameter(1, OracleTypes.CURSOR);
            pstmt.execute();
            rs = (ResultSet) pstmt.getObject(1);
            while (rs.next()) {
                elProfesor = new Profesor(rs.getString("CEDULA_PROFESOR"),
                        rs.getString("NOMBRE"),
                        rs.getInt("TELEFONO"),
                        rs.getString("EMAIL"));
                coleccion.add(elProfesor);
            }
        } catch (SQLException e) {
            e.printStackTrace();

            throw new GlobalException("Sentencia no valida");
        } finally {
            try {
                if (rs != null) {
                    rs.close();
                }
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
        if (coleccion == null || coleccion.size() == 0) {
            throw new NoDataException("No hay datos");
        }
        return coleccion;
    }

    /*Eliminar profesores*/
    public void eliminar_profesor(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        PreparedStatement pstmt = null;
        try {
            pstmt = conexion.prepareStatement(ELIMINAR_PROFESOR);
            pstmt.setString(1, id);

            int resultado = pstmt.executeUpdate();

            if (resultado == 0) {
                throw new NoDataException("No se realizo el borrado");
            } else {
                System.out.println("\nEliminación Satisfactoria!");
            }
        } catch (SQLException e) {
            throw new GlobalException("Sentencia no valida");
        } finally {
            try {
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
    }
}
