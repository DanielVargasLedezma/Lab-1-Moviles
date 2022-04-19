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
      <p>{{ alumno.cedula_alumno }}</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ alumno.nombre }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ alumno.telefono }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]"
      ><p>
        {{ alumno.correoe }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[4]"
      ><p>
        {{ alumno.fecha_nacimiento }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[5]"
      ><p>
        {{ alumno.carrera.nombre }}
      </p></span
    >

    <span>
      <select @change="manageAction" id="combo-box-telefonos">
        <option disabled selected>Elegir</option>
        <option value="1" v-if="this.UsuarioLoggeado.tipo_usuario === 1">
          Editar
        </option>
        <option value="2">Matricula</option>
        <option value="3" v-if="this.UsuarioLoggeado.tipo_usuario === 1">
          Eliminar
        </option>
      </select>
    </span>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import Swal from "sweetalert2";

import image from "@/assets/img/edit.png";

import "@/assets/css/TablaFila.css";
import alumnoController from "../../../controllers/alumnoController";

export default {
  data() {
    return {
      image: image,
    };
  },
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableAlumnoModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableAlumnoModule/GET_MODAL_NUM",
      GET_SERVICES: "TableAlumnoModule/GET_SERVICES",
      GET_ALUMNO_ACTUAL: "TableAlumnoModule/GET_ALUMNO_ACTUAL",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      Token: "LoginModule/Token",
    }),
  },
  props: {
    alumno: null,
  },
  methods: {
    ...mapMutations({
      SET_ALUMNO_ACTUAL: "TableAlumnoModule/SET_ALUMNO_ACTUAL",
      SET_MOSTRAR_TABLA: "TableAlumnoModule/SET_MOSTRAR_TABLA",
    }),
    manageAction: async function (e) {
      this.SET_ALUMNO_ACTUAL(this.alumno);
      switch (e.target.value) {
        case "1":
          this.$router.push("/inicio/editar-alumno");
          break;
        case "2":
          this.$router.push("/inicio/matricula-alumno/cursos");
          break;
        case "3":
          await Swal.fire({
            title: "¿Está seguro de eliminar este alumno del sistema?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            denyButtonText: `Cancelar`,
          }).then((result) => {
            if (result.isConfirmed) {
              alumnoController
                .eliminarAlumno(this.GET_ALUMNO_ACTUAL, this.Token)
                .then((response) => {
                  if (response === 204) {
                    Swal.fire(
                      "¡Alumno eliminado!",
                      "El alumno ha sido desmatriculado con éxito",
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