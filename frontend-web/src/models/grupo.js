class Grupo {
  constructor(
    numero_grupo = "",
    codigo_curso = "",
    cedula_profesor = "",
    id_ciclo = "",
    horario_inicio = "",
    horario_final = "",
    dia_dos = "",
    dia_uno = ""
  ) {
    this.numero_grupo = numero_grupo;
    this.codigo_curso = codigo_curso;
    this.cedula_profesor = cedula_profesor;
    this.id_ciclo = id_ciclo;
    this.horario_inicio = horario_inicio;
    this.horario_final = horario_final;
    this.dia_uno = dia_uno;
    this.dia_dos = dia_dos;
  }
}

export default Grupo;
