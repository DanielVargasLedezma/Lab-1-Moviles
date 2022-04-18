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
      <p>{{ grupo.numero_grupo }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>{{ grupo.curso.codigo_curso }} - {{ grupo.curso.nombre }}</p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ grupo.profesor.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]">
      <p v-if="grupo.ciclo.numero_ciclo === '1'">
        Ciclo I de {{ grupo.ciclo.year }}
      </p>
      <p v-else>Ciclo II de {{ grupo.ciclo.year }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[4]">
      <p v-if="grupo.dia_dos">
        {{ grupo.dia_uno }} / {{ grupo.dia_dos }} - {{ grupo.horario }}
      </p>
      <p v-else>{{ grupo.dia_uno }} - {{ grupo.horario }}</p>
    </span>

    <span>
      <select @change="manageAction" id="combo-box-telefonos">
        <option disabled selected>Elegir</option>
        <option v-if="path === '/inicio/grupos-curso'" value="1">Editar</option>
        <option v-if="path === '/inicio/grupos-curso'" value="2">
          Eliminar
        </option>
        <option v-if="path === '/inicio/matricula-alumno/cursos'" value="3">
          Desmatricular
        </option>
      </select>
    </span>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

import image from "@/assets/img/edit.png";

import "@/assets/css/TablaFila.css";

export default {
  data() {
    return {
      image: image,
      path: "",
    };
  },
  mounted() {
    this.path = window.location.pathname;
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableGrupoModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableGrupoModule/GET_MODAL_NUM",
      GET_SERVICES: "TableGrupoModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  props: {
    grupo: null,
  },
  methods: {
    ...mapMutations({
      SET_GRUPO_ACTUAL: "TableGrupoModule/SET_GRUPO_ACTUAL",
      SET_MOSTRAR_TABLA: "TableGrupoModule/SET_MOSTRAR_TABLA",
    }),
    manageAction: function (e) {
      switch (e.target.value) {
        case "1":
          this.SET_GRUPO_ACTUAL(this.grupo);
          this.$router.push("/inicio/editar-grupo");
          break;
        case "2":
          break;
      }
    },
    ShowModal() {
      this.SET_MOSTRAR_TABLA(false);
    },
  },
};
</script>