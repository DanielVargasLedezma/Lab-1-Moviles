<template>
  <section>
    <section
      v-if="
        LoggedState && UsuarioLoggeado && UsuarioLoggeado.tipo_usuario === 1
      "
    >
      <div id="titulo-container">
        <h1 id="titulo">Editar Profesor</h1>
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
                  placeholder="Nombre del profesor"
                  name="nombre"
                  v-model="profesor.nombre"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.profesor.nombre.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.profesor.nombre.$error }]"
                >
                  <img
                    class="helpimg"
                    name="titulo"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span v-if="v$.profesor.nombre.$error" class="validation-error">
                El nombre del profesor es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="telefono">Teléfono</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Telefono del profesor"
                  name="telefono"
                  v-model="profesor.telefono"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.profesor.telefono.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.profesor.telefono.$error }]"
                >
                  <img
                    class="helpimg"
                    name="titulo"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span v-if="v$.profesor.telefono.$error" class="validation-error">
                El teléfono del profesor es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="correo">Correo Electrónico</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Correo electrónico del profesor"
                  name="correo"
                  v-model="profesor.correoE"
                  @input="touchInput"
                  @blur="touchInput"
                  :class="[{ error: v$.profesor.correoE.$error }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.profesor.correoE.$error }]"
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
              <span v-if="v$.profesor.correoE.$error" class="validation-error">
                El correo del profesor es requerido
              </span>
            </section>
          </div>

          <div id="col2"></div>
          <div>
            <section id="wrapper">
              <button type="submit" @click="editarProfesor">
                Editar Profesor
              </button>
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

import profesorController from "../../controllers/profesorController.js";
import Profesor from "@/models/profesor.js";

const alpha_with_spaces = helpers.regex(/^[\D\s]+$/);

const alpha_with_spaces_special_and_underscore = helpers.regex(/^[\w-\s]+$/);

export default {
  data() {
    return {
      v$: useValidate(),
      profesor: new Profesor(),
    };
  },
  validations() {
    return {
      profesor: {
        cedula: { required, alpha_with_spaces_special_and_underscore },
        nombre: {
          required,
          alpha_with_spaces,
        },
        telefono: {
          required,
          numeric,
        },
        correoE: {
          required,
          email,
        },
      },
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",

      GET_PROFESOR_ACTUAL: "TableProfesorModule/GET_PROFESOR_ACTUAL",
    }),
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }
    this.profesor.cedula = this.GET_PROFESOR_ACTUAL.cedula_profesor;
    this.profesor.nombre = this.GET_PROFESOR_ACTUAL.nombre;
    this.profesor.telefono = this.GET_PROFESOR_ACTUAL.telefono;
    this.profesor.correoE = this.GET_PROFESOR_ACTUAL.correo;
    console.log();
  },
  methods: {
    ...mapMutations({
      LogOut: "LoginModule/logout",
    }),
    showHelp(e) {
      switch (e.target.name) {
        case "cedula":
          swal.fire(
            "Cedula del Profesor",
            "En este apartado debe ingresar el número de cédula del profesor.",
            "info"
          );
          break;
        case "nombre":
          swal.fire(
            "Nombre del profesor",
            "En este apartado debe ingresar el nombre completo del profesor.",
            "info"
          );
          break;
        case "telefono":
          swal.fire(
            "Teléfono del profesor",
            "En este apartado debe ingresar el teléfono del profesor.",
            "info"
          );
          break;
        case "correo":
          swal.fire(
            "Correo electrónico del profesor",
            "En este apartado debe ingresar el correo electrónico del profesor.",
            "info"
          );
          break;
        default:
          console.log("Switch error");
          break;
      }
    },
    async editarProfesor() {
      await this.v$.$validate();
      console.log(this.v$);

      if (!this.v$.$error) {
        await profesorController
          .editarProfesor(this.profesor, this.Token)
          .then((response) => {
            if (response === 204) {
              swal.fire(
                "¡Profesor Editado!",
                "El profesor ha sido editado con éxito.",
                "success"
              );
              this.$router.push("/inicio/profesores");
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },

    touchInput: function (e) {
      switch (e.target.name) {
        case "nombre":
          this.v$.profesor.nombre.$touch();
          break;
        case "telefono":
          this.v$.profesor.telefono.$touch();
        case "correo":
          this.v$.profesor.correoE.$touch();
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