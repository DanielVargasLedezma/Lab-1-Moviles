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
      <p>{{ profesor.cedula_profesor }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ profesor.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ profesor.telefono }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ profesor.correo }}
      </p></span
    >

    <span>
      <select @change="manageAction" id="combo-box-telefonos">
        <option disabled selected>Elegir</option>
        <option value="1">Editar</option>
        <option value="2">Cursos</option>
        <option value="3">Eliminar</option>
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
      GET_VISIBILIDAD_COLUMNAS: "TableProfesorModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableProfesorModule/GET_MODAL_NUM",
      GET_SERVICES: "TableProfesorModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  props: {
    profesor: null,
  },
  methods: {
    ...mapMutations({
      SET_PROFESOR_ACTUAL: "TableProfesorModule/SET_PROFESOR_ACTUAL",
      SET_MOSTRAR_TABLA: "TableProfesorModule/SET_MOSTRAR_TABLA",
    }),
    manageAction: function (e) {
      switch (e.target.value) {
        case "1":
          this.SET_PROFESOR_ACTUAL(this.profesor);
          this.$router.push("/inicio/editar-profesor");
          break;
        case "2":
          break;
      }
    },
    ShowModal() {
      this.SET_MOSTRAR_TABLA(false);
    },
  },
};
</script>