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
      <p>{{ curso.codigo_curso }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ curso.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]">
      <p v-if="curso.carrera">
        {{ curso.carrera.nombre }}
      </p>
      <p v-else>*Sin Carrera</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]"
      ><p>
        {{ curso.creditos }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[4]"
      ><p>
        {{ curso.horas_semanales }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[5]"
      ><p>
        {{ curso.anyo_a_llevar }}
      </p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[6]">
      <p v-if="curso.num_semestre_a_llevar === '1'">Primer Ciclo</p>
      <p v-else-if="curso.num_semestre_a_llevar === '2'">Segundo Ciclo</p>
    </span>

    <span>
      <select @change="manageAction" id="combo-box-telefonos">
        <option disabled selected>Elegir</option>
        <option v-if="path !== '/inicio/oferta-academica'" value="1">
          Editar
        </option>
        <option v-if="path === '/inicio/oferta-academica'" value="2">
          Grupos
        </option>
        <option v-if="path !== '/inicio/oferta-academica'" value="3">
          Eliminar
        </option>
      </select>
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
      GET_VISIBILIDAD_COLUMNAS: "TableCursoModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableCursoModule/GET_MODAL_NUM",
      GET_SERVICES: "TableCursoModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  props: {
    curso: null,
  },
  methods: {
    ...mapMutations({
      SET_CURSO_ACTUAL: "TableCursoModule/SET_CURSO_ACTUAL",
      SET_MOSTRAR_TABLA: "TableCursoModule/SET_MOSTRAR_TABLA",
    }),
    manageAction: function (e) {
      this.SET_CURSO_ACTUAL(this.curso);
      switch (e.target.value) {
        case "1":
          this.$router.push("/inicio/editar-curso");
          break;
        case "2":
          this.$router.push("/inicio/grupos-curso");
          break;
        case "3":
          break;
      }
    },
  },
};
</script>