<template>
  <div id="barrita">
    <span v-if="GET_VISIBILIDAD_COLUMNAS[0]" id="nombre">
      <div id="logo-usuario">
        <img
          id="userLogo"
          alt="User logo"
          src="../../../assets/svg/user-solid.svg"
        />
      </div>
      <p>{{ historial.grupo.numero_grupo }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ historial.grupo.curso.codigo_curso }} -
        {{ historial.grupo.curso.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ historial.grupo.profesor.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]">
      <p v-if="historial.grupo.ciclo.numero_ciclo === '1'">
        Ciclo I de {{ historial.grupo.ciclo.year }}
      </p>
      <p v-else>Ciclo II de {{ historial.grupo.ciclo.year }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[4]">
      <p v-if="historial.grupo.dia_dos !== 'null'">
        {{ historial.grupo.dia_uno }} / {{ historial.grupo.dia_dos }} -
        {{ historial.grupo.horario }}
      </p>
      <p v-else>
        {{ historial.grupo.dia_uno }} - {{ historial.grupo.horario }}
      </p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[5]">
      <p v-if="historial.nota">
        {{ historial.nota }}
      </p>
      <p v-else>*Sin nota</p>
    </span>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

import "@/assets/css/TablaFila.css";

export default {
  data() {
    return {
      path: "",
    };
  },
  mounted() {
    this.path = window.location.pathname;
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableHistorialModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableHistorialModule/GET_MODAL_NUM",
      GET_SERVICES: "TableHistorialModule/GET_SERVICES",

      GET_ALUMNO_ACTUAL: "TableAlumnoModule/GET_ALUMNO_ACTUAL",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",
    }),
  },
  props: {
    historial: null,
  },
  methods: {
    ...mapMutations({
      SET_HISTORIAL_ACTUAL: "TableHistorialModule/SET_HISTORIAL_ACTUAL",
      SET_MOSTRAR_TABLA: "TableHistorialModule/SET_MOSTRAR_TABLA",
    }),
    manageAction: async function (e) {},
  },
};
</script>