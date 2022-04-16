<template>
  <div>
    <!-- <Modal v-if="!GET_MOSTRAR_TABLA" /> -->

    <div id="container" v-show="GET_MOSTRAR_TABLA">
      <TablaCarrerasOpciones
        :opcionesOrdenado="opcionesOrdenado"
        :accionBoton="crearCarrera"
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
        <TablaCarrerasFila
          v-for="(carrera, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :carrera="carrera"
        />
      </div>
      <div id="indices">
        <TablaCarrerasIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaCarrerasOpciones from "./TablaCarrerasOpciones.vue";
import TablaCarrerasIndices from "./TablaCarrerasIndices.vue";
import TablaCarrerasFila from "./TablaCarrerasFila.vue";
// import Modal from "./Modal.vue";

import carreraController from "../../../controllers/carreraController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaCarrerasFila,
    TablaCarrerasIndices,
    TablaCarrerasOpciones,
    // Modal,
  },
  data() {
    return {
      opcionesOrdenado: ["nombre", "codigo_carrera"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME("Carreras Registradas");

    await carreraController
      .cargarTodas(this.Token)
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
      "Código de la Carrera",
      "Nombre de la Carrera",
      "Título de la Carrera",
      "Acción",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GetOpcionComboBoxReverse: "TableCarreraModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableCarreraModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableCarreraModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableCarreraModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableCarreraModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableCarreraModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableCarreraModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableCarreraModule/GET_ARRAY",
      GetTexto: "TableCarreraModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((carrera) => {
        return (
          carrera.codigo_carrera.includes(this.GetTexto) ||
          carrera.nombre.includes(this.GetTexto)
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
      SET_USUARIO_ACTUAL: "TableCarreraModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableCarreraModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableCarreraModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableCarreraModule/SET_TABLE_NAME",
      SET_SERVICES: "TableCarreraModule/SET_SERVICES",
      SET_TEXTO: "TableCarreraModule/SET_TEXTO",
      SET_ARRAY: "TableCarreraModule/SET_ARRAY",
    }),
    crearCarrera() {
      this.$router.push("/inicio/crear-carreras");
    },
  },
};
</script>