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
        {{ usuario.correoE }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]">
      <p v-if="usuario.tipo_usuario === '1'">Administrador</p>
      <p v-else>Matriculador</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[4]" id="estado">
      <div v-if="usuario.estado == 1" id="estado-verde">Activado(a)</div>
      <div v-else id="estado-rojo">Desactivado(a)</div>
    </span>

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
import Swal from "sweetalert2";

import "@/assets/css/TablaFila.css";
import userController from "../../../controllers/userController";

export default {
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableUsuarioModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableUsuarioModule/GET_MODAL_NUM",
      GET_SERVICES: "TableUsuarioModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",
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
    manageAction: async function (e) {
      this.SET_USER_ACTUAL(this.usuario);
      switch (e.target.value) {
        case "1":
          this.$router.push("/inicio/editar-usuario");
          break;
        case "2":
          if (this.usuario.cedula_usuario === this.UsuarioLoggeado.cedula) {
            Swal.fire(
              "¡Acción cancelada!",
              "No se puede eliminar a usted mismo.",
              "info"
            );

            return;
          }
          await Swal.fire({
            title: "¿Está seguro de eliminar este grupo?",
            showDenyButton: true,
            confirmButtonText: "Confirmar",
            denyButtonText: `Cancelar`,
            icon: "warning",
          }).then((result) => {
            if (result.isConfirmed) {
              userController
                .eliminarUsuario(this.usuario, this.Token)
                .then((response) => {
                  if (response === 204) {
                    Swal.fire(
                      "¡Usuario eliminado!",
                      "El usuario ha sido eliminado con éxito.",
                      "success"
                    );

                    this.$router.push("/inicio");
                  }
                })
                .catch((error) => {
                  console.error(error.data);
                  Swal.fire("¡Error!", `${error.data.message}`, "error");
                });
            } else {
              Swal.fire("Acción cancelada", "", "info");
            }
          });
          break;
      }
    },
  },
};
</script>