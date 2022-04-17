class Usuario {
  constructor(cedula = "", password = "", tipo_usuario = 0, nombre = "", estado = 0) {
    this.cedula = cedula;
    this.password = password;
    this.tipo_usuario = tipo_usuario;
    this.nombre = nombre;
    this.estado = estado;
  }
}

export default Usuario;
