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
      <Image :image="image" :clickEvent="clickEvent" />
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
  components: {
    Image: {
      template: `
      <router-link 
        title="Editar Carrera"
        active-class="active-link"
        style="text-decoration: none; color: inherit"
        to="/inicio/editar-carreras">
          <img
            id="moreLogo"
            alt="More logo"
            :src="image"
            @click="clickEvent"
          />
        </router-link>`,
      props: { image: null, clickEvent: null },
    },
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
    ShowModal() {
      this.SET_MOSTRAR_TABLA(false);
    },
  },
};
</script>