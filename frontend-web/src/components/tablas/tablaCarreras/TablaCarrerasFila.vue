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
        <option disabled selected="Selected">Elegir</option>
        <option value="1">Editar</option>
        <option value="2">Cursos</option>
        <option value="3">Eliminar</option>
      </select>
    </span>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import Swal from "sweetalert2";

import "@/assets/css/TablaFila.css";

import carreraController from "../../../controllers/carreraController";

export default {
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableCarreraModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableCarreraModule/GET_MODAL_NUM",
      GET_SERVICES: "TableCarreraModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",
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
    manageAction: async function (e) {
      this.SET_CARRERA_ACTUAL(this.carrera);
      switch (e.target.value) {
        case "1":
          this.$router.push("/inicio/editar-carrera");
          break;
        case "2":
          this.$router.push("/inicio/cursos-carrera");
          break;
        case "3":
          await Swal.fire({
            title: "¿Está seguro de eliminar este alumno del sistema?",
            showDenyButton: true,
            confirmButtonText: "Confirmar",
            denyButtonText: `Cancelar`,
          }).then((result) => {
            if (result.isConfirmed) {
              carreraController
                .eliminarCarrera(this.carrera, this.Token)
                .then((response) => {
                  if (response === 204) {
                    Swal.fire(
                      "Carrera eliminada!",
                      "La carrera ha sido eliminada con éxito.",
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