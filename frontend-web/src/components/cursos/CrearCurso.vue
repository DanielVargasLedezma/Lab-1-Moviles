<template>
  <section>
    <section
      v-if="
        LoggedState && UsuarioLoggeado && UsuarioLoggeado.tipo_usuario === 1
      "
    >
      <div id="titulo-container">
        <h1 id="titulo">Creación de Cursos</h1>
      </div>
      <div id="addContainer">
        <div id="col1">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="codigo_curso">Código del Curso</label>
              </div>

              <section id="input-span">
                <input
                  type="text"
                  placeholder="Código del Curso"
                  name="codigo_curso"
                  v-model="curso.codigo_curso"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[
                    {
                      error: v$.curso.codigo_curso.$error,
                      correct: !v$.curso.codigo_curso.$error,
                    },
                  ]"
                />
                <span
                  :class="[{ error: v$.curso.codigo_curso.$error }]"
                  class="question"
                >
                  <img
                    class="helpimg"
                    :class="[{ error: v$.curso.codigo_carrera.$error }]"
                    name="codigo_curso"
                    @click="showHelp"
                    src="@/assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span
                v-if="v$.curso.codigo_curso.$error"
                class="validation-error"
              >
                El código del curso es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombre">Nombre del curso </label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Nombre"
                  name="nombre"
                  v-model="curso.nombre"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.curso.nombre.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.curso.nombre.$error }]"
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
              <span v-if="v$.curso.nombre.$error" class="validation-error">
                El nombre del curso es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="codigo_carrera">Carrera del Curso</label>
              </div>
              <select
                name="codigo_carrera"
                id="rolCombo"
                @change="handleValueChange"
                @blur="touchInput"
                :class="[{ error: v$.curso.codigo_carrera.$error }]"
                :value="
                  GET_CARRERA_ACTUAL
                    ? GET_CARRERA_ACTUAL.codigo_carrera
                    : 'default'
                "
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
              v-if="v$.curso.codigo_carrera.$error"
              class="validation-error"
            >
              Campo requerido.
            </span>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="creditos">Créditos del curso </label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Créditos del curso"
                  name="creditos"
                  v-model="curso.creditos"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.curso.creditos.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.curso.creditos.$error }]"
                >
                  <img
                    class="helpimg"
                    name="creditos"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span v-if="v$.curso.creditos.$error" class="validation-error">
                Los créditos del curso son requeridos
              </span>
            </section>
          </div>
        </div>
        <div id="col2">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="horas_semanales">Horas semanales del curso </label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Horas semanales del curso"
                  name="horas_semanales"
                  v-model="curso.horas_semanales"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.curso.horas_semanales.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.curso.horas_semanales.$error }]"
                >
                  <img
                    class="helpimg"
                    name="horas_semanales"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span
                v-if="v$.curso.horas_semanales.$error"
                class="validation-error"
              >
                Los horas semanales del curso son requeridas
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="anyo_a_llevar">Año en el que se cursa</label>
              </div>
              <section id="input-span">
                <select
                  name="anyo_a_llevar"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.curso.anyo_a_llevar.$error }]"
                >
                  <option value="default" selected="Selected" disabled>
                    Seleccionar
                  </option>
                  <option value="Primero">Primer Año</option>
                  <option value="Segundo">Segundo Año</option>
                  <option value="Tercer">Tercer Año</option>
                  <option value="Cuarto">Cuarto Año</option>
                  <option value="Quinto">Quinto Año</option>
                </select>
              </section>
              <span
                class="validation-error"
                v-if="v$.curso.anyo_a_llevar.$error"
              >
                Este campo es requerido.
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="num_semestre_a_llevar">Ciclo donde se cursa</label>
              </div>
              <section id="input-span">
                <select
                  name="num_semestre_a_llevar"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.curso.num_semestre_a_llevar.$error }]"
                >
                  <option value="default" selected="Selected" disabled>
                    Seleccionar
                  </option>
                  <option value="1">Primer Ciclo</option>
                  <option value="2">Segundo Ciclo</option>
                </select>
              </section>
              <span
                class="validation-error"
                v-if="v$.curso.num_semestre_a_llevar.$error"
              >
                Este campo es requerido.
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <button type="submit" @click="insertarCurso">Crear Curso</button>
            </section>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import { required, helpers, numeric } from "@vuelidate/validators";
import { mapMutations, mapGetters } from "vuex";
import useValidate from "@vuelidate/core";
import swal from "sweetalert2";

import carreraController from "../../controllers/carreraController.js";
import cursoController from "../../controllers/cursoController.js";
import Curso from "@/models/curso.js";

const alpha_with_spaces = helpers.regex(/^[\D\s]+$/);

const alpha_with_spaces_special_and_underscore = helpers.regex(/^[\w-\s]+$/);

export default {
  data() {
    return {
      v$: useValidate(),
      curso: new Curso(),
      carreras: [],
    };
  },
  validations() {
    return {
      curso: {
        codigo_curso: { required, alpha_with_spaces_special_and_underscore },
        codigo_carrera: { required, alpha_with_spaces_special_and_underscore },
        nombre: {
          required,
          alpha_with_spaces,
        },
        creditos: {
          required,
          numeric,
        },
        horas_semanales: {
          required,
          numeric,
        },
        num_semestre_a_llevar: {
          required,
          numeric,
        },
        anyo_a_llevar: {
          required,
        },
      },
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",

      GET_CARRERA_ACTUAL: "TableCarreraModule/GET_CARRERA_ACTUAL",
    }),
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    await carreraController
      .cargarTodas(this.Token)
      .then((response) => {
        this.carreras = response;
      })
      .catch((error) => {
        console.error(error);
      });

    if (this.GET_CARRERA_ACTUAL) {
      this.curso.codigo_carrera = this.GET_CARRERA_ACTUAL.codigo_curso;
    }
  },
  unmounted() {
    this.SET_CARRERA_ACTUAL(null);
  },
  methods: {
    ...mapMutations({
      LogOut: "LoginModule/logout",

      SET_CARRERA_ACTUAL: "TableCarreraModule/SET_CARRERA_ACTUAL",
    }),
    showHelp(e) {
      switch (e.target.name) {
        case "codigo_curso":
          swal.fire(
            "Código de la Carrera",
            "En este apartado debe ingresar el código único de la carrera a registrar.",
            "info"
          );
          break;
        case "nombre":
          swal.fire(
            "Nombre de la Carrera",
            "En este apartado debe ingresar el nombre de la carrera a registrar.",
            "info"
          );
          break;
        case "carrera":
          swal.fire(
            "Carrera a la que pertenece",
            "En este apartado debe ingresar la carrera a la que pertenece el curso a registrar.",
            "info"
          );
          break;
        case "creditos":
          swal.fire(
            "Créditos del curso",
            "En este apartado debe ingresar número de créditos del curso a registrar.",
            "info"
          );
          break;
        case "horas_semanales":
          swal.fire(
            "Horas semanales del curso",
            "En este apartado debe ingresar número total de horas semanales del curso a registrar.",
            "info"
          );
          break;
        case "num_semestre_a_llevar":
          swal.fire(
            "Semestre en el que se debe llevar el curso",
            "En este apartado debe ingresar el semestre en el que se debe llevar el curso a registrar.",
            "info"
          );
          break;
        case "anyo_a_llevar":
          swal.fire(
            "Año de la carrera en el que se debe llevar el curso",
            "En este apartado debe ingresar el año de la carrera en el que se debe llevar el curso a registrar.",
            "info"
          );
          break;
        default:
          console.log("Switch error");
          break;
      }
    },
    touchInput: function (e) {
      switch (e.target.name) {
        case "codigo_curso":
          this.v$.curso.codigo_curso.$touch();
          break;
        case "nombre":
          this.v$.curso.nombre.$touch();
          break;
        case "codigo_carrera":
          this.v$.curso.codigo_carrera.$touch();
          break;
        case "creditos":
          this.v$.curso.creditos.$touch();
          break;
        case "horas_semanales":
          this.v$.curso.horas_semanales.$touch();
          break;
        case "num_semestre_a_llevar":
          this.v$.curso.num_semestre_a_llevar.$touch();
          break;
        case "anyo_a_llevar":
          this.v$.curso.anyo_a_llevar.$touch();
          break;
      }
    },
    handleValueChange: function (e) {
      switch (e.target.name) {
        case "num_semestre_a_llevar":
          this.curso.num_semestre_a_llevar = parseInt(e.target.value);
          break;
        case "anyo_a_llevar":
          this.curso.anyo_a_llevar = e.target.value;
          break;
        case "codigo_carrera":
          this.curso.codigo_carrera = e.target.value;
          break;
      }
    },
    async insertarCurso() {
      await this.v$.$validate();

      if (!this.v$.$error) {
        await cursoController
          .registrarCurso(this.curso, this.Token)
          .then((response) => {
            if (response === 201) {
              swal.fire(
                "Curso Registrado!",
                "El curso ha sido registrado con éxito.",
                "success"
              );
              this.$router.push("/inicio/cursos");
            }
          })
          .catch((error) => {
            console.error(error.data);
            swal.fire("¡Error!", `${error.data.message}`, "error");
          });
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

  input,
  textarea {
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