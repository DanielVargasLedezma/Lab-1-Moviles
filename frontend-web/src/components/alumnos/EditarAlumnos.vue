<template>
  <section>
    <section
      v-if="
        LoggedState && UsuarioLoggeado && UsuarioLoggeado.tipo_usuario === 1
      "
    >
      <div id="titulo-container">
        <h1 id="titulo">Edición de Alumnos</h1>
      </div>
      <div id="addContainer">
        <div id="col1">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombre">Nombre</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Nombre"
                  name="nombre"
                  v-model="alumno.nombre"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.alumno.nombre.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.alumno.nombre.$error }]"
                >
                  <img
                    class="helpimg"
                    name="nombre"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span v-if="v$.alumno.nombre.$error" class="validation-error">
                El nombre del alumno es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="telefono">Teléfono </label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Teléfono del alumno"
                  name="telefono"
                  v-model="alumno.telefono"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.alumno.telefono.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.alumno.telefono.$error }]"
                >
                  <img
                    class="helpimg"
                    name="telefono"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span v-if="v$.alumno.telefono.$error" class="validation-error">
                El teléfono del alumno es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="correo">Correo electrónico </label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Correo electrónico del alumno"
                  name="correo"
                  v-model="alumno.correoe"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.alumno.correoe.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.alumno.correoe.$error }]"
                >
                  <img
                    class="helpimg"
                    name="correo"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span v-if="v$.alumno.correoe.$error" class="validation-error">
                El correo del alumno es requerido
              </span>
            </section>
          </div>
        </div>
        <div id="col2">
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="carrera">Carrera</label>
              </div>
              <select
                name="codigo_carrera"
                id="rolCombo"
                @change="handleValueChange"
                @blur="touchInput"
                :class="[{ error: v$.alumno.codigo_carrera.$error }]"
                :value="alumno.codigo_carrera"
              >
                <option value="default" selected="Selected" disabled>
                  Seleccionar
                </option>
                <option
                  v-for="(carrera, index) in carreras"
                  :key="index"
                  :value="carrera.codigo_carrera"
                >
                  {{ carrera.nombre }}
                </option>
              </select>
            </section>
            <span
              class="validation-error"
              v-if="v$.alumno.codigo_carrera.$error"
            >
              Este campo es requerido
            </span>
          </div>
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
              </div>
              <div class="fecha_nacimiento">
                <div id="div-labels"></div>
                <section id="input-span">
                  <input
                    id="fecha_nacimiento"
                    name="fecha_nacimiento"
                    class="input-3"
                    type="date"
                    @blur="touchInput"
                    @change="resetFinal"
                    v-model="alumno.fecha_nacimiento"
                    :class="[{ error: v$.alumno.fecha_nacimiento.$error }]"
                  />
                  <span
                    class="question"
                    :class="[{ error: v$.alumno.fecha_nacimiento.$error }]"
                  >
                    <img
                      class="helpimg"
                      name="fecha_nacimiento"
                      @click="showHelp"
                      src="../../assets/svg/questionsign.svg"
                      alt="help"
                    />
                  </span>
                </section>
                <span
                  class="validation-error"
                  v-if="v$.alumno.fecha_nacimiento.$error"
                >
                  Este campo es requerido
                </span>
              </div>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <button type="submit" @click="editarAlumno">Editar Alumno</button>
            </section>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import { required, helpers, numeric, email } from "@vuelidate/validators";
import { mapMutations, mapGetters } from "vuex";
import useValidate from "@vuelidate/core";
import swal from "sweetalert2";

import carreraController from "../../controllers/carreraController.js";
import alumnoController from "../../controllers/alumnoController.js";
import Alumno from "@/models/alumno.js";
import Carrera from "@/models/carrera.js";

const alpha_with_spaces = helpers.regex(/^[\D\s]+$/);

const alpha_with_spaces_special_and_underscore = helpers.regex(/^[\w-\s]+$/);

export default {
  data() {
    return {
      v$: useValidate(),
      alumno: new Alumno(),
      carreras: [],
    };
  },
  validations() {
    return {
      alumno: {
        cedula: { required, numeric },
        codigo_carrera: { required, alpha_with_spaces_special_and_underscore },
        nombre: { required, alpha_with_spaces },
        telefono: { required, numeric },
        correoe: { required, email },
        fecha_nacimiento: { required },
      },
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",

      GET_ALUMNO_ACTUAL: "TableAlumnoModule/GET_ALUMNO_ACTUAL",
    }),
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.alumno.cedula = this.GET_ALUMNO_ACTUAL.cedula_alumno;
    this.alumno.nombre = this.GET_ALUMNO_ACTUAL.nombre;
    this.alumno.telefono = this.GET_ALUMNO_ACTUAL.telefono;
    this.alumno.correoe = this.GET_ALUMNO_ACTUAL.correoe;
    this.alumno.fecha_nacimiento =
      this.GET_ALUMNO_ACTUAL.fecha_nacimiento.substring(0, 10);
    this.alumno.codigo_carrera = this.GET_ALUMNO_ACTUAL.carrera.codigo_carrera;

    await carreraController
      .cargarTodas(this.Token)
      .then((res) => {
        this.carreras = res;
      })
      .catch((error) => {
        console.error(error);
      });
  },

  methods: {
    ...mapMutations({
      LogOut: "LoginModule/logout",
    }),
    showHelp(e) {
      switch (e.target.name) {
        case "cedula_alumno":
          swal.fire(
            "Cédula del alumno",
            "En este apartado debe ingresar la cédula del alumno a registrar.",
            "info"
          );
          break;
        case "codigo_carrera":
          swal.fire(
            "Código de la Carrera",
            "En este apartado debe ingresar el código de la carrera del alumno a registrar.",
            "info"
          );
          break;
        case "nombre":
          swal.fire(
            "Nombre del Alumno",
            "En este apartado debe ingresar el nombre del alumno a registrar.",
            "info"
          );
          break;
        case "telefono":
          swal.fire(
            "Telefono del alumno",
            "En este apartado debe ingresar el teléfono del alumno a registrar.",
            "info"
          );
          break;
        case "correo":
          swal.fire(
            "Correo electrónico del alumno",
            "En este apartado debe ingresar el correo electrónico del alumno a registrar.",
            "info"
          );
          break;
        case "fecha_nacimiento":
          swal.fire(
            "Fecha de nacimiento del Alumno",
            "En este apartado debe ingresar la fecha de nacimiento del alumno",
            "info"
          );
          break;
      }
    },
    handleValueChange(e) {
      if (e.target.name === "codigo_carrera") {
        this.alumno.codigo_carrera = e.target.value;
      }
      // console.log(e.target.name);
    },
    async editarAlumno() {
      await this.v$.$validate();
      console.log(this.v$);

      if (!this.v$.$error) {
        await alumnoController
          .editarAlumno(this.alumno, this.Token)
          .then((response) => {
            if (response === 204) {
              swal.fire(
                "¡Carrera Editada!",
                "La carrera ha sido editada con éxito.",
                "success"
              );
              this.$router.push("/inicio/alumnos");
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    touchInput: function (e) {
      switch (e.target.name) {
        case "cedula_alumno":
          this.v$.alumno.cedula.$touch();
          break;
        case "nombre":
          this.v$.alumno.nombre.$touch();
          break;
        case "telefono":
          this.v$.alumno.telefono.$touch();
          break;
        case "correo":
          this.v$.alumno.correoe.$touch();
          break;
        case "fecha_nacimiento":
          this.v$.alumno.fecha_nacimiento.$touch();
          break;
        case "codigo_carrera":
          this.v$.alumno.codigo_carrera.$touch();
          break;
      }
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap");
.validation-error {
  font-family: "Inter", sans-serif;
  color: red;
  flex-grow: 0;
}
textarea {
  width: 18rem;
  max-width: 18rem;
}
#editar-usuarios-container {
  height: 100%;
  overflow-y: scroll;
}
#titulo-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

#editar-usuarios-header-switch {
  display: flex;
  align-items: center;
}
.switch {
  position: relative;
  display: inline-block;
  width: 160px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #f44336;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
    rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
    rgba(0, 0, 0, 0.07) 0px 16px 16px;
  border-radius: 5px;
  font-family: "Inter", sans-serif;
  font-size: medium;
  color: #ffffff;
  text-align: center;
  user-select: none;
}

.slider div {
  padding-right: 10px;
  padding-left: 10px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  /*background-color: white;*/
  border-radius: 5px;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  background-image: url(../../assets/img/logosolo.png);
  background-size: contain;
}

input:checked + .slider {
  background-color: #4caf50;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
    rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
    rgba(0, 0, 0, 0.07) 0px 16px 16px;
}

input:focus + .slider {
  box-shadow: 0 0 10px #2196f3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(126px);
  border-radius: 5px;
  user-select: none;
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

@media screen and (min-width: 801px) {
  #titulo {
    margin: 0;
    margin-top: 1%;
    margin-left: 1%;
    font-family: "Inter", sans-serif;
    text-align: left;
    color: #3d3d3d;
    font-size: 250%;
  }

  #div-labels {
    display: flex;
    align-items: flex-start;
  }

  #addContainer {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 100%;
    height: 70vh;
  }

  #bottomContainer {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }

  #col1 {
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
  }

  #col1 div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  #col2 {
    width: 30%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: flex-start;
  }

  #col2 div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }

  #wrapper-telefono {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    width: 100%;
  }

  #input-span {
    display: flex;
    flex-direction: row;
  }
  #input-span-telefono {
    display: flex;
    flex-direction: row;
    margin-left: 0;
  }

  #input-feature {
    display: flex;
    flex-direction: row;
  }

  .question {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .question-telefono {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    width: 13%;
  }
  .question-telefono .helpimg {
    width: 2.5vw;
    height: 2.5vh;
  }

  .question:hover ~ #help-question {
    display: none;
  }

  #help-question {
    position: absolute;
  }

  #input-span .helpimg {
    width: 2.5vw;
    height: 2.5vh;
    cursor: pointer;
  }

  .error {
    border-color: rgb(184, 48, 48);
  }

  #input-span img .error {
    width: 2.5vw;
    height: 2.5vh;
    cursor: pointer;
    color: red;
  }

  label {
    font-family: "Inter", sans-serif;
    margin-bottom: 4%;
  }

  input,
  textarea {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 15vw;
    height: 5vh;
    border-radius: 5px 0px 0px 5px;
    background: #ffffff;
    border-top: solid 2px #969696;
    border-left: solid 2px #969696;
    border-bottom: solid 2px #969696;
    border-right: 0;
  }

  select {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 18vw;
    height: 5.5vh;
    border-radius: 5px;
    background: #ffffff;
    border: solid 2px #969696;
  }

  button {
    background-color: #1089d4;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
      rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
      rgba(0, 0, 0, 0.07) 0px 16px 16px;
    border-radius: 5px;
    width: 18vw;
    height: 5.8vh;
    font-family: "Inter", sans-serif;
    font-size: medium;
    color: #ffffff;
    text-align: center;
    cursor: pointer;
  }

  ::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: #838383;
  }
  ::-moz-placeholder {
    /* Firefox 19+ */
    color: #838383;
  }
  :-ms-input-placeholder {
    /* IE 10+ */
    color: #838383;
  }
  :-moz-placeholder {
    /* Firefox 18- */
    color: #838383;
  }

  .hidden {
    visibility: hidden;
  }

  #input-feature {
    margin: auto;
    margin-left: 0.5rem;
    cursor: pointer;
  }
}

@media screen and (max-width: 800px) {
  #editar-usuarios-container {
    height: 100%;
  }

  #editar-usuarios-header-switch {
    display: flex;
    align-items: center;
    margin-right: 1%;
    margin-top: 1%;
  }

  #titulo {
    margin: 0;
    margin-top: 1%;
    margin-left: 1%;
    font-family: "Inter", sans-serif;
    text-align: left;
    color: #3d3d3d;
    font-size: 150%;
  }

  #div-labels {
    align-items: center;
    display: flex;
    justify-content: center;
  }

  #addContainer {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%; /*estaba en 70 */
  }

  #col1 {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 1%;
  }
  #titulo-container {
    display: flex;
  }
  #col1 div {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  #col2 {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #col2 div {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #input-span {
    display: flex;
    width: 100%;
    flex-direction: row;
  }

  #input-span-telefono {
    display: flex;
    flex-direction: row;
    margin-left: 6%;
  }

  #input-feature {
    display: flex;
    flex-direction: row;
  }

  .question {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 3.7vh;
  }

  .question-telefono {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 3.7vh;
  }

  .question-telefono .helpimg {
    width: 5vw;
    height: 2.7vh;
    padding-right: 1%;
  }

  .question:hover ~ #help-question {
    display: none;
  }

  #help-question {
    position: absolute;
  }

  #input-span .helpimg {
    width: 5vw;
    height: 5vh;
    cursor: pointer;
    height: 2.7vh;
  }

  .error {
    border-color: rgb(184, 48, 48);
  }

  #input-span img .error {
    width: 2.5vw;
    height: 2.7vh;
    cursor: pointer;
    color: red;
  }

  label {
    font-family: "Inter", sans-serif;
    margin-bottom: 1%;
    font-size: 1rem;
  }

  input {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 60vw;
    height: 3.7vh;
    background-color: rgb(0, 0, 0);
    background: #ffffff;
    border-top: solid 2px #969696;
    border-left: solid 2px #969696;
    border-bottom: solid 2px #969696;
    border-right: 0;
  }

  select {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 65.5vw;
    height: fit-content;
    height: 3.7vh;
    border-radius: 5px;
    background: #ffffff;
    border: solid 2px #969696;
  }

  button {
    background-color: #1089d4;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
      rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
      rgba(0, 0, 0, 0.07) 0px 16px 16px;
    border-radius: 5px;
    width: 35vw;
    height: 5.8vh;
    font-family: "Inter", sans-serif;
    font-size: medium;
    color: #ffffff;
    text-align: center;
    cursor: pointer;
  }

  ::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: #838383;
  }
  ::-moz-placeholder {
    /* Firefox 19+ */
    color: #838383;
  }
  :-ms-input-placeholder {
    /* IE 10+ */
    color: #838383;
  }
  :-moz-placeholder {
    /* Firefox 18- */
    color: #838383;
  }

  .hidden {
    visibility: hidden;
  }

  #input-feature {
    position: relative;
    margin: auto;
    margin-left: 0.5rem;
    cursor: pointer;
  }
}
</style>