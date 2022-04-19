class Curso {
  constructor(
    codigo_curso = "",
    codigo_carrera = "",
    nombre = "",
    creditos = "",
    horas_semanales = "",
    num_semestre_a_llevar = "",
    anyo_a_llevar = ""
  ) {
    this.codigo_curso = codigo_curso;
    this.codigo_carrera = codigo_carrera;
    this.nombre = nombre;
    this.creditos = creditos;
    this.horas_semanales = horas_semanales;
    this.num_semestre_a_llevar = num_semestre_a_llevar;
    this.anyo_a_llevar = anyo_a_llevar;
  }
}

export default Curso;
