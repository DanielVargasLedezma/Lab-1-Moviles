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
      <p>{{ carrera.codigo_carrera }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ carrera.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ carrera.titulo }}
      </p></span
    >

    <span>
      <select @change="manageAction" id="combo-box-telefonos">
        <option disabled selected>Elegir</option>
        <option value="1">Editar</option>
        <option value="2">Eliminar</option>
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
    };
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableCarreraModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableCarreraModule/GET_MODAL_NUM",
      GET_SERVICES: "TableCarreraModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  props: {
    carrera: null,
  },
  methods: {
    ...mapMutations({
      SET_CARRERA_ACTUAL: "TableCarreraModule/SET_CARRERA_ACTUAL",
      SET_MOSTRAR_TABLA: "TableCarreraModule/SET_MOSTRAR_TABLA",
    }),
    clickEvent() {
      this.SET_CARRERA_ACTUAL(this.carrera);
    },
    manageAction: function (e) {
      switch (e.target.value) {
        case "1":
          this.SET_CARRERA_ACTUAL(this.carrera);

          break;
        case "2":
          console.log("a");

          break;
      }
    },
    ShowModal() {
      this.SET_MOSTRAR_TABLA(false);
    },
  },
};
</script>