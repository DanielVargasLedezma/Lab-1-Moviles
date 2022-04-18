class Curso {
    constructor(
        codigo_curso = "",
        codigo_carrera = "",
        nombre = "",
        creditos = 0,
        horas_semanales = 0,
        num_semestre_a_llevar = 0,
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
