class Usuario {
  constructor(
    cedula = "",
    password = "",
    tipo_usuario = "",
    nombre = "",
    estado = "",
    correoE = ""
  ) {
    this.cedula = cedula;
    this.password = password;
    this.tipo_usuario = tipo_usuario;
    this.nombre = nombre;
    this.estado = estado;
    this.correoE = correoE;
  }
}

export default Usuario;
