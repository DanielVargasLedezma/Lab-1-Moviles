class Curso {
    constructor(
        codigo_curso = "",
        nombre = "",
        creditos = 0,
        horas_semanales = 0
    ) {
        this.codigo_curso = codigo_curso;
        this.nombre = nombre;
        this.creditos = creditos;
        this.horas_semanales = horas_semanales;
    }
}

export default Curso;
