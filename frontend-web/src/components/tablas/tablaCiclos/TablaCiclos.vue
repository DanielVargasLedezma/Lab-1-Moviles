<template>
  <div>
    <!-- <Modal v-if="!GET_MOSTRAR_TABLA" /> -->

    <div id="container" v-show="GET_MOSTRAR_TABLA">
      <TablaCiclosOpciones
        :opcionesOrdenado="opcionesOrdenado"
        :accionBoton="crearCiclo"
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
        <TablaCiclosFila
          v-for="(ciclo, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :ciclo="ciclo"
        />
      </div>
      <div id="indices">
        <TablaCiclosIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaCiclosOpciones from "./TablaCiclosOpciones.vue";
import TablaCiclosIndices from "./TablaCiclosIndices.vue";
import TablaCiclosFila from "./TablaCiclosFila.vue";
// import Modal from "./Modal.vue";

import cicloController from "../../../controllers/cicloController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaCiclosOpciones,
    TablaCiclosFila,
    TablaCiclosIndices,
    // Modal,
  },
  data() {
    return {
      opcionesOrdenado: ["Año"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME("Ciclos Registradas");

    await cicloController
      .cargarCiclos(this.Token)
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
      "Número de Ciclo",
      "Año del Ciclo",
      "Fecha de Inicio",
      "Fecha de Finalización",
      "Estado",
      "Acciones",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GetOpcionComboBoxReverse: "TableCicloModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableCicloModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableCicloModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableCicloModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableCicloModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableCicloModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableCicloModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableCicloModule/GET_ARRAY",
      GetTexto: "TableCicloModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((ciclo) => {
        return ciclo.year.includes(this.GetTexto);
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
      SET_USUARIO_ACTUAL: "TableCicloModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableCicloModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableCicloModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableCicloModule/SET_TABLE_NAME",
      SET_SERVICES: "TableCicloModule/SET_SERVICES",
      SET_TEXTO: "TableCicloModule/SET_TEXTO",
      SET_ARRAY: "TableCicloModule/SET_ARRAY",
    }),
    crearCiclo() {
      this.$router.push("/inicio/crear-ciclos");
    },
  },
};
</script>