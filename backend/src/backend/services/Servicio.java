/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package backend.services;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;
/**
 *
 * @author danil
 */
public class Servicio {
    
    protected Connection conexion = null;
    
    protected void conectar() throws SQLException,ClassNotFoundException 
    {
       Class.forName("oracle.jdbc.driver.OracleDriver");
       
       conexion = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:xe", "GestionAcademica", "root123");

//       try {
//            conexion = getJdbcMydbsource();
//        } catch (NamingException ex) {
//            ex.printStackTrace();
//        }
        
    }
    
    protected void desconectar() throws SQLException{
        if(!conexion.isClosed())
        {
            conexion.close();
        }
    }

    private Connection getJdbcMydbsource() throws NamingException {
        Context c = new InitialContext();
        
        try {
            return ((DataSource) c.lookup("jdbc/Mydbsource")).getConnection();
        } catch (NamingException ex) {
            ex.printStackTrace();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        
        return null;
    }
}
