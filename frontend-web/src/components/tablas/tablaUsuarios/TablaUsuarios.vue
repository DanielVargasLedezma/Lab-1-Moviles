<template>
  <div>
    <!-- <Modal v-if="!GET_MOSTRAR_TABLA" /> -->

    <div id="container" v-show="GET_MOSTRAR_TABLA">
      <TablaUsuariosOpciones
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
        <TablaUsuariosFila
          v-for="(usuario, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :usuario="usuario"
        />
      </div>
      <div id="indices">
        <TablaUsuariosIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaUsuariosOpciones from "./TablaUsuariosOpciones.vue";
import TablaUsuariosIndices from "./TablaUsuariosIndices.vue";
import TablaUsuariosFila from "./TablaUsuariosFila.vue";
// import Modal from "./Modal.vue";

import carreraController from "../../../controllers/carreraController.js";
import userController from "../../../controllers/userController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaUsuariosFila,
    TablaUsuariosIndices,
    TablaUsuariosOpciones,
    // Modal,
  },
  data() {
    return {
      opcionesOrdenado: ["Nombre", "Cédula"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME("Usuarios Registrados");

    await userController
      .cargarUsuarios(this.Token)
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
      "Cédula del usuario",
      "Nombre",
      "Tipo de usuario",
      "Estado",
      "Acción",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GetOpcionComboBoxReverse: "TableUsuarioModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableUsuarioModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableUsuarioModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableUsuarioModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableUsuarioModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableUsuarioModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableUsuarioModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableUsuarioModule/GET_ARRAY",
      GetTexto: "TableUsuarioModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((usuario) => {
        return (
          usuario.cedula_usuario.includes(this.GetTexto) ||
          usuario.tipo_usuario.includes(this.GetTexto)
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
      SET_USUARIO_ACTUAL: "TableUsuarioModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableUsuarioModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableUsuarioModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableUsuarioModule/SET_TABLE_NAME",
      SET_SERVICES: "TableUsuarioModule/SET_SERVICES",
      SET_TEXTO: "TableUsuarioModule/SET_TEXTO",
      SET_ARRAY: "TableUsuarioModule/SET_ARRAY",
    }),
    crearCarrera() {
      this.$router.push("/inicio/crear-usuarios");
    },
  },
};
</script>