<template>
  <div>
    <div id="container">
      <TablaGruposOpciones
        :opcionesOrdenado="opcionesOrdenado"
        :accionBoton="crearGrupo"
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
        <TablaGruposFila
          v-for="(grupo, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :grupo="grupo"
        />
      </div>
      <div id="indices">
        <TablaGruposIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaGruposOpciones from "./TablaGruposOpciones.vue";
import TablaGruposIndices from "./TablaGruposIndices.vue";
import TablaGruposFila from "./TablaGruposFila.vue";

import grupoController from "../../../controllers/grupoController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaGruposFila,
    TablaGruposOpciones,
    TablaGruposIndices,
  },
  data() {
    return {
      opcionesOrdenado: ["numero_grupo", "profesor.nombre", "ciclo.year"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME(
      "Grupos Programados de " + this.GET_CURSO_ACTUAL.nombre
    );

    if (this.UsuarioLoggeado.tipo_usuario === 1) {
      await grupoController
        .cargarGruposDeCurso(this.Token, this.GET_CURSO_ACTUAL.codigo_curso)
        .then((response) => {
          this.SET_ARRAY(response);
          this.SET_CANTIDAD_UoC(this.GET_ARRAY.length);
        })
        .catch((error) => {
          console.error(error);
          this.SET_ARRAY([]);
        });
    }
  },
  created() {
    this.SET_COLUMNS_TITLE([
      "Número de Grupo",
      "Curso",
      "Profesor",
      "Ciclo",
      "Horario",
      "Acción",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GET_CURSO_ACTUAL: "TableCursoModule/GET_CURSO_ACTUAL",

      GetOpcionComboBoxReverse: "TableGrupoModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableGrupoModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableGrupoModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableGrupoModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableGrupoModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableGrupoModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableGrupoModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableGrupoModule/GET_ARRAY",
      GetTexto: "TableGrupoModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((grupo) => {
        return (
          grupo.numero_grupo.includes(this.GetTexto) ||
          grupo.profesor.nombre.includes(this.GetTexto) ||
          grupo.ciclo.year.includes(this.GetTexto)
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
      SET_USUARIO_ACTUAL: "TableGrupoModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableGrupoModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableGrupoModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableGrupoModule/SET_TABLE_NAME",
      SET_SERVICES: "TableGrupoModule/SET_SERVICES",
      SET_TEXTO: "TableGrupoModule/SET_TEXTO",
      SET_ARRAY: "TableGrupoModule/SET_ARRAY",
    }),
    crearGrupo() {
      this.$router.push("/inicio/crear-grupos");
    },
  },
};
</script>