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
      <p>{{ usuario.cedula_usuario }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ usuario.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ usuario.tipo_usuario }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]" id="estado">
      <div v-if="usuario.estado == 1" id="estado-verde" @click="isCheckedM">
        Activado(a)
      </div>
      <div v-else id="estado-rojo" @click="isCheckedM">Desactivado(a)</div>
    </span>

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
      GET_VISIBILIDAD_COLUMNAS: "TableUsuarioModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableUsuarioModule/GET_MODAL_NUM",
      GET_SERVICES: "TableUsuarioModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  props: {
    usuario: null,
  },
  methods: {
    ...mapMutations({
      SET_USER_ACTUAL: "TableUsuarioModule/SET_USER_ACTUAL",
      SET_MOSTRAR_TABLA: "TableUsuarioModule/SET_MOSTRAR_TABLA",
    }),
    isCheckedM() {
      this.SET_USUARIO_ACTUAL(this.usuario);
    },
    manageAction: function (e) {
      switch (e.target.value) {
        case "1":
          this.SET_USER_ACTUAL(this.usuario);
          this.$router.push("/inicio/editar-usuario");
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