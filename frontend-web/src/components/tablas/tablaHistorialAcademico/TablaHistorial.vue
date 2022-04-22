<template>
  <div>
    <div id="container">
      <TablaHistorialOpciones :opcionesOrdenado="opcionesOrdenado" />
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
        <TablaHistorialFila
          v-for="(historial, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :historial="historial"
        />
      </div>
      <div id="indices">
        <TablaHistorialIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaHistorialOpciones from "./TablaHistorialOpciones.vue";
import TablaHistorialIndices from "./TablaHistorialIndices.vue";
import TablaHistorialFila from "./TablaHistorialFila.vue";

import alumnoController from "../../../controllers/alumnoController";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaHistorialFila,
    TablaHistorialOpciones,
    TablaHistorialIndices,
  },
  data() {
    return {
      opcionesOrdenado: [
        "grupo.numero_grupo",
        "grupo.profesor.nombre",
        "grupo.ciclo.year",
      ],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
    this.SET_ARRAY([]);
    this.SET_CANTIDAD_UoC(0);
  },
  async mounted() {
    switch (window.location.pathname) {
      case "/inicio/historial-academico/alumno":
        this.SET_TABLE_NAME(
          `Historial Académica de ${this.UsuarioLoggeado.nombre}`
        );

        await alumnoController
          .matriculas(this.UsuarioLoggeado.cedula, this.Token)
          .then((response) => {
            this.SET_ARRAY(response);
            this.SET_CANTIDAD_UoC(this.GET_ARRAY.length);
          })
          .catch((error) => {
            console.error(error);
            this.SET_ARRAY([]);
          });

        break;
      case "/inicio/historial/alumno":
        this.SET_TABLE_NAME(
          `Historial Académica de ${this.GET_ALUMNO_ACTUAL.nombre}`
        );

        await alumnoController
          .matriculas(this.GET_ALUMNO_ACTUAL.cedula_alumno, this.Token)
          .then((response) => {
            this.SET_ARRAY(response);
            this.SET_CANTIDAD_UoC(this.GET_ARRAY.length);
          })
          .catch((error) => {
            console.error(error);
            this.SET_ARRAY([]);
          });

        break;
    }
  },
  created() {
    this.SET_COLUMNS_TITLE([
      "Número de Grupo",
      "Curso",
      "Profesor",
      "Ciclo",
      "Horario",
      "Nota",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GET_ALUMNO_ACTUAL: "TableAlumnoModule/GET_ALUMNO_ACTUAL",

      GetOpcionComboBoxReverse: "TableHistorialModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableHistorialModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableHistorialModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableHistorialModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableHistorialModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableHistorialModule/GET_PAGINA_ACTUAL",
      GET_ARRAY: "TableHistorialModule/GET_ARRAY",
      GetTexto: "TableHistorialModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((historial) => {
        return (
          historial.grupo.numero_grupo.includes(this.GetTexto) ||
          historial.grupo.profesor.nombre.includes(this.GetTexto) ||
          historial.grupo.ciclo.year.includes(this.GetTexto)
        );
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
      SET_COLUMNS_TITLE: "TableHistorialModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableHistorialModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableHistorialModule/SET_TABLE_NAME",
      SET_TEXTO: "TableHistorialModule/SET_TEXTO",
      SET_ARRAY: "TableHistorialModule/SET_ARRAY",
    }),
    crearGrupo() {
      this.$router.push("/inicio/crear-grupos");
    },
  },
};
</script>