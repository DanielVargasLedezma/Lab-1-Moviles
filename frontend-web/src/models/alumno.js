import Usuario from "./usuario";

class Alumno extends Usuario {
  constructor(
    cedula = "",
    password = "",
    tipo_usuario = 0,
    nombre = "",
    telefono = 0,
    correoE = "",
    fecha_nacimiento = "",
    codigo_carrera = ""
  ) {
    super(cedula, password, tipo_usuario);
    this.nombre = nombre;
    this.telefono = telefono;
    this.correoE = correoE;
    this.fecha_nacimiento = fecha_nacimiento;
    this.codigo_carrera = codigo_carrera;
  }
}

export default Alumno;
