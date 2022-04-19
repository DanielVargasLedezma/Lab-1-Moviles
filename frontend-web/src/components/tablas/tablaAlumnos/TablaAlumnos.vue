<template>
  <div>
    <!-- <Modal v-if="!GET_MOSTRAR_TABLA" /> -->

    <div id="container" v-show="GET_MOSTRAR_TABLA">
      <TablaAlumnosOpciones
        :opcionesOrdenado="opcionesOrdenado"
        :accionBoton="crearAlumno"
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
        <TablaAlumnosFila
          v-for="(alumno, index) in listaFinal.slice(
            GET_PAGINA_ACTUAL * 10 - 10,
            GET_PAGINA_ACTUAL * 10
          )"
          :key="index"
          :alumno="alumno"
        />
      </div>
      <div id="indices">
        <TablaAlumnosIndices />
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import _ from "lodash";

import TablaAlumnosOpciones from "./TablaAlumnosOpciones.vue";
import TablaAlumnosIndices from "./TablaAlumnosIndices.vue";
import TablaAlumnosFila from "./TablaAlumnosFila.vue";

// import Modal from "./Modal.vue";

import carreraController from "../../../controllers/carreraController.js";
import alumnosController from "../../../controllers/alumnoController.js";

import "@/assets/css/Tabla.css";

export default {
  components: {
    TablaAlumnosFila,
    TablaAlumnosIndices,
    TablaAlumnosOpciones,
    // Modal,
  },
  data() {
    return {
      opcionesOrdenado: ["Nombre", "Cédula", "Carrera"],
    };
  },
  unmounted() {
    this.SET_TEXTO("");
  },
  async mounted() {
    if (
      this.UsuarioLoggeado &&
      this.UsuarioLoggeado.tipo_usuario !== 1 &&
      this.UsuarioLoggeado.tipo_usuario !== 2
    ) {
      this.$router.push("/inicio");
    }

    this.SET_TABLE_NAME("Alumnos Registrados");

    await alumnosController
      .cargarAlumnos(this.Token)
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
      "Cédula",
      "Nombre",
      "Telefono",
      "Correo Electronico",
      "Fecha Nacimiento",
      "Carrera",
      " ",
    ]);
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",

      GetOpcionComboBoxReverse: "TableAlumnoModule/GetOpcionComboBoxReverse",
      GET_VISIBILIDAD_COLUMNAS: "TableAlumnoModule/GET_VISIBILIDAD_COLUMNAS",
      GetOpcionComboBox: "TableAlumnoModule/GetOpcionComboBox",
      GET_COLUMNS_TITLE: "TableAlumnoModule/GET_COLUMNS_TITLE",
      GET_USUARIO_ACTUAL: "TableAlumnoModule/GetUsuarioActual",
      GET_PAGINA_ACTUAL: "TableAlumnoModule/GET_PAGINA_ACTUAL",
      GET_MOSTRAR_TABLA: "TableAlumnoModule/GET_MOSTRAR_TABLA",
      GET_ARRAY: "TableAlumnoModule/GET_ARRAY",
      GetTexto: "TableAlumnoModule/GetTexto",
    }),
    listaFiltrada: function () {
      return this.GET_ARRAY.filter((alumno) => {
        return (
          //alumno.codigo_carrera.includes(this.GetTexto) ||
          alumno.nombre.includes(this.GetTexto) ||
          alumno.cedula.includes(this.GetTexto)
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
      SET_USUARIO_ACTUAL: "TableAlumnoModule/SET_USUARIO_ACTUAL",
      SET_COLUMNS_TITLE: "TableAlumnoModule/SET_COLUMNS_TITLE",
      SET_CANTIDAD_UoC: "TableAlumnoModule/SET_CANTIDAD_UoC",
      SET_TABLE_NAME: "TableAlumnoModule/SET_TABLE_NAME",
      SET_SERVICES: "TableAlumnoModule/SET_SERVICES",
      SET_TEXTO: "TableAlumnoModule/SET_TEXTO",
      SET_ARRAY: "TableAlumnoModule/SET_ARRAY",
    }),
    crearAlumno() {
      this.$router.push("/inicio/crear-alumno");
    },
  },
};
</script>