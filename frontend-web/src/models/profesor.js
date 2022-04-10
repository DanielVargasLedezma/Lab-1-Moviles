import Usuario from "./usuario";

class Profesor extends Usuario {
  constructor(
    cedula = "",
    password = "",
    tipo_usuario = 0,
    nombre = "",
    telefono = 0,
    correoE = ""
  ) {
    super(cedula, password, tipo_usuario);
    this.nombre = nombre;
    this.telefono = telefono;
    this.correoE = correoE;
  }
}

export default Profesor;
