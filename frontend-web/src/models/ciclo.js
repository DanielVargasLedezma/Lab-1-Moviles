class Ciclo {
  constructor(
    id_ciclo = 0,
    numero_ciclo = "",
    year = "",
    fecha_inicio = "",
    fecha_finalizacion = "",
    ciclo_activo = ""
  ) {
    this.id_ciclo = id_ciclo;
    this.numero_ciclo = numero_ciclo;
    this.year = year;
    this.fecha_inicio = fecha_inicio;
    this.fecha_finalizacion = fecha_finalizacion;
    this.ciclo_activo = ciclo_activo;
  }
}

export default Ciclo;
