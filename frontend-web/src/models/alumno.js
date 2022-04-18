import Usuario from "./usuario";

class Alumno extends Usuario {
  constructor(
    cedula = "",
    password = "",
    tipo_usuario = "",
    nombre = "",
    estado = "",
    telefono = "",
    correoE = "",
    fecha_nacimiento = "",
    codigo_carrera = ""
  ) {
    super(cedula, password, tipo_usuario, nombre, estado, correoE);

    this.telefono = telefono;
    this.fecha_nacimiento = fecha_nacimiento;
    this.codigo_carrera = codigo_carrera;
  }
}

export default Alumno;
