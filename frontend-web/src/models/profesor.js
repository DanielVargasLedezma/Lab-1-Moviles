import Usuario from "./usuario";

class Profesor extends Usuario {
  constructor(
    cedula = "",
    password = "",
    tipo_usuario = "",
    nombre = "",
    estado = "",
    telefono = "",
    correoE = ""
  ) {
    super(cedula, password, tipo_usuario, nombre, estado, correoE);

    this.telefono = telefono;
  }
}

export default Profesor;
