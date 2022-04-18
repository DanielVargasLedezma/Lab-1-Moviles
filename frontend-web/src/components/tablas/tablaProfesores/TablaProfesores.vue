<template>
  <div>
    <!-- <Modal v-if="!GET_MOSTRAR_TABLA" /> -->

    <div id="container" v-show="GET_MOSTRAR_TABLA">
      <TablaProfesorOpciones
        :opcionesOrdenado="opcionesOrdenado"
        :accionBoton="crearProfesor"
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
        <TablaProfesorFila
          v-for="(profesor, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :profesor="profesor"
        />
      </div>
      <div id="indices">
        <TablaProfesorIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaProfesorOpciones from "./TablaProfesorOpciones.vue";
import TablaProfesorIndices from "./TablaProfesorIndices.vue";
import TablaProfesorFila from "./TablaProfesorFila.vue";
// import Modal from "./Modal.vue";

import profesorController from "../../../controllers/profesorController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaProfesorFila,
    TablaProfesorIndices,
    TablaProfesorOpciones,
    // Modal,
  },
  data() {
    return {
      opcionesOrdenado: ["Nombre", "Cedula"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME("Profesores Registrados");

    await profesorController
      .cargarProfesores(this.Token)
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
    this.SET_COLUMNS_TITLE(["Cédula", "Nombre", "Teléfono", "Correo", ""]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GetOpcionComboBoxReverse: "TableProfesorModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableProfesorModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableProfesorModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableProfesorModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableProfesorModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableProfesorModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableProfesorModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableProfesorModule/GET_ARRAY",
      GetTexto: "TableProfesorModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((profesor) => {
        return (
          profesor.cedula_profesor.includes(this.GetTexto) ||
          profesor.nombre.includes(this.GetTexto)
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
      SET_USUARIO_ACTUAL: "TableProfesorModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableProfesorModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableProfesorModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableProfesorModule/SET_TABLE_NAME",
      SET_SERVICES: "TableProfesorModule/SET_SERVICES",
      SET_TEXTO: "TableProfesorModule/SET_TEXTO",
      SET_ARRAY: "TableProfesorModule/SET_ARRAY",
    }),
    crearProfesor() {
      this.$router.push("/inicio/crear-profesor");
    },
  },
};
</script>