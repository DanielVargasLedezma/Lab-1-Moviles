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
import Swal from "sweetalert2";

import "@/assets/css/TablaFila.css";
import profesorController from "../../../controllers/profesorController";

export default {
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableProfesorModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableProfesorModule/GET_MODAL_NUM",
      GET_SERVICES: "TableProfesorModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",
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
    manageAction: async function (e) {
      switch (e.target.value) {
        case "1":
          this.SET_PROFESOR_ACTUAL(this.profesor);
          this.$router.push("/inicio/editar-profesor");
          break;
        case "2":
          break;
        case "3":
          await Swal.fire({
            title: "¿Está seguro de eliminar este profesor?",
            showDenyButton: true,
            confirmButtonText: "Confirmar",
            denyButtonText: `Cancelar`,
            icon: "warning",
          }).then((result) => {
            if (result.isConfirmed) {
              profesorController
                .eliminarProfesor(this.profesor, this.Token)
                .then((response) => {
                  if (response === 204) {
                    Swal.fire(
                      "Profesor eliminado!",
                      "El profesor ha sido eliminado con éxito.",
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
    ShowModal() {
      this.SET_MOSTRAR_TABLA(false);
    },
  },
};
</script>