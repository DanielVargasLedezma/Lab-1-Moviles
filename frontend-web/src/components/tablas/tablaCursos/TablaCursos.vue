<template>
  <div>
    <!-- <Modal v-if="!GET_MOSTRAR_TABLA" /> -->

    <div id="container" v-show="GET_MOSTRAR_TABLA">
      <TablaCursosOpciones
        :opcionesOrdenado="opcionesOrdenado"
        :accionBoton="crearCursos"
      />
      <div id="tablita">
        <div id="header">
          <th
            v-for="(columna, index) in GET_COLUMNS_TITLE.length"
            :key="index"
            v-show="GET_VISIBILIDAD_COLUMNAS[index]"
          >
            <div v-if="index === 0"></div>
            {{ GET_COLUMNS_TITLE[index] }}
          </th>
        </div>
        <TablaCursosFila
          v-for="(curso, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :curso="curso"
        />
      </div>
      <div id="indices">
        <TablaCursosIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaCursosOpciones from "./TablaCursosOpciones.vue";
import TablaCursosIndices from "./TablaCursosIndices.vue";
import TablaCursosFila from "./TablaCursosFila.vue";
// import Modal from "./Modal.vue";

import cursoController from "../../../controllers/cursoController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaCursosFila,
    TablaCursosIndices,
    TablaCursosOpciones,
    // Modal,
  },
  data() {
    return {
      opcionesOrdenado: ["Nombre", "Código", "Carrera"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME("Cursos Registrados");

    await cursoController
      .cargarCursos(this.Token)
      .then((response) => {
        this.SET_ARRAY(response);
        this.SET_CANTIDAD_UoC(this.GET_ARRAY.length);
      })
      .catch((error) => {
        console.error(error);
        this.SET_ARRAY([]);
      });
  },
  created() {
    this.SET_COLUMNS_TITLE([
      "Código del Curso",
      "Nombre del Curso",
      "Carrera del Curso",
      "Créditos del Curso",
      "Horas semanales",
      "Semestre donde se lleva",
      "Año donde se lleva",
      "",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GetOpcionComboBoxReverse: "TableCursoModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableCursoModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableCursoModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableCursoModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableCursoModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableCursoModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableCursoModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableCursoModule/GET_ARRAY",
      GetTexto: "TableCursoModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((curso) => {
        if (curso.carrera) {
          return (
            curso.codigo_curso.includes(this.GetTexto) ||
            curso.nombre.includes(this.GetTexto) ||
            curso.carrera.nombre.includes(this.GetTexto)
          );
        } else {
          return (
            curso.codigo_curso.includes(this.GetTexto) ||
            curso.nombre.includes(this.GetTexto)
          );
        }
      });
    },
    listaFinal: function () {
      var listaF;
      if (this.GetOpcionComboBoxReverse) {
        listaF = _.reverse(
          _.orderBy(this.listaFiltrada, this.GetOpcionComboBox)
        );
        this.SET_CANTIDAD_UoC(listaF.length);
        return listaF;
      }
      listaF = _.orderBy(this.listaFiltrada, this.GetOpcionComboBox);
      this.SET_CANTIDAD_UoC(listaF.length);

      return listaF;
    },
  },
  methods: {
    ...mapMutations({
      SET_USUARIO_ACTUAL: "TableCursoModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableCursoModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableCursoModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableCursoModule/SET_TABLE_NAME",
      SET_SERVICES: "TableCursoModule/SET_SERVICES",
      SET_TEXTO: "TableCursoModule/SET_TEXTO",
      SET_ARRAY: "TableCursoModule/SET_ARRAY",
    }),
    crearCursos() {
      this.$router.push("/inicio/crear-carreras");
    },
  },
};
</script>