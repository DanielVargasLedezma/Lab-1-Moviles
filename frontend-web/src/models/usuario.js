class Usuario {
  constructor(cedula = "", password = "", tipo_usuario = 0) {
    this.cedula = cedula;
    this.password = password;
    this.tipo_usuario = tipo_usuario;
  }
}

export default Usuario;
